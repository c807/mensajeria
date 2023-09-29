<?php if (isset($lista)) { ?>

<div class="form-group">

    <div class="table-responsive">

        <table class="table  table-striped  table-hover">

            <thead>

                <th class=" col-xs-6">Fecha</th>

                <th class=" col-xs-6">Estatus</th>

                <th class=" col-xs-6">Observaciones</th>

                <th class=" col-xs-6">Usuario</th>
   
            </thead>

            <tbody>

                <?php foreach ($lista as $row): ?>

                <tr>
                   
                    <td>
                        <?php echo  date('d-m-Y', strtotime($row->fecha)); ?>
                    </td>

                    <td>
                        <?php echo $row->nombre_estatus; ?>
                    </td>

                    <td>
                        <?php echo $row->observaciones; ?>
                    </td>

                    <td nowrap>
                        <?php echo $row->nombre_usuario; ?>
                    </td>

                </tr>

                <?php endforeach ?>

            </tbody>

        </table>
    </div>
</div>

<?php } ?>