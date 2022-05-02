<?php
session_start();
//vuelve a la pagina de inicio si no esta registrado
if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == '')) {
    header('location:index.php');
}

include_once('Usuarios.class.php');
include_once('proyectos.class.php');

$user = new Usuario();
$proyecto = new Proyecto_class();

//extrae datos de usuaio
$sql = "SELECT * FROM usuarios WHERE id_usuario = '" . $_SESSION['user'] . "'";
$row = $user->detalle($sql);

//contador usuarios
$cont = $user->cont_u();

//llama funcion borrar
if (isset($_GET['borrarid']) && !empty($_GET['borrarid'])) {
    $borrarId = $_GET['borrarid'];
    $user->borrar_usuario($borrarId);
}
//carga los datos cuando recien entra a la pagina
$query = "SELECT * FROM usuarios ";
//bandera para que desaparezca boton volver a la lista
$flag = false;

//carga la consulta de busqueda
if (isset($_POST['submit'])) {
    $query = "SELECT * FROM usuarios WHERE nombre LIKE '%" . $_POST['busqueda'] . "%'";
    $flag = true;
}
//es lo que imprime al inicio.
if (isset($_POST['volver'])) {
    $query = "SELECT * FROM usuarios ";
    $flag = false;
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Lista Usuarios</title>
    <?php include('header.php'); ?>
</head>


<body id="page-top">
    <div id="wrapper">
        <?php include('navbar.php'); ?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
            <?php include('navbar_superior.php'); ?>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Usuarios</h3>
                    <div class="row">
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-left-primary py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>Nuevo Usuario</span></div>
                                            <div class="text-dark font-weight-bold h5 mb-0"><span></span></div>
                                        </div>
                                        <div class="col-auto"><a class="btn btn-primary" href="crear_usuario.php"><i class="fas fa-user-plus  text-gray-300"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-left-warning py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"><span>Usuarios</span></div>

                                        </div>
                                        <div class="col-auto" style="color: darkgoldenrod;margin-right: 1rem; font-size: larger;">

                                            <?php echo  $cont; ?>

                                        </div>
                                        <div class="col-auto"><i class="fas fa-tasks fa-2x text-gray-300"></i></div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Información&nbsp;</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-nowrap">
                                    <!-- <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label>Mostrar&nbsp;<select class="form-control form-control-sm custom-select custom-select-sm"><option value="10" selected="">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select>&nbsp;</label></div> -->
                                    <?php
                                    if ($flag == true) { ?>
                                        <form method="POST" action="Lista_Usuarios.php">
                                            <input style="display: none;" type="text" name="busqueda" id="volver">
                                            <input type="submit" name="volver" class="btn btn-info btn-sm" value="Volver a la lista completa" />

                                        </form>
                                    <?php }
                                    $flag = false; ?>
                                </div>
                                <div class="col-md-6">
                                    <form method="POST" action="Lista_Usuarios.php">
                                        <div class="row">
                                            <div class="col" style="max-width: fit-content; margin-right: 0px; margin-left: auto;">
                                                <input type="text" name="busqueda" id="busqueda" placeholder="Ingrese nombre">
                                            </div>
                                            <div class="col" style="padding: 0px; max-width: fit-content;">
                                                <input type="submit" name="submit" class="btn btn-primary btn-sm" value="Buscar" />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table dataTable my-0" id="dataTable">
                                    <thead class="thead-dark">
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
                                    </thead>
                                    <tbody>

                                        <?php
                                        $filas = $user->mostrarDatosBusqueda($query);
                                        foreach ($filas as $fila) {
                                        ?>
                                            <tr>

                                                <!-- <td>/<?php //echo $fila['id_usuario'] 
                                                            ?></td> -->
                                                <td><?php echo $fila['nombre'] ?></td>
                                                <td><?php echo $fila['apellido'] ?></td>
                                                <td><?php echo $fila['rol'] ?></td>
                                                <td><?php echo $fila["alias"] ?></td>
                                                <td><?php echo $fila["pasword"] ?></td>
                                                <td><?php echo $fila["mail"] ?></td>
                                                <script src="cartel.js"> </script>
                                                <td><a class="btn btn-info mx-auto btn-circle ml-1" role="button" href="actualizar.php?editId=<?php echo $fila['id_usuario'] ?>"><i class="fas fa-user-circle text-white"></i></a></td>
                                                <td><a class="btn btn-danger mx-auto btn-circle ml-1" onclick="return confirmBorrar()" role="button" href="Lista_Usuarios.php?borrarid=<?php echo $fila['id_usuario'] ?>"><i class="fas fa-trash text-white"></i></a></td>

                                            </tr>
                                        <?php }  ?>


                                    </tbody>
                                   
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-6 align-self-center">
                                    <!-- <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Mostrando 1 al 10 de 27</p> -->

                                </div>
                                <!-- <div class="col-md-6"> 
                                <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                    <ul class="pagination">
                                        <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                                    </ul>
                                </nav>
                            </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include('footer.php'); ?>

</html>