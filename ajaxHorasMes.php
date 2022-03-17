<?php
session_start();
//vuelve a la pagina de inicio si no esta registrado
if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == '')) {
    header('location:index.php');
}

include_once('calendario.class.php');

$calendario = new calendario_class();


$mes=$_POST[('mes')];

$resultado= $calendario->mostrarFilaPorId($mes);

echo($resultado['horas_Totales']);


?>
