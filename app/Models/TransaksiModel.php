<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = "transaksi";
    protected $primaryKey = "id_transaksi";
    protected $useAutoIncrement = true;
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $allowedFields = ['sub_total', 'diskon', 'total_harga', 'pembayaran', 'kembalian', 'id_kasir'];

    public function getAllTransaksi($id)
    {
        return $this->db->table("penjualan")->select("*")->join("barang", "barang.id_barang = penjualan.id_barang", "inner")->where('id_transaksi', $id)->get()->getResultArray();
    }

    public function totalTransaksi($awal = null, $akhir = null)
    {
        if ($awal == null && $akhir == null) {
            return $this->db->table("transaksi")->select("count(id_transaksi) as total_transaksi")->get()->getRowArray();
        } else {
            return $this->db->table("transaksi")->select("count(id_transaksi) as total_transaksi")->where("DATE(created_at) BETWEEN '$awal' AND '$akhir'")->get()->getRowArray();
        }
    }

    public function totalPendapatan($awal = null, $akhir = null)
    {
        if ($awal == null && $akhir == null) {
            return $this->db->table("transaksi")->select("sum(total_harga) as total_pendapatan")->get()->getRowArray();
        } else {
            return $this->db->table("transaksi")->select("sum(total_harga) as total_pendapatan")->where("DATE(created_at) BETWEEN '$awal' AND '$akhir'")->get()->getRowArray();
        }
    }

    public function totalDiskon($awal = null, $akhir = null)
    {
        if ($awal == null && $akhir == null) {
            return $this->db->table("transaksi")->select("sum(diskon) as total_diskon")->get()->getRowArray();
        } else {
            return $this->db->table("transaksi")->select("sum(diskon) as total_diskon")->where("DATE(created_at) BETWEEN '$awal' AND '$akhir'")->get()->getRowArray();
        }
    }

    public function subtotalPendapatan($awal = null, $akhir = null)
    {
        if ($awal == null && $akhir == null) {
            return $this->db->table("transaksi")->select("sum(sub_total) as subtotal_pendapatan")->get()->getRowArray();
        } else {
            return $this->db->table("transaksi")->select("sum(sub_total) as subtotal_pendapatan")->where("DATE(created_at) BETWEEN '$awal' AND '$akhir'")->get()->getRowArray();
        }
    }

    public function getUserId($id)
    {
        return $this->db->table("transaksi")->select("*")->join("kasir", "transaksi.id_kasir = kasir.id_kasir", "inner")->where("id_transaksi", $id)->get()->getRowArray();
    }
}
