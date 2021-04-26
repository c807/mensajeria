function base_url(url) {
    return window.location.origin + "/grupo_c807/mensajeria/" + url;
}

function ruta_lista() {
    var url = base_url("index.php/mantenimiento/Ruta/listado");
    $.post(url, function(data) {
        document.getElementById("contenidoLista").innerHTML = data;
    });
}

function openform_ruta(id) {
    $("#editar").show("blind");

    var url = base_url("index.php/mantenimiento/Ruta/ver_ruta/" + id);

    $.post(url, function(data) {
        $("#contenidoeditar").html(data);
    });
}

function ruta_guardar() {
    var formData;
    var valido = "S";
    url_destino = "index.php/mantenimiento/Ruta/guardar/";
    formData = new FormData($(".formRuta")[0]);
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
                $.notify("Ruta ha sido guardada con exito", "success");
                ruta_lista();
            },
        });
    }
}

function modal_eliminar_ruta(id) {
    $("#deleteRuta").modal("show");
    $("#ruta").val(id);
    document.getElementById("id").innerHTML = "ID: " + id;

}

function eliminar_ruta() {
    var url = base_url(
        "index.php/mantenimiento/Ruta/eliminar_ruta/" + $("#ruta").val()
    );
    $.post(url, function(data) {
        $("#ruta").val("");
        $('#deleteRuta').modal('hide')
        ruta_lista();

        $.notify("Ruta ha sido eliminada con exito", "success");
    });
}