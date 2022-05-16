<?php
header('Content-Type: application/json');
include_once('Usuarios.class.php');
$user = new Usuario();
$conn = mysqli_connect("localhost","root","","gestion");


$usuario_id=$_POST[('id_usuario')];
$filtro=$_POST[('filtro')];
$datosUsuario=$user->mostrarFilaPorId($usuario_id);
$sector_Usuario=$datosUsuario['sector_id'];
$opcion=$_POST[('opcion')];


	// $sqlQuery = "SELECT nombre,horas_dedicadas,color_act FROM proyectos WHERE sector = '$sector_Usuario' order by  $filtro";
	if ($opcion=="todos"){
		$sqlQuery = "SELECT nombre,horas_dedicadas,horas_acumuladas,color_act FROM proyectos order by $filtro ";
	}
	if ($opcion=="proyectos"){
		$sqlQuery = "SELECT nombre,horas_dedicadas,horas_acumuladas,color_act FROM proyectos where tipo=1 order by $filtro ";
	}
	if ($opcion=="actividades"){
		$sqlQuery = "SELECT nombre,horas_dedicadas,horas_acumuladas,color_act FROM proyectos where tipo=0 order by $filtro ";
	}



$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>

