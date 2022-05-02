<?php
session_start();
//vuelve a la pagina de inicio si no esta registrado
if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == '')) {
    header('location:index.php');
}

include_once('logs.class.php');
include_once('Usuarios.class.php');

$log = new  log_class();
$user = new Usuario();

//extrae datos de usuaio
$sql = "SELECT * FROM usuarios WHERE id_usuario = '" . $_SESSION['user'] . "'";
$row = $user->detalle($sql);

?>
<!DOCTYPE html>
<html>

<head>
    <title>Configuración.</title>
    <?php include('header.php'); ?>
</head>


<body id="page-top">
    <div id="wrapper">
        <?php include('navbar.php'); ?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php include('navbar_superior.php'); ?>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Logs</h3>

                    <div class="card shadow ">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Entradas y acciones del sistema&nbsp;</p>
                        </div>
                        <div class="card-body" style="text-align: center;">
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table dataTable my-0" id="dataTable" data-show-export="true" data-force-export="true" data-toggle="table" data-search="true" data-pagination="true" data-show-columns="true" data-locale="es-ES">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th data-field="alias" data-sortable="true">Usuario</th>
                                            <th data-field="Accion" data-sortable="true">Accion</th>
                                            <th data-field="TimeStamp" data-sortable="true">TimeStamp</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $filas = $log->mostrarDatos();
                                        foreach ($filas as $fila) {
                                        ?>
                                            <tr>

                                                <!-- <td>/<?php //echo $fila['id_usuario'] 
                                                            ?></td> -->
                                                <td><?php echo $fila['alias'] ?></td>
                                                <td><?php echo $fila['Accion'] ?></td>

                                                <td><?php echo $fila['TimeStamp'] ?></td>

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