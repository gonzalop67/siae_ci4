<?php 
namespace App\Controllers\Admin;

use App\Models\Admin\Periodos_evaluacion_model;
use App\Models\Admin\Tipos_periodo_model;
use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;

class Periodos_evaluacion extends BaseController
{

    protected $reglas, $periodos_evaluacion, $periodos_lectivos, $tipos_periodo;

    public function __construct()
    {
        $this->periodos_evaluacion = new Periodos_evaluacion_model();
        $this->tipos_periodo = new Tipos_periodo_model();

        $this->reglas = [
            'pe_nombre' => [
                'rules' => 'required|max_length[24]',
                'errors' => [
                    'required'   => 'El campo Nombre es obligatorio.',
                    'max_length' => 'El campo Nombre no debe exceder los 24 caracteres.' 
                ]
            ],
            'pe_abreviatura' => [
                'rules' => 'required|max_length[6]',
                'errors' => [
                    'required'   => 'El campo Abreviatura es obligatorio.',
                    'max_length' => 'El campo Abreviatura no debe exceder los 6 caracteres.'
                ]
            ],
            'id_tipo_periodo' => [
                'rules' => 'required|is_not_unique[sw_tipo_periodo.id_tipo_periodo]',
                'errors' => [
                    'required' => 'El campo Tipo Periodo es obligatorio.',
                    'is_not_unique' => 'No existe la opción elegida en la base de datos.'
                ]
            ]
        ];
    }

    public function index()
    {
        return view('Admin/Periodos_evaluacion/index', [
            'periodos_evaluacion' => $this->periodos_evaluacion
                                     ->where('id_periodo_lectivo', session()->id_periodo_lectivo)
                                     ->paginate(config('Blog')->regPerPage),
            'pager' => $this->periodos_evaluacion->pager
        ]);
    }

    public function create()
    {
        $datos['tipos_periodo'] = $this->tipos_periodo->findAll();

        return view('Admin/Periodos_evaluacion/create', $datos);
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

        $this->periodos_evaluacion->save([
            'pe_nombre' => trim($_POST['pe_nombre']),
            'pe_abreviatura' => trim($_POST['pe_abreviatura']),
            'id_periodo_lectivo' => session()->id_periodo_lectivo,
            'id_tipo_periodo' => trim($_POST['id_tipo_periodo']) 
        ]);

        return redirect()->route('periodos_evaluacion')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'El Periodo de Evaluación fue guardado correctamente.'
        ]);
    }

    public function edit(string $id)
    {
        if (!$periodo_evaluacion = $this->periodos_evaluacion->find($id)) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('Admin/Periodos_evaluacion/edit', [
            'periodo_evaluacion' => $periodo_evaluacion,
            'tipos_periodo' => $this->tipos_periodo->findAll()
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

        $this->periodos_evaluacion->save([
            'id_periodo_evaluacion' => $_POST['id_periodo_evaluacion'],
            'pe_nombre' => trim($_POST['pe_nombre']),
            'pe_abreviatura' => trim($_POST['pe_abreviatura']),
            'id_tipo_periodo' => $_POST['id_tipo_periodo']
        ]);

        return redirect('periodos_evaluacion')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'El Periodo de Evaluación fue actualizado correctamente.'
        ]);
    }

    public function delete(string $id)
    {
        try {
            $this->periodos_evaluacion->delete($id);
    
            return redirect('periodos_evaluacion')->with('msg', [
                'type' => 'success',
                'icon' => 'check',
                'body' => 'El Periodo de Evaluación fue eliminado correctamente.'
            ]);
        } catch (\Exception $e) {
            return redirect('periodos_evaluacion')->with('msg', [
                'type' => 'danger',
                'icon' => 'ban',
                'body' => 'El Periodo de Evaluación no se pudo eliminar correctamente...Error: ' . $e->getMessage()
            ]);
        }
    }
}