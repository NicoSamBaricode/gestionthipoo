<?php
session_start();
//vuelve a la pagina de inicio si no esta registrado
if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == '')) {
    header('location:index.php');
}
error_reporting(0);
include_once('Usuarios.class.php');


$user = new Usuario();
$usuario = $user->mostrarFilaPorIdConNombre($_SESSION['user'])

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
                                            <p class="text-primary m-0 font-weight-bold"><?php echo $usuario["nombre"] . " " . $usuario["apellido"] ?></p>
                                        </div>
                                        <div class="card-body">
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Detalles</a>
                                                </li>

                                            </ul>

                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                    <div class="container">
                                                        <form action="actualizar_proyecto.php" method="POST" class="formulario">

                                                            <div class="container form-row">
                                                                <div class="col-md-3">
                                                                    <div class="form-group"><label for="nombre"><strong>Nombre&nbsp;</strong></label>
                                                                        <p><?php echo $usuario["nombre"] ?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group"><label for="fecha"><strong>Apellido</strong></label>
                                                                        <p><?php echo $usuario["apellido"] ?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group"><label for="fecha"><strong>Rol</strong></label>
                                                                        <p><?php echo $usuario["rol"] ?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group"><label for="fecha"><strong>Email</strong></label>
                                                                        <p><?php echo $usuario["mail"] ?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group"><label for="fecha"><strong>Usuario</strong></label>
                                                                        <p><?php echo $usuario["alias"] ?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group"><label for="fecha"><strong>Legajo</strong></label>
                                                                        <p><?php echo $usuario["legajo"] ?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group"><label for="fecha"><strong>Usuario Gde</strong></label>
                                                                        <p><?php echo $usuario["gde"] ?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group"><label for="fecha"><strong>Estado</strong></label>
                                                                        <p><?php
                                                                            if ($usuario["estado"] == 1) {
                                                                                echo "Activo";
                                                                            }
                                                                            if ($usuario["estado"] == 0) {
                                                                                echo "Inactivo";
                                                                            }
                                                                            if ($usuario["estado"] == 2) {
                                                                                echo "Licencia";
                                                                            } ?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group"><label for="fecha"><strong>Sector</strong></label>
                                                                        <p><?php echo $usuario["NombreSector"] ?></p>
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

                                                </div>


                                            </div>

                                        </div>
                                        <div class="card-footer">
                                            <div class="row" id="boton-volver">
                                                <div class="col" style="max-width:fit-content">
                                                    <a class="btn btn-secondary" href="Lista_Usuarios.php">Volver</a>
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