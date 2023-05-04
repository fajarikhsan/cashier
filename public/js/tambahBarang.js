$(document).ready(function () {
  $("#tambahBarangTable").DataTable({
    lengthMenu: [
      [10, 25, 50, -1],
      ["10 rows", "25 rows", "50 rows", "Show all"],
    ],
    dom: "Blfrtip",
    buttons: [
      {
        extend: "pdf",
        title: "Daftar Barang Masuk",
      },
      {
        extend: "excel",
        title: "Daftar Barang Masuk",
      },
    ],
    fnDrawCallback: function (oSettings) {
      // Hapus stok barang berhasil
      $(".btnHapusStok").on("click", function () {
        const id = $(this).data("id");
        const id_barang = $(this).data("id_barang");
        const jumlahMasuk = $(this).data("jumlah_masuk");
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
                  "/home/hapusstokbarang/" +
                  id +
                  "/" +
                  id_barang +
                  "/" +
                  jumlahMasuk,
                type: "DELETE",
                success: function () {
                  window.location.href = baseUrl + "/home/tambahbarang";
                },
              })
            );
          }
        });
      });
    },
  });
});
