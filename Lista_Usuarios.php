<?php
session_start();
//vuelve a la pagina de inicio si no esta registrado
if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == '')) {
    header('location:index.php');
}

include_once('Usuarios.class.php');
include_once('proyectos.class.php');

$user = new Usuario();
$proyecto = new Proyecto_class();

//extrae datos de usuaio

$row = $user->mostrarFilaPorIdConNombre($_SESSION['user']);




//contador usuarios
$cont = $user->cont_u();

//llama funcion borrar
if (isset($_GET['borrarid']) && !empty($_GET['borrarid'])) {
    $borrarId = $_GET['borrarid'];
    $user->borrar_usuario($borrarId);
}



?>
<!DOCTYPE html>
<html>

<head>
    <title>Lista Usuarios</title>
    <?php include('header.php'); ?>
</head>


<body id="page-top">
    <div id="wrapper">
        <?php include('navbar.php'); ?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php include('navbar_superior.php'); ?>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Usuarios</h3>
                    <div class="row">
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-left-primary py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>Nuevo Usuario</span></div>
                                            <div class="text-dark font-weight-bold h5 mb-0"><span></span></div>
                                        </div>
                                        <?php if ($row['rol'] == 'Admin') { ?>
                                            <div class="col-auto"><a class="btn btn-primary" href="crear_usuario.php"><i class="fas fa-user-plus  text-gray-300"></i></a></div>
                                        <?php } else { ?>
                                            <div class="col-auto"><a class="btn btn-primary" target="_blank" href="mailto:nicolas.sammarco@cab.cnea.gov.ar"><i class="fas fa-user-plus  text-gray-300"></i></a></div>
                                        <?php  } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-left-warning py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"><span>Usuarios</span></div>

                                        </div>
                                        <div class="col-auto" style="color: darkgoldenrod;margin-right: 1rem; font-size: larger;">

                                            <?php echo  $cont; ?>

                                        </div>
                                        <div class="col-auto"><i class="fas fa-tasks fa-2x text-gray-300"></i></div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Listado de Usuarios&nbsp;</p>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table dataTable my-0" id="dataTable" data-show-export="true" data-force-export="true" data-toggle="table" data-search="true" data-pagination="true" data-show-columns="true" data-locale="es-ES">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th data-field="id" data-sortable="false">id</th>
                                            <th data-field="Nombre" data-sortable="true">Nombre</th>
                                            <th data-field="Apellido" data-sortable="true">Apellido</th>
                                            <th data-field="Sector" data-sortable="true">División</th>

                                            <th data-field="Email" data-sortable="true">Email</th>
                                            <th data-field="Usuario" data-sortable="true">Usuario</th>
                                            <th data-field="Legajo" data-sortable="true">Legajo</th>
                                            <th data-field="Gde" data-sortable="true">Gde</th>
                                            <th data-field="Rol" data-sortable="true">Estado</th>
                                            <th data-field="detalles" data-sortable="true">Detalles</th>
                                            <?php if ($row['rol'] == 'Admin') {

                                                echo (" <th data-field='editar' data-sortable='true'>Editar </th>
                                                <th data-field='Eliminar' data-sortable='true'>Eliminar</th>");
                                            } ?>




                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $filas = $user->mostrarDatosCompletos();
                                        foreach ($filas as $fila) {
                                        ?>
                                            <tr>

                                                <td><?php echo $fila['id_usuario'] ?></td>
                                                <td><?php echo $fila['nombre'] ?></td>
                                                <td><?php echo $fila['apellido'] ?></td>
                                                <td><?php echo $fila["NombreSector"] ?></td>
                                                <td><?php echo $fila['mail'] ?></td>
                                                <td><?php echo $fila["alias"] ?></td>
                                                <td><?php echo $fila["legajo"] ?></td>
                                                <td><?php echo $fila["gde"] ?></td>
                                                <td><?php
                                                    if ($fila["estado"] == 1) {
                                                        echo "Activo";
                                                    }
                                                    if ($fila["estado"] == 0) {
                                                        echo "Inactivo";
                                                    }
                                                    if ($fila["estado"] == 2) {
                                                        echo "Licencia";
                                                    } ?></td>
                                                <script src="cartel.js"> </script>
                                                <td style="text-align: center;"><a class="btn btn-secondary mx-auto btn-circle ml-1" role="button" href="detalle_usuario.php?Id=<?php echo $fila['id_usuario'] ?>"><i class="fas fa-plus-circle text-white"></i></a></td>
                                                <?php if ($row['rol'] == 'Admin') { ?>

                                                    <td style="text-align: center;"><a class="btn btn-info mx-auto btn-circle ml-1" role="button" href="actualizar.php?editId=<?php echo $fila['id_usuario'] ?>"><i class="fas fa-user-circle text-white"></i></a></td>
                                                    <td style="text-align: center;"><a class="btn btn-danger mx-auto btn-circle ml-1" onclick="return confirmBorrar()" role="button" href="Lista_Usuarios.php?borrarid=<?php echo $fila['id_usuario'] ?>"><i class="fas fa-trash text-white"></i></a></td>
                                                <?php } ?>
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
</body>
<?php include('footer.php'); ?>

</html>