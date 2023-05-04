$(document).ready(function () {
  $("#liveSearch").select();

  function preventAll(id) {
    $(id).on("keydown", function (e) {
      switch (e.keyCode) {
        case 112:
          e.preventDefault();
          $("#liveSearch").select();
          break;
        case 113:
          e.preventDefault();
          $("#qty").select();
          break;
        case 114:
          e.preventDefault();
          $("#diskon").select();
          break;
        case 115:
          e.preventDefault();
          $("#bayar").select();
          break;
      }
    });
  }

  preventAll(document);
  preventAll("#liveSearch");
  preventAll("#qty");
  preventAll("#diskon");
  preventAll("#bayar");

  $("#liveSearch").on("keyup", function (event) {
    // console.log("ok");
    if (event.keyCode == 13) {
      // console.log("ok");
      $("#btnTambah").click();
    }
  });

  $("#diskon").on("keyup", function () {
    // console.log($("#diskon").val());
    var diskon = parseInt($(this).val());
    if ($(this).val() == "" || $(this).val() == undefined) {
      diskon = 0;
    }
    var subtotal = parseInt(accounting.unformat($("#subtotal").val()));
    var total = $("#total");
    total.val(accounting.formatNumber(subtotal - (diskon / 100) * subtotal));
    $("#kembalian").val(
      accounting.formatNumber(
        accounting.unformat($("#bayar").val()) -
          accounting.unformat(total.val())
      )
    );
    $("#money").text(
      "Rp. " + accounting.formatNumber(subtotal - (diskon / 100) * subtotal)
    );
  });

  $("#bayar").on("keyup", function () {
    $(this).val(accounting.formatNumber($(this).val()));
    var total = parseInt(accounting.unformat($("#total").val()));
    var pembayaran = parseInt(accounting.unformat($(this).val()));
    var kembalian = $("#kembalian");
    kembalian.val(accounting.formatNumber(pembayaran - total));
  });

  $("#btnBayar").on("click", function () {
    const subtotal = accounting.unformat($("#subtotal").val());
    const diskon = accounting.unformat($("#diskon").val());
    const total = accounting.unformat($("#total").val());
    const bayar = accounting.unformat($("#bayar").val());
    const kembalian = accounting.unformat($("#kembalian").val());

    if (parseInt(accounting.unformat(subtotal)) <= 0) {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Belum ada barang!",
      });
    } else if (parseInt(accounting.unformat(kembalian)) < 0) {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Pembayaran kurang!",
      });
    } else {
      // console.log(subtotal);
      // console.log(diskon);
      // console.log(total);
      // console.log(bayar);
      // console.log(kembalian);
      var cart = [];
      $(".cart").each(function () {
        console.log($(this).data("qty"));
        cart.push({
          id_barang: $(this).data("id"),
          qty: $(this).data("qty"),
        });
      });
      console.log(cart);
      $.ajax({
        url: baseUrl + "/home/invoice",
        data: {
          subtotal: subtotal,
          diskon: diskon,
          total: total,
          bayar: bayar,
          kembalian: kembalian,
          cart: cart,
        },
        method: "post",
        success: function (data) {
          $("#isiModal").html(data);
        },
      });
      $("#cetakBayar").modal({ backdrop: "static" });
    }
  });

  $("#cetakStruk").on("click", function () {
    const subtotal = accounting.unformat($("#subtotal").val());
    const diskon = accounting.unformat($("#diskon").val());
    const total = accounting.unformat($("#total").val());
    const bayar = accounting.unformat($("#bayar").val());
    const kembalian = accounting.unformat($("#kembalian").val());
    $("#isiModal").printThis({
      importCSS: false,
      loadCSS: baseUrl + "/css/strukCss.css",
      afterPrint: function () {
        location.reload();
      },
    });

    // console.log(subtotal);
    // console.log(diskon);
    // console.log(total);
    // console.log(bayar);
    // console.log(kembalian);
    var cart = [];
    $(".cart").each(function () {
      console.log($(this).data("qty"));
      cart.push({
        id_barang: $(this).data("id"),
        qty: $(this).data("qty"),
      });
    });
    $.ajax({
      url: baseUrl + "/home/simpanTransaksi",
      data: {
        subtotal: subtotal,
        diskon: diskon,
        total: total,
        bayar: bayar,
        kembalian: kembalian,
        cart: cart,
      },
      method: "post",
    });
  });
});
