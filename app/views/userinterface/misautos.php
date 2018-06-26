<?php require RUTA_APP.'/views/includes/header.php'; ?>

<?php require RUTA_APP.'/views/includes/userinterface-menu.php'; ?>


<div class="container">
  <h2>Gestion de autos</h2> 
  <a href="<?php echo RUTA_URL; ?>/userinterface/agregarAuto" type="button" class="btn btn-success">Agregar auto</a>
  <?php if($datos['cantAutos'] == 0) { 
    echo ('  <p> Usted no posee autos asociados a su cuenta </p>');
     } ?>
  <table class="table table-dark table-striped">
    <thead>
      <tr>
        <th>Patente</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Cantida de Pasajeros</th>
        <th>Modificar</th>
        <th>Eliminar</th>
      </tr>
    </thead>
    <tbody>
    <?php for ($i = 0; $i < $datos['cantAutos'] ; $i++) { ?>
      <tr>
        <td><?php echo($datos['autos'][$i]->patente) ?></td>
        <td><?php echo($datos['autos'][$i]->marca) ?></td>
        <td><?php echo($datos['autos'][$i]->modelo); ?></td>
        <td><?php echo($datos['autos'][$i]->asientosdisp); ?></td>
        <td> 
            <a href="<?php echo RUTA_URL; ?>/userinterface/modificarAuto/<?php echo($datos['autos'][$i]->id); ?>"><img src="<?php echo RUTA_URL;?>/public/img/icons8-maintenance.png" alt="" ></a>
        </td>
        <td>
        <a href="<?php echo RUTA_URL; ?>/userinterface/eliminarAuto/<?php echo($datos['autos'][$i]->id); ?>"><img src="<?php echo RUTA_URL;?>/public/img/icons8-trash.png" alt="" ></a>
    
        </td>

      </tr>
      <?php } ?>
      
      

    </tbody>
  </table>
</div>



<?php require RUTA_APP.'/views/includes/footer.php'; ?>


