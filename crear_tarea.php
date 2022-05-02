<?php
session_start();
//vuelve a la pagina de inicio si no esta registrado
if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == '')) {
    header('location:index.php');
}

include_once('Usuarios.class.php');
include_once('tareas.class.php');
include_once('proyectos.class.php');

$user = new Usuario();
$tarea = new Tarea_class();
$proyecto = new Proyecto_class();

//extrae datos de usuaio
$sql = "SELECT * FROM usuarios WHERE id_usuario = '" . $_SESSION['user'] . "'";
$row = $user->detalle($sql);





//llama a la funcion de insertar datos
if (isset($_POST['submit'])) {

    $tarea->insertarDatos($_POST);
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Crear Tarea</title>
    <?php include('header.php'); ?>

</head>

<body id="page-top">
    <div id="wrapper">
        <?php include('navbar.php'); ?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
            <?php include('navbar_superior.php'); ?>
                <div class="container-fluid">

                    <div class="row mb-3">

                        <div class="col-lg-12">

                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 font-weight-bold">Nueva Tarea</p>
                                        </div>
                                        <div class="card-body">
                                            <form action="crear_tarea.php" method="POST">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="nombre"><strong>Nombre&nbsp;</strong></label><input class="form-control" type="text" placeholder="Nombre " name="nombre" required="Ingrese dato valido"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="fecha"><strong>Fecha de Inicio</strong></label><input class="form-control" type="date" placeholder="Fecha inicio" required="Ingrese dato valido" name="fecha"></div>
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="descripcion"><strong>Descripcion</strong><br></label><textarea class="form-control" type="text" placeholder="Descripcion" name="descrip"></textarea></div>
                                                    </div>

                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="resp"><strong>Responsable</strong><br></label><select class="form-control" require name="resp" id="exampleFormControlSelect2">
                                                                <?php
                                                                $filas = $user->mostrarDatos();
                                                                foreach ($filas as $fila) {
                                                                ?>
                                                                    <option value="<?php echo $fila['id_usuario']; ?>">
                                                                        <?php echo $fila['nombre']; ?>
                                                                    </option>
                                                                <?php }  ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="frealizacion"><strong>Fecha finalizacion</strong><br></label><input class="form-control" type="date" placeholder="Ingrese fecha de finalizacion" name="frealizado"></div>
                                                    </div>
                                                </div>
                                                <div class="form-row">

                                                    <div class="col">
                                                        <div class="form-group"><label for="estado"><strong>Estado</strong><br></label><select class="form-control" require name="estado" id="exampleFormControlSelect1">
                                                                <option>Pendiente</option>
                                                                <option>En proceso</option>
                                                                <option>Realizada</option>
                                                                <option>Cancelada</option>
                                                                <option>Revisar</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="resp"><strong>Proyecto</strong><br></label><select class="form-control" require name="proy" id="exampleFormControlSelect2">
                                                                <?php
                                                                $filas_p = $proyecto->mostrarDatos(1);
                                                                foreach ($filas_p as $fila_p) {
                                                                ?>
                                                                    <option value="<?php echo $fila_p['id_proyectos'] ?>"> <?php echo $fila_p['nombre'] ?></option>
                                                                <?php }  ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--  
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label for="archivo"><strong>Subir archivo</strong><br></label><br><input type="file"  class="btn btn-secondary btn-sm" name="archivo" value="agregar archivo"/></div>
                                                </div>
                                                
                                            </div>-->
                                                <div class="form-row" style="margin-left:auto; right:0px; max-width:fit-content">

                                                    <div class="col" style="max-width:fit-content">
                                                        <a class="btn btn-secondary" href="Lista_Tareas.php">Volver</a>
                                                    </div>
                                                    <div class="col" style="max-width:fit-content">

                                                        <input type="submit" name="submit" class="btn btn-primary " value="Crear Tarea" />
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