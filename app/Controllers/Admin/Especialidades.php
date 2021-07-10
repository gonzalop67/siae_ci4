<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\Especialidades_model;
use App\Models\Admin\Tipos_educacion_model;
use CodeIgniter\Exceptions\PageNotFoundException;

class Especialidades extends BaseController
{
    protected $especialidades, $tipos_educacion;

    public function __construct()
    {
        $this->especialidades = new Especialidades_model();
        $this->tipos_educacion = new Tipos_educacion_model();
    }

    public function index()
    {
        return view('Admin/Especialidades/index', [
            'especialidades' => $this->especialidades->listarEspecialidades()
        ]);
    }

    public function create()
    {
        $datos['tipos_educacion'] = $this->tipos_educacion->orderBy('te_orden', 'ASC')->findAll();

        return view('Admin/Especialidades/create', $datos);
    }

    public function store()
    {
        $reglas = [
            'es_nombre' => [
                'rules' => 'required|max_length[64]',
                'errors' => [
                    'required'   => 'El campo Nombre es obligatorio.',
                    'max_length' => 'El campo Nombre no debe exceder los 64 caracteres.'
                ]
            ],
            'es_figura' => [
                'rules' => 'required|max_length[50]|is_unique[sw_especialidad.es_figura]',
                'errors' => [
                    'required'   => 'El campo Figura Profesional es obligatorio.',
                    'max_length' => 'El campo Figura Profesional no debe exceder los 50 caracteres.',
                    'is_unique'  => 'El campo Figura Profesional debe ser único.'
                ]
            ],
            'es_abreviatura' => [
                'rules' => 'required|max_length[15]',
                'errors' => [
                    'required'   => 'El campo Abreviatura es obligatorio.',
                    'max_length' => 'El campo Abreviatura no debe exceder los 15 caracteres.'
                ]
            ],
            'id_tipo_educacion' => [
                'rules' => 'required|is_not_unique[sw_tipo_educacion.id_tipo_educacion]',
                'errors' => [
                    'required' => 'El campo Nivel de Educación es obligatorio.',
                    'is_not_unique' => 'No existe la opción elegida en la base de datos.'
                ]
            ]
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()
                ->with('msg', [
                    'type' => 'danger',
                    'icon' => 'ban',
                    'body' => 'Tienes campos incorrectos.'
                ])
                ->with('errors', $this->validator->getErrors());
        }

        $this->especialidades->save([
            'es_nombre' => trim($_POST['es_nombre']),
            'es_figura' => $_POST['es_figura'],
            'es_abreviatura' => $_POST['es_abreviatura'],
            'id_tipo_educacion' => $_POST['id_tipo_educacion'],
        ]);

        return redirect()->route('especialidades')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'La Especialidad fue guardada correctamente.'
        ]);
    }

    public function edit(string $id)
    {
        if (!$especialidad = $this->especialidades->find($id)) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('Admin/Especialidades/edit', [
            'especialidad' => $especialidad,
            'tipos_educacion' => $this->tipos_educacion->orderBy('te_orden', 'ASC')->findAll()
        ]);
    }

    public function update()
    {
        $especialidad = $this->especialidades->find($_POST['id_especialidad']);

        if (trim($_POST['es_figura']) != $especialidad->es_figura) {
            $is_unique = '|is_unique[sw_especialidad.es_figura]';
        } else {
            $is_unique = '';
        }

        $reglas = [
            'es_nombre' => [
                'rules' => 'required|max_length[64]',
                'errors' => [
                    'required'   => 'El campo Nombre es obligatorio.',
                    'max_length' => 'El campo Nombre no debe exceder los 64 caracteres.'
                ]
            ],
            'es_figura' => [
                'rules' => 'required|max_length[50]' . $is_unique,
                'errors' => [
                    'required'   => 'El campo Figura Profesional es obligatorio.',
                    'max_length' => 'El campo Figura Profesional no debe exceder los 50 caracteres.',
                    'is_unique'  => 'El campo Figura Profesional debe ser único.'
                ]
            ],
            'es_abreviatura' => [
                'rules' => 'required|max_length[15]',
                'errors' => [
                    'required'   => 'El campo Abreviatura es obligatorio.',
                    'max_length' => 'El campo Abreviatura no debe exceder los 15 caracteres.'
                ]
            ],
            'id_tipo_educacion' => [
                'rules' => 'required|is_not_unique[sw_tipo_educacion.id_tipo_educacion]',
                'errors' => [
                    'required' => 'El campo Nivel de Educación es obligatorio.',
                    'is_not_unique' => 'No existe la opción elegida en la base de datos.'
                ]
            ]
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()
                ->with('msg', [
                    'type' => 'danger',
                    'icon' => 'ban',
                    'body' => 'Tienes campos incorrectos.'
                ])
                ->with('errors', $this->validator->getErrors());
        }

        $this->especialidades->save([
            'id_especialidad'   => $_POST['id_especialidad'],
            'es_nombre'         => trim($_POST['es_nombre']),
            'es_figura'         => $_POST['es_figura'],
            'es_abreviatura'    => $_POST['es_abreviatura'],
            'id_tipo_educacion' => $_POST['id_tipo_educacion'],
        ]);

        return redirect('especialidades')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'La Especialidad fue actualizada correctamente.'
        ]);
    }

    public function delete(string $id)
    {
        try {
            $this->especialidades->delete($id);

            return redirect('especialidades')->with('msg', [
                'type' => 'success',
                'icon' => 'check',
                'body' => 'La Especialidad fue eliminada correctamente.'
            ]);
        } catch (\Exception $e) {
            return redirect('especialidades')->with('msg', [
                'type' => 'danger',
                'icon' => 'ban',
                'body' => 'La Especialidad no se pudo eliminar correctamente...Error: ' . $e->getMessage()
            ]);
        }
    }

    public function saveNewPositions()
    {
        foreach ($_POST['positions'] as $position) {
            $index = $position[0];
            $newPosition = $position[1];

            $this->especialidades->actualizarOrden($index, $newPosition);
        }
    }
}
