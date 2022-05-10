<?php
header('Content-Type: application/json');
include_once('Usuarios.class.php');
$user = new Usuario();
$conn = mysqli_connect("localhost","root","","gestion");


$usuario_id=$_POST[('id_usuario')];
$filtro=$_POST[('filtro')];
$datosUsuario=$user->mostrarFilaPorId($usuario_id);
$sector_Usuario=$datosUsuario['sector_id'];

if ($datosUsuario['rol']=='Admin' or $datosUsuario['rol']=='Jefe Depto') {
	$sqlQuery = "SELECT nombre,horas_dedicadas,color_act FROM proyectos order by $filtro ";
}else{
	// $sqlQuery = "SELECT nombre,horas_dedicadas,color_act FROM proyectos WHERE sector = '$sector_Usuario' order by  $filtro";
	$sqlQuery = "SELECT nombre,horas_dedicadas,color_act FROM proyectos order by $filtro ";
}	

$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>

