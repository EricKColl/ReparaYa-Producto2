<?php
$appConfig = require __DIR__ . '/../../../config/app.php';
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
        <hr>
    </header>

    <main>
        <?= $content ?? '' ?>
    </main>
</body>
</html>