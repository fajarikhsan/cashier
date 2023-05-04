<?php

namespace App\Models;

use CodeIgniter\Model;
use Hermawan\DataTables\DataTable;

class PenjualanModel extends Model
{
    protected $table = "penjualan";
    protected $primaryKey = 'id_penjualan';
    protected $useAutoIncrement = true;
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $allowedFields = ['id_barang', 'id_transaksi', 'qty'];

    public function getPenjualanByDate($start = null, $end = null)
    {
        if ($start == null || $end == null) {
            return $this->db->query("SELECT SUM(qty) AS barang_terjual
            FROM barang INNER JOIN penjualan ON barang.`id_barang` = penjualan.`id_barang`")->getRowArray();
        } else {
            return $this->db->query("SELECT SUM(qty) AS barang_terjual
            FROM barang INNER JOIN penjualan ON barang.`id_barang` = penjualan.`id_barang`
            WHERE DATE(penjualan.`created_at`) BETWEEN '$start' AND '$end'")->getRowArray();
        }
    }

    public function getKeuntunganByDate($start = null, $end = null)
    {
        if ($start == null || $end == null) {
            return $this->db->query("SELECT SUM(total) AS keuntungan
                FROM (SELECT ((harga_ecer - harga_modal) * SUM(qty)) AS total
                FROM barang INNER JOIN penjualan ON barang.`id_barang` = penjualan.`id_barang`
                GROUP BY penjualan.`id_barang`) AS totals")->getRowArray();
        } else {
            return $this->db->query("SELECT SUM(total) AS keuntungan
                FROM (SELECT ((harga_ecer - harga_modal) * SUM(qty)) AS total
                FROM barang INNER JOIN penjualan ON barang.`id_barang` = penjualan.`id_barang`
                WHERE DATE(penjualan.`created_at`) BETWEEN '$start' AND '$end'
                GROUP BY penjualan.`id_barang`) AS totals")->getRowArray();
        }
    }

    public function getLaporanBarang($start = null, $end = null)
    {
        if ($start == null || $end == null) {
            $builder = $this->db->table("barang")->select("kode_barang, nama_barang, harga_ecer, harga_modal, SUM(qty) AS terjual, ((harga_ecer - harga_modal) * SUM(qty)) AS keuntungan, (harga_ecer * SUM(qty)) AS harga_jual")->join("penjualan", "barang.id_barang = penjualan.id_barang", "inner")->groupBy("penjualan.`id_barang`");

            // $this->db->query("SELECT kode_barang, nama_barang, SUM(qty) AS terjual, harga_ecer, harga_modal, ((harga_ecer - harga_modal) * SUM(qty)) AS keuntungan
            // FROM barang INNER JOIN penjualan ON barang.`id_barang` = penjualan.`id_barang`
            // GROUP BY penjualan.`id_barang`");
        } else {
            $builder = $this->db->table("barang")->select("kode_barang, nama_barang, harga_ecer, harga_modal, SUM(qty) AS terjual, ((harga_ecer - harga_modal) * SUM(qty)) AS keuntungan, (harga_ecer * SUM(qty)) AS harga_jual")->join("penjualan", "barang.id_barang = penjualan.id_barang", "inner")->where("DATE(penjualan.`created_at`) BETWEEN '$start' AND '$end'")->groupBy("penjualan.`id_barang`");

            // $this->db->query("SELECT kode_barang, nama_barang, SUM(qty) AS terjual, harga_ecer, harga_modal, ((harga_ecer - harga_modal) * SUM(qty)) AS keuntungan
            //             FROM barang INNER JOIN penjualan ON barang.`id_barang` = penjualan.`id_barang`
            //             WHERE DATE(penjualan.`created_at`) BETWEEN '2021-07-03' AND '2021-07-05'
            //             GROUP BY penjualan.`id_barang`");
        }
        return DataTable::of($builder)->setSearchableColumns(['kode_barang', 'nama_barang'])->addNumbering("no")->toJson(true);
        // return $builder;
    }
}
