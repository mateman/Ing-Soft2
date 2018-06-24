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
                    <a href="<?php echo RUTA_URL; ?>/viaje/muro/<?php echo($datos['viajes'][$i]->id);?>"> <img src="<?php echo RUTA_URL;?>/public/img/icons8-car.png" alt="" ></a>
                </td>
                <td>

                </td>

            </tr>
          <?php } ?>



        </tbody>
    </table>
</div>

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
    function MostrarDatos(idviaje) {
        if (document.getElementById('tr-' + idviaje).style.visibility === 'hidden') {
            lista.open("POST", "./listarInfo", true);
            lista.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            lista.send("listar= " + idviaje);
            lista.onreadystatechange = function () {
                if (lista.readyState == 4) {
                    document.getElementById('tr-' + idviaje).innerHTML = lista.responseText;
                    document.getElementById('tr-' + idviaje).style.visibility= 'visible';
                }
            }
        } else {
            document.getElementById('tr-' + idviaje).style.visibility = 'hidden';
        }

    }

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




        
