$(document).ready(function () {
  var kodeBarang, namaBarang, hargaBarang;
  const d = new Date();
  $("#randomCode").on("click", function () {
    $("#kodeBarang").val(Math.floor(Math.random() * 9999999999999 + 0));
  });

  $("#daftarBarangTable").DataTable({
    lengthMenu: [
      [10, 25, 50, -1],
      ["10 rows", "25 rows", "50 rows", "Show all"],
    ],
    dom: "Blfrtip",
    buttons: [
      {
        extend: "pdf",
        title:
          "Daftar Barang ( " +
          d.getDate() +
          "/" +
          (d.getMonth() + 1) +
          "/" +
          d.getFullYear() +
          " )",
      },
      {
        extend: "excel",
        title:
          "Daftar Barang ( " +
          d.getDate() +
          "/" +
          (d.getMonth() + 1) +
          "/" +
          d.getFullYear() +
          " )",
      },
    ],
    fnDrawCallback: function (oSettings) {
      // BARCODE
      $("#qtyBarcode").on("keyup", function () {
        $("#barcodeContainer").html("");
        var barcode;
        if (datePicker.value() == undefined || datePicker.value() == "") {
          barcode = "";
          barcodeGone = "";
        } else {
          barcode = "<b>exp : " + datePicker.value() + "</b>";
        }
        for (let i = 1; i <= parseInt($(this).val()); i++) {
          if (i == 1) {
            $("#barcodeContainer").append(
              '<div class="children"><p class="barcodeNama m-0"><b>' +
                namaBarang +
                '</b></p><p class="barcodeHarga m-0"><b>' +
                "Rp. " +
                hargaBarang +
                '</b></p><p class="expired m-0">' +
                barcode +
                '</p><p><svg class="barcodeShow"></svg></p></div>'
            );
          } else {
            $("#barcodeContainer").append(
              '<div class="children"><p class="barcodeNama m-0 barcodeGone"><b>' +
                namaBarang +
                '</b></p><p class="barcodeHarga m-0 barcodeGone"><b>' +
                "Rp. " +
                hargaBarang +
                '</b></p><p class="expired barcodeGone m-0">' +
                barcode +
                '</p><p><svg class="barcodeShow barcodeGone"></svg></p></div>'
            );
            // console.log(htmlG);
          }
        }
        JsBarcode(".barcodeShow", $("#barcodeKode").text(), {
          width: 1.5,
          height: 40,
          fontSize: 14,
        });
      });

      $(".btnCetakBarcode").on("click", function () {
        kodeBarang = $(this).data("kode");
        namaBarang = $(this).data("nama");
        hargaBarang = $(this).data("harga");
        $(".barcodeNama").html("<b>" + namaBarang + "</b>");
        $("#barcodeKode").html("<b>" + kodeBarang + "</b>");
        $(".barcodeHarga").html("<b>Rp. " + hargaBarang + "</b>");
        JsBarcode(".barcodeShow", kodeBarang, {
          width: 1.5,
          height: 40,
          fontSize: 14,
        });
      });

      $("#cetakBarcode").on("click", function () {
        $("#barcodeContainer").printThis({
          importCSS: false,
          loadCSS: baseUrl + "/css/strukCss.css",
        });
      });

      const date = new Date();
      date.setDate(date.getDate() + 7);
      var datePicker = $("#datepicker").datepicker({
        change: function (e) {
          $(".expired").html("<b>exp : " + datePicker.value() + "</b>");
          $("#qtyBarcode").prop("disabled", false);
        },
        format: "dd/mm/yyyy",
      });

      // Hapus barang berhasil
      $(".btnHapusBarang").on("click", function () {
        const id = $(this).data("id");
        Swal.fire({
          title: "Yakin menghapus kode barang ini?",
          text: "Kamu tidak dapat mengembalikannya",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yakin",
          cancelButtonText: "Batal",
        }).then((result) => {
          if (result.value) {
            Swal.fire({
              icon: "success",
              title: "Kode barang berhasil dihapus!",
              showConfirmButton: false,
              timer: 1500,
            }).then(
              $.ajax({
                url: baseUrl + "/home/hapusKodeBarang/" + id,
                type: "DELETE",
                success: function () {
                  window.location.href = baseUrl + "/home/daftarbarang";
                },
              })
            );
          }
        });
      });

      // EDIT
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
    },
  });

  // $("#qtyBarcode").on("keyup", function () {
  //   $("#barcodeContainer").html("");
  //   for (let i = 1; i <= parseInt($(this).val()); i++) {
  //     if (i == 1) {
  //       $("#barcodeContainer").append(
  //         '<div class="children"><p class="barcodeNama m-0"><b>' +
  //           namaBarang +
  //           '</b></p><p class="expired" class="m-0"><b>exp : ' +
  //           datePicker.value() +
  //           '</b></p><p><svg class="barcodeShow"></svg></p></div>'
  //       );
  //     } else {
  //       $("#barcodeContainer").append(
  //         '<div class="children"><p class="barcodeNama m-0 barcodeGone"><b>' +
  //           namaBarang +
  //           '</b></p><p class="expired barcodeGone" class="m-0"><b>exp : ' +
  //           datePicker.value() +
  //           '</b></p><p><svg class="barcodeShow barcodeGone"></svg></p></div>'
  //       );
  //       // console.log(htmlG);
  //     }
  //   }
  //   JsBarcode(".barcodeShow", $("#barcodeKode").text());
  // });

  // $(".btnCetakBarcode").on("click", function () {
  //   kodeBarang = $(this).data("kode");
  //   namaBarang = $(this).data("nama");
  //   hargaBarang = $(this).data("harga");
  //   $(".barcodeNama").html("<b>" + namaBarang + "</b>");
  //   $("#barcodeKode").html("<b>" + kodeBarang + "</b>");
  //   $(".barcodeHarga").html("<b>Rp. " + hargaBarang + "</b>");
  //   JsBarcode(".barcodeShow", kodeBarang, {
  //     width: 1,
  //     height: 40,
  //   });
  // });

  // $("#cetakBarcode").on("click", function () {
  //   $("#barcodeContainer").printThis({
  //     importCSS: false,
  //     loadCSS: baseUrl + "/css/strukCss.css",
  //   });
  // });

  // const date = new Date();
  // date.setDate(date.getDate() + 7);
  // var datePicker = $("#datepicker").datepicker({
  //   change: function (e) {
  //     $(".expired").html("<b>exp : " + datePicker.value() + "</b>");
  //     $("#qtyBarcode").prop("disabled", false);
  //   },
  //   format: "dd/mm/yyyy",
  // });
});
