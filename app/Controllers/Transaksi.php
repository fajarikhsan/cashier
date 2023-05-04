<?php

namespace App\Controllers;

use App\Models\BarangMasukModel;
use App\Models\BarangModel;
use App\Models\BarangRejectModel;
use App\Models\PenjualanModel;
use App\Models\TransaksiModel;

class Transaksi extends BaseController
{
    protected $barangModel, $barangMasukModel, $barangRejectModel, $transaksiModel, $penjualanModel;
    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->barangMasukModel = new BarangMasukModel();
        $this->barangRejectModel = new BarangRejectModel();
        $this->transaksiModel = new TransaksiModel();
        $this->penjualanModel = new PenjualanModel();
        helper('number');
    }
    public function index()
    {
        // index
        if (!$this->cekSession()) {
            session()->setFlashdata('akses-terlarang', 'Harap login terlebih dahulu.');
            return redirect()->to(base_url());
        } else {
            $data = [
                'halaman' => 'daftar_transaksi',
                'dataTransaksi' => $this->transaksiModel->orderBy('id_transaksi', 'desc')->findAll(),
                "notifHampir" => $this->barangModel->where('stok <', 4)->where('stok >', 0)->findAll(),
                "notifHabis" => $this->barangModel->where('stok =', 0)->findAll()
            ];
            return view('transaksi/index', $data);
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

    public function invoice()
    {
        // $dataStruk = [];
        // foreach ($this->request->getVar('cart') as $d) {
        //     $temp = $this->barangModel->find($d['id_barang']);
        //     $d['nama_barang'] = $temp['nama_barang'];
        //     $d['harga_ecer'] = $temp['harga_ecer'];
        //     $dataStruk[] = $d;
        // }

        $view = [
            'subtotal' => $this->request->getVar('subtotal'),
            'diskon' => $this->request->getVar('diskon'),
            'total' => $this->request->getVar('total'),
            'bayar' => $this->request->getVar('pembayaran'),
            'kembalian' => $this->request->getVar('kembalian'),
            'penjualan' => $this->request->getVar('data'),
            'id_transaksi' => $this->transaksiModel->getUserId($this->request->getVar('id_transaksi'))['id_transaksi'],
            'username' => $this->transaksiModel->getUserId($this->request->getVar('id_transaksi'))['username']
        ];

        echo view('struk/index', $view);
    }

    public function getTransaksiById()
    {
        echo json_encode($this->transaksiModel->getAllTransaksi($this->request->getVar('id_transaksi')));
    }
}
