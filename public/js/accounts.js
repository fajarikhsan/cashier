$(document).ready(function () {
  // tambah barang gagal
  const tambahAkunaGagal = $(".flash-akun-gagal").data("flashdata");

  if (tambahAkunaGagal) {
    $("#tambahAkunModal").modal({ backdrop: "static" });
  }

  // tambah barang berhasil
  const tambahAkunBerhasil = $(".flash-akun-berhasil").data("flashdata");
  if (tambahAkunBerhasil) {
    Swal.fire({
      icon: "success",
      title: "Berhasil",
      text: tambahAkunBerhasil,
    });
  }

  // Hapus barang berhasil
  $(".btnHapusAkun").on("click", function () {
    const id = $(this).data("id");
    Swal.fire({
      title: "Yakin menghapus akun ini?",
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
          title: "Akun berhasil dihapus!",
          showConfirmButton: false,
          timer: 1500,
        }).then(
          $.ajax({
            url: baseUrl + "/home/hapusakun/" + id,
            type: "DELETE",
            success: function () {
              window.location.href = baseUrl + "/home/accounts";
            },
          })
        );
      }
    });
  });

  $("#btnTambahAkun").on("click", function () {
    $("#username").focus();
    $("#id_kasir").val("");
    $("#tambahAkunLabel").text("Tambah Akun");
    $("#username").val("");
    $("#password").val("");
    $("#tipeUser").val("1");
  });

  $(".btnEditAkun").on("click", function () {
    const id = $(this).data("id");
    $("#tambahAkunLabel").text("Ubah Data Akun");

    $.ajax({
      url: baseUrl + "/home/cariAkun",
      data: { id_kasir: id },
      method: "post",
      dataType: "json",
      success: function (data) {
        $("#id_kasir").val(data.id_kasir);
        $("#username").val(data.username);
        $("#tipeUser").val(data.level);
      },
    });
  });
});
