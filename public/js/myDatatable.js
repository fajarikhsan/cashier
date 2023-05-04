$(document).ready(function () {
  $("#liveSearch").focus();

  $("#myTable").DataTable();

  // console.log(
  //   $("#myTable")
  //     .DataTable()
  //     .column(1)
  //     .search("A")
  //     .rows({ search: "applied" })
  //     .nodes().length
  // );
  // console.log(
  //   $("#myTable")
  //     .DataTable()
  //     .column(1)
  //     .search("A")
  //     .rows({ search: "applied" })
  //     .data()
  // );

  $("#qty").on("change", function () {
    // console.log(event.keyCode);
    $("#liveSearch").focus();
  });

  var cashierTable = $("#cashierTable").DataTable({
    dom: "Bfrtip",
    paging: false,
    columnDefs: [
      {
        targets: [0, 1],
        visible: false,
        searchable: true,
      },
    ],
    buttons: [
      {
        text: "Hapus",
        className: "btnKasirHps",
      },
    ],
  });
  $("#cashierTable_filter").css("display", "none");
  var i = 1;
  $("#btnTambah").on("click", function () {
    const inputKode = $("#liveSearch").val();
    var kodeBrg = inputKode.split(" ");
    const tableCheck = cashierTable
      .column(1)
      .search(kodeBrg[0])
      .rows({ search: "applied" })
      .nodes().length;
    $.ajax({
      url: baseUrl + "/home/getKodeBarang",
      data: { kode_barang: kodeBrg[0] },
      method: "post",
      dataType: "json",
      success: function (brg) {
        // console.log(brg[0]);
        // console.log(tableCheck);
        if (brg.length > 0) {
          if (parseInt($("#qty").val()) > brg[0].stok) {
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text:
                "Stok tidak mencukupi! Sisa stok untuk barang ini : " +
                brg[0].stok,
            });
          } else {
            var subtotal = 0;
            if (tableCheck > 0) {
              // console.log(
              //   cashierTable
              //     .column(1)
              //     .search(kodeBrg)
              //     .rows({ search: "applied" })
              //     .data()[0][4] + 1
              // );
              cashierTable.rows(function (idx, data, node) {
                // console.log(idx);
                // console.log(node);
                if (data[1] == kodeBrg[0]) {
                  // console.log(idx);
                  var cellVal = parseInt(
                    accounting.unformat(
                      cashierTable.cell({ row: idx, column: 4 }).data()
                    )
                  );
                  var cellPrice = parseInt(
                    accounting.unformat(
                      cashierTable.cell({ row: idx, column: 3 }).data()
                    )
                  );
                  if (cellVal + parseInt($("#qty").val()) > brg[0].stok) {
                    Swal.fire({
                      icon: "error",
                      title: "Oops...",
                      text:
                        "Stok tidak mencukupi! Sisa stok untuk barang ini : " +
                        brg[0].stok,
                    });
                  } else {
                    cashierTable
                      .cell({ row: idx, column: 4 })
                      .data(cellVal + parseInt($("#qty").val()));
                    var cellValNew = parseInt(
                      accounting.unformat(
                        cashierTable.cell({ row: idx, column: 4 }).data()
                      )
                    );
                    cashierTable
                      .cell({ row: idx, column: 5 })
                      .data(accounting.formatNumber(cellPrice * cellValNew));
                    var qtyInput =
                      parseInt($("#" + data[1]).data("qty")) +
                      +parseInt($("#qty").val());
                    $("#" + data[1]).data("qty", qtyInput);
                    // console.log($("#" + data[1]).data("qty"));
                  }
                }
                // console.log(data[5]);
                // subtotal = subtotal + data[5];
                return false;
              });
            } else {
              cashierTable.row.add([
                i,
                brg[0].kode_barang,
                brg[0].nama_barang,
                accounting.formatNumber(brg[0].harga_ecer),
                $("#qty").val(),
                accounting.formatNumber(
                  brg[0].harga_ecer * parseInt($("#qty").val())
                ),
              ]);
              $("#inputAwal").after(
                '<input type="hidden" id="' +
                  brg[0].kode_barang +
                  '" class="cart" data-id="' +
                  brg[0].id_barang +
                  '" data-qty="' +
                  parseInt($("#qty").val()) +
                  '">'
              );
              i++;
            }
            cashierTable.rows(function (idx, data, node) {
              subtotal = subtotal + accounting.unformat(data[5]);
            });
            $("#subtotal").val(accounting.formatNumber(subtotal));
            $("#total").val(
              accounting.formatNumber(
                subtotal - ($("#diskon").val() / 100) * subtotal
              )
            );
            $("#kembalian").val(
              accounting.formatNumber(
                accounting.unformat($("#bayar").val()) -
                  (subtotal - ($("#diskon").val() / 100) * subtotal)
              )
            );
            $("#money").text(
              "Rp. " +
                accounting.formatNumber(
                  subtotal - ($("#diskon").val() / 100) * subtotal
                )
            );

            cashierTable.column(1).search("").draw();
            $("#liveSearch").val("");
            $("#liveSearch").focus();
            $("#qty").val(1);
          }
        }
      },
    });
  });

  $(".btnKasirHps").prop("disabled", true);
  // hapus kasir row table
  $("#cashierTable tbody").on("click", "tr", function () {
    if ($(this).hasClass("selected")) {
      $(this).removeClass("selected");
      $(".btnKasirHps").prop("disabled", true);
    } else {
      cashierTable.$("tr.selected").removeClass("selected");
      $(this).addClass("selected");
      $(".btnKasirHps").prop("disabled", false);
    }
  });

  $(".btnKasirHps").click(function () {
    var subtotal = accounting.unformat(cashierTable.row(".selected").data()[5]);
    console.log(subtotal);
    var subtotalNow = accounting.unformat($("#subtotal").val());
    var subtotalRes = subtotalNow - subtotal;
    var kode_barang = cashierTable.row(".selected").data()[1];

    $("#" + kode_barang).remove();

    $("#subtotal").val(accounting.formatNumber(subtotalRes));
    $("#total").val(
      accounting.formatNumber(
        subtotalRes - ($("#diskon").val() / 100) * subtotalRes
      )
    );
    $("#kembalian").val(
      accounting.formatNumber(
        accounting.unformat($("#bayar").val()) -
          (subtotalRes - ($("#diskon").val() / 100) * subtotalRes)
      )
    );
    $("#money").text(
      "Rp. " +
        accounting.formatNumber(
          subtotalRes - ($("#diskon").val() / 100) * subtotalRes
        )
    );

    cashierTable.row(".selected").remove().draw(false);
  });
});
