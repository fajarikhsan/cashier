<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BarangReject extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_reject'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'alasan'       => [
				'type'       => 'VARCHAR',
				'constraint' => '1000',
			],
			'jumlah_reject' => [
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
			'id_barang' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => true,
			],
		]);
		$this->forge->addKey('id_reject', true);
		$this->forge->addForeignKey('id_barang', 'barang', 'id_barang', 'NO_ACTION', 'CASCADE');
		$this->forge->createTable('barang_reject');
		// $this->db->query('ALTER TABLE `barang_reject` ADD FOREIGN KEY(`id_barang`) REFERENCES barang(`id_barang`) ON DELETE NO ACTION ON UPDATE CASCADE;');
	}

	public function down()
	{
		$this->forge->dropTable('barang_reject');
	}
}
