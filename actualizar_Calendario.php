<?php
session_start();
//vuelve a la pagina de inicio si no esta registrado
if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == '')) {
    header('location:index.php');
}

include_once('Usuarios.Class.php');
include_once('calendario.class.php');


$user = new Usuario();
$calendario = new calendario_class();

//extrae datos de usuaio
$sql = "SELECT * FROM usuarios WHERE id_usuario = '" . $_SESSION['user'] . "'";
$row = $user->detalle($sql);

// funcion edita
if (isset($_GET['editId']) && !empty($_GET['editId'])) {
    $editId = $_GET['editId'];
    $mes = $calendario->mostrarFilaPorId($editId);
}

// actualiza
if (isset($_POST['update'])) {
    $calendario->actualizarFila($_POST);
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Actualizar Mes</title>
    <?php include('header.php'); ?>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include('navbar.php'); ?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
            <?php include('navbar_superior.php'); ?>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Editar Horas Laborables del Mes</h3>
                    
                        <div class="col-lg-12">

                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 font-weight-bold">Mes</p>
                                        </div>
                                        <div class="card-body">
                                            <form action="actualizar_Calendario.php" method="POST">
                                                <div class="form-row">
                                                <div class="col" hidden>
                                                        <div class="form-group"><label for="id_Mes"><strong>Mes&nbsp;</strong></label><input class="form-control" type="text"  name="id_Mes" value="<?php echo $mes['id_Mes']; ?>" ></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="nombre"><strong>Mes&nbsp;</strong></label><input class="form-control" type="text"  name="nombre" value="<?php echo $mes['nombre']; ?>" readonly></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="horas"><strong>Horas Laborables</strong></label><input class="form-control" type="number"  value="<?php echo $mes['horas_Totales']; ?>" name="horas"></div>
                                                    </div>
                                                </div>
                                                                                              
                                                <div class="form-row" style="margin-left:auto; right:0px; max-width:fit-content">
                                                    
                                                    <div class="col" style="max-width:fit-content">

                                                        <input type="submit" name="update" class="btn btn-primary " value="Actualizar" />
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
        </div>
    </div>
</body>
<?php include('footer.php'); ?>

</html>