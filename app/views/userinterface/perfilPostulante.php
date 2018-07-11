<div class="modal-header">
    <h4 class="modal-title" id="myModalLabel">Informacion del pasajero</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>         <!-- /modal-header -->
<div class="modal-body">
    <br>
    <p><b>Nombre:</b> <?php echo $datos['nombre'] ?></p>
    <hr>
    <p><b>Apellido: </b><?php echo $datos['apellido'] ?>
    <hr>
    <p><b>Nombre de usuario:</b> <?php echo $datos['nombreusuario'] ?>
    <hr>
    <p><b>Provincia:</b> <?php echo $datos['provincia'] ?>
    <hr>
    <p><b>Ciudad:</b> <?php echo $datos['ciudad'] ?>
    <hr>
    <p><b>Calificaion:</b> <?php if ($datos['calificacion']<0) { echo '0';} else { echo $datos['calificacion'];}; ?>
    <hr>
    <hr>
    <?php
    $im = file_get_contents(RUTA_APP.'/../public/img/users/'. $datos['imagenurl']);
    $imdata = base64_encode($im);
    echo "<p><img class=\"img-perfil\" src='data:image/jpg;base64,".$imdata."' />";
    ?>
</div>
</div>         <!-- /modal-body -->
<div class="container">








