<?php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../models/Incidencia.php';
require_once __DIR__ . '/../models/Tecnico.php';
require_once __DIR__ . '/../models/Especialidad.php';
require_once __DIR__ . '/../models/Usuario.php';

class AdminController extends Controller
{
    public function index(): void
    {
        $this->requireAdmin();

        $incidenciaModel = new Incidencia();
        $incidencias = $incidenciaModel->getAll();

        $this->render('admin/index', [
            'title'       => 'Panel de Administración - ReparaYa',
            'incidencias' => $incidencias,
        ]);
    }

    public function create(): void
    {
        $this->requireAdmin();

        $especialidadModel = new Especialidad();
        $usuarioModel      = new Usuario();

        $this->render('admin/create', [
            'title'         => 'Nueva Incidencia - ReparaYa',
            'especialidades' => $especialidadModel->getAll(),
            'clientes'      => $usuarioModel->getClientes(),
        ]);
    }

    public function store(): void
    {
        $this->requireAdmin();

        $clienteId    = (int) ($_POST['cliente_id']      ?? 0);
        $especialidad = (int) ($_POST['especialidad_id'] ?? 0);
        $descripcion  = trim($_POST['descripcion']       ?? '');
        $direccion    = trim($_POST['direccion']          ?? '');
        $fecha        = trim($_POST['fecha_servicio']     ?? '');
        $urgencia     = $_POST['tipo_urgencia']           ?? 'Estándar';

        if (!$clienteId || !$especialidad || !$descripcion || !$direccion || !$fecha) {
            $especialidadModel = new Especialidad();
            $usuarioModel      = new Usuario();
            $this->render('admin/create', [
                'title'         => 'Nueva Incidencia - ReparaYa',
                'error'         => 'Todos los campos son obligatorios.',
                'especialidades' => $especialidadModel->getAll(),
                'clientes'      => $usuarioModel->getClientes(),
            ]);
            return;
        }

        $incidenciaModel = new Incidencia();
        $incidenciaModel->create([
            'cliente_id'      => $clienteId,
            'especialidad_id' => $especialidad,
            'descripcion'     => $descripcion,
            'direccion'       => $direccion,
            'fecha_servicio'  => $fecha,
            'tipo_urgencia'   => $urgencia,
        ]);

        header('Location: /public/admin?ok=creada');
        exit;
    }

    public function edit(): void
    {
        $this->requireAdmin();

        $id = (int) ($_GET['id'] ?? 0);
        if ($id <= 0) {
            header('Location: /public/admin');
            exit;
        }

        $incidenciaModel = new Incidencia();
        $incidencia = $incidenciaModel->getById($id);
        if (!$incidencia) {
            header('Location: /public/admin');
            exit;
        }

        $especialidadModel = new Especialidad();

        $this->render('admin/edit', [
            'title'         => 'Editar Incidencia - ReparaYa',
            'incidencia'    => $incidencia,
            'especialidades' => $especialidadModel->getAll(),
        ]);
    }

    public function update(): void
    {
        $this->requireAdmin();

        $id = (int) ($_POST['id'] ?? 0);
        if ($id <= 0) {
            header('Location: /public/admin');
            exit;
        }

        $incidenciaModel = new Incidencia();
        $incidenciaModel->update($id, [
            'especialidad_id' => (int) ($_POST['especialidad_id'] ?? 0),
            'descripcion'     => trim($_POST['descripcion']       ?? ''),
            'direccion'       => trim($_POST['direccion']          ?? ''),
            'fecha_servicio'  => trim($_POST['fecha_servicio']     ?? ''),
            'tipo_urgencia'   => $_POST['tipo_urgencia']           ?? 'Estándar',
            'estado'          => $_POST['estado']                  ?? 'Pendiente',
        ]);

        header('Location: /public/admin?ok=actualizada');
        exit;
    }

    public function asignar(): void
    {
        $this->requireAdmin();

        $id        = (int) ($_POST['incidencia_id'] ?? 0);
        $tecnicoId = (int) ($_POST['tecnico_id']    ?? 0);

        if ($id > 0 && $tecnicoId > 0) {
            $incidenciaModel = new Incidencia();
            $incidenciaModel->asignarTecnico($id, $tecnicoId);
        }

        header('Location: /public/admin?ok=asignado');
        exit;
    }

    public function delete(): void
    {
        $this->requireAdmin();

        $id = (int) ($_POST['id'] ?? 0);
        if ($id > 0) {
            $incidenciaModel = new Incidencia();
            $incidenciaModel->delete($id);
        }

        header('Location: /public/admin?ok=cancelada');
        exit;
    }

    public function calendario(): void
    {
        $this->requireAdmin();

        $incidenciaModel = new Incidencia();
        $incidencias = $incidenciaModel->getAll();

        $this->render('admin/calendario', [
            'title'       => 'Calendario - ReparaYa',
            'incidencias' => $incidencias,
        ]);
    }
}
