<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="akses-terlarang" data-flashdata="<?= session()->getFlashdata('akses-terlarang'); ?>"></div>

<style>
  @media print {
    #wrapper {
      display: none;
    }

    .modal-footer,
    .modal-header {
      display: none;
    }

    title {
      display: none;
    }
  }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header bg-gray">
    <div class="row align-items-center">
      <div class="col-1">
        <img src="<?= base_url("img/logo.png"); ?>" alt="Zhot Petshop" width="100%">
      </div>
      <div class="col-9">
        <span class="align-self-center">
          <h1>Zhot Petshop</h1>
        </span>
      </div>
      <div class="col-1 border-right">
        <div class="row justify-content-end pr-3 mb-2">
          Tanggal
        </div>
        <div class="row justify-content-end pr-3">
          <h5>5 Juni 2021</h5>
        </div>
      </div>
      <div class="col-1">
        <div class="row justify-content-end pr-3 mb-2">
          <span>Nama Kasir</span>
        </div>
        <div class="row justify-content-end pr-3">
          <h5><?= session()->get('username'); ?></h5>
        </div>
      </div>
    </div>
  </div>
  <!-- /.content-header -->

  <hr class="mt-0 mb-0 border-3" />

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-5 border-right border-bottom border-2 pt-4 border-bottom-7 border-right-7 pb-4">
          <label for="kode_barang">TAMBAH ITEM</label>
          <div class=" form-group row">
            <div class="col-8">
              <input type="text" class="form-control" id="liveSearch" name="kode_barang" autofocus>
            </div>
            <div class="col-2">
              <div class="quantity">
                <input type="number" name="qty" min="1" step="1" value="1" id="qty">
              </div>
            </div>
            <div class="col-2">
              <input type="button" value="Tambah" id="btnTambah" class="btn btn-primary">
            </div>
          </div>
        </div>
        <div class="col-1 border-bottom border-bottom-5">
          <h4 class="text-danger pt-2">Total</h4>
        </div>
        <div class="col-6 border-bottom d-flex justify-content-end align-items-end border-bottom-5">
          <h1 class="font-weight-bold" id="money">Rp. 0 </h1>
        </div>
      </div>
      <div class="row mt-2">
        <div class="col-10">
          <table class="table table-bordered table-hover table-striped bg-light display" id="cashierTable" data-s-dom="lrtip">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Kode Barang</th>
                <th scope="col">Nama Item</th>
                <th scope="col">Harga</th>
                <th scope="col">Qty</th>
                <th scope="col">Subtotal</th>
              </tr>
            </thead>
            <tbody>
              <!-- <tr>
                <th scope="row">1</th>
                <td>Royal Canin</td>
                <td>10000</td>
                <td width="1">
                  <div class="quantity">
                    <input type="number" name="qty" min="1" step="1" value="1">
                  </div>
                </td>
                <td>10000</td>
                <td width="1"><input type="button" name="hapus_item" id="hapus_item1" value="Hapus" class="btn btn-danger"></td>
              </tr> -->
            </tbody>
          </table>
        </div>
        <div class="col-2">
          <form action="<?= base_url('home/cetakBayar'); ?>" method="POST" id="formBayar">
            <div id="inputAwal"></div>
            <div class="form-group">
              <label for="subtotal">SUBTOTAL</label>
              <input type="text" class="form-control" id="subtotal" name="subtotal" value="0" readonly>
            </div>
            <div class="form-group">
              <label for="diskon">DISKON</label>
              <div class="input-group">
                <input type="number" class="form-control" id="diskon" name="diskon" value="0" min="0" max="100">
                <div class="input-group-append">
                  <span class="input-group-text">%</span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="total">TOTAL</label>
              <input type="text" class="form-control" id="total" name="total" value="0" readonly>
            </div>
            <div class="form-group">
              <label for="bayar">PEMBAYARAN</label>
              <input type="text" class="form-control" id="bayar" name="bayar" value="0">
            </div>
            <div class="form-group">
              <label for="kembalian">KEMBALIAN</label>
              <input type="text" class="form-control" id="kembalian" name="kembalian" value="0" readonly>
            </div>
            <button type="button" class="btn btn-primary btn-block btn-lg btnBayar" id="btnBayar" data-toggle="modal">BAYAR</button>
          </form>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal -->
<div class="modal fade" id="cetakBayar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Simpan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="isiModal">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="cetakStruk">Simpan & Cetak</button>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>