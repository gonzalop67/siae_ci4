<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwCurso extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_curso' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'id_especialidad' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'id_curso_superior' => [
				'type'       => 'INT',
				'constraint' => 11,
				'unsigned'   => true,
			],
			'cu_nombre' => [
				'type'       => 'VARCHAR',
				'constraint' => '128',
			],
			'cu_shortname' => [
				'type'       => 'VARCHAR',
				'constraint' => '45',
			],
			'cu_abreviatura' => [
				'type'       => 'VARCHAR',
				'constraint' => '5',
			],
			'cu_orden' => [
				'type'       => 'INT',
				'constraint' => 11,
				'unsigned'   => true,
				'default'    => 0,
			],
			'quien_inserta_comp' => [
				'type'       => 'INT',
				'constraint' => 1,
				'unsigned'   => true,
				'default'    => 0,
			],			
		]);
		$this->forge->addKey('id_curso', true);
		$this->forge->addForeignKey('id_especialidad','sw_especialidad','id_especialidad');
		$this->forge->createTable('sw_curso');
	}

	public function down()
	{
		$this->forge->dropTable('sw_curso');
	}
}
