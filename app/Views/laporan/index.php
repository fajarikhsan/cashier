<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="akses-terlarang" data-flashdata="<?= session()->getFlashdata('akses-terlarang'); ?>"></div>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-4">
                    <div class="form-group shadow-lg p-3 bg-white rounded">
                        <label for="periodeTanggal">Periode</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Peride Tanggal" aria-label="Peride Tanggal" aria-describedby="button-addon2" value="Keseluruhan" id="periodeTanggal" readonly>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="calendar"><i class="fas fa-calendar"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3 id="totalTransaksi"><?= $total_transaksi['total_transaksi']; ?></h3>

                            <p>Total Transaksi</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3 id="totalPendapatan"><?= (isset($total_pendapatan['total_pendapatan'])) ? number_to_currency($total_pendapatan['total_pendapatan'], 'Rp. ') : 0; ?></h3>

                            <p>Total Pendapatan</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3 id="totalDiskon"><?= (isset($total_diskon['total_diskon'])) ? number_to_currency($total_diskon['total_diskon'], 'Rp. ') : 0; ?></h3>

                            <p>Total Diskon</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-pricetags"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3 id="subtotalPendapatan"><?= (isset($subtotal_pendapatan['subtotal_pendapatan'])) ? number_to_currency($subtotal_pendapatan['subtotal_pendapatan'], 'Rp. ') : 0; ?></h3>

                            <p>Subtotal Pendapatan</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-arrow-graph-up-right"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
            </div>

            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col">
                    <!-- small box -->
                    <div class="small-box bg-olive">
                        <div class="inner">
                            <h3 id="barangTerjual"><?= (isset($barang_terjual['barang_terjual'])) ? $barang_terjual['barang_terjual'] : 0; ?></h3>

                            <p>Total Barang Terjual</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-android-cart"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3 id="totalKeuntungan"><?= (isset($total_keuntungan['keuntungan'])) ? number_to_currency($total_keuntungan['keuntungan'], 'Rp. ') : 0; ?></h3>

                            <p>Total Keuntungan</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-cash"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col">
                    <!-- small box -->
                    <div class="small-box bg-purple">
                        <div class="inner">
                            <h3 id="keuntunganDiskon"><?= (isset($total_keuntungan['keuntungan'])) ? number_to_currency($total_keuntungan['keuntungan'] - $total_diskon['total_diskon'], 'Rp. ') : 0; ?></h3>

                            <p>Keuntungan - Diskon</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-card"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <hr>
            <h1 class="text-center" id="barangTitle">Rekapitulasi Penjualan Per Barang Periode (Sepanjang Waktu)</h1>
            <div class="row">
                <div class="col">
                    <table class="table table-bordered table-hover table-striped bg-light" id="laporanTable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Barang</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Harga Modal</th>
                                <th scope="col">Harga Ecer</th>
                                <th scope="col">Terjual</th>
                                <th scope="col">Harga Jual</th>
                                <th scope="col">Keuntungan</th>
                            </tr>
                        </thead>
                        <tbody>
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