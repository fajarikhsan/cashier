<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Penjualan extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_barang' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => true,
			],
			'id_transaksi' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => true,
			],
		]);
		$this->forge->addForeignKey('id_barang', 'barang', 'id_barang', 'NO_ACTION', 'CASCADE');
		$this->forge->addForeignKey('id_transaksi', 'transaksi', 'id_transaksi', 'NO_ACTION', 'CASCADE');
		$this->forge->createTable('penjualan');
	}

	public function down()
	{
		$this->forge->dropTable('penjualan');
	}
}
