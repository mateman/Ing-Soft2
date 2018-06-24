<?php require RUTA_APP.'/views/includes/header.php'; ?>

<?php require RUTA_APP.'/views/includes/userinterface-menu.php'; ?>

<div class="container">
  <div class="row">
  <div class="col-3">
      <form>
          <div>
          <label><input type="checkbox" id="salida" value="true">Salida</label>
          <input type="datetime-local" id="salidaresultadodesde" disabled />
          Entre:<input type="datetime-local" id="salidaresultadohasta" disabled />
          </div>
         <div>
         <label><input type="checkbox" id="llegada" >Llegada</label>
          <input type="datetime-local" id="llegadaresultadodesde" disabled>
          Entre: <input type="datetime-local" id="llegadaresultadohasta" disabled>
         </div>
         <div>
         <label><input type="checkbox" id="origen" >Origen</label>
          <input type="text" id="origenresultado" disabled>
         </div>
         <div>
         <label><input type="checkbox" id="destino" >Destino</label>
          <input type="text" id="destinoresultado" disabled>
         </div>
         <div>
         <label><input type="checkbox" id="costo" >Costo</label>
          <input type="text" id="costoresultado" disabled>
         </div>
         <label ><input type="submit" id="submit-form"></label>
        </form>
      </div>
      <div class="col-9">
      <div id="resultado"></div>
      </div>
    </div>
    </div>





<?php require RUTA_APP.'/views/includes/footer.php'; ?>





<script>

$('form').on('click','input', function(){
  var r = $(this).prop('checked');
  $(this).parent().siblings().prop('disabled', !r)

})



$('form').on('submit' , function(e) {
  e.preventDefault();
  var v = {}
  if ( $('#salida').prop('checked')) {
    v['salidaresultadodesde'] = $('#salidaresultadodesde').val()
    v['salidaresultadohasta'] = $('#salidaresultadohasta').val()
  }
  if( $('#llegada').prop('checked') ) {
    v['llegadaresultadodesde'] = $('#llegadaresultadodesde').val()
    v['llegadaresultadohasta'] = $('#llegadaresultadohasta').val()

  }
  if( $('#origen').prop('checked') ) {
    v['origen'] = $('#origenresultado').val()

  }
  if( $('#destino').prop('checked') ) {
    v['destino'] = $('#destinoresultado').val()
  }
  if( $('#campo') != null ) {
    v['campo'] = $('#campo').val()
  }
  $.ajax({
    data:  {v}, 
    url:   "<?php echo RUTA_URL; ?>/buscadorajax/ajax", 
    type:  'POST', 
    dataType:'html',
    success:  function (response) {
               $("#resultado").html(response);
               //alert(response)
              }
    });
  
})
  
  
  
  
  
  

</script> 