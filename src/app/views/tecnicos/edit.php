<h2>Editar técnico</h2>

<?php if (!empty($error)): ?>
    <p><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form action="/public/tecnicos/update" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($tecnico['id']) ?>">

    <div>
        <label for="nombre_completo">Nombre completo:</label>
        <input
            type="text"
            id="nombre_completo"
            name="nombre_completo"
            value="<?= htmlspecialchars($tecnico['nombre_completo']) ?>"
        >
    </div>

    <br>

    <div>
        <label for="especialidad_id">Especialidad:</label>
        <select id="especialidad_id" name="especialidad_id">
            <option value="">Selecciona una especialidad</option>
            <?php foreach ($especialidades as $especialidad): ?>
                <option
                    value="<?= htmlspecialchars($especialidad['id']) ?>"
                    <?= (int) $tecnico['especialidad_id'] === (int) $especialidad['id'] ? 'selected' : '' ?>
                >
                    <?= htmlspecialchars($especialidad['nombre_especialidad']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <br>

    <div>
        <label>
            <input
                type="checkbox"
                name="disponible"
                value="1"
                <?= !empty($tecnico['disponible']) ? 'checked' : '' ?>
            >
            Disponible
        </label>
    </div>

    <br>

    <button type="submit">Actualizar</button>
</form>

<br>

<a href="/public/tecnicos">Volver al listado</a>