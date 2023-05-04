<?php

namespace App\Controllers;

use App\Models\BarangModel;

class Hotkey extends BaseController
{
    protected $barangModel;
    public function __construct()
    {
        $this->barangModel = new BarangModel();
    }
    public function index()
    {
        if (!$this->cekSession()) {
            session()->setFlashdata('akses-terlarang', 'Harap login terlebih dahulu.');
            return redirect()->to(base_url());
        } else {
            // index
            $data = [
                "halaman" => "hotkey",
                "notifHampir" => $this->barangModel->where('stok <', 4)->where('stok >', 0)->findAll(),
                "notifHabis" => $this->barangModel->where('stok =', 0)->findAll()
            ];
            return view('home/hotkey', $data);
        }
    }

    public function cekSession()
    {
        if (!session()->has('username') || !session()->has('level')) {
            return false;
        } else {
            return true;
        }
    }
}
