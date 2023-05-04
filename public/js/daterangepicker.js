$(document).ready(function () {
  $("#calendar").daterangepicker(
    {
      opens: "left",
    },
    function (start, end, label) {
      console.log(
        "A new date selection was made: " +
          start.format("YYYY-MM-DD") +
          " to " +
          end.format("YYYY-MM-DD")
      );
      $("#periodeTanggal").val(
        start.format("DD/MM/YYYY") + " - " + end.format("DD/MM/YYYY")
      );
    }
  );
});
