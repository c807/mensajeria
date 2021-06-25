function base_url(url) {
    return window.location.origin + "/grupo_c807/mensajeria/" + url;
}

function comision_lista() {
    var url = base_url("index.php/comision/Comision/comision_lista");
    $.post(url, function(data) {
        document.getElementById("contenidoLista").innerHTML = data;
    });
}

function lista_comision() {
    var today = get_fecha();
    desde = $("#desde").val();
    hasta = $("#hasta").val();
    mensajero = $("#mensajero_comision").val();
    if (desde) {

    } else {
        $.notify("Error, selecciones fecha inicial ", "error");
        return false;
    }

    if (hasta) {

    } else {
        hasta = today;
    }
    $("#desde1").val(desde);
    $("#hasta1").val(hasta);
    $("#mensajero_comision1").val(mensajero);

    if (mensajero == "") {
        mensajero = 0;
    } else {}
    mostrarlista(desde, hasta, mensajero);

    $(".modal-backdrop").remove();
    $("#comisionModal").modal("hide");
}

function mostrarlista(desde, hasta, mensajero) {
    var url = base_url(
        "index.php/comision/Comision/listado_comisiones/" +
        desde +
        "/" +
        hasta +
        "/" +
        mensajero
    );
    $.get(url, function(data) {
        document.getElementById("contenidoLista").innerHTML = "";
        document.getElementById("contenidoLista").innerHTML = data;
    });
}

function autoriza_pago() {
    //si  encuentra varias filas marcadas entra aqui

    var filas = $("#tabla_comisiones").find("tr");

    opc = 0;
    for (i = 0; i < filas.length; i++) {
        //	alert(i)
        a = "chk" + opc;
        var celdas = $(filas[i]).find("td");
        solicitud = $(celdas[0]).text();
        valor = 0;
        if ($("#chk" + opc).is(":checked")) {
            valor = $("#valor").val();
            //	alert(solicitud);
        } else {
            valor = 0;
        }

        var url = base_url(
            "index.php/comision/Comision/autoriza_pago/" + solicitud + "/" + valor
        );
        $.ajax({
            url: url,
            data: $("form").serialize(),
            type: "POST",
            success: function(response) {
                if (response > 0) {
                    //$.notify("Los cambios han sido guardados", "success");
                } else {}
            },
            error: function(error) {
                $.notify("Error al intentar guardar ", "warning");
            },
        });
        opc = opc + 1;
    }


    mensajero = $("#mensajero_comision1").val();
    if (mensajero == "") {
        mensajero = 0;
    } else {}
    mostrarlista($("#desde1").val(), $("#hasta1").val(), mensajero);

    /*for (i = 0; i < filas.length; i++) {
    	var celdas = $(filas[i]).find("td");
    	solicitud = $(celdas[0]).text();
    	cheque = $(celdas[6]).text().trim();
    	valor = 0;
    	if (cheque == "X") {
    		valor = 0;
    	} else {
    		valor = $("#valor").val();
    	}
    	var url = base_url(
    		"index.php/comision/comision/autoriza_pago/" + solicitud + "/" + valor
    	);

    	$.ajax({
    		url: url,
    		data: $("form").serialize(),
    		type: "POST",
    		success: function (response) {
    			if (response > 0) {
    			} else {
    			}
    		},
    		error: function (error) {
    			$.notify("Error al intentar guardar ", "warning");
    		},
    	});
    	mensajero = $("#mensajero_comision1").val();
    	if (mensajero == "") {
    		mensajero = 0;
    	} else {
    	}
    	mostrarlista($("#desde1").val(), $("#hasta1").val(), mensajero);
    }*/
    $.notify("Los cambios han sido guardados", "success");
    $(".modal-backdrop").remove();
    $("#precioModal").modal("hide");
    //comision_lista();
    //listado_comisiones();

    cerrar_formulario();
}

function imprimir_comision() {
    desde = $("#desde1").val();
    hasta = $("#hasta1").val();
    mensajero = $("#mensajero_comision1").val();
    if (mensajero == "") {
        mensajero = 0;
    } else {}
    var url = base_url(
        "index.php/comision/Comision/imprimir_comision/" +
        desde +
        "/" +
        hasta +
        "/" +
        mensajero
    );
    $.get(url, function(data) {
        pdf_comision();
    });
}

function pdf_comision() {
    var url = "comision";
    window.open(
        base_url(url + ".pdf"),
        "ventana1",
        "width=600,height=600,scrollbars=no,toolbar=no, titlebar=no, menubar=no"
    );
}

function detalle() {
    $("#cambiar_comisionModal").on("show.bs.modal", function(e) {
        var bookId = $(e.relatedTarget).data("book-id");
        var bookId1 = $(e.relatedTarget).data("book-id1");
        var bookId2 = $(e.relatedTarget).data("book-id2");
        $(e.currentTarget).find('input[name="idsolicitud"]').val(bookId);
        $(e.currentTarget).find('input[name="valorcomision"]').val(bookId1);
        $(e.currentTarget).find('input[name="detalle"]').val(bookId2);
    });
}

function agregar_detalle() {
    deta = $("#detalle").val();
    solicitud = $("#idsolicitud").val();
    valor = $("#valorcomision").val();

    var url = base_url(
        "index.php/comision/Comision/agregar_detalle/" +
        solicitud +
        "/" +
        valor +
        "/" +
        deta
    );

    $.ajax({
        url: url,
        data: $("form").serialize(),
        type: "POST",
        success: function(response) {
            if (response > 0) {
                mensajero = $("#mensajero_comision1").val();
                if (mensajero == "") {
                    mensajero = 0;
                } else {}
                mostrarlista($("#desde1").val(), $("#hasta1").val(), mensajero);
                $.notify("Los cambios han sido guardados", "success");
                $(".modal-backdrop").remove();
                $("#cambiar_comisionModal").modal("hide");
            } else {}
        },
        error: function(error) {
            $.notify("Error al intentar guardar ", "warning");
        },
    });
}