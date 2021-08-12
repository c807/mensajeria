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
if (isset($lista_solicitud)) {
    $c=1;
    foreach ($lista_solicitud as $row) { ?>
    <?php if ($row->nombre_estatus=="Solicitud") {?>

    <tr style="background:#3D6654; color:yellow">
        <td><?php echo $row->solicitud; ?></td>
        <td><?php echo  date('d/m/Y', strtotime($row->creacion)); ?></td>
        <td><?php echo $row->solicitado_por; ?></td>
        <td><?php echo $row->consignado_a; ?></td>
        <td><?php echo $row->lugar; ?></td>
        <td><?php echo $row->nombre_actividad; ?></td>
        <td><?php echo $row->nombre_mensajero; ?></td>
        <td><?php echo $row->nombre_estatus; ?></td>
        <th scope="row">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="<?php echo 'chk'.$c?>">
                <label class="custom-control-label" for="tableDefaultCheck4"></label>
            </div>
        </th>

        <?php
    } else {
        ?>
    <tr>
        <td><?php echo $row->solicitud; ?></td>
        <td><?php echo  date('d/m/Y', strtotime($row->creacion)); ?></td>
        <td><?php echo $row->solicitado_por; ?></td>
        <td><?php echo $row->consignado_a; ?></td>
        <td><?php echo $row->lugar; ?></td>
        <td><?php echo $row->nombre_actividad; ?></td>
        <td><?php echo $row->nombre_mensajero; ?></td>
        <td><?php echo $row->nombre_estatus; ?></td>
        <th scope="row">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="<?php echo 'chk'.$c?>">
                <label class="custom-control-label" for="tableDefaultCheck4"></label>
            </div>
        </th>


        <?php
        }
        $c=$c+1;
     ?>
        <td style="color:#1633c0;font-weight: bold;"></td>
        <td>
            <div class="btn-group">
                <button class="btn btn-default btn-xs dropdown-toggle" type="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                </button>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="javascript:;" onclick="openform_solicitud(6,'<?php echo "$row->solicitud"; ?>')">Editar
                            Solicitud</a></li>
                    <li><a href="javascript:;"
                            onclick="openform_solicitud(2,'<?php echo "$row->solicitud"; ?>')">Aceptar
                            / Rechazar</a></li>
                    <li><a href="javascript:;"
                            onclick="openform_solicitud(3,'<?php echo "{$row->solicitud}"; ?>')">Asignar
                            Mensajero</a></li>

                    <li><a href="javascript:;"
                            onclick="openform_solicitud(4,'<?php echo "{$row->solicitud}"; ?>')">Liquidación
                            Mensajero</a></li>

                    <li><a href="javascript:;"
                            onclick="openform_solicitud(5,'<?php echo "{$row->solicitud}"; ?>')">Liquidación
                            Solicitante</a></li>

                    <li><a href="javascript:;"
                            onclick="imprimir_solicitud('<?php echo "{$row->solicitud}"; ?>')">Imprimir Solicitud</a>
                    </li>

                </ul>

        </td>
        <td nowrap>
            <a href='#' onclick="enruta('<?php echo $row->solicitud; ?>')" class="btn btn-default btn-xs"
                title="Estatus en ruta" data-id="" style="margin-left:3px">
                <i class="glyphicon glyphicon-repeat"></i></a>

            <a href='#' onclick="lista_estatus('<?php echo $row->solicitud; ?>')" class="btn btn-default btn-xs"
                title="Bitácora" data-id="" style="margin-left:3px">
                <i class="glyphicon glyphicon-th-list"></i></a>

            <a href='#' onclick="mostrar_modal_confirmacion('<?php echo $row->solicitud; ?>','<?php echo $row->costo   ; ?>')" class="btn btn-default btn-xs"
                title="Confirmar facturación" data-id="" >
                <i class="glyphicon glyphicon-usd"></i></a>    
        </td>

    </tr>
    <?php
}
}

?>

    <!--- modal Impresiones -->
    <div class="modal" id="imprimirModal" role="dialog" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Opciones de Impresión</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <select name="mensajero_re" id="mensajero_re" class="form-control chosen  "
                            data-placeholder="Seleccione...">
                            <option value=""></option>
                            <?php foreach ($mensajero as $row): ?>
                            <option value="<?php echo $row->mensajero; ?>">
                                <?php echo  $row->mensajero.' - '.$row->nombre; ?>
                            </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn btn-sm" onclick="lista_asignaciones()">
                        <i class="glyphicon glyphicon-print"></i> Imprimir
                    </button>
                    <button type="button" class="btn btn-default btn btn-sm" data-dismiss="modal"> <i
                            class="glyphicon glyphicon-log-out "> Cancelar</i></button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="enRutaModal" role="dialog" data-backdrop="static">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Cambiar Estatus</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_solicitud" id="id_solicitud" />
                    <input type="hidden" name="seleccionado" id="seleccionado" />
                    <div class="form-group">
                        <select name="estatus" id="estatus" class="form-control chosen  "
                            data-placeholder="Seleccione...">
                            <option value=""></option>
                            <?php foreach ($estatus as $row): ?>
                            <option value="<?php echo $row->estatus; ?>">
                                <?php echo  $row->estatus.' - '.$row->descripcion; ?>
                            </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="2" id="observacion" name="observacion"
                            placeholder="observaciones"><?php echo $nota_estatus; ?></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <div class="alert alert-success text-center " role="alert" id="msg" name="msg">
                            <strong> Aplicará estatus seleccionado a todas las solicitud que esten marcadas (&#10003)
                            </strong>
                        </div>
                    </div>
                    <button type="button" name="Save" class="btn btn-primary" onclick="cambiar_estatus()"><span
                            class="glyphicon glyphicon-ok"></span>
                        Guardar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i
                            class="glyphicon glyphicon-log-out "> Cancelar</i></button>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="manifiestoModal" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Manifiesto</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_solicitud" id="id_solicitud" />
                    <input type="hidden" name="seleccionado" id="seleccionado" />
                    <div class="form-group">
                        <select name="manifiesto" id="manifiesto" class="form-control chosen  "
                            data-placeholder="Seleccione...">
                            <option value=""></option>
                            <?php foreach ($mensajero as $row): ?>
                            <option value="<?php echo $row->mensajero; ?>">
                                <?php echo  $row->mensajero.' - '.$row->nombre; ?>
                            </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" name="Save" class="btn btn-primary" onclick="crear_manifiesto()"><span
                            class="glyphicon glyphicon-ok"></span>
                        Guardar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i
                            class="glyphicon glyphicon-log-out "> Cancelar</i></button>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade " id="modal_bitacora" role="dialog" data-backdrop="static">

        <div class="modal-dialog modal-dialog-centered  " role="document">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header" style="background-color:white">
                    <h4 class="modal-title">Bitacora</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div id="lista_estatus">
                        <?php $this->load->view('solicitud/lista_bitacora');?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i> Cerrar</i></button>
                </div>
                </form>
            </div>
        </div>

    </div>




    <div class="modal fade" id="filtrarModal" role="dialog" data-backdrop="static">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Filtrar</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">

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
                                <label for="mensajero_filtro">Mensajero</label>
                                <select name="mensajero_filtro" id="mensajero_filtro" required
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

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="estatus_filtro">Estatus</label>
                                <select name="estatus_filtro" id="estatus_filtro" required
                                    class="form-control chosen  " data-placeholder="Seleccione...">
                                    <option value=""></option>
                                    <?php foreach ($estatus_all as $row): ?>
                                    <option value="<?php echo $row->estatus; ?>">
                                        <?php echo  $row->estatus.' - '.$row->descripcion; ?>
                                    </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" name="Save" class="btn btn-success" onclick="filtro_solicitudes()"><span
                            class="glyphicon glyphicon-filter"></span>
                        Filtrar</button>

                    <button type="button" class="btn btn-default" data-dismiss="modal"><span
                            class="glyphicon glyphicon-log-out"></span> Cerrar</button>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmar_facturacionModal" role="dialog" data-backdrop="static">
        <div class="modal-dialog ">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Confirmar Facturación</h4>
                </div>
                <input type="hidden" id="id_confirmar" name="id_confirmar" class="form-control">
                <div class="modal-body">
                    <div class="form-group">
                        <p id="msg_confirma" name="msg_confirma"></p>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" name="Save" class="btn btn-success" onclick="confirmar_facturacion()"><span
                            class="glyphicon glyphicon-ok"></span>
                        Aceptar</button>

                    <button type="button" class="btn btn-default" data-dismiss="modal"><span
                            class="glyphicon glyphicon-log-out"></span> Cancelar</button>
                </div>

            </div>

        </div>
    </div>
</body>

</html>