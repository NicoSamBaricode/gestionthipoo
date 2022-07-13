<?php


include_once('dedicacion.class.php');


$dedicacion = new Dedicacion_class();

$mes=$_POST[('mes')];
$anio=$_POST[('anio')];
$agente=$_POST[('agente')];

$totales=$_POST[('totales')];




$sumaRelevadasBase=$dedicacion-> contadorPorAgenteMesAnioRelevadas($agente,$mes,$anio);
$resultado=$totales-$sumaRelevadasBase;
echo($resultado);
?>
