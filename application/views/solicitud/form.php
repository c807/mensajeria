<style>
    .padding-0 {
        padding-right: 0;
        padding-left: 0;
    }

    .borde {
        border-right: 8px solid #fff;
    }

    label {
        display: block;
        width: x;
        height: y;
        text-align: left;
        padding-top: 4px;
        padding-right: 0;
        padding-left: 0;
    }
</style>
<?php

$codigo = "";
$nombre = "";
$cobrada = 0;

$idsolicitud = "";
$id_file = "";
$fecha_solicitud = "";
$solicitado_por = "";
$idproceso = "";
$cobrada = "";
$justificacion = "";
$fecha_sugerida = "";
$idprioridad = "";
$idactividad = "";
$horasugerida = "";
$documento = "";
$valor = "";
$consignadoa = "";
$lugar = "";
$contacto = "";
$direccion = "";
$idturno = "";
$idzona = "";
$nota = "";
$recibidopor = "";
$fecha_recibido = "";
$aceptada = "";
$motivo_rechazo = "";
$idtipo = "";
$idmensajero = "";
$nombre_mensajero = "";
$fecha_entrega = "";
$hora_entrega = "";
$fecha_entrega = "";
$liquidada_por = "";
$fecha_liquidada = "";
$hora_liquidada = "";
$nota_ent_mensajero = "";
$nota_liquidacion = "";
$fecha_ent_mensajero = "";
$fecha_liquidacion = "";
if (isset($file)) {
    $id_file = $file->c807_file;
}
if (isset($datos_solicitud)) {
    $idsolicitud = $datos_solicitud->solicitud;
    $id_file = $datos_solicitud->file;
    $fecha_solicitud = date('d/m/Y H:i', strtotime($datos_solicitud->creacion));
    $solicitado_por = $datos_solicitud->usuario;
    $idproceso = $datos_solicitud->idproceso;
    $cobrada = $datos_solicitud->cobrada;
    $justificacion = $datos_solicitud->justificacion;
    $fecha_sugerida = $datos_solicitud->fecha_sugerida;
    $idprioridad = $datos_solicitud->prioridad;
    $idactividad = $datos_solicitud->actividad;
    $horasugerida = $datos_solicitud->hora_sugerida;
    $documento = $datos_solicitud->documento;
    $valor = $datos_solicitud->costo;
    $consignadoa = $datos_solicitud->consignado_a;
    $lugar = $datos_solicitud->lugar;
    $contacto = $datos_solicitud->contacto;
    $direccion = $datos_solicitud->direccion;
    $idturno = $datos_solicitud->idturno;
    $idzona = $datos_solicitud->idzona;
    $nota = $datos_solicitud->observaciones;
    $recibidopor = $datos_solicitud->recibidopor;

    if (is_null($datos_solicitud->fecha_recibido)){
        $fecha_recibido = "mm/dd/yyy";
    }else{
        $fecha_recibido = date('d/m/Y H:i', strtotime($datos_solicitud->fecha_recibido));
    }
   
    $aceptada = $datos_solicitud->aceptada;
    $motivo_rechazo = $datos_solicitud->motivo_rechazo;
    $idtipo = $datos_solicitud->idtipo;
    $idmensajero = $datos_solicitud->mensajero;
    $nombre_mensajero = $datos_solicitud->nombre_mensajero;
    if (is_null($datos_solicitud->fecha_entrega)) {
        $fecha_entrega = "mm/dd/yyy";
    } else {
        $fecha_entrega = date('Y-m-d', strtotime($datos_solicitud->fecha_entrega));
    }
    $hora_entrega = $datos_solicitud->hora_entrega;
    $liquidada_por = $datos_solicitud->liquidada_por;

    if (is_null($datos_solicitud->fecha_liquidada)){
        $fecha_liquidada = "mm/dd/yyy";
    }else{
        $fecha_liquidada = date('Y-m-d', strtotime($datos_solicitud->fecha_liquidada));
    }
    
    $hora_liquidada = $datos_solicitud->hora_liquidada;
    $nota_ent_mensajero = $datos_solicitud->nota_ent_mensajero;
    $nota_liquidacion = $datos_solicitud->nota_liquidacion;

    if (is_null($datos_solicitud->fecha_ent_mensajero)){
        $fecha_ent_mensajero = "mm/dd/yyy";
    }else{
        $fecha_ent_mensajero = date('d/m/Y H:i', strtotime($datos_solicitud->fecha_ent_mensajero));
    }

    if (is_null($datos_solicitud->fecha_liquidacion)){
        $fecha_liquidacion = "mm/dd/yyy";
    }else{
        $fecha_liquidacion = date('d/m/Y H:i', strtotime($datos_solicitud->fecha_liquidacion));
    }
    
   
}
?>


<div class="container-fluid well well-sm">
    <form enctype="multipart/form-data" class="formsolicitud form-horizontal" id="formsolicitud" action="javascript:mensajero_guardar()">

        <input type="hidden" id="idsolicitud" name="idsolicitud" class="form-control" value="<?php echo $idsolicitud; ?>">

        <div class="col-sm-12">

            <div class="form-group">
                <div class="col-sm-12 bg-hd borde">
                    <h5>SOLICITADO POR</h5>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group ">

                    <label class="col-md-2 lbl" for="file">File:</label>
                    <div class="col-sm-4 ">
                        <input type="text" id="file" name="file" class="form-control" value="<?php echo $id_file; ?>" disabled>
                    </div>

                    <label class="col-md-1 " for="fecha_solicitud" style="padding-left:0px">Fecha:</label>
                    <div class="col-sm-5">
                        <input type="text" id="fecha_solicitud" name="fecha_solicitud" class="form-control" value="<?php echo $fecha_solicitud; ?>" readonly>
                    </div>

                </div>

                <div class="form-group">
                    <input type="hidden" id="idproceso" value="<?php echo $idproceso; ?>">
                    <label class="col-sm-2 lbl" for="proceso">Proceso:</label>
                    <div class="col-sm-10">
                        <select name="proceso" id="proceso" class="form-control chosen" data-placeholder="Seleccione...">
                            <option value=""></option>
                            <?php foreach ($proceso as $row) : ?>
                                <option value="<?php echo $row->id; ?>">
                                    <?php echo  $row->id . ' - ' . $row->nombre; ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <input type="hidden" id="idcolaborador" value="<?php echo $solicitado_por; ?>">
                    <label class="col-sm-2 lbl" for="colaborador">Nombre:</label>
                    <div class="col-sm-10">
                        <select name="colaborador" id="colaborador" class="form-control chosen" data-placeholder="Seleccione...">
                            <option value=""></option>
                            <?php foreach ($colaborador as $row) : ?>
                                <option value="<?php echo $row->usuario; ?>">
                                    <?php echo  $row->usuario . ' - ' . $row->nombre; ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>

            </div>
            <div class="col-sm-6">

                <div class="form-group">

                    <label class="col-sm-2 lbl" for="fecha_recibe">Fecha Sugerida:</label>
                    <div class="col-sm-5">
                        <input type="date" id="fecha_sugerida" name="fecha_sugerida" class="form-control" value="<?php echo $fecha_sugerida; ?>" required>
                    </div>

                    <label class="col-sm-2 lbl" for="hora_sugerida">Hora:</label>
                    <div class="col-sm-3">
                        <input type="time" id="hora_sugerida" name="hora_sugerida" class="form-control" style="padding-left:0px" value="<?php echo $horasugerida; ?>" required>
                    </div>
                </div>

            </div>

            <div class="col-sm-12 bg-hd text-center">
                <h5>SERVICIO SOLICITADO</h5>
            </div>

            <div class="col-sm-6">
                <br>
                <div class="form-group">
                    <input type="hidden" id="idprioridad" value="<?php echo $idprioridad; ?>">
                    <label class="col-sm-2 lbl" for="prioridad"> Prioridad: </label>
                    <div class="col-sm-10">
                        <select name="prioridad" id="prioridad" class="form-control chosen" data-placeholder="Seleccione...">
                            <option value=""></option>
                            <?php foreach ($prioridad as $row) : ?>
                                <option value="<?php echo $row->prioridad; ?>">
                                    <?php echo  $row->prioridad . ' - ' . $row->descripcion; ?>
                                </option>
                            <?php endforeach ?>
                        </select>

                    </div>
                </div>
                <div class="form-group">

                    <label class="col-sm-2 " for="cobrada"></label>
                    <div class="col-sm-2">
                        <div class="checkbox">

                            <label> <input name="cobrada" id="cobrada" type="checkbox" <?php if ($cobrada == 1) {
                                                                                            echo "checked='checked'";
                                                                                        } ?>>Cobrada </label>

                        </div>
                    </div>

                    <label class="col-sm-1 lbl " for="valor"></label>
                    <div class="col-sm-4">
                        <input type="text" id="valor" name="valor" class="form-control text-right" value="<?php echo $valor; ?>" placeholder="0.00" disabled>
                    </div>

                </div>

                <div class="form-group">
                    <label class="col-sm-2 " for="justificacion">Justificación</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="2" id="justificacion" name="justificacion" placeholder="Justificación"  maxlength="120" disabled><?php echo $justificacion; ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 lbl" for="actividad">Actividad:</label>
                    <div class="col-sm-10">
                        <input type="hidden" id="idactividad" value="<?php echo $idactividad; ?>">
                        <!-- <select name="actividad[]" id="actividad" class="form-control chosen" multiple="true">-->
                        <select name="actividad" id="actividad" class="form-control chosen">
                            data-placeholder="Seleccione...">
                            <option value=""></option>
                            <?php foreach ($actividad as $row) : ?>
                                <option value="<?php echo $row->actividad; ?>">
                                    <?php echo  $row->actividad . ' - ' . $row->descripcion; ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                        <div id="result"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 lbl" for="documento">Documento:</label>
                    <div class="col-sm-8">
                        <input type="text" id="documento" name="documento" class="form-control" value="<?php echo $documento; ?>" required placeholder="Introduzca número de documento" disabled maxlength="45">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 lbl" for="consignado_a">Consignado a:</label>
                    <div class="col-sm-10">
                        <input type="text" id="consignado_a" name="consignado_a" class="form-control" value="<?php echo $consignadoa; ?>" required placeholder="Consignado a..." maxlength="100">
                    </div>
                </div>

            </div>

            <div class="col-sm-6">
                <br>
                <div class="form-group">
                    <label class="col-sm-2 lbl" for="lugar">Lugar:</label>
                    <div class="col-sm-10">
                        <input type="text" id="lugar" name="lugar" class="form-control" value="<?php echo $lugar; ?>" required placeholder="Introduzca lugar de retiro" maxlength="120">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 lbl" for="contacto">Contacto:</label>
                    <div class="col-sm-10">
                        <input type="text" id="contacto" name="contacto" class="form-control" value="<?php echo $contacto; ?>" required placeholder="Introduzca contacto" maxlength="100">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 lbl" for="direccion">Dirección:</label>
                    <div class="col-sm-10">
                        <input type="text" id="direccion" name="direccion" class="form-control" value="<?php echo $direccion; ?>" required placeholder="Introduzca dirección" maxlength="120">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 lbl" for="turno">Turno:</label>
                    <div class="col-sm-4">
                        <input type="hidden" id="idturno" value="<?php echo $idturno; ?>">
                        <select name="turno" id="turno" class="form-control chosen" data-placeholder="Seleccione...">
                            <option value=""></option>
                            <?php foreach ($turno as $row) : ?>
                                <option value="<?php echo $row->idturno; ?>">
                                    <?php echo  $row->idturno . ' - ' . $row->descripcion; ?>
                                </option>
                            <?php endforeach ?>
                        </select>

                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-sm-2 lbl">Notas:</div>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="2" id="observaciones" name="observaciones" placeholder="Observaciones" maxlength="120"><?php echo $nota; ?></textarea>
                    </div>
                </div>

            </div>

            <div class="row"> </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <div class="col-sm-12 bg-hd">
                        <h5>RECIBIDO EN TRANSPORTE POR:</h5>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-2 lbl" for="recibido_por">Nombre:</label>
                    <div class="col-sm-10">
                        <input type="text" id="recibido_por" name="recibido_por" class="form-control" readonly value="<?php echo $recibidopor; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 lbl" for="fecha_recibe">Fecha: </label>
                    <div class="col-sm-5">
                        <input type="text" id="fecha_recibe" name="fecha_recibe" class="form-control" value="<?php echo $fecha_recibido; ?>" required readonly>
                    </div>
                </div>

                <div class="form-group">

                    <label class="col-sm-2 "></label>
                    <div class="col-sm-8">

                        <label class="radio-inline">
                            <input type="radio" name="aceptar" id="aceptar" value="1" <?php echo ($aceptada == 1 ? "checked" : ""); ?> />
                            Aceptada</label>

                        <label class="radio-inline">
                            <input type="radio" name="aceptar" id="aceptar" value="0" <?php echo ($aceptada == 0 ? "checked" : ""); ?> />
                            Rechazada</label>

                    </div>

                </div>

                <div class="form-group">
                    <label class="col-sm-2 lbl" for="motivo_rechazo">Motivo:</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" rows="2" id="motivo_rechazo" name="motivo_rechazo" placeholder="Motivo de rechazo" maxlength="100"><?php echo $motivo_rechazo; ?></textarea>

                    </div>
                </div>


            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <div class="col-sm-12 bg-hd">
                        <h5>ASIGNACION:</h5>
                    </div>
                </div>
                <div class="form-group">

                    <label class="col-sm-2" for="tipo_viaje">Tipo:</label>
                    <div class="col-sm-10">
                        <input type="hidden" id="idtipo" value="<?php echo $idtipo; ?>">
                        <select name="tipo_viaje" id="tipo_viaje" class="form-control chosen" data-placeholder="Seleccione...">
                            <option value=""></option>
                            <?php foreach ($tipo as $row) : ?>
                                <option value="<?php echo $row->idtipo; ?>">
                                    <?php echo  $row->idtipo . ' - ' . $row->descripcion; ?>
                                </option>
                            <?php endforeach ?>
                        </select>

                    </div>
                </div>



                <div class="form-group">
                    <label class="col-sm-2 lbl" for="mensajero">Mensajero:</label>
                    <div class="col-sm-10">
                        <input type="hidden" id="idmensajero" value="<?php echo $idmensajero; ?>">
                        <select name="mensajero" id="mensajero" class="form-control chosen" data-placeholder="Seleccione...">
                            <option value=""></option>
                            <?php foreach ($mensajero as $row) : ?>
                                <option value="<?php echo $row->mensajero; ?>">
                                    <?php echo  $row->mensajero . ' - ' . $row->nombre; ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 lbl" for="zona">Zona:</label>
                    <div class="col-sm-10">
                        <input type="hidden" id="idzona" value="<?php echo $idzona; ?>">
                        <select name="zona" id="zona" class="form-control chosen" data-placeholder="Seleccione...">
                            <option value=""></option>
                            <?php foreach ($zona as $row) : ?>
                                <option value="<?php echo $row->idzona; ?>">
                                    <?php echo  $row->idzona . ' - ' . $row->nombre; ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>


            </div>

            <div class="row"></div>



            <div class="col-sm-6">

                <div class="form-group">
                    <div class="col-sm-12 bg-hd borde">
                        <h5>LIQUIDACION MENSAJERO</h5>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 lbl" for="nombre_mensajero">Mensajero:</label>
                    <div class="col-sm-10">
                        <input type="text" id="nombre_mensajero" name="nombre_mensajero" class="form-control" value="<?php echo $nombre_mensajero; ?>" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 lbl" for="fecha_entrega">Fecha:</label>
                    <div class="col-sm-5">
                        <input type="date" id="fecha_entrega" name="fecha_entrega" class="form-control" value="<?php echo $fecha_entrega; ?>" required>
                    </div>

                    <label class="col-sm-2 lbl" for="hora_entrega">Hora:</label>
                    <div class="col-sm-3">
                        <input type="time" id="hora_entrega" name="hora_entrega" class="form-control" style="padding-left:0px" value="<?php echo $hora_entrega; ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 lbl" for="nota_ent_mensajero"></label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="2" id="nota_ent_mensajero" name="nota_ent_mensajero" placeholder="Observaciones" maxlength="100"><?php echo $nota_ent_mensajero; ?></textarea>

                    </div>
                </div>

                <div class="form-group ">
                    <label class="col-sm-2 lbl" for="fecha_ent_mensajero">Fecha:</label>
                    <div class="col-sm-5">
                        <input type="text" id="fecha_ent_mensajero" name="fecha_ent_mensajero" class="form-control" value="<?php echo $fecha_ent_mensajero; ?>" readonly>
                    </div>

                </div>
            </div>


            <div class="col-sm-6">

                <div class="form-group">
                    <div class="col-sm-12 bg-hd">
                        <h5>LIQUIDACION SOLICITANTE</h5>
                    </div>
                </div>

                <div class="form-group">
                    <input type="hidden" id="idliquidada_por" value="<?php echo $liquidada_por; ?>">
                    <label class="col-sm-2 lbl" for="liquidada_por">Nombre:</label>
                    <div class="col-sm-10">
                        <select name="liquidada_por" id="liquidada_por" class="form-control chosen" data-placeholder="Seleccione...">
                            <option value=""></option>
                            <?php foreach ($colaborador as $row) : ?>
                                <option value="<?php echo $row->usuario; ?>">
                                    <?php echo  $row->usuario . ' - ' . $row->nombre; ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>


                <div class="form-group">

                    <label class="col-sm-2 lbl" for="fecha_liquidada">Fecha:</label>
                    <div class="col-sm-5">
                        <input type="date" id="fecha_liquidada" name="fecha_liquidada" class="form-control" value="<?php echo $fecha_liquidada; ?>">
                    </div>

                    <label class="col-sm-2 lbl" for="hora_liquida">Hora:</label>
                    <div class="col-sm-3">
                        <input type="time" id="hora_liquidada" name="hora_liquidada" class="form-control" style="padding-left:0px" value="<?php echo $hora_liquidada; ?>">
                    </div>

                </div>

                <div class="form-group">
                    <label class="col-sm-2 lbl" for="nota_liquidacion"></label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="2" id="nota_liquidacion" name="nota_liquidacion" placeholder="Observaciones" maxlength="100"><?php echo $nota_liquidacion; ?></textarea>

                    </div>
                </div>
                <div class="form-group ">
                    <label class="col-sm-2 lbl" for="fecha_liquidacion">Fecha:</label>
                    <div class="col-sm-5">
                        <input type="text" id="fecha_liquidacion" name="fecha_liquidacion" class="form-control" value="<?php echo $fecha_liquidacion; ?>" readonly>
                    </div>

                </div>

            </div>


    </form>

</div>

<div class="row">

    <div class="col-md-12 text-center">
        <button class="btn btn-success btn-sm" id="btn1" onclick="crear_solicitud(1)"><i class="glyphicon glyphicon-ok"></i>
            Guardar</button>

        <button class="btn btn-primary btn-sm" id="btn2" onclick="aceptar_rechazar()"><i class="glyphicon glyphicon-ok"></i>
            Guardar</button>

        <button class="btn btn-primary btn-sm" id="btn3" onclick="asignar_mensajero()"><i class="glyphicon glyphicon-ok"></i>
            Guardar</button>

        <button class="btn btn-primary btn-sm" id="btn4" onclick="entregado_mensajero()"><i class="glyphicon glyphicon-ok"></i>
            Guardar</button>

        <button class="btn btn-primary btn-sm" id="btn5" onclick="liquidar()"><i class="glyphicon glyphicon-ok"></i>
            Guardar</button>

        <button class="btn btn-default btn-sm" onclick="cerrarform('form_solicitud')"><i class="glyphicon glyphicon-ok"></i>
            Cancelar</button>
    </div>

</div>

<script>
    $(".chosen").chosen({
        width: "100%"

    });

    validar();
</script>