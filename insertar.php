<?php 
session_start();
//vuelve a la pagina de inicio si no esta registrado
if (!isset($_SESSION['user']) ||(trim ($_SESSION['user']) == '')){
	header('location:index.php');
}

include_once('User.php');
include_once('proyectos.class.php');

$user = new Usuario();
$proyecto = new Proyecto_class();

//extrae datos de usuaio
$sql = "SELECT * FROM usuarios WHERE id_usuario = '".$_SESSION['user']."'";
$row = $user->detalle($sql);


/* 
//aca para subir archivos
if($_FILES["imagen"]){
$nombre_base=basename($_FILES["imagen"]["name"]);//extrae el nombre del archivo
$nombre_final=date("d-m-a"). "-" .date("H-i-s")."-".$nombre_base;
 $ruta="assets/img/avatars".$nombre_final;
 $subirarchivo= move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);
    if($subirarchivo){
       
       $insertar = "INSERT INTO usuarios(nombre,apellido,mail,alias,rol,pasword,imagen) VALUES ('$nombre','$apellido','$mail','$alias','$rol','$contr','$ruta')";
       $query= mysqli_query($conexion, $insertar);
    }
}
//fin subir archivos




if($query){
    echo"<script> alert('Se insertaron los datos con exito'); window.location='/gestion/Lista_Usuarios.php'</script> ";
}
else {
    echo"<script> alert('Fallo al insertar datos'); </script>";

}

*/


?>
<!DOCTYPE html>
<html lang="en">
<head>
<head>
  <title>insertar</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
</head>
</head>
<body>
    

<div class="container">
  <form action="insertar.php" method="POST">
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" name="name" placeholder="Enter name" required="">
    </div>
    <div class="form-group">
      <label for="email">Email address:</label>
      <input type="email" class="form-control" name="email" placeholder="Enter email" required="">
    </div>
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" class="form-control" name="username" placeholder="Enter username" required="">
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" name="password" placeholder="Enter password" required="">
    </div>
    <input type="submit" name="submit" class="btn btn-primary" style="float:right;" value="Submit">
  </form>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>