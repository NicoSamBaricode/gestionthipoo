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

$user = new Usuario();
$proyecto = new Proyecto_class();
$dedicacion = new Dedicacion_class();

//extrae datos de usuaio
$sql = "SELECT * FROM usuarios WHERE id_usuario = '" . $_SESSION['user'] . "'";
$row = $user->detalle($sql);


//llama funcion borrar
if (isset($_GET['borrarid']) && !empty($_GET['borrarid'])) {
    $borrarId = $_GET['borrarid'];
    $dedicacion->borrar_dedic($borrarId);
}
//carga los datos cuando recien entra a la pagina
$query = "SELECT * FROM dedicacion ";





?>
<!DOCTYPE html>
<html>

<head>
    <title>Mi Dedicacion</title>
    <?php include('header.php'); ?>
    <!-- no anda el exportar archivos -->
    <link href="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.css" rel="stylesheet">
    <script src="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table-locale-all.min"></script>
    <script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/tableExport.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF/jspdf.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
</head>

<script>
    $(document).ready(function() {
        $(document).on('change', '#selectormes', function() {
            alert("The text has been changed.");
        });


    });
</script>

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
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small"><?php echo $row['nombre']; ?></span><img class="border rounded-circle img-profile" src="<?php echo $row['imagen'] ?>"></a>
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
                    <h3 class="text-dark mb-4">Mi Dedicacion</h3>
                    <div class="row">
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-left-primary py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>Ingresar Horas</span></div>
                                            <div class="text-dark font-weight-bold h5 mb-0"><span></span></div>
                                        </div>
                                        <div class="col-auto"><a class="btn btn-primary" href="crear_dedicacion.php"><i class="fas fa-file-medical  text-gray-300"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-left-warning py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"><span>Próximo Vencimiento</span></div>

                                        </div>
                                        <div class="col-auto" style="color: darkgoldenrod;margin-right: 1rem; font-size: larger;">

                                            <?php echo "12 dias"; ?>

                                        </div>
                                        <div class="col-auto"><i class="fas fa-tasks fa-2x text-gray-300"></i></div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Listado Dedicación&nbsp;</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label>Mostrar&nbsp;<select class="form-control form-control-sm custom-select custom-select-sm">
                                                <option value="5" selected="">5</option>
                                                <option value="10">10</option>
                                                <option value="20">20</option>
                                                <option value="100">Todos</option>
                                            </select>&nbsp;</label></div>

                                    
                                </div>
                                <div class="col-md-3" style=" margin-left: 0px; margin-right: auto;">
                                    <select class="form-control form-control-sm" id="selectormes">
                                        <option selected>Filtrar por mes</option>
                                        <option value="1">Enero</option>
                                        <option value="2">Febrero</option>
                                        <option value="3">Marzo</option>
                                        <option value="4">Abril</option>
                                        <option value="5">Mayo</option>
                                        <option value="6">Junio</option>
                                        <option value="7">Julio</option>
                                        <option value="8">Agosto</option>
                                        <option value="9">Septiembre</option>
                                        <option value="10">Octubre</option>
                                        <option value="11">Noviembre</option>
                                        <option value="12">Diciembre</option>
                                    </select>
                                </div>
                               
  
                                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                    <table class="table dataTable my-0" id="table"                                    
                                    data-show-export="true" 
                                    data-force-export="true"
                                    data-toggle="table" 
                                     data-search="true"
                                     data-pagination="true"
                                      data-show-columns="true"
                                      data-locale="es-ES">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th data-field="Mes">Mes</th>
                                                <th data-field="Horas P">Horas planificadas</th>
                                                <th data-field="Horas R">Horas relevadas</th>
                                                <th data-field="Imputacion">Imputación</th>
                                                <th data-field="Editar">Editar</th>
                                                <th data-field="Borrar"> Eliminar</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tablaDedicacion">

                                            <?php
                                            $filas = $dedicacion->mostrarDatosBusqueda($query);
                                            foreach ($filas as $fila) {
                                            ?>
                                                <tr>
                                                    <?php $aux_p = $proyecto->mostrarFilaPorId($fila["imputacion"]);
                                                    // $aux_u = $user->mostrarFilaPorId($fila["id_agente"]);//aca tengo el nombre del usuario
                                                    ?>

                                                    <td><?php echo $fila['mes'] ?></td>
                                                    <td class="centrarRegistros"><?php echo $fila['horas'] ?></td>
                                                    <td><?php echo $fila['horas'] ?></td>
                                                    <td><?php echo $aux_p['nombre'] ?></td>

                                                    <script src="cartel.js"> </script>
                                                    <!-- <td><a class="btn btn-primary mx-auto btn-circle ml-1"  role="button" href="crear_tarea.php?tareaId=<?php //echo $fila["id_proyectos"]; 
                                                                                                                                                                ?>"><i class="fas fa-file-medical text-white"></i></a></td> -->

                                                    <td><a class="btn btn-info mx-auto btn-circle ml-1" role="button" href="actualizar_dedicacion.php?editId=<?php echo $fila['id_dedicacion'] ?>"><i class="fa fa-edit text-white"></i></a></td>
                                                    <td><a class="btn btn-danger mx-auto btn-circle ml-1" onclick="return confirmBorrar()" role="button" href="Lista_dedicacion.php?borrarid=<?php echo $fila['id_dedicacion'] ?>"><i class="fas fa-trash text-white"></i></a></td>

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
        </div>
        
</body>
<?php include('footer.php'); ?>

</html>