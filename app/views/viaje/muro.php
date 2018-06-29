<?php require RUTA_APP.'/views/includes/header.php'; ?>

<?php require RUTA_APP.'/views/includes/userinterface-menu.php'; ?>
<style>
    .datos{
        max-width: 25%;
    }
</style>
<?php echo ('<a href="'. RUTA_URL.'/userinterface/'.$datos['path'].'"><img src="'.RUTA_URL.'/public/img/icons8-undo-52.png" alt="" ></a>'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Viaje</h1>
            <div class="alert alert-success" role="alert">
                <?php echo $datos['mensaje']; ?>
            </div>
            <br />
            <h4>Desde: <?php echo($datos['viaje']->origen) ?></h4>
            <h4>Hasta: <?php echo($datos['viaje']->destino); ?></h4>
            <hr />
            <br />
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h5>Saliendo: <?php echo(date("d-m-Y H:i", strtotime($datos['viaje']->horasalida))); ?><br></h5>
            <h5>Llegando: <?php echo(date("d-m-Y H:i", strtotime($datos['viaje']->horallegada))); ?></h5>
            <h5>Costo: $ <?php echo($datos['viaje']->costo); ?></h5>
        </div>
        <div class="col">
            <h5>Descripcion: <?php echo($datos['viaje']->descripcion); ?> </h5>
        </div>
    </div>
    <hr />
    <br />
    <div class="row">
        <div class="col">
        <h3>Auto adjudicado a este viaje:</h3>
        <h5>Marca: <?php echo $datos['auto']->marca; ?> </h5>
        <h5>Modelo: <?php echo $datos['auto']->modelo; ?></h5>
        <?php if($datos['rol'] == 'conductor' or $datos['rol'] == 'pasajero'):?>
            <h5>Patente: <?php echo $datos['auto']->patente; ?></h5>
        <?php endif; ?>
      
        <h5>Cantidad de asientos: <?php echo $datos['auto']->asientosdisp; ?> </h5>
   
   
        </div>
        <div class="col">
        <h3>Datos del conductor:</h3>
        

        <?php
            $im = file_get_contents(RUTA_APP.'/../public/img/users/'. $datos['conductor']->imagen_url);
            $imdata = base64_encode($im);
            echo "<p><img class=\"img-perfil\" src='data:image/jpg;base64,".$imdata."' />";
        ?>
        <h5>Nombre de usuario: <?php echo $datos['conductor']->nombreusuario; ?>
        <br>
        <h5>Calificacion: <?php echo $datos['calificacion_conductor']; ?> </h5>
        <br>
        <?php if($datos['rol'] == 'conductor' or $datos['rol'] == 'pasajero'): ?>
            <h5>Nombre: <?php echo $datos['conductor']->nombre; ?> </h5>
            <h5>Apellido: <?php echo $datos['conductor']->apellido; ?></h5>
            <h5>Telefono: <?php echo $datos['conductor']->telefono; ?></h5>
            <h5>Email: <?php echo $datos['conductor']->email; ?> </h5> 
            <br>
        <?php endif;  ?>

        
        
        </div>
        <div class="row">
        <?php if ($datos['rol'] =='publico')
      {
            $class_succes = ' class="btn btn-success"';
            $class_danger = ' class="btn btn-danger"';
            echo "<a id='anotar-". ($datos['viaje']->id) . "' onClick='Anotarse(".($datos['viaje']->id).")'><button".$class_succes.">Anotarse</button></a>";
            echo '<br />';
            echo "<a id='borrar-". ($datos['viaje']->id) . "' onClick='Borrarse(".($datos['viaje']->id).")' style='visibility: hidden'><button".$class_danger.">Darse de Baja</button></a>";
      }
      elseif ($datos['rol'] =='postulado')
      {
          $class_succes = ' class="btn btn-success"';
          $class_danger = ' class="btn btn-danger"';
          echo "<a id='anotar-". ($datos['viaje']->id) . "' onClick='Anotarse(".($datos['viaje']->id).")' style='visibility: hidden'><button".$class_succes.">Anotarse</button></a>";
          echo "<a id='borrar-". ($datos['viaje']->id) . "' onClick='Borrarse(".($datos['viaje']->id).")'><button".$class_danger.">Darse de Baja</button></a>";}
      
          elseif ($datos['estado'] =='3'){
    ?>
        </div>
    </div>
</div>





      <div class="container">
  
  
  
  
  
  <h2>Listado de Postulantes</h2>
        <table class="table table-dark table-striped">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Telefono</th>
        <th>E-Mail</th>
        <th>Calificacion</th>
         <th></th>
         <th></th>
        
        
      </tr>
    </thead>
    <tbody>
    <?php foreach ($datos['postulantes'] as $postulante){ ?>
    <tr>
        <td><?php echo ($postulante->nombre); ?></td>
        <td><?php echo ($postulante->apellido); ?></td>
        <td><?php echo ($postulante->telefono); ?></td>
        <td><?php echo ($postulante->email); ?></td>
        <td><?php echo ($postulante->calificacion_pasajero); ?></td> 
          <td> 
            <a href="<?php echo RUTA_URL; ?>/viaje/cancelarPostulante/<?php echo($postulante->usuario_id); ?>/<?php echo($postulante->viaje_id); ?>"><img src="<?php echo RUTA_URL;?>/public/img/icons8-delete.png" alt="" onmouseover="normalImg(this)" onmouseout="smallImg(this)" width="32" height="32"></a>
        </td>
        <td>
            <a href="<?php echo RUTA_URL; ?>/viaje/aceptarPostulante/<?php echo($postulante->usuario_id); ?>/<?php echo($postulante->viaje_id); ?>"><img src="<?php echo RUTA_URL;?>/public/img/icons8-checkmark.png" alt="" onmouseover="normalImg(this)" onmouseout="smallImg(this)" width="32" height="32"></a>
        </td>
        <td>
            <a href="<?php echo RUTA_URL; ?>/userinterface/infoPostulante/<?php echo($postulante->usuario_id); ?>/<?php echo($datos['viaje']->id); ?>"> <img src="<?php echo RUTA_URL;?>/public/img/icons8-customer.png" alt="" onmouseover="normalImg(this)" onmouseout="smallImg(this)" width="32" height="32"></a>
        </td>

    </tr>
              
        <?php } ?> </tbody>
       
          
             </table>
             </div>
 <div class="container">
  <h2>Listado de Pasajeros Aceptados</h2>
        <table class="table table-dark table-striped">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Telefono</th>
        <th>E-Mail</th>
        <th>Calificacion</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($datos['pasajerosAprobados'] as $aceptados){ ?>
    <tr>
        <td><?php echo ($aceptados->nombre); ?></td>
        <td><?php echo ($aceptados->apellido); ?></td>
        <td><?php echo ($aceptados->telefono); ?></td>
        <td><?php echo ($aceptados->email); ?></td>
        <td><?php echo ($aceptados->calificacion_pasajero); ?></td>
        <td>
            <a href="<?php echo RUTA_URL; ?>/userinterface/infoPostulado/<?php echo($aceptados->usuario_id); ?>/<?php echo($datos['viaje']->id); ?>"><img src="<?php echo RUTA_URL;?>/public/img/icons8-customer.png" alt="" onmouseover="normalImg(this)" onmouseout="smallImg(this)" width="32" height="32"></a>
        </td>
    </tr>
              
        <?php } ?> </tbody>
       
          
             </table>
             </div>

             <?php }?>
        
      

<br>









<script>


    function smallImg(x) {
        x.style.height = "32px";
        x.style.width = "32px";
    }

    function normalImg(x) {
        x.style.height = "50px";
        x.style.width = "50px";
    }


    var lista = nuevoAjax();

    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    function nuevoAjax(){
        var xmlhttp=false;
        try{
            xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
        }catch(e){
            try{
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }catch(E){
                if (!xmlhttp && typeof XMLHttpRequest!='undefined') xmlhttp=new XMLHttpRequest();
            };
        };
        return xmlhttp;
    };


    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    function Anotarse(idviaje) {
        lista.open("POST", "<?php echo RUTA_URL; ?>/userinterface/anotarse/", true);
        lista.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        lista.send("anotarse= " + idviaje);
        lista.onreadystatechange = function () {
            if (lista.readyState == 4) {
                if (lista.responseText == "Rechazado"){alert("Se rechazo la postulacion");}
                else {document.getElementById('anotar-' + idviaje).style.visibility= 'hidden';
                      document.getElementById('borrar-' + idviaje).style.visibility= 'visible';};
            };
        };
    };
    //------------------------------------------------------------------------------------------------------------------------------
    function Borrarse(idviaje) {
        lista.open("POST", "<?php echo RUTA_URL; ?>/userinterface/eliminarPasajero/", true);
        lista.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        lista.send("eliminarse= " + idviaje);
        lista.onreadystatechange = function () {
            if (lista.readyState == 4) {
                if (lista.responseText == "Rechazado"){alert("Se rechazo la eliminacion");}
                else{document.getElementById('borrar-' + idviaje).style.visibility= 'hidden';
                     document.getElementById('anotar-' + idviaje).style.visibility= 'visible';};
            };
        };
    };
    //------------------------------------------------------------------------------------------------------------------------------

</script>



<?php require RUTA_APP.'/views/includes/footer.php'; ?>
