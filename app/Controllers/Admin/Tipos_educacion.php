<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Admin\Tipos_educacion_model;
use CodeIgniter\Exceptions\PageNotFoundException;

class Tipos_educacion extends Controller{

    public function __construct()
    {
        $this->tipos_educacion = new Tipos_educacion_model();
    }

    public function index()
    {
        return view('Admin/Tipos_educacion/index', [
            'tipos_educacion' => $this->tipos_educacion->orderBy('te_orden')->paginate(config('Blog')->regPerPage),
            'pager' => $this->tipos_educacion->pager
        ]);
    }

    public function create()
    {
        return view('Admin/Tipos_educacion/create');
    }

    public function store()
    {
        $reglas = [
            'te_nombre' => [
                'rules' => 'required|max_length[48]|is_unique[sw_tipo_educacion.te_nombre]',
                'errors' => [
                    'required'   => 'El campo Nombre es obligatorio.',
                    'max_length' => 'El campo Nombre no debe exceder los 48 caracteres.',
                    'is_unique'  => 'El campo Nombre debe ser único.' 
                ]
            ],
            'te_bachillerato' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo Es Bachillerato es obligatorio.'
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

        $this->tipos_educacion->save([
            'te_nombre' => trim($_POST['te_nombre']),
            'te_bachillerato' => $_POST['te_bachillerato']
        ]);

        return redirect()->route('tipos_educacion')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'El Nivel de Educación fue guardado correctamente.'
        ]);
    }

    public function saveNewPositions()
    {
        foreach($_POST['positions'] as $position) {
            $index = $position[0];
            $newPosition = $position[1];

            $this->tipos_educacion->actualizarOrden($index, $newPosition);
        }
    }

    public function edit(string $id)
    {
        if (!$tipo_educacion = $this->tipos_educacion->find($id)) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('Admin/Tipos_educacion/edit', [
            'tipo_educacion' => $tipo_educacion
        ]);
    }

    public function update()
    {
        $tipo_educacion_actual = $this->tipos_educacion->find($_POST['id_tipo_educacion']);

        if (trim($_POST['te_nombre']) != $tipo_educacion_actual->te_nombre) {
            $is_unique = '|is_unique[sw_tipo_educacion.te_nombre]';
        } else {
            $is_unique = '';
        }

        $reglas = [
            'te_nombre' => [
                'rules' => 'required|max_length[48]'.$is_unique,
                'errors' => [
                    'required'   => 'El campo Nombre es obligatorio.',
                    'max_length' => 'El campo Nombre no debe exceder los 48 caracteres.',
                    'is_unique'  => 'El campo Nombre debe ser único.' 
                ]
            ],
            'te_bachillerato' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo Es Bachillerato es obligatorio.'
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

        $this->tipos_educacion->save([
            'id_tipo_educacion' => $_POST['id_tipo_educacion'],
            'te_nombre' => trim($_POST['te_nombre']),
            'te_bachillerato' => $_POST['te_bachillerato']
        ]);

        return redirect('tipos_educacion')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'El Nivel de Educación fue actualizado correctamente.'
        ]);
    }
    
    public function delete(string $id)
    {
        try {
            $this->tipos_educacion->delete($id);
    
            return redirect('tipos_educacion')->with('msg', [
                'type' => 'success',
                'icon' => 'check',
                'body' => 'El Nivel de Educación fue eliminado correctamente.'
            ]);
        } catch (\Exception $e) {
            return redirect('tipos_educacion')->with('msg', [
                'type' => 'danger',
                'icon' => 'ban',
                'body' => 'El Nivel de Educación no se pudo eliminar correctamente...Error: ' . $e->getMessage()
            ]);
        }
    }
}