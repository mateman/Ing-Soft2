<?php require RUTA_APP.'/views/includes/header.php'; ?>
<?php require RUTA_APP.'/views/includes/login-registrate-menu.php'; ?>


      <div class="container">
                <div class="row">
                  <div class="col-md-4"></div>
                  <div class="col-sm-12 col-lg-5">
                    <div class="login-panel panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">Ingrese sus datos</h3>
                      </div>
                      <div class="panel-body">
                        <form method="POST" action="<?php echo RUTA_URL; ?>/registrate/procesar">
                          <fieldset>
            
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <input class="form-control" placeholder="Nombre" type="text" name="nombre"
                                       required>
                              </div>
                              <div class="form-group col-md-6">
                                <input class="form-control" placeholder="Apellido" type="text" name="apellido"
                                       required>
                              </div>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Telefono" name="telefono" type="text" autofocus
                                     required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus
                                     required>
                            </div>
                            <div class="form-group">
                                    <input class="form-control" placeholder="Nombre Usuario" name="nombreusuario" autofocus
                                           required>
                                  </div>
                            <div class="form-row">
 
                              <div class="form-group col-md-6">
                              <input class="form-control" placeholder="Fecha de nacimiento" type="date"
                                     name="fechanac" required>
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <input class="form-control" placeholder="Ciudad" name="ciudad" type="text" required>
                              </div>
                              <div class="form-group col-md-6">
                              <input class="form-control" placeholder="Provincia" type="text"
                                     name="provincia" required>
                              </div>
                            </div>
            
                            <div class="form-group">
                              <input id="id_password" class="form-control" placeholder="Contrase&ntilde;a" name="contrasena"
                                     type="password"  required title="Minimo 8 caracteres">
                            </div>
                            <div class="form-group">
                              <input id="id_confirmPassword" class="form-control" placeholder="Confirmar contrase&ntilde;a"
                                     name="contrasena2" type="password" required>
                            </div>
            
                            <button type="submit" class="btn btn-lg btn-success btn-block">Registrarse</button>
                          </fieldset>
                          <?php  if(isset($datos['err'])) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $datos['err']; ?>
                            </div>
                        <?php  }  ?>
                        </form>
                   
                      </div>
                    </div>
                  </div>
                </div>
              </div>


    

<?php require RUTA_APP.'/views/includes/footer.php'; ?>