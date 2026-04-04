<?php

require_once __DIR__ . '/../../core/Model.php';

class Incidencia extends Model
{
    // Devuelve todas las incidencias con datos del cliente y técnico
    public function getAll(): array
    {
        $stmt = $this->db->query("
            SELECT 
                i.id,
                i.localizador,
                i.tecnico_id,
                i.descripcion,
                i.direccion,
                i.fecha_servicio,
                i.tipo_urgencia,
                i.estado,
                i.created_at,
                u.nombre AS cliente_nombre,
                t.nombre_completo AS tecnico_nombre,
                e.nombre_especialidad
            FROM incidencias i
            JOIN usuarios u ON i.cliente_id = u.id
            LEFT JOIN tecnicos t ON i.tecnico_id = t.id
            LEFT JOIN especialidades e ON i.especialidad_id = e.id
            ORDER BY i.fecha_servicio ASC
        ");
        return $stmt->fetchAll();
    }

    public function getById(int $id): array|false
    {
        $stmt = $this->db->prepare("
            SELECT i.*, u.nombre AS cliente_nombre
            FROM incidencias i
            JOIN usuarios u ON i.cliente_id = u.id
            WHERE i.id = :id
        ");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    // Genera un código único tipo INC-XXXXXX
    private function generarLocalizador(): string
    {
        return 'INC-' . strtoupper(substr(uniqid(), -6));
    }

    public function create(array $datos): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO incidencias 
                (localizador, cliente_id, especialidad_id, descripcion, direccion, fecha_servicio, tipo_urgencia, estado)
            VALUES 
                (:localizador, :cliente_id, :especialidad_id, :descripcion, :direccion, :fecha_servicio, :tipo_urgencia, 'Pendiente')
        ");
        return $stmt->execute([
            'localizador'    => $this->generarLocalizador(),
            'cliente_id'     => $datos['cliente_id'],
            'especialidad_id' => $datos['especialidad_id'],
            'descripcion'    => $datos['descripcion'],
            'direccion'      => $datos['direccion'],
            'fecha_servicio' => $datos['fecha_servicio'],
            'tipo_urgencia'  => $datos['tipo_urgencia'],
        ]);
    }

    public function update(int $id, array $datos): bool
    {
        $stmt = $this->db->prepare("
            UPDATE incidencias SET
                especialidad_id = :especialidad_id,
                descripcion     = :descripcion,
                direccion       = :direccion,
                fecha_servicio  = :fecha_servicio,
                tipo_urgencia   = :tipo_urgencia,
                estado          = :estado
            WHERE id = :id
        ");
        return $stmt->execute([
            'id'             => $id,
            'especialidad_id' => $datos['especialidad_id'],
            'descripcion'    => $datos['descripcion'],
            'direccion'      => $datos['direccion'],
            'fecha_servicio' => $datos['fecha_servicio'],
            'tipo_urgencia'  => $datos['tipo_urgencia'],
            'estado'         => $datos['estado'],
        ]);
    }

    public function asignarTecnico(int $id, int $tecnicoId): bool
    {
        $stmt = $this->db->prepare("
            UPDATE incidencias 
            SET tecnico_id = :tecnico_id, estado = 'Asignada'
            WHERE id = :id
        ");
        return $stmt->execute(['id' => $id, 'tecnico_id' => $tecnicoId]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("
            UPDATE incidencias SET estado = 'Cancelada' WHERE id = :id
        ");
        return $stmt->execute(['id' => $id]);
    }
}
