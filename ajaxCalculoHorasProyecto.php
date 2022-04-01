<?php
session_start();
//vuelve a la pagina de inicio si no esta registrado
if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == '')) {
    header('location:index.php');
}


include_once('dedicacion.class.php');


$dedicacion = new Dedicacion_class();

$proyecto=$_POST[('proyecto')];

$resultado=$dedicacion->contadorHorasPorProyecto($proyecto);
$dedicacion->actualizarHorasProyecto($proyecto,$resultado);
echo($resultado);


?>
