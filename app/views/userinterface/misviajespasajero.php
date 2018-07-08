


<?php require RUTA_APP.'/views/includes/header.php'; ?>

<?php require RUTA_APP.'/views/includes/userinterface-menu.php'; ?>
<div class="container">
    <div class="row">
    <div class="col">
    <br /><br />
    <table class="table table-dark table-striped">
    <thead>
    <tr>
        <th>Origen</th>
        <th>Hora de salida</th>
        <th>Destino</th>
        <th>Hora de llegada</th>
        <th>Descripcion</th>
        <th>Costo</th>
        <th>Muro</th>

    </tr>
    </thead>
    <tbody>
 
    <?php foreach ($datos['viajes'] as $viaje):  ?>
        <tr>
            <td><?php echo $viaje->origen; ?></td>
            <td><?php echo date("d-m-Y H:i", strtotime($viaje->horasalida)); ?></td>
            <td><?php echo $viaje->destino; ?></td>
            <td><?php echo date("d-m-Y H:i", strtotime($viaje->horallegada)); ?></td>
            <td><?php echo $viaje->descripcion; ?></td>
            <td><?php echo $viaje->costo; ?></td>
            <td>
                <a href="<?php echo RUTA_URL; ?>/viaje/muro/<?php echo $viaje->viaje_id; ?>/misviajespasajero"> <img src="<?php echo RUTA_URL;?>/public/img/<?php  if ($viaje->estado ==1){echo 'icons8-car-aceptado.png" title="Aceptado';}elseif ($viaje->estado ==2){echo 'icons8-car-rechazado.png" title="Rechazado';}else{echo 'icons8-car.png" title="En espera';}; ?>" alt="" onmouseover="normalImg(this)" onmouseout="smallImg(this)" width="36" height="36"></a>
            </td>

        </tr>
    <?php endforeach; ?>



    </tbody>
</table>
    </div>
    </div>
</div>
<script>
    function smallImg(x) {
        x.style.height = "36px";
        x.style.width = "36px";
    }

    function normalImg(x) {
        x.style.height = "50px";
        x.style.width = "50px";
    }
</script>

<?php require RUTA_APP.'/views/includes/footer.php'; ?>








