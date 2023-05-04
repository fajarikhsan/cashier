$(document).ready(function () {
  var options = {
    url: baseUrl + "/home/getAllBarangWithStok",

    getValue: function (element) {
      return element.kode_barang + " | " + element.nama_barang;
    },

    list: {
      match: {
        enabled: true,
      },
    },

    theme: "square",
  };

  $("#liveSearch").easyAutocomplete(options);
});
