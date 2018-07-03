<?php require RUTA_APP.'/views/includes/header.php'; ?>

<?php require RUTA_APP.'/views/includes/userinterface-menu.php'; ?>
<script src="<?php echo RUTA_URL;?>/public/js/main.js"></script>

 <div class="mensaje" align="center">
     <p><h3><strong><I><?php if(isset($datos['mensaje'])) {
                    echo $datos['mensaje'];
                } ?></I></strong></h3></p> </div>
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
    <?php for ($i = 0; $i < $datos['cantViajes'] ; $i++) {
 //   $modeloViajes= $this->model('Modeloviajes');
 //   $tienePasajeros = $modeloViajes->tienePasajeros($datos['viajes'][$i]->id);
     ?>
        <tr>
            <td><?php echo($datos['viajes'][$i]->origen); ?></td>
            <td><?php echo(date("d-m-Y H:i", strtotime($datos['viajes'][$i]->horasalida))); ?></td>
            <td><?php echo($datos['viajes'][$i]->destino); ?></td>
            <td><?php echo(date("d-m-Y H:i", strtotime($datos['viajes'][$i]->horallegada))); ?></td>
            <td><?php echo($datos['viajes'][$i]->descripcion);  ?></td>
            <td><?php echo($datos['viajes'][$i]->costo); ?></td>
            <td>
                <a href="<?php echo RUTA_URL; ?>/viaje/modificarViaje/<?php echo($datos['viajes'][$i]->id); ?>"><img src="<?php echo RUTA_URL;?>/public/img/icons8-maintenance.png" alt="" onmouseover="normalImg(this)"  onmouseout="smallImg(this)" width="32" height="32"></a>
            </td>
            <td>
                <a><img src="<?php echo RUTA_URL;?>/public/img/icons8-trash.png" alt="" onmouseover="normalImg(this)" onmouseout="smallImg(this)" width="32" height="32" onclick="borrar(<?php echo($datos['viajes'][$i]->id); ?>);"></a>

            </td>
            <td>
                <a href="<?php echo RUTA_URL; ?>/viaje/muro/<?php echo($datos['viajes'][$i]->id);?>/misviajes"> <img src="<?php echo RUTA_URL;?>/public/img/icons8-car.png" alt="" onmouseover="normalImg(this)" onmouseout="smallImg(this)" width="32" height="32"></a>
            </td>

        </tr>
    <?php } ?>



    </tbody>
</table>
</div>

<script>
    function borrar(id) {
        if(id == 0){
            var mensaje = "¿desea usted realmente borrar el viaje?";
        }
        else{
            var mensaje = "El viaje seleccionado tiene pasajeros aceptados, si lo elimina se le descontará un punto ¿desea realmente borrarlo?";
        }
        var link = "<?php echo RUTA_URL; ?>/viaje/viajeEliminar/"+id;
        var respuesta=Confirm('Borrar Viaje',mensaje, link);
     
    }

    function smallImg(x) {
        x.style.height = "32px";
        x.style.width = "32px";
    }

    function normalImg(x) {
        x.style.height = "50px";
        x.style.width = "50px";
    }
</script>

<?php require RUTA_APP.'/views/includes/footer.php'; ?>








