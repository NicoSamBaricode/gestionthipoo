<?php
session_start();
//vuelve a la pagina de inicio si no esta registrado
if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == '')) {
    header('location:index.php');
}

include_once('Usuarios.class.php');
include_once('proyectos.class.php');
include_once('sectores.class.php');
include_once('temas.class.php');

$user = new Usuario();
$proyecto = new Proyecto_class();
$sector = new Sector();
$tema = new Temas_class();

//extrae datos de usuaio
$sql = "SELECT * FROM usuarios WHERE id_usuario = '" . $_SESSION['user'] . "'";
$row = $user->detalle($sql);
$tipo = 1;
//llama a la funcion de insertar datos
if (isset($_POST['submit'])) {
    $proyecto->insertarDatos($_POST, $tipo);
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Crear Proyecto</title>
    <?php include('header.php'); ?>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include('navbar.php'); ?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
            <?php include('navbar_superior.php'); ?>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Nuevo Proyecto</h3>
                    <div class="row mb-3">

                        <div class="col-lg-12">

                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 font-weight-bold">Configurar Proyecto</p>
                                        </div>
                                        <div class="card-body">
                                            <form action="crear_proyecto.php" method="POST">
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
                                                        <div class="form-group"><label for="identificador"><strong>Código Acronimo&nbsp;</strong></label><input class="form-control" type="text" placeholder="Identificador" name="identificador" required="Ingrese dato valido"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="acta"><strong>Acta Inicio&nbsp;</strong></label><input class="form-control" type="text" placeholder="Acta" name="acta" required="Ingrese dato valido"></div>
                                                    </div>
                                                   
                                                    <div class="col">
                                                        <div class="form-group"><label for="tema"><strong>Tema</strong><br></label><select class="form-control" name="tema" >
                                                                <?php
                                                                $filas = $tema->mostrarDatos();

                                                                foreach ($filas as $fila) {
                                                                ?>
                                                                    <tr>

                                                                        <option value="<?php echo $fila['id_tema'] ?>"> <?php echo $fila['nombre'] ?></option>


                                                                    </tr>
                                                                <?php }  ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="descripcion"><strong>Descripcion</strong><br></label><textarea class="form-control" type="text" placeholder="Descripcion" name="descrip"></textarea></div>
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
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="resp"><strong>Responsable</strong><br></label><select class="form-control" name="resp" id="exampleFormControlSelect2">
                                                                <?php
                                                                $filas = $user->mostrarDatos();

                                                                foreach ($filas as $fila) {
                                                                ?>
                                                                    <tr>

                                                                        <option value="<?php echo $fila['id_usuario'] ?>"> <?php echo $fila['nombre']." ".$fila['apellido'] ?></option>


                                                                    </tr>
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
                                                        <div class="form-group"><label for="horas"><strong>Horas Pautadas</strong><br></label><input class="form-control" type="number" placeholder="Horas pautadas" name="horas" required></inp>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group"><label for="estado"><strong>Estado</strong><br></label><select class="form-control" required name="estado" id="exampleFormControlSelect1">
                                                                <option>Pendiente</option>
                                                                <option>En proceso</option>
                                                                <option>Realizado</option>
                                                                <option>Cancelado</option>
                                                                <option>Revisar</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="color"><strong>Color de grafico</strong><br></label><input class="form-control" type="color" placeholder="Color" name="color" ></div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-12">
                                                        <div class="form-group"><label for="obs"><strong>Observaciones</strong><br></label><textarea class="form-control" type="text" placeholder="Observaciones" name="obs"></textarea></div>
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
                                                        <a class="btn btn-secondary" href="Lista_proyectos.php">Volver</a>
                                                    </div>
                                                    <div class="col" style="max-width:fit-content">

                                                        <input type="submit" name="submit" class="btn btn-primary " value="Crear Proyecto" />
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div>

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