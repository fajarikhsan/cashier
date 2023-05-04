<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">
                        <h1 class="text-center">Profile</h1>
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <!-- Profile Image -->
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle" src="<?= base_url(); ?>/img/default.png" alt="User profile picture" />
                                    </div>

                                    <h3 class="profile-username text-center"><?= session()->get('username'); ?></h3>

                                    <p class="text-muted text-center">
                                        <?= (session()->get('level') == "1") ? "Administrator" : "Kasir"; ?>
                                    </p>

                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Username</b> <a class="float-right">fajarikhsan</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Password</b> <a class="float-right">*********</a>
                                        </li>
                                    </ul>

                                    <a href="#" class="btn btn-primary btn-block"><b>Ubah</b></a>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>

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
<!-- /.content-wrapper -->
<?= $this->endSection(); ?>