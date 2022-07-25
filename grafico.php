<?php
header('Content-Type: application/json');
include_once('Usuarios.class.php');
$user = new Usuario();
$conn = mysqli_connect("localhost", "root", "", "gestion");


$usuario_id = $_POST[('id_usuario')];
$filtro = $_POST[('filtro')];
$datosUsuario = $user->mostrarFilaPorId($usuario_id);
$sector_Usuario = $datosUsuario['sector_id'];
$opcion = $_POST[('opcion')];
$mostrar = $_POST[('mostrar')];

if ($mostrar == "ambas") {
	$aux = "horas_dedicadas,SUM(dedicacion.horas_relevadas)as horas_acumuladas";
}
if ($mostrar == "planificadas") {
	$aux = "horas_dedicadas";
}
if ($mostrar == "relevadas") {
	$aux = "SUM(dedicacion.horas_relevadas)as horas_acumuladas";
}



if ($opcion == "todos") {
	$sqlQuery = "SELECT proyectos.nombre,$aux,color_act FROM proyectos left join 
	dedicacion on  dedicacion.imputacion=proyectos.id_proyectos GROUP by proyectos.nombre order by $filtro";
}
if ($opcion == "proyectos") {
	$sqlQuery = "SELECT proyectos.nombre,$aux,color_act FROM proyectos left join 
	dedicacion on  dedicacion.imputacion=proyectos.id_proyectos  where proyectos.tipo=1 and dedicacion.horas_relevadas IS NOT NULL GROUP by proyectos.nombre order by $filtro ";
}
if ($opcion == "actividades") {
	$sqlQuery = "SELECT proyectos.nombre,$aux,color_act FROM proyectos left join 
	dedicacion on  dedicacion.imputacion=proyectos.id_proyectos where proyectos.tipo=0 and dedicacion.horas_relevadas IS NOT NULL GROUP by proyectos.nombre order by $filtro ";
}


$result = mysqli_query($conn, $sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
