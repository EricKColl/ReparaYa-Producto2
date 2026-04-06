<?php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../models/Especialidad.php';

class EspecialidadController extends Controller
{
    public function index(): void
    {
        $this->requireAdmin();

        $especialidadModel = new Especialidad();
        $especialidades = $especialidadModel->getAll();

        $this->render('especialidades/index', [
            'title' => 'Listado de especialidades - ReparaYa',
            'especialidades' => $especialidades
        ]);
    }

    public function create(): void
    {
        $this->requireAdmin();

        $this->render('especialidades/create', [
            'title' => 'Crear especialidad - ReparaYa'
        ]);
    }

    public function store(): void
    {
        $this->requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /public/especialidades');
            exit;
        }

        $nombreEspecialidad = trim($_POST['nombre_especialidad'] ?? '');

        if ($nombreEspecialidad === '') {
            $this->render('especialidades/create', [
                'title' => 'Crear especialidad - ReparaYa',
                'error' => 'El nombre de la especialidad es obligatorio.'
            ]);
            return;
        }

        $especialidadModel = new Especialidad();
        $especialidadModel->create($nombreEspecialidad);

        header('Location: /public/especialidades?ok=creada');
        exit;
    }

    public function edit(): void
    {
        $this->requireAdmin();

        $id = (int) ($_GET['id'] ?? 0);

        if ($id <= 0) {
            header('Location: /public/especialidades');
            exit;
        }

        $especialidadModel = new Especialidad();
        $especialidad = $especialidadModel->getById($id);

        if (!$especialidad) {
            header('Location: /public/especialidades');
            exit;
        }

        $this->render('especialidades/edit', [
            'title' => 'Editar especialidad - ReparaYa',
            'especialidad' => $especialidad
        ]);
    }

    public function update(): void
    {
        $this->requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /public/especialidades');
            exit;
        }

        $id = (int) ($_POST['id'] ?? 0);
        $nombreEspecialidad = trim($_POST['nombre_especialidad'] ?? '');

        if ($id <= 0) {
            header('Location: /public/especialidades');
            exit;
        }

        if ($nombreEspecialidad === '') {
            $especialidadModel = new Especialidad();
            $especialidad = $especialidadModel->getById($id);

            $this->render('especialidades/edit', [
                'title' => 'Editar especialidad - ReparaYa',
                'error' => 'El nombre de la especialidad es obligatorio.',
                'especialidad' => $especialidad
            ]);
            return;
        }

        $especialidadModel = new Especialidad();
        $especialidadModel->update($id, $nombreEspecialidad);

        header('Location: /public/especialidades?ok=actualizada');
        exit;
    }

    public function delete(): void
    {
        $this->requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /public/especialidades');
            exit;
        }

        $id = (int) ($_POST['id'] ?? 0);

        if ($id <= 0) {
            header('Location: /public/especialidades');
            exit;
        }

        $especialidadModel = new Especialidad();

        try {
            $especialidadModel->delete($id);
            header('Location: /public/especialidades?ok=eliminada');
            exit;
        } catch (PDOException $e) {
            header('Location: /public/especialidades?error=en_uso');
            exit;
        }
    }
}