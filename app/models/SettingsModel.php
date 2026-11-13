<?php
namespace App\Models;

use App\Core\Model;

class SettingsModel extends Model {
    private const DEFAULTS = [
        'nombre_plataforma'      => 'Educación Financiera',
        'correo_soporte'         => 'soporte@educacionfinanciera.edu',
        'moneda'                 => 'MXN',
        'zona_horaria'           => 'America/Mexico_City',
        'permitir_registro'      => '1',
        'login_max_intentos'     => '5',
        'login_ventana_minutos'  => '15',
        'modo_mantenimiento'     => '0',
        'mensaje_mantenimiento'  => 'Estamos realizando mejoras en la plataforma. Vuelve en unos minutos.',
    ];

    public function getAll(): array {
        $settings = self::DEFAULTS;

        try {
            $stmt = $this->db->query("SELECT clave, valor FROM configuraciones");
            foreach ($stmt->fetchAll() as $row) {
                if (array_key_exists($row['clave'], $settings)) {
                    $settings[$row['clave']] = (string)$row['valor'];
                }
            }
        } catch (\Throwable $e) {
            // Si la tabla aún no existe, se usan los valores predeterminados.
        }

        return $settings;
    }

    public function get(string $key, mixed $default = null): mixed {
        $settings = $this->getAll();
        return $settings[$key] ?? $default;
    }

    public function isEnabled(string $key): bool {
        return (string)$this->get($key, '0') === '1';
    }

    public function setMany(array $values): bool {
        if (empty($values)) {
            return false;
        }

        try {
            $this->beginTransaction();

            $stmt = $this->db->prepare("
                INSERT INTO configuraciones (clave, valor, fecha_actualizacion)
                VALUES (?, ?, NOW())
                ON DUPLICATE KEY UPDATE valor = VALUES(valor), fecha_actualizacion = NOW()
            ");

            foreach ($values as $key => $value) {
                if (!array_key_exists($key, self::DEFAULTS)) {
                    continue;
                }
                $stmt->execute([$key, (string)$value]);
            }

            $this->commit();
            return true;
        } catch (\Throwable $e) {
            $this->rollBack();
            return false;
        }
    }
}
