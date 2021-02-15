<?php
session_start();
//vuelve a la pagina de inicio si no esta registrado
if (!isset($_SESSION['user']) ||(trim ($_SESSION['user']) == '')){
	header('location:index.php');
}

include_once('Usuarios.class.php');

$user = new Usuario();
$customerObj = new Usuario();
//extrae datos de usuaio
$sql = "SELECT * FROM usuarios WHERE id_usuario = '".$_SESSION['user']."'";
$row = $user->detalle($sql);

$flag=false;

//carga la consulta de busqueda
if(isset($_POST['submit'])) {
	$query = "SELECT * FROM usuarios WHERE nombre LIKE '%".$_POST['busqueda']."%'";
	$flag=true;
	
  }
  //es lo que imprime al inicio.
  if(isset($_POST['volver'])) {
	$query = "SELECT * FROM usuarios ";
	$flag=false;
  }


?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	
</head>
<body>

          <div class="container"> 
			  <div class="row">                          
		  <form method="POST" action="home.php">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar...">
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="Buscar"/>
		</form>
		</div>
<div class="row">
	<div class="col" >
		<table>
		<tr>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Rol</th>
                                        
                                        <th>Alias</th>  
                                        <th>Pasword</th>
                                        <th>Email</th>                                     
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </tr>
	<?php 
									$filas = $user->mostrarDatosBusqueda($query); 
											 foreach ($filas as $fila) {
										   ?>
										   <tr>
                                           
											 <!-- <td>/<?php //echo $fila['id_usuario'] ?></td> -->
											 <td><?php echo $fila['nombre'] ?></td>
											 <td><?php echo $fila['apellido'] ?></td>
											 <td><?php echo $fila['rol'] ?></td>
                                             <td><?php echo $fila["alias"] ?></td>
                                             <td><?php echo $fila["pasword"] ?></td>
                                             <td><?php echo $fila["mail"] ?></td>
                                             <script src="cartel.js"> </script>
                                             <td><a class="btn btn-info mx-auto btn-circle ml-1" role="button" href="actualizar.php?editId=<?php echo $fila['id_usuario'] ?>" ><i class="fas fa-user-circle text-white"></i></a></td>
                                             <td><a class="btn btn-danger mx-auto btn-circle ml-1" onclick="return confirmBorrar()" role="button" href="Lista_Usuarios.php?borrarid=<?php echo $fila['id_usuario'] ?>"><i class="fas fa-trash text-white"></i></a></td>

                                           </tr>
                                            <?php }  ?>
		</table>
           </div>            
		</div>

			<a href="cerrar_sesion.php" class="btn btn-danger"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
			<a href="panel.php" class="btn btn-primary"><span class="glyphicon glyphicon-log-out"></span> Ir a panel</a>
			<?php 
				if ($flag==true){ ?>
			<form method="POST" action="home.php">
				<input style="display: none;" type="text" name="busqueda" id="volver">
				<input type="submit" name="volver" class="btn btn-secondary btn-sm" value="Volver a la lista"/>
			
			</form>
			<?php } $flag=false; ?>
</div>  

</body>
</html>