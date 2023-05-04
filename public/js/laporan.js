$(document).ready(function () {
  var dXhr, xhr;

  dXhr = $("#laporanTable").DataTable({
    lengthMenu: [
      [10, 25, 50, -1],
      ["10 rows", "25 rows", "50 rows", "Show all"],
    ],
    dom: "Blfrtip",
    processing: true,
    serverSide: true,
    ajax: baseUrl + "/laporan/laporanDatatable",
    order: [],
    columns: [
      { data: "no", orderable: false },
      { data: "kode_barang" },
      { data: "nama_barang" },
      { data: "harga_modal" },
      { data: "harga_ecer" },
      { data: "terjual" },
      { data: "harga_jual" },
      { data: "keuntungan" },
    ],
    columnDefs: [
      {
        targets: [2, 3, 4, 5, 6, 7],
        render: $.fn.dataTable.render.number(",", ".", 0, ""),
      },
    ],
    buttons: [
      {
        extend: "pdf",
        title: "Rekapitulasi Penjualan Per Barang Periode (Sepanjang Waktu)",
      },
      {
        extend: "excel",
        title: "Rekapitulasi Penjualan Per Barang Periode (Sepanjang Waktu)",
      },
    ],
  });

  $("#calendar").on("apply.daterangepicker", function (ev, picker) {
    startDate = picker.startDate.format("YYYY-MM-DD");
    endDate = picker.endDate.format("YYYY-MM-DD");

    xhr = $.ajax({
      url: baseUrl + "/laporan/aturTanggal",
      data: { startDate: startDate, endDate: endDate },
      method: "post",
      dataType: "json",
      beforeSend: function () {
        if (xhr != undefined) {
          xhr.abort();
        }
      },
      success: function (data) {
        $("#totalTransaksi").text(
          accounting.formatNumber(data.total_transaksi)
        );
        $("#totalPendapatan").text(
          "Rp. " + accounting.formatNumber(data.total_pendapatan)
        );
        $("#totalDiskon").text(
          "Rp. " + accounting.formatNumber(data.total_diskon)
        );
        $("#subtotalPendapatan").text(
          "Rp. " + accounting.formatNumber(data.subtotal_pendapatan)
        );
        $("#barangTerjual").text(accounting.formatNumber(data.barang_terjual));
        $("#totalKeuntungan").text(
          "Rp. " + accounting.formatNumber(data.total_keuntungan)
        );
        $("#keuntunganDiskon").text(
          "Rp. " +
            accounting.formatNumber(data.total_keuntungan - data.total_diskon)
        );
      },
    });

    dXhr.settings()[0].jqXHR.abort();
    $("#laporanTable").DataTable().clear();
    $("#laporanTable").DataTable().destroy();
    dXhr = $("#laporanTable").DataTable({
      lengthMenu: [
        [10, 25, 50, -1],
        ["10 rows", "25 rows", "50 rows", "Show all"],
      ],
      dom: "Blfrtip",
      processing: true,
      serverSide: true,
      ajax: {
        type: "POST",
        url: baseUrl + "/laporan/laporanDatatableWithDate",
        data: {
          startDate: startDate,
          endDate: endDate,
        },
      },
      order: [],
      columns: [
        { data: "no", orderable: false },
        { data: "kode_barang" },
        { data: "nama_barang" },
        { data: "harga_modal" },
        { data: "harga_ecer" },
        { data: "terjual" },
        { data: "harga_jual" },
        { data: "keuntungan" },
      ],
      columnDefs: [
        {
          targets: [2, 3, 4, 5, 6, 7],
          render: $.fn.dataTable.render.number(",", ".", 0, ""),
        },
      ],
      buttons: [
        {
          extend: "pdf",
          title:
            "Rekapitulasi Penjualan Per Barang Periode (" +
            picker.startDate.format("DD/MM/YYYY") +
            " - " +
            picker.endDate.format("DD/MM/YYYY") +
            ")",
        },
        {
          extend: "excel",
          title:
            "Rekapitulasi Penjualan Per Barang Periode (" +
            picker.startDate.format("DD/MM/YYYY") +
            " - " +
            picker.endDate.format("DD/MM/YYYY") +
            ")",
        },
      ],
    });

    $("#barangTitle").text(
      "Rekapitulasi Penjualan Per Barang Periode (" +
        picker.startDate.format("DD/MM/YYYY") +
        " - " +
        picker.endDate.format("DD/MM/YYYY") +
        ")"
    );
  });
});
