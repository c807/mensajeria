<?php
if (isset($lista)) {
    foreach ($lista as $row) { ?>
<tr>
    <td><?php echo $row->actividad; ?></td>
    <td><?php echo $row->descripcion; ?></td>
    <td>
        <button class="btn btn-default btn-xs" onclick="openform_actividad(<?php echo $row->actividad; ?>)"><i
                class="glyphicon glyphicon-edit"></i></button>
       

        <button class="btn btn-default btn-xs" onclick="modal_eliminar_actividad(<?php echo $row->actividad; ?>)"><i
                class="glyphicon glyphicon-trash"></i></button>

    </td>

</tr>
<?php
}
}
?>

<!-- Modal eliminar actividad-->
<div class="modal fade" id="deleteActividad" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Elimina Actividad</h4>
            </div>
            <div class="modal-body text-center">
                <p id="id"></p>
				<h5 id="msg">Esta seguro de eliminar este registro</h5>
				<input type="hidden" id="actividad" name="actividad">
            </div>
            <div class="modal-footer">
                <button type="button" name="Save" class="btn btn-success btn-sm" onclick="eliminar_actividad()"><span
                        class="glyphicon glyphicon-trash"></span> Eliminar</button>
                        
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"> <span
                        class="glyphicon glyphicon-remove"></span> Cancelar</button>
            </div>
        </div>
    </div>
</div>
</div>