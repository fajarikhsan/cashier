<?php

namespace App\Models;

use CodeIgniter\Model;

class KasirModel extends Model
{
    protected $table = "kasir";
    protected $primaryKey = "id_kasir";
    protected $useAutoIncrement = true;
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $allowedFields = ['username', 'pass', 'level'];
}
