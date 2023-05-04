<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<!-- flashdata -->
<div class="flash-barang-reject-gagal" data-flashdata="<?= session()->getFlashdata('tambah-barang-reject-gagal'); ?>"></div>
<div class="flash-barang-reject-berhasil" data-flashdata="<?= session()->getFlashdata('tambah-barang-reject-berhasil'); ?>"></div>
<div class="akses-terlarang" data-flashdata="<?= session()->getFlashdata('akses-terlarang'); ?>"></div>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="card card-olive">
                <div class="card-header">
                    <h3 class="card-title">
                        <h1 class="text-center">Barang Reject</h1>
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <button type="button" class="btn btn-primary  btn-lg" data-toggle="modal" data-target="#tambahBarangReject">Tambah Barang Reject</button>
                    <hr>
                    <table class="table table-bordered table-hover table-striped bg-light" id="barangRejectTable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <td scope="col">Tanggal Reject</td>
                                <td scope="col">Kode Barang</td>
                                <td scope="col">Nama Barang</td>
                                <td scope="col">Jumlah Reject</td>
                                <td scope="col">Alasan</td>
                                <td scope="col">Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($dataBarangReject as $rjt) : ?>
                                <tr>
                                    <th scope="row"><?= $i++; ?></th>
                                    <td><?= $rjt['tgl_reject']; ?></td>
                                    <td><?= $rjt['kode_barang']; ?></td>
                                    <td><?= $rjt['nama_barang']; ?></td>
                                    <td><?= $rjt['jumlah_reject']; ?></td>
                                    <td><?= $rjt['alasan']; ?></td>
                                    <td>
                                        <button value="Hapus" class="btn btn-danger btnHapusReject" data-id="<?= $rjt['id_reject']; ?>" data-id_barang="<?= $rjt['id_barang']; ?>" data-jumlah_reject="<?= $rjt['jumlah_reject']; ?>"><i class="fas fa-trash-alt"></i></button>
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

<!-- Modal Tambah Barang Reject-->
<div class="modal fade" id="tambahBarangReject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Barang Reject</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url("home/tambahReject"); ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="kodeBarang">Kode Barang</label>
                        <select class="form-group kodeBarangReject <?= ($validation->hasError('kodeBarang') ? "is-invalid" : ""); ?>" id="select-beast" name="kodeBarang" value="<?= old('kodeBarang'); ?>">
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
                        <label for="jumlahReject" id="labelReject">Jumlah Reject</label>
                        <input type="number" class="form-control maxReject <?= ($validation->hasError('jumlahReject') ? "is-invalid" : ""); ?>" id="jumlahReject" name="jumlahReject" value="<?= old('jumlahReject'); ?>" min="0">
                        <?php if ($validation->getError('jumlahReject')) : ?>
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('jumlahReject'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="alasan">Alasan</label>
                        <input type="text" class="form-control <?= ($validation->hasError('alasan') ? "is-invalid" : ""); ?>" id="alasan" name="alasan" value="<?= old('alasan'); ?>">
                        <?php if ($validation->getError('alasan')) : ?>
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('alasan'); ?>
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