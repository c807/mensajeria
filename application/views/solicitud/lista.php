<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Solicitud</title>
</head>

<body>

<input type="hidden" value="<?php echo $opc['opcion']; ?>" id="opcion" name="opcion">
<input type="hidden" value="<?php echo $opc['id']; ?>" id="id" name="id">

    <div class="panel panel-default" id="form_solicitud">
        <div class="panel-heading" id="titulo">
            <i class="glyphicon glyphicon-edit"></i> Editar
            <button class="btn btn-danger btn-xs pull-right" onclick="cerrarform('form_solicitud')"><i
                    class="glyphicon glyphicon-remove"></i></button>
        </div>
        <div class="panel-body" id="contenidoeditar">
        </div>
    </div>

    <div class="panel panel-default" id="lst_solicitud">
        <div class="panel-heading" id="titulo">
            Lista solicitudes
        </div>
        <div class="panel-body" id="contenido">
            <table class="table" id="tabla_solicitudes">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha Solicitud</th>
                        <th>Solicitado por</th>
                        <th>Cliente</th>
                        <th>Lugar</th>
                        <th>Requerimiento</th>
                        <th>Mensajero</th>
                        <th>Estatus</th>
                        <th></th>
                        <th colspan="3" style="text-align:center">Acción</th>
                    </tr>
                </thead>
                <tbody id="contenidoLista">

                </tbody>
            </table>
        </div>
    </div>
   
    <script>
   
    solicitud_lista();
   // get_fila();
    </script>
</body>

</html>