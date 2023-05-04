$(document).ready(function () {
  $("#barangRejectTable").DataTable({
    lengthMenu: [
      [10, 25, 50, -1],
      ["10 rows", "25 rows", "50 rows", "Show all"],
    ],
    dom: "Blfrtip",
    buttons: [
      {
        extend: "pdf",
        title: "Daftar Barang Reject",
      },
      {
        extend: "excel",
        title: "Daftar Barang Reject",
      },
    ],
    fnDrawCallback: function (oSettings) {
      // Hapus barang reject berhasil
      $(".btnHapusReject").on("click", function () {
        const id = $(this).data("id");
        const id_barang = $(this).data("id_barang");
        const jumlahReject = $(this).data("jumlah_reject");
        Swal.fire({
          title: "Yakin menghapus stok kode barang ini?",
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
              title: "Stok barang berhasil dihapus!",
              showConfirmButton: false,
              timer: 1500,
            }).then(
              $.ajax({
                url:
                  baseUrl +
                  "/home/hapusbarangreject/" +
                  id +
                  "/" +
                  id_barang +
                  "/" +
                  jumlahReject,
                type: "DELETE",
                success: function () {
                  window.location.href = baseUrl + "/home/barangreject";
                },
              })
            );
          }
        });
      });
    },
  });
});
