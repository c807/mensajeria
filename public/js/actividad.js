function base_url(url) {
    return window.location.origin + "/grupo_c807/mensajeria/" + url;
}

function actividad_lista() {
    var url = base_url("index.php/mantenimiento/Actividad/listado");
    $.post(url, function(data) {
        document.getElementById("contenidoLista").innerHTML = data;
    });
}

function openform_actividad(id) {
    $("#editar").show("blind");

    var url = base_url("index.php/mantenimiento/Actividad/ver/" + id);

    $.post(url, function(data) {
        $("#contenidoeditar").html(data);
    });
}

function actividad_guardar() {
    var formData;
    var valido = "S";
    url_destino = "index.php/mantenimiento/Actividad/guardar/";
    formData = new FormData($(".formActividad")[0]);
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
                $.notify("Actividad ha sido guardada con exito", "success");
                actividad_lista();
            },
        });
    }
}

function modal_eliminar_actividad(id) {
    $("#deleteActividad").modal("show");
    $("#actividad").val(id);
    document.getElementById("id").innerHTML = "ID: " + id;

}
/* eliminar item del formuñlario para los Items */
function eliminar_actividad() {
    var url = base_url(
        "index.php/mantenimiento/Actividad/eliminar_actividad/" + $("#actividad").val()
    );
    $.post(url, function(data) {
        $("#actividad").val("");
        $('#deleteActividad').modal('hide')
        actividad_lista();

        $.notify("Actividad ha sido eliminada con exito", "success");
    });
}