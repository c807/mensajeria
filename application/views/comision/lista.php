<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Solicitud</title>
</head>

<body>
<input type="hidden" id="desde1" name="desde1" class="form-control" >
<input type="hidden" id="hasta1" name="hasta1" class="form-control" >
<input type="hidden" id="mensajero_comision1" name="mensajero_comision1" class="form-control" >


    <div class="panel panel-default ">
        <div class="panel-heading" id="titulo">
            Lista Comisiones
        </div>
        <div class="panel-body" id="contenido">
            <table class="table" id="tabla_comisiones">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha Solicitud</th>
                        <th>Cliente</th>
                        <th>Mensajero</th>
                        <th>Lugar</th>
                        <th>Valor</th>
                        <th>Detalle</th>
                        <th></th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody id="contenidoLista">

                </tbody>
            </table>
        </div>
    </div>

    <script>
    // lista_comisiones();
    comision_lista();
    //get_fila_comision();
    </script>
</body>

</html>