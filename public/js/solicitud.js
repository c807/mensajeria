function base_url(url) {
    return window.location.origin + "/grupo_c807/mensajeria/" + url;
}

function solicitud_lista() {
    $("#contenidoLista_comision").hide();
    $("#lst_comision").hide();
    var url = base_url("index.php/solicitud/Solicitud/lista_solicitud");
    $.post(url, function(data) {
        document.getElementById("contenidoLista").innerHTML = data;
        if ($('#opcion').val() == 1) {
            op = $('#opcion').val();
            op = 0;
            id = 10;
            $("#form_solicitud").show("blind");
            var url = base_url("index.php/solicitud/Solicitud/ver/" + op + "/" + id);



            $.get(url, function(data) {
                $("#contenidoeditar").html(data);
                $("#motivo_rechazo").prop("disabled", true);
                off_recibe();
                off_entregado();
                off_liquidado();
                off_asignar_mensajero();
                off_recibir;
                botones_off();
                $("#btn1").show();
            });


        } else {
            //$("#form_solicitud").hide();
        }
        opc_impresion();

        $(".chosen").chosen({
            width: "100%",
        });
    });
}

function openform_solicitud(op, id) {
    // op = 0; /* cuand op=0 indica que tiene un file asignado */
    // id = 10;
    $("#form_solicitud").show("blind");
    var url = base_url("index.php/solicitud/Solicitud/ver/" + op + "/" + id);


    if (op == 0) {
        $.get(url, function(data) {
            $("#contenidoeditar").html(data);
            $("#motivo_rechazo").prop("disabled", true);
            off_recibe();
            off_entregado();
            off_liquidado();
            off_asignar_mensajero();
            off_recibir;
            botones_off();
            $("#btn1").show();
        });
    }

    if (op == 1) {
        $.get(url, function(data) {
            $("#contenidoeditar").html(data);
            $("#motivo_rechazo").prop("disabled", true);
            off_recibe();
            off_entregado();
            off_liquidado();
            off_asignar_mensajero();
            off_recibir;
            botones_off();
            $("#btn1").show();
        });
    }

    //var url = base_url("index.php/solicitud/Solicitud/ver/" + op + "/" + id);
    if (op == 2) {
        //solicitud rechazada       
        $.get(url, function(data) {
            $("#contenidoeditar").html(data);
            off_solicita();
            catalogo_on();
            off_entregado();
            off_asignar_mensajero();
            off_liquidado();
            botones_off();
            $("#btn2").show();


        });
    }

    if (op == 3) {
        $.get(url, function(data) {
            $("#contenidoeditar").html(data);
            off_solicita();
            off_recibe();
            catalogo_on();
            off_entregado();
            off_liquidado();
            botones_off();
            $("#btn3").show();
        });
    }

    if (op == 4) {
        $.get(url, function(data) {
            $("#contenidoeditar").html(data);
            off_solicita();
            off_recibe();
            catalogo_on();
            off_liquidado();
            botones_off();
            $("#btn4").show();
        });
    }

    if (op == 5) {
        $.get(url, function(data) {
            $("#contenidoeditar").html(data);
            off_solicita();
            off_recibe();
            catalogo_on();
            off_entregado();
            botones_off();
            $("#btn5").show();
        });
    }

    if (op == 6) {
        $.get(url, function(data) {
            $("#contenidoeditar").html(data);

            off_recibe();
            catalogo_on();
            off_entregado();
            botones_off();
            $("#btn5").show();
        });
    }
}

function botones_off() {
    $("#btn1").hide();
    $("#btn2").hide();
    $("#btn3").hide();
    $("#btn4").hide();
    $("#btn5").hide();
}

function catalogo_on() {
    $("#motivo_rechazo").prop("disabled", true);
    $("#colaborador").val($("#idcolaborador").val());
    $("#proceso").val($("#idproceso").val());
    $("#prioridad").val($("#idprioridad").val());
    $("#turno").val($("#idturno").val());
    $("#zona").val($("#idzona").val());
    $("#tipo_viaje").val($("#idtipo").val());
    $("#mensajero").val($("#idmensajero").val());
    $("#actividad").val($("#idactividad").val());
    $("#liquidada_por").val($("#idliquidada_por").val());
    //$("#zona").val($("#idzona").val());
    $("select").trigger("chosen:updated");
}

function off_asignar_mensajero() {
    //$("#motivo_rechazo").prop("disabled", true);
    //$("input[type=radio]").attr("disabled", true);
    $("#tipo_viaje.chosen").prop("disabled", true).trigger("chosen:updated");
    $("#mensajero.chosen").prop("disabled", true).trigger("chosen:updated");
    $("#zona.chosen").prop("disabled", true).trigger("chosen:updated");
    $("#zona.chosen").prop("disabled", true).trigger("chosen:updated");
}

function off_recibir() {
    $("#motivo_rechazo").prop("disabled", true);
    $("input[type=radio]").attr("disabled", true);
}

function off_recibe() {
    $("#recibido_por").prop("disabled", true);
    $("#fecha_recibe").prop("disabled", true);
    $("#motivo_rechazo").prop("disabled", true);
    $("input[type=radio]").attr("disabled", true);
}

function off_entregado() {
    $("#nombre_mensajero").prop("disabled", true);
    $("#fecha_entrega").prop("disabled", true);
    $("#hora_entrega").prop("disabled", true);
    $("#nota_ent_mensajero").prop("disabled", true);
}

function off_liquidado() {
    $("#liquidada_por").prop("disabled", true);
    $("#fecha_liquidada").prop("disabled", true);
    $("#hora_liquidada").prop("disabled", true);
    $("#nota_liquidacion").prop("disabled", true);
}

function off_solicita() {
    $("#file").prop("disabled", true);
    $("#colaborador.chosen").prop("disabled", true).trigger("chosen:updated");
    $("#proceso.chosen").prop("disabled", true).trigger("chosen:updated");
    $("#hora_sugerida").prop("disabled", true);
    $("#prioridad.chosen").prop("disabled", true).trigger("chosen:updated");
    $("#actividad.chosen").prop("disabled", true).trigger("chosen:updated");
    $("#documento").prop("disabled", true);
    $("#consignado_a").prop("disabled", true);
    $("#lugar").prop("disabled", true);
    $("#contacto").prop("disabled", true);
    $("#direccion").prop("disabled", true);
    $("#turno.chosen").prop("disabled", true).trigger("chosen:updated");
    //$("#zona.chosen").prop("disabled", true).trigger("chosen:updated");
    $("#observaciones").prop("disabled", true);
    $("#fecha_sugerida").prop("disabled", true);
    $("input[type=checkbox]").attr("disabled", true);
}

function crear_solicitud(id) {
    var url = base_url("index.php/solicitud/Solicitud/crear_solicitud/");
    $.ajax({
        url: url,
        data: $("form").serialize(),
        type: "POST",
        success: function(response) {
            $.notify("Los cambios han sido guardados", "success");
            solicitud_lista();
            cerrar_formulario();
        },
        error: function(error) {},
    });
}

function aceptar_rechazar() {
    var url = base_url("index.php/solicitud/Solicitud/aceptar_rechazar/");
    $.ajax({
        url: url,
        data: $("form").serialize(),
        type: "POST",
        success: function(response) {
            if (response > 0) {
                $.notify("Los cambios han sido guardados", "success");
                solicitud_lista();
                cerrar_formulario();
                //----------------------------------------

                // if ($("#aceptar").val() == "1") {
                if ($('input:radio[name=aceptar]:checked').val() == 1) {
                    alert('aceptada');
                } else {
                    var url = base_url("index.php/welcome/enviar_correo_rechazo/" + $('#idsolicitud').val() + "/" + $('#motivo_rechazo').val());

                    $.get(url, function(data) {

                    });
                }


                //----------------------------------------
            } else {
                $.notify("Error, no ha sido posible guardar los cambios", "error");
            }
        },
        error: function(error) {
            $.notify("Error al intentar guardar ", "warning");
        },
    });
}

function asignar_mensajero() {
    var url = base_url("index.php/solicitud/Solicitud/asignar_mensajero/");
    $.ajax({
        url: url,
        data: $("form").serialize(),
        type: "POST",
        success: function(response) {
            if (response > 0) {
                $.notify("Los cambios han sido guardados", "success");
                solicitud_lista();
                cerrar_formulario();
            } else {
                $.notify("Error, no ha sido posible guardar los cambios", "error");
            }
        },
        error: function(error) {
            $.notify("Error al intentar guardar ", "warning");
        },
    });
}

function entregado_mensajero() {
    var url = base_url("index.php/solicitud/Solicitud/entregado_mensajero/");
    $.ajax({
        url: url,
        data: $("form").serialize(),
        type: "POST",
        success: function(response) {
            if (response > 0) {
                $.notify("Los cambios han sido guardados", "success");
                solicitud_lista();
                cerrar_formulario();
            } else {
                $.notify("Error, no ha sido posible guardar los cambios", "error");
            }
        },
        error: function(error) {
            $.notify("Error al intentar guardar ", "warning");
        },
    });
}

function liquidar() {
    var url = base_url("index.php/solicitud/Solicitud/liquidar/");
    $.ajax({
        url: url,
        data: $("form").serialize(),
        type: "POST",
        success: function(response) {
            if (response > 0) {
                $.notify("Los cambios han sido guardados", "success");
                solicitud_lista();
                cerrar_formulario();
            } else {
                $.notify("Error, no ha sido posible guardar los cambios", "error");
            }
        },
        error: function(error) {
            $.notify("Error al intentar guardar ", "warning");
        },
    });
}

function lista_asignaciones() {
    var mensajero = $("#mensajero_re").val();

    if (mensajero > 0) {
        var url = base_url(
            "index.php/solicitud/Solicitud/lista_asignaciones/" +
            $("#mensajero_re").val()
        );
        $.get(url, function(data) {

            pdf_asignaciones();
        });
    } else {
        $.notify("Seleccione mensajero...", "error");
        return false;
    }
}

function cambiar_estatus() {
    id = $("#estatus").val();

    if ($("#seleccionado").val() == 0) {
        var url = base_url(
            "index.php/solicitud/Solicitud/cambiar_estatus/" +
            id +
            "/" +
            $("#id_solicitud").val() +
            "/" +
            $("#observacion").val()
        );

        $.ajax({
            url: url,
            data: $("form").serialize(),
            type: "POST",
            success: function(response) {
                if (response > 0) {
                    $.notify("Los cambios han sido guardados", "success");
                    $(".modal-backdrop").remove();
                    $("#enRutaModal").modal("hide");
                    solicitud_lista();
                    cerrar_formulario();
                } else {
                    $.notify("Error, no ha sido posible guardar los cambios", "error");
                }
            },
            error: function(error) {
                $.notify("Error al intentar guardar ", "warning");
            },
        });
    } else {
        var filas = $("#tabla_solicitudes").find("tr");
        opc = 0;
        for (i = 0; i < filas.length; i++) {
            var celdas = $(filas[i]).find("td");
            codigo = $(celdas[0]).text();

            if ($("#chk" + opc).is(":checked")) {
                var url = base_url(
                    "index.php/solicitud/Solicitud/cambiar_estatus/" +
                    id +
                    "/" +
                    codigo +
                    "/" +
                    $("#observacion").val()
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

            } else {}
            opc = opc + 1;
        }
        $.notify("Los cambios han sido guardados", "success");
        $(".modal-backdrop").remove();
        $("#enRutaModal").modal("hide");
        solicitud_lista();
        cerrar_formulario();
    }
}

function pdf_asignaciones() {
    var loc = window.location;

    var url = "asignaciones.pdf";


    window.open(
        base_url(url),
        "ventana1",
        "width=600,height=600,scrollbars=no,toolbar=no, titlebar=no, menubar=no"

    );

}

function pdf_solicitus() {
    var loc = window.location;

    var url = "lista_solicitudes";
    window.open(
        base_url(url + ".pdf"),
        "ventana1",
        "width=600,height=600,scrollbars=no,toolbar=no, titlebar=no, menubar=no"
    );
}

function imprimir_solicitud(id) {
    var url = base_url("index.php/solicitud/Solicitud/imprimir_solicitud/" + id);
    $.get(url, function(data) {
        pdf_solicitud();
    });
}

function pdf_solicitud() {
    var url = "solicitud";
    window.open(
        base_url(url + ".pdf"),
        "ventana1",
        "width=600,height=600,scrollbars=no,toolbar=no, titlebar=no, menubar=no"
    );
}

function opc_impresion() {
    $(document).ready(function() {
        $("#opcionbuscar").change(function() {
            if ($("#opcionbuscar").val() == 1) {
                //	$("#mensajero_re").show();
                $("#mensajero_re").next().fadeIn(); //para chose
            } else {
                //	$("#mensajero_re").hide();
                $("#mensajero_re").next().hide(); //para chosen
            }
        });
    });
}

function validar() {
    $("input[name=cobrada]").on("change", function() {
        if ($(this).is(":checked")) {
            $("#justificacion").prop("disabled", true);
            $("#valor").prop("disabled", false);
        } else {
            $("#justificacion").prop("disabled", false);
            $("#valor").prop("disabled", true);
        }
    });

    $(document).ready(function() {
        $("input[name=aceptar]").click(function() {
            // $('input:radio[name=aceptar]:checked').val()); otra forma de hacerlo
            if ($(this).val() == "1") {
                $("#motivo_rechazo").prop("disabled", true);
            } else {
                $("#motivo_rechazo").prop("disabled", false);
            }
        });
    });

    $(document).ready(function() {
        $("#actividad").change(function() {
            //alert($('#actividad').val());
            if ($("#actividad").val() == 2 || $("#actividad").val() == 4 || $("#actividad").val() == 7) {
                $("#documento").prop("disabled", false);
                //$("#consignado_a").prop("disabled", false);
            } else {
                $("#documento").prop("disabled", true);
                //$("#consignado_a").prop("disabled", true);
            }
        });
    });

    $(document).ready(function() {
        $("#prioridad").change(function() {
            if ($("#prioridad").val() == 4) {
                $("#valor").prop("disabled", false);
                $("input[type=checkbox]").attr("disabled", false);
                $("input[type=checkbox]").prop("checked", true);
            } else {
                $("#valor").prop("disabled", true);
                $("input[type=checkbox]").attr("disabled", false);
                $("input[type=checkbox]").prop("checked", true);
                $("#cobrada").prop("checked", false);
            }
        });
    });
}

function enruta(id) {
    var filas = $("#tabla_solicitudes").find("tr");
    var resultado = 0;

    var opc = 1;
    for (i = 0; i < filas.length; i++) {
        var codigo = $("#chk" + codigo).val();
        var celdas = $(filas[i]).find("td");
        //	codigo = $(celdas[8]).text();
        codigo = $("#chk" + opc).val();
        if ($("#chk" + opc).is(":checked")) {
            //	alert("Checkbox seleccionado" + "- " + codigo);
            resultado = 1;
            break;
        } else {}
        opc = opc + 1;
    }

    $("#enRutaModal").modal("show");
    $("#id_solicitud").val(id);
    $("#seleccionado").val(resultado);
    if (resultado == 1) {
        $("#msg").show();
    } else {
        $("#msg").hide();
    }
    resultado = 0;
}

function cerrar_formulario() {
    cerrarform("form_solicitud");
}


function crear_manifiesto() {

    var filas = $("#tabla_solicitudes").find("tr");
    mensajero = $("#manifiesto").val();

    opc = 0;
    for (i = 0; i < filas.length; i++) {
        var celdas = $(filas[i]).find("td");
        solicitud = $(celdas[0]).text();

        if ($("#chk" + opc).is(":checked")) {
            var url = base_url(
                "index.php/solicitud/Solicitud/manifiesto/" +
                solicitud +
                "/" +
                mensajero
            );
            //alert(solicitud+"-"+opc)
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

        } else {}
        opc = opc + 1;
    }

    $.notify("Los cambios han sido guardados", "success");
    $(".modal-backdrop").remove();
    $("#manifiestoModal").modal("hide");
    solicitud_lista();
    cerrar_formulario();
}

function filtro_solicitudes(opc) {
    desde = $("#desde").val();
    hasta = $("#hasta").val();
    mensajero = $("#mensajero_filtro").val();
    $("#desde1").val(desde);
    $("#hasta1").val(hasta);
    $("#mensajero_filtro").val(mensajero);

    if (mensajero == "") {
        mensajero = 0;
    } else {}

    mostrarlista_filtro(desde, hasta, mensajero);
    $("#mensajero_filtro").val("Seleccione...");
    $("#mensajero_filtro").chosen().val("Seleccione").trigger("chosen:updated");
    $(".modal-backdrop").remove();
    $("#filtrarModal").modal("hide");
}

function mostrarlista_filtro(desde, hasta, mensajero) {
    var url = base_url(
        "index.php/solicitud/Solicitud/filtro_solicitudes/" +
        desde +
        "/" +
        hasta +
        "/" +
        mensajero
    );

    $.get(url, function(data) {
        document.getElementById("contenidoLista").innerHTML = data;
    });
}

function lista_estatus(id) {
    var url = base_url("index.php/solicitud/Solicitud/lista_estatus/" + id);
    $.post(url, function(data) {
        $("#modal_bitacora").modal("show");
        document.getElementById("lista_estatus").innerHTML = data;
    });
}