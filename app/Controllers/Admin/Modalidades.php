<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\Modalidades_model;
use CodeIgniter\Exceptions\PageNotFoundException;

class Modalidades extends BaseController
{
	public function __construct()
    {
        $this->modalidades = new Modalidades_model();
    }

	public function index()
    {
        return view('Admin/Modalidades/index', [
            'modalidades' => $this->modalidades->paginate(config('Blog')->regPerPage),
            'pager' => $this->modalidades->pager
        ]);
    }

    public function create()
    {
        return view('Admin/Modalidades/create');
    }

    public function store()
    {
        $reglas = [
            'mo_nombre' => [
                'rules' => 'required|max_length[64]|is_unique[sw_modalidad.mo_nombre]',
                'errors' => [
                    'required'   => 'El campo Nombre es obligatorio.',
                    'max_length' => 'El campo Nombre no debe exceder los 64 caracteres.',
                    'is_unique'  => 'El campo Nombre debe ser único.' 
                ]
            ],
            'mo_activo' => [
                'rules' => 'required|is_not_unique[sw_modalidad.mo_activo]',
                'errors' => [
                    'required' => 'El campo Activo es obligatorio.',
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

        $this->modalidades->save([
            'mo_nombre' => trim($_POST['mo_nombre']),
            'mo_activo' => $_POST['mo_activo']
        ]);

        return redirect()->route('modalidades')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'La modalidad fue guardada correctamente.'
        ]);
    }

    public function edit(string $id)
    {
        if (!$modalidad = $this->modalidades->find($id)) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('Admin/Modalidades/edit', [
            'modalidad' => $modalidad
        ]);
    }

    public function update()
    {
        $modalidad = $this->modalidades->find($_POST['id_modalidad']);

        if (trim($_POST['mo_nombre']) != $modalidad->mo_nombre) {
            $is_unique = '|is_unique[sw_modalidad.mo_nombre]';
        } else {
            $is_unique = '';
        }
        
        $reglas = [
            'mo_nombre' => [
                'rules' => 'required|max_length[64]'.$is_unique,
                'errors' => [
                    'required'   => 'El campo Nombre es obligatorio.',
                    'max_length' => 'El campo Nombre no debe exceder los 64 caracteres.',
                    'is_unique'  => 'El campo Nombre debe ser único.'
                ]
            ],
            'mo_activo' => [
                'rules' => 'required|is_not_unique[sw_modalidad.mo_activo]',
                'errors' => [
                    'required' => 'El campo Activo es obligatorio.',
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

        $this->modalidades->save([
            'id_modalidad' => $_POST['id_modalidad'],
            'mo_nombre' => trim($_POST['mo_nombre']),
            'mo_activo' => $_POST['mo_activo']
        ]);

        return redirect('modalidades')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'La modalidad fue actualizada correctamente.'
        ]);
    }

    public function delete(string $id)
    {
        try {
            $this->modalidades->delete($id);
    
            return redirect('modalidades')->with('msg', [
                'type' => 'success',
                'icon' => 'check',
                'body' => 'La modalidad fue eliminada correctamente.'
            ]);
        } catch (\Exception $e) {
            return redirect('modalidades')->with('msg', [
                'type' => 'danger',
                'icon' => 'ban',
                'body' => 'La modalidad no se pudo eliminar correctamente...Error: ' . $e->getMessage()
            ]);
        }
    }
}
