<?php require RUTA_APP.'/views/includes/header.php'; ?>

<?php require RUTA_APP.'/views/includes/userinterface-menu.php'; ?>


<div class="container">
<br>
<div class="row">
<div class="col"></div>
<div class="col">
<form action="<?php echo RUTA_URL; ?>/userinterface/actualizarauto/<?php echo $datos['id']?>" method="post">
  <div class="form-group">
    <label for="patente">Patente</label>
    <input name="patente" class="form-control" id="patente" value="<?php echo $datos['patente']?>" required />
  </div>
  <div class="form-group">
    <label for="marca">Marca</label>
    <input name="marca" type="text" class="form-control" id="marca" value="<?php echo $datos['marca']?>" required />
  </div>
  <div class="form-group">
    <label for="modelo">Modelo</label>
    <input name="modelo" type="text" class="form-control" id="modelo"value="<?php echo $datos['modelo']?>" required />
  </div>
  <div class="form-group">
    <label for="asientosdisponibles">Asientos disponibles</label>
    <input name="asientosdisp" type="number" min="0" class="form-control" id="asientosdisponibles" value="<?php echo $datos['asientosdisp']?>" required />
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form></div>
<div class="col"></div>
</div>
</div>


<?php require RUTA_APP.'/views/includes/footer.php'; ?>