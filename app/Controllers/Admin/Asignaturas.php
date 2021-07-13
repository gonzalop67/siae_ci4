<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Admin\Asignaturas_model;
use App\Models\Admin\Tipos_asignatura_model;
use App\Models\Admin\Areas_model;
use CodeIgniter\Exceptions\PageNotFoundException;

class Asignaturas extends Controller{

    protected $areas, $asignaturas, $reglas, $tipos_asignatura;

    public function __construct()
    {
        $this->areas = new Areas_model();
        $this->asignaturas = new Asignaturas_model();
        $this->tipos_asignatura = new Tipos_asignatura_model();

        $this->reglas = [
            'as_nombre' => [
                'rules' => 'required|max_length[84]',
                'errors' => [
                    'required'   => 'El campo Nombre es obligatorio.',
                    'max_length' => 'El campo Nombre no debe exceder los 84 caracteres.'
                ]
            ],
            'as_abreviatura' => [
                'rules' => 'required|max_length[12]',
                'errors' => [
                    'required'   => 'El campo Abreviatura es obligatorio.',
                    'max_length' => 'El campo Abreviatura no debe exceder los 12 caracteres.'
                ]
            ],
            'id_tipo_asignatura' => [
                'rules' => 'required|is_not_unique[sw_tipo_asignatura.id_tipo_asignatura]',
                'errors' => [
                    'required' => 'El campo Tipo Asignatura es obligatorio.',
                    'is_not_unique' => 'No existe la opción elegida en la base de datos.'
                ]
            ],
            'id_area' => [
                'rules' => 'required|is_not_unique[sw_area.id_area]',
                'errors' => [
                    'required' => 'El campo Area es obligatorio.',
                    'is_not_unique' => 'No existe la opción elegida en la base de datos.'
                ]
            ]
        ];
    }

    public function index()
    {
        return view('Admin/Asignaturas/index', [
            'asignaturas' => $this->asignaturas
                            ->join(
                                'sw_area',
                                'sw_area.id_area = sw_asignatura.id_area'
                            )
                            ->join(
                                'sw_tipo_asignatura',
                                'sw_tipo_asignatura.id_tipo_asignatura = sw_asignatura.id_tipo_asignatura'
                            )
                            ->orderBy('ar_nombre')
                            ->orderBy('as_nombre')
                            ->paginate(config('Blog')->regPerPage),
            'pager' => $this->asignaturas->pager
        ]);
    }

    public function create()
    {
        return view('Admin/Asignaturas/create', [
            'tipos_asignatura' => $this->tipos_asignatura->findAll(),
            'areas' => $this->areas->orderBy('ar_nombre')->findAll()
        ]);
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

        $this->asignaturas->save([
            'as_nombre'          => trim($_POST['as_nombre']),
            'as_abreviatura'     => $_POST['as_abreviatura'],
            'id_tipo_asignatura' => $_POST['id_tipo_asignatura'],
            'id_area'            => $_POST['id_area']
        ]);

        return redirect()->route('asignaturas')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'La Asignatura fue guardada correctamente.'
        ]);
    }

    public function edit(string $id)
    {
        if (!$asignatura = $this->asignaturas->find($id)) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('Admin/Asignaturas/edit', [
            'asignatura' => $asignatura,
            'tipos_asignatura' => $this->tipos_asignatura->findAll(),
            'areas' => $this->areas->orderBy('ar_nombre')->findAll()
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

        $this->asignaturas->save([
            'id_asignatura' => $_POST['id_asignatura'],
            'as_nombre' => trim($_POST['as_nombre']),
            'as_abreviatura' => $_POST['as_abreviatura'],
            'id_tipo_asignatura' => $_POST['id_tipo_asignatura'],
            'id_area' => $_POST['id_area']
        ]);

        return redirect('asignaturas')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'La asignatura fue actualizada correctamente.'
        ]);
    }
    
    public function delete(string $id)
    {
        try {
            $this->asignaturas->delete($id);
    
            return redirect('asignaturas')->with('msg', [
                'type' => 'success',
                'icon' => 'check',
                'body' => 'La Asignatura fue eliminado correctamente.'
            ]);
        } catch (\Exception $e) {
            return redirect('asignaturas')->with('msg', [
                'type' => 'danger',
                'icon' => 'ban',
                'body' => 'La Asignatura no se pudo eliminar correctamente...Error: ' . $e->getMessage()
            ]);
        }
    }
}