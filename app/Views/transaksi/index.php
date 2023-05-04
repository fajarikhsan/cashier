<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="card card-olive">
                <div class="card-header">
                    <h3 class="card-title">
                        <h1 class="text-center">Daftar Transaksi</h1>
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered table-hover table-striped bg-light" id="transaksiTable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Id Transaksi</th>
                                <th scope="col">Total</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($dataTransaksi as $t) : ?>
                                <tr>
                                    <th scope="row"><?= $i++; ?></th>
                                    <td><?= $t['created_at']; ?></td>
                                    <td><?= $t['id_transaksi']; ?></td>
                                    <td><?= number_to_currency($t['total_harga'], 'Rp. '); ?></td>
                                    <td>
                                        <button name="EditBarang" data-id="<?= $t['id_transaksi']; ?>" value="Ubah" class="btn btn-info btnCekStruk" data-toggle="modal" data-target="#cekStruk" data-subtotal="<?= $t['sub_total']; ?>" data-diskon="<?= $t['diskon']; ?>" data-total="<?= $t['total_harga']; ?>" data-bayar="<?= $t['pembayaran']; ?>" data-kembalian="<?= $t['kembalian']; ?>"><i class="fas fa-print"></i></button>
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

<div class="modal fade" id="cekStruk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cek Struk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="isiModalCekStruk">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="cetakCekStruk">Cetak</button>
            </div>
        </div>
    </div>
</div>

<!-- /.content-wrapper -->
<?= $this->endSection(); ?>