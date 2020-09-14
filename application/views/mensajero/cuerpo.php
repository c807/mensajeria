
<?php
if (isset($lista)) {
    foreach ($lista as $row) { ?>
<tr>
    <td><?php echo $row->mensajero; ?></td>
    <td><?php echo $row->nombre; ?></td>
    <td>
        <button class="btn btn-default btn-xs" onclick="openform(<?php echo $row->mensajero; ?>)"><i
                class="glyphicon glyphicon-edit"></i></button>
       

        <button class="btn btn-default btn-xs" onclick="modal_eliminar(<?php echo $row->mensajero; ?>)"><i
                class="glyphicon glyphicon-trash"></i></button>

    </td>

</tr>
<?php
}
}
?>

<!-- Modal eliminar mensajero-->
<div class="modal fade" id="deleteMensajero" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Elimina Mensajero</h4>
            </div>
            <div class="modal-body text-center">
                <p id="id"></p>
				<h5 id="msg">Esta seguro de eliminar este registro</h5>
				<input type="hidden" id="mensajero" name="mensajero">
            </div>
            <div class="modal-footer">
                <button type="button" name="Save" class="btn btn-success btn-sm" onclick="eliminar_mensajero()"><span
                        class="glyphicon glyphicon-trash"></span> Eliminar</button>
                        
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"> <span
                        class="glyphicon glyphicon-remove"></span> Cancelar</button>
            </div>
        </div>
    </div>
</div>
</div>