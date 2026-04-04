<a href="/public/admin" class="top-link">← Volver al panel</a>
<h2>Nueva Incidencia</h2>

<?php if (isset($error)): ?>
    <p class="message-error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form action="/public/admin/store" method="POST">
    <label>Cliente</label>
    <select name="cliente_id" required>
        <option value="">— Selecciona cliente —</option>
        <?php foreach ($clientes as $c): ?>
            <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['nombre'] . ' (' . $c['email'] . ')') ?></option>
        <?php endforeach; ?>
    </select>

    <label>Especialidad / Tipo de servicio</label>
    <select name="especialidad_id" required>
        <option value="">— Selecciona especialidad —</option>
        <?php foreach ($especialidades as $e): ?>
            <option value="<?= $e['id'] ?>"><?= htmlspecialchars($e['nombre_especialidad']) ?></option>
        <?php endforeach; ?>
    </select>

    <label>Tipo de urgencia</label>
    <select name="tipo_urgencia">
        <option value="Estándar">Estándar (plazo normal)</option>
        <option value="Urgente">Urgente (24h)</option>
    </select>

    <label>Fecha y hora del servicio</label>
    <input type="datetime-local" name="fecha_servicio" required>

    <label>Dirección</label>
    <input type="text" name="direccion" placeholder="Calle, número, ciudad" required>

    <label>Descripción de la avería</label>
    <textarea name="descripcion" rows="4" required placeholder="Describe el problema..."></textarea>

    <br>
    <button type="submit">Crear incidencia</button>
</form>