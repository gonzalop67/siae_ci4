<?php 
namespace App\Controllers\Admin;

use App\Models\Admin\Cursos_model;
use App\Models\Admin\Jornadas_model;
use App\Models\Admin\Paralelos_model;
use App\Models\Admin\Especialidades_model;
use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;

class Paralelos extends BaseController
{
    protected $reglas, $reglas2, $jornadas, $cursos, $especialidades, $paralelos;

    public function __construct()
    {
        $this->cursos = new Cursos_model();
        $this->jornadas = new Jornadas_model();
        $this->paralelos = new Paralelos_model();
        $this->especialidades = new Especialidades_model();

        $this->reglas = [
            'pa_nombre' => [
                'rules' => 'required|max_length[5]',
                'errors' => [
                    'required'   => 'El campo Nombre es obligatorio.',
                    'max_length' => 'El campo Nombre no debe exceder los 5 caracteres.'
                ]
            ],
            'id_curso' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo Curso es obligatorio.'
                ]
            ],
            'id_jornada' => [
                'rules' => 'required|is_not_unique[sw_jornada.id_jornada]',
                'errors' => [
                    'required' => 'El campo Jornada es obligatorio.',
                    'is_not_unique' => 'No existe la opción elegida en la base de datos.'
                ]
            ]
        ];
    }

    public function index()
    {
        return view('Admin/Paralelos/index', [
            'paralelos' => $this->paralelos
                            ->join(
                                'sw_curso',
                                'sw_curso.id_curso = sw_paralelo.id_curso'
                            )
                            ->join(
                                'sw_especialidad', 
                                'sw_especialidad.id_especialidad = sw_curso.id_especialidad'
                            )
                            ->join(
                                'sw_jornada', 
                                'sw_jornada.id_jornada = sw_paralelo.id_jornada'
                            )
                            ->where('id_periodo_lectivo', session()->id_periodo_lectivo)
                            ->orderBy('pa_orden')
                            ->findAll()
        ]);
    }

    public function create()
    {
        $datos['cursos'] = $this->cursos
                            ->join(
                                'sw_especialidad',
                                'sw_especialidad.id_especialidad = sw_curso.id_especialidad'
                            )
                            ->orderBy('cu_orden', 'ASC')->findAll();

        $datos['jornadas'] = $this->jornadas->orderBy('id_jornada', 'ASC')->findAll();

        return view('Admin/Paralelos/create', $datos);
    }

    public function store()
    {
        if (!$this->validate($this->reglas)) 
        {
            return redirect()->back()->withInput()
                ->with('msg', [
                    'type' => 'danger',
                    'icon' => 'ban',
                    'body' => 'Tienes campos incorrectos.'
                ])
                ->with('errors', $this->validator->getErrors());
        }

        $this->paralelos->save([
            'pa_nombre'          => trim($_POST['pa_nombre']),
            'id_curso'           => $_POST['id_curso'],
            'id_jornada'         => $_POST['id_jornada'],
            'id_periodo_lectivo' => session()->id_periodo_lectivo,
        ]);

        $id_paralelo = $this->paralelos->insertID;

        $this->paralelos->save([
            'id_paralelo' => $id_paralelo,
            'pa_orden' => $id_paralelo
        ]);

        return redirect()->route('paralelos')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'El Paralelo fue guardado correctamente.'
        ]);
    }

    public function edit(string $id)
    {
        if (!$paralelo = $this->paralelos->find($id)) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('Admin/Paralelos/edit', [
            'paralelo' => $this->paralelos
                            ->join(
                                'sw_curso',
                                'sw_curso.id_curso = sw_paralelo.id_curso'
                            )
                            ->join(
                                'sw_especialidad',
                                'sw_especialidad.id_especialidad = sw_curso.id_especialidad'
                            )
                            ->find($id),
            'cursos'   => $this->cursos
                            ->join(
                                'sw_especialidad',
                                'sw_especialidad.id_especialidad = sw_curso.id_especialidad'
                            )
                            ->orderBy('cu_orden', 'ASC')->findAll(),
            'jornadas' => $this->jornadas->orderBy('id_jornada', 'ASC')->findAll() 
        ]);
    }

    public function update()
    {
        if (!$this->validate($this->reglas)) 
        {
            return redirect()->back()->withInput()
                ->with('msg', [
                    'type' => 'danger',
                    'icon' => 'ban',
                    'body' => 'Tienes campos incorrectos.'
                ])
                ->with('errors', $this->validator->getErrors());
        }

        $this->paralelos->save([
            'id_paralelo' => $_POST['id_paralelo'], 
            'pa_nombre'   => trim($_POST['pa_nombre']),
            'id_curso'    => $_POST['id_curso'],
            'id_jornada'  => $_POST['id_jornada'],
        ]);

        return redirect('paralelos')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'El Paralelo fue actualizado correctamente.'
        ]);
    }

    public function delete(string $id)
    {
        try {
            $this->paralelos->delete($id);
    
            return redirect('paralelos')->with('msg', [
                'type' => 'success',
                'icon' => 'check',
                'body' => 'El Paralelo fue eliminado correctamente.'
            ]);
        } catch (\Exception $e) {
            return redirect('paralelos')->with('msg', [
                'type' => 'danger',
                'icon' => 'ban',
                'body' => 'El Paralelo no se pudo eliminar correctamente...Error: ' . $e->getMessage()
            ]);
        }
    }

    public function saveNewPositions()
    {
        foreach($_POST['positions'] as $position) {
            $index = $position[0];
            $newPosition = $position[1];

            $this->paralelos->actualizarOrden($index, $newPosition);
        }
    }
}