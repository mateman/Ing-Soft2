<?php require RUTA_APP.'/views/includes/header.php'; ?>

<?php require RUTA_APP.'/views/includes/login-registrate-menu.php'; ?>

 <div class="container">
            <div class="row cincuenta">
              <div class="col">
                <div class="text-center">
                    <form class="form-signin"action="<?php echo RUTA_URL; ?>/recuperar/procesarContrasenas" method="post">
                        <input type="hidden" id="usuario" name="usuario" value="<?php echo $datos['usuario']; ?>">
                        <input type="hidden" id="email" name="email" value="<?php echo $datos['email']; ?>">
                        <input type="hidden" id="token" name="token" value="<?php echo $datos['token']; ?>">
                        <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
                        <h1 class="h3 mb-3 font-weight-normal">Ingrese su nuevo password</h1>
                        <label for="inputEmail" class="sr-only">Password</label>
                        <input type="password" id="inputEmail" class="form-control" placeholder="Password" name="contrasena" required autofocus>
                        <label for="inputPassword" class="sr-only">Repita el password</label>
                        <input type="password" id="inputPassword" class="form-control" placeholder="Repita su password" name ="contrasena2" required>
                        <div class="checkbox mb-3">
                      
                        </div>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Actualizar password</button>
                       
                            <div>
                                <?php if(isset($datos['msj'])) {
                                    echo $datos['msj'];
                                } ?>
                            </div>
                       
                        
                        
                        
                    
                      </form>
                </div>
              </div>
            </div>
          </div>


<?php require RUTA_APP.'/views/includes/footer.php'; ?>

