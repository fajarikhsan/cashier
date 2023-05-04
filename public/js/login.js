$(document).ready(function () {
  const loginGagal = $(".login-gagal").data("flashdata");
  if (loginGagal) {
    Swal.fire({
      icon: "error",
      title: "Gagal",
      text: loginGagal,
    });
  }

  const aksesTerlarang = $(".akses-terlarang").data("flashdata");
  if (aksesTerlarang) {
    Swal.fire({
      icon: "error",
      title: "Gagal",
      text: aksesTerlarang,
    });
  }
});
