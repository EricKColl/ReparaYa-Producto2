<h2>Panel de Administración</h2>

<?php if (isset($_GET['ok'])): ?>
    <p class="message-success">
        <?php
        $msgs = [
            'creada' => 'Incidencia creada.',
            'actualizada' => 'Incidencia actualizada.',
            'cancelada' => 'Incidencia cancelada.',
            'asignado' => 'Técnico asignado.'
        ];
        echo htmlspecialchars($msgs[$_GET['ok']] ?? 'Operación completada.');
        ?>
    </p>
<?php endif; ?>

<p>
    <a href="/public/admin/create" class="top-link">+ Nueva incidencia</a>
    <a href="/public/admin/calendario" class="top-link" style="margin-left:10px">📅 Calendario</a>
</p>

<table style="width:100%;border-collapse:collapse;font-size:1rem;">
    <thead>
        <tr style="background:#e0ecff;text-align:left;">
            <th style="padding:10px 12px;">Código</th>
            <th style="padding:10px 12px;">Cliente</th>
            <th style="padding:10px 12px;">Especialidad</th>
            <th style="padding:10px 12px;">Fecha</th>
            <th style="padding:10px 12px;">Urgencia</th>
            <th style="padding:10px 12px;">Estado</th>
            <th style="padding:10px 12px;">Técnico</th>
            <th style="padding:10px 12px;">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($incidencias as $inc): ?>
            <tr style="border-bottom:1px solid #e2e8f0;">
                <td style="padding:10px 12px;font-weight:700;"><?= htmlspecialchars($inc['localizador']) ?></td>
                <td style="padding:10px 12px;"><?= htmlspecialchars($inc['cliente_nombre']) ?></td>
                <td style="padding:10px 12px;"><?= htmlspecialchars($inc['nombre_especialidad']) ?></td>
                <td style="padding:10px 12px;"><?= htmlspecialchars(date('d/m/Y H:i', strtotime($inc['fecha_servicio']))) ?></td>
                <td style="padding:10px 12px;">
                    <?php if ($inc['tipo_urgencia'] === 'Urgente'): ?>
                        <span style="background:#fee2e2;color:#b91c1c;padding:3px 8px;border-radius:8px;font-weight:700;">Urgente</span>
                    <?php else: ?>
                        <span style="background:#dcfce7;color:#166534;padding:3px 8px;border-radius:8px;font-weight:700;">Estándar</span>
                    <?php endif; ?>
                </td>
                <td style="padding:10px 12px;"><?= htmlspecialchars($inc['estado']) ?></td>
                <td style="padding:10px 12px;"><?= htmlspecialchars($inc['tecnico_nombre'] ?? '— Sin asignar') ?></td>
                <td style="padding:10px 12px;">
                    <a href="/public/admin/edit?id=<?= $inc['id'] ?>" class="action-link">Editar</a>
                    <form action="/public/admin/delete" method="POST" class="inline-form"
                        onsubmit="return confirm('¿Cancelar esta incidencia?')">
                        <input type="hidden" name="id" value="<?= $inc['id'] ?>">
                        <button type="submit">Cancelar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (empty($incidencias)): ?>
            <tr>
                <td colspan="8" style="padding:20px;text-align:center;color:#64748b;">No hay incidencias registradas.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>