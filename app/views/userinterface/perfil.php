<?php require RUTA_APP.'/views/includes/header.php'; ?>
<script>
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

function getComentarios (ruta) {
    lista.open("POST", ruta, true);
    lista.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    lista.send();
    lista.onreadystatechange = function () {
        if (lista.readyState == 4) {
            if (lista.responseText == "Rechazado"){Alerta("","Por favor introduzca una pregrunta");}
            else{document.getElementById('divINFO').innerHTML = lista.responseText;};
        };
    };
};

//------------------------------------------------------------------------------------------------------------------------------BORRAR PREGUNTA SI SOS CONDUCTOR. -CLAUDIO

</script>

<?php require RUTA_APP.'/views/includes/userinterface-menu.php'; ?>

<style>
.img-perfil {
    max-width:60px;
    max-height:60px;
}
</style>

<div class="container">
    <br>
 
    <p><b>Nombre:</b> <?php echo $datos['nombre']; ?></p>
    <hr>
    <p><b>Apellido: </b><?php echo $datos['apellido']; ?></p>
    <hr>
    <p><b>Nombre de usuario:</b> <?php echo $datos['nombreusuario']; ?></p>
    <hr>
    <p><b>Teléfono:</b> <?php echo $datos['telefono']; ?></p>
    <hr>
    <p><b>Mail: </b><?php echo $datos['email']; ?></p>
    <hr>
    <p><b>Provincia:</b> <?php echo $datos['provincia']; ?></p>
    <hr>
    <p><b>Ciudad:</b> <?php echo $datos['ciudad']; ?></p>
    <?php if (isset($datos['puntospasajero'])): ?>
    <hr>
    <p><b>Puntos como pasajero:</b> <?php echo $datos['puntospasajero']; ?></p>
    <p><button type="button"  title="Comentarios de Conductores" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#infoModal" id="bt-ant<?php echo ($datos['id']); ?>" name="bt-ant<?php echo ($datos['id']); ?>" onclick="getComentarios('<?php echo RUTA_URL; ?>/userinterface/antecedentesPasajero/<?php echo($datos['id']); ?>');">
            <img src="<?php echo RUTA_URL;?>/public/img/icons8-document.png" title="Comentarios de Conductores" alt="" onmouseover="normalImg(this)" onmouseout="smallImg(this)" width="32" height="32"></button></p>
    <?php endif;  ?>
    <?php if (isset($datos['puntosconductor'])): ?>
    <hr>
    <p><b>Puntos como conductor:</b> <?php echo $datos['puntosconductor']; ?></p>
    <p><button type="button"  title="Comentarios de pasajeros" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#infoModal" id="bt-ant<?php echo ($datos['id']); ?>" name="bt-ant<?php echo ($datos['id']); ?>" onclick="getComentarios('<?php echo RUTA_URL; ?>/userinterface/antecedentesConductor/<?php echo($datos['id']); ?>');">
            <img src="<?php echo RUTA_URL;?>/public/img/icons8-document.png" title="Comentarios de pasajeros" alt="" onmouseover="normalImg(this)" onmouseout="smallImg(this)" width="32" height="32"></button></p>
    <?php endif;  ?>
    <hr>
    <a href="<?php echo RUTA_URL; ?>/userinterface/modificarperfil" type="button" class="btn btn-success">Modificar perfil</a>
    <a href="<?php echo RUTA_URL; ?>/userinterface/actualizarcontrasena" type="button" class="btn btn-success">Modificar contraseña</a>
    <hr>
    <?php
    $im = file_get_contents(RUTA_APP.'/../public/img/users/'. $datos['imagenurl']);
    $imdata = base64_encode($im);
    echo "<p><img class=\"img-perfil\" src='data:image/jpg;base64,".$imdata."' />";
    /*     <p><img class="img-perfil"src="<?php echo RUTA_URL . '/public/img/users/'. $datos['imagenurl'] ?>">
    */
    ?>

    <form enctype="multipart/form-data" action="<?php echo RUTA_URL; ?>/userinterface/updateimage" method="POST">
<input name="imagen" type="file" size=20/>
<input type="submit" value="Subir archivo" />
    </p>
    </form>

</div>


<div class="modal fade" data-refresh="true" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:51%;">
        <div class="modal-content" id="divINFO">
        </div>

    </div>
    <!-- /.modal-dialog -->
</div>

<?php require RUTA_APP.'/views/includes/footer.php'; ?>








