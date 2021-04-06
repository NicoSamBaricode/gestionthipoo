<?php 
session_start();
//vuelve a la pagina de inicio si no esta registrado
if (!isset($_SESSION['user']) ||(trim ($_SESSION['user']) == '')){
	header('location:index.php');
}

include_once('Usuarios.class.php');
include_once('proyectos.class.php');
include_once('tareas.class.php');

$user = new Usuario();
$proyecto = new Proyecto_class();
$tarea= new Tarea_class();

//extrae datos de usuaio
$sql = "SELECT * FROM usuarios WHERE id_usuario = '".$_SESSION['user']."'";
$row = $user->detalle($sql);

//recibe el id de lista de proyectos
$id_tarea= $_GET["detalleid"];
$fila_tarea=$tarea->mostrarFilaPorId($id_tarea);
$aux_u=$user->mostrarFilaPorId($fila_tarea['responsable']);
$aux_p=$proyecto->mostrarFilaPorId($fila_tarea['id_proyectos']);
                                          

  //llama funcion borrar
  if(isset($_GET['borrarid']) && !empty($_GET['borrarid'])) {
    $borrarId = $_GET['borrarid'];
    $proyecto->borrar_proyecto($borrarId);
} 

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>detalle</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/estilos.css">
    
    <link rel="stylesheet" href="assets/bootstrap/css/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="far fa-clipboard"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>THI Gestión</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="nav navbar-nav text-light" id="accordionSidebar">
                <li class="nav-item" role="presentation"><a class="nav-link active" href="panel.php"><i class="fas fa-tachometer-alt"></i><span>Panel Principal</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="Lista_Usuarios.php"><i class="fas fa-user"></i><span>Usuarios</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="Lista_Proyectos.php"><i class="fas fa-table"></i><span>Proyectos</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="Lista_Tareas.php"><i class="fas fa-list"></i><span>Tareas</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="stock.php"><i class="fas fa-warehouse"></i><span>Recursos</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="cerrar_sesion.php"><i class="fas fa-user-circle"></i><span>Cerrar Sesión</span></a></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
            <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        
                        <ul class="nav navbar-nav flex-nowrap ml-auto">
                            
                            
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow" role="presentation">
                            <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small"><?php echo $row['nombre'] ?></span><img class="border rounded-circle img-profile" src="<?php echo $row['imagen']?>"></a>
                                    <div
                                        class="dropdown-menu shadow dropdown-menu-right animated--grow-in" role="menu"><a class="dropdown-item" role="presentation" href="#"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Profile</a><a class="dropdown-item" role="presentation" href="#"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Settings</a>
                                        <a
                                            class="dropdown-item" role="presentation" href="#"><i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Registro de actividades</a>
                                            <div class="dropdown-divider"></div><a class="dropdown-item" role="presentation" href="cerrar_sesion.php"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Logout</a></div>
                    </div>
                    </li>
                    </ul>
            </div>
            </nav>
            <div class="container-fluid">
                <h3 class="text-dark mb-4">Tarea</h3>
                <div class="row mb-3">
                   
                    <div class="col-lg-12">
                        
                        <div class="row">
                            <div class="col">
                                <div class="card shadow mb-3">
                                    <div class="card-header py-3">
                                        <p class="text-primary m-0 font-weight-bold"><?php echo $fila_tarea["nombre"] ?></p>
                                    </div>
                                    <div class="card-body">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                         <li class="nav-item" role="presentation">
                                           <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Detalles</a>
                                         </li>
                                         
                                         <li class="nav-item" role="presentation">
                                           <a class="nav-link" id="recursos-tab" data-toggle="tab" href="#recursos" role="tab" aria-controls="recursos" aria-selected="false">Recursos</a>
                                         </li>
                                         <li class="nav-item" role="presentation">
                                           <a class="nav-link" id="int-tab" data-toggle="tab" href="#int" role="tab" aria-controls="int" aria-selected="false">Integrantes</a>
                                         </li>
                                        </ul>

                                        <div class="tab-content" id="myTabContent">
                                         <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                         <form action="actualizar_tarea.php" method="POST" class="formulario" >
                                        
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="nombre"><strong>Nombre&nbsp;</strong></label><p><?php echo $fila_tarea["nombre"] ?></p></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="fecha"><strong>Fecha de Inicio</strong></label><p><?php echo $fila_tarea["f_inicio"] ?></p></div>
                                                    </div>
                                                </div>
                                              
                                                <div class="form-row">
                                                    <div class="col">
                                                    <div class="form-group"><label for="descripcion"><strong>Descripcion</strong><br></label><p><?php echo $fila_tarea["descripcion"] ?></p></div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="resp"><strong>Responsable</strong><br></label><p><?php echo $aux_u["nombre"] ?></p></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="frealizacion"><strong>Fecha finalizacion</strong><br></label><p><?php echo $fila_tarea["f_final"] ?></p></div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                <div class="col">
                                                        <div class="form-group"><label for="proy"><strong>Perteneciente a proyecto</strong><br></label><p><?php echo $aux_p["nombre"] ?></p></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="estado"><strong>Estado</strong><br></label><p><?php echo $fila_tarea["Estado"] ?></p></div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="id_proyectos" value="<?php echo $fila_tarea['id_tareas']; ?>">
                                                <!--  
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="archivo"><strong>Subir archivo</strong><br></label><br><input type="file"  class="btn btn-secondary btn-sm" name="archivo" value="agregar archivo"/></div>
                                                    </div>
                                                    
                                                </div>-->
                                                <div class="form-row" style="margin-left:auto; right:0px; max-width:fit-content">
                                                 
                                                    
                                                    <div class="col" style="max-width:fit-content">
                                                     
                                                    
                                                    <a class="btn btn-info mx-auto  ml-1" role="button" href="actualizar_tarea.php?editId=<?php echo $fila_tarea['id_tareas'] ?>" >Actualizar</a>
                                                    </div>
                                                    <div class="col" style="max-width:fit-content">
                                                    <a class="btn btn-danger mx-auto btn-circle ml-1" onclick="return confirmBorrar()" role="button" href="Lista_Tareas.php?borrarid=<?php echo $fila_tarea['id_tareas'] ?>"><i class="fas fa-trash text-white"></i></a>
                                                </div>
                                            </div>
                                            </form>
                                        
                                         </div>
                                         <div class="tab-pane fade" id="recursos" role="tabpanel" aria-labelledby="recursos-tab">recursos</div>
                                         <div class="tab-pane fade" id="int" role="tabpanel" aria-labelledby="int-tab">integrantes</div>
                                        </div>
                                        
                                    </div>
                                    <div class="card-footer">
                                        <div class="row" id="boton-volver">
                                        <div class="col" style="max-width:fit-content">
                                                    <a class="btn btn-secondary" href="Lista_Tareas.php">Volver</a>
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
        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright © Thi Programación</span></div>
            </div>
        </footer>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>

</body>

</html>