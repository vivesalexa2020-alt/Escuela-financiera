<?php
namespace App\Core;

use PDO;
use App\Config\Database;

abstract class Model {
    protected PDO $db;

    public function __construct(?PDO $db = null) {
        $this->db = $db ?? Database::getConnection();
    }

    public function beginTransaction(): bool {
        return $this->db->beginTransaction();
    }

    public function commit(): bool {
        return $this->db->commit();
    }

    public function rollBack(): bool {
        return $this->db->rollBack();
    }

    public function lastInsertId(): string {
        return $this->db->lastInsertId();
    }
}
