<?php

$appConfig = require __DIR__ . '/../../../config/app.php';

$usuarioSesion = $_SESSION['usuario'] ?? null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? $appConfig['name'] ?></title>
</head>
<body>
    <header>
        <h1><?= $appConfig['name'] ?></h1>

        <nav style="margin-bottom: 15px;">
            <a href="/public">Inicio</a>

            <?php if ($usuarioSesion): ?>
                | <a href="/public/perfil">Mi perfil</a>

                <?php if (($usuarioSesion['rol'] ?? '') === 'admin'): ?>
                    | <a href="/public/usuarios">Usuarios</a>
                    | <a href="/public/tecnicos">Técnicos</a>
                    | <a href="/public/especialidades">Especialidades</a>
                <?php endif; ?>

                | <span>Hola, <?= htmlspecialchars($usuarioSesion['nombre']) ?> (<?= htmlspecialchars($usuarioSesion['rol']) ?>)</span>
                | <a href="/public/logout">Cerrar sesión</a>
            <?php else: ?>
                | <a href="/public/login">Iniciar sesión</a>
                | <a href="/public/register">Registrarse</a>
            <?php endif; ?>
        </nav>

        <hr>
    </header>

    <main>
        <?= $content ?? '' ?>
    </main>
</body>
</html>