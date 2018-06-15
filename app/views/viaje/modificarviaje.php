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
      <div class="col"> <form action="<?php echo RUTA_URL; ?>/viaje/viajeModificar/<?php echo $datos['id']?>" method="post" >
    <div class="form-group">
      <label for="origen">Ingrese ciudad de origen:</label>
      <input type="text"id="origen" class="form-control"  name="origen" value="<?php if(isset($datos['origen'])) echo ($datos['origen']); ?>">
    </div>



    <div class="form-group">
      <label for="destino">Ingrese ciudad de destino:</label>
      <input type="text" class="form-control" id="destino"  name="destino" value="<?php if(isset($datos['destino'])) echo ($datos['destino']); ?>">
    </div>


    <div class="form-group">
      <label for="fechayhorasalida">Fecha y hora de salida:</label>
      <input class="form-control"type="datetime-local" name="fechayhorasalida" placeholder="   dd/mm/aaaa  hh:mm" id="fechayhorasalida" min="<?php echo date('d-m-Y\ H:i'); ?>" max="30-06-2019 16:30"  pattern="[0-9]{2}(-|/)[0-9]{2}(-|/)[0-9]{4} ([0-9]{1}|[0-9]{2}):[0-9]{2}" value="<?php if(isset($datos['fechayhorasalida'])) echo ($datos['fechayhorasalida']); ?>" required /> 
    </div>



    <div class="form-group">
      <label for="fechayhorallegada">Fecha y hora de llegada:</label>
      <input class="form-control" type="datetime-local" name="fechayhorallegada" placeholder="   dd/mm/aaaa  hh:mm" id="fechayhorallegada" min="<?php echo date('d-m-Y\ H:i'); ?>" max="30-06-2019 16:30"  pattern="[0-9]{2}(-|/)[0-9]{2}(-|/)[0-9]{4} ([0-9]{1}|[0-9]{2}):[0-9]{2}" value="<?php if(isset($datos['fechayhorallegada'])) echo ($datos['fechayhorallegada']); ?>" required>
    </div>



    <div class="form-group">
      <label for="costo">Costo</label>
      <input class="form-control" type="number" name="costo" placeholder="   en $" id="costo" value="<?php if(isset($datos['costo'])) echo ($datos['costo']); ?>">
    </div>

    <div class="form-group">
      <label for="descripcion">descripcion:</label>
      <input class="form-control" type="text" name="descripcion"  id="descripcion" value="<?php if(isset($datos['descripcion'])) echo ($datos['descripcion']); ?>">
    </div>


    <div class="form-group">
    <label for="autodelviaje">Tipo de auto:</label>
      <select id= 'autodelviaje' name="autodelviaje">
            
            <?php for ($i = 0; $i < $datos['cantAutos'] ; $i++) { ?>
                <option value="<?php echo($datos['autos'][$i]->id) ?>"><?php echo($datos['autos'][$i]->patente) ?></option>
        
           <?php } ?>
       </select>

    </div>
    <button type="submit" class="btn btn-primary">Actualizar</button>
  </form></div>
      <div class="col"></div>
     


<?php require RUTA_APP.'/views/includes/footer.php'; ?>

