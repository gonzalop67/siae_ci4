<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ModalidadSeeder extends Seeder
{
	public function run()
	{
		$modalidades = [
			[
				'mo_nombre' => 'PRESENCIAL',
				'mo_activo' => 1
			],
			[
				'mo_nombre' => 'VIRTUAL',
				'mo_activo' => 0
			],
		];

		$builder = $this->db->table('sw_modalidad');
		$builder->insertBatch($modalidades);
	}
}
