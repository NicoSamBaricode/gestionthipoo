<?php
session_start();
//vuelve a la pagina de inicio si no esta registrado
if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == '')) {
    header('location:index.php');
}

include_once('Usuarios.class.php');
include_once('tareas.class.php');
include_once('proyectos.class.php');

$user = new Usuario();
$actividad = new Proyecto_class();
$tareas = new Tarea_class();

$tipo = 0;
//extrae datos de usuaio
$sql = "SELECT * FROM usuarios WHERE id_usuario = '" . $_SESSION['user'] . "'";
$row = $user->detalle($sql);

//contador actividades
$cont = $actividad->contadorPorColumna($tipo, 'tipo');

//contador tareas
$cont_t = $tareas->cont_t();


//llama funcion borrar
if (isset($_GET['borrarid']) && !empty($_GET['borrarid'])) {
    $borrarId = $_GET['borrarid'];
    $actividad->borrar_proyecto($borrarId, $tipo);
}
//carga los datos cuando recien entra a la pagina
$query = "SELECT proyectos.id_proyectos, proyectos.identificador,proyectos.nombre,proyectos.descripcion,proyectos.horas_dedicadas,proyectos.sector,sector.nombre as nombreSector FROM proyectos LEFT JOIN sector ON proyectos.sector=sector.Sector_id where proyectos.Tipo = '$tipo' ";
//bandera para que desaparezca boton volver a la lista
$flag = false;


?>
<!DOCTYPE html>
<html>

<head>
    <title>Actividades</title>
    <?php include('header.php'); ?>
</head>


<body id="page-top">
    <div id="wrapper">
        <?php include('navbar.php'); ?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php include('navbar_superior.php'); ?>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Actividades</h3>
                    <div class="row">
                        <?php if (('Agente' != $row["rol"])) { ?>
                            <div class="col-md-6 col-xl-3 mb-4">
                                <div class="card shadow border-left-primary py-2">
                                    <div class="card-body">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col mr-2">
                                                <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>Nueva Actividad</span></div>
                                                <div class="text-dark font-weight-bold h5 mb-0"><span></span></div>
                                            </div>

                                            <?php if ($row['rol'] == 'Admin' || ('Jefe Depto' == $row["rol"])) { ?>
                                                <div class="col-auto"><a class="btn btn-primary" href="crear_actividades.php"><i class="fas fa-user-plus  text-gray-300"></i></a></div>
                                            <?php } else { ?>
                                                <div class="col-auto"><a class="btn btn-primary" target="_blank" href="mailto:agustin.coleff@cab.cnea.gov.ar "><i class="fas fa-user-plus  text-gray-300"></i></a></div>
                                            <?php  } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } else {   ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Atención:</strong> Para agregar una nueva actividad, contactate con tu jefe directo.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        <?php  } ?>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-left-warning py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"><span>Actividades</span></div>

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
                            <p class="text-primary m-0 font-weight-bold">Listado&nbsp;</p>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table dataTable my-0" id="dataTable" data-show-export="true" data-force-export="true" data-toggle="table" data-search="true" data-pagination="true" data-show-columns="true" data-locale="es-ES">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th data-field="Id" data-sortable="true">Acronimo</th>
                                            <th data-field="Nombre" data-sortable="true">Nombre</th>
                                            <th data-field="Descripcion" data-sortable="true">Descripción</th>
                                            <th>Horas asignadas</th>
                                            <th data-field="Sector" data-sortable="true">Sector</th>
                                            <th data-field="Detalles" data-sortable="true">Detalles</th>
                                            <?php if ((('Admin' == $row["rol"]) || ('Jefe Depto' == $row["rol"]))) { ?>
                                                <th class="editar">Editar</th>
                                                <th class="eliminar">Eliminar</th>
                                            <?php }  ?>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $filas = $actividad->mostrarDatosBusqueda($query);
                                        foreach ($filas as $fila) {
                                        ?>
                                            <tr>


                                                <!-- <td hide="true"><?php echo $fila['id_proyectos'] ?></td> -->
                                                <td><?php echo $fila['identificador'] ?></td>
                                                <td><?php echo $fila['nombre'] ?></td>
                                                <td><?php echo $fila['descripcion'] ?></td>

                                                <td><?php echo $fila['horas_dedicadas'] ?></td>
                                                <td><?php echo $fila['nombreSector'] ?></td>
                                                <td><a class="btn btn-secondary mx-auto btn-circle ml-1 " role="button" href="detalle_actividad.php?detalleid=<?php echo $fila["id_proyectos"]; ?>"><i class="fas fa-file-alt text-white"></i></a></td>

                                                <script src="cartel.js"> </script>
                                                <!-- <td><a class="btn btn-primary mx-auto btn-circle ml-1"  role="button" href="crear_tarea.php?tareaId=<?php echo $fila["id_proyectos"]; ?>"><i class="fas fa-file-medical text-white"></i></a></td> -->
                                                <?php if ((('Admin' == $row["rol"]) || ('Jefe Depto' == $row["rol"]))) {

                                                ?>
                                                    <td><a class="btn btn-info mx-auto btn-circle ml-1" role="button" href="actualizar_actividades.php?editId=<?php echo $fila['id_proyectos'] ?>"><i class="fas fa-edit text-white"></i></a></td>
                                                    <td><a class="btn btn-danger mx-auto btn-circle ml-1" onclick="return confirmBorrar()" role="button" href="Lista_actividades.php?borrarid=<?php echo $fila['id_proyectos'] ?>"><i class="fas fa-trash text-white"></i></a></td>
                                                <?php }  ?>
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