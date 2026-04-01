<?php

require_once __DIR__ . '/../../core/Model.php';

class Tecnico extends Model
{
    public function getAll(): array
    {
        $stmt = $this->db->query("
            SELECT 
                t.id,
                t.nombre_completo,
                t.disponible,
                e.nombre_especialidad
            FROM tecnicos t
            LEFT JOIN especialidades e ON t.especialidad_id = e.id
            ORDER BY t.id ASC
        ");

        return $stmt->fetchAll();
    }

    public function getById(int $id): array|false
    {
        $stmt = $this->db->prepare("
            SELECT id, nombre_completo, especialidad_id, disponible
            FROM tecnicos
            WHERE id = :id
        ");

        $stmt->execute([
            'id' => $id
        ]);

        return $stmt->fetch();
    }

    public function create(string $nombreCompleto, int $especialidadId, int $disponible): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO tecnicos (nombre_completo, especialidad_id, disponible)
            VALUES (:nombre_completo, :especialidad_id, :disponible)
        ");

        return $stmt->execute([
            'nombre_completo' => $nombreCompleto,
            'especialidad_id' => $especialidadId,
            'disponible' => $disponible
        ]);
    }

    public function update(int $id, string $nombreCompleto, int $especialidadId, int $disponible): bool
    {
        $stmt = $this->db->prepare("
            UPDATE tecnicos
            SET nombre_completo = :nombre_completo,
                especialidad_id = :especialidad_id,
                disponible = :disponible
            WHERE id = :id
        ");

        return $stmt->execute([
            'id' => $id,
            'nombre_completo' => $nombreCompleto,
            'especialidad_id' => $especialidadId,
            'disponible' => $disponible
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("
            DELETE FROM tecnicos
            WHERE id = :id
        ");

        return $stmt->execute([
            'id' => $id
        ]);
    }

    public function getDisponibles(): array
    {
        $stmt = $this->db->query("
            SELECT 
                t.id,
                t.nombre_completo,
                t.especialidad_id,
                t.disponible,
                e.nombre_especialidad
            FROM tecnicos t
            LEFT JOIN especialidades e ON t.especialidad_id = e.id
            WHERE t.disponible = 1
            ORDER BY t.nombre_completo ASC
        ");

        return $stmt->fetchAll();
    }

    public function getDisponiblesByEspecialidad(int $especialidadId): array
    {
        $stmt = $this->db->prepare("
            SELECT 
                t.id,
                t.nombre_completo,
                t.especialidad_id,
                t.disponible,
                e.nombre_especialidad
            FROM tecnicos t
            LEFT JOIN especialidades e ON t.especialidad_id = e.id
            WHERE t.disponible = 1
              AND t.especialidad_id = :especialidad_id
            ORDER BY t.nombre_completo ASC
        ");

        $stmt->execute([
            'especialidad_id' => $especialidadId
        ]);

        return $stmt->fetchAll();
    }
}