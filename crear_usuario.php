<?php
session_start();
//vuelve a la pagina de inicio si no esta registrado
if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == '')) {
    header('location:index.php');
}

include_once('Usuarios.class.php');
include_once('proyectos.class.php');
include_once('sectores.class.php');
include_once('logs.class.php');
$sector = new Sector();
$user = new Usuario();
$proyecto = new Proyecto_class();
$log = new log_class();
//extrae datos de usuaio

$row = $user->mostrarFilaPorIdConNombre($_SESSION['user']);
//llama a la funcion de insertar datos
if (isset($_POST['submit'])) {
    $user->insertarDatos($_POST, $_SESSION['user']);
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Crear usuario</title>
    <?php include('header.php'); ?>

</head>

<body id="page-top">
    <div id="wrapper">
        <?php include('navbar.php'); ?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php include('navbar_superior.php'); ?>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Nuevo Usuario</h3>
                    <div class="row mb-3">

                        <div class="col-lg-12">

                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 font-weight-bold">Configurar Usuario</p>
                                        </div>
                                        <div class="card-body">
                                            <form action="crear_usuario.php" method="POST">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="nombre"><strong>Nombre&nbsp;</strong></label><input class="form-control" type="text" placeholder="Nombre " name="nombre" required="Ingrese dato valido"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="apellido"><strong>Apellido</strong></label><input class="form-control" type="text" placeholder="Apellido" required="Ingrese dato valido" name="apellido"></div>
                                                    </div>
                                                </div>

                                                <div class="form-row">

                                                    <div class="col">
                                                        <div class="form-group"><label for="rol"><strong>Tipo de Usuario</strong></label><select class="form-control" required name="rol" placeholder="Tipo de usuario" id="rol">
                                                                <option selected>Agente</option>
                                                                <option>Admin</option>
                                                                <option>Jefe Division</option>
                                                                <option>Jefe Depto</option>
                                                            </select></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="password"><strong>Contraseña</strong></label><input class="form-control" type="password" required="Ingrese dato valido" placeholder="contraseña" name="pasword"></div>
                                                    </div>
                                                </div>




                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="alias"><strong>Nombre de Usuario</strong><br></label><input class="form-control" type="text" required="Ingrese dato valido" placeholder="Nombre de usuario" name="alias"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="sector"><strong>Sector</strong><br></label><select class="form-control" name="sector" id="exampleFormControlSelect2">
                                                                <?php
                                                                $filas = $sector->mostrarDatos();

                                                                foreach ($filas as $fila) {
                                                                ?>
                                                                    <tr>

                                                                        <option value="<?php echo $fila['Sector_id'] ?>"> <?php echo $fila['Nombre'] ?></option>


                                                                    </tr>
                                                                <?php }  ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="mail"><strong>Email</strong><br></label><input class="form-control" type="email" required="Ingrese dato valido" placeholder="usuario@cab.cnea.gov.ar" name="mail"></div>
                                                    </div>
                                                </div>
                                                <div class="form-row">


                                                    <div class="col">
                                                        <div class="form-group"><label for="text"><strong>Legajo</strong></label><input class="form-control" type="number" required="Ingrese dato valido" placeholder="Legajo" name="legajo"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="text"><strong>Usuario Gde</strong></label><input class="form-control" type="text" required="Ingrese dato valido" placeholder="Gde" name="gde"></div>
                                                    </div>

                                                </div>
                                                <div class="form-row">

                                                    <div class="col">
                                                        <div class="form-group"><label for="edificio"><strong>Edificio</strong></label><select class="form-control" required name="edificio" placeholder="Lugar de trabajo" id="edificio">
                                                                <option selected>Oficinas Uain A</option>
                                                                <option>Oficinas Uain B</option>
                                                                <option>Taller Uain B</option>
                                                                <option>Laboratorio Uain B</option>
                                                                <option>Ampliacion Uain B</option>
                                                            </select></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="cuil"><strong>Cuil</strong></label><input class="form-control" type="number" required="Ingrese dato valido" placeholder="Cuil" name="cuil"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="interno"><strong>Interno</strong></label><input class="form-control" type="number" required="Ingrese dato valido" placeholder="Interno" name="interno"></div>
                                                    </div>

                                                </div>
                                                <div class="form-row">

                                                    <div class="col">
                                                        <div class="form-group"><label for="contratacion"><strong>Contratación</strong></label><input class="form-control" type="text" required="Ingrese dato valido" placeholder="Ingrese tipo de Contratacion" name="contratacion"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="tng"><strong>Tng</strong></label><input class="form-control" type="number" required="Ingrese dato valido" placeholder="Ingrese Tng" name="tng"></div>
                                                    </div>


                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="obs"><strong>Observaciones</strong></label><textarea class="form-control" type="text" required="Ingrese dato valido" placeholder="Observaciones" name="obs"></textarea></div>
                                                    </div>

                                                </div>
                                                <div class="form-row" style="margin-left:auto; right:0px; max-width:fit-content">

                                                    <div class="col" style="max-width:fit-content">
                                                        <input type="submit" name="submit" class="btn btn-primary btn-sm" value="Crear Usuario" />
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