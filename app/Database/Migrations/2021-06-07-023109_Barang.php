<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Barang extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_barang'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'kode_barang'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'nama_barang' => [
				'type' => 'VARCHAR',
				'constraint' => '1000',
			],
			'harga_ecer' => [
				'type' => 'INT',
				'constraint' => 11,
				'null' => true,
			],
			'harga_modal' => [
				'type' => 'INT',
				'constraint' => 11,
				'null' => true,
			],
			'stok' => [
				'type' => 'INT',
				'constraint' => 11,
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
		$this->forge->addKey('id_barang', true);
		$this->forge->createTable('barang');
	}

	public function down()
	{
		$this->forge->dropTable('barang');
	}
}
