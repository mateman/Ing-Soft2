


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
        <th>Descricpion</th>
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
                <a href="<?php echo RUTA_URL; ?>/viaje/muro/<?php echo $viaje->viaje_id; ?>/misviajespasajero"> <img src="<?php echo RUTA_URL;?>/public/img/icons8-car.png" alt="" ></a>
            </td>

        </tr>
    <?php endforeach; ?>



    </tbody>
</table>
    </div>
    </div>
</div>
<?php require RUTA_APP.'/views/includes/footer.php'; ?>








