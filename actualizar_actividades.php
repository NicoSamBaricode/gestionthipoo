<?php
session_start();
//vuelve a la pagina de inicio si no esta registrado
if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == '')) {
    header('location:index.php');
}

include_once('Usuarios.Class.php');
include_once('proyectos.class.php');

$user = new Usuario();
$actividad_obj = new Proyecto_class();
$tipo = 0;

//extrae datos de usuaio
$sql = "SELECT * FROM usuarios WHERE id_usuario = '" . $_SESSION['user'] . "'";
$row = $user->detalle($sql);

// funcion edita
if (isset($_GET['editId']) && !empty($_GET['editId'])) {
    $editId = $_GET['editId'];
    $actividad = $actividad_obj->mostrarFilaPorId($editId,$tipo);
}

// actualiza
if (isset($_POST['update'])) {
    $actividad_obj->actualizarFila($_POST,$tipo);
}
//llama funcion borrar
if (isset($_GET['borrarid']) && !empty($_GET['borrarid'])) {
    $borrarId = $_GET['borrarid'];
    $actividad->borrar_actividad($borrarId);
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Actualizar Actividad</title>
    <?php include('header.php'); ?>

<body id="page-top">
    <div id="wrapper">
        <?php include('navbar.php'); ?>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>

                        <ul class="nav navbar-nav flex-nowrap ml-auto">


                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow" role="presentation">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small"><?php echo $row['nombre'] ?></span><img class="border rounded-circle img-profile" src="/GestionThi/gestionthipoo/assets/img/logo-cnea2.png"></a>
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
                    <h3 class="text-dark mb-4">Editar actividad </h3>
                    <div class="row mb-3">

                        <div class="col-lg-12">

                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 font-weight-bold">Actividad</p>
                                        </div>
                                        <div class="card-body">
                                            <form action="actualizar_actividades.php" method="POST">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="nombre"><strong>Nombre&nbsp;</strong></label><input class="form-control" type="text" placeholder="Nombre " name="nombre" required="Ingrese dato valido" value="<?php echo $actividad['nombre']; ?>"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="identificador"><strong>Identificador&nbsp;</strong></label><input class="form-control" type="text" placeholder="Identificador" name="identificador" required="Ingrese dato valido" value="<?php echo $actividad['identificador']; ?>"></div>

                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="descripcion"><strong>Descripcion</strong><br></label><input class="form-control" type="text" placeholder="Descripcion" name="descrip" value="<?php echo $actividad['descripcion']; ?>"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="horas"><strong>Horas dedicadas</strong><br></label><input class="form-control" type="number" placeholder="Horas dedicadas" name="horas" value="<?php echo $actividad['horas_dedicadas']; ?>"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="color"><strong>Color de grafico</strong><br></label><input class="form-control" type="color" placeholder="Color" name="color" value="<?php echo $actividad['color_act']; ?>"></div>
                                                    </div>

                                                </div>


                                                <div class="form-row">
                                                    <div class="col">
                                                        <!-- <div class="form-group"><label for="imagen"><strong>Imagen de Perfil</strong><br></label><br><input type="file" required class="btn btn-secondary btn-sm" name="imagen" value="agregar imagen"/></div> -->
                                                    </div>
                                                    <input type="hidden" name="id_proyectos" value="<?php echo $actividad['id_proyectos']; ?>">
                                                </div>
                                                <div class="form-row" style="margin-left:auto; right:0px; max-width:fit-content">

                                                    <div class="col" style="max-width:fit-content">
                                                        <a class="btn btn-secondary" href="Lista_actividades.php">Volver</a>

                                                    </div>
                                                    <div class="col" style="max-width:fit-content">

                                                        <input type="submit" name="update" class="btn btn-primary " value="Actualizar" />
                                                    </div>
                                                    <div class="col" style="max-width:fit-content">
                                                        <a class="btn btn-danger mx-auto btn-circle ml-1" onclick="return confirmBorrar()" role="button" href="Lista_actividades.php?borrarid=<?php echo  $actividad['id_proyectos'] ?>"><i class="fas fa-trash text-white"></i></a>

                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>



                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
</body>

</html>