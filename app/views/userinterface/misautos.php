<?php require RUTA_APP.'/views/includes/header.php'; ?>

<?php require RUTA_APP.'/views/includes/userinterface-menu.php'; ?>
<style>
.fijo {
  position: fixed;
  
}
</style>
<script src="<?php echo RUTA_URL;?>/public/js/main.js"></script>
<div class="mensaje" align="center">
    <p><h3><strong><I><?php if(isset($datos['mensaje'])) {
                    echo $datos['mensaje'];
                } ?></I></strong></h3></p> </div>
<div class="mensaje">
</div>

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
            <a  style="cursor:pointer;"  <?php if ($datos['autos'][$i]->enuso ==0){echo 'href="'.RUTA_URL.'/userinterface/modificarAuto/'.$datos['autos'][$i]->id.'"';}; ?>><img src="<?php echo RUTA_URL;?>/public/img/<?php  if ($datos['autos'][$i]->enuso >0){echo 'icons8-maintenance-gris.png" title="No se puede modificar el auto por encontrarse asociado a uno o mas viajes"  alt="" onclick="Alerta(\'Auto en uso\',\'No se puede modificar el auto por encontrarse asociado a uno o mas viajes\');';}else{echo 'icons8-maintenance.png';}; ?>" alt="" onmouseover="normalImg(this)" onmouseout="smallImg(this)" width="32" height="32"></a>
        </td>
        <td>
        <a style="cursor:pointer;" ><img src="<?php echo RUTA_URL;?>/public/img/<?php  if ($datos['autos'][$i]->enuso >0){echo 'icons8-trash-gris.png" title="No se puede borrar el auto por encontrarse asociado a uno o mas viajes" alt="" onclick="Alerta(\'Auto en uso\',\'No se puede borrar el auto por encontrarse asociado a uno o mas viajes\');';}else{echo 'icons8-trash.png';}; ?>" alt="" onmouseover="normalImg(this)" onmouseout="smallImg(this)" width="32" height="32" <?php  if ($datos['autos'][$i]->enuso ==0){echo 'onclick="borrar('.$datos['autos'][$i]->id.');"';}; ?>></a>
    
        </td>

      </tr>
      <?php } ?>
      
      

    </tbody>
  </table>


</div>


<script>

    function borrar(id) {
        Confirm("Eliminar Auto","¿Desea realmente borrar el auto?", "<?php echo RUTA_URL; ?>/userinterface/eliminarAuto/"+id);
       
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


