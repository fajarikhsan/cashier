<?php

namespace App\Controllers;

use App\Models\BarangMasukModel;
use App\Models\BarangModel;
use App\Models\BarangRejectModel;
use App\Models\KasirModel;
use App\Models\PenjualanModel;
use App\Models\TransaksiModel;
use TCPDF;

class Home extends BaseController
{
	protected $barangModel, $barangMasukModel, $barangRejectModel, $transaksiModel, $penjualanModel, $kasirModel;
	public function __construct()
	{
		$this->barangModel = new BarangModel();
		$this->barangMasukModel = new BarangMasukModel();
		$this->barangRejectModel = new BarangRejectModel();
		$this->transaksiModel = new TransaksiModel();
		$this->penjualanModel = new PenjualanModel();
		$this->kasirModel = new KasirModel();
		helper('number');
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

	public function index()
	{
		if (!$this->cekSession()) {
			session()->setFlashdata('akses-terlarang', 'Harap login terlebih dahulu.');
			return redirect()->to(base_url());
		} else {
			$data = [
				"halaman" => "index",
				"notifHampir" => $this->barangModel->where('stok <', 4)->where('stok >', 0)->findAll(),
				"notifHabis" => $this->barangModel->where('stok =', 0)->findAll()
			];
			return view('home/index', $data);
		}
	}

	public function daftarBarang()
	{
		if (!$this->cekSession()) {
			session()->setFlashdata('akses-terlarang', 'Harap login terlebih dahulu.');
			return redirect()->to(base_url());
		} else {
			if (!$this->cekAdmin()) {
				session()->setFlashdata('akses-terlarang', 'Anda bukan Administrator!');
				return redirect()->to(base_url("home"));
			} else {
				$data = [
					"halaman" => "daftar_barang",
					'validation' => \Config\Services::validation(),
					"dataBarang" => $this->barangModel->orderBy('id_barang', 'desc')->find(),
					"notifHampir" => $this->barangModel->where('stok <', 4)->where('stok >', 0)->findAll(),
					"notifHabis" => $this->barangModel->where('stok =', 0)->findAll()
				];
				return view("home/daftar_barang", $data);
			}
		}
	}

	public function tambahBarang()
	{
		if (!$this->cekSession()) {
			session()->setFlashdata('akses-terlarang', 'Harap login terlebih dahulu.');
			return redirect()->to(base_url());
		} else {
			if (!$this->cekAdmin()) {
				session()->setFlashdata('akses-terlarang', 'Anda bukan Administrator!');
				return redirect()->to(base_url("home"));
			} else {
				$data = [
					"halaman" => "tambah_barang",
					'validation' => \Config\Services::validation(),
					"kode_barang" => $this->barangModel->find(),
					"dataBarangMasuk" => $this->barangMasukModel->getAllBarangMasuk(),
					"notifHampir" => $this->barangModel->where('stok <', 4)->where('stok >', 0)->findAll(),
					"notifHabis" => $this->barangModel->where('stok =', 0)->findAll()
				];
				return view("home/tambah_barang", $data);
			}
		}
	}

	public function barangReject()
	{
		if (!$this->cekSession()) {
			session()->setFlashdata('akses-terlarang', 'Harap login terlebih dahulu.');
			return redirect()->to(base_url());
		} else {
			if (!$this->cekAdmin()) {
				session()->setFlashdata('akses-terlarang', 'Anda bukan Administrator!');
				return redirect()->to(base_url("home"));
			} else {
				$data = [
					"halaman" => "barang_reject",
					'validation' => \Config\Services::validation(),
					"kode_barang" => $this->barangModel->where('stok >', 0)->findAll(),
					"dataBarangReject" => $this->barangRejectModel->getAllBarangReject(),
					"notifHampir" => $this->barangModel->where('stok <', 4)->where('stok >', 0)->findAll(),
					"notifHabis" => $this->barangModel->where('stok =', 0)->findAll()
				];
				return view("home/barang_reject", $data);
			}
		}
	}

	public function profile()
	{
		if (!$this->cekSession()) {
			session()->setFlashdata('akses-terlarang', 'Harap login terlebih dahulu.');
			return redirect()->to(base_url());
		} else {
			$data = [
				"halaman" => "profile",
				"notifHampir" => $this->barangModel->where('stok <', 4)->where('stok >', 0)->findAll(),
				"notifHabis" => $this->barangModel->where('stok =', 0)->findAll()
			];
			return view("home/profile", $data);
		}
	}

	public function accounts()
	{
		if (!$this->cekSession()) {
			session()->setFlashdata('akses-terlarang', 'Harap login terlebih dahulu.');
			return redirect()->to(base_url());
		} else {
			if (!$this->cekAdmin()) {
				session()->setFlashdata('akses-terlarang', 'Anda bukan Administrator!');
				return redirect()->to(base_url("home"));
			} else {
				$data = [
					"halaman" => "accounts",
					"notifHampir" => $this->barangModel->where('stok <', 4)->where('stok >', 0)->findAll(),
					"notifHabis" => $this->barangModel->where('stok =', 0)->findAll(),
					'validation' => \Config\Services::validation(),
					'daftarAkun' => $this->kasirModel->findAll()
				];
				return view("home/accounts", $data);
			}
		}
	}

	public function barangBaru()
	{
		if (!$this->cekSession()) {
			session()->setFlashdata('akses-terlarang', 'Harap login terlebih dahulu.');
			return redirect()->to(base_url());
		} else {
			if (!$this->cekAdmin()) {
				session()->setFlashdata('akses-terlarang', 'Anda bukan Administrator!');
				return redirect()->to(base_url("home"));
			} else {
				// cek judul lama untuk ubah
				$getBarang = $this->barangModel->find($this->request->getVar("id_barang"));
				if (!empty($getBarang) && $getBarang['kode_barang'] == $this->request->getVar("kodeBarang")) {
					$ruleKode = 'required';
				} else {
					$ruleKode = 'required|is_unique[barang.kode_barang]';
				}

				// Validasi
				if (!$this->validate([
					'kodeBarang' => [
						'rules' => $ruleKode,
						'errors' => [
							'required' => 'Kode barang harus diisi.',
							'is_unique' => 'Kode barang sudah terdaftar.'
						]
					],
					'namaBarang' => [
						'rules' => 'required',
						'errors' => [
							'required' => 'Nama barang harus diisi.'
						]
					],
					'hargaEcer' => [
						'rules' => 'required|numeric',
						'errors' => [
							'required' => 'Harga ecer harus diisi.',
							'numeric' => 'Harga ecer hanya dapat bertipe angka saja.'
						]
					],
					'hargaModal' => [
						'rules' => 'required|numeric',
						'errors' => [
							'required' => 'Harga modal harus diisi.',
							'numeric' => 'Harga modal hanya dapat bertipe angka saja.'
						]
					]
				])) {
					session()->setFlashdata('tambah-barang-baru-gagal', 'Barang gagal ditambah.');
					return redirect()->to(base_url('/home/daftarbarang'))->withInput();
				}
				if ($this->request->getVar("id_barang") == "" || $this->request->getVar("id_barang") == null) {
					$data = [
						'kode_barang' => $this->request->getVar("kodeBarang"),
						'nama_barang' => $this->request->getVar("namaBarang"),
						'harga_ecer' => $this->request->getVar("hargaEcer"),
						'harga_modal' => $this->request->getVar("hargaModal"),
						'stok' => 0
					];
					session()->setFlashdata('tambah-barang-baru-berhasil', 'Barang berhasil ditambah.');
				} else {
					$data = [
						'id_barang' => $this->request->getVar("id_barang"),
						'kode_barang' => $this->request->getVar("kodeBarang"),
						'nama_barang' => $this->request->getVar("namaBarang"),
						'harga_ecer' => $this->request->getVar("hargaEcer"),
						'harga_modal' => $this->request->getVar("hargaModal")
					];
					session()->setFlashdata('tambah-barang-baru-berhasil', 'Barang berhasil diubah.');
				}
				$this->barangModel->save($data);
				return redirect()->to(base_url('/home/daftarbarang'));
			}
		}
	}

	public function cariKodeBarang()
	{
		echo json_encode($this->barangModel->find($this->request->getVar("id_barang")));
	}

	public function hapusKodeBarang($id)
	{
		$this->barangModel->delete($id);
		return redirect()->to(base_url('/home/daftarbarang'));
	}

	public function tambahStok()
	{
		// Validasi
		if (!$this->validate([
			'kodeBarang' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Kode Barang harus diisi.'
				]
			],
			'hargaBeli' => [
				'rules' => 'required|numeric',
				'errors' => [
					'required' => 'Harga Beli harus diisi.',
					'numeric' => 'Harga beli hanya dapat bertipe angka saja.'
				]
			],
			'namaSupplier' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Nama Supplier harus diisi.'
				]
			],
			'jumlahMasuk' => [
				'rules' => 'required|numeric',
				'errors' => [
					'required' => 'Jumlah Masuk harus diisi.',
					'numeric' => 'Jumlah masuk hanya dapat bertipe angka saja.'
				]
			]
		])) {
			session()->setFlashdata('tambah-stok-barang-gagal', 'Stok Barang gagal ditambah.');
			return redirect()->to(base_url('/home/tambahBarang'))->withInput();
		}

		$data = [
			'jumlah_masuk' => $this->request->getVar("jumlahMasuk"),
			'harga_beli' => $this->request->getVar("hargaBeli"),
			'nama_supplier' => $this->request->getVar("namaSupplier"),
			'id_barang' => $this->request->getVar("kodeBarang")
		];
		$this->barangMasukModel->save($data);

		// tambah stok

		$data_barang = [
			'id_barang' => $this->request->getVar("kodeBarang"),
			'stok' => $this->barangModel->getStok($this->request->getVar("kodeBarang"))["stok"] + $this->request->getVar("jumlahMasuk")
		];
		$this->barangModel->save($data_barang);
		session()->setFlashdata('tambah-stok-barang-berhasil', 'Stok Barang berhasil ditambah.');
		return redirect()->to(base_url('/home/tambahbarang'));
	}

	public function hapusStokBarang($id, $id_barang, $jumlahMasuk)
	{
		$data_barang = [
			'id_barang' => $id_barang,
			'stok' => $this->barangModel->getStok($id_barang)["stok"] - $jumlahMasuk
		];
		$this->barangModel->save($data_barang);
		$this->barangMasukModel->delete($id);
		return redirect()->to(base_url('/home/tambahbarang'));
	}

	public function tambahReject()
	{
		// Validasi
		if (!$this->validate([
			'kodeBarang' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Kode Barang harus diisi.'
				]
			],
			'jumlahReject' => [
				'rules' => 'required|numeric',
				'errors' => [
					'required' => 'Jumlah Reject harus diisi.',
					'numeric' => 'Jumlah reject hanya dapat bertipe angka saja.'
				]
			],
			'alasan' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Alasan harus diisi.'
				]
			]
		])) {
			session()->setFlashdata('tambah-barang-reject-gagal', 'Barang Reject gagal ditambah.');
			return redirect()->to(base_url('/home/barangreject'))->withInput();
		}

		$data = [
			'alasan' => $this->request->getVar("alasan"),
			'jumlah_reject' => $this->request->getVar("jumlahReject"),
			'id_barang' => $this->request->getVar("kodeBarang")
		];
		$this->barangRejectModel->save($data);

		// kurangi stok
		$data_barang = [
			'id_barang' => $this->request->getVar("kodeBarang"),
			'stok' => $this->barangModel->getStok($this->request->getVar("kodeBarang"))["stok"] - $this->request->getVar("jumlahReject")
		];
		$this->barangModel->save($data_barang);
		session()->setFlashdata('tambah-barang-reject-berhasil', 'Barang Reject berhasil ditambah.');
		return redirect()->to(base_url('/home/barangreject'));
	}

	public function hapusBarangReject($id, $id_barang, $jumlahReject)
	{
		$data_barang = [
			'id_barang' => $id_barang,
			'stok' => $this->barangModel->getStok($id_barang)["stok"] + $jumlahReject
		];
		$this->barangModel->save($data_barang);
		$this->barangRejectModel->delete($id);
		return redirect()->to(base_url('/home/barangreject'));
	}

	public function getStokById()
	{
		echo json_encode($this->barangModel->getStok($this->request->getVar("id"))["stok"]);
	}

	public function getKodeBarang()
	{
		echo json_encode($this->barangModel->where('kode_barang', $this->request->getVar('kode_barang'))->where('stok >', 0)->find());
	}

	public function getAllBarangWithStok()
	{
		echo json_encode($this->barangModel->where('stok >', 0)->find());
	}

	public function invoice()
	{
		$dataStruk = [];
		foreach ($this->request->getVar('cart') as $d) {
			$temp = $this->barangModel->find($d['id_barang']);
			$d['nama_barang'] = $temp['nama_barang'];
			$d['harga_ecer'] = $temp['harga_ecer'];
			$dataStruk[] = $d;
		}

		$view = [
			'subtotal' => $this->request->getVar('subtotal'),
			'diskon' => $this->request->getVar('subtotal') * ($this->request->getVar('diskon') / 100),
			'total' => $this->request->getVar('total'),
			'bayar' => $this->request->getVar('bayar'),
			'kembalian' => $this->request->getVar('kembalian'),
			'penjualan' => $dataStruk,
			'id_transaksi' => $this->transaksiModel->orderBy('id_transaksi', 'DESC')->first()['id_transaksi'] + 1,
			'username' => session()->get('username')
		];

		echo view('struk/index', $view);
	}

	public function simpanTransaksi()
	{
		$data = [
			'sub_total' => $this->request->getVar('subtotal'),
			'diskon' => $this->request->getVar('subtotal') * ($this->request->getVar('diskon') / 100),
			'total_harga' => $this->request->getVar('total'),
			'pembayaran' => $this->request->getVar('bayar'),
			'kembalian' => $this->request->getVar('kembalian'),
			'id_kasir' => session()->get('id_user')
		];

		$this->transaksiModel->save($data);

		$lastId = $this->transaksiModel->getInsertID();
		$dataJual = [];
		foreach ($this->request->getVar('cart') as $cart) {
			$cart['id_transaksi'] = $lastId;
			$dataJual[] = $cart;
		}

		$this->penjualanModel->insertBatch($dataJual);

		$kurangStok = [];
		foreach ($this->request->getVar('cart') as $cart) {
			$temp = [];
			$temp['id_barang'] = $cart['id_barang'];
			$temp['stok'] = $this->barangModel->getStok($cart['id_barang'])["stok"] - $cart['qty'];
			$kurangStok[] = $temp;
		}

		$this->barangModel->updateBatch($kurangStok, 'id_barang');
	}

	public function akunBaru()
	{
		// cek judul lama untuk ubah
		$getAkun = $this->kasirModel->find($this->request->getVar("id_kasir"));
		if (!empty($getAkun) && $getAkun['username'] == $this->request->getVar("username")) {
			$ruleKode = 'required';
		} else {
			$ruleKode = 'required|is_unique[kasir.username]';
		}

		// Validasi
		if (!$this->validate([
			'username' => [
				'rules' => $ruleKode,
				'errors' => [
					'required' => 'Username harus diisi.',
					'is_unique' => 'Username sudah terdaftar.'
				]
			],
			'password' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Password harus diisi.'
				]
			],
			'tipeUser' => [
				'rules' => 'required',
				'errors' => ['required' => "Tipe user harus diisi."]
			]
		])) {
			session()->setFlashdata('tambah-akun-gagal', 'Akun gagal ditambah.');
			return redirect()->to(base_url('/home/accounts'))->withInput();
		}
		if ($this->request->getVar("id_kasir") == "" || $this->request->getVar("id_kasir") == null) {
			$data = [
				'username' => $this->request->getVar("username"),
				'pass' => password_hash($this->request->getVar("password"), PASSWORD_DEFAULT),
				'level' => $this->request->getVar("tipeUser")
			];
			session()->setFlashdata('tambah-akun-berhasil', 'Akun berhasil ditambah.');
		} else {
			$data = [
				'id_kasir' => $this->request->getVar("id_kasir"),
				'username' => $this->request->getVar("username"),
				'pass' => password_hash($this->request->getVar("password"), PASSWORD_DEFAULT),
				'level' => $this->request->getVar("tipeUser")
			];
			session()->setFlashdata('tambah-akun-berhasil', 'Akun berhasil diubah.');
		}
		$this->kasirModel->save($data);
		return redirect()->to(base_url('/home/accounts'));
	}

	public function hapusAkun($id)
	{
		$this->kasirModel->delete($id);
		return redirect()->to(base_url('/home/accounts'));
	}

	public function cariAkun()
	{
		echo json_encode($this->kasirModel->find($this->request->getVar('id_kasir')));
	}

	public function logout()
	{
		session()->destroy();
		return redirect()->to(base_url());
	}

	public function cetakBayar()
	{
		$html = view('struk/index');

		$pdf = new TCPDF('P', 'mm', [48, 200], true, 'UTF-8', false);

		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Zhot Petshop');
		$pdf->SetTitle('Zhot Petshop');
		$pdf->SetSubject('Invoice');

		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetMargins(0, 0, 0, true);

		$pdf->addPage();

		// output the HTML content
		$pdf->writeHTML($html, true, false, true, false, '');
		//line ini penting
		$this->response->setContentType('application/pdf');
		//Close and output PDF document

		$pdf->Output('invoice.pdf', 'I');
		// redirect()->to('/home');
	}
}
