<?php
session_start();
//vuelve a la pagina de inicio si no esta registrado
if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == '')) {
    header('location:index.php');
}
error_reporting(0);
include_once('Usuarios.class.php');


$user = new Usuario();

//extrae datos de usuaio
$sql = "SELECT * FROM usuarios WHERE id_usuario = '" . $_SESSION['user'] . "'";
$usuario = $user->detalle($sql);


?>

<!DOCTYPE html>
<html>

<head>
    <title>Detalle Usuario</title>
    <?php include('header.php'); ?>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include('navbar.php'); ?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
            <?php include('navbar_superior.php'); ?>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Detalle Usuario</h3>
                    <div class="row mb-3">

                        <div class="col-lg-12">

                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 font-weight-bold"><?php echo $usuario["nombre"]." ".$usuario["apellido"] ?></p>
                                        </div>
                                        <div class="card-body">
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Detalles</a>
                                                </li>
                                                <!-- <li class="nav-item" role="presentation">
                                                    <a class="nav-link" id="tareas-tab" data-toggle="tab" href="#tareas" role="tab" aria-controls="tareas" aria-selected="false">Tareas</a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" id="recursos-tab" data-toggle="tab" href="#recursos" role="tab" aria-controls="recursos" aria-selected="false">Recursos</a>
                                                </li> -->
                                                <?php if ((('Admin' == $row["rol"]) || ('Jefe Depto' == $row["rol"]) || ('Jefe Division' == $row["rol"]))) { ?>
                                                    <li class="nav-item" role="presentation">
                                                        <a class="nav-link" id="int-tab" data-toggle="tab" href="#int" role="tab" aria-controls="int" aria-selected="false">Integrantes</a>
                                                    </li>
                                                <?php }  ?>
                                            </ul>

                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                                    <form action="actualizar_proyecto.php" method="POST" class="formulario">

                                                        <div class="container form-row">
                                                            <div class="col-md-3">
                                                                <div class="form-group"><label for="nombre"><strong>Nombre&nbsp;</strong></label>
                                                                    <p><?php echo $fila_proy["nombre"] ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group"><label for="fecha"><strong>Fecha de Inicio</strong></label>
                                                                    <p><?php echo $fila_proy["fecha_inicio"] ?></p>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="form-group"><label for="identificador"><strong>Identificador&nbsp;</strong></label>
                                                                    <p><?php echo $fila_proy["identificador"] ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group"><label for="tema"><strong>Tema</strong></label>
                                                                    <p><?php echo $fila_proy["tema"] ?></p>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="form-group"><label for="descripcion"><strong>Descripcion</strong><br></label>
                                                                    <p><?php echo $fila_proy["descripcion"] ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group"><label for="sector"><strong>Sector</strong></label>
                                                                    <p><?php echo $fila_proy["sector"] ?></p>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="form-group"><label for="resp"><strong>Responsable</strong><br></label>
                                                                    <p><?php echo $aux_u["nombre"] ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group"><label for="frealizacion"><strong>Fecha finalizacion</strong><br></label>
                                                                    <p><?php echo $fila_proy["fecha_realizado"] ?></p>
                                                                </div>
                                                            </div>

                                                            
                                                            <div class="col-md-3">
                                                                <div class="form-group"><label for="estado"><strong>Estado</strong><br></label>
                                                                    <p><?php echo $fila_proy["estado"] ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group"><label for="horas"><strong>Horas Proyectadas Totales</strong><br></label>
                                                                    <p><?php echo $fila_proy["horas_dedicadas"] ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group"><label for="horasP"><strong>Horas Planificadas</strong><br></label>
                                                                    <p><?php echo $fila_proy["horas_acumuladas"] ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group"><label for="horasR" ><strong>Horas Relevadas</strong><br></label>
                                                                    <p><?php echo $fila_proy["horas_totales_relevadas"] ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group"><label for="obs"><strong>Observaciones</strong><br></label>
                                                                    <p><?php echo $fila_proy["observaciones"] ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="id_proyectos" value="<?php echo $fila_proy['id_proyectos']; ?>">
                                                        <!--  
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="archivo"><strong>Subir archivo</strong><br></label><br><input type="file"  class="btn btn-secondary btn-sm" name="archivo" value="agregar archivo"/></div>
                                                    </div>
                                                    
                                                </div>-->
                                                        <?php if ((('Admin' == $row["rol"]) || ('Jefe Depto' == $row["rol"]))) { ?>
                                                            <div class="form-row" style="margin-left:auto; right:0px; max-width:fit-content">


                                                                <div class="col" style="max-width:fit-content">


                                                                    <a class="btn btn-info mx-auto  ml-1" role="button" href="actualizar_proyecto.php?editId=<?php echo $fila_proy['id_proyectos'] ?>">Actualizar</a>
                                                                </div>
                                                                <div class="col" style="max-width:fit-content">
                                                                    <a class="btn btn-danger mx-auto btn-circle ml-1" onclick="return confirmBorrar()" role="button" href="Lista_proyectos.php?borrarid=<?php echo $fila_proy['id_proyectos'] ?>"><i class="fas fa-trash text-white"></i></a>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </form>


                                                </div>

                                                <!-- cierra home tab -->
                                                <div class="tab-pane fade" id="tareas" role="tabpanel" aria-labelledby="tareas-tab">

                                                    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                                        <table class="table dataTable my-0" id="dataTable">
                                                            <thead class="thead-dark">
                                                                <tr>

                                                                    <th>Nombre</th>
                                                                    <th>Descripcion</th>
                                                                    <th>Responsable</th>
                                                                    <th>Fecha de Inicio</th>
                                                                    <th>Fecha de Fin</th>
                                                                    <th>Estado</th>
                                                                    <th>Editar</th>
                                                                    <th>Eliminar</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <?php
                                                                $filas_tarea = $tarea->mostrarDatos_id($id_proy);
                                                                foreach ($filas_tarea as $fila) {
                                                                ?>
                                                                    <tr>
                                                                        <?php $aux_u2 = $user->mostrarFilaPorId($fila["responsable"]);
                                                                        ?>

                                                                        <td><?php echo $fila['nombre'] ?></td>
                                                                        <td><?php echo $fila['descripcion'] ?></td>
                                                                        <td><?php echo $aux_u2['nombre'] ?></td>
                                                                        <td><?php echo $fila['f_inicio'] ?></td>
                                                                        <td><?php echo $fila['f_final'] ?></td>
                                                                        <td><?php echo $fila["Estado"] ?></td>
                                                                        < <script src="cartel.js">
                                                                            </script>
                                                                            <!-- <td><a class="btn btn-primary mx-auto btn-circle ml-1"  role="button" href="crear_tarea.php?tareaId=<?php //echo $fila["id_proyectos"]; 
                                                                                                                                                                                        ?>"><i class="fas fa-file-medical text-white"></i></a></td> -->
                                                                            <!-- <td><a class="btn btn-secondary mx-auto btn-circle ml-1"  role="button" href="detalle_proyecto.php?detalleid=<?php //echo $fila["id_proyectos"]; 
                                                                                                                                                                                                ?>"><i class="fas fa-file-alt text-white"></i></a></td> -->
                                                                            <td><a class="btn btn-info mx-auto btn-circle ml-1" role="button" href="actualizar_tarea.php?editId=<?php echo $fila['id_tareas'] ?>"><i class="fas fa-user-circle text-white"></i></a></td>
                                                                            <td><a class="btn btn-danger mx-auto btn-circle ml-1" onclick="return confirmBorrar()" role="button" href="Lista_Tareas.php?borrarid=<?php echo $fila['id_tareas'] ?>"><i class="fas fa-trash text-white"></i></a></td>

                                                                    </tr>
                                                                <?php }  ?>


                                                            </tbody>

                                                        </table>
                                                    </div>
                                                    <!-- cierra TAREAS tab -->


                                                    <a class="btn btn-primary mx-auto  ml-1" role="button" href="crear_tarea.php">Nueva Tarea</a>
                                                </div>
                                                <div class="tab-pane fade" id="recursos" role="tabpanel" aria-labelledby="recursos-tab">recursos</div>
                                                <div class="tab-pane fade" id="int" role="tabpanel" aria-labelledby="int-tab">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                                                <table class="table dataTable my-0" id="table" data-show-print="true" data-toggle="table" data-search="true" data-pagination="true" data-show-columns="true" data-locale="es-ES">
                                                                    <thead class="thead-dark">
                                                                        <tr>
                                                                            <th data-field="Agente" data-sortable="true">Agente</th>
                                                                            <th data-field="Horas Dedicadas" data-sortable="true">Horas Dedicadas</th>
                                                                            <th data-field="Mes">Mes</th>
                                                                            <th data-field="Anio">Año</th>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="tablaDedicacionProyecto">

                                                                        <?php
                                                                        $filas = $proyecto->mostrarDatosPorImputacion($id_proy);
                                                                        foreach ($filas as $fila) {
                                                                        ?>
                                                                            <tr>
                                                                                <td><?php echo $fila['usuariosNombre'] ?></td>
                                                                                <td><?php echo $fila['horas'] ?></td>
                                                                                <td><?php echo $fila['mes'] ?></td>
                                                                                <td><?php echo $fila['anio'] ?></td>

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
                                        <div class="card-footer">
                                            <div class="row" id="boton-volver">
                                                <div class="col" style="max-width:fit-content">
                                                    <a class="btn btn-secondary" href="Lista_proyectos.php">Volver</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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