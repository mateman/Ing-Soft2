<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Un Aventon</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>/public/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>/css/style.css">
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

        //------------------------------------------------------------------------------------------------------------------------------
        function getComentarios (ruta) {
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
 <style>
     .datos{
         max-width: 25%;
     }
 </style>


</head>

<?php require RUTA_APP.'/views/includes/userinterface-menu.php'; ?>

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
            <h5>Saliendo: <?php echo(date("d-m-Y H:i", strtotime($datos['viaje']->horasalida))); ?>hs<br></h5>
            <h5>Llegando: <?php echo(date("d-m-Y H:i", strtotime($datos['viaje']->horallegada))); ?>hs</h5>
            <h5>Costo Total: $ <?php echo($datos['viaje']->costo); ?></h5>
            <h5>Costo por pasajero: $ <?php echo(($datos['viaje']->costo)/($datos['auto']->asientosdisp)); ?></h5>
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
        <h5>Asientos disponibles: <?php echo ($datos['auto']->asientosdisp - $datos['pasajerosCantAprobados'] - 1); ?> </h5>

        </div>
        <div class="col">
        <h3>Datos del conductor:</h3>
        

        <?php
            $im = file_get_contents(RUTA_APP.'/../public/img/users/'. $datos['conductor']->imagen_url);
            $imdata = base64_encode($im);
            echo "<p><img class=\"img-perfil\" src='data:image/jpg;base64,".$imdata."' width=\"182\" height=\"182\"/>";
        ?>
        <h5>Nombre de usuario: <?php echo $datos['conductor']->nombreusuario; ?>
        <br>
        <h5>Calificacion: <?php if ($datos['calificacion_conductor']<0) {echo '0';} else { echo $datos['calificacion_conductor'];}; ?> </h5>
            <button type="button" title="Comentarios de pasajeros" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#infoModal" id="bt-ant<?php echo ($datos['conductor']->id); ?>" name="bt-ant<?php echo ($datos['conductor']->id); ?>" onclick="getComentarios('<?php echo RUTA_URL; ?>/userinterface/antecedentesConductor/<?php echo($datos['conductor']->id); ?>');">
                <img src="<?php echo RUTA_URL;?>/public/img/icons8-document.png" alt="" onmouseover="normalImg(this)" onmouseout="smallImg(this)" width="32" height="32"></button>
            <br>
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
        <?php if ($datos['rol'] =='publico' AND $datos['estado']=='pre' AND ($datos['auto']->asientosdisp - $datos['pasajerosCantAprobados'] - 1))
      {
            $class_succes = '';
            $class_danger = '';
            echo "<a id='anotar-". ($datos['viaje']->id) . "'><button  class='btn btn-success' data-toggle='modal' data-target='#tarjetaCobro'>Anotarse</button></a>";
            echo '<br />';
            echo "<a id='borrar-". ($datos['viaje']->id) . "' onClick='Borrarse(".($datos['viaje']->id).")' style='visibility: hidden'><button class='btn btn-danger'>Darse de Baja</button></a>";
      }
      elseif ($datos['rol'] =='postulado' AND $datos['estado']=='pre' AND ($datos['auto']->asientosdisp - $datos['pasajerosCantAprobados'] - 1))
      {
          echo "<a id='anotar-". ($datos['viaje']->id) . "' style='visibility: hidden'><button  class='btn btn-success' data-toggle='modal' data-target='#tarjeta'>Anotarse</button></a>";
          echo '<br />';
          echo "<a id='borrar-". ($datos['viaje']->id) . "' onClick='Borrarse(".($datos['viaje']->id).")'><button class='btn btn-danger'>Darse de Baja</button></a>";}
      
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
        <th>Calificacion total</th>
        <th>Rechazar</th>
        <th>Aceptar</th>
        <th>Info</th>
        <th>Comentarios</th>
        
        
      </tr>
    </thead>
    <tbody>
    <?php foreach ($datos['postulantes'] as $postulante){ ?>
    <tr>
        <td><?php echo ($postulante->nombre); ?></td>
        <td><?php echo ($postulante->apellido); ?></td>
        <td><?php echo ($postulante->calificacion_pasajero); ?></td>
          <td>
            <a href="<?php echo RUTA_URL; ?>/viaje/cancelarPostulante/<?php echo($postulante->usuario_id); ?>/<?php echo($postulante->viaje_id); ?>"><img src="<?php echo RUTA_URL;?>/public/img/icons8-delete.png" title="Rechazar" alt="" onmouseover="normalImg(this)" onmouseout="smallImg(this)" width="32" height="32"></a>
        </td>
        <td>
            <a href="#" data-toggle='modal' data-target='#tarjetaPago'>
                <img src="<?php echo RUTA_URL;?>/public/img/icons8-checkmark.png" title="Aceptar" alt="" onmouseover="normalImg(this)" onmouseout="smallImg(this)" width="32" height="32"></a>
        </td>
        <td>
            <a href="#" data-toggle="modal" data-target="#infoModal" id="bt-info<?php echo ($postulante->usuario_id); ?>" name="bt-info<?php echo ($postulante->usuario_id); ?>" onclick="getInfo('<?php echo RUTA_URL; ?>/userinterface/infoPostulante/<?php echo($postulante->usuario_id); ?>');">
                <img src="<?php echo RUTA_URL;?>/public/img/icons8-customer.png" title="Informacion" alt="" onmouseover="normalImg(this)" onmouseout="smallImg(this)" width="32" height="32"></a>
        </td>
        <td>
            <a href="#" data-toggle="modal" data-target="#infoModal" id="bt-ant<?php echo ($postulante->usuario_id); ?>" name="bt-ant<?php echo ($postulante->usuario_id); ?>" onclick="getComentarios('<?php echo RUTA_URL; ?>/userinterface/antecedentesPasajero/<?php echo($postulante->usuario_id); ?>');">
                <img src="<?php echo RUTA_URL;?>/public/img/icons8-document.png" title="Comentarios" alt="" onmouseover="normalImg(this)" onmouseout="smallImg(this)" width="32" height="32"></a>
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
        <th>Info</th>
        <th>Comentarios</th>

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
        <td><a href="#" data-toggle="modal" data-target="#miModal" id="bt-calificar" name="bt-calificar" onclick="pasajeroid=<?php echo ($aceptados->id); ?>"><img src="<?php echo RUTA_URL;?>/public/img/icons8-edit-property.png" title="Calificar" alt="" onmouseover="normalImg(this)" onmouseout="smallImg(this)" width="32" height="32"></a>
        </td>
        <?php } else {echo '<td>'.$aceptados->calificacion_pasajero.' '.$aceptados->comentario_pasajero.'</td>';}; ?>
        <td>
            <a href="#" data-toggle="modal" data-target="#infoModal" id="bt-info<?php echo ($aceptados->id); ?>" name="bt-info<?php echo ($aceptados->id); ?>" onclick="getInfo('<?php echo RUTA_URL; ?>/userinterface/infoPostulado/<?php echo($aceptados->usuario_id); ?>');" >
                <img src="<?php echo RUTA_URL;?>/public/img/icons8-customer.png" title="Informacion" alt="" onmouseover="normalImg(this)" onmouseout="smallImg(this)" width="32" height="32"></a>
        </td>
        <td>
            <a href="#" data-toggle="modal" data-target="#infoModal" id="bt-ant<?php echo ($aceptados->id); ?>" name="bt-ant<?php echo ($aceptados->id); ?>" onclick="getComentarios('<?php echo RUTA_URL; ?>/userinterface/antecedentesPasajero/<?php echo($aceptados->id); ?>');">
                <img src="<?php echo RUTA_URL;?>/public/img/icons8-document.png" title="Comentarios" alt="" onmouseover="normalImg(this)" onmouseout="smallImg(this)" width="32" height="32"></a>
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
<label class="animate" for=%22<?php echo $consultasAprobadas->id; ?>%22><?php echo '<small><small><b>'.$consultasAprobadas->nombreusuario.'</b></small></small><br><br>'.$consultasAprobadas->pregunta; ?></label>
<p class="response animate"><?php echo $consultasAprobadas->respuesta; ?></p><br>
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
<label class="animate" for=%22<?php echo $consultasPendientes->id; ?>%22><?php echo '<small><small><b>'.$consultasPendientes->nombreusuario.'</b></small></small><br><br>'.$consultasPendientes->pregunta; ?> </label>
<p class="response animate"><button type="button"  class="btn btn-primary btn-lg" data-toggle="modal" data-target="#respuestaModal" id="bt-respuesta<?php echo $consultasPendientes->id; ?>" name="bt-calificar<?php echo $consultasPendientes->id; ?>" onclick="respondido=<?php echo $consultasPendientes->id; ?>">Responder</button><a onClick='BorrarPregunta(<?php echo $consultasPendientes->id?>)'><button class="btn btn-primary btn-lg">Eliminar</button></a><a href="#" data-toggle="modal" data-target="#infoModal" id="bt-info<?php echo ($consultasPendientes->id_usuario); ?>" name="bt-info<?php echo ($consultasPendientes->id_usuario); ?>" onclick="getInfo('<?php echo RUTA_URL; ?>/userinterface/infoPostulante/<?php echo($consultasPendientes->id_usuario); ?>');">
                <img src="<?php echo RUTA_URL;?>/public/img/icons8-customer.png" title="Informacion usuario" alt="" onmouseover="normalImg(this)" onmouseout="smallImg(this)" width="32" height="32"></a></p><!-- BOTONES RESPONDER Y ELIMINAR - CLAUDIO -->
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
                <a id='bt-calificacion' onClick='valor=seleccionado();calificar(valor,CKEDITOR.instances.editor.getData())'><button class="btn btn-primary btn-lg" class="close" data-dismiss="modal" aria-label="Close">Calificar</button></a>
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
                <textarea style="resize:none;width:100%;float:center;"  name="preguntas">Escriba la respuesta...</textarea>
                    <a id='bt-pregunta' onClick='ResponderPregunta(respondido,CKEDITOR.instances.preguntas.getData())'><button style="margin-right: 20px;" class="btn btn-primary btn-lg">Responder</button></a>
            </div>
        </div>
    </div>
</div>

<?php if ($datos['rol'] =='publico' AND $datos['estado']=='pre' AND ($datos['auto']->asientosdisp - $datos['pasajerosCantAprobados'] - 1)) { ?>

<div class="modal fade" data-refresh="true" id="tarjetaCobro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:51%;">
       
<div class="modal-content">
      <div class="modal-header" style="float: left; ">
 
        <h4 class="modal-title" style="float: left;">Pago con Tarjeta</h4>
        <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
      </div>
      <div class="modal-body">
        <p>Ingrese los datos de su tarjeta, si es aceptado en el viaje se le debitara <b> $<?php echo(($datos['viaje']->costo)/($datos['auto']->asientosdisp)); ?></b> de su cuenta, en caso contrario no habrá ningun costo </p>
<form class="form-horizontal" action="<?php echo RUTA_URL; ?>/viaje/validacionTarjetaCobro" method="post">
  <div class="form-group">
   <label class="control-label col-sm-2" for="cardNumber">Numero </label>
    <div class="col-sm-10">
   <input type="hidden" id="path" name="path" value="<?php echo($datos['path']);?>"> 
   <input type="hidden" id="viaje" name="viaje" value="<?php echo($datos['viaje']->id);?>">     
   <input type="tel" maxlength="16" class="form-control" pattern="[0-9]{16}" name="cardNumber" placeholder="Numero de tarjeta valido" autocomplete="cc-number" required autofocus >
    </div>
    <div class="col-sm-10">
        <label class="control-label col-sm-2" for="vencimiento">Vencimiento </label>
   <input type="month" class="form-control" name="vencimiento" placeholder="MM/YY" autocomplete="cc-number" required autofocus >
    </div>
    <div class="col-sm-10">
        <label class="control-label col-sm-2" for="CCV">CCV </label>
   <input style="width: 60px" type="tel" maxlength="3" class="form-control" pattern="[0-9]{3}" name="CCV" placeholder="CCV" autocomplete="cc-number" required autofocus >
    </div>

  </div>

      </div>
      <div class="modal-footer">
     <button type='submit' class='btn btn-success' '>Aceptar</button>
        <button type="button"  class="btn btn-danger" data-dismiss="modal">Cancelar</button>
      </div>
      
      
      </form>
    </div>

    </div>
    <!-- /.modal-dialog -->
</div>

<?php }; ?>

<?php if (($datos['rol'] =='conductor' AND $datos['estado']=='pre')){ ?>

<div class="modal fade" data-refresh="true" id="tarjetaPago" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:51%;">

        <div class="modal-content">
            <div class="modal-header" style="float: left; ">

                <h4 class="modal-title" style="float: left;">Pago con Tarjeta</h4>
                <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
            </div>
            <div class="modal-body">
                <p>Ingrese los datos de su tarjeta, y le serán transferido <b> $<?php echo(($datos['viaje']->costo)/($datos['auto']->asientosdisp) * 0.95); ?></b> a su cuenta. </p>
                <form class="form-horizontal" action="<?php echo RUTA_URL; ?>/viaje/aceptarPostulante/<?php echo($postulante->usuario_id); ?>/<?php echo($postulante->viaje_id); ?>" method="post">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="cardNumber">Numero </label>
                        <div class="col-sm-10">
                            <input type="hidden" id="path" name="path" value="<?php echo($datos['path']);?>">
                            <input type="hidden" id="viaje" name="viaje" value="<?php echo($datos['viaje']->id);?>">
                            <input type="tel" maxlength="16" class="form-control" pattern="[0-9]{16}" name="cardNumber" placeholder="Numero de tarjeta valido" autocomplete="cc-number" required autofocus >
                        </div>
                        <div class="col-sm-10">
                            <label class="control-label col-sm-2" for="vencimiento">Vencimiento </label>
                            <input type="month" class="form-control" name="vencimiento" placeholder="MM/YY" autocomplete="cc-number" required autofocus >
                        </div>
                        <div class="col-sm-10">
                            <label class="control-label col-sm-2" for="CCV">CCV </label>
                            <input style="width: 60px" type="tel" maxlength="3" class="form-control" pattern="[0-9]{3}" name="CCV" placeholder="CCV" autocomplete="cc-number" required autofocus >
                        </div>

                    </div>

            </div>
            <div class="modal-footer">
                <button type='submit' class='btn btn-success' '>Aceptar</button>
                <button type="button"  class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>


            </form>
        </div>

    </div>
    <!-- /.modal-dialog -->
</div>

<?php } ?>


<?php require RUTA_APP.'/views/includes/footer.php'; ?>
