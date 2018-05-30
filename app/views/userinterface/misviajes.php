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
</div>
<div class="col"></div>
</div>
</div>
<?php require RUTA_APP.'/views/includes/footer.php'; ?>








