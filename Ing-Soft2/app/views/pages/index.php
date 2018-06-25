<?php require RUTA_APP.'/views/includes/header.php'; ?>

<?php require RUTA_APP.'/views/includes/login-registrate-menu.php'; ?>

 <div class="container">
            <div class="row cincuenta">
              <div class="col">
                <div class="text-center">
                    <form class="form-signin"action="<?php echo RUTA_URL; ?>/current/login" method="post">
                        <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
                        <h1 class="h3 mb-3 font-weight-normal">Ingresar!</h1>
                        <label for="inputEmail" class="sr-only">Email address</label>
                        <input type="text" id="inputEmail" class="form-control" placeholder="Nombre de usuario" name="nombreusuario" required autofocus>
                        <label for="inputPassword" class="sr-only">Password</label>
                        <input type="password" id="inputPassword" class="form-control" placeholder="Password" name ="password" required>
                        <div class="checkbox mb-3">
                      
                        </div>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                        <?php  if(isset($datos['datos_err'])) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $datos['datos_err']; ?>
                            </div>
                        <?php  }  ?>
                        
                        
                        
                    
                      </form>
                </div>
              </div>
            </div>
          </div>


<?php require RUTA_APP.'/views/includes/footer.php'; ?>




