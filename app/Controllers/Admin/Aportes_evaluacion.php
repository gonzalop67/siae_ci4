<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Admin\Aportes_evaluacion_model;
use App\Models\Admin\Periodos_evaluacion_model;
use App\Models\Admin\Tipos_aporte_model;
use CodeIgniter\Exceptions\PageNotFoundException;

class Aportes_evaluacion extends Controller
{

    protected $aportes_evaluacion, $periodos_evaluacion, $reglas, $tipos_aporte;

    public function __construct()
    {
        $this->aportes_evaluacion = new Aportes_evaluacion_model();
        $this->periodos_evaluacion = new Periodos_evaluacion_model();
        $this->tipos_aporte = new Tipos_aporte_model();

        $this->reglas = [
            'ap_nombre' => [
                'rules' => 'required|max_length[24]',
                'errors' => [
                    'required'   => 'El campo Nombre es obligatorio.',
                    'max_length' => 'El campo Nombre no debe exceder los 24 caracteres.'
                ]
            ],
            'ap_abreviatura' => [
                'rules' => 'required|max_length[8]',
                'errors' => [
                    'required'   => 'El campo Abreviatura es obligatorio.',
                    'max_length' => 'El campo Abreviatura no debe exceder los 8 caracteres.'
                ]
            ],
            'ap_fecha_apertura' => [
                'rules' => 'required|valid_date',
                'errors' => [
                    'required'   => 'El campo Fecha de inicio es obligatorio.',
                    'valid_date' => 'El campo Fecha de inicio no contiene un formato válido de fecha.'
                ]
            ],
            'ap_fecha_cierre' => [
                'rules' => 'required|valid_date',
                'errors' => [
                    'required'   => 'El campo Fecha de fin es obligatorio.',
                    'valid_date' => 'El campo Fecha de fin no contiene un formato válido de fecha.'
                ]
            ],
            'id_tipo_aporte' => [
                'rules' => 'required|is_not_unique[sw_tipo_aporte.id_tipo_aporte]',
                'errors' => [
                    'required' => 'El campo Tipo es obligatorio.',
                    'is_not_unique' => 'No existe la opción elegida en la base de datos.'
                ]
            ],
            'id_periodo_evaluacion' => [
                'rules' => 'required|is_not_unique[sw_periodo_evaluacion.id_periodo_evaluacion]',
                'errors' => [
                    'required' => 'El campo Periodo es obligatorio.',
                    'is_not_unique' => 'No existe la opción elegida en la base de datos.'
                ]
            ]
        ];

    }

    public function index()
    {
        return view('Admin/Aportes_evaluacion/index', [
            'aportes_evaluacion' => $this->aportes_evaluacion
                                    ->join(
                                        'sw_periodo_evaluacion',
                                        'sw_periodo_evaluacion.id_periodo_evaluacion = sw_aporte_evaluacion.id_periodo_evaluacion'
                                    )
                                    ->join(
                                        'sw_tipo_aporte',
                                        'sw_tipo_aporte.id_tipo_aporte = sw_aporte_evaluacion.id_tipo_aporte'
                                    )
                                    ->orderby('sw_periodo_evaluacion.id_periodo_evaluacion')
                                    ->orderBy('sw_tipo_aporte.id_tipo_aporte')
                                    ->orderBy('id_aporte_evaluacion')
                                    ->paginate(config('Blog')->regPerPage),
            'pager' => $this->aportes_evaluacion->pager
        ]);
    }

    public function create()
    {
        $datos['tipos_aporte'] = $this->tipos_aporte->findAll();
        $datos['periodos_evaluacion'] = $this->periodos_evaluacion->findAll();
        return view('Admin/Aportes_evaluacion/create', $datos);
    }

    public function store()
    {
        if (!$this->validate($this->reglas)) {
            return redirect()->back()->withInput()
                ->with('msg', [
                    'type' => 'danger',
                    'icon' => 'ban',
                    'body' => 'Tienes campos incorrectos.'
                ])
                ->with('errors', $this->validator->getErrors());
        }

        $this->aportes_evaluacion->save([
            'ap_nombre' => trim($_POST['ap_nombre']),
            'ap_abreviatura' => trim($_POST['ap_abreviatura']),
            'ap_fecha_apertura' => trim($_POST['ap_fecha_apertura']),
            'ap_fecha_cierre' => trim($_POST['ap_fecha_cierre']),
            'id_tipo_aporte' => trim($_POST['id_tipo_aporte']),
            'id_periodo_evaluacion' => trim($_POST['id_periodo_evaluacion']),
        ]);

        return redirect()->route('aportes_evaluacion')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'El Aporte de Evaluación fue guardado correctamente.'
        ]);
    }

    public function edit(string $id)
    {
        if (!$aporte_evaluacion = $this->aportes_evaluacion->find($id)) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('Admin/Aportes_evaluacion/edit', [
            'aporte_evaluacion' => $aporte_evaluacion,
            'tipos_aporte' => $this->tipos_aporte->findAll(),
            'periodos_evaluacion' => $this->periodos_evaluacion->findAll()
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

        $this->aportes_evaluacion->save([
            'id_aporte_evaluacion' => $_POST['id_aporte_evaluacion'],
            'ap_nombre' => trim($_POST['ap_nombre']),
            'ap_abreviatura' => trim($_POST['ap_abreviatura']),
            'ap_fecha_apertura' => trim($_POST['ap_fecha_apertura']),
            'ap_fecha_cierre' => trim($_POST['ap_fecha_cierre']),
            'id_tipo_aporte' => trim($_POST['id_tipo_aporte']),
            'id_periodo_evaluacion' => trim($_POST['id_periodo_evaluacion']),
        ]);

        return redirect()->route('aportes_evaluacion')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'El Aporte de Evaluación fue actualizado correctamente.'
        ]);
    }

    public function delete(string $id)
    {
        try {
            $this->aportes_evaluacion->delete($id);
    
            return redirect('aportes_evaluacion')->with('msg', [
                'type' => 'success',
                'icon' => 'check',
                'body' => 'El Aporte de Evaluación fue eliminado correctamente.'
            ]);
        } catch (\Exception $e) {
            return redirect('aportes_evaluacion')->with('msg', [
                'type' => 'danger',
                'icon' => 'ban',
                'body' => 'El Aporte de Evaluación no se pudo eliminar correctamente...Error: ' . $e->getMessage()
            ]);
        }
    }
}