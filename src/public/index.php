<?php

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/Router.php';

try {
    Database::connect();

    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    $router = new Router();
    $router->dispatch($path);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}