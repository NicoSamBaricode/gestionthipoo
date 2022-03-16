<?php
session_start();
//vuelve a la pagina de inicio si no esta registrado
if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == '')) {
    header('location:index.php');
}

include_once('Usuarios.class.php');
include_once('proyectos.class.php');
include_once('actividades.class.php');
include_once('dedicacion.class.php');
include_once('calendario.class.php');
include_once('funciones.php');
$user = new Usuario();
$dedicacion = new Dedicacion_class();
$proyecto = new Proyecto_class();
$calendario = new calendario_class();


//extrae datos de usuaio
$sql = "SELECT * FROM usuarios WHERE id_usuario = '" . $_SESSION['user'] . "'";
$row = $user->detalle($sql);
$usuario =  $_SESSION['user']; //numero de usuario
//tabla
$queryMiDedicacion = "SELECT * FROM dedicacion where id_agente = $usuario ORDER by `timeStamp` DESC" ;


//llama a la funcion de insertar datos
if (isset($_POST['submit'])) {

    $dedicacion->insertarDatos($_POST);
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Asignar Horas</title>
    <?php include('header.php'); ?>

</head>

<body id="page-top">
    <div id="wrapper">
        <?php include('navbar.php'); ?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>

                        <ul class="nav navbar-nav flex-nowrap ml-auto">


                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow" role="presentation">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small"><?php echo $row['nombre'] ?></span><img class="border rounded-circle img-profile" src="<?php echo $row['imagen'] ?>"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in" role="menu"><a class="dropdown-item" role="presentation" href="#"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Profile</a><a class="dropdown-item" role="presentation" href="#"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Settings</a>
                                        <a class="dropdown-item" role="presentation" href="#"><i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Registro de actividades</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" role="presentation" href="cerrar_sesion.php"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">

                    <div class="row mb-3">

                        <div class="col-lg-12">

                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 font-weight-bold">Asignar Horas</p>
                                        </div>
                                        <div class="card-body">
                                            <form action="crear_dedicacion.php" method="POST">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="id_agente"><strong>Agente</strong><br></label><select class="form-control" require name="id_agente" id="exampleFormControlSelect2">
                                                                <?php
                                                                $filas = $user->mostrarDatos();
                                                                foreach ($filas as $fila) {
                                                                ?>
                                                                    <option value="<?php echo $fila['id_usuario']; ?>">
                                                                        <?php echo $fila['nombre'] ?>
                                                                    </option>
                                                                <?php }  ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="mes"><strong>Mes</strong><br></label><select class="form-control" require name="mes" id="exampleFormControlSelect23">
                                                                <?php
                                                                $filasCalendario = $calendario->mostrarDatos();
                                                                foreach ($filasCalendario as $fila_c) {
                                                                ?>
                                                                    <option value="<?php echo $fila_c['id_Mes']; ?>">
                                                                        <?php echo $fila_c['nombre'] ?>
                                                                    </option>
                                                                <?php }  ?>
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="anio"><strong>Año</strong><br></label><input class="form-control" type="number" placeholder="Año" name="anio" min="2022"></input></div>
                                                    </div>
                                                </div>

                                                <div class="form-row">

                                                    <div class="col">
                                                        <div class="form-group"><label for="horas"><strong>Horas Planificadas</strong><br></label><input class="form-control" type="number" placeholder="Ingrese cantidad de horas" name="horas"></input></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="resp"><strong>Proyecto / Actividad</strong><br></label><select class="form-control" require name="imputacion" id="exampleFormControlSelect2">
                                                                <?php
                                                                $filas_p = $proyecto->mostrarDatosCompleto();
                                                                foreach ($filas_p as $fila_p) {
                                                                ?>
                                                                    <option value="<?php echo $fila_p['id_proyectos'] ?>"> <?php echo $fila_p['nombre'] ?></option>
                                                                <?php }  ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                                <!--  
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label for="archivo"><strong>Subir archivo</strong><br></label><br><input type="file"  class="btn btn-secondary btn-sm" name="archivo" value="agregar archivo"/></div>
                                                </div>
                                                
                                            </div>-->
                                                <div class="form-row" style="margin-left:auto; right:0px; max-width:fit-content">

                                                    <div class="col" style="max-width:fit-content">
                                                        <a class="btn btn-secondary" href="Lista_dedicacion.php">Volver</a>
                                                    </div>
                                                    <div class="col" style="max-width:fit-content">

                                                        <input type="submit" name="submit" class="btn btn-primary " value="Asignar Horas" />
                                                    </div>
                                                </div>
                                            </form>
                                        </div>



                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table dataTable my-0" id="table2" data-show-export="true" data-force-export="true" data-toggle="table" data-search="false" data-pagination="true" data-show-columns="true" data-locale="es-ES">
                                    <thead class="thead-dark">
                                        <tr>

                                            <th data-field="Mes" data-sortable="true">Mes</th>
                                            <th data-field="Horas P">Horas planificadas</th>
                                            <th data-field="Imputacion" data-sortable="true">Imputación</th>
                                            <!-- <th data-field="Editar">Editar</th> -->

                                        </tr>
                                    </thead>
                                    <tbody id="tablaDedicacionPersonalCrear">

                                        <?php
                                        $filas = $dedicacion->mostrarDatosBusqueda($queryMiDedicacion);
                                        foreach ($filas as $fila) {
                                        ?>
                                            <tr>
                                                <?php $aux_p = $proyecto->mostrarFilaPorId($fila["imputacion"], 2);
                                                $aux_u = $user->mostrarFilaPorId($fila["id_agente"]); //aca tengo el nombre del usuario
                                                ?>

                                                <td><?php echo $fila['mes'] ?></td>
                                                <td class="centrarRegistros"><?php echo $fila['horas'] ?></td>

                                                <td><?php echo $aux_p['nombre'] ?></td>

                                                <script src="cartel.js"> </script>
                                                <!-- <td><a class="btn btn-primary mx-auto btn-circle ml-1"  role="button" href="crear_tarea.php?tareaId=<?php //echo $fila["id_proyectos"]; 
                                                                                                                                                            ?>"><i class="fas fa-file-medical text-white"></i></a></td> -->

                                                <!-- <td><a class="btn btn-info mx-auto btn-circle ml-1" role="button" href="actualizar_dedicacion.php?editId=<?php echo $fila['id_dedicacion'] ?>"><i class="fa fa-edit text-white"></i></a></td> -->
                                                <!-- <td><a class="btn btn-danger mx-auto btn-circle ml-1" onclick="return confirmBorrar()" role="button" href="Lista_dedicacion.php?borrarid=<?php echo $fila['id_dedicacion'] ?>"><i class="fas fa-trash text-white"></i></a></td> -->

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

</html>