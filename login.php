<?php

session_start();

include_once('Usuarios.class.php');
include_once('logs.class.php');

$user = new Usuario();
$log = new log_class();

if(isset($_POST['login'])){
	$username = $user->escape_string($_POST['alias']);
	$password = $user->escape_string($_POST['pasword']);

	$auth = $user->check_login($username, $password);

	if(!$auth){
		$_SESSION['message'] = 'Datos no validos';
    	header('location:index.php');
	}
	else{
		//si no rechaza la conexion puede entrar
		$_SESSION['user'] = $auth;
	    $log->insertarLog($_SESSION['user'], "Ingreso al sistema");
		header('location:panel.php');
		
	}
}
else{
	$_SESSION['message'] = 'Necesita logearse primero';
	header('location:index.php');
}
?>