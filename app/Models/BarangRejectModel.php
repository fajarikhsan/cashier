<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangRejectModel extends Model
{
    protected $table = "barang_reject";
    protected $primaryKey = "id_reject";
    protected $useAutoIncrement = true;
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $allowedFields = ['alasan', 'jumlah_reject', 'id_barang'];

    public function getAllBarangReject()
    {
        return $this->db->table("barang_reject")->select("*, barang_reject.created_at as tgl_reject")->join("barang", "barang.id_barang = barang_reject.id_barang", "inner")->orderBy('id_reject', 'desc')->get()->getResultArray();
    }
}
