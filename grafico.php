<?php
header('Content-Type: application/json');

$conn = mysqli_connect("localhost","root","","gestion_thi");

$sqlQuery = "SELECT nombre,horas_dedicadas,color_act FROM actividades ";
$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>