$(document).ready(function () {
  $("#transaksiTable").DataTable({
    columnDefs: [
      {
        targets: [0, 1, 3, 4],
        searchable: false,
      },
    ],
    fnDrawCallback: function (oSettings) {
      // Write any code (also ajax code that you want to execute)
      // that you want to be executed after
      // the table has been redrawn
      $(".btnCekStruk").on("click", function () {
        console.log("ok");
        const idTransaksi = $(this).data("id");
        const subtotal = $(this).data("subtotal");
        const diskon = $(this).data("diskon");
        const total = $(this).data("total");
        const pembayaran = $(this).data("bayar");
        const kembalian = $(this).data("kembalian");

        $.ajax({
          url: baseUrl + "/transaksi/getTransaksiById",
          data: {
            id_transaksi: idTransaksi,
          },
          method: "post",
          dataType: "json",
          success: function (data) {
            var temp = [];

            $.ajax({
              url: baseUrl + "/transaksi/invoice",
              data: {
                subtotal: subtotal,
                diskon: diskon,
                total: total,
                pembayaran: pembayaran,
                kembalian: kembalian,
                id_transaksi: idTransaksi,
                data: data,
              },
              method: "post",
              success: function (view) {
                $("#isiModalCekStruk").html(view);
              },
            });
          },
        });
      });
    },
  });
  $(".btnCekStruk").on("click", function () {
    console.log("ok");
    const idTransaksi = $(this).data("id");
    const subtotal = $(this).data("subtotal");
    const diskon = $(this).data("diskon");
    const total = $(this).data("total");
    const pembayaran = $(this).data("bayar");
    const kembalian = $(this).data("kembalian");

    $.ajax({
      url: baseUrl + "/transaksi/getTransaksiById",
      data: {
        id_transaksi: idTransaksi,
      },
      method: "post",
      dataType: "json",
      success: function (data) {
        var temp = [];

        $.ajax({
          url: baseUrl + "/transaksi/invoice",
          data: {
            subtotal: subtotal,
            diskon: diskon,
            total: total,
            pembayaran: pembayaran,
            kembalian: kembalian,
            id_transaksi: idTransaksi,
            data: data,
          },
          method: "post",
          success: function (view) {
            $("#isiModalCekStruk").html(view);
          },
        });
      },
    });
  });

  $("#cetakCekStruk").on("click", function () {
    $("#isiModalCekStruk").printThis({
      importCSS: false,
      loadCSS: baseUrl + "/css/strukCss.css",
    });
  });
});
