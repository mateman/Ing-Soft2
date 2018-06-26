<?php require RUTA_APP.'/views/includes/header.php'; ?>

<?php require RUTA_APP.'/views/includes/userinterface-menu.php'; ?>
 <div class="mensaje">
        <?php if(isset($datos['mensaje'])) {
                    echo $datos['mensaje'];
                } ?> </div>
                <div class="mensaje">
</div>

<div class="container">
<div class="row">
<div class="col"></div>
<div class="col">
<br>
<br>
<br>
    <a href="<?php echo RUTA_URL; ?>/viaje/agregarViaje" type="button" class="btn btn-success">Crear Viaje</a>
<br>
<br>
<br>
</div>
<div class="col"></div>
</div>
</div>
<div class="container">
<h2>Mis viajes</h2>

<table class="table table-dark table-striped">
    <thead>
    <tr>
        <th>Origen</th>
        <th>Hora de salida</th>
        <th>Destino</th>
        <th>Hora de llegada</th>
        <th>Descricpion</th>
        <th>Costo</th>
        <th>Modificar</th>
        <th>Eliminar</th>
        <th>Muro</th>
    </tr>
    </thead>
    <tbody>
    <?php for ($i = 0; $i < $datos['cantViajes'] ; $i++) { ?>
        <tr>
            <td><?php echo($datos['viajes'][$i]->origen) ?></td>
            <td><?php echo($datos['viajes'][$i]->horasalida) ?></td>
            <td><?php echo($datos['viajes'][$i]->destino); ?></td>
            <td><?php echo($datos['viajes'][$i]->horallegada); ?></td>
            <td><?php echo($datos['viajes'][$i]->descripcion); ?></td>
            <td><?php echo($datos['viajes'][$i]->costo); ?></td>
            <td>
                <a href="<?php echo RUTA_URL; ?>/viaje/modificarViaje/<?php echo($datos['viajes'][$i]->id); ?>"><button>Modificar</button></a>
            </td>
            <td>
                <a href="<?php echo RUTA_URL; ?>/viaje/viajeEliminar/<?php echo($datos['viajes'][$i]->id); ?>"><button>Eliminar</button></a>

            </td>
            <td>
                <a href="<?php echo RUTA_URL; ?>/viaje/muro/<?php echo($datos['viajes'][$i]->id);?>"> <img src="<?php echo RUTA_URL;?>/public/img/icons8-car.png" alt="" ></a>
            </td>

        </tr>
    <?php } ?>



    </tbody>
</table>
</div>

<?php require RUTA_APP.'/views/includes/footer.php'; ?>








