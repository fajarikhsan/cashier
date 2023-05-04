<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BarangMasuk extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_masuk'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'jumlah_masuk'       => [
				'type'       => 'INT',
				'constraint' => 11,
			],
			'harga_beli' => [
				'type' => 'INT',
				'constraint' => 11,
			],
			'nama_supplier' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
			],
			'created_at' => [
				'type' => 'DATETIME',
				'null' => true,
			],
			'updated_at' => [
				'type' => 'DATETIME',
				'null' => true,
			],
			'id_barang' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => true,
			],
		]);
		$this->forge->addKey('id_masuk', true);
		$this->forge->addForeignKey('id_barang', 'barang', 'id_barang', 'NO_ACTION', 'CASCADE');
		$this->forge->createTable('barang_masuk');
	}

	public function down()
	{
		$this->forge->dropTable('barang_masuk');
	}
}
