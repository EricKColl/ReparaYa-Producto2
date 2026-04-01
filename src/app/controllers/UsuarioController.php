<?php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController extends Controller
{
    private function requireLogin(): void
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: /public/login');
            exit;
        }
    }

    private function redirectIfLoggedIn(): void
    {
        if (isset($_SESSION['usuario'])) {
            header('Location: /public');
            exit;
        }
    }

    public function index(): void
    {
        $this->requireLogin();

        $usuarioModel = new Usuario();
        $usuarios = $usuarioModel->getAll();

        $this->render('usuarios/index', [
            'title' => 'Listado de usuarios - ReparaYa',
            'usuarios' => $usuarios
        ]);
    }

    public function create(): void
    {
        $this->requireLogin();

        $this->render('usuarios/create', [
            'title' => 'Crear usuario - ReparaYa'
        ]);
    }

    public function store(): void
    {
        $this->requireLogin();

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

        if ($data['nombre'] === '' || $data['email'] === '' || $data['password'] === '') {
            header('Location: /public/usuarios/create?error=campos_vacios');
            exit;
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            header('Location: /public/usuarios/create?error=email_invalido');
            exit;
        }

        $emailExistente = $usuarioModel->getByEmail($data['email']);

        if ($emailExistente) {
            header('Location: /public/usuarios/create?error=email_duplicado');
            exit;
        }

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        $usuarioModel->create($data);

        header('Location: /public/usuarios');
        exit;
    }

    public function edit(): void
    {
        $this->requireLogin();

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
        $this->requireLogin();

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
        $usuarioActual = $usuarioModel->getById($id);

        if (!$usuarioActual) {
            header('Location: /public/usuarios');
            exit;
        }

        $data = [
            'nombre' => trim($_POST['nombre'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'password' => trim($_POST['password'] ?? ''),
            'rol' => $_POST['rol'] ?? 'particular',
            'telefono' => trim($_POST['telefono'] ?? '')
        ];

        if ($data['nombre'] === '' || $data['email'] === '') {
            header('Location: /public/usuarios/edit?id=' . $id . '&error=campos_vacios');
            exit;
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            header('Location: /public/usuarios/edit?id=' . $id . '&error=email_invalido');
            exit;
        }

        $emailExistente = $usuarioModel->getByEmailExcludingId($data['email'], $id);

        if ($emailExistente) {
            header('Location: /public/usuarios/edit?id=' . $id . '&error=email_duplicado');
            exit;
        }

        if ($data['password'] === '') {
            $data['password'] = $usuarioActual['password'];
        } else {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        $usuarioModel->update($id, $data);

        header('Location: /public/usuarios');
        exit;
    }

    public function delete(): void
    {
        $this->requireLogin();

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
        $usuarioModel->delete($id);

        header('Location: /public/usuarios');
        exit;
    }

    public function loginForm(): void
    {
        $this->redirectIfLoggedIn();

        $this->render('auth/login', [
            'title' => 'Iniciar sesión - ReparaYa'
        ]);
    }

    public function login(): void
    {
        $this->redirectIfLoggedIn();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /public/login');
            exit;
        }

        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if ($email === '' || $password === '') {
            header('Location: /public/login?error=campos_vacios');
            exit;
        }

        $usuarioModel = new Usuario();
        $usuario = $usuarioModel->getByEmail($email);

        if (!$usuario || !password_verify($password, $usuario['password'])) {
            header('Location: /public/login?error=credenciales_invalidas');
            exit;
        }

        $_SESSION['usuario'] = [
            'id' => $usuario['id'],
            'nombre' => $usuario['nombre'],
            'email' => $usuario['email'],
            'rol' => $usuario['rol']
        ];

        header('Location: /public');
        exit;
    }

    public function logout(): void
    {
        unset($_SESSION['usuario']);
        session_destroy();

        header('Location: /public/login');
        exit;
    }

    public function profile(): void
    {
        $this->requireLogin();

        $usuarioModel = new Usuario();
        $usuario = $usuarioModel->getById((int) $_SESSION['usuario']['id']);

        if (!$usuario) {
            header('Location: /public/logout');
            exit;
        }

        $this->render('usuarios/profile', [
            'title' => 'Mi perfil - ReparaYa',
            'usuario' => $usuario
        ]);
    }

    public function updateProfile(): void
    {
        $this->requireLogin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /public/perfil');
            exit;
        }

        $id = (int) $_SESSION['usuario']['id'];

        $usuarioModel = new Usuario();
        $usuarioActual = $usuarioModel->getById($id);

        if (!$usuarioActual) {
            header('Location: /public/logout');
            exit;
        }

        $data = [
            'nombre' => trim($_POST['nombre'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'password' => trim($_POST['password'] ?? ''),
            'rol' => $usuarioActual['rol'],
            'telefono' => trim($_POST['telefono'] ?? '')
        ];

        if ($data['nombre'] === '' || $data['email'] === '') {
            header('Location: /public/perfil?error=campos_vacios');
            exit;
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            header('Location: /public/perfil?error=email_invalido');
            exit;
        }

        $emailExistente = $usuarioModel->getByEmailExcludingId($data['email'], $id);

        if ($emailExistente) {
            header('Location: /public/perfil?error=email_duplicado');
            exit;
        }

        if ($data['password'] === '') {
            $data['password'] = $usuarioActual['password'];
        } else {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        $usuarioModel->update($id, $data);

        $_SESSION['usuario']['nombre'] = $data['nombre'];
        $_SESSION['usuario']['email'] = $data['email'];

        header('Location: /public/perfil?ok=perfil_actualizado');
        exit;
    }
}