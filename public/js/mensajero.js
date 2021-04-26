function base_url(url) {
    return window.location.origin + "/grupo_c807/mensajeria/" + url;
}

function mensajero_lista() {
    var url = base_url("index.php/mantenimiento/Mensajero/listado");
    //cargando('contenidoLista');

    $.post(url, function(data) {
        document.getElementById("contenidoLista").innerHTML = data;
    });
}

function openform(id) {
    $("#editar").show("blind");

    var url = base_url("index.php/mantenimiento/Mensajero/ver/" + id);

    $.post(url, function(data) {
        $("#contenidoeditar").html(data);
    });
}

function mensajero_guardar() {
    var formData;
    var valido = "S";
    url_destino = "index.php/mantenimiento/Mensajero/guardar/";
    formData = new FormData($(".formMensajero")[0]);
    if (valido == "S") {
        var message = "";
        $.ajax({
            url: base_url(url_destino),
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                $("#nombre").val("");
                $.notify("Mensajero ha sido guardado con exito", "success");
                mensajero_lista();
            },
        });
    }
}

function modal_eliminar(id) {
    $("#deleteMensajero").modal("show");
    $("#mensajero").val(id);
    document.getElementById("id").innerHTML = "ID: " + id;

}
/* eliminar item del formuñlario para los Items */
function eliminar_mensajero() {
    var url = base_url(
        "index.php/mantenimiento/Mensajero/eliminar_mensajero/" + $("#mensajero").val()
    );
    $.post(url, function(data) {
        $("#mensajero").val("");
        $('#deleteMensajero').modal('hide')
        mensajero_lista();

        $.notify("Mensajero ha sido eliminado con exito", "success");
    });
}