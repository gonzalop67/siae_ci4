<?php 
namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\Admin\Perfiles_model;
use App\Models\Admin\Institucion_model;
use App\Models\Admin\Periodos_lectivos_model;

class Login extends BaseController
{
    protected $perfiles;
    protected $institucion;
    protected $periodos_lectivos;

    public function __construct()
    {
        $this->perfiles = new Perfiles_model();
        $this->institucion = new Institucion_model();
        $this->periodos_lectivos = new Periodos_lectivos_model();
    }

    public function index()
	{
        $resultado = $this->institucion->obtenerDatos();
		$nombreInstitucion = $resultado[0]->in_nombre;

        $data = [
            "perfiles" => $this->perfiles->listarPerfiles(),
            "nombreInstitucion"  => $nombreInstitucion,
			"periodos_lectivos" => $this->periodos_lectivos->listarPeriodosLectivos()
		];

        return view('login', $data);
    }
}