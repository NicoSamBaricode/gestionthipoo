<?php
session_start();
//vuelve a la pagina de inicio si no esta registrado
if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == '')) {
    header('location:index.php');
}

include_once('Usuarios.class.php');

include_once('temas.class.php');

$user = new Usuario();

$tema = new Temas_class();

//extrae datos de usuaio
$sql = "SELECT * FROM usuarios WHERE id_usuario = '" . $_SESSION['user'] . "'";
$row = $user->detalle($sql);

//llama a la funcion de insertar datos
if (isset($_POST['submit'])) {
    $tema->insertarDatos($_POST);
}
//llama funcion borrar
if (isset($_GET['borrarid']) && !empty($_GET['borrarid'])) {
    $borrarId = $_GET['borrarid'];
    $tema->borrar_tema($borrarId);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crear Tema</title>
    <?php include('header.php'); ?>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include('navbar.php'); ?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php include('navbar_superior.php'); ?>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Agregar Tema</h3>
                    <div class="row mb-3">

                        <div class="col-lg-12">

                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 font-weight-bold">Configurar Tema</p>
                                        </div>
                                        <div class="card-body">
                                            <form action="crear_tema.php" method="POST">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="nombre"><strong>Nombre&nbsp;</strong></label><input class="form-control" type="text" placeholder="Nombre " name="nombre" required="Ingrese dato valido"></div>
                                                    </div>

                                                </div>

                                                <div class="form-row" style="margin-left:auto; right:0px; max-width:fit-content">

                                                    <div class="col" style="max-width:fit-content">
                                                        <a class="btn btn-secondary" href="Lista_proyectos.php">Volver</a>
                                                    </div>
                                                    <div class="col" style="max-width:fit-content">

                                                        <input type="submit" name="submit" class="btn btn-primary " value="Agregar Tema" />
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div>

                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 font-weight-bold">Información&nbsp;</p>
                                        </div>
                                        <div class="card-body">

                                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                                <table class="table dataTable my-0" id="dataTable" data-show-export="true" data-force-export="true" data-toggle="table" data-search="true" data-pagination="true" data-show-columns="true" data-locale="es-ES">
                                                    <thead class="thead-dark">
                                                        <tr>

                                                            <th data-field="Nombre" data-sortable="true">Nombre</th>

                                                            
                                                            <?php if ((('Admin' == $row["rol"]) || ('Jefe Depto' == $row["rol"]))) {

                                                            ?>
                                                                <th id="borrar1" class="editar">Editar</th>
                                                                <th id="borrar2" class="eliminar">Eliminar</th>
                                                            <?php }  ?>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php
                                                        $filas = $tema->mostrarDatos();

                                                        foreach ($filas as $fila) {
                                                        ?>
                                                            <tr>
                                                                <?php

                                                                ?>


                                                                <td><?php echo $fila['nombre'] ?></td>

                                                                <script src="cartel.js"> </script>

                                                              
                                                                <?php if ((('Admin' == $row["rol"]) || ('Jefe Depto' == $row["rol"]))) {

                                                                ?>
                                                                    <td class="editar"><a class="btn btn-info mx-auto btn-circle ml-1 editar" role="button" href="actualizar_tema.php?Id=<?php echo $fila['id_tema'] ?>"><i class="fas fa-edit text-white"></i></a></td>
                                                                    <td class="eliminar"><a class="btn btn-danger mx-auto btn-circle ml-1 eliminar" onclick="return confirmBorrar()" role="button" href="crear_tema.php?borrarid=<?php echo $fila['id_tema'] ?>"><i class="fas fa-trash text-white"></i></a></td>
                                                                <?php }  ?>
                                                            </tr>
                                                        <?php }  ?>


                                                    </tbody>

                                                </table>
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