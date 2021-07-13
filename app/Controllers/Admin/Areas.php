<?php

namespace App\Controllers\Admin;

use App\Models\Admin\Areas_model;
use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;

class Areas extends BaseController
{

    protected $areas;

    public function __construct()
    {
        $this->areas = new Areas_model();
    }

    public function index()
    {
        return view('Admin/Areas/index', [
            'areas' => $this->areas->orderBy('ar_nombre')->paginate(config('Blog')->regPerPage),
            'pager' => $this->areas->pager
        ]);
    }

    public function create()
    {
        return view('Admin/Areas/create');
    }

    public function store()
    {
        $reglas = [
            'ar_nombre' => [
                'rules' => 'required|max_length[45]|is_unique[sw_area.ar_nombre]',
                'errors' => [
                    'required'   => 'El campo Nombre es obligatorio.',
                    'max_length' => 'El campo Nombre no debe exceder los 45 caracteres.',
                    'is_unique'  => 'El campo Nombre debe ser único.'
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

        $this->areas->save([
            'ar_nombre' => trim($_POST['ar_nombre']),
        ]);

        return redirect()->route('areas')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'El Area fue guardada correctamente.'
        ]);
    }

    public function edit(string $id)
    {
        if (!$area = $this->areas->find($id)) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('Admin/Areas/edit', [
            'area' => $area
        ]);
    }

    public function update()
    {
        $area_actual = $this->areas->find($_POST['id_area']);

        if (trim($_POST['ar_nombre']) != $area_actual->ar_nombre) {
            $is_unique =  '|is_unique[sw_area.ar_nombre]';
        } else {
            $is_unique =  '';
        }

        $reglas = [
            'ar_nombre' => [
                'rules' => 'required|max_length[45]'.$is_unique,
                'errors' => [
                    'required'   => 'El campo Nombre es obligatorio.',
                    'max_length' => 'El campo Nombre no debe exceder los 45 caracteres.',
                    'is_unique'  => 'El campo Nombre debe ser único.'
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

        $this->areas->save([
            'id_area'   => $_POST['id_area'],
            'ar_nombre' => trim($_POST['ar_nombre']),
        ]);

        return redirect('areas')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'El Area fue actualizada correctamente.'
        ]);
    }

    public function delete(string $id)
    {
        try {
            $this->areas->delete($id);

            return redirect('areas')->with('msg', [
                'type' => 'success',
                'icon' => 'check',
                'body' => 'El Area fue eliminada correctamente.'
            ]);
        } catch (\Exception $e) {
            return redirect('areas')->with('msg', [
                'type' => 'danger',
                'icon' => 'ban',
                'body' => 'El Area no se pudo eliminar correctamente...Error: ' . $e->getMessage()
            ]);
        }
    }
}
