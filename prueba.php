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

        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
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
                                                    var relev = [];
                                                    var color = [];

                                                    for (var i in data) {
                                                        name.push(data[i].nombre);
                                                        marks.push(data[i].horas_dedicadas);
                                                        relev.push(data[i].horas_acumuladas);
                                                        color.push(data[i].color_act);
                                                    }

                                                    var chartdata = {

                                                        labels: name,
                                                       
                                                        datasets: [
                                                            {
                                                                type: "bubble",
                                                                label: "Relevadas",
                                                                data: relev,                                                          
                                                                backgroundColor:"#ffff",
                                                                borderColor: " #ffff",
                                                                pointStyle: 'line',
                                                                radius: 12,
                                                                borderWidth: 4,
                                                            },{
                                                                type: "bar",
                                                                backgroundColor: color,
                                                                borderColor: color,
                                                                borderWidth: 1,
                                                                label: "Planificadas",
                                                                data: marks
                                                            },
                                                           
                                                        ]
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

                                                }
                                            );

                                        }
                                    }
                                </script>
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