<h2>Listado de especialidades</h2>

<a href="/public/especialidades/create">Nueva especialidad</a>

<br><br>

<?php if (empty($especialidades)): ?>
    <p>No hay especialidades registradas.</p>
<?php else: ?>
    <ul>
        <?php foreach ($especialidades as $especialidad): ?>
            <li>
                <?= htmlspecialchars($especialidad['nombre_especialidad']) ?>
                - <a href="/public/especialidades/edit?id=<?= htmlspecialchars($especialidad['id']) ?>">Editar</a>
                - <a href="/public/especialidades/delete?id=<?= htmlspecialchars($especialidad['id']) ?>">Eliminar</a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
