<h2>Listado de usuarios</h2>

<p><a href="/public/usuarios/create">Crear nuevo usuario</a></p>

<?php if (empty($usuarios)): ?>
    <p>No hay usuarios registrados.</p>
<?php else: ?>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Teléfono</th>
                <th>Fecha de creación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= htmlspecialchars($usuario['id']) ?></td>
                    <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                    <td><?= htmlspecialchars($usuario['email']) ?></td>
                    <td><?= htmlspecialchars($usuario['rol']) ?></td>
                    <td><?= htmlspecialchars($usuario['telefono'] ?? '') ?></td>
                    <td><?= htmlspecialchars($usuario['created_at']) ?></td>
                    <td>
                        <a href="/public/usuarios/edit?id=<?= urlencode($usuario['id']) ?>">Editar</a>

                        <form action="/public/usuarios/delete" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($usuario['id']) ?>">
                            <button type="submit" onclick="return confirm('¿Seguro que quieres eliminar este usuario?');">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>