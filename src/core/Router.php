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

        if ($path === '/public/login' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            require_once __DIR__ . '/../app/controllers/UsuarioController.php';
            $controller = new UsuarioController();
            $controller->loginForm();
            return;
        }

        if ($path === '/public/login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../app/controllers/UsuarioController.php';
            $controller = new UsuarioController();
            $controller->login();
            return;
        }

        if ($path === '/public/register' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            require_once __DIR__ . '/../app/controllers/UsuarioController.php';
            $controller = new UsuarioController();
            $controller->registerForm();
            return;
        }

        if ($path === '/public/register' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../app/controllers/UsuarioController.php';
            $controller = new UsuarioController();
            $controller->register();
            return;
        }

        if ($path === '/public/logout' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            require_once __DIR__ . '/../app/controllers/UsuarioController.php';
            $controller = new UsuarioController();
            $controller->logout();
            return;
        }

        if ($path === '/public/perfil' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            require_once __DIR__ . '/../app/controllers/UsuarioController.php';
            $controller = new UsuarioController();
            $controller->profile();
            return;
        }

        if ($path === '/public/perfil/update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../app/controllers/UsuarioController.php';
            $controller = new UsuarioController();
            $controller->updateProfile();
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

        if ($path === '/public/usuarios/edit' || $path === '/public/usuarios/edit/') {
            require_once __DIR__ . '/../app/controllers/UsuarioController.php';
            $controller = new UsuarioController();
            $controller->edit();
            return;
        }

        if ($path === '/public/usuarios/update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../app/controllers/UsuarioController.php';
            $controller = new UsuarioController();
            $controller->update();
            return;
        }

        if ($path === '/public/usuarios/delete' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../app/controllers/UsuarioController.php';
            $controller = new UsuarioController();
            $controller->delete();
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

        if ($path === '/public/especialidades/store' && $_SERVER['REQUEST_METHOD'] === 'POST') {
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

        if ($path === '/public/especialidades/update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../app/controllers/EspecialidadController.php';
            $controller = new EspecialidadController();
            $controller->update();
            return;
        }

        if ($path === '/public/especialidades/delete' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../app/controllers/EspecialidadController.php';
            $controller = new EspecialidadController();
            $controller->delete();
            return;
        }

        if ($path === '/public/tecnicos') {
            require_once __DIR__ . '/../app/controllers/TecnicoController.php';
            $controller = new TecnicoController();
            $controller->index();
            return;
        }

        if ($path === '/public/tecnicos/create') {
            require_once __DIR__ . '/../app/controllers/TecnicoController.php';
            $controller = new TecnicoController();
            $controller->create();
            return;
        }

        if ($path === '/public/tecnicos/store' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../app/controllers/TecnicoController.php';
            $controller = new TecnicoController();
            $controller->store();
            return;
        }

        if ($path === '/public/tecnicos/edit') {
            require_once __DIR__ . '/../app/controllers/TecnicoController.php';
            $controller = new TecnicoController();
            $controller->edit();
            return;
        }

        if ($path === '/public/tecnicos/update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../app/controllers/TecnicoController.php';
            $controller = new TecnicoController();
            $controller->update();
            return;
        }

        if ($path === '/public/tecnicos/delete' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../app/controllers/TecnicoController.php';
            $controller = new TecnicoController();
            $controller->delete();
            return;
        }

        http_response_code(404);
        require __DIR__ . '/../app/views/errors/404.php';
    }
}