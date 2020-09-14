<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">


    <title>Mensajeros</title>
</head>

<body>


    <div class="panel panel-default" id="editar">
        <div class="panel-heading" id="titulo">
            <i class="glyphicon glyphicon-edit"></i> Editar
            <button class="btn btn-danger btn-xs pull-right" onclick="cerrarform('editar')"><i
                    class="glyphicon glyphicon-remove"></i></button>
        </div>
        <div class="panel-body" id="contenidoeditar">
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading" id="titulo">
            Lista
        </div>
        <div class="panel-body" id="contenido">
            <table class="table">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody id="contenidoLista">

                </tbody>
            </table>
        </div>
    </div>
    <script>
    mensajero_lista();
    </script>
</body>

</html>