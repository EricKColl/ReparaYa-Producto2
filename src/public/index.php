<?php

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../app/controllers/HomeController.php';

try {
    Database::connect();

    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    if ($path === '/public' || $path === '/public/' || $path === '/public/index.php') {
        $controller = new HomeController();
        $controller->index();
    } else {
        require __DIR__ . '/../app/views/errors/404.php';
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}