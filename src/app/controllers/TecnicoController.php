<?php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../models/Tecnico.php';
require_once __DIR__ . '/../models/Especialidad.php';

class TecnicoController extends Controller
{
    public function index(): void
    {
        $tecnicoModel = new Tecnico();
        $tecnicos = $tecnicoModel->getAll();

        $this->render('tecnicos/index', [
            'title' => 'Listado de técnicos - ReparaYa',
            'tecnicos' => $tecnicos
        ]);
    }

    public function create(): void
    {
        $especialidadModel = new Especialidad();
        $especialidades = $especialidadModel->getAll();

        $this->render('tecnicos/create', [
            'title' => 'Crear técnico - ReparaYa',
            'especialidades' => $especialidades
        ]);
    }

    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /public/tecnicos');
            exit;
        }

        $nombreCompleto = trim($_POST['nombre_completo'] ?? '');
        $especialidadId = (int) ($_POST['especialidad_id'] ?? 0);
        $disponible = isset($_POST['disponible']) ? 1 : 0;

        if ($nombreCompleto === '' || $especialidadId <= 0) {
            $especialidadModel = new Especialidad();
            $especialidades = $especialidadModel->getAll();

            $this->render('tecnicos/create', [
                'title' => 'Crear técnico - ReparaYa',
                'error' => 'El nombre y la especialidad son obligatorios.',
                'especialidades' => $especialidades
            ]);
            return;
        }

        $tecnicoModel = new Tecnico();
        $tecnicoModel->create($nombreCompleto, $especialidadId, $disponible);

        header('Location: /public/tecnicos');
        exit;
    }

    public function edit(): void
    {
        $id = (int) ($_GET['id'] ?? 0);

        if ($id <= 0) {
            header('Location: /public/tecnicos');
            exit;
        }

        $tecnicoModel = new Tecnico();
        $tecnico = $tecnicoModel->getById($id);

        if (!$tecnico) {
            header('Location: /public/tecnicos');
            exit;
        }

        $especialidadModel = new Especialidad();
        $especialidades = $especialidadModel->getAll();

        $this->render('tecnicos/edit', [
            'title' => 'Editar técnico - ReparaYa',
            'tecnico' => $tecnico,
            'especialidades' => $especialidades
        ]);
    }

    public function update(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /public/tecnicos');
            exit;
        }

        $id = (int) ($_POST['id'] ?? 0);
        $nombreCompleto = trim($_POST['nombre_completo'] ?? '');
        $especialidadId = (int) ($_POST['especialidad_id'] ?? 0);
        $disponible = isset($_POST['disponible']) ? 1 : 0;

        if ($id <= 0) {
            header('Location: /public/tecnicos');
            exit;
        }

        if ($nombreCompleto === '' || $especialidadId <= 0) {
            $tecnicoModel = new Tecnico();
            $tecnico = $tecnicoModel->getById($id);

            $especialidadModel = new Especialidad();
            $especialidades = $especialidadModel->getAll();

            if ($tecnico) {
                $tecnico['nombre_completo'] = $nombreCompleto;
                $tecnico['especialidad_id'] = $especialidadId;
                $tecnico['disponible'] = $disponible;
            }

            $this->render('tecnicos/edit', [
                'title' => 'Editar técnico - ReparaYa',
                'error' => 'El nombre y la especialidad son obligatorios.',
                'tecnico' => $tecnico,
                'especialidades' => $especialidades
            ]);
            return;
        }

        $tecnicoModel = new Tecnico();
        $tecnicoModel->update($id, $nombreCompleto, $especialidadId, $disponible);

        header('Location: /public/tecnicos');
        exit;
    }

    public function delete(): void
    {
        $id = (int) ($_GET['id'] ?? 0);

        if ($id <= 0) {
         header('Location: /public/tecnicos');
            exit;
        }

        $tecnicoModel = new Tecnico();
        $tecnicoModel->delete($id);

        header('Location: /public/tecnicos');
        exit;
    }
}