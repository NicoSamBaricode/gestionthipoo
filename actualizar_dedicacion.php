<?php
session_start();
//vuelve a la pagina de inicio si no esta registrado
if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == '')) {
    header('location:index.php');
}


include_once('Usuarios.class.php');
include_once('dedicacion.class.php');
include_once('proyectos.class.php');

$user = new Usuario();
$dedicacion_obj = new Dedicacion_class();
$proyecto = new Proyecto_class();


//extrae datos de usuaio
$sql = "SELECT * FROM usuarios WHERE id_usuario = '" . $_SESSION['user'] . "'";
$row = $user->detalle($sql);


// actualiza
if (isset($_POST['updateDedicacion'])) {
    $dedicacion_obj->actualizarFilaD($_POST);
}

// funcion edita
if (isset($_GET['editId']) && !empty($_GET['editId'])) {
    $editId = $_GET['editId'];
    $dedicacion = $dedicacion_obj->mostrarFilaPorId($editId);
    $aux_u = $user->mostrarFilaPorId($dedicacion['id_agente']);
    $aux_p = $proyecto->mostrarFilaPorId($dedicacion['imputacion'], 2);
}





?>

<!DOCTYPE html>
<html>

<head>
    <title>Editar Dedicacion</title>
    <?php include('header.php'); ?>

</head>

<style>
    .rojo {
        color: red !important;
    }
</style>

<body id="page-top">
    <div id="wrapper">
        <?php include('navbar.php'); ?>
        <div class="d-flex flex-column " id="content-wrapper">
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
                                            <p class="text-primary m-0 font-weight-bold">Dedicación</p>
                                        </div>
                                        <div class="card-body">
                                            <form action="actualizar_dedicacion.php" method="POST">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="id_agente"><strong>Agente</strong><br></label><select class="form-control" require name="id_agente" id="id_agente" disabled>
                                                                <?php

                                                                ?>
                                                                <option value="<?php echo $aux_u['id_usuario']; ?>">
                                                                    <?php echo  $aux_u['nombre'] ?>
                                                                </option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col" hidden>
                                                        <div class="form-group"><label for="id_dedicacion"><strong>id dedicacion</strong></label><input class="form-control" type="text" required="Ingrese dato valido" value="<?php echo ($dedicacion['id_dedicacion']) ?> " name="id_dedicacion"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="mes"><strong>Mes</strong></label><input class="form-control" type="text" required="Ingrese dato valido" value="<?php echo ($dedicacion['mes']) ?> " name="mes" id="mes" disabled></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="anio"><strong>Año</strong><br></label><input class="form-control" type="text" placeholder="Año" value="<?php echo ($dedicacion['anio']) ?> " name="anio" id="anio" disabled></input></div>
                                                    </div>
                                                </div>

                                                <div class="form-row">

                                                    <div class="col">
                                                        <div class="form-group"><label for="horas"><strong>Horas Planificadas</strong><br></label><input class="form-control" type="text" placeholder="Ingrese cantidad de horas" value="<?php echo ($dedicacion['horas']) ?>" name="horas" id="planificadas" disabled></input></div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group"><label for="horasR"><strong>Diferencia Planificadas/Relevadas</strong><br></label><input class="form-control" type="text" id="diferencia" name="diferencia" readonly></input></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="horasR"><strong>Horas Restantes Agente Mes</strong><br></label><input class="form-control" type="text" id="horas_restantes" placeholder="Ingrese cantidad de horas" name="horasRestantes" readonly></input></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="horasR"><strong>Horas Relevadas</strong><br></label><input min="0" class="form-control" type="number" id="horas_relevadas" value="<?php echo ($dedicacion['horas_relevadas']) ?>" placeholder="Ingrese cantidad de horas" name="horasR"></input></div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="resp"><strong>Proyecto</strong><br></label><select class="form-control" require name="imputacion" id="proyectoID" disabled>

                                                                <option value="<?php echo  $aux_p['id_proyectos'] ?>"> <?php echo  $aux_p['nombre'] ?></option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="obs"><strong>Metas/Observaciones</strong><br></label><textarea id="obs" class="form-control" type="text" placeholder="Metas/Observaciones" value="<?php echo ($dedicacion['obs']) ?>" name="obs"><?php echo ($dedicacion['obs']) ?></textarea></div>
                                                    </div>
                                                </div>
                                                <div class="form-row" style="margin-left:auto; right:0px; max-width:fit-content">

                                                    <div class="col" style="max-width:fit-content">
                                                        <a class="btn btn-secondary" href="Lista_dedicacion.php">Volver</a>
                                                    </div>
                                                    <div class="col" style="max-width:fit-content">
                                                        <input type="submit" name="updateDedicacion" class="btn btn-primary " id="guardarDedicacion" value="Guardar" />
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
<script>
    $("#guardarDedicacion").on("click", function() {


        $.post("ajaxCalculoHorasProyectoRelevadas.php", {
                proyecto: $("#proyectoID").val(),

            })
            .done(function(data) {
                console.log(data);
                // alert("Calculo horas por proyecto relevadas: " + data);

            });
    });




    function calculoHorasRestantes() {
        var horas_restantesMasRelevadas = 0;
        var horas_planificadas = $("#planificadas").val();
        var horas_relevadas = $("#horas_relevadas").val();
        var diferencia = horas_planificadas - horas_relevadas;
        var horas_restantes = $("#horas_restantes").val();

        if (diferencia < 0) {
            $("#diferencia").addClass("rojo");
        } else {
            $("#diferencia").removeClass("rojo");
        }
        $("#diferencia").val(diferencia);

        $.post("ajaxHorasMes.php", {
                mes: $("#mes").val(),
            })
            .done(function(data) {

                horas_restantesMasRelevadas = data - horas_relevadas;

                if (horas_restantesMasRelevadas < 0) {
                    $("#horas_restantes").addClass("rojo");
                } else {
                    $("#horas_restantes").removeClass("rojo");
                }
                $("#horas_restantes").val(horas_restantesMasRelevadas);


            });


    }

    $("#horas_relevadas").on("keyup", function() {
        calculoHorasRestantes();
    });
    $("#horas_relevadas").on("change", function() {
        calculoHorasRestantes();
    });
    $(document).ready(function() {
        calculoHorasRestantes();

        $.post("ajaxHorasMes.php", {
                mes: $("#mes").val(),

            })
            .done(function(data) {
                var horas_totales = data;
                $.post("ajaxCalculoHorasAgenteRelevadas.php", {
                        mes: $("#mes").val(),
                        planificadas: $("#planificadas").val(),
                        anio: $("#anio").val(),
                        agente: $("#id_agente").val(),
                        totales: data,
                    })
                    .done(function(data2) {
                        $("#horas_restantes").val(data2);
                        // alert("Calculo horas restante por agente: " + data);
                        console.log(data2);
                    });
            });
    });
</script>

</html>