<?php require RUTA_APP.'/views/includes/header.php'; ?>
<?php require RUTA_APP.'/views/includes/login-registrate-menu.php'; ?>


<div class="container">
          <div class="row">
            <div class="col-md-4"></div>
            <div class="col-sm-12 col-lg-5">
              <div class="login-panel panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">Ingrese cuenta y correo electrónico</h3>
                </div>
                <div class="panel-body">
                  <form method="POST" action="<?php echo RUTA_URL; ?>/recuperar/procesar">
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="Nombre Usuario" name="nombreusuario" value="<?php if(isset($datos['nombreusuario'])) echo ($datos['nombreusuario']); ?>" autofocus required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="E-mail" name="email" value="<?php if(isset($datos['email'])) echo ($datos['email']); ?>" type="email" autofocus required>
                        </div>
                        <button type="submit" class="btn btn-lg btn-success btn-block">Enviar e-mail</button>
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