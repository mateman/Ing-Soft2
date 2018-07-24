<nav class="navbar navbar-expand-lg navbar-light bg-light">

<script src="<?php echo RUTA_URL;?>/public/js/main.js"></script>
    <a class="navbar-brand" href="<?php echo RUTA_URL; ?>/userinterface/unAventon">

        <img src="<?php echo RUTA_URL;?>/public/img/Logo.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
        Un aventon
      </a>
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo RUTA_URL; ?>/userinterface/misautos">Mis autos <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Viajes
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        <a class="nav-link" href="<?php echo RUTA_URL; ?>/userinterface/misviajes">Viajes | Conductor <span class="sr-only">(current)</span></a>
        <a class="nav-link" href="<?php echo RUTA_URL; ?>/userinterface/misviajespasajero">Viajes | Pasajero<span class="sr-only">(current)</span></a>
   
        </div>
      </li>
        <!--
        <li class="nav-item">
          <a class="nav-link" href="<?php echo RUTA_URL; ?>/userinterface/misviajes">Mis viajes <span class="sr-only">(current)</span></a>
        </li>-->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Perfil
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="nav-link" href="<?php echo RUTA_URL; ?>/userinterface/perfil">Ver perfil <span class="sr-only">(current)</span></a>
                <a class="nav-link" href="<?php echo RUTA_URL; ?>/userinterface/modificarperfil">Editar perfil <span class="sr-only">(current)</span></a>
                <a class="nav-link" href="<?php echo RUTA_URL; ?>/userinterface/actualizarcontrasena">Cambiar password<span class="sr-only">(current)</span></a>
                <a class="nav-link" style="cursor:pointer;"  onclick="Confirm('Darse de baja','¿Desea realmente darse de baja de UnAventon? Si lo hace, no podrá volver a ingresar con su nombre de usuario y contraseña','<?php echo RUTA_URL; ?>/userinterface/darbaja')">Dar de baja la cuenta<span class="sr-only">(current)</span></a>
            </div>

        </li>
         <li class="nav-item">
          <a class="nav-link" href="<?php echo RUTA_URL; ?>/buscador/buscador">Buscar<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo RUTA_URL; ?>/userinterface/logout">Salir <span class="sr-only">(current)</span></a>
        </li>

       
      </ul>
    </div>
  </nav>
