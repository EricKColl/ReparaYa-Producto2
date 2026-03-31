<?php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../models/Especialidad.php';

class EspecialidadController extends Controller
{
    public function index(): void
    {
        $especialidadModel = new Especialidad();
        $especialidades = $especialidadModel->getAll();

        $this->render('especialidades/index', [
            'title' => 'Listado de especialidades - ReparaYa',
            'especialidades' => $especialidades
        ]);
    }
}