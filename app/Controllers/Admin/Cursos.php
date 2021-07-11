<?php 
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\Cursos_model;
use App\Models\Admin\Especialidades_model;
use App\Models\Admin\Tipos_educacion_model;
use CodeIgniter\Exceptions\PageNotFoundException;

class Cursos extends BaseController
{
    protected $cursos, $especialidades, $tipos_educacion;

    public function __construct()
    {
        $this->cursos = new Cursos_model();
        $this->especialidades = new Especialidades_model();
        $this->tipos_educacion = new Tipos_educacion_model();
    }

    public function index()
    {
        return view('Admin/Cursos/index', [
            'cursos' => $this->cursos
                        ->join(
                            'sw_especialidad',
                            'sw_especialidad.id_especialidad = sw_curso.id_especialidad'
                        )
                        ->join(
                            'sw_tipo_educacion', 
                            'sw_tipo_educacion.id_tipo_educacion = sw_especialidad.id_tipo_educacion'
                        )->orderBy('cu_orden')
                        ->findAll()
        ]);
    }

    public function create()
    {
        $datos['especialidades'] = $this->especialidades->orderBy('es_orden', 'ASC')->findAll();

        return view('Admin/Cursos/create', $datos);
    }

    public function store()
    {
        $reglas = [
            'cu_nombre' => [
                'rules' => 'required|max_length[128]',
                'errors' => [
                    'required'   => 'El campo Nombre es obligatorio.',
                    'max_length' => 'El campo Nombre no debe exceder los 128 caracteres.'
                ]
            ],
            'cu_shortname' => [
                'rules' => 'required|max_length[45]|is_unique[sw_curso.cu_shortname]',
                'errors' => [
                    'required'   => 'El campo Nombre Corto es obligatorio.',
                    'max_length' => 'El campo Nombre Corto no debe exceder los 45 caracteres.',
                    'is_unique'  => 'El campo Nombre Corto debe ser único.' 
                ]
            ],
            'cu_abreviatura' => [
                'rules' => 'required|max_length[5]',
                'errors' => [
                    'required'   => 'El campo Abreviatura es obligatorio.',
                    'max_length' => 'El campo Abreviatura no debe exceder los 5 caracteres.'
                ]
            ],
            'quien_inserta_comp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo Quién inserta comportamiento es obligatorio.'
                ]
            ],
            'id_especialidad' => [
                'rules' => 'required|is_not_unique[sw_especialidad.id_especialidad]',
                'errors' => [
                    'required' => 'El campo Especialidad es obligatorio.',
                    'is_not_unique' => 'No existe la opción elegida en la base de datos.'
                ]
            ]
        ];

        if (!$this->validate($reglas)) 
        {
            return redirect()->back()->withInput()
                ->with('msg', [
                    'type' => 'danger',
                    'icon' => 'ban',
                    'body' => 'Tienes campos incorrectos.'
                ])
                ->with('errors', $this->validator->getErrors());
        }

        $this->cursos->save([
            'cu_nombre'          => trim($_POST['cu_nombre']),
            'cu_shortname'       => $_POST['cu_shortname'],
            'cu_abreviatura'     => $_POST['cu_abreviatura'],
            'quien_inserta_comp' => $_POST['quien_inserta_comp'],
            'id_especialidad'    => $_POST['id_especialidad'],
        ]);

        $id_curso = $this->cursos->insertID;

        $this->cursos->save([
            'id_curso' => $id_curso,
            'cu_orden' => $id_curso
        ]);

        return redirect()->route('cursos')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'El Curso fue guardado correctamente.'
        ]);
    }

    public function edit(string $id)
    {
        if (!$curso = $this->cursos->find($id)) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('Admin/Cursos/edit', [
            'curso' => $curso,
            'especialidades' => $this->especialidades->orderBy('es_orden', 'ASC')->findAll()
        ]);
    }

    public function update()
    {
        $curso = $this->cursos->find($_POST['id_curso']);

        if (trim($_POST['cu_shortname']) != $curso->cu_shortname) {
            $is_unique = '|is_unique[sw_curso.cu_shortname]';
        } else {
            $is_unique = '';
        }
        
        $reglas = [
            'cu_nombre' => [
                'rules' => 'required|max_length[128]',
                'errors' => [
                    'required'   => 'El campo Nombre es obligatorio.',
                    'max_length' => 'El campo Nombre no debe exceder los 128 caracteres.'
                ]
            ],
            'cu_shortname' => [
                'rules' => 'required|max_length[45]'.$is_unique,
                'errors' => [
                    'required'   => 'El campo Nombre Corto es obligatorio.',
                    'max_length' => 'El campo Nombre Corto no debe exceder los 45 caracteres.',
                    'is_unique'  => 'El campo Nombre Corto debe ser único.' 
                ]
            ],
            'cu_abreviatura' => [
                'rules' => 'required|max_length[5]',
                'errors' => [
                    'required'   => 'El campo Abreviatura es obligatorio.',
                    'max_length' => 'El campo Abreviatura no debe exceder los 5 caracteres.'
                ]
            ],
            'quien_inserta_comp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo Quién inserta comportamiento es obligatorio.'
                ]
            ],
            'id_especialidad' => [
                'rules' => 'required|is_not_unique[sw_especialidad.id_especialidad]',
                'errors' => [
                    'required' => 'El campo Especialidad es obligatorio.',
                    'is_not_unique' => 'No existe la opción elegida en la base de datos.'
                ]
            ]
        ];

        if (!$this->validate($reglas)) 
        {
            return redirect()->back()->withInput()
                ->with('msg', [
                    'type' => 'danger',
                    'icon' => 'ban',
                    'body' => 'Tienes campos incorrectos.'
                ])
                ->with('errors', $this->validator->getErrors());
        }

        $this->cursos->save([
            'id_curso'           => $_POST['id_curso'], 
            'cu_nombre'          => trim($_POST['cu_nombre']),
            'cu_shortname'       => $_POST['cu_shortname'],
            'cu_abreviatura'     => $_POST['cu_abreviatura'],
            'id_especialidad'    => $_POST['id_especialidad'],
            'quien_inserta_comp' => $_POST['quien_inserta_comp'],
        ]);

        return redirect('cursos')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'El Curso fue actualizado correctamente.'
        ]);
    }

    public function delete(string $id)
    {
        try {
            $this->cursos->delete($id);
    
            return redirect('cursos')->with('msg', [
                'type' => 'success',
                'icon' => 'check',
                'body' => 'El Curso fue eliminado correctamente.'
            ]);
        } catch (\Exception $e) {
            return redirect('cursos')->with('msg', [
                'type' => 'danger',
                'icon' => 'ban',
                'body' => 'El Curso no se pudo eliminar correctamente...Error: ' . $e->getMessage()
            ]);
        }
    }

    public function saveNewPositions()
    {
        foreach($_POST['positions'] as $position) {
            $index = $position[0];
            $newPosition = $position[1];

            $this->cursos->actualizarOrden($index, $newPosition);
        }
    }
}