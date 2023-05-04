$(document).ready(function () {
  $("#btnTambahKodeBarang").on("click", function () {
    $("#kodeBarang").focus();
    $("#exampleModalLabel").text("Tambah Kode Barang");
    $("#id_barang").val("");
    $("#kodeBarang").val("");
    $("#namaBarang").val("");
    $("#hargaEcer").val("");
    $("#hargaModal").val("");
  });

  $(".btnEditBarang").on("click", function () {
    const id = $(this).data("id");
    $("#exampleModalLabel").text("Ubah Data Kode Barang");

    $.ajax({
      url: baseUrl + "/home/cariKodeBarang",
      data: { id_barang: id },
      method: "post",
      dataType: "json",
      success: function (data) {
        $("#id_barang").val(data.id_barang);
        $("#kodeBarang").val(data.kode_barang);
        $("#namaBarang").val(data.nama_barang);
        $("#hargaEcer").val(data.harga_ecer);
        $("#hargaModal").val(data.harga_modal);
      },
    });
  });

  $(".kodeBarangReject").on("change", function () {
    const id = $(this).val();

    $.ajax({
      url: baseUrl + "/home/getStokById",
      data: { id: id },
      method: "post",
      dataType: "json",
      success: function (data) {
        $("#labelReject").text("Jumlah Reject (Max : " + data + ")");
        $(".maxReject").attr("max", data);
      },
    });
  });
});
