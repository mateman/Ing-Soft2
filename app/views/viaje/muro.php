<?php require RUTA_APP.'/views/includes/header.php'; ?>

<?php require RUTA_APP.'/views/includes/userinterface-menu.php'; ?>
<<<<<<< HEAD
<?php if ($datos['anotarse'] =='1'){echo "<a id='anotar-". ($datos['viaje']->id) . "' onClick='Anotarse(".($datos['viaje']->id).")'><button>Anotarse</button></a>";} ?><br>
=======
<?php echo($datos['boton']) ?><br>
>>>>>>> 63b3660dda8ed5f182d35f1988fd307848cebfa6
<?php echo($datos['viaje']->origen) ?><br>
<?php echo($datos['viaje']->horasalida) ?><br>
<?php echo($datos['viaje']->destino); ?><br>
<?php echo($datos['viaje']->horallegada); ?><br>
<?php echo($datos['viaje']->descripcion); ?><br>
<?php echo($datos['viaje']->costo); ?><br>
<<<<<<< HEAD
<?php echo($datos['auto']->marca); ?><br>
<?php echo($datos['auto']->modelo); ?><br>
<?php echo($datos['auto']->asientosdisp); ?><br>
<?php echo($datos['conductor']->nombreusuario); ?><br>
<?php echo ('<a href="'. RUTA_URL.'/'.$datos['path'].'">Volver </a>'); ?>
=======

>>>>>>> 63b3660dda8ed5f182d35f1988fd307848cebfa6
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
<<<<<<< HEAD
        lista.open("POST", "<?php echo RUTA_URL; ?>/userinterface/anotarse/"+idviaje, true);
=======
        lista.open("POST", "./anotarse", true);
>>>>>>> 63b3660dda8ed5f182d35f1988fd307848cebfa6
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
