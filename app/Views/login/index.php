<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zhot Petshop | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url(); ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>/css/adminlte.min.css">
    <!-- Sweetalert -->
    <link rel="stylesheet" href="<?= base_url(); ?>/plugins/sweetalert2/sweetalert2.min.css">
</head>

<body class="hold-transition login-page">
    <!-- flashdata -->
    <div class="login-gagal" data-flashdata="<?= session()->getFlashdata('login-gagal'); ?>"></div>
    <div class="akses-terlarang" data-flashdata="<?= session()->getFlashdata('akses-terlarang'); ?>"></div>

    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="<?= base_url(); ?>" class="h1">Zhot Petshop</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Silakan Login</p>

                <form action="<?= base_url("login/cekLogin"); ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" name="username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user-alt"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url(); ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url(); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url(); ?>/js/adminlte.min.js"></script>
    <!-- sweetalert -->
    <script src="<?= base_url(); ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- login -->
    <script src="<?= base_url("js/login.js"); ?>"></script>
</body>

</html>