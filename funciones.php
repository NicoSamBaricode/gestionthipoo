
<script>
  function imprimir($tabla) {
    var divToPrint = document.getElementById($tabla);
    newWin = window.open("");
    newWin.document.write(divToPrint.outerHTML);
    newWin.print();
    newWin.close();
  }
</script>