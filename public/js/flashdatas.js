$(document).ready(function () {
  // tambah barang gagal
  const tambahBarangGagal = $(".flash-barang-baru-gagal").data("flashdata");

  if (tambahBarangGagal) {
    $("#tambahKodeBarang").modal({ backdrop: "static" });
  }

  // tambah barang berhasil
  const tambahBarangBerhasil = $(".flash-barang-baru-berhasil").data(
    "flashdata"
  );
  if (tambahBarangBerhasil) {
    Swal.fire({
      icon: "success",
      title: "Berhasil",
      text: tambahBarangBerhasil,
    });
  }

  // tambah stok barang gagal
  const stokBarangGagal = $(".flash-stok-barang-gagal").data("flashdata");

  if (stokBarangGagal) {
    $("#tambahStokBarang").modal({ backdrop: "static" });
  }

  // tambah stok barang berhasil
  const stokBarangBerhasil = $(".flash-stok-barang-berhasil").data("flashdata");
  if (stokBarangBerhasil) {
    Swal.fire({
      icon: "success",
      title: "Berhasil",
      text: stokBarangBerhasil,
    });
  }

  // tambah barang reject gagal
  const barangRejectGagal = $(".flash-barang-reject-gagal").data("flashdata");

  if (barangRejectGagal) {
    $("#tambahBarangReject").modal({ backdrop: "static" });
  }

  // tambah barang reject berhasil
  const barangRejectBerhasil = $(".flash-barang-reject-berhasil").data(
    "flashdata"
  );
  if (barangRejectBerhasil) {
    Swal.fire({
      icon: "success",
      title: "Berhasil",
      text: barangRejectBerhasil,
    });
  }

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
});
