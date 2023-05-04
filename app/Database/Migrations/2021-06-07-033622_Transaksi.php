<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transaksi extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_transaksi'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'sub_total'       => [
				'type'       => 'INT',
				'constraint' => 11,
			],
			'diskon' => [
				'type' => 'INT',
				'constraint' => 11,
			],
			'total_harga' => [
				'type' => 'INT',
				'constraint' => 11,
			],
			'pembayaran' => [
				'type' => 'INT',
				'constraint' => 11,
			],
			'kembalian' => [
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
			'id_kasir' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => true,
			],
		]);
		$this->forge->addKey('id_transaksi', true);
		$this->forge->addForeignKey('id_kasir', 'kasir', 'id_kasir', 'NO_ACTION', 'CASCADE');
		$this->forge->createTable('transaksi');
	}

	public function down()
	{
		$this->forge->dropTable('transaksi');
	}
}
