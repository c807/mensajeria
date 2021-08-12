
    <div class="modal fade" id="filtrarModal" role="dialog" data-backdrop="static">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Filtrar </h4>
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
                                    <select name="mensajero_filtro" id="mensajero_filtro"
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
                                    <label for="lst_estatus">Mensajero</label>
                                    <select name="lst_estatus" id="lst_estatus"
                                        class="form-control chosen  " data-placeholder="Seleccione...">
                                        <option value=""></option>
                                        <?php foreach ($estatus as $row): ?>
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

    
