<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\Modalidades_model;

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
}
