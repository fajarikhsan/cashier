<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangMasukModel extends Model
{
    protected $table = "barang_masuk";
    protected $primaryKey = "id_masuk";
    protected $useAutoIncrement = true;
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $allowedFields = ['jumlah_masuk', 'harga_beli', 'nama_supplier', 'id_barang'];

    public function getAllBarangMasuk()
    {
        return $this->db->table("barang_masuk")->select("*, barang_masuk.created_at as tgl_stok")->join("barang", "barang.id_barang = barang_masuk.id_barang", "inner")->orderBy('id_masuk', 'desc')->get()->getResultArray();
    }
}
