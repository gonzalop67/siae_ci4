<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwTipoEducacion extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_tipo_educacion'  => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'te_nombre' => [
				'type'       => 'VARCHAR',
				'constraint' => '48',
			],
			'te_bachillerato' => [
				'type'       => 'INT',
				'constraint' => 1,
				'unsigned'   => true,
			],
			'te_orden' => [
				'type'       => 'INT',
				'constraint' => 11,
				'unsigned'   => true,
				'default'    => 0,
			],
		]);
		$this->forge->addKey('id_tipo_educacion', true);
		$this->forge->createTable('sw_tipo_educacion');
	}

	public function down()
	{
		$this->forge->dropTable('sw_tipo_educacion');
	}
}
