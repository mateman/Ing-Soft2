<?php require RUTA_APP.'/views/includes/header.php'; ?>

<?php require RUTA_APP.'/views/includes/userinterface-menu.php'; ?>
<style>
.one-line {
  width:10px;
}


</style>
<div class="container">
  <div class="row">
  <div class="col-3">
      <form>
          <div>
          <label><input type="checkbox" id="salida" value="true">Salida</label>
          <p>Entre las fechas:</p>
          <input type="datetime-local" id="salidaresultadodesde" disabled />
          <input type="datetime-local" id="salidaresultadohasta" disabled />
          </div>
         <div>
         <hr>
         <label><input type="checkbox" id="llegada" >Llegada</label>
          <p>Entre las fechas:</p>
          <input type="datetime-local" id="llegadaresultadodesde" disabled>
          <input type="datetime-local" id="llegadaresultadohasta" disabled>
         </div>
         <div>
         <hr>
         <label><input class="one-line" type="checkbox" id="origen" > Origen:&nbsp;</label>
          <input type="text" id="origenresultado" disabled>
         </div>
         <hr>
         <div>
       
         <label><input type="checkbox" id="destino" class="one-line" > Destino:</label>
          <input type="text" id="destinoresultado" disabled>
         </div>
         <hr>
         <div>
         <label><input type="checkbox" id="costo" class="one-line" > Costo:&nbsp;&nbsp;</label>
          <input type="text" id="costoresultado" disabled>
         </div>
         <label ><input type="submit" id="submit-form"value="Buscar"></label>
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

function smallImg(x) {
    x.style.height = "36px";
    x.style.width = "36px";
}

function normalImg(x) {
    x.style.height = "50px";
    x.style.width = "50px";
}






</script> 