<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<!-- flashdata -->
<div class="flash-akun-gagal" data-flashdata="<?= session()->getFlashdata('tambah-akun-gagal'); ?>"></div>
<div class="flash-akun-berhasil" data-flashdata="<?= session()->getFlashdata('tambah-akun-berhasil'); ?>"></div>
<div class="akses-terlarang" data-flashdata="<?= session()->getFlashdata('akses-terlarang'); ?>"></div>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="card card-olive">
                <div class="card-header">
                    <h3 class="card-title">
                        <h1 class="text-center">Pengaturan Akun</h1>
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#tambahAkunModal" id="btnTambahAkun">Tambah Akun</button>
                    <hr>
                    <table class="table table-bordered table-hover table-striped bg-light" id="myTable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Terakhir Update</th>
                                <th scope="col">Username</th>
                                <th scope="col">Tipe Akun</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($daftarAkun as $d) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $d['updated_at']; ?></td>
                                    <td><?= $d['username']; ?></td>
                                    <td><?= ($d['level'] == "1") ? "Administrator" : "Kasir" ?></td>
                                    <td>
                                        <button name="editAkun" data-id="<?= $d['id_kasir']; ?>" class="btn btn-info btnEditAkun" data-toggle="modal" data-target="#tambahAkunModal"><i class="fas fa-edit"></i></button>
                                        <button name="hapusAkun" data-id="<?= $d['id_kasir']; ?>" class="btn btn-danger btnHapusAkun"><i class="fas fa-trash-alt"></i></button>
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
<div class="modal fade" id="tambahAkunModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahAkunLabel">Tambah Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url("home/akunBaru"); ?>" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id_kasir" id="id_kasir" value="<?= old('id_kasir'); ?>">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control <?= ($validation->hasError('username') ? "is-invalid" : ""); ?>" id="username" name="username" value="<?= old('username'); ?>" autofocus>
                        <?php if ($validation->getError('username')) : ?>
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('username'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control <?= ($validation->hasError('password') ? "is-invalid" : ""); ?>" id="password" name="password" value="<?= old('password'); ?>">
                        <?php if ($validation->getError('password')) : ?>
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('password'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="tipeUser">Tipe User</label>
                        <select class="form-control <?= ($validation->hasError('tipeUser') ? "is-invalid" : ""); ?>" name="tipeUser" value="<?= old('tipeUser'); ?>">
                            <option value="1">Administrator</option>
                            <option value="2">Kasir</option>
                        </select>
                        <?php if ($validation->getError('tipeUser')) : ?>
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('tipeUser'); ?>
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

<!-- /.content-wrapper -->
<?= $this->endSection(); ?>