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

            // Membresía inicial gratuita
            $stmt = $this->db->prepare("
                INSERT INTO membresias (usuario_id, activa, tipo_membresia) 
                VALUES (?, 1, 'gratis')
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
                INSERT INTO login_logs (usuario_id, email_ingresado, ip_address, user_agent, exitoso) 
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
