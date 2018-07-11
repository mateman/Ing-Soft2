<head>
<meta charset="utf-8">

    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>/css/consultas.css">
  <!--  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script> -->
    <script src="<?php echo RUTA_URL;?>/ckeditor/ckeditor.js"></script>
<script src="<?php echo RUTA_URL;?>/public/js/main.js"></script>

    <script>

        window.onload = function()
        {
            CKEDITOR.replace('editor');
            CKEDITOR.add;
            CKEDITOR.replace('preguntas');
        }

         function smallImg(x) {
            x.style.height = "32px";
            x.style.width = "32px";
        }

        function normalImg(x) {
            x.style.height = "50px";
            x.style.width = "50px";
        }

        function seleccionado() {

                if (document.getElementById('calificacionP').checked) {
                    return document.getElementById('calificacionP').value;
                }
                else if(document.getElementById('calificacionN').checked) {
                    return document.getElementById('calificacionN').value;
                } else if (document.getElementById('calificacion0').checked) {
                    return document.getElementById('calificacion0').value;
                } else {return null;
                }
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
            lista.send("anotarse=" + idviaje);
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
            lista.send("eliminarse=" + idviaje);
            lista.onreadystatechange = function () {
                if (lista.readyState == 4) {
                    if (lista.responseText == "Rechazado"){alert("Se rechazo la eliminacion");}
                    else{document.getElementById('borrar-' + idviaje).style.visibility= 'hidden';
                        document.getElementById('anotar-' + idviaje).style.visibility= 'visible';};
                };
            };
        };
        //------------------------------------------------------------------------------------------------------------------------------BORRAR PREGUNTA SI SOS CONDUCTOR. -CLAUDIO
        <?php if ($datos['rol'] =='conductor' AND $datos['estado']=='pre') : ?>
            function BorrarPregunta(idPregunta) {
            lista.open("POST", "<?php echo RUTA_URL; ?>/viaje/eliminarPregunta/", true);
            lista.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            lista.send("idPregunta=" + idPregunta);
            lista.onreadystatechange = function () {
                if (lista.readyState == 4) {
                    if (lista.responseText == "Rechazado"){alert("Se rechazo la eliminacion");}
                    else{location.reload();};
                };
            };
        };

        <?php endif; ?>
        //------------------------------------------------------------------------------------------------------------------------------HACER PREGUNTA PARA PASAJERO Y PUBLICO GRAL -CLAUDIO
    
            function HacerPregunta(idUsuario, idViaje, pregunta) {
            lista.open("POST", "<?php echo RUTA_URL; ?>/viaje/preguntar/", true);
            lista.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            lista.send("idUsuario=" + idUsuario + "&idViaje=" + idViaje + "&pregunta=" + encodeURIComponent(pregunta));
            lista.onreadystatechange = function () {
                if (lista.readyState == 4) {
                    if (lista.responseText == "Rechazado"){alert("Por favor introduzca una pregrunta");}
                    else{location.reload();};
                };
            };
        };

      
        //------------------------------------------------------------------------------------------------------------------------------RESPONDER PREGUNTAS -CLAUDIO
             <?php if ($datos['rol'] =='conductor' ) : ?>
            function ResponderPregunta(idPregunta, respuesta) {
            lista.open("POST", "<?php echo RUTA_URL; ?>/viaje/responderPregunta/", true);
            lista.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            lista.send("idPregunta=" + idPregunta + "&respuesta=" + encodeURIComponent(respuesta));
            lista.onreadystatechange = function () {
                if (lista.readyState == 4) {
                    if (lista.responseText == "Rechazado"){alert("Por favor escriba una respuesta a la pregunta");}
                    else{location.reload();};
                };
            };
        };

        <?php endif; ?>
        //------------------------------------------------------------------------------------------------------------------------------

        <?php if ($datos['rol'] =='aceptado' AND $datos['estado']=='pos') : ?>
        function calificar(punto, editor) {
            lista.open("POST", "<?php echo RUTA_URL; ?>/viaje/calificar/", true);
            lista.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            lista.send("viaje=" +<?php echo $datos['viaje']->id ?>+"&usuario="+<?php echo $datos['conductor']->id ?>+"&punto="+punto+"&editor="+encodeURIComponent(editor));
            lista.onreadystatechange = function () {
                if (lista.readyState == 4) {
                    if (lista.responseText == "Rechazado"){alert("Se rechazo la calificacion");}
                    else{location.reload();};
                };
            };
        };
        //------------------------------------------------------------------------------------------------------------------------------
        <?php endif; ?>

        <?php if ($datos['rol'] =='conductor' AND $datos['estado']=='pos') : ?>

        var pasajeroid = null;

        function calificar(punto, editor) {
            lista.open("POST", "<?php echo RUTA_URL; ?>/viaje/calificar/", true);
            lista.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            lista.send("viaje="+<?php echo $datos['viaje']->id ?>+"&usuario="+pasajeroid+"&punto="+punto+"&editor="+encodeURIComponent(editor));
            lista.onreadystatechange = function () {
                if (lista.readyState == 4) {
                    if (lista.responseText == "Rechazado"){alert("Se rechazo la calificacion");}
                    else{location.reload();};
                };
            };
        };
        <?php endif; ?>

        //------------------------------------------------------------------------------------------------------------------------------HACER PREGUNTA PARA PASAJERO Y PUBLICO GRAL -CLAUDIO
        <?php if ($datos['rol'] =='conductor') : ?>
        function getInfo (ruta) {
            lista.open("POST", ruta, true);
            lista.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            lista.send();
            lista.onreadystatechange = function () {
                if (lista.readyState == 4) {
                    if (lista.responseText == "Rechazado"){alert("Por favor introduzca una pregrunta");}
                    else{document.getElementById('divINFO').innerHTML = lista.responseText;};
                };
            };
        };

        //------------------------------------------------------------------------------------------------------------------------------
        <?php endif; ?>

 </script>

</head>
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
        <?php if ($datos['estado']=='pos' AND $datos['rol']=='aceptado' AND $datos['viaje']->estado=='1' AND $datos['viaje']->flagcalificacion_conductor=='0') { ?>
            <div class="col">
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#miModal" id="bt-calificar" name="bt-calificar">
            Calificar
            </button>
            </div>
        <?php } ?>
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
        <?php if($datos['rol'] == 'conductor' or $datos['rol'] == 'aceptado'):?>
            <h5>Patente: <?php echo $datos['auto']->patente; ?></h5>
        <?php endif; ?>
      
        <h5>Cantidad de asientos: <?php echo $datos['auto']->asientosdisp; ?> </h5>
        <h5>Asientos disponibles: <?php echo ($datos['auto']->asientosdisp - $datos['pasajerosCantAprobados']); ?> </h5>

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
        <h5>Calificacion: <?php if ($datos['calificacion_conductor']<0) {echo '0';} else { echo $datos['calificacion_conductor'];}; ?> </h5>
        <br>
        <?php if($datos['rol'] == 'conductor' or $datos['rol'] == 'aceptado'): ?>
            <h5>Nombre: <?php echo $datos['conductor']->nombre; ?> </h5>
            <h5>Apellido: <?php echo $datos['conductor']->apellido; ?></h5>
            <h5>Telefono: <?php echo $datos['conductor']->telefono; ?></h5>
            <h5>Email: <?php echo $datos['conductor']->email; ?> </h5> 
            <br>
        <?php endif;  ?>

        
        
        </div>
        <div class="row">
        <?php if ($datos['rol'] =='publico' AND $datos['estado']=='pre' AND ($datos['auto']->asientosdisp - $datos['pasajerosCantAprobados']))
      {
            $class_succes = ' class="btn btn-success"';
            $class_danger = ' class="btn btn-danger"';
            echo "<a id='anotar-". ($datos['viaje']->id) . "' onClick='Anotarse(".($datos['viaje']->id).")'><button".$class_succes.">Anotarse</button></a>";
            echo '<br />';
            echo "<a id='borrar-". ($datos['viaje']->id) . "' onClick='Borrarse(".($datos['viaje']->id).")' style='visibility: hidden'><button".$class_danger.">Darse de Baja</button></a>";
      }
      elseif ($datos['rol'] =='postulado' AND $datos['estado']=='pre' AND ($datos['auto']->asientosdisp - $datos['pasajerosCantAprobados']))
      {
          $class_succes = ' class="btn btn-success"';
          $class_danger = ' class="btn btn-danger"';
          echo "<a id='anotar-". ($datos['viaje']->id) . "' onClick='Anotarse(".($datos['viaje']->id).")' style='visibility: hidden'><button".$class_succes.">Anotarse</button></a>";
          echo '<br />';
          echo "<a id='borrar-". ($datos['viaje']->id) . "' onClick='Borrarse(".($datos['viaje']->id).")'><button".$class_danger.">Darse de Baja</button></a>";}
      
          elseif ($datos['rol'] =='conductor'){
    ?>
        </div>
    </div>
</div>





      <div class="container">

   <?php if ($datos['estado']=='pre') { ?>
  
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
            <button type="button"  class="btn btn-primary btn-lg" data-toggle="modal" data-target="#infoModal" id="bt-info<?php echo ($postulante->usuario_id); ?>" name="bt-info<?php echo ($postulante->usuario_id); ?>" onclick="getInfo('<?php echo RUTA_URL; ?>/userinterface/infoPostulante/<?php echo($postulante->usuario_id); ?>');">
                <img src="<?php echo RUTA_URL;?>/public/img/icons8-customer.png" alt="" onmouseover="normalImg(this)" onmouseout="smallImg(this)" width="32" height="32"></button>
            </td>
    </tr>
              
        <?php } ?> </tbody>
       
          
             </table>
             </div>
  <?php } ?>
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
        <?php if ($datos['estado']=='pre' OR $datos['estado']=='en') { ?>
        <td><?php echo ($aceptados->calificacion_pasajero); ?></td>
        <?php } elseif ($datos['estado']=='pos' AND $aceptados->flagcalificacion_pasajero=='0') { ?>
        <td><button type="button"  class="btn btn-primary btn-lg" data-toggle="modal" data-target="#miModal" id="bt-calificar" name="bt-calificar" onclick="pasajeroid=<?php echo ($aceptados->id); ?>">Calificar</button>
        </td>
        <?php } else {echo '<td>'.$aceptados->calificacion_pasajero.' '.$aceptados->comentario_pasajero.'</td>';}; ?>
        <td>
            <button type="button"  class="btn btn-primary btn-lg" data-toggle="modal" data-target="#infoModal" id="bt-info<?php echo ($aceptados->id); ?>" name="bt-info<?php echo ($aceptados->id); ?>" onclick="getInfo('<?php echo RUTA_URL; ?>/userinterface/infoPostulado/<?php echo($aceptados->usuario_id); ?>');">
                <img src="<?php echo RUTA_URL;?>/public/img/icons8-customer.png" alt="" onmouseover="normalImg(this)" onmouseout="smallImg(this)" width="32" height="32"></button>
        </td>
    </tr>
              
        <?php } ?> </tbody>
       
          
             </table>
             </div>

             <?php }?>



<br>

<div>
<section>
<div class="titulo">Preguntas y Respuestas </div>
<?php foreach($datos['consultasAprobadas'] as $consultasAprobadas){ ?>
<input class="animate" type="radio" name="question" id=%22<?php echo $consultasAprobadas->id; ?>%22>
<label class="animate" for=%22<?php echo $consultasAprobadas->id; ?>%22><?php echo $consultasAprobadas->pregunta; ?></label>
<p class="response animate"><?php echo $consultasAprobadas->respuesta; ?></p>
<?php } ?>

<?php if (($datos['rol'] =='publico' OR $datos['rol'] =='postulado' OR $datos['rol'] =='aceptado') AND $datos['estado']=='pre') : ?>
    <textarea style="resize:none;width:100%;float:center;"  name="preguntas">Haga su pregunta</textarea>
    <a style="align-content: center;" id='bt-pregunta' onClick='HacerPregunta(<?php echo $datos['usuario'].','.$datos['viaje']->id?>,CKEDITOR.instances.preguntas.getData())'><button style="margin-top: 15px; " class="btn btn-primary btn-lg">Preguntar</button></a><!-- BOTON PREGUNTAR - CLAUDIO -->
<?php endif; ?>

</section>

<?php if (($datos['rol'] =='conductor' AND $datos['estado']=='pre')){ ?>

<section>
<div class="titulo">Preguntas pendientes </div>
<?php foreach($datos['consultasPendientes'] as $consultasPendientes){ ?>
<input class="animate" type="radio" name="question" id=%22<?php echo $consultasPendientes->id; ?>%22>
<label class="animate" for=%22<?php echo $consultasPendientes->id; ?>%22><?php echo $consultasPendientes->pregunta; ?></label>
    <button type="button"  class="btn btn-primary btn-lg" data-toggle="modal" data-target="#respuestaModal" id="bt-respuesta<?php echo $consultasPendientes->id; ?>" name="bt-calificar<?php echo $consultasPendientes->id; ?>" onclick="respondido=<?php echo $consultasPendientes->id; ?>">Responder</button><a onClick='BorrarPregunta(<?php echo $consultasPendientes->id?>)'><button class="btn btn-primary btn-lg">Eliminar</button></a></p><!-- BOTONES RESPONDER Y ELIMINAR - CLAUDIO -->
<?php }} ?>
</div>
</section>



<div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body">
                <h5><I><strong>Calificacion: </strong><input type="radio" id="calificacionN" name="calificacion" value="-1">Negativo<input type="radio" id="calificacion0" name="calificacion" value="0">Neutro<input type="radio" id="calificacionP" name="calificacion" value="1">Positivo</I></h5>
                <textarea name="editor">Coloque el comentario del viaje</textarea>
                <a id='bt-calificacion' onClick='valor=seleccionado();calificar(valor,CKEDITOR.instances.editor.getData())'><button class="btn btn-primary btn-lg" class="close" data-dismiss="modal" aria-label="Close">Anotarse</button></a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" data-refresh="true" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:51%;">
        <div class="modal-content" id="divINFO">
        </div>

    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="respuestaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body">
                <p class="response animate"><textarea maxlength="300"  style="resize:none;width:70%;float:left;margin-right:20px;" name="preguntas">Escriba la respuesta...</textarea>
                    <a id='bt-pregunta' onClick='ResponderPregunta(respondido,CKEDITOR.instances.preguntas.getData())'><button style="margin-right: 20px;" class="btn btn-primary btn-lg">Responder</button></a>
            </div>
        </div>
    </div>
</div>


<?php require RUTA_APP.'/views/includes/footer.php'; ?>
