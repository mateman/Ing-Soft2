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
          <input type="datetime-local" id="salidaresultadodesde" disabled required="" />
          <input type="datetime-local" id="salidaresultadohasta" disabled required="" />
          </div>
         <div>
         <hr>
         <label><input type="checkbox" id="llegada" >Llegada</label>
          <p>Entre las fechas:</p>
          <input type="datetime-local" id="llegadaresultadodesde" disabled required="">
          <input type="datetime-local" id="llegadaresultadohasta" disabled required="">
         </div>
         <div>
         <hr>
         <label><input class="one-line" type="checkbox" id="origen" > Origen:&nbsp;</label>
          <input type="text" id="origenresultado" disabled required="">
         </div>
         <hr>
         <div>
       
         <label><input type="checkbox" id="destino" class="one-line" > Destino:</label>
          <input type="text" id="destinoresultado" disabled required="">
         </div>
         <hr>
         <div>
         <label><input type="checkbox" id="costo" class="one-line" > Costo:&nbsp;&nbsp;</label>
           <select id="costoresultado">
    <option value="1">Hasta $100</option>
    <option value="2">Entre $101 y $500</option>
    <option value="3">Entre $501 y $1000</option>
    <option value="4">Más de $1000</option>
  </select>
         </div>
         <label ><input type="submit" id="submit-form" value="Buscar"></label>
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
    if( $('#costo').prop('checked') ) {
    v['costo'] = $('#costoresultado').val()
  }
  $.ajax({
    data:  {v}, 
    url:   "<?php echo RUTA_URL; ?>/buscadorAjax/ajax",
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