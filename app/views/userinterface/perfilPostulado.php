<?php require RUTA_APP.'/views/includes/header.php'; ?>

<?php require RUTA_APP.'/views/includes/userinterface-menu.php'; ?>
<style>
.img-perfil {
    max-width:60px;
    max-height:60px;
}
</style>
<?php echo ('<a href="'. RUTA_URL.'/viaje/muro/'.$datos['path'].'/unAventon"><img src="'.RUTA_URL.'/public/img/icons8-undo-52.png" alt="" ></a>'); ?>

<div class="container">
    <br>
 
    <p><b>Nombre:</b> <?php echo $datos['nombre'] ?></p>
    <hr>
    <p><b>Apellido: </b><?php echo $datos['apellido'] ?>
    <hr>
    <p><b>Nombre de usuario:</b> <?php echo $datos['nombreusuario'] ?>
    <hr>
    <p><b>Teléfono:</b> <?php echo $datos['telefono'] ?>
    <hr>
    <p><b>Mail: </b><?php echo $datos['email'] ?>
    <hr>
    <p><b>Provincia:</b> <?php echo $datos['provincia'] ?>
    <hr>
    <p><b>Ciudad:</b> <?php echo $datos['ciudad'] ?>
    <hr>
    <p><b>Calificaion:</b> <?php if ($datos['calificacion']<0){ echo '0';} else{ echo $datos['calificacion'];}; ?>
    <hr>
    <hr>
    <?php
    $im = file_get_contents(RUTA_APP.'/../public/img/users/'. $datos['imagenurl']);
    $imdata = base64_encode($im);
    echo "<p><img class=\"img-perfil\" src='data:image/jpg;base64,".$imdata."' />";
    ?>
</div>

<?php require RUTA_APP.'/views/includes/footer.php'; ?>








