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
include_once('funciones.php');
include_once('calendario.class.php');
$user = new Usuario();
$proyecto = new Proyecto_class();
$dedicacion = new Dedicacion_class();
$calendario = new calendario_class();

//extrae datos de usuaio
$sql = "SELECT * FROM usuarios WHERE id_usuario = '" . $_SESSION['user'] . "'";
$row = $user->detalle($sql);
$usuario =  $_SESSION['user']; //numero de usuario

//llama funcion borrar
if (isset($_GET['borrarid']) && !empty($_GET['borrarid'])) {
    $borrarId = $_GET['borrarid'];
    $dedicacion->borrar_dedic($borrarId);
}
//carga los datos cuando recien entra a la pagina
$query = "SELECT * FROM dedicacion ";

$queryMiDedicacion = "SELECT * FROM dedicacion where id_agente = $usuario";

$tipo = 2; // si es 0 es de actividad //1 si es proyectos


?>
<!DOCTYPE html>
<html>

<head>
    <title>Mi Dedicacion</title>
    <?php include_once('header.php'); ?>






</head>



<body id="page-top">
    <div id="wrapper">
        <?php include('navbar.php'); ?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php include('navbar_superior.php'); ?>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Gestion de Horas</h3>
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
                        <?php if (('Admin' == $row["rol"]) || ('Jefe Division' == $row["rol"]) || ('Jefe Depto' == $row["rol"])) { ?>
                            <div class="col-md-6 col-xl-3 mb-4">
                                <div class="card shadow border-left-warning py-2">
                                    <div class="card-body">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col mr-2">
                                                <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"><span>Imprimir Reporte</span></div>

                                            </div>
                                            <div class="col-auto" style="color: darkgoldenrod;margin-right: 1rem; font-size: larger;">

                                                <button id="imprimir2" class="btn btn-secondary"><i class="fa fa-print"></i></button>


                                            </div>
                                            <div class="col-auto"><i class="fas fa-tasks fa-2x text-gray-300"></i></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                    </div>

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="mi_dedicacion">
                            <a class="nav-link active" id="mi_dedicacion-tab" data-toggle="tab" href="#mi_dedicacion" role="tab" aria-controls="mi_dedicacion" aria-selected="false">Mi Dedicación</a>
                        </li>
                        <?php if (('Admin' == $row["rol"]) || ('Jefe Division' == $row["rol"]) || ('Jefe Depto' == $row["rol"])) { ?>
                            <li class="nav-item" role="dedicacion_todos">
                                <a class="nav-link " id="dedicacion_todos-tab" data-toggle="tab" href="#dedicacion_todos" role="tab" aria-controls="dedicacion_todos" aria-selected="true">Dedicación Equipo</a>
                            </li>
                            <li class="nav-item" role="faltantes">
                                <a class="nav-link " id="faltantes-tab" data-toggle="tab" href="#faltantes" role="tab" aria-controls="faltantes" aria-selected="true">Agentes sin horas</a>
                            </li>

                        <?php } ?>

                        <li class="nav-item" role="grafico">
                            <a class="nav-link" id="grafico-tab" data-toggle="tab" href="#grafico" role="tab" aria-controls="grafico" aria-selected="false">Grafico</a>
                        </li>

                    </ul>


                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show  active" id="mi_dedicacion" role="tabpanel" aria-labelledby="mi_dedicacion-tab">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col " style="text-align: right;">
                                        <button id="imprimir" class="btn btn-secondary" style="margin-top: 24px;"><i class="fa fa-print"></i></button>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                            <table class="table dataTable my-0" id="table2" data-show-export="true" data-force-export="true" data-toggle="table" data-search="true" data-pagination="true" data-show-columns="true" data-locale="es-ES">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th data-field="Agente" data-sortable="true">Agente</th>
                                                        <th data-field="Mes" data-sortable="true">Mes</th>
                                                        <th data-field="Horas P">Horas Relevadas</th>
                                                        <!-- <th data-field="Horas R">Horas relevadas</th> -->
                                                        <th data-field="Imputacion" data-sortable="true">Imputación</th>
                                                        <th data-field="obs2" data-sortable="true">Obs/Metas</th>
                                                        <!-- <th data-field="Editar">Editar</th> -->

                                                    </tr>
                                                </thead>
                                                <tbody id="tablaDedicacion">

                                                    <?php
                                                    $filas = $dedicacion->mostrarDatosBusqueda($queryMiDedicacion);
                                                    foreach ($filas as $fila) {
                                                    ?>
                                                        <tr>
                                                            <?php $aux_p = $proyecto->mostrarFilaPorId($fila["imputacion"], $tipo);
                                                            $aux_u = $user->mostrarFilaPorId($fila["id_agente"]); //aca tengo el nombre del usuario
                                                            ?>
                                                            <td><?php echo $aux_u['nombre'] ?></td>
                                                            <td><?php echo $fila['mes'] ?></td>
                                                            <td class="centrarRegistros"><?php echo $fila['horas_relevadas'] ?></td>
                                                            <!-- <td>
                                                                <div class="row">
                                                                    <div class="col-md-6" style="top: 9px;">
                                                                        <p><?php echo $fila['horas_relevadas'] ?></p>
                                                                    </div>
                                                                    <div class="col-md-6 " style="text-align: right;"><a class="btn btn-light mx-auto btn-circle ml-1" title="Para editar detalles y declarar horas relevadas" style="color:black" role="button" href="actualizar_dedicacion.php?editId=<?php echo $fila['id_dedicacion'] ?>"><i class="fa fa-edit text-black"></i></a></div>
                                                                </div>
                                                            </td> -->
                                                            <td><?php echo $aux_p['nombre'] ?></td>

                                                            <td><a href="detalle_dedicacion.php?Id=<?php echo $fila['id_dedicacion'] ?>" class="btn btn-secondary btn-sm"><i class="fas fa-search-plus" style="color:white"></i></a></td>
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
                        <div class="tab-pane fade show " id="dedicacion_todos" role="tabpanel" aria-labelledby="dedicacion_todos-tab">

                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                            <table class="table dataTable my-0" id="table" data-show-print="true" data-toggle="table" data-search="true" data-pagination="true" data-show-columns="true" data-locale="es-ES">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th data-field="Agente" data-sortable="true">Agente</th>
                                                        <th data-field="Anio" data-sortable="true">Año</th>
                                                        <th data-field="Mes" data-sortable="true">Mes</th>
                                                        <th data-field="Horas P">Horas Relevadas</th>
                                                        <!-- <th data-field="Horas R">Horas relevadas</th> -->
                                                        <th data-field="Imputacion" data-sortable="true">Imputación</th>
                                                        <th data-field="obs" data-sortable="true">Obs/Metas</th>
                                                        <!-- <th data-field="Editar">Editar</th> -->
                                                        <th data-field="Borrar"> Eliminar</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tablaDedicacion">

                                                    <?php

                                                    $filas = $dedicacion->mostrarDatosPorSector($row['rol'], $row['sector_id']);
                                                    foreach ($filas as $fila) {
                                                    ?>
                                                        <tr>
                                                            <?php $aux_p = $proyecto->mostrarFilaPorId($fila["imputacion"], $tipo);

                                                            ?>
                                                            <td><?php echo $fila['usuariosNombre'] . " " . $fila['apellido'] ?></td>
                                                            <td><?php echo $fila['anio'] ?></td>
                                                            <td><?php echo $fila['mes'] ?></td>
                                                            <!-- <td class="centrarRegistros"><?php echo $fila['horas'] ?></td> -->
                                                            <td><?php echo $fila['horas_relevadas'] ?></td>
                                                            <td><?php echo $aux_p['nombre'] ?></td>
                                                            <td><a href="detalle_dedicacion.php?Id=<?php echo $fila['id_dedicacion'] ?>" class="btn btn-secondary btn-sm"><i class="fas fa-search-plus" style="color:white"></i></a></td>
                                                            <script src="cartel.js"> </script>
                                                            <!-- <td><a class="btn btn-primary mx-auto btn-circle ml-1"  role="button" href="crear_tarea.php?tareaId=<?php //echo $fila["id_proyectos"]; 
                                                                                                                                                                        ?>"><i class="fas fa-file-medical text-white"></i></a></td> -->

                                                            <!-- <td><a class="btn btn-info mx-auto btn-circle ml-1" role="button" href="actualizar_dedicacion.php?editId=<?php echo $fila['id_dedicacion'] ?>"><i class="fa fa-edit text-white"></i></a></td> -->
                                                            <td style="text-align: center;"><a class="btn btn-danger mx-auto btn-circle ml-1" onclick="return confirmBorrar()" role="button" href="Lista_dedicacion.php?borrarid=<?php echo $fila['id_dedicacion'] ?>"><i class="fas fa-trash text-white"></i></a></td>

                                                        </tr>
                                                    <?php }  ?>


                                                </tbody>

                                            </table>
                                            <!-- <div class="row">
                                                <div class="col  derecha" style="text-align: right; max-width: fit-content;">
                                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label>Mostrar&nbsp;<select class="form-control form-control-sm custom-select custom-select-sm">
                                                                <option value="5" selected="">5</option>
                                                                <option value="10">10</option>
                                                                <option value="20">20</option>
                                                                <option value="100">Todos</option>
                                                            </select>&nbsp;</label></div>


                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>




                            </div>
                        </div>

                        <div class="tab-pane fade show " id="faltantes" role="tabpanel" aria-labelledby="faltantes-tab">
                            <div class="card-body">
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    <strong>Info: </strong> Esta información muestra quien no cargo ninguna hora relevada para el mes seleccionado.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group"><label for="mes"><strong>Mes</strong><br></label><select class="form-control" require name="mes" id="mesFaltante">
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
                                    <div class="col-md-6">
                                        <div class="form-group"><label for="anio"><strong>Año</strong><br></label><input class="form-control" type="number" id="anioFaltante" placeholder="Año" name="anio" min="2022"></input></div>
                                    </div>

                                    <div class="col-md-12" id="tablaFaltantes">


                                    </div>
                                </div>




                            </div>
                        </div>
                        <div class="tab-pane fade show " id="grafico" role="tabpanel" aria-labelledby="grafico-tab">
                            <div class="col-md-6">
                                <div class="card shadow mb-4">
                                    <div class="col">
                                        <div class="form-group"><label for="mes"><strong>Mes</strong><br></label><select class="form-control" require name="mes" id="mes">
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
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h6 class="text-primary font-weight-bold m-0">Ocupación Agente: <?= $row['nombre'] ?></h6>
                                        <button id="boton" class="btn btn-danger">borrar</button>
                                    </div>


                                    <!-- grafico de torta -->
                                    <div class="card-body">
                                        <div id="chart-container2">
                                            <canvas id="graphCanvas2"></canvas>
                                        </div>

                                        <script>
                                            $(document).ready(function() {
                                                const d = new Date();
                                                let month = d.getMonth();
                                                $("#mes").val(month + 1);
                                                showGraph();
                                            });

                                            $("#boton").on("click", function() {
                                                resetCanvas();

                                            });

                                            var resetCanvas = function() {
                                                $('#graphCanvas2').remove(); // this is my <canvas> element
                                                $('#chart-container2').append('<canvas id="graphCanvas2"><canvas>');
                                                canvas = document.querySelector('#graphCanvas2');
                                                ctx = canvas.getContext('2d');

                                            };
                                            $("#mes").on("change", function() {
                                                resetCanvas();
                                                showGraph();
                                            });

                                            function showGraph() {
                                                {
                                                    $.post("graficoAgente.php", {
                                                            mes: $("#mes").val(),
                                                            usuario: <?= $row['id_usuario']; ?>
                                                        },
                                                        function(data) {

                                                            console.log(data);
                                                            var name = [];
                                                            var marks = [];
                                                            var color = [];

                                                            for (var i in data) {
                                                                name.push(data[i].nombre);
                                                                marks.push(data[i].horas_relevadas);
                                                                color.push(data[i].color_act);
                                                            }

                                                            var chartdata = {
                                                                labels: name,
                                                                datasets: [{
                                                                    label: 'Ocupacion: ',
                                                                    backgroundColor: color,
                                                                    borderColor: '#ffff',
                                                                    hoverBackgroundColor: '#CCCCCC',
                                                                    hoverBorderColor: '#666666',
                                                                    data: marks
                                                                }]
                                                            };

                                                            var graphTarget = $("#graphCanvas2");

                                                            var barGraph = new Chart(graphTarget, {
                                                                type: 'bar',
                                                                data: chartdata
                                                            });
                                                        },

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
    </div>

</body>

<?php include('footer.php'); ?>

<script>
    $(document).ready(function() {
        const d = new Date();
        let year = d.getFullYear();
        let month = d.getMonth();
        $("#anioFaltante").val(year);
        $("#mesFaltante").val(month+ 1);
        AgentesRestantes();
    });
    $("#guardarDedicacion").on("click", function() {
        $.post("ajaxCalculoHorasProyectoRelevadas.php", {
                proyecto: $("#proyectoID").val(),
            })
            .done(function(data) {
                console.log(data);
                alert("Calculo horas por proyecto: " + data);
            });
    });
    $('#imprimir').on('click', function() {
        imprimir("table2");
    })
    $('#imprimir2').on('click', function() {
        imprimir("table");
    })

    function AgentesRestantes() {
        $.post("ajaxAgentesHorasRestantes.php", {
                mes: $("#mesFaltante").val(),
                anio: $("#anioFaltante").val(),
                opcion: null,
                rol: "<?php echo $row["rol"]?>",
                sectorId: <?php echo $row["sector_id"]?>,
            })
            .done(function(data) {
                
                $("#tablaFaltantes").html(data);
            });
    }

    $("#mesFaltante").on("change", function() {
        AgentesRestantes();
    });
    $("#anioFaltante").on("change", function() {
        AgentesRestantes();
    });
</script>

</html>