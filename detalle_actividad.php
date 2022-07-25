<?php
session_start();
//vuelve a la pagina de inicio si no esta registrado
if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == '')) {
    header('location:index.php');
}
include_once('Usuarios.class.php');
include_once('proyectos.class.php');
include_once('tareas.class.php');
include_once('temas.class.php');


$temas = new Temas_class();
$user = new Usuario();
$proyecto = new Proyecto_class();

$tipo = 0;
//extrae datos de usuaio
$sql = "SELECT * FROM usuarios WHERE id_usuario = '" . $_SESSION['user'] . "'";
$row = $user->detalle($sql);

//recibe el id de lista de proyectos
$id_proy = $_GET["detalleid"];
$fila_proy = $proyecto->mostrarFilaPorId($id_proy, $tipo);

$cantidadHorasProyecto= $proyecto->cantidadHorasRelevadasPorProyecto($id_proy);

$sectorProyecto = $proyecto->mostrarNombreSector($id_proy);



//llama funcion borrar
if (isset($_GET['borrarid']) && !empty($_GET['borrarid'])) {
    $borrarId = $_GET['borrarid'];
    $proyecto->borrar_proyecto($borrarId, $tipo);
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Detalle Actividad</title>
    <?php include('header.php'); ?>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include('navbar.php'); ?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php include('navbar_superior.php'); ?>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Actividad</h3>
                    <div class="row mb-3">

                        <div class="col-lg-12">

                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 font-weight-bold"><?php echo $fila_proy["nombre"] ?></p>
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

                                                    <form action="actualizar_actividades.php" method="POST" class="formulario">

                                                        <div class="container form-row">
                                                            <div class="col-md-3">
                                                                <div class="form-group"><label for="identificador"><strong>Código Acronimo&nbsp;</strong></label>
                                                                    <p><?php echo $fila_proy["identificador"] ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group"><label for="nombre"><strong>Nombre&nbsp;</strong></label>
                                                                    <p><?php echo $fila_proy["nombre"] ?></p>
                                                                </div>
                                                            </div>




                                                            <div class="col-md-12">
                                                                <div class="form-group"><label for="descripcion"><strong>Descripcion</strong><br></label>
                                                                    <p><?php echo $fila_proy["descripcion"] ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group"><label for="sector"><strong>Sector</strong></label>
                                                                    <p><?php echo $sectorProyecto["Nombre"] ?></p>
                                                                </div>
                                                            </div>





                                                            <div class="col-md-3">
                                                                <div class="form-group"><label for="horas"><strong>Horas Proyectadas Totales</strong><br></label>
                                                                    <p><?php echo $fila_proy["horas_dedicadas"] ?></p>
                                                                </div>
                                                            </div>
                                                         
                                                            <div class="col-md-3">
                                                                <div class="form-group"><label for="horasR"><strong>Horas Relevadas</strong><br></label>
                                                                    <p><?php echo $cantidadHorasProyecto  ?></p>
                                                                </div>
                                                            </div>


                                                            <input type="hidden" name="id_proyectos" value="<?php echo $fila_proy['id_proyectos']; ?>">
                                                        </div>
                                                </div>




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
                                                                                <td><?php echo $fila['usuariosNombre'] . " " . $fila['usuariosApellido'] ?></td>
                                                                                <td><?php echo $fila['horas_relevadas'] ?></td>
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
                                                    <a class="btn btn-secondary" href="Lista_actividades.php">Volver</a>
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
    </div>

</body>
<?php include('footer.php'); ?>

</html>