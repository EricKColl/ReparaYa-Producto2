<h2>Listado de especialidades</h2>

<?php if (isset($_GET['ok']) && $_GET['ok'] === 'creada'): ?>
    <p style="color: green;">Especialidad creada correctamente.</p>
<?php endif; ?>

<?php if (isset($_GET['ok']) && $_GET['ok'] === 'actualizada'): ?>
    <p style="color: green;">Especialidad actualizada correctamente.</p>
<?php endif; ?>

<?php if (isset($_GET['ok']) && $_GET['ok'] === 'eliminada'): ?>
    <p style="color: green;">Especialidad eliminada correctamente.</p>
<?php endif; ?>

<?php if (isset($_GET['error']) && $_GET['error'] === 'en_uso'): ?>
    <p style="color: red;">No se puede eliminar la especialidad porque está asignada a uno o más técnicos.</p>
<?php endif; ?>

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

                <form action="/public/especialidades/delete" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($especialidad['id']) ?>">
                    <button type="submit" onclick="return confirm('¿Seguro que quieres eliminar esta especialidad?');">
                        Eliminar
                    </button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>