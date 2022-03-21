<?php
header('Content-Type: application/json');

$conn = mysqli_connect("localhost","root","","gestion_thi_back");
$mes=$_POST[('mes')];
$usuario=$_POST[('usuario')];
$sqlQuery = "SELECT dedicacion.id_dedicacion, dedicacion.mes, dedicacion.anio,dedicacion.horas, proyectos.color_act,dedicacion.id_agente,dedicacion.imputacion,proyectos.nombre,usuarios.nombre AS usuariosNombre FROM dedicacion LEFT JOIN usuarios ON dedicacion.id_agente=usuarios.id_usuario LEFT JOIN proyectos ON dedicacion.imputacion=proyectos.id_proyectos where dedicacion.id_agente = $usuario and dedicacion.mes=$mes; ";

$result = mysqli_query($conn,$sqlQuery);


$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
