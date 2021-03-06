<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitSeeder extends Seeder
{
	public function run()
	{
		$this->truncateTablas([
			'sw_area',
			'sw_asignatura',
			'sw_curso',
			'sw_especialidad',
			'sw_institucion',
			'sw_jornada',
			'sw_menu',
			'sw_menu_perfil',
			'sw_modalidad',
			'sw_perfil',
            'sw_periodo_estado',
			'sw_periodo_lectivo',
			'sw_tipo_aporte',
			'sw_tipo_asignatura',
			'sw_tipo_educacion',
			'sw_tipo_periodo',
			'sw_periodo_evaluacion',
			'sw_usuario',
			'sw_usuario_perfil'
        ]);
		$this->call('AreaSeeder');
		$this->call('InstitucionSeeder');
		$this->call('JornadaSeeder');
		$this->call('ModalidadSeeder');
		$this->call('NivelEducacionSeeder');
		$this->call('EspecialidadSeeder');
		$this->call('PerfilSeeder');
		$this->call('PeriodoEstadoSeeder');
		$this->call('PrimerPeriodoLectivoSeeder');
		$this->call('TipoAsignaturaSeeder');
		$this->call('TipoPeriodoSeeder');
		$this->call('PeriodoEvaluacionSeeder');
		$this->call('TipoAporteSeeder');
		$this->call('UsuarioAdministradorSeeder');
		$this->call('MenuAdministradorSeeder');
        $this->call('MenuAutoridadSeeder');
	}

	protected function truncateTablas(array $tablas)
    {
        $this->db->disableForeignKeyChecks();
        foreach ($tablas as $tabla) {
            $this->db->table($tabla)->truncate();
        }
        $this->db->enableForeignKeyChecks();
    }
}
