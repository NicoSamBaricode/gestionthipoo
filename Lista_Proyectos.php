<?php
session_start();
//vuelve a la pagina de inicio si no esta registrado
if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == '')) {
    header('location:index.php');
}

include_once('Usuarios.class.php');
include_once('proyectos.class.php');
include_once('tareas.class.php');

$user = new Usuario();
$proyecto = new Proyecto_class();
$tareas = new Tarea_class();
$tipo = 1; //significa que es efectivamente un proyecto
//extrae datos de usuaio
$sql = "SELECT * FROM usuarios WHERE id_usuario = '" . $_SESSION['user'] . "'";
$row = $user->detalle($sql);
$sectorUsuario = $row['sector_id'];
//contador proyectos
$cont = $proyecto->cont_p(2, 2);

//contador tareas
$cont_t = $tareas->cont_t();


//llama funcion borrar
if (isset($_GET['borrarid']) && !empty($_GET['borrarid'])) {
    $borrarId = $_GET['borrarid'];
    $proyecto->borrar_proyecto($borrarId, $tipo);
}
//carga los datos cuando recien entra a la pagina

$query = "SELECT * FROM proyectos where tipo = '$tipo' ";


//bandera para que desaparezca boton volver a la lista
$flag = false;



?>
<!DOCTYPE html>
<html>

<head>
    <title>Proyectos</title>
    <?php include('header.php'); ?>
</head>



<body id="page-top">
    <div id="wrapper">
        <?php include('navbar.php'); ?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php include('navbar_superior.php'); ?>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Proyectos</h3>
                    <?php if ('Agente' != $row["rol"]) {

                    ?>
                        <div class="row">
                            <div class="col-md-6 col-xl-3 mb-4" id="NuevoProyecto">
                                <div class="card shadow border-left-primary py-2">
                                    <div class="card-body">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col mr-2">
                                                <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>Nuevo Proyecto</span></div>
                                                <div class="text-dark font-weight-bold h5 mb-0"><span></span></div>
                                            </div>
                                            <?php if ($row['rol'] == 'Admin' || ('Jefe Depto' == $row["rol"])) { ?>
                                                <div class="col-auto"><a class="btn btn-primary" href="crear_proyecto.php"><i class="fas fa-user-plus  text-gray-300"></i></a></div>
                                            <?php } else { ?>
                                                <div class="col-auto"><a class="btn btn-primary" target="_blank" href="mailto:agustin.coleff@cab.cnea.gov.ar "><i class="fas fa-user-plus  text-gray-300"></i></a></div>
                                            <?php  } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-3 mb-4">
                                <div class="card shadow border-left-warning py-2">
                                    <div class="card-body">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col mr-2">
                                                <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"><span>Proyectos</span></div>

                                            </div>
                                            <div class="col-auto" style="color: darkgoldenrod;margin-right: 1rem; font-size: larger;">

                                                <?php echo  $cont; ?>

                                            </div>
                                            <div class="col-auto"><i class="fas fa-tasks fa-2x text-gray-300"></i></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-left-dark py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-black font-weight-bold text-xs mb-1"><span>Nueva Tarea</span></div>
                                            <div class="text-dark font-weight-bold h5 mb-0"><span></span></div>
                                        </div>
                                        <div class="col-auto"><a class="btn btn-dark" href="crear_tarea.php"><i class="fas fa-file-medical  text-gray-300"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-left-info py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-info font-weight-bold text-xs mb-1"><span>Tareas</span></div>

                                        </div>
                                        <div class="col-auto" style="color: darkgoldenrod;margin-right: 1rem; font-size: larger;">

                                            <?php echo  $cont_t; ?>

                                        </div>
                                        <div class="col-auto"><i class="fas fa-tasks fa-2x text-gray-300"></i></div>

                                    </div>
                                </div>
                            </div>
                        </div> -->


                        </div>
                    <?php } ?>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Información&nbsp;</p>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table dataTable my-0" id="dataTable" data-show-export="true" data-force-export="true" data-toggle="table" data-search="true" data-pagination="true" data-show-columns="true" data-locale="es-ES">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th data-field="Id" data-sortable="true">Id</th>
                                            <th data-field="Nombre" data-sortable="true">Nombre</th>
                                            <th data-field="Sector" data-sortable="true">Sector</th>
                                            <th data-field="proyectadas" data-sortable="true">Horas Proyectadas Total</th>

                                            <th data-field="dedicadas" data-sortable="true">Horas Dedicadas</th>
                                            <th data-field="relevadas" data-sortable="true">Horas Relevadas</th>
                                            <th data-field="Estado" data-sortable="true">Estado</th>

                                            <th>Detalles</th>
                                            <?php if ((('Admin' == $row["rol"]) || ('Jefe Depto' == $row["rol"]))) {

                                            ?>
                                                <th id="borrar1" class="editar">Editar</th>
                                                <th id="borrar2" class="eliminar">Eliminar</th>
                                            <?php }  ?>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $filas = $proyecto->mostrarDatosBusqueda($query);

                                        foreach ($filas as $fila) {
                                        ?>
                                            <tr>
                                                <?php
                                                $nombreSector = $proyecto->mostrarNombreSector($fila['id_proyectos'])
                                                ?>
                                                <!-- <td>/<?php //echo $fila['id_proyectos'] 
                                                            ?></td> -->
                                                <td><?php echo $fila['identificador'] ?></td>
                                                <td><?php echo $fila['nombre'] ?></td>
                                                <td><?php echo ($nombreSector['Nombre']) ?></td>

                                                <td><?php echo $fila['horas_dedicadas'] ?></td>
                                                <td><?php echo $fila["horas_acumuladas"] ?></td>
                                                <td><?php echo $fila["horas_totales_relevadas"] ?></td>
                                                <td><?php echo $fila["estado"] ?></td>
                                                <script src="cartel.js"> </script>
                                                <!-- <td><a class="btn btn-primary mx-auto btn-circle ml-1"  role="button" href="crear_tarea.php?tareaId=<?php echo $fila["id_proyectos"]; ?>"><i class="fas fa-file-medical text-white"></i></a></td> -->

                                                <td><a class="btn btn-secondary mx-auto btn-circle ml-1 " role="button" href="detalle_proyecto.php?detalleid=<?php echo $fila["id_proyectos"]; ?>"><i class="fas fa-file-alt text-white"></i></a></td>
                                                <?php if ((('Admin' == $row["rol"]) || ('Jefe Depto' == $row["rol"]))) {

                                                ?>
                                                    <td class="editar"><a class="btn btn-info mx-auto btn-circle ml-1 editar" role="button" href="actualizar_proyecto.php?editId=<?php echo $fila['id_proyectos'] ?>"><i class="fas fa-edit text-white"></i></a></td>
                                                    <td class="eliminar"><a class="btn btn-danger mx-auto btn-circle ml-1 eliminar" onclick="return confirmBorrar()" role="button" href="Lista_proyectos.php?borrarid=<?php echo $fila['id_proyectos'] ?>"><i class="fas fa-trash text-white"></i></a></td>
                                                <?php }  ?>
                                            </tr>
                                        <?php }  ?>


                                    </tbody>

                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<?php include('footer.php'); ?>
<script>
    $(document).ready(function() {


    });
</script>

</html>