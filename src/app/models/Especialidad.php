<?php

require_once __DIR__ . '/../../core/Model.php';

class Especialidad extends Model
{
    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM especialidades ORDER BY id ASC");
        return $stmt->fetchAll();
    }
}