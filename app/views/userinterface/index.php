<?php require RUTA_APP.'/views/includes/header.php'; ?>

<?php
// var_dump($datos);
 ?>




<nav class="main-menu">
            <div class="main-menu-logo">
                <img class= "main-menu-img" src="<?php echo RUTA_URL;?>/img/Logo.jpg" alt="">
            </div>
            <ul class="main-menu-container">
                <li class="main-menu-item"><a href="#">Registrar auto</a></li>
                <li class="main-menu-item"><a href="#">Crear Viaje</a></li>
                <li class="main-menu-item"><a href="<?php echo RUTA_URL; ?>/userinterface/perfil">Ver perfil</a></li>
                <li class="main-menu-item"><a href="<?php echo RUTA_URL; ?>/userinterface/logout">SALIR</a></li>
            </ul>
        </nav>

 <div class="container">       
        <header>
        <h1>Hola  <?php echo $datos['nombreusuario'];?> , Bienvenido!</h1>
        </header>
    </div>

        
       
<?php require RUTA_APP.'/views/includes/footer.php'; ?>