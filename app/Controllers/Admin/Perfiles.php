<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\Perfiles_model;
use CodeIgniter\Exceptions\PageNotFoundException;

class Perfiles extends BaseController
{
	public function __construct()
    {
        $this->perfiles = new Perfiles_model();
    }

	public function index()
    {
        return view('Admin/Perfiles/index', [
            'perfiles' => $this->perfiles->orderBy('pe_nombre')->paginate(config('Blog')->regPerPage),
            'pager' => $this->perfiles->pager
        ]);
    }

    public function create()
    {
        return view('Admin/Perfiles/create');
    }

    public function store()
    {
        $reglas = [
            'pe_nombre' => [
                'rules' => 'required|max_length[16]|is_unique[sw_perfil.pe_nombre]',
                'errors' => [
                    'required'   => 'El campo Nombre es obligatorio.',
                    'max_length' => 'El campo Nombre no debe exceder los 16 caracteres.',
                    'is_unique'  => 'El campo Nombre debe ser único.' 
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

        $this->perfiles->save([
            'pe_nombre' => trim($_POST['pe_nombre'])
        ]);

        return redirect()->route('perfiles')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'El perfil fue guardado correctamente.'
        ]);
    }

    public function edit(string $id)
    {
        if (!$perfil = $this->perfiles->find($id)) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('Admin/perfiles/edit', [
            'perfil' => $perfil
        ]);
    }

    public function update()
    {
        $perfil = $this->perfiles->find($_POST['id_perfil']);

        if (trim($_POST['pe_nombre']) != $perfil->pe_nombre) {
            $is_unique = '|is_unique[sw_perfil.pe_nombre]';
        } else {
            $is_unique = '';
        }
        
        $reglas = [
            'pe_nombre' => [
                'rules' => 'required|max_length[64]'.$is_unique,
                'errors' => [
                    'required'   => 'El campo Nombre es obligatorio.',
                    'max_length' => 'El campo Nombre no debe exceder los 64 caracteres.',
                    'is_unique'  => 'El campo Nombre debe ser único.'
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

        $this->perfiles->save([
            'id_perfil' => $_POST['id_perfil'],
            'pe_nombre' => trim($_POST['pe_nombre'])
        ]);

        return redirect('perfiles')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'El perfil fue actualizado correctamente.'
        ]);
    }

    public function delete(string $id)
    {
        try {
            $this->perfiles->delete($id);
    
            return redirect('perfiles')->with('msg', [
                'type' => 'success',
                'icon' => 'check',
                'body' => 'El perfil fue eliminado correctamente.'
            ]);
        } catch (\Exception $e) {
            return redirect('perfiles')->with('msg', [
                'type' => 'danger',
                'icon' => 'ban',
                'body' => 'El perfil no se pudo eliminar correctamente...Error: ' . $e->getMessage()
            ]);
        }
    }
}
