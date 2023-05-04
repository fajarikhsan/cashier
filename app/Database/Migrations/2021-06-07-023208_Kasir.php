<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kasir extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_kasir'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'username' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
			],
			'password' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
			],
			'level' => [
				'type' => 'ENUM',
				'constraint' => ['1', '2'],
				'default' => '1',
			],
			'created_at' => [
				'type' => 'DATETIME',
				'null' => true,
			],
			'updated_at' => [
				'type' => 'DATETIME',
				'null' => true,
			],
		]);
		$this->forge->addKey('id_kasir', true);
		$this->forge->createTable('kasir');
	}

	public function down()
	{
		$this->forge->dropTable('kasir');
	}
}
