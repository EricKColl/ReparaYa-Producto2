<?php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController extends Controller
{
    public function index(): void
    {
        $usuarioModel = new Usuario();
        $usuarios = $usuarioModel->getAll();

        $this->render('usuarios/index', [
            'title' => 'Listado de usuarios - ReparaYa',
            'usuarios' => $usuarios
        ]);
    }
}