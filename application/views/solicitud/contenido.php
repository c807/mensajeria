<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">



    <title>Solicitud</title>
</head>

<body>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <form class="navbar-form navbar-left" action="" method="post" id="formter">
            <input type="hidden" id="inicio" value="0" name="inicio">
            <div class="form-group"></div>
        </form>
        <button type="button" class="btn btn-default navbar-btn btn-sm" onclick="openform_solicitud(1,1)">
            <i class="glyphicon glyphicon-plus"></i> Nuevo
        </button>

        <button type="button" class="btn btn-primary navbar-btn btn-sm" onclick="solicitud_lista()">
            <i class="glyphicon glyphicon-tasks"></i> Pendientes
        </button>

        <button type="button" class="btn btn-primary navbar-btn btn-sm" data-toggle="modal"
            data-target="#filtrarModal"><i class="glyphicon glyphicon-filter"></i> Filtrar
        </button>

        <button type="button" class="btn btn-primary navbar-btn btn-sm" data-toggle="modal"
            data-target="#manifiestoModal" id="crear_manifiesto"> <i class="glyphicon glyphicon-th-list" ></i> Manifiesto
        </button>
            
        <button type="button" class="btn btn-primary navbar-btn btn-sm" id="no_facturados" onclick="pendientes_facturar()"><i
                class="glyphicon glyphicon-usd"></i> Pendientes de facturar
        </button>

        <button type="button" class="btn btn-primary navbar-btn btn-sm" data-toggle="modal"
            data-target="#imprimirModal" id="print_manifiesto"> <i class="glyphicon glyphicon-print" ></i> Imprimir
        </button>

    </div>


</body>

</html>