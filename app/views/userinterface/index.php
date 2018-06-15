<?php require RUTA_APP.'/views/includes/header.php'; ?>

<?php require RUTA_APP.'/views/includes/userinterface-menu.php'; ?>


 <div class="container">     
 <br><br>
    <div class="row">
        <div class="col text-center"> <h1>Hola  <?php echo $datos['nombreusuario'];?> , Bienvenido!</h1></div>
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
            <th>Modificar</th>
            <th>Eliminar</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < $datos['cantViajes'] ; $i++) { ?>
            <tr>
                <td><?php echo($datos['viajes'][$i]->origen) ?></td>
                <td><?php echo($datos['viajes'][$i]->horasalida) ?></td>
                <td><?php echo($datos['viajes'][$i]->destino); ?></td>
                <td><?php echo($datos['viajes'][$i]->horallegada); ?></td>
                <td><?php echo($datos['viajes'][$i]->descripcion); ?></td>
                <td><?php echo($datos['viajes'][$i]->costo); ?></td>
                <td>
                    <a href="<?php echo RUTA_URL; ?>/viaje/viajeModificar/<?php echo($datos['viajes'][$i]->id); ?>"><button>Modificar</button></a>
                </td>
                <td>
                    <a href="<?php echo RUTA_URL; ?>/viaje/viajeEliminar/<?php echo($datos['viajes'][$i]->id); ?>"><button>Eliminar</button></a>

                </td>

            </tr>
        <?php } ?>



        </tbody>
    </table>
</div>




<?php require RUTA_APP.'/views/includes/footer.php'; ?>




        
