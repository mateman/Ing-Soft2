<?php require RUTA_APP.'/views/includes/header.php'; ?>

<?php require RUTA_APP.'/views/includes/userinterface-menu.php'; ?>

  

<div class="container">
  <div class="row">
  <form action="<?php echo RUTA_URL; ?>/buscador/busqueda">
  <div class="container">
  <div class="form-group">
  <label for="salidadesde">Busqueda</label>
  <input id="campo" name="campo">
<button type="submit" class="btn btn-default">Buscar</button>

</form>

 <div id="resultado"></div>
  </div>
</div>



<?php require RUTA_APP.'/views/includes/footer.php'; ?>





<script>

 $(buscar_datos());
 function buscar_datos(consulta) {
  $.ajax({
    data:  {consulta : consulta}, 
    url:   "<?php echo RUTA_URL; ?>/buscadorajax/ajax", 
    type:  'POST', 
    dataType:'html',
    success:  function (response) {
                $("#resultado").html(response);
              }
    });

}
$(document).on('keyup', '#campo', function() {
  var valor = $(this).val();
  if(valor != "") {
    var v = {empty: valor}
    buscar_datos(v);
  }else {
    buscar_datos();
  }
})

</script>