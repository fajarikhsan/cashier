<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<!-- flashdata -->
<div class="flash-barang-baru-gagal" data-flashdata="<?= session()->getFlashdata('tambah-barang-baru-gagal'); ?>"></div>
<div class="flash-barang-baru-berhasil" data-flashdata="<?= session()->getFlashdata('tambah-barang-baru-berhasil'); ?>"></div>
<div class="akses-terlarang" data-flashdata="<?= session()->getFlashdata('akses-terlarang'); ?>"></div>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="card card-olive">
                <div class="card-header">
                    <h3 class="card-title">
                        <h1 class="text-center">Daftar Barang</h1>
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#tambahKodeBarang" id="btnTambahKodeBarang">Tambah Kode Barang</button>
                    <hr>
                    <table class="table table-bordered table-hover table-striped bg-light" id="daftarBarangTable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Barang</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Harga Modal</th>
                                <th scope="col">Harga Ecer</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($dataBarang as $barang) : ?>
                                <tr>
                                    <th scope="row"><?= $i++; ?></th>
                                    <td><?= $barang['kode_barang']; ?></td>
                                    <td><?= $barang['nama_barang']; ?></td>
                                    <td><?= number_to_currency($barang['harga_modal'], 'Rp. '); ?></td>
                                    <td><?= number_to_currency($barang['harga_ecer'], 'Rp. '); ?></td>
                                    <td><?= $barang['stok']; ?></td>
                                    <td>
                                        <button name="EditBarang" data-id="<?= $barang['id_barang']; ?>" value="Ubah" class="btn btn-info btnEditBarang" data-toggle="modal" data-target="#tambahKodeBarang"><i class="fas fa-edit"></i></button>
                                        <button name="CetakBarang" data-kode="<?= $barang['kode_barang']; ?>" data-nama="<?= $barang['nama_barang']; ?>" data-harga="<?= $barang['harga_ecer']; ?>" value="Hapus" class="btn btn-warning btnCetakBarcode" data-toggle="modal" data-target="#cetakBarcodeBarang"><i class="fas fa-print"></i></button>
                                        <button name="HapusBarang" data-id="<?= $barang['id_barang']; ?>" value="Hapus" class="btn btn-danger btnHapusBarang"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

<!-- Modal Tambah Kode Barang -->
<div class="modal fade" id="tambahKodeBarang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kode Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url("home/barangBaru"); ?>" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id_barang" id="id_barang" value="<?= old('id_barang'); ?>">
                    <div class="form-group">
                        <label for="kodeBarang">Kode Barang</label>
                        <input type="text" class="form-control <?= ($validation->hasError('kodeBarang') ? "is-invalid" : ""); ?>" id="kodeBarang" name="kodeBarang" value="<?= old('kodeBarang'); ?>" autofocus>
                        <input type="button" class="btn btn-light text-primary" id="randomCode" value="Randomize">
                        <?php if ($validation->getError('kodeBarang')) : ?>
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('kodeBarang'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="namaBarang">Nama Barang</label>
                        <input type="text" class="form-control <?= ($validation->hasError('namaBarang') ? "is-invalid" : ""); ?>" id="namaBarang" name="namaBarang" value="<?= old('namaBarang'); ?>">
                        <?php if ($validation->getError('namaBarang')) : ?>
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('namaBarang'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="hargaModal">Harga Modal</label>
                        <input type="number" class="form-control <?= ($validation->hasError('hargaModal') ? "is-invalid" : ""); ?>" id="hargaModal" name="hargaModal" value="<?= old('hargaModal'); ?>" min="0">
                        <?php if ($validation->getError('hargaModal')) : ?>
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('hargaModal'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="hargaEcer">Harga Ecer</label>
                        <input type="number" class="form-control <?= ($validation->hasError('hargaEcer') ? "is-invalid" : ""); ?>" id="hargaEcer" name="hargaEcer" value="<?= old('hargaEcer'); ?>" min="0">
                        <?php if ($validation->getError('hargaEcer')) : ?>
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('hargaEcer'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="cetakBarcodeBarang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cetak Barcode</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-3">
                            Nama Barang
                        </div>
                        <div class="col">
                            <span class="barcodeNama"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            Kode Barang
                        </div>
                        <div class="col">
                            <span id="barcodeKode"></span>
                        </div>
                    </div>
                    <div class="row mt-2 mb-2">
                        <div class="col">
                            Expired
                        </div>
                        <div class="col">
                            <input id="datepicker" />
                            <!-- <div class="form-group">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" placeholder="Peride Tanggal" aria-label="Peride Tanggal" aria-describedby="button-addon2" value="<?= date("d-m-Y", strtotime('+7 days')); ?>" id="expiredDate">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="expiredCalendar"><i class="fas fa-calendar"></i></button>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            Banyak Print Barcode
                        </div>
                        <div class="col">
                            <input type="number" name="qtyBarcode" id="qtyBarcode" min="1" value="1">
                        </div>
                    </div>
                    <div id="barcodeContainer" class="mt-2">
                        <div class="children">
                            <p class="barcodeNama m-0"></p>
                            <p class="barcodeHarga m-0"></p>
                            <p class="expired" class="m-0"></p>
                            <p>
                                <svg class="barcodeShow"></svg>
                            </p>
                        </div>
                    </div>
                    <div id="barcodeGone" class="mt-2">
                        <div class="children">
                            <p class="barcodeNama m-0 barcodeGone"></p>
                            <p class="barcodeHarga m-0 barcodeGone"></p>
                            <p class="expired m-0 barcodeGone"></p>
                            <p>
                                <svg class="barcodeShow barcodeGone"></svg>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" id="cetakBarcode">Cetak</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- /.content-wrapper -->
<?= $this->endSection(); ?>