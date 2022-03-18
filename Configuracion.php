<?php
session_start();
//vuelve a la pagina de inicio si no esta registrado
if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == '')) {
    header('location:index.php');
}

include_once('calendario.class.php');
include_once('Usuarios.class.php');

$calendario = new calendario_class();
$user= new Usuario();

//extrae datos de usuaio
$sql = "SELECT * FROM usuarios WHERE id_usuario = '" . $_SESSION['user'] . "'";
$row = $user->detalle($sql);




//carga los datos cuando recien entra a la pagina
$query = "SELECT * FROM mes ";




?>
<!DOCTYPE html>
<html>

<head>
    <title>Configuración.</title>
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
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small"><?php echo $row['nombre']; ?></span><img class="border rounded-circle img-profile" src="/GestionThi/gestionthipoo/assets/img/logo-cnea2.png"></a>
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
                    <h3 class="text-dark mb-4">Configuración</h3>
                    
                    <div class="card shadow " >
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Horas Laborables Por Mes&nbsp;</p>
                        </div>
                        <div class="card-body" style="text-align: center;">
                            
                            <div class="table-responsive table mt-2 " id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table dataTable my-0 col-md-6" id="dataTable">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Mes</th>
                                            <th>Horas Laborables</th>
                                            <th>Editar</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $filas = $calendario->mostrarDatosBusqueda($query);
                                        foreach ($filas as $fila) {
                                        ?>
                                            <tr>

                                                <!-- <td>/<?php //echo $fila['id_usuario'] 
                                                            ?></td> -->
                                                <td><?php echo $fila['nombre'] ?></td>
                                                <td><?php echo $fila['horas_Totales'] ?></td>
                                               
                                                <script src="cartel.js"> </script>
                                                <td><a class="btn btn-info mx-auto btn-circle ml-1" role="button" href="actualizar_Calendario.php?editId=<?php echo $fila['id_Mes'] ?>"><i class="fas fa-edit text-white"></i></a></td>

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