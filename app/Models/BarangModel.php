<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = "barang";
    protected $primaryKey = "id_barang";
    protected $useAutoIncrement = true;
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $allowedFields = ['kode_barang', 'nama_barang', 'harga_ecer', 'harga_modal', 'stok'];

    public function getStok($id)
    {
        return $this->db->table("barang")->select("stok")->getWhere(['id_barang' => $id])->getRowArray();
    }
}
