<?php
session_start();
//vuelve a la pagina de inicio si no esta registrado
if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == '')) {
    header('location:index.php');
}
error_reporting(0);
include_once('Usuarios.class.php');
include_once('dedicacion.class.php');


$user = new Usuario();
$row = $user->mostrarFilaPorIdConNombre($_SESSION['user']);

$dedicacion_obj = new Dedicacion_class();
// funcion edita
if (isset($_GET['Id']) && !empty($_GET['Id'])) {
    $Id = $_GET['Id'];
    $dedicacion = $dedicacion_obj->mostrarFilaPorIdJoinNombres($Id);
   
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>Detalle Dedicación</title>
    <?php include('header.php'); ?>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include('navbar.php'); ?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php include('navbar_superior.php'); ?>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Detalle Dedicación</h3>
                    <div class="row mb-3">

                        <div class="col-lg-12">

                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 font-weight-bold">Identificador #<?php echo($Id)?></p>
                                        </div>
                                        <div class="card-body">
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Detalles</a>
                                                </li>

                                            </ul>

                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                    <div class="container " style="margin: 0px; margin-top:20px">
                                                        <form action="actualizar_proyecto.php" method="POST" >

                                                            <div class="row ">
                                                                <div class="col-md-3">
                                                                    <div class="form-group"><label for="nombre"><strong>Nombre&nbsp;</strong></label>
                                                                        <p><?php echo $dedicacion["nombre"] ?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group"><label for="fecha"><strong>Apellido</strong></label>
                                                                        <p><?php echo $dedicacion["apellido"] ?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group"><label for="fecha"><strong>Mes</strong></label>
                                                                        <p><?php echo $dedicacion["mes"] ?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group"><label for="fecha"><strong>Año</strong></label>
                                                                        <p><?php echo $dedicacion["anio"] ?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group"><label for="fecha"><strong>Proyecto/Actividad</strong></label>
                                                                        <p><?php echo $dedicacion["nombreProyecto"] ?></p>
                                                                    </div>
                                                                </div>
                                                                <!-- <div class="col-md-3">
                                                                    <div class="form-group"><label for="fecha"><strong>Horas Planificadas</strong></label>
                                                                        <p><?php echo $dedicacion["horas"] ?></p>
                                                                    </div>
                                                                </div> -->
                                                                <div class="col-md-3">
                                                                    <div class="form-group"><label for="fecha"><strong>Horas Relevadas</strong></label>
                                                                        <p><?php echo $dedicacion["horas_relevadas"] ?></p>
                                                                    </div>
                                                                </div>
                                                               
                                                                <div class="col-md-3">
                                                                    <div class="form-group"><label for="sector"><strong>TimeStamp</strong></label>
                                                                        <p><?php echo $dedicacion["timeStamp"] ?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group"><label for="sector"><strong>Observaciones/Metas</strong></label>
                                                                        <p><?php echo $dedicacion["obs"] ?></p>
                                                                    </div>
                                                                </div>
                                                               
                                                            </div>
                                                            
                                                            <!--  
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="archivo"><strong>Subir archivo</strong><br></label><br><input type="file"  class="btn btn-secondary btn-sm" name="archivo" value="agregar archivo"/></div>
                                                    </div>
                                                    
                                                </div>-->
                                                            
                                                        </form>
                                                    </div>

                                                </div>


                                            </div>

                                        </div>
                                        <div class="card-footer">
                                            <div class="row" id="boton-volver">
                                                <div class="col" style="max-width:fit-content">
                                                    <a class="btn btn-secondary" href="Lista_dedicacion.php">Volver</a>
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