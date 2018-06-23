<?php require RUTA_APP.'/views/includes/header.php'; ?>

<?php require RUTA_APP.'/views/includes/userinterface-menu.php'; ?>
<?php echo($datos['boton']) ?><br>
<?php echo($datos['viaje']->origen) ?><br>
<?php echo($datos['viaje']->horasalida) ?><br>
<?php echo($datos['viaje']->destino); ?><br>
<?php echo($datos['viaje']->horallegada); ?><br>
<?php echo($datos['viaje']->descripcion); ?><br>
<?php echo($datos['viaje']->costo); ?><br>

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
        lista.open("POST", "./anotarse", true);
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
