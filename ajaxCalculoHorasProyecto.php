<?php
include_once('dedicacion.class.php');


$dedicacion = new Dedicacion_class();

$proyecto=$_POST[('proyecto')];

$resultado=$dedicacion->contadorHorasPorProyecto($proyecto);
$dedicacion->actualizarHorasProyecto($proyecto,$resultado);
echo($resultado);


?>
