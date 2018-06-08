<?php require RUTA_APP.'/views/includes/header.php'; ?>

<?php require RUTA_APP.'/views/includes/userinterface-menu.php'; ?>
<style>
.img-perfil {
    max-width:60px;
    max-height:60px;
}
</style>

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
    <a href="<?php echo RUTA_URL; ?>/userinterface/modificarperfil" type="button" class="btn btn-success">Modificar perfil</a>
    <a href="<?php echo RUTA_URL; ?>/userinterface/actualizarcontrasena" type="button" class="btn btn-success">Modificar contraseña</a>
    
    <hr>
    <?php
    $im = file_get_contents('/public/img/users/'. $datos['imagenurl']);
    $imdata = base64_encode($im);
    echo "<p><img class=\"img-perfil\" src='data:image/jpg;base64,".$imdata."' />";
    /*     <p><img class="img-perfil"src="<?php echo RUTA_URL . '/public/img/users/'. $datos['imagenurl'] ?>">
    */
    ?>

    <form enctype="multipart/form-data" action="<?php echo RUTA_URL; ?>/userinterface/updateimage" method="POST">
<input name="imagen" type="file" size=20/>
<input type="submit" value="Subir archivo" />
    </p>
    
  
</div>

<?php require RUTA_APP.'/views/includes/footer.php'; ?>








