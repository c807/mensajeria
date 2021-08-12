<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title></title>
    <style>
    .modal70 {
        width: 70%;
        margin: 30px auto;
    }
    </style>
</head>

<body>

    <?php 

if (isset($lista_comision)) {
    $c=1;
    foreach ($lista_comision as $row) { 
        if($row->aplica_comision==1) {
            $ch='checked';
        }  else{
            $ch='';
        } 

        
        ?>
    <tr>
        <td><?php echo $row->solicitud; ?></td>
        <td><?php echo  date('d/m/Y', strtotime($row->creacion)); ?></td>
        <td><?php echo $row->consignado_a; ?></td>
        <td><?php echo $row->nombre_mensajero; ?></td>
        <td><?php echo $row->lugar; ?></td>
        <td><?php echo $row->valor_comision; ?></td>
        <td><?php echo $row->detalle; ?></td>


        <th scope="row">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="<?php echo 'chk'.$c?>" value="checked" <?=$ch?>>

            </div>
        </th>
      

        <td>
            <a href='#cambiar_comisionModal' onclick="detalle()" class="btn btn-default btn-xs" data-id=""
                data-toggle="modal" data-book-id="<?php echo  $row->solicitud; ?>"
                data-book-id1="<?php echo $row->valor_comision; ?>" data-book-id2="<?php echo  $row->detalle; ?>">
                <i class="glyphicon glyphicon-edit"></i></a>

        </td>
    </tr>
    <?php
     $c=$c+1;
    }
   
    }
?>

    <div class="modal fade" id="comisionModal" role="dialog" data-backdrop="static">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">COMISIONES</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="desde">Desde</label>
                                    <input type="date" id="desde" name="desde" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="hasta">Hasta</label>
                                    <input type="date" id="hasta" name="hasta" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="mensajero_comision">Mensajero</label>
                                    <select name="mensajero_comision" id="mensajero_comision"
                                        class="form-control chosen  " data-placeholder="Seleccione...">
                                        <option value=""></option>
                                        <?php foreach ($mensajero as $row): ?>
                                        <option value="<?php echo $row->mensajero; ?>">
                                            <?php echo  $row->mensajero.' - '.$row->nombre; ?>
                                        </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" name="Save" class="btn btn-success" onclick="lista_comision()"><span
                            class="glyphicon glyphicon-filter"></span>
                        Filtrar</button>

                    <button type="button" class="btn btn-default" data-dismiss="modal"><span
                            class="glyphicon glyphicon-log-out"></span> Cerrar</button>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="precioModal" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Cambiar valor comisiones</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="valor">Valor</label>
                                <input type="number" id="valor" name="valor" class="form-control" required min="0"
                                    step="0.01">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="Save" class="btn btn-success" onclick="autoriza_pago()"><span
                            class="glyphicon glyphicon-ok"></span>
                        Aplicar</button>

                    <button type="button" class="btn btn-default" data-dismiss="modal"><span
                            class="glyphicon glyphicon-log-out"></span> Cancelar</button>
                </div>

            </div>

        </div>
    </div>

    <div class="modal fade" id="cambiar_comisionModal" role="dialog" data-backdrop="static">
        <div class="modal-dialog ">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Cambiar valor comisiones</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="idsolicitud" name="idsolicitud" class="form-control">
                    <div class="container-fluid">

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="valor">Valor</label>
                                <input type="number" id="valorcomision" name="valorcomision" class="form-control"
                                    required min="0" step="0.01">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="detalle">Detalle</label>
                                <input type="text" id="detalle" name="detalle" class="form-control" required>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="Save" class="btn btn-success" onclick="agregar_detalle()"><span
                            class="glyphicon glyphicon-ok"></span>
                        Aplicar</button>

                    <button type="button" class="btn btn-default" data-dismiss="modal"><span
                            class="glyphicon glyphicon-log-out"></span> Cancelar</button>
                </div>

            </div>

        </div>
    </div>

</body>

</html>