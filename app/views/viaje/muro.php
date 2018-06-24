<?php require RUTA_APP.'/views/includes/header.php'; ?>

<?php require RUTA_APP.'/views/includes/userinterface-menu.php'; ?>
<style>
    .datos{
        max-width: 25%;
    }
</style>
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
            <h5>Saliendo: <?php echo($datos['viaje']->horasalida) ?><br></h5>
            <h5>Llegando: <?php echo($datos['viaje']->horallegada); ?></h5>
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
        <?php if($datos['rol'] == 'conductor'): ?>
        <h5>Patente: <?php echo $datos['auto']->patente; ?></h5>
        <?php endif; ?>
      
        <h5>Cantidad de asientos: <?php echo $datos['auto']->asientosdisp; ?> </h5>
   
   
        </div>
        <div class="col">
        <h3>Datos del conductor:</h3>
        <img class="datos" src="<?php echo  RUTA_URL .'/public/img/'. $datos['conductor']->imagen_url ; ?>" alt="">
        <h5>Nombre de usuario: <?php echo $datos['conductor']->nombreusuario; ?>
        <?php if($datos['rol'] == 'conductor'): ?>
            <h5>Nombre: <?php echo $datos['conductor']->nombre; ?> </h5>
            <h5>Apellido: <?php echo $datos['conductor']->apellido; ?></h5>
            <h5>Telefono: <?php echo $datos['conductor']->telefono; ?></h5>
            <h5>Email: <?php echo $datos['conductor']->email; ?> </h5>
        <?php endif; ?>

        
        
        </div>
    </div>
</div>




<?php if ($datos['anotarse'] =='1'){echo "<a id='anotar-". ($datos['viaje']->id) . "' onClick='Anotarse(".($datos['viaje']->id).")'><button>Anotarse</button></a>";} ?><br>

<?php echo ('<a href="'. RUTA_URL.'/'.$datos['path'].'">Volver </a>'); ?>







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
    function Anotarse(idviaje) {
        lista.open("POST", "<?php echo RUTA_URL; ?>/userinterface/anotarse/"+idviaje, true);
        lista.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        lista.send("anotarse= " + idviaje);
        lista.onreadystatechange = function () {
            if (lista.readyState == 4) {
                if (lista.responseText == "Rechazado"){alert("Se rechazo la postulacion");};
                document.getElementById('anotar-' + idviaje).style.visibility= 'hidden';
            }
        }
    }
    //------------------------------------------------------------------------------------------------------------------------------
</script>



<?php require RUTA_APP.'/views/includes/footer.php'; ?>
