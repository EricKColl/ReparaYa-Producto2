<h2>Crear técnico</h2>

<?php if (!empty($error)): ?>
    <p><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form action="/public/tecnicos/store" method="POST">
    <div>
        <label for="nombre_completo">Nombre completo:</label>
        <input type="text" id="nombre_completo" name="nombre_completo">
    </div>

    <br>

    <div>
        <label for="especialidad_id">Especialidad:</label>
        <select id="especialidad_id" name="especialidad_id">
            <option value="">Selecciona una especialidad</option>
            <?php foreach ($especialidades as $especialidad): ?>
                <option value="<?= htmlspecialchars($especialidad['id']) ?>">
                    <?= htmlspecialchars($especialidad['nombre_especialidad']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <br>

    <div>
        <label>
            <input type="checkbox" name="disponible" value="1">
            Disponible
        </label>
    </div>

    <br>

    <button type="submit">Guardar</button>
</form>

<br>

<a href="/public/tecnicos">Volver al listado</a>