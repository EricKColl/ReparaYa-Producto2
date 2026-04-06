<a href="/public/admin" class="top-link">← Volver al panel</a>
<h2>Editar Incidencia <small style="font-size:1.2rem;color:#64748b;"><?= htmlspecialchars($incidencia['localizador']) ?></small></h2>

<form action="/public/admin/update" method="POST">
    <input type="hidden" name="id" value="<?= $incidencia['id'] ?>">

    <label>Especialidad</label>
    <select name="especialidad_id">
        <?php foreach ($especialidades as $e): ?>
            <option value="<?= $e['id'] ?>" <?= $e['id'] == $incidencia['especialidad_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($e['nombre_especialidad']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Tipo de urgencia</label>
    <select name="tipo_urgencia">
        <option value="Estandar" <?= $incidencia['tipo_urgencia'] === 'Estandar' ? 'selected' : '' ?>>Estándar</option>
        <option value="Urgente" <?= $incidencia['tipo_urgencia'] === 'Urgente' ? 'selected' : '' ?>>Urgente</option>
    </select>

    <label>Estado</label>
    <select name="estado">
        <?php foreach (['Pendiente', 'Asignada', 'Finalizada', 'Cancelada'] as $s): ?>
            <option value="<?= $s ?>" <?= $incidencia['estado'] === $s ? 'selected' : '' ?>><?= $s ?></option>
        <?php endforeach; ?>
    </select>

    <label>Fecha y hora</label>
    <input
        type="datetime-local"
        name="fecha_servicio"
        value="<?= date('Y-m-d\TH:i', strtotime($incidencia['fecha_servicio'])) ?>"
        required
    >

    <label>Dirección</label>
    <input
        type="text"
        name="direccion"
        value="<?= htmlspecialchars($incidencia['direccion']) ?>"
        required
    >

    <label>Teléfono de contacto</label>
    <input
        type="text"
        name="telefono_contacto"
        value="<?= htmlspecialchars($incidencia['telefono_contacto']) ?>"
        required
    >

    <label>Descripción</label>
    <textarea name="descripcion" rows="4"><?= htmlspecialchars($incidencia['descripcion']) ?></textarea>

    <button type="submit">Guardar cambios</button>
</form>