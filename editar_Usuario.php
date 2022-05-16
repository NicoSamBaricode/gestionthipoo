<?php
session_start();
//vuelve a la pagina de inicio si no esta registrado
if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == '')) {
    header('location:index.php');
}

include_once('Usuarios.Class.php');
include_once('proyectos.class.php');
include_once('sectores.class.php');
$sector = new Sector();
$user = new Usuario();


//extrae datos de usuaio

$row = $user->mostrarFilaPorIdConNombre($_SESSION['user']);

// funcion edita

$editId = $_SESSION['user'];
$usuario = $user->mostrarFilaPorIdConNombre($editId);


// actualiza
if (isset($_POST['update'])) {
    $user->actualizarDatosParaUsuario($_POST);
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Actualizar usuario</title>
    <?php include('header.php'); ?>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include('navbar.php'); ?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php include('navbar_superior.php'); ?>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Editar Usuario</h3>
                    <div class="row mb-3">

                        <div class="col-lg-12">

                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 font-weight-bold">Usuario</p>
                                        </div>
                                        <div class="card-body">
                                            <form action="editar_Usuario.php" method="POST">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="nombre"><strong>Nombre&nbsp;</strong></label><input class="form-control" type="text" placeholder="Nombre " name="nombre" value="<?php echo $usuario['nombre']; ?>" required="Ingrese dato valido" readonly></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="apellido"><strong>Apellido</strong></label><input class="form-control" type="text" placeholder="Apellido" value="<?php echo $usuario['apellido']; ?>" required="Ingrese dato valido" name="apellido" readonly></div>
                                                    </div>
                                                </div>



                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="alias"><strong>Nombre de Usuario</strong><br></label><input class="form-control" type="text" required="Ingrese dato valido" placeholder="Nombre de usuario" value="<?php echo $usuario['alias']; ?>" name="alias" readonly></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="pasword"><strong>Contraseña</strong></label><input class="form-control" type="password" required="Ingrese dato valido" placeholder="contraseña" value="<?php echo $usuario['pasword']; ?>" name="pasword"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="mail"><strong>Email</strong><br></label><input class="form-control" type="email" required="Ingrese dato valido" placeholder="usuario@cab.cnea.gov.ar" name="mail" value="<?php echo $usuario['mail']; ?>"></div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="legajo"><strong>Legajo</strong><br></label><input class="form-control" type="number" required="Ingrese dato valido" placeholder="legajo" value="<?php echo $usuario['legajo']; ?>" name="legajo"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="gde"><strong>Usuario Gde</strong><br></label><input class="form-control" type="text" required="Ingrese dato valido" placeholder="gde" name="gde" value="<?php echo $usuario['gde']; ?>"></div>
                                                    </div>

                                                </div>
                                                <div class="form-row">

                                                    <div class="col">
                                                        <div class="form-group"><label for="edificio"><strong>Edificio</strong></label><select class="form-control"  name="edificio" value="<?php echo $usuario['edificio']; ?>" placeholder=" Lugar de trabajo" id="edificio">

                                                                <option selected value="<?php echo $usuario['edificio']; ?>"><?php echo $usuario['edificio']; ?></option>
                                                                <option>Oficinas Uain A</option>
                                                                <option>Oficinas Uain B</option>
                                                                <option>Taller Uain B</option>
                                                                <option>Laboratorio Uain B</option>
                                                                <option>Ampliacion Uain B</option>
                                                            </select></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="cuil"><strong>Cuil</strong></label><input class="form-control" type="number"  value="<?php echo $usuario['cuil']; ?>" placeholder="Cuil" name="cuil"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="interno"><strong>Interno</strong></label><input class="form-control" type="number"  placeholder="Interno" name="interno" value="<?php echo $usuario['interno']; ?>"></div>
                                                    </div>

                                                </div>
                                                <div class="form-row">

                                                    <div class="col">
                                                        <div class="form-group"><label for="contratacion"><strong>Contratación</strong></label><input class="form-control" type="text" value="<?php echo $usuario['contratacion']; ?>" placeholder="Ingrese tipo de Contratacion" name="contratacion"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="tng"><strong>Tng</strong></label><input class="form-control" type="number" placeholder="Ingrese Tng" name="tng" value="<?php echo $usuario['tng']; ?>"></div>
                                                    </div>


                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="obs"><strong>Observaciones</strong></label><textarea class="form-control" type="text" value="<?php echo $usuario['obs']; ?>" name="obs"><?php echo $usuario['obs']; ?></textarea></div>
                                                    </div>

                                                </div>

                                                <div class="form-row">
                                                    <div class="col">
                                                        <!-- <div class="form-group"><label for="imagen"><strong>Imagen de Perfil</strong><br></label><br><input type="file" required class="btn btn-secondary btn-sm" name="imagen" value="agregar imagen"/></div> -->
                                                    </div>
                                                    <input type="hidden" name="id_usuario" value="<?php echo $usuario['id_usuario']; ?>">
                                                </div>
                                                <div class="form-row" style="margin-left:auto; right:0px; max-width:fit-content">

                                                    <div class="col" style="max-width:fit-content">
                                                        <a class="btn btn-secondary" href="panel.php">Volver</a>

                                                    </div>
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