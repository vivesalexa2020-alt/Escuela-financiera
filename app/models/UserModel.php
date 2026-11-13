<?php
namespace App\Models;

use PDO;
use App\Core\Model;
use App\Core\Logger;

class UserModel extends Model {
    public function findByEmail(string $email): ?array {
        $stmt = $this->db->prepare("
            SELECT id, nombre, email, password_hash, rol, email_verificado 
            FROM usuarios 
            WHERE email = ? AND activo = 1 AND eliminado_en IS NULL
        ");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        return $user ?: null;
    }

    public function findById(int $id): ?array {
        $stmt = $this->db->prepare("
            SELECT id, nombre, email, rol, email_verificado, fecha_creacion 
            FROM usuarios 
            WHERE id = ? AND activo = 1 AND eliminado_en IS NULL
        ");
        $stmt->execute([$id]);
        $user = $stmt->fetch();
        return $user ?: null;
    }

    public function findAnyById(int $id): ?array {
        $stmt = $this->db->prepare("
            SELECT id, nombre, email, rol, activo, email_verificado, fecha_creacion
            FROM usuarios
            WHERE id = ? AND eliminado_en IS NULL
        ");
        $stmt->execute([$id]);
        $user = $stmt->fetch();
        return $user ?: null;
    }

    public function setActive(int $id, bool $activo): bool {
        $stmt = $this->db->prepare("UPDATE usuarios SET activo = ? WHERE id = ? AND eliminado_en IS NULL");
        return $stmt->execute([$activo ? 1 : 0, $id]);
    }

    public function getRecentLogins(int $limit = 15): array {
        $stmt = $this->db->prepare("
            SELECT l.id, l.email, l.ip_address, l.exitoso, l.fecha_intent, u.nombre AS usuario_nombre
            FROM login_logs l
            LEFT JOIN usuarios u ON u.id = l.usuario_id
            ORDER BY l.fecha_intent DESC
            LIMIT " . max(1, min(100, $limit))
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getRecentProfileChanges(int $limit = 15): array {
        $stmt = $this->db->prepare("
            SELECT c.id, c.campo_cambiado, c.valor_anterior, c.valor_nuevo, c.fecha_cambio, u.nombre AS usuario_nombre, u.email
            FROM cambios_perfil c
            LEFT JOIN usuarios u ON u.id = c.usuario_id
            ORDER BY c.fecha_cambio DESC
            LIMIT " . max(1, min(100, $limit))
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Lista todos los usuarios no eliminados (para el panel de administración)
     */
    public function getAll(): array {
        $stmt = $this->db->prepare("
            SELECT id, nombre, email, rol, activo, email_verificado, fecha_creacion
            FROM usuarios
            WHERE eliminado_en IS NULL
            ORDER BY fecha_creacion DESC, id DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function countAll(): int {
        $stmt = $this->db->query("SELECT COUNT(*) FROM usuarios WHERE eliminado_en IS NULL");
        return (int)$stmt->fetchColumn();
    }

    public function countByRole(string $rol): int {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM usuarios WHERE rol = ? AND eliminado_en IS NULL");
        $stmt->execute([$rol]);
        return (int)$stmt->fetchColumn();
    }

    /**
     * Actualiza el rol de un usuario. Solo admite roles válidos del ENUM.
     */
    public function updateRole(int $id, string $rol): bool {
        $permitidos = ['estudiante', 'admin'];
        if (!in_array($rol, $permitidos, true)) {
            return false;
        }

        $stmt = $this->db->prepare("UPDATE usuarios SET rol = ? WHERE id = ? AND eliminado_en IS NULL");
        return $stmt->execute([$rol, $id]);
    }

    public function emailExists(string $email, ?int $excludeId = null): bool {
        if ($excludeId) {
            $stmt = $this->db->prepare("SELECT id FROM usuarios WHERE email = ? AND id != ? AND eliminado_en IS NULL");
            $stmt->execute([$email, $excludeId]);
        } else {
            $stmt = $this->db->prepare("SELECT id FROM usuarios WHERE email = ? AND eliminado_en IS NULL");
            $stmt->execute([$email]);
        }
        return (bool)$stmt->fetch();
    }

    public function create(string $nombre, string $email, string $passwordHash, string $tokenVerificacion): int {
        $this->beginTransaction();
        try {
            $stmt = $this->db->prepare("
                INSERT INTO usuarios (nombre, email, password_hash, token_verificacion) 
                VALUES (?, ?, ?, ?)
            ");
            $stmt->execute([$nombre, $email, $passwordHash, $tokenVerificacion]);
            $userId = (int)$this->lastInsertId();

            // Membresía inicial gratuita: primer mes de prueba del Nivel 1
            $stmt = $this->db->prepare("
                INSERT INTO membresias (usuario_id, activa, tipo_membresia, fecha_vencimiento) 
                VALUES (?, 1, 'gratis', DATE_ADD(NOW(), INTERVAL 1 MONTH))
            ");
            $stmt->execute([$userId]);

            // Registro inicial de puntos y nivel 1
            $stmt = $this->db->prepare("
                INSERT INTO puntos_usuario (usuario_id, puntos_totales, nivel) 
                VALUES (?, 0, 1)
            ");
            $stmt->execute([$userId]);

            $this->commit();
            return $userId;
        } catch (\PDOException $e) {
            $this->rollBack();
            Logger::error('Error al registrar usuario en BD', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    public function updateProfile(int $id, string $nombre, string $email): bool {
        $actual = $this->findById($id);
        $stmt = $this->db->prepare("UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?");
        $ok = $stmt->execute([$nombre, $email, $id]);

        if ($ok && $actual) {
            $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
            if ($actual['nombre'] !== $nombre) {
                $this->logProfileChange($id, 'nombre', $actual['nombre'], $nombre, $ip);
            }
            if ($actual['email'] !== $email) {
                $this->logProfileChange($id, 'email', $actual['email'], $email, $ip);
            }
        }

        return $ok;
    }

    public function updatePassword(int $id, string $newPasswordHash): bool {
        $stmt = $this->db->prepare("UPDATE usuarios SET password_hash = ? WHERE id = ?");
        $ok = $stmt->execute([$newPasswordHash, $id]);

        if ($ok) {
            $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
            $this->logProfileChange($id, 'password', '***', '***', $ip);
        }

        return $ok;
    }

    public function verifyEmail(int $id, string $token): bool {
        $stmt = $this->db->prepare("
            SELECT id FROM usuarios 
            WHERE id = ? AND token_verificacion = ? AND eliminado_en IS NULL
        ");
        $stmt->execute([$id, $token]);
        if (!$stmt->fetch()) {
            return false;
        }

        $stmt = $this->db->prepare("UPDATE usuarios SET email_verificado = 1, token_verificacion = NULL WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function softDelete(int $id, string $ip): bool {
        $stmt = $this->db->prepare("UPDATE usuarios SET activo = 0, eliminado_en = NOW() WHERE id = ?");
        $ok = $stmt->execute([$id]);

        if ($ok) {
            $this->logProfileChange($id, 'cuenta_eliminada', 'activa', 'eliminada', $ip);
        }

        return $ok;
    }

    public function logLoginAttempt(?int $userId, string $email, bool $exitoso): void {
        try {
            $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
            $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';

            $stmt = $this->db->prepare("
                INSERT INTO login_logs (usuario_id, email, ip_address, user_agent, exitoso) 
                VALUES (?, ?, ?, ?, ?)
            ");
            $stmt->execute([$userId, $email, $ip, $userAgent, $exitoso ? 1 : 0]);
        } catch (\Exception $e) {
            // Silencioso para no interrumpir el flujo principal
        }
    }

    public function logProfileChange(int $userId, string $campo, ?string $anterior, ?string $nuevo, string $ip): void {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO cambios_perfil (usuario_id, campo_cambiado, valor_anterior, valor_nuevo, ip_address) 
                VALUES (?, ?, ?, ?, ?)
            ");
            $stmt->execute([$userId, $campo, $anterior, $nuevo, $ip]);
        } catch (\Exception $e) {
            // Silencioso
        }
    }
}
