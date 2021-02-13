<?php
session_start();
//vuelve a la pagina de inicio si no esta registrado
if (!isset($_SESSION['user']) ||(trim ($_SESSION['user']) == '')){
	header('location:index.php');
}

include_once('User.php');

$user = new Usuario();
$customerObj = new Usuario();
//extrae datos de usuaio
$sql = "SELECT * FROM usuarios WHERE id_usuario = '".$_SESSION['user']."'";
$row = $user->detalle($sql);

//contador usuarios
$cont = $user->cont_u();



?>
<!DOCTYPE html>
<html>
<head>
	<title>PHP Login using OOP Approach</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

                                       
                                   
		  

			<a href="cerrar_sesion.php" class="btn btn-danger"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
			<a href="panel.php" class="btn btn-primary"><span class="glyphicon glyphicon-log-out"></span> Ir a panel</a>



</body>
</html>