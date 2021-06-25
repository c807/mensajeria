
<?php
if (isset($lista)) {
    foreach ($lista as $row) { ?>
<tr>
    <td><?php echo $row->idruta; ?></td>
    <td><?php echo $row->nombre; ?></td>
    <td>
        <button class="btn btn-default btn-xs" onclick="openform_ruta(<?php echo $row->idruta; ?>)"><i
                class="glyphicon glyphicon-edit"></i></button>
       

        <button class="btn btn-default btn-xs" onclick="modal_eliminar_ruta(<?php echo $row->idruta; ?>)"><i
                class="glyphicon glyphicon-lock"></i></button>

    </td>
</tr>
<?php
}
}
?>

<!-- Modal eliminar ruta-->
<div class="modal fade" id="deleteRuta" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Deshabilitar Ruta</h4>
            </div>
            <div class="modal-body text-center">
                <p id="id"></p>
				<h5 id="msg">Esta seguro de deshabilitar este registro</h5>
				<input type="hidden" id="ruta" name="ruta">
            </div>
            <div class="modal-footer">
                <button type="button" name="Save" class="btn btn-success btn-sm" onclick="eliminar_ruta()"><span
                        class="glyphicon glyphicon-lock"></span> Deshabilitar</button>
                        
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"> <span
                        class="glyphicon glyphicon-remove"></span> Cancelar</button>
            </div>
        </div>
    </div>
</div>
</div>