<?php require RUTA_APP.'/views/includes/header.php'; ?>

<?php require RUTA_APP.'/views/includes/userinterface-menu.php'; ?>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>


      <div class="container">
      <div  id="result" > </div>
      <div id="resultnombreusuario"></div>
      <br>
      
                <div class="row">
                  <div class="col-md-4"></div>
                  <div class="col-sm-12 col-lg-5">
                    <div class="login-panel panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">Ingrese sus datos</h3>
                      </div>
                      <div class="panel-body">
                        <form action="<?php echo RUTA_URL; ?>/userinterface/actualizarperfil" method="post">
                          <fieldset>
            
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <input class="form-control" placeholder="Nombre" type="text" name="nombre"
                                    value="<?php echo $datos['nombre']?>" required />
                              </div>
                              <div class="form-group col-md-6">
                                <input class="form-control" placeholder="Apellido" type="text" name="apellido"
                                    value="<?php echo $datos['apellido']?>"   required />
                              </div>
                            </div>
                            
                            <div class="form-group">
                              <input class="form-control" id="email" placeholder="E-mail" name="email" type="email" autofocus
                              value="<?php echo $datos['email']?>" required />
                            </div>
                            <div class="form-group">
                                  
                            
                            <div class="form-row">
                              
                            <div class="form-group col-md-6">
                              <input class="form-control" placeholder="Telefono" name="telefono" type="text" autofocus
                              value="<?php echo $datos['telefono']?>" required />
                            </div>

                              <div class="form-group col-md-6">
                              <input class="form-control" placeholder="Fecha de nacimiento" type="date"
                              value="<?php echo $datos['fechanac']; ?>" name="fechanac" required>
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <input class="form-control" placeholder="Ciudad" name="ciudad" type="text" value="<?php echo $datos['ciudad']?>" required />
                              </div>
                              <div class="form-group col-md-6">
                              <input class="form-control" placeholder="Provincia" type="text"
                              value="<?php echo $datos['provincia']; ?>" name="provincia" required />
                              </div>
                            </div>
            
                            
            
                            <button type="submit" class="btn btn-lg btn-success btn-block">Modicar</button>
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

        
 
<?php require RUTA_APP.'/views/includes/footer.php'; ?>












<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script>
      $("#email").blur(function(){
        var mail = $("#email").val();
        
        $.ajax({
            url:"<?php echo RUTA_URL; ?>/ajax",
            type: 'POST',
            data:{
                'mail':mail,
            },
            success: function(data){
                // DONDE SE MOSTRARA EL MENSAJE
                $('#result').html(data); 
            }
        });
    });

    $("#nombreusuario").blur(function(){
        var nombreusuario = $("#nombreusuario").val();
        
        $.ajax({
            url:"<?php echo RUTA_URL; ?>/ajax/user",
            type: 'POST',
            data:{
                'nombreusuario':nombreusuario,
            },
            success: function(data){
                // DONDE SE MOSTRARA EL MENSAJE
                $('#resultnombreusuario').html(data); 
            }
        });
    });

    
</script>