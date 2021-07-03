<?php 
namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\Admin\Perfiles_model;
use App\Models\Admin\Usuarios_model;
use App\Models\Admin\Institucion_model;
use App\Models\Admin\Periodos_lectivos_model;

class Login extends BaseController
{
    protected $perfiles;
    protected $usuarios;
    protected $institucion;
    protected $periodos_lectivos;

    public function __construct()
    {
        $this->perfiles = new Perfiles_model();
        $this->usuarios = new Usuarios_model();
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

        if (session()->is_logged) {
            return redirect()->to(base_url('/dashboard'));
        } else {
            return view('login', $data);
        }
    }

    public function dashboard()
	{
		return view('dashboard');
	}

    public function signin()
	{
		$username           = $_POST["username"];
        $password           = $_POST["password"];
        $id_periodo_lectivo = $_POST["cboPeriodo"];
        $perfil             = $_POST["cboPerfil"];

		$datosUsuario = $this->usuarios->login($username, $password, $perfil);

		if (count($datosUsuario) > 0 && password_verify($password, $datosUsuario[0]['us_password'])) {
			$periodo     = $this->periodos_lectivos->getPeriodName($id_periodo_lectivo);
			$nom_periodo = $periodo[0]->pe_anio_inicio . " - " . $periodo[0]->pe_anio_fin;

			$resultado = $this->institucion->obtenerDatos();
			$nombreInstitucion = $resultado[0]->in_nombre;
			$urlInstitucion = $resultado[0]->in_url;
			
			$data = array(
                'id_usuario'         => $datosUsuario[0]['id_usuario'],
                'nombre'             => $datosUsuario[0]['primer_nombre'] . " " . $datosUsuario[0]['primer_apellido'],
                'foto'               => $datosUsuario[0]['us_foto'],
                'id_perfil'          => $datosUsuario[0]['id_perfil'],
                'rol_name'           => $datosUsuario[0]['pe_nombre'],
                'id_periodo_lectivo' => $id_periodo_lectivo,
                'periodo'            => $nom_periodo,
				'nomInstitucion'     => $nombreInstitucion,
				'urlInstitucion'     => $urlInstitucion,
                'is_logged'          => true,
            );
			
			$session = session();
			$session->set($data);

			return redirect()->to(base_url('auth/dashboard'));
		} else {
			return redirect()->to(base_url('/'))
					->with('msg', [
						'type' => 'danger',
						'icon' => 'ban',
						'body' => 'El Usuario, Contraseña y/o Perfil son incorrectos.'
					]);
		}
	}

    public function signout()
	{
		$session = session();
		$session->destroy();
		return redirect()->to(base_url('/'));
	}
}