<h2>Crear nuevo usuario</h2>

<form action="/public/usuarios/store" method="POST">
    <div>
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required>
    </div>

    <br>

    <div>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required>
    </div>

    <br>

    <div>
        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password" required>
    </div>

    <br>

    <div>
        <label for="rol">Rol:</label><br>
        <select id="rol" name="rol" required>
            <option value="particular">Particular</option>
            <option value="tecnico">Técnico</option>
            <option value="admin">Administrador</option>
        </select>
    </div>

    <br>

    <div>
        <label for="telefono">Teléfono:</label><br>
        <input type="text" id="telefono" name="telefono">
    </div>

    <br>

    <button type="submit">Guardar usuario</button>
</form>

<br>

<a href="/public/usuarios">Volver al listado</a>