<?php 

$codigo = "";
$nombre = "";

if (isset($result)){
	$codigo = $result->idruta;
	$nombre = $result->nombre;
}
?>
<div class="row">
	<p id="msg"> </p>
    <div class="col-sm-12">
        <div class="well well-sm" id="result-bita">
            <div class="container-fluid">
                <form enctype="multipart/form-data" class="formRuta" id="formRuta"
                    action="javascript:ruta_guardar()">

                    <input type="hidden" id="ruta" name="ruta" class="form-control"
                        value="<?php echo $codigo; ?>">

                    <div class="form-group col-md-6">
                        <label for="nombre">Nombre: </label>
                        <input type="text" id="nombre" name="nombre" class="form-control"
                            value="<?php echo $nombre; ?>" required>
                    </div>
                    <div class="form-group col-sm-12">
                        <button class="btn btn-success btn-sm"><i class="glyphicon glyphicon-ok"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
