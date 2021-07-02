<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PrimerPeriodoLectivoSeeder extends Seeder
{
	public function run()
	{
		$data = [
			'id_periodo_estado' => '1',
			'id_modalidad' => 1,
			'pe_anio_inicio' => date("Y"),
            'pe_anio_fin' => date("Y") + 1
		];
	
		// Using Query Builder
		$this->db->table('sw_periodo_lectivo')->insert($data);
	}
}
