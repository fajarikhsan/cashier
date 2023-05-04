<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<!-- flashdata -->
<div class="flash-stok-barang-gagal" data-flashdata="<?= session()->getFlashdata('tambah-stok-barang-gagal'); ?>"></div>
<div class="flash-stok-barang-berhasil" data-flashdata="<?= session()->getFlashdata('tambah-stok-barang-berhasil'); ?>"></div>
<div class="akses-terlarang" data-flashdata="<?= session()->getFlashdata('akses-terlarang'); ?>"></div>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="card card-olive">
                <div class="card-header">
                    <h3 class="card-title">
                        <h1 class="text-center">Tambah Barang</h1>
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#tambahStokBarang">Tambah Stok Barang</button>
                    <hr>
                    <table class="table table-bordered table-hover table-striped bg-light" id="tambahBarangTable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <td scope="col">Tanggal</td>
                                <td scope="col">Kode Barang</td>
                                <td scope="col">Nama Barang</td>
                                <td scope="col">Harga Beli</td>
                                <td scope="col">Nama Supplier</td>
                                <td scope="col">Jumlah Masuk</td>
                                <td scope="col">Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($dataBarangMasuk as $d) : ?>
                                <tr>
                                    <th scope="row"><?= $i++; ?></th>
                                    <td><?= $d['tgl_stok']; ?></td>
                                    <td><?= $d['kode_barang']; ?></td>
                                    <td><?= $d['nama_barang']; ?></td>
                                    <td><?= number_to_currency($d['harga_beli'], 'IDR'); ?></td>
                                    <td><?= $d['nama_supplier']; ?></td>
                                    <td><?= $d['jumlah_masuk']; ?></td>
                                    <td>
                                        <button value="Hapus" class="btn btn-danger btnHapusStok" data-id="<?= $d['id_masuk']; ?>" data-id_barang="<?= $d['id_barang']; ?>" data-jumlah_masuk="<?= $d['jumlah_masuk']; ?>"> <i class="fas fa-trash-alt"></i> </button>
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

<!-- Modal Tambah Stok Barang -->
<div class="modal fade" id="tambahStokBarang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Stok Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url("home/tambahStok"); ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="kodeBarang">Kode Barang</label>
                        <select class="form-group <?= ($validation->hasError('kodeBarang') ? "is-invalid" : ""); ?>" id="select-beast" name="kodeBarang" value="<?= old('kodeBarang'); ?>">
                            <option></option>
                            <?php foreach ($kode_barang as $brg) : ?>
                                <option value="<?= $brg['id_barang']; ?>"><?= $brg['kode_barang']; ?> | <?= $brg['nama_barang']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php if ($validation->getError('kodeBarang')) : ?>
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('kodeBarang'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="hargaBeli">Harga Beli</label>
                        <input type="number" class="form-control <?= ($validation->hasError('hargaBeli') ? "is-invalid" : ""); ?>" id="hargaBeli" name="hargaBeli" value="<?= old('hargaBeli'); ?>" min="0">
                        <?php if ($validation->getError('hargaBeli')) : ?>
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('hargaBeli'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="namaSupplier">Nama Supplier</label>
                        <input type="text" class="form-control <?= ($validation->hasError('namaSupplier') ? "is-invalid" : ""); ?>" id="namaSupplier" name="namaSupplier" value="<?= old('namaSupplier'); ?>">
                        <?php if ($validation->getError('namaSupplier')) : ?>
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('namaSupplier'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="jumlahMasuk">Jumlah Masuk</label>
                        <input type="number" class="form-control <?= ($validation->hasError('jumlahMasuk') ? "is-invalid" : ""); ?>" id="jumlahMasuk" name="jumlahMasuk" value="<?= old('jumlahMasuk'); ?>" min="0">
                        <?php if ($validation->getError('jumlahMasuk')) : ?>
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('jumlahMasuk'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- /.content-wrapper -->
<?= $this->endSection(); ?>