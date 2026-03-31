<?php

class Router
{
    public function dispatch(string $path): void
    {
        if ($path === '/public' || $path === '/public/' || $path === '/public/index.php') {
            require_once __DIR__ . '/../app/controllers/HomeController.php';
            $controller = new HomeController();
            $controller->index();
            return;
        }

        if ($path === '/public/usuarios' || $path === '/public/usuarios/') {
            require_once __DIR__ . '/../app/controllers/UsuarioController.php';
            $controller = new UsuarioController();
            $controller->index();
            return;
        }
                if ($path === '/public/usuarios/create' || $path === '/public/usuarios/create/') {
            require_once __DIR__ . '/../app/controllers/UsuarioController.php';
            $controller = new UsuarioController();
            $controller->create();
            return;
        }
        if ($path === '/public/usuarios/store' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../app/controllers/UsuarioController.php';
            $controller = new UsuarioController();
            $controller->store();
            return;
        }

        http_response_code(404);
        require __DIR__ . '/../app/views/errors/404.php';
    }
}