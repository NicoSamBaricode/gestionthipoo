<?php
session_start();
//vuelve a la pagina de inicio si no esta registrado
if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == '')) {
    header('location:index.php');
}

include_once('Usuarios.class.php');
include_once('proyectos.class.php');
include_once('actividades.class.php');

$user = new Usuario();
$proyecto = new Proyecto_class();
$actividad = new actividades_class();

//extrae datos de usuaio
$sql = "SELECT * FROM usuarios WHERE id_usuario = '" . $_SESSION['user'] . "'";
$row = $user->detalle($sql);

//contador usuarios
$cont = $user->cont_u();

//contador proyectos
$cont_p = $proyecto->cont_p();


/*
echo "contador proyectos:".$cont_p;
echo  "contador Usuarios:". $cont;
echo $row['nombre'];
echo $row['alias'];
echo $row['rol'];
*/
?>


<!DOCTYPE html>
<html>

<head>
    <title>Panel principal</title>
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
                                    <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in" role="menu"><a class="dropdown-item" role="presentation" href="#"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Editar perfil</a><a class="dropdown-item" role="presentation" href="#"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Settings</a>
                                        <a class="dropdown-item" role="presentation" href="#"><i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Registro de actividades</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" role="presentation" href="cerrar_sesion.php"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Cerrar Sesion</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>

                <!-- arranca Admin -->
                <?php if ('Admin' == $row["rol"]) { ?>

                    <div class="container-fluid">
                        <div class="d-sm-flex justify-content-between align-items-center mb-4">
                            <h3 class="text-dark mb-0">Panel principal</h3><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="javascript:window.print()"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generar Reporte</a>
                        </div>
                        <!-- <div class="row" >
                            <div class="col-md-6 col-xl-3 mb-4">
                                <div class="card shadow border-left-info py-2">
                                    <div class="card-body">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col mr-2">
                                                <div class="text-uppercase text-info font-weight-bold text-xs mb-1"><span>Usuarios Registrados</span></div>
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-auto">
                                                        <div class="text-dark font-weight-bold h5 mb-0 mr-3"><span>
                                                                <?php echo  $cont; ?>
                                                            </span></div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-auto"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></div>
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
                                                <div class="text-dark font-weight-bold h5 mb-0"><span>
                                                        <?php echo $cont_p; ?>
                                                    </span></div>
                                            </div>
                                            <div class="col-auto"><i class="fas fa-comments fa-2x text-gray-300"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->



                        <div class="row">
                            <div class="col">
                                <div class="card shadow mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h6 class="text-primary font-weight-bold m-0">Ocupación del personal</h6>

                                    </div>


                                    <!-- grafico de torta -->
                                    <div class="card-body">
                                        <div id="chart-container">
                                            <canvas id="graphCanvas"></canvas>
                                        </div>

                                        <script>
                                            $(document).ready(function() {
                                                showGraph();
                                            });


                                            function showGraph() {
                                                {
                                                    $.post("grafico.php",
                                                        function(data) {
                                                            console.log(data);
                                                            var name = [];
                                                            var marks = [];
                                                            var color = [];

                                                            for (var i in data) {
                                                                name.push(data[i].nombre);
                                                                marks.push(data[i].horas_dedicadas);
                                                                color.push(data[i].color_act);
                                                            }

                                                            var chartdata = {
                                                                labels: name,
                                                                datasets: [{
                                                                    label: 'Ocupacion',
                                                                    backgroundColor: color,
                                                                    borderColor: '#ffff',
                                                                    hoverBackgroundColor: '#CCCCCC',
                                                                    hoverBorderColor: '#666666',
                                                                    data: marks
                                                                }]
                                                            };

                                                            var graphTarget = $("#graphCanvas");

                                                            var barGraph = new Chart(graphTarget, {
                                                                type: 'doughnut',
                                                                data: chartdata
                                                            });
                                                        });
                                                }
                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>




                            <!-- grafico de barra -->
                            <div class="col">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="text-primary font-weight-bold m-0">Proyectos</h6>
                                    </div>
                                    <div class="card-body">

                                        <?php //contador proyectos realiados
                                        $estado = 'Realizado';
                                        $cont_p_c = $proyecto->cont_p_estado($estado);
                                        $porcentaje = ($cont_p_c * 100) / $cont_p;
                                        ?>

                                        <h4 class="small font-weight-bold">Realizados<span class="float-right"><?php echo  $porcentaje . "%"; ?></span></h4>
                                        <div class="progress mb-4">
                                            <div class="progress-bar bg-success" aria-valuenow="" aria-valuemin="0" aria-valuemax="100%" style="width:<?php echo  $porcentaje; ?>%"><span class="sr-only"></span></div>
                                        </div>
                                        <?php unset($porcentaje);
                                        unset($estado) ?>

                                        <!-- Termina realizados -->

                                        <?php //contador proyectos cancelados
                                        $estado = 'Cancelado';
                                        $cont_p_c = $proyecto->cont_p_estado($estado);
                                        $porcentaje = ($cont_p_c * 100) / $cont_p;
                                        ?>

                                        <h4 class="small font-weight-bold">Cancelados<span class="float-right"><?php echo  $porcentaje . "%"; ?></span></h4>
                                        <div class="progress mb-4">
                                            <div class="progress-bar bg-danger" aria-valuenow="" aria-valuemin="0" aria-valuemax="100%" style="width:<?php echo  $porcentaje; ?>%"><span class="sr-only"></span></div>
                                        </div>
                                        <?php unset($porcentaje);
                                        unset($estado) ?>

                                        <!-- Termina cancelados -->

                                        <?php //contador proyectos en proceso
                                        $estado = 'En proceso';
                                        $cont_p_c = $proyecto->cont_p_estado($estado);
                                        $porcentaje = ($cont_p_c * 100) / $cont_p;
                                        ?>

                                        <h4 class="small font-weight-bold">En proceso<span class="float-right"><?php echo  $porcentaje . "%"; ?></span></h4>
                                        <div class="progress mb-4">
                                            <div class="progress-bar bg-primary" aria-valuenow="" aria-valuemin="0" aria-valuemax="100%" style="width:<?php echo  $porcentaje; ?>%"><span class="sr-only"></span></div>
                                        </div>
                                        <?php unset($porcentaje);
                                        unset($estado) ?>

                                        <!-- Termina En proceso -->

                                        <?php //contador proyectos Pendiente
                                        $estado = 'Pendiente';
                                        $cont_p_c = $proyecto->cont_p_estado($estado);
                                        $porcentaje = ($cont_p_c * 100) / $cont_p;
                                        ?>

                                        <h4 class="small font-weight-bold">Pendientes<span class="float-right"><?php echo  $porcentaje . "%"; ?></span></h4>
                                        <div class="progress mb-4">
                                            <div class="progress-bar bg-warning" aria-valuenow="" aria-valuemin="0" aria-valuemax="100%" style="width:<?php echo  $porcentaje; ?>%"><span class="sr-only"></span></div>
                                        </div>
                                        <?php unset($porcentaje);
                                        unset($estado) ?>

                                        <!-- Termina pendientes -->

                                        <?php //contador proyectos a revisar
                                        $estado = 'Revisar';
                                        $cont_p_c = $proyecto->cont_p_estado($estado);
                                        $porcentaje = ($cont_p_c * 100) / $cont_p;
                                        ?>

                                        <h4 class="small font-weight-bold">A revisar<span class="float-right"><?php echo  $porcentaje . "%"; ?></span></h4>
                                        <div class="progress mb-4">
                                            <div class="progress-bar bg-info" aria-valuenow="" aria-valuemin="0" aria-valuemax="100%" style="width:<?php echo  $porcentaje; ?>%"><span class="sr-only"></span></div>
                                        </div>
                                        <?php unset($porcentaje);
                                        unset($estado) ?>

                                        <!-- Termina pendientes -->

                                    </div> <!-- termina CARD -->

                                </div>

                            </div>
                        </div>



                    <?php } ?>
                    <!-- termina Admin -->


                    <!-- arranca agente -->
                    
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 col-xl-3 mb-4">
                                    <a class="card shadow border-left-info py-2 btn" href="crear_dedicacion.php">
                                        <div class="card-body">
                                            <div class="row align-items-center no-gutters">
                                                <div class="col mr-2">
                                                    <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>Agregar Dedicación</span></div>
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col-auto">

                                                            <!-- Contenido -->

                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-6 col-xl-3 mb-4">
                                    <a class="card shadow border-left-primary  py-2 btn" href="https://portal.cnea.gob.ar/app/web/ " target="_blank">
                                        <div class="card-body">
                                            <div class="row align-items-center no-gutters">
                                                <div class="col mr-2">
                                                    <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>Portal Teletrabajo</span></div>
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col-auto">

                                                            <!-- Contenido -->

                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-briefcase fa-2x text-gray-300"></i></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-6 col-xl-3 mb-4">
                                    <a class="card shadow border-left-warning  py-2 btn" href="https://portal.cnea.gob.ar/app/web/buscador-agenda/index " target="_blank">
                                        <div class="card-body">
                                            <div class="row align-items-center no-gutters">
                                                <div class="col mr-2">
                                                    <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>Agenda Institucional</span></div>
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col-auto">

                                                            <!-- Contenido -->

                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-atlas fa-2x text-gray-300"></i></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-6 col-xl-3 mb-4">
                                    <a class="card shadow border-left-secondary  py-2 btn" href="https://comunidades.cnea.gob.ar/new/ " target="_blank">
                                        <div class="card-body">
                                            <div class="row align-items-center no-gutters">
                                                <div class="col mr-2">
                                                    <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>Comunidades-News</span></div>
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col-auto">

                                                            <!-- Contenido -->

                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-bullhorn fa-2x text-gray-300"></i></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-6 col-xl-3 mb-4">
                                    <a class="card shadow border-left-danger  py-2 btn" href="https://gestion.cab.cnea.gov.ar/ " target="_blank">
                                        <div class="card-body">
                                            <div class="row align-items-center no-gutters">
                                                <div class="col mr-2">
                                                    <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>Gestion Cab</span></div>
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col-auto">

                                                            <!-- Contenido -->

                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-chart-pie fa-2x text-gray-300"></i></div>
                                            </div>
                                        </div>
                                    </a>
                                </div> <div class="col-md-6 col-xl-3 mb-4">
                                    <a class="card shadow border-left-success  py-2 btn" href="https://webmail.cab.cnea.gov.ar/ " target="_blank">
                                        <div class="card-body">
                                            <div class="row align-items-center no-gutters">
                                                <div class="col mr-2">
                                                    <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>WebMail</span></div>
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col-auto">

                                                            <!-- Contenido -->

                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-mail-bulk fa-2x text-gray-300"></i></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-6 col-xl-3 mb-4">
                                    <a class="card shadow border-left-primary py-2  btn" href="file://10.73.34.78/Publico/01.Accesos%20Directos/" target="_blank">
                                        <div class="card-body">
                                            <div class="row align-items-center no-gutters">
                                                <div class="col mr-2">
                                                    <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>Ingresar a Nas</span></div>
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col-auto">
                                                            
                                                            

                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-archive fa-2x text-gray-300"></i></div>
                                            </div>
                                        </div>
                    </a>
                                </div>
                            </div>
                        </div>
                  
                    <!-- termina agente -->
                    </div>
            </div>

        </div>
    </div>

</body>
<?php include('footer.php'); ?>

</html>