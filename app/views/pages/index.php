<?php require RUTA_APP.'/views/includes/header.php'; ?>

<?php
// var_dump($datos);
 ?>

<div class="container">


<nav class="main-menu">
            <div class="main-menu-logo">
                <img class= "main-menu-img" src="<?php echo RUTA_URL;?>/img/Logo.jpg" alt="">
            </div>
            <ul class="main-menu-container">
              <!--  <li class="main-menu-item"><a href="#">Item-1</a></li>
                <li class="main-menu-item"><a href="#">Item-2</a></li>
                <li class="main-menu-item"><a href="#">Item-3</a></li> -->
                <li class="main-menu-item"><a href="<?php echo RUTA_URL; ?>/registrate">REGISTRATE</a></li>
            </ul>
        </nav>
    <header class="header_img">
        
        <form action="<?php echo RUTA_URL; ?>/current/login" method="post" class="form-login">
           <div class="form-login-item">
            <input class="form-login-input" type="email" placeholder="Ingrese su email" name="email" required>
            <input class="form-login-input" type="password" placeholder="Ingrese su password" name="password" required>
           </div>
           <br>
            <div class="form-login-item">
            <button>Enviar</button>
            </div>
        </form>
    </header>
</div>
<?php require RUTA_APP.'/views/includes/footer.php'; ?>