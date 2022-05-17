
<script>
  function imprimir($tabla) {
    var divToPrint = document.getElementById($tabla);
    newWin = window.open("");
    newWin.document.write(divToPrint.outerHTML);
    newWin.print();
    newWin.close();
  }
</script>
<?php
function colorRandom(){
  $color =  mt_rand(0, 0xFFFFFF);
			$color = "#" . dechex($color);
      return $color;
}

      