function base_url(url) {
  return window.location.origin + "/grupo_c807/mensajeria/" + url;
}

function opc_botones() {
  var url = base_url("index.php/solicitud/Solicitud/permitir/");
  $.get(url, function (data) {
    if (data == 1) {
      $("#print_manifiesto").show();
      $("#crear_manifiesto").show();
      $("#no_facturados").show();
    } else {
      $("#print_manifiesto").hide();
      $("#crear_manifiesto").hide();
      $("#no_facturados").hide();
    }
  });
}

function solicitud_lista() {
  $("#contenidoLista_comision").hide();
  $("#lst_comision").hide();
  var url = base_url("index.php/solicitud/Solicitud/lista_solicitud");
  $.post(url, function (data) {
    document.getElementById("contenidoLista").innerHTML = data;
    if ($("#opcion").val() == 1) {
      op = $("#opcion").val();
      id = $("#id").val();
      $("#form_solicitud").show("blind");
      var url = base_url("index.php/solicitud/Solicitud/ver/" + op + "/" + id);
      $.get(url, function (data) {
        $("#contenidoeditar").html(data);
        $("#motivo_rechazo").prop("disabled", true);
        off_recibe();
        off_entregado();
        off_liquidado();
        off_asignar_mensajero();
        off_recibir();
        botones_off();
        $("#btn1").show();
      });
    } else {
    }
    opc_impresion();
    opc_botones();

    $(".chosen").chosen({
      width: "100%",
    });
  });
}

function openform_solicitud(op, id) {
  // op = 1; /* cuand op=0 indica que tiene un file asignado */
  // id = 10;
  var estatus = verificar_estatus(id);

  var msg =
    "No puede aplicar esta opción, debido al estatus actual de esta solicitud!";

  if (estatus == 8) {
    //asignacion de mensajero
    $.notify(
      "Esta solicitud ya fue liquidada, no puede realizar cambios",
      "error"
    );
    return false;
  }

  if (op == 2 && estatus > 3) {
    //rechazar aceptar
    $.notify(msg, "error");
    return false;
  }

  if (op == 3) {
    //rechazar aceptar
    if (estatus == 1 || estatus == 3) {
      $.notify(msg, "error");
      return false;
    }
  }
  if (op == 3) {
    //rechazar aceptar
    if (estatus > 4) {
      $.notify(msg, "error");
      return false;
    }
  }

  if (op == 4 && estatus < 4) {
    //liquidar mensajero
    $.notify(msg, "error");
    return false;
  }

  if (op == 4 && estatus > 6) {
    //liquidar mensajero
    $.notify(msg, "error");
    return false;
  }

  if (op == 5 && estatus <= 4) {
    //liquidar mensajero
    $.notify(msg, "error");
    return false;
  }

  if (op == 6 && estatus == 1) {
    //editar solicitud
    $.notify(msg, "error");
    return false;
  }

  if (id == 1) {
    op = 0;
  }

  $("#form_solicitud").show("blind");
  var url = base_url("index.php/solicitud/Solicitud/ver/" + op + "/" + id);
  if (op == 0) {
    $.get(url, function (data) {
      $("#contenidoeditar").html(data);
      $("#motivo_rechazo").prop("disabled", true);
      off_recibe();
      off_entregado();
      off_liquidado();
      off_asignar_mensajero();
      off_recibir();
      botones_off();
      $("#btn1").show();
      $("#file").prop("disabled", true);
    });
  }

  if (op == 1) {
    $.get(url, function (data) {
      $("#contenidoeditar").html(data);
      $("#motivo_rechazo").prop("disabled", true);
      off_recibe();
      off_entregado();
      off_liquidado();
      off_asignar_mensajero();
      off_recibir();
      botones_off();
      $("#btn1").show();
    });
  }

  if (op == 2) {
    //solicitud rechazada
    $.get(url, function (data) {
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
    //asiganr mensajero
    $.get(url, function (data) {
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
    $.get(url, function (data) {
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
    $.get(url, function (data) {
      $("#contenidoeditar").html(data);
      off_solicita();
      off_recibe();
      catalogo_on();
      off_entregado();
      botones_off();
      off_asignar_mensajero();
      $("#btn5").show();
    });
  }

  if (op == 6) {
    $.get(url, function (data) {
      $("#contenidoeditar").html(data);
      off_recibe();
      catalogo_on();
      off_entregado();
      botones_off();
      $("#btn1").show();
    });
  }
}

function verificar_estatus(id) {
  var result = "";
  var url = base_url("index.php/solicitud/Solicitud/verificar_estatus/" + id);
  $.ajax({
    url: url,
    async: false,
    success: function (data) {
      result = data;
    },
  });
  return result;
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
  if ($("#file").val().length <= 0) {
    if (!$("#proceso").val()) {
      $.notify("Información incompleta, seleccione proceso ", "error");
      return false;
    }

    if (!$("#colaborador").val()) {
      $.notify(
        "Información incompleta, seleccione nombre de quien hace la solicitud ",
        "error"
      );
      return false;
    }
  }

  if (!$("#prioridad").val()) {
    $.notify("Información incompleta, seleccione prioridad ", "error");
    return false;
  }

  if (!$("#actividad").val()) {
    $.notify("Información incompleta, seleccione actividad ", "error");
    return false;
  }

  if (!$("#turno").val()) {
    $.notify("Información incompleta, seleccione turno ", "error");
    return false;
  }

  if (!$("#fecha_sugerida").val()) {
    $.notify("Información incompleta, seleccione fecha sugerida", "error");
    return false;
  }

  var url = base_url("index.php/solicitud/Solicitud/crear_solicitud/");
  $.ajax({
    url: url,
    data: $("form").serialize(),
    type: "POST",
    success: function (response) {
      $.notify("Los cambios han sido guardados", "success");
      $("#opcion").val("");
      $("#id").val("");
      $("#file").val("");

      solicitud_lista();
      cerrar_formulario();
    },
    error: function (error) { },
  });
}

function aceptar_rechazar() {
  var id = $("#idsolicitud").val();
  var motivo = $("#motivo_rechazo").val();
  var idcolaborador = $("#idcolaborador").val();
  var url = base_url("index.php/solicitud/Solicitud/aceptar_rechazar/");
  $.ajax({
    url: url,
    data: $("form").serialize(),
    type: "POST",
    success: function (response) {
      //  alert(response);

      $.notify("Los cambios han sido guardados", "success");
      if ($("input:radio[name=aceptar]:checked").val() == 1) {
      } else {
        var url = base_url("index.php/welcome/enviar_correo_rechazo");

        $.ajax({
          url: url,
          type: "POST",
          data: {
            id_solicitud: id,
            motivo_rechazo: motivo,
            solicitdo_por: idcolaborador,
          },
          success: function (datos) { },
        });
      }
      solicitud_lista();
      cerrar_formulario();

      //----------------------------------------
    },
    error: function (error) {
      $.notify("Error al intentar guardar dos ", "warning");
    },
  });
}

function asignar_mensajero() {
  if (!$("#tipo_viaje").val()) {
    $.notify("Información incompleta, seleccione tipo de viaje ", "error");
    return false;
  }

  if (!$("#mensajero").val()) {
    $.notify("Información incompleta, seleccione mensajero ", "error");
    return false;
  }

  if (!$("#zona").val()) {
    $.notify("Información incompleta, seleccione zona ", "error");
    return false;
  }
  var url = base_url("index.php/solicitud/Solicitud/asignar_mensajero/");
  $.ajax({
    url: url,
    data: $("form").serialize(),
    type: "POST",
    success: function (response) {
      if (response > 0) {
        $.notify("Los cambios han sido guardados", "success");
        solicitud_lista();
        cerrar_formulario();
      } else {
        $.notify("Error, no ha sido posible guardar los cambios", "error");
      }
    },
    error: function (error) {
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
    success: function (response) {
      if (response > 0) {
        $.notify("Los cambios han sido guardados", "success");
        solicitud_lista();
        cerrar_formulario();
      } else {
        $.notify("Error, no ha sido posible guardar los cambios", "error");
      }
    },
    error: function (error) {
      $.notify("Error al intentar guardar ", "warning");
    },
  });
}

function liquidar() {
  var solicitante = $("#liquidada_por").val();
  var url = base_url("index.php/solicitud/Solicitud/liquidar/");
  $.ajax({
    url: url,
    data: $("form").serialize(),
    type: "POST",
    success: function (response) {
      if (response > 0) {
        $.notify("Los cambios han sido guardados", "success");
        solicitud_lista();
        cerrar_formulario();
      } else {
        $.notify("Error, no ha sido posible guardar los cambios", "error");
      }
    },
    error: function (error) {
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
    $.get(url, function (data) {
      pdf_asignaciones();
    });
  } else {
    $.notify("Seleccione mensajero...", "error");
    return false;
  }
}

function cambiar_estatus() {
  id = $("#id_solicitud").val();

  var estatus = verificar_estatus(id);
  if (estatus == 8) {
    $.notify(
      "No puede aplicar esta opción, debido al estatus actual de esta solicitud!"
    );
    return false;
  }
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
      success: function (response) {
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
      error: function (error) {
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
          success: function (response) {
            if (response > 0) {
              //$.notify("Los cambios han sido guardados", "success");
            } else {
            }
          },
          error: function (error) {
            $.notify("Error al intentar guardar ", "warning");
          },
        });
      } else {
      }
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
  $.get(url, function (data) {
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
  $(document).ready(function () {
    $("#opcionbuscar").change(function () {
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
  $("input[name=cobrada]").on("change", function () {
    if ($(this).is(":checked")) {
      $("#justificacion").prop("disabled", false);
      $("#valor").prop("disabled", false);
    } else {
      $("#justificacion").prop("disabled", true);
      $("#valor").prop("disabled", true);
    }
  });

  $(document).ready(function () {
    $("input[name=aceptar]").click(function () {
      // $('input:radio[name=aceptar]:checked').val()); otra forma de hacerlo
      if ($(this).val() == "1") {
        $("#motivo_rechazo").prop("disabled", true);
      } else {
        $("#motivo_rechazo").prop("disabled", false);
      }
    });
  });

  $(document).ready(function () {
    $("#actividad").change(function () {
      if (
        $("#actividad").val() == 2 ||
        $("#actividad").val() == 4 ||
        $("#actividad").val() == 7
      ) {
        $("#documento").prop("disabled", false);
      } else {
        $("#documento").prop("disabled", true);
      }
    });
  });

  $(document).ready(function () {
    $("#prioridad").change(function () {
      if ($("#prioridad").val() == 4 || $("#prioridad").val() == 3) {
        $("#valor").prop("disabled", false);
        $("#justificacion").prop("disabled", false);
        $("input[type=checkbox]").attr("disabled", false);
        $("input[type=checkbox]").prop("checked", true);
      } else {
        $("#valor").prop("disabled", true);
        $("#justificacion").prop("disabled", true);
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
    } else {
    }
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
        success: function (response) {
          if (response > 0) {
            //$.notify("Los cambios han sido guardados", "success");
          } else {
          }
        },
        error: function (error) {
          $.notify("Error al intentar guardar ", "warning");
        },
      });
    } else {
    }
    opc = opc + 1;
  }

  $.notify("Los cambios han sido guardados", "success");
  $(".modal-backdrop").remove();
  $("#manifiestoModal").modal("hide");
  solicitud_lista();
  cerrar_formulario();
}

function get_fecha() {
  var d = new Date();
  var today =
    d.getFullYear() +
    "-" +
    ("0" + (d.getMonth() + 1)).slice(-2) +
    "-" +
    ("0" + d.getDate()).slice(-2);
  return today;
}

function filtro_solicitudes(opc) {
  var today = get_fecha();
  desde = $("#desde").val();
  hasta = $("#hasta").val();

  if (desde) {
  } else {
    $.notify("Error, selecciones fecha inicial ", "error");
    return false;
  }

  if (hasta) {
  } else {
    hasta = today;
  }

  mensajero = $("#mensajero_filtro").val();
  estatus = $("#estatus_filtro").val();

  $("#desde1").val(desde);
  $("#hasta1").val(hasta);
  $("#mensajero_filtro").val(mensajero);
  $("#estatus_filtro").val(estatus);

  if (mensajero == "") {
    mensajero = 0;
  }
  if (estatus == "") {
    estatus = 0;
  }

  mostrarlista_filtro(desde, hasta, mensajero, estatus);
  $("#mensajero_filtro").val("Seleccione...");
  $("#mensajero_filtro").chosen().val("Seleccione").trigger("chosen:updated");
  $(".modal-backdrop").remove();
  $("#filtrarModal").modal("hide");
}

function mostrarlista_filtro(desde, hasta, mensajero, estatus) {
  var url = base_url(
    "index.php/solicitud/Solicitud/filtro_solicitudes/" +
    desde +
    "/" +
    hasta +
    "/" +
    mensajero +
    "/" +
    estatus
  );

  $.get(url, function (data) {
    document.getElementById("contenidoLista").innerHTML = data;
  });
}

function lista_estatus(id) {
  var url = base_url("index.php/solicitud/Solicitud/lista_estatus/" + id);
  $.post(url, function (data) {
    $("#modal_bitacora").modal("show");
    document.getElementById("lista_estatus").innerHTML = data;
  });
}

function mostrar_modal_confirmacion(id, costo) {
  var estatus = verificar_estatus(id);
  if (estatus != 8) {
    $.notify(
      "No puede aplicar esta opción, debido al estatus actual de esta solicitud!"
    );
    return false;
  }

  if (costo == 0) {
    $.notify(
      "Error, La acción que usted quiere ejecutar, no aplica para esta solicitud.",
      "error"
    );
    return false;
  }

  var mensaje =
    "Está seguro de confirmar como facturada la solicitud número: " +
    id +
    " - valor facturación: $ " +
    costo;
  $("#confirmar_facturacionModal").modal("show");
  document.getElementById("msg_confirma").innerHTML = mensaje;
  $("#id_confirmar").val(id);
}

function confirmar_facturacion() {
  var id = $("#id_confirmar").val();
  $("#confirmar_facturacionModal").modal("show");

  var url = base_url(
    "index.php/solicitud/Solicitud/confirmar_facturacion/" + id
  );
  $.get(url, function (success) {
    $.notify("El estatus ha sido actualizado correctamente.", "success");
    $(".modal-backdrop").remove();
    $("#confirmar_facturacionModal").modal("hide");
    pendientes_facturar();
  });
}

function pendientes_facturar() {
  var url = base_url("index.php/solicitud/Solicitud/pendientes_facturar/");
  $.get(url, function (data) {
    document.getElementById("contenidoLista").innerHTML = data;
  });
}
