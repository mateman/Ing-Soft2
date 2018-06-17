<?php require RUTA_APP.'/views/includes/header.php'; ?>

<?php require RUTA_APP.'/views/includes/userinterface-menu.php'; ?>

<form action="<?php echo RUTA_URL; ?>/buscador/busqueda">
 <div class="container">
  <div class="form-group">
    <label for="salidadesde">Salida desde:</label>
     <input class="form-control"type="datetime-local" name="salidadesde" placeholder="   dd-mm-aaaa  hh:mm" id="salidadesde" min="<?php echo date('d-m-Y\ H:i'); ?>"  pattern="[0-9]{2}-[0-9]{2}-[0-9]{4} ([0-9]{1}|[0-9]{2}):[0-9]{2}" value="<?php if(isset($datos['fechayhorasalida'])) echo ($datos['fechayhorasalida']); ?>" required />
  </div>
   <div class="form-group">
    <label for="salidahasta">Salida hasta:</label>
    <input class="form-control"type="datetime-local" name="salidahasta" placeholder="   dd-mm-aaaa  hh:mm" id="salidahasta" min="<?php echo date('d-m-Y\ H:i'); ?>"  pattern="[0-9]{2}-[0-9]{2}-[0-9]{4} ([0-9]{1}|[0-9]{2}):[0-9]{2}" value="<?php if(isset($datos['fechayhorasalida'])) echo ($datos['fechayhorasalida']); ?>" required />
  </div>
  <div class="form-group">
    <label for="llegadadesde">Llegada desde:</label>
     <input class="form-control"type="datetime-local" name="llegadadesde" placeholder="   dd-mm-aaaa  hh:mm" id="llegadadesde" min="<?php echo date('d-m-Y\ H:i'); ?>"  pattern="[0-9]{2}-[0-9]{2}-[0-9]{4} ([0-9]{1}|[0-9]{2}):[0-9]{2}" value="<?php if(isset($datos['fechayhorasalida'])) echo ($datos['fechayhorasalida']); ?>" required />
  </div>
   <div class="form-group">Llegada hasta:</label>
    <input class="form-control"type="datetime-local" name="llegadahasta" placeholder="   dd-mm-aaaa  hh:mm" id="llegadahasta" min="<?php echo date('d-m-Y\ H:i'); ?>"  pattern="[0-9]{2}-[0-9]{2}-[0-9]{4} ([0-9]{1}|[0-9]{2}):[0-9]{2}" value="<?php if(isset($datos['fechayhorasalida'])) echo ($datos['fechayhorasalida']); ?>" required />
  </div>
  <div class="form-group">
    <label for="Origen">Origen</label>
    <input type="text" class="form-control" id="origen">
  </div>
   <div class="form-group">
    <label for="Origen">Destino</label>
    <input type="text" class="form-control" id="destino">
  </div>
  <button type="submit" class="btn btn-default">Buscar</button>
</form>
</div>