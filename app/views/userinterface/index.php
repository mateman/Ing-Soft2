<?php require RUTA_APP.'/views/includes/header.php'; ?>

<?php require RUTA_APP.'/views/includes/userinterface-menu.php'; ?>


 <div class="container">     
 <br><br>
    <div class="row">
        <div class="col text-center"> <h1><?php echo $datos['mensaje'];?></h1></div>
    </div>
</div>
<div class="container">

    <table class="table table-dark table-striped">
        <thead>
        <tr>
            <th>Origen</th>
            <th>Hora de salida</th>
            <th>Destino</th>
            <th>Hora de llegada</th>
            <th>Descricpion</th>
            <th>Costo</th>
            <th>Consultar</th>
            <th>Postularse</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < $datos['cantViajes'] ; $i++) { ?>
            <tr>
                <td><?php echo($datos['viajes'][$i]->origen); ?></td>
                <td><?php echo($datos['viajes'][$i]->horasalida); ?></td>
                <td><?php echo($datos['viajes'][$i]->destino); ?></td>
                <td><?php echo($datos['viajes'][$i]->horallegada); ?></td>
                <td><?php echo($datos['viajes'][$i]->descripcion); ?></td>
                <td><?php echo($datos['viajes'][$i]->costo); ?></td>
                <td>
                    <a onClick="MostrarLista(<?php echo($datos['viajes'][$i]->id); ?>)"><button>Consultar</button></a>
                </td>
                <td>
                    <a href="<?php echo RUTA_URL; ?>/viaje/viajeEliminar/<?php echo($datos['viajes'][$i]->id); ?>"><button>Anotarse</button></a>

                </td>

            </tr>
            <tr><div id="div-<?php echo($datos['viajes'][$i]->id); ?>"></div></tr>
        <?php } ?>



        </tbody>
    </table>
</div>

<script>
    var http = nuevoAjax();

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
    function MostrarLista(idviaje) {
        lista.open("POST", "./listar.php", true);
        lista.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        lista.send("listar= " + idviaje);
        lista.onreadystatechange = function () {
            if (lista.readyState == 4) {
                document.getElementById('div-' + idviaje).innerHTML = lista.responseText;
            }
        }
    }

    //------------------------------------------------------------------------------------------------------------------------------
</script>

<?php require RUTA_APP.'/views/includes/footer.php'; ?>




        
