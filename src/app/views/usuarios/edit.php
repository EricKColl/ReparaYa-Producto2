<h2>Editar usuario</h2>

<form action="/public/usuarios/update" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($usuario['id']) ?>">

    <div>
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>
    </div>

    <br>

    <div>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>
    </div>

    <br>

    <div>
        <label for="password">Contraseña:</label><br>
        <input type="text" id="password" name="password" value="<?= htmlspecialchars($usuario['password']) ?>" required>
    </div>

    <br>

    <div>
        <label for="rol">Rol:</label><br>
        <select id="rol" name="rol" required>
            <option value="particular" <?= $usuario['rol'] === 'particular' ? 'selected' : '' ?>>Particular</option>
            <option value="tecnico" <?= $usuario['rol'] === 'tecnico' ? 'selected' : '' ?>>Técnico</option>
            <option value="admin" <?= $usuario['rol'] === 'admin' ? 'selected' : '' ?>>Administrador</option>
        </select>
    </div>

    <br>

    <div>
        <label for="telefono">Teléfono:</label><br>
        <input type="text" id="telefono" name="telefono" value="<?= htmlspecialchars($usuario['telefono'] ?? '') ?>">
    </div>

    <br>

    <button type="submit">Actualizar usuario</button>
</form>

<br>

<a href="/public/usuarios">Volver al listado</a>