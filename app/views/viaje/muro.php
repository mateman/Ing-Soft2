<head>
    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>/css/consultas.css">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
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
        <?php if ($datos['rol'] =='aceptado' AND $datos['estado']=='pos') : ?>
        function calificar(punto, editor) {
            lista.open("POST", "<?php echo RUTA_URL; ?>/viaje/calificar/", true);
            lista.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            lista.send("viaje= " +<?php echo $datos['viaje']->id ?>+"&usuario="+<?php echo $datos['conductor']->id ?>+"&punto="+punto+"&editor="+editor);
            lista.onreadystatechange = function () {
                if (lista.readyState == 4) {
                    if (lista.responseText == "Rechazado"){alert("Se rechazo la calificacion");}
                    else{document.getElementById('bt-calificar').style.visibility= 'hidden';};
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
            lista.send("viaje= " +<?php echo $datos['viaje']->id ?>+"&usuario="+pasajeroid+"&punto="+punto+"&editor="+editor);
            lista.onreadystatechange = function () {
                if (lista.readyState == 4) {
                    if (lista.responseText == "Rechazado"){alert("Se rechazo la calificacion");}
                    else{document.getElementById('bt-calificacion').style.visibility= 'hidden';};
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
        <?php if ($datos['estado']=='pos' AND $datos['rol']=='aceptado') { ?>
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
        <?php if($datos['rol'] == 'conductor' or $datos['rol'] == 'aceptado'): ?>
            <h5>Nombre: <?php echo $datos['conductor']->nombre; ?> </h5>
            <h5>Apellido: <?php echo $datos['conductor']->apellido; ?></h5>
            <h5>Telefono: <?php echo $datos['conductor']->telefono; ?></h5>
            <h5>Email: <?php echo $datos['conductor']->email; ?> </h5> 
            <br>
        <?php endif;  ?>

        
        
        </div>
        <div class="row">
        <?php if ($datos['rol'] =='publico' AND $datos['estado']=='pre')
      {
            $class_succes = ' class="btn btn-success"';
            $class_danger = ' class="btn btn-danger"';
            echo "<a id='anotar-". ($datos['viaje']->id) . "' onClick='Anotarse(".($datos['viaje']->id).")'><button".$class_succes.">Anotarse</button></a>";
            echo '<br />';
            echo "<a id='borrar-". ($datos['viaje']->id) . "' onClick='Borrarse(".($datos['viaje']->id).")' style='visibility: hidden'><button".$class_danger.">Darse de Baja</button></a>";
      }
      elseif ($datos['rol'] =='postulado' AND $datos['estado']=='pre')
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
            <a href="<?php echo RUTA_URL; ?>/userinterface/infoPostulante/<?php echo($postulante->usuario_id); ?>/<?php echo($datos['viaje']->id); ?>"> <img src="<?php echo RUTA_URL;?>/public/img/icons8-customer.png" alt="" onmouseover="normalImg(this)" onmouseout="smallImg(this)" width="32" height="32"></a>
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
        <?php } elseif ($datos['estado']=='pos') { ?>
        <td><input type="radio" name="calificacion" value="-1">Negativo<input type="radio" name="calificacion" value="0">Neutro<input type="radio" name="calificacion" value="1">Positivo
        </td>
        <?php } else {}; ?>
        <td>
            <a href="<?php echo RUTA_URL; ?>/userinterface/infoPostulado/<?php echo($aceptados->usuario_id); ?>/<?php echo($datos['viaje']->id); ?>"><img src="<?php echo RUTA_URL;?>/public/img/icons8-customer.png" alt="" onmouseover="normalImg(this)" onmouseout="smallImg(this)" width="32" height="32"></a>
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
<input class="animate" type="radio" name="question" id="q1"/>
<label class="animate" for="q1">Q: Puedo llevar a mi perro? Se porta bien...</label>
<p class="response animate">A: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

<input class="animate" type="radio" name="question" id="q2"/>
<label class="animate" for="q2">Q: Puedo parar a fumar un pucho a mitad de viaje?</label>
<p class="response animate">A: It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>

<input class="animate" type="radio" name="question" id="q3"/>
<label class="animate" for="q3">Q: Puedo llevar una valija de 30 kg aprox?</label>
<p class="response animate">A: Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>

<input class="animate" type="radio" name="question" id="q4"/>
<label class="animate" for="q4">Q: En serio es una Ferrari?</label>
<p class="response animate">A: There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc..</p>
</section>
<?php if (($datos['rol'] =='publico' OR$datos['rol'] =='postulado' OR $datos['rol'] =='aceptado') AND $datos['estado']=='pre') : ?>
    <textarea name="preguntas">Haga su pregunta</textarea>
    <a id='bt-pregunta' onClick='preguntar(<?php echo $datos['viaje']->id.','.$datos['conductor']->id ?>,CKEDITOR.instances.preguntas.getData())'><button class="btn btn-primary btn-lg">Preguntar</button></a>
<?php endif; ?>
</div>

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
                <a id='bt-calificacion' onClick='valor=seleccionado();calificar(valor,CKEDITOR.instances.editor.getData())'><button class="btn btn-primary btn-lg">Anotarse</button></a>
            </div>
        </div>
    </div>
</div>


<?php require RUTA_APP.'/views/includes/footer.php'; ?>
