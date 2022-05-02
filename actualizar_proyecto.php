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
$proyecto_obj = new Proyecto_class();
$tipo = 1;

//extrae datos de usuaio
$sql = "SELECT * FROM usuarios WHERE id_usuario = '" . $_SESSION['user'] . "'";
$row = $user->detalle($sql);

// funcion edita
if (isset($_GET['editId']) && !empty($_GET['editId'])) {
    $editId = $_GET['editId'];
    $proyecto = $proyecto_obj->mostrarFilaPorId($editId,$tipo);
}

// actualiza
if (isset($_POST['update'])) {
    $proyecto_obj->actualizarFila($_POST,$tipo);
}
//llama funcion borrar
if (isset($_GET['borrarid']) && !empty($_GET['borrarid'])) {
    $borrarId = $_GET['borrarid'];
    $proyecto->borrar_proyecto($borrarId);
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Actualizar proyecto</title>
    <?php include('header.php'); ?>

</head>

<body id="page-top">
    <div id="wrapper">
        <?php include('navbar.php'); ?>

        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
            <?php include('navbar_superior.php'); ?>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Editar </h3>
                    <div class="row mb-3">
                        
                        <div class="col-lg-12">

                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 font-weight-bold">Proyecto</p>
                                        </div>
                                        <div class="card-body">
                                            <form action="actualizar_proyecto.php" method="POST">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="nombre"><strong>Nombre&nbsp;</strong></label><input class="form-control" type="text" placeholder="Nombre " name="nombre" required="Ingrese dato valido" value="<?php echo $proyecto['nombre']; ?>"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="fecha"><strong>Fecha de Inicio</strong></label><input class="form-control" type="date" placeholder="Fecha inicio" required="Ingrese dato valido" name="fecha" value="<?php echo $proyecto['fecha_inicio']; ?>"></div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="identificador"><strong>Identificador&nbsp;</strong></label><input class="form-control" type="text" placeholder="Identificador" name="identificador" required="Ingrese dato valido" value="<?php echo $proyecto['identificador']; ?>"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="tema"><strong>Tema</strong></label><input class="form-control" type="text" placeholder="Tema" name="tema" value="<?php echo $proyecto['tema']; ?>"></div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="descripcion"><strong>Descripcion</strong><br></label><input class="form-control" type="text" placeholder="Descripcion" name="descrip" value="<?php echo $proyecto['descripcion']; ?>"></div>
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
                                                        <div class="form-group"><label for="resp"><strong>Responsable</strong><br></label><input class="form-control" type="text" required="Ingrese dato valido" placeholder="Responsable" name="resp" value="<?php echo $proyecto['responsable']; ?>"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="frealizacion"><strong>Fecha finalizacion</strong><br></label><input class="form-control" type="date" placeholder="Ingrese fecha de finalizacion" name="frealizado" value="<?php echo $proyecto['fecha_realizado']; ?>"></div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="obs"><strong>Observaciones</strong><br></label><input class="form-control" type="text" placeholder="Observaciones" name="obs" value="<?php echo $proyecto['observaciones']; ?>"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="estado"><strong>Estado</strong><br></label><select class="form-control" require name="estado" id="exampleFormControlSelect1" value="<?php echo $proyecto['estado']; ?>">

                                                                <option selected><?php echo $proyecto['estado']; ?></option>
                                                                <option>Pendiente</option>
                                                                <option>En proceso</option>
                                                                <option>Realizado</option>
                                                                <option>Cancelado</option>
                                                                <option>Revisar</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <!-- <div class="form-group"><label for="imagen"><strong>Imagen de Perfil</strong><br></label><br><input type="file" required class="btn btn-secondary btn-sm" name="imagen" value="agregar imagen"/></div> -->
                                                    </div>
                                                    <input type="hidden" name="id_proyectos" value="<?php echo $proyecto['id_proyectos']; ?>">
                                                </div>
                                                <div class="form-row" style="margin-left:auto; right:0px; max-width:fit-content">

                                                    <div class="col" style="max-width:fit-content">
                                                        <a class="btn btn-secondary" href="Lista_Proyectos.php">Volver</a>

                                                    </div>
                                                    <div class="col" style="max-width:fit-content">

                                                        <input type="submit" name="update" class="btn btn-primary " value="Actualizar" />
                                                    </div>
                                                    <div class="col" style="max-width:fit-content">
                                                        <a class="btn btn-danger mx-auto btn-circle ml-1" onclick="return confirmBorrar()" role="button" href="Lista_proyectos.php?borrarid=<?php echo $proyecto['id_proyectos'] ?>"><i class="fas fa-trash text-white"></i></a>

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
     
</body>
<?php include('footer.php'); ?>
</html>