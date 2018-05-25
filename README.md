
1) Crear un controlodador en la carpeta app/controllers, asegurese de utilizar un 
nombre relacionado a la aplicación ya que este será llamado desde la url.
Ejemplo: supongamos que su aplicación es www.miaplicacion.com, si ustedes quiere
crear funcionalidades para gestionar usuarios, su controlador debería ser llamado
usuarios, ya que se lo llamará desde la url www.miaplicacion.com/usuarios

2) Es necesario que el controlador herede de Controller, ya que le permitirá
utilizar las vistas y los modelos.

3) Dentro del controlador cree diferentes métodos para gestionar, siguiendo con el 
ejemplo anterior, usuarios.
Por ejemplo cuando usted ingresa www.miaplicacion.com/usuarios se cargará automaticamente
el metodo index, puede en esa pantalla listar todos los usuarios. En caso de querer cambiar
algún dato, puede crear un método detalle, el cual le mostrara detalles de algún usuario
concreto, ingresando a www.miaplicacion.com/usuarios/detalle/$id.

4) Para utilizar las vistas llame al método de la clase padre Controller view pasando
como primer parámetro la ruta de la vista. En caso de querer pasar parámetros, pase un array
asociativo como segundo parámetro.