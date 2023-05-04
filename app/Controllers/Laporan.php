<?php

namespace App\Controllers;

use App\Models\BarangMasukModel;
use App\Models\BarangModel;
use App\Models\BarangRejectModel;
use App\Models\PenjualanModel;
use App\Models\TransaksiModel;

class Laporan extends BaseController
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
            if (!$this->cekAdmin()) {
                session()->setFlashdata('akses-terlarang', 'Anda bukan Administrator!');
                return redirect()->to(base_url("home"));
            } else {
                $data = [
                    'halaman' => 'laporan',
                    "notifHampir" => $this->barangModel->where('stok <', 4)->where('stok >', 0)->findAll(),
                    "notifHabis" => $this->barangModel->where('stok =', 0)->findAll(),
                    "total_transaksi" => $this->transaksiModel->totalTransaksi(),
                    'total_pendapatan' => $this->transaksiModel->totalPendapatan(),
                    'total_diskon' => $this->transaksiModel->totalDiskon(),
                    'subtotal_pendapatan' => $this->transaksiModel->subtotalPendapatan(),
                    'barang_terjual' => $this->penjualanModel->getPenjualanByDate(),
                    'total_keuntungan' => $this->penjualanModel->getKeuntunganByDate()
                ];
                return view('laporan/index', $data);
            }
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

    public function cekAdmin()
    {
        if (session()->get('level') != "1") {
            return false;
        } else {
            return true;
        }
    }

    public function aturTanggal()
    {
        $startDate = $this->request->getVar('startDate');
        $endDate = $this->request->getVar('endDate');

        $data = [
            "total_transaksi" => $this->transaksiModel->totalTransaksi($startDate, $endDate)['total_transaksi'],
            'total_pendapatan' => $this->transaksiModel->totalPendapatan($startDate, $endDate)['total_pendapatan'],
            'total_diskon' => $this->transaksiModel->totalDiskon($startDate, $endDate)['total_diskon'],
            'subtotal_pendapatan' => $this->transaksiModel->subtotalPendapatan($startDate, $endDate)['subtotal_pendapatan'],
            'barang_terjual' => $this->penjualanModel->getPenjualanByDate($startDate, $endDate)['barang_terjual'],
            'total_keuntungan' => $this->penjualanModel->getKeuntunganByDate($startDate, $endDate)['keuntungan']
        ];
        echo json_encode($data);
    }

    public function laporanDatatable()
    {
        return $this->penjualanModel->getLaporanBarang();
        // $db = db_connect();
        // $builder = $db->table("barang")->select("SELECT kode_barang, nama_barang, harga_ecer, harga_modal, SUM(qty) AS terjual, ((harga_ecer - harga_modal) * SUM(qty)) AS keuntungan")->join("barang", "barang.id_barang = penjualan.id_barang", "inner");
        // return DataTable::of($builder)->toJson(true);
    }

    public function laporanDatatableWithDate()
    {
        $startDate = $this->request->getVar('startDate');
        $endDate = $this->request->getVar('endDate');

        return $this->penjualanModel->getLaporanBarang($startDate, $endDate);
    }
}
