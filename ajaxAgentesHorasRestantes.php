<?php

include_once('dedicacion.class.php');



$dedicacion = new Dedicacion_class();

$mes = $_POST[('mes')];
$anio = $_POST[('anio')];
$opcion = 1;
$rol= $_POST[('rol')];
$sectorId = $_POST[('sectorId')];
$filas = $dedicacion->mostrarUsuariosSinCargarHoras($mes, $anio, $opcion, $rol,$sectorId);

?>

<div class="table-responsive table mt-2" id="dataTable22" role="grid" aria-describedby="dataTable_info">
    <table class="table dataTable my-0" id="table22" data-show-export="true" data-force-export="true" data-toggle="table" data-search="true" data-pagination="true" data-show-columns="true" data-locale="es-ES">
        <thead class="thead-dark">
            <tr>
                <th data-field="Agente" data-sortable="true">Agente</th>
                <th data-field="Mes" data-sortable="true">Mes</th>
            </tr>
        </thead>
        <tbody>

            <?php
            foreach ($filas as $fila) {
            ?>
                <tr>
                    <td><?php echo $fila['apellido'] . " " . $fila['nombre'] ?></td>
                    <td><?php echo $mes ?></td>
                </tr>
            <?php }  ?>

        </tbody>

    </table>
</div>

