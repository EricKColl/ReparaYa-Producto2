<h2>Listado de especialidades</h2>

<?php if (empty($especialidades)): ?>
    <p>No hay especialidades registradas.</p>
<?php else: ?>
    <ul>
        <?php foreach ($especialidades as $especialidad): ?>
            <li>
                <?= htmlspecialchars($especialidad['nombre_especialidad']) ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>