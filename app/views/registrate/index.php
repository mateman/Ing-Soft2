<?php require RUTA_APP.'/views/includes/header.php'; ?>

<?php
// var_dump($datos);
 ?>

<div class="container">


<nav class="main-menu">
            <div class="main-menu-logo">
                <img class= "main-menu-img" src="<?php echo RUTA_URL;?>/img/Logo.jpg">
            </div>
            <ul class="main-menu-container">
                <li class="main-menu-item"><a href="#">Item-1</a></li>
                <li class="main-menu-item"><a href="#">Item-2</a></li>
                <li class="main-menu-item"><a href="#">Item-3</a></li>
                <li class="main-menu-item"><a href="<?php echo RUTA_URL; ?>/registrate">REGISTRATE</a></li>
            </ul>
        </nav>

        
        <header>
        <form action="<?php echo RUTA_URL; ?>/registrate/procesar" method="post" >
            <input type="email"     placeholder="Ingrese su email" name="email" >
            <?php
                if(isset($datos['email_err'])) {
                    echo $datos['email_err'];
                }
             ?>
            <input type="password"  placeholder="Ingrese su password" name="contrasena" >
            <input type="password"  placeholder="Ingrese su password" name="contrasena2" >
            <span> <?php
                if(isset($datos['contrasena_err'])) {
                    echo $datos['contrasena_err'];
                }
             ?></span>
            
            <input type="text" name="provincia" placeholder="provincia" >
            <input type="date" name="fechanac" placeholder="Fecha de aciemiento" >
            <input type="text" name="apellido" placeholder="apellido" >
            <input type="phone" name="telefono" placeholder="telefono" >
            <input type="text" name="nombre" placeholder="nombre" >
            <input type="text" name="nombreusuario" placeholder="Nombre de usuario" > <span> <?php
                if(isset($datos['username_err'])) {
                    echo $datos['username_err'];
                }
             ?></span>
            
            
            <input type="text" name="ciudad" placeholder="Ciudad" >
            
         
            <button>Enviar</button>
            </div>
        </form>
        </header>
</div>
<?php require RUTA_APP.'/views/includes/footer.php'; ?>