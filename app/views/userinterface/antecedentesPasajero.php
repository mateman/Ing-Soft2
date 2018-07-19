<div class="modal-header">
    <h4 class="modal-title" id="myModalLabel">Comentarios de conductores</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>         <!-- /modal-header -->
<div class="modal-body">
    <br>
    <table class="table table-striped">
    <thead>
    </thead>
    <tbody>
    <?php foreach ($datos as $comentario){ ?>
    <tr>
        <th>
            <p><b><?php echo $comentario->nombreusuario ?></b></p>
        </th>
        <td>
            <br></br><p><?php echo $comentario->comentario_pasajero ?></p>
        </td>
    </tr>
    <?php } ?>
    </tbody>
    </table>
</div>
</div>         <!-- /modal-body -->
<div class="container">









