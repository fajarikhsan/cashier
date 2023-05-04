<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Zhot Petshop</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url("plugins/fontawesome-free/css/all.min.css"); ?>" />
    <!-- datepicker -->
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url("css/adminlte.min.css"); ?>" />
    <!-- Datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <!-- Datatable Buttons -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
    <!-- Sweetalert -->
    <link rel="stylesheet" href="<?= base_url(); ?>/plugins/sweetalert2/sweetalert2.min.css">
    <!-- date range picker -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!-- MyCss -->
    <link rel="stylesheet" href="<?= base_url("css/mycss.css"); ?>">
    <link rel="stylesheet" href="<?= base_url("css/customnumber.css"); ?>">
    <!-- Selectize -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/css/selectize.default.css" rel="stylesheet" />
    <!-- Roboto -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <!-- autocomplete -->
    <!-- CSS file -->
    <link rel="stylesheet" href="<?= base_url(); ?>/css/easy-autocomplete.min.css">
    <!-- Additional CSS Themes file - not required-->
    <link rel="stylesheet" href="<?= base_url(); ?>/css/easy-autocomplete.themes.min.css">
    <style>
        html,
        body {
            height: 100% !important;
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <?php
    if (!session()->has('username') || !session()->has('level')) {
        // dd($this->barangModel->findAll());
        // dd(session()->get());
        session()->setFlashdata('akses-terlarang', 'Harap login terlebih dahulu.');
        redirect()->to(base_url());
    }
    ?>
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="<?= base_url("img/logo.png"); ?>" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <?php if (count($notifHampir) + count($notifHabis) > 0) : ?>
                            <span class="badge badge-warning navbar-badge"><?= count($notifHampir) + count($notifHabis); ?></span>
                        <?php endif; ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-header"><?= count($notifHampir) + count($notifHabis); ?> Notifications</span>
                        <?php if (!empty($notifHampir)) : ?>
                            <?php foreach ($notifHampir as $n) : ?>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="fas fa-exclamation-circle" style="color: red;"></i> <b> <?= $n['nama_barang']; ?> Tinggal <?= $n['stok']; ?> lagi!</b>
                                </a>
                                <div class="dropdown-divider"></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php if (!empty($notifHabis)) : ?>
                            <?php foreach ($notifHabis as $h) : ?>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="fas fa-times-circle" style="color: red;"></i> <b><?= $h['nama_barang']; ?> Sudah habis!!!</b>
                                </a>
                                <div class="dropdown-divider"></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <!-- <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a> -->
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="<?= base_url("img/logo.png"); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8" />
                <span class="brand-text font-weight-light">Zhot Petshop</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= base_url("img/logo.png"); ?>" class="img-circle elevation-2" alt="User Image" />
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= session()->get('username'); ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="<?= base_url("home"); ?>" class="nav-link <?= $halaman == "index" ? "active" : "" ?>">
                                <i class="nav-icon fas fa-cash-register"></i>
                                <p>
                                    Kasir
                                    <!-- <i class="right fas fa-angle-left"></i> -->
                                </p>
                            </a>
                        </li>
                        <?php if (session()->get('level') == "1") : ?>
                            <li class="nav-item">
                                <a href="<?= base_url("home/daftarbarang"); ?>" class="nav-link <?= $halaman == "daftar_barang" ? "active" : "" ?>">
                                    <i class="nav-icon fas fa-boxes"></i>
                                    <p>
                                        Daftar Barang
                                        <!-- <span class="right badge badge-danger">New</span> -->
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item <?= ($halaman == "tambah_barang" || $halaman == "barang_reject") ? "menu-open" : "" ?>">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-warehouse"></i>
                                    <p>
                                        Inventory
                                        <i class="right fas fa-angle-left"></i>
                                        <!-- <span class="right badge badge-danger">New</span> -->
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url("home/tambahbarang"); ?>" class="nav-link <?= $halaman == "tambah_barang" ? "active" : "" ?>">
                                            <i class="fas fa-plus-circle nav-icon"></i>
                                            <p>Tambah Barang</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url("home/barangreject"); ?>" class="nav-link <?= $halaman == "barang_reject" ? "active" : "" ?>">
                                            <i class="fas fa-minus-circle nav-icon"></i>
                                            <p>Barang Reject</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a href="<?= base_url("transaksi/index"); ?>" class="nav-link <?= $halaman == "daftar_transaksi" ? "active" : "" ?>">
                                <i class="nav-icon fas fa-receipt"></i>
                                <p>
                                    Daftar Transaksi
                                    <!-- <span class="right badge badge-danger">New</span> -->
                                </p>
                            </a>
                        </li>
                        <?php if (session()->get('level') == "1") : ?>
                            <li class="nav-item">
                                <a href="<?= base_url("laporan/index"); ?>" class="nav-link <?= $halaman == "laporan" ? "active" : "" ?>">
                                    <i class="nav-icon fas fa-file-pdf"></i>
                                    <p>
                                        Laporan Penjualan
                                        <!-- <span class="right badge badge-danger">New</span> -->
                                    </p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a href="<?= base_url("hotkey"); ?>" class="nav-link <?= $halaman == "hotkey" ? "active" : "" ?>">
                                <i class="nav-icon fas fa-question"></i>
                                <p>
                                    Petunjuk Kasir
                                    <!-- <span class="right badge badge-danger">New</span> -->
                                </p>
                            </a>
                        </li>
                        <?php if (session()->get('level') == "1") : ?>
                            <li class="nav-item">
                                <a href="<?= base_url("home/accounts"); ?>" class="nav-link <?= $halaman == "accounts" ? "active" : "" ?>">
                                    <i class="nav-icon fas fa-user-friends"></i>
                                    <p>
                                        Pengaturan Akun
                                        <!-- <span class="right badge badge-danger">New</span> -->
                                    </p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a href="<?= base_url("home/logout"); ?>" class="nav-link <?= $halaman == "logout" ? "active" : "" ?>">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Logout
                                    <!-- <span class="right badge badge-danger">New</span> -->
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <?= $this->renderSection('content') ?>

        <!-- BOTTOM -->
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">Anything you want</div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2021
                Zhot Petshop</strong>
            All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <script type="text/javascript">
        window.base_url = '<?= base_url(); ?>';
        const baseUrl = window.base_url;
    </script>
    <!-- jQuery -->
    <script src="<?= base_url("plugins/jquery/jquery.min.js"); ?>"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url("plugins/bootstrap/js/bootstrap.bundle.min.js"); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url("js/adminlte.min.js"); ?>"></script>
    <!-- Datatable -->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <!-- Datatable Button -->
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
    <!-- sweetalert -->
    <script src="<?= base_url(); ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- selectize -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/js/standalone/selectize.js"></script>
    <!-- JsBarcode -->
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.4/dist/JsBarcode.all.min.js"></script>
    <!-- date rangepicker -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <!-- accounting js -->
    <script src="<?= base_url("js/accounting.min.js"); ?>"></script>
    <!-- printjs -->
    <script src="<?= base_url("js/printThis.js"); ?>"></script>
    <!-- Custom Number -->
    <script src="<?= base_url("js/customnumber.js"); ?>"></script>
    <!-- MyDatatable -->
    <script src="<?= base_url("js/myDatatable.js"); ?>"></script>
    <!-- flashdatas -->
    <script src="<?= base_url("js/flashdatas.js"); ?>"></script>
    <!-- ajaxes -->
    <script src="<?= base_url("js/ajaxes.js"); ?>"></script>
    <!-- Search Select -->
    <script src="<?= base_url("js/selectSearch.js"); ?>"></script>
    <!-- autocomplete -->
    <!-- JS file -->
    <script src="<?= base_url(); ?>/js/jquery.easy-autocomplete.min.js"></script>
    <!-- liveSearch -->
    <script src="<?= base_url("js/liveSearch.js"); ?>"></script>
    <!-- kasir -->
    <script src="<?= base_url("js/kasir.js"); ?>"></script>
    <!-- transaksi -->
    <script src="<?= base_url("js/transaksi.js"); ?>"></script>
    <!-- daftarBarang -->
    <script src="<?= base_url("js/daftarBarang.js"); ?>"></script>
    <!-- tambahBarang -->
    <script src="<?= base_url("js/tambahBarang.js"); ?>"></script>
    <!-- barangReject -->
    <script src="<?= base_url("js/barangReject.js"); ?>"></script>
    <!-- daterangepicker -->
    <script src="<?= base_url("js/daterangepicker.js"); ?>"></script>
    <!-- laporan -->
    <script src="<?= base_url("js/laporan.js"); ?>"></script>
    <!-- accounts -->
    <script src="<?= base_url("js/accounts.js"); ?>"></script>
    <!-- login -->
    <script src="<?= base_url("js/login.js"); ?>"></script>
</body>

</html>