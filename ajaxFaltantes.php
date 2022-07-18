<?php
session_start();
//vuelve a la pagina de inicio si no esta registrado
if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == '')) {
    header('location:index.php');
}


include_once('dedicacion.class.php');


$dedicacion = new Dedicacion_class();

$mes=$_POST[('mes')];
$anio=$_POST[('anio')];
$agente=$_POST[('agente')];
$horasPlanificadas=$_POST[('planificadas')];
$totales=$_POST[('totales')];




$suma=$dedicacion->contadorPorAgenteMesAnio($agente,$mes,$anio);
$resultado=$totales-($horasPlanificadas+$suma);
echo($resultado);


?>
