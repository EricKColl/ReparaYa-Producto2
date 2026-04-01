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

        if ($path === '/public/especialidades') {
            require_once __DIR__ . '/../app/controllers/EspecialidadController.php';
            $controller = new EspecialidadController();
            $controller->index();
            return;
        }

        if ($path === '/public/especialidades/create') {
            require_once __DIR__ . '/../app/controllers/EspecialidadController.php';
            $controller = new EspecialidadController();
            $controller->create();
            return;
        }

        if ($path === '/public/especialidades/store') {
            require_once __DIR__ . '/../app/controllers/EspecialidadController.php';
            $controller = new EspecialidadController();
            $controller->store();
            return;
        }

        if ($path === '/public/especialidades/edit') {
            require_once __DIR__ . '/../app/controllers/EspecialidadController.php';
            $controller = new EspecialidadController();
            $controller->edit();
            return;
        }

        if ($path === '/public/especialidades/update') {
            require_once __DIR__ . '/../app/controllers/EspecialidadController.php';
            $controller = new EspecialidadController();
            $controller->update();
            return;
        }
        if ($path === '/public/especialidades/delete') {
        require_once __DIR__ . '/../app/controllers/EspecialidadController.php';
        $controller = new EspecialidadController();
        $controller->delete();
        return;
        }

        http_response_code(404);
        require __DIR__ . '/../app/views/errors/404.php';
    }
}