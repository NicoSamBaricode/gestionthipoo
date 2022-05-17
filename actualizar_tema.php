<?php
session_start();
//vuelve a la pagina de inicio si no esta registrado
if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == '')) {
    header('location:index.php');
}

include_once('Usuarios.Class.php');
include_once('temas.class.php');


$user = new Usuario();
$temas = new Temas_class();

//extrae datos de usuaio
$sql = "SELECT * FROM usuarios WHERE id_usuario = '" . $_SESSION['user'] . "'";
$row = $user->detalle($sql);

// funcion edita
if (isset($_GET['Id']) && !empty($_GET['Id'])) {
    $editId = $_GET['Id'];
    $tema = $temas->mostrarFilaPorId($editId);
}

// actualiza
if (isset($_POST['update'])) {
    
    $temas->actualizarFila($_POST);
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Actualizar Tema</title>
    <?php include('header.php'); ?>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include('navbar.php'); ?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
            <?php include('navbar_superior.php'); ?>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Editar Tema</h3>
                    
                        <div class="col-lg-12">

                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 font-weight-bold">Mes</p>
                                        </div>
                                        <div class="card-body">
                                            <form action="actualizar_tema.php" method="POST">
                                                <div class="form-row">
                                                <div class="col" hidden>
                                                        <div class="form-group"><label for="id_Mes"><strong>id tema&nbsp;</strong></label><input class="form-control" type="text"  name="id_tema" value="<?php echo $tema['id_tema']; ?>" ></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="nombre"><strong>Nombre Tema&nbsp;</strong></label><input class="form-control" type="text"  name="nombre" value="<?php echo $tema['nombre']; ?>" ></div>
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