<?php
error_reporting(0);
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
$cont_p = $proyecto->cont_p($row['sector_id'], $row['rol']);



$id_usuario = $row['id_usuario'];


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
                <?php include('navbar_superior.php'); ?>
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
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
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
                <!-- arranca Admin -->
                <?php if (('Admin' == $row["rol"]) or ('Jefe Depto' == $row["rol"]) or ('Jefe Division' == $row["rol"])) { ?>

                    <div class="container-fluid">
                        <div class="d-sm-flex justify-content-between align-items-center mb-4">
                            <!-- <h3 class="text-dark mb-0">Panel principal</h3> -->
                            <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="javascript:window.print()"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generar Reporte</a>
                        </div>




                        <div class="row">
                            <div class="col">
                                <div class="card shadow mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h6 class="text-primary font-weight-bold m-0">Proyectos y actividades del departamento</h6>

                                    </div>
                                    <div class="col">
                                        <label for="filtros">Ordenar por:</label>
                                        <select class="form-control" id="filtros">
                                            <option value="nombre">Nombre</option>
                                            <option value="horas_dedicadas">Cantidad de horas</option>

                                        </select>
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
                                            var resetCanvass = function() {
                                                $('#graphCanvas').remove(); // this is my <canvas> element
                                                $('#chart-container').append('<canvas id="graphCanvas"><canvas>');
                                                canvas = document.querySelector('#graphCanvas');
                                                ctx = canvas.getContext('2d');

                                            };
                                            $("#filtros").on("change", function() {
                                                resetCanvass();
                                                showGraph();
                                            });

                                            function showGraph() {
                                                {
                                                    $.post("grafico.php", {

                                                            id_usuario: <?php echo $id_usuario; ?>,
                                                            filtro: $("#filtros").val(),

                                                        },
                                                        function(data) {

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
                                                                    borderColor: 'rgba(200, 200, 200, 0.75)',
                                                                    borderColor: '#ffff',
                                                                    hoverBackgroundColor: '#CCCCCC',
                                                                    hoverBorderColor: '#666666',
                                                                    data: marks
                                                                }]
                                                            };

                                                            var graphTarget = $("#graphCanvas");

                                                            var barGraph = new Chart(graphTarget, {
                                                                options: {
                                                                    legend: {
                                                                        position: "left",
                                                                        align: 'start',
                                                                        textAlign: 'left',

                                                                    }
                                                                },
                                                                type: 'bar',
                                                                data: chartdata
                                                            });
                                                        });
                                                }
                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>

                        </div>



                    <?php } ?>

                    </div>
            </div>

        </div>
    </div>

</body>
<?php include('footer.php'); ?>

</html>