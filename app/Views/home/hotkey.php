<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="text-center mb-4 mt-4">Petunjuk Kasir</h1>
            <div class="row justify-content-center">
                <div class="col-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Hotkey</th>
                                <th scope="col">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>F1</td>
                                <td>Fokus ke kolom <b>Tambah Item</b></td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>F2</td>
                                <td>Fokus ke kolom <b>QTY</b></td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>F3</td>
                                <td>Fokus ke kolom <b>DISKON</b></td>
                            </tr>
                            <tr>
                                <th scope="row">4</th>
                                <td>F4</td>
                                <td>Fokus ke kolom <b>PEMBAYARAN</b></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
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