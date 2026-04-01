<h2>Listado de técnicos</h2>

<a href="/public/tecnicos/create">Nuevo técnico</a>

<br><br>

<?php if (empty($tecnicos)): ?>
    <p>No hay técnicos registrados.</p>
<?php else: ?>
    <ul>
        <?php foreach ($tecnicos as $tecnico): ?>
            <li>
                <?= htmlspecialchars($tecnico['nombre_completo']) ?> -
                <?= htmlspecialchars($tecnico['nombre_especialidad'] ?? 'Sin especialidad') ?> -
                <?= $tecnico['disponible'] ? 'Disponible' : 'No disponible' ?>
                - <a href="/public/tecnicos/edit?id=<?= htmlspecialchars($tecnico['id']) ?>">Editar</a>
                - <a href="/public/tecnicos/delete?id=<?= htmlspecialchars($tecnico['id']) ?>">Eliminar</a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>