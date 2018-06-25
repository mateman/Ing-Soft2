
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



SEGUNDA ENTREGA.

Guido:
    - Password mas segura. // Listo
    - Loguearse con nombre de usuario // Listo
    - Poder modificar email. // Listo
    
Claudio

    - Borrar tabla conductores y agregar id_conductor al viaje.
    - agregar estado en la tabla pasajeros
    -consultar a juan tema puntajes

Pablo
    - La fecha de creacion del viaje que no sea menor al momento actual
    - Controla la modificacion del auto si este esta implicado en un viaje.

DEMO 2 AGREGAR COMLUMNA ESTADO A (0,1,2) a PASAJERO

1- Ver listado de los viajes
2- postularse a un viaje
3- confirmar postulante

4- Modificar viaje.
    1) si hay gente pero no esta aceptada NO puedo

5- Cancelar viaje.
    1) si hay gente pero no esta aceptada puedo




Ver detalle de viaje


cancelar postulante
buscar viaje

