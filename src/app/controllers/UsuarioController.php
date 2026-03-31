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

    public function create(): void
    {
        $this->render('usuarios/create', [
            'title' => 'Crear usuario - ReparaYa'
        ]);
    }

    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /public/usuarios');
            exit;
        }

        $usuarioModel = new Usuario();

        $data = [
            'nombre' => trim($_POST['nombre'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'password' => trim($_POST['password'] ?? ''),
            'rol' => $_POST['rol'] ?? 'particular',
            'telefono' => trim($_POST['telefono'] ?? '')
        ];

        $usuarioModel->create($data);

        header('Location: /public/usuarios');
        exit;
    }

    public function edit(): void
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

        if ($id <= 0) {
            header('Location: /public/usuarios');
            exit;
        }

        $usuarioModel = new Usuario();
        $usuario = $usuarioModel->getById($id);

        if (!$usuario) {
            header('Location: /public/usuarios');
            exit;
        }

        $this->render('usuarios/edit', [
            'title' => 'Editar usuario - ReparaYa',
            'usuario' => $usuario
        ]);
    }

    public function update(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /public/usuarios');
            exit;
        }

        $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

        if ($id <= 0) {
            header('Location: /public/usuarios');
            exit;
        }

        $usuarioModel = new Usuario();

        $data = [
            'nombre' => trim($_POST['nombre'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'password' => trim($_POST['password'] ?? ''),
            'rol' => $_POST['rol'] ?? 'particular',
            'telefono' => trim($_POST['telefono'] ?? '')
        ];

        $usuarioModel->update($id, $data);

        header('Location: /public/usuarios');
        exit;
    }
}