/*=============================================
MODAL APPENDTO BODY CLIENTE
=============================================*/


$('#modalNuevoPropuesta').appendTo("body");

$('#modalNuevoItinerario').appendTo("body");


/*=============================================
DOCUMENT READY
=============================================*/

$(document).ready(function() {

    formatoNumeros();
    limpiarModalPropuesta();
    limpiarModalItinerarioCrear();
    botonesCotizacion();
    
    $.blockUI.defaults = {
        timeout: 5000,
        fadeIn: 500,
        fadeOut: 300,
    };

});

$(document).keyup(function(e) {
    if (e.keyCode == 27 && $('#modalNuevoItinerario').is(':visible'))  {
        //alert('Esc key is press');
        $('#modalNuevoPropuesta').modal('show');
    }
});

/*=============================================
VALIDAR SELECCION DE USUARIO
=============================================*/

function validarClienteSeleccionado() {

    var clienteSeleccionado = $('#cotizacionNuevoCliente').select2('data');

    if (clienteSeleccionado != "") {

        $('#modalNuevoPropuesta').modal('show');

    } else {

        Swal.fire(
            'Seleccionar cliente',
            'Debe seleccionar un cliente para la cotizacion',
            'info'
        );

    }

}

/*=============================================
MOSTRAR MODAL ADICIONAR ITINERARIO
=============================================*/

function addItenerario() {

    limpiarModalItinerarioCrear();

    $("#modalItinerario").text("Crear Itinerario");
    $("#btnItinerario").text("Crear Itinerario");
    $('#modalNuevoPropuesta').modal('hide');
    $('#modalNuevoItinerario').modal('show');

}

/*=============================================
MOSTRAR MODAL PROPUESTA CUANDO CIERRO MODAL ADICIONAR ITINERARIO
=============================================*/

function mostrarModalPropuesta() {

    $('#modalNuevoPropuesta').modal('show');

}

var nextId = 1;
var activeId = 0;

/*=============================================
AGREGANDO ITINERARIO
=============================================*/

function itinerarioActualizar() {
    
    if ($("#btnItinerario").text() == "Actualizar Itinerario") {

        var active = $('#hidden_itinerario').val();

        console.log("active", active);
        
        itinerarioActualizarEnTabla(active);
    }
    else {
        itinerarioAgregarEnTabla();
    }

    $('#modalNuevoItinerario').modal('hide');
    $('#modalNuevoPropuesta').modal('show');

}

/*=============================================
ACTUALIZANDO ITINERARIO A LA TABLA ITINERARIOS
=============================================*/

function itinerarioActualizarEnTabla(id) {

    var row = $("#tablaItinerario button[data-id='" + id + "']")
                .parents("tr")[0];

    $(row).after(itinerarioConstruirTablaRow(id));
    $(row).remove();

}

/*=============================================
AGREGANDO ITINERARIO A LA TABLA ITINERARIOS
=============================================*/

function itinerarioAgregarEnTabla() {

    // Append product to table
    $("#tablaItinerario").append(
        itinerarioConstruirTablaRow(nextId));

    // Increment next ID to use
    nextId += 1;
}

/*=============================================
CONTRUYENDO ROW PARA LA TABLA ITINERARIOS
=============================================*/

function itinerarioConstruirTablaRow(id) {

    var origen = $('#itinerarioNuevoOrigen').select2('data');
    var origenId = origen[0].id_aeropuerto;
    var origenNombre = origen[0].nombre_aeropuerto;

    var destino = $('#itinerarioNuevoDestino').select2('data');
    var destinoId = destino[0].id_aeropuerto;
    var destinoNombre = destino[0].nombre_aeropuerto;

    var fechaVuelo = $('#itinerarioNuevoFechaVuelo').val();


    //console.log("origenId : ", origenId);
    //console.log("destinoId : ", destinoId);
    //console.log("origenNombre : ", origenNombre);
    //console.log("destinoNombre : ", destinoNombre);
    //console.log("fechaVuelo : ", fechaVuelo);


    var ret = '<tr>' +
                '<td>' + id + '</td>' +
                '<td style="display: none;">' + origenId + '</td>' +
                '<td>' + origenNombre + '</td>' +
                '<td style="display: none;">' + destinoId + '</td>' +
                '<td>' + destinoNombre + '</td>' +
                '<td>' + fechaVuelo + '</td>' +
                '<td>' +
                    '<button type="button" class="border-0 btn-transition btn btn-outline-warning" onClick="itinerarioMostrar(' + id + ', ' + origenId + ', ' + destinoId + ', \'' + origenNombre + ' \', \'' + destinoNombre + ' \',\'' + fechaVuelo + ' \');" data-id="'+ id +'"><i class="lnr-pencil btn-icon-wrapper">&nbsp;</i></button>' +
                    '<button type="button" class="border-0 btn-transition btn btn-outline-danger" onClick="itinerarioBorrar(this);" data-id="'+ id +'" ><i class="lnr-cross btn-icon-wrapper">&nbsp;</i></button>' +
                '</td>' +
            '</tr>';

    return ret;
    
}

/*=============================================
MOSTRAR MODAL EDITAR ITINERARIO
=============================================*/

function itinerarioMostrar(id, origenId, destinoId, origenNombre, destinoNombre, fechaVuelo) {


    limpiarModalItinerarioCrear();

    $("#modalItinerario").text("Actualizar Itinerario");
    $("#btnItinerario").text("Actualizar Itinerario");

    
    $('#hidden_itinerario').val(id);
    
    var optionOrigen = new Option(origenNombre, origenId, true, true);
    $('#itinerarioNuevoOrigen').append(optionOrigen);

    var optionDestino = new Option(destinoNombre, destinoId, true, true);
    $('#itinerarioNuevoDestino').append(optionDestino);

    $("#itinerarioNuevoFechaVuelo").val(fechaVuelo);
    $('#itinerarioNuevoFechaVuelo').trigger('change');

    $('#modalNuevoPropuesta').modal('hide');
    $('#modalNuevoItinerario').modal('show');

}

/*=============================================
BORRAR ROW ITINERARIO
=============================================*/

function itinerarioBorrar(ctl) {
    $(ctl).parents("tr").remove();
}

/*=============================================
LIMPIAR MODALES
=============================================*/

function limpiar() {

    limpiarModalPropuesta();
    limpiarModalItinerarioCrear();
    $('#smartwizard').smartWizard("reset");

}

/*=============================================
FORMATOS PARA LOS SELECCIONAR
=============================================*/

function formatRepo(repo) {
    if (repo.loading) return repo.text;
    return repo.desc;
}

function formatRepoSelection(repo) {
    return repo.desc || repo.text;
}

/*=============================================
SELECCIONAR CLIENTE / BUSCAR CLIENTE
=============================================*/

$("#cotizacionNuevoCliente").select2({

    placeholder: "Busca cliente aquí...",
    theme: "bootstrap4",
    ajax: {
        url: 'ajax/ajax.clientes.php',
        dataType: 'json',
        delay: 250,
        data: function(params) {
            return {
                q: params.term,
                page: params.page
            };
        },
        processResults: function(data, params) {
            params.page = params.page || 1;
            return {
                results: data.items,
                pagination: {
                    more: (params.page * 30) < data.total_count
                }
            };
        },
        cache: false
    },
    minimumInputLength: 3,
    templateResult: formatRepo,
    templateSelection: formatRepoSelection
});


/*=============================================
SELECCIONAR AEROLINEA / BUSCAR AEROLINEA
=============================================*/

$("#cotizacionNuevoAerolinea").select2({
    dropdownParent: $('#modalNuevoPropuesta'),
    placeholder: "Busca aerolinea aquí...",
    theme: "bootstrap4",
    ajax: {
        url: 'ajax/ajax.aerolineas.php',
        dataType: 'json',
        delay: 250,
        data: function(params) {
            return {
                q: params.term,
                page: params.page
            };
        },
        processResults: function(data, params) {
            params.page = params.page || 1;
            return {
                results: data.items,
                pagination: {
                    more: (params.page * 30) < data.total_count
                }
            };
        },
        cache: false
    },
    minimumInputLength: 3,
    templateResult: formatRepo,
    templateSelection: formatRepoSelection
});

/*=============================================
SELECCIONAR AEROPUERTOS / BUSCAR AEROPUERTOS
=============================================*/

$(".cotizacionNuevoAeropuerto").select2({
    dropdownParent: $('#modalNuevoItinerario'),
    placeholder: "Busca Aropuerto",
    theme: "bootstrap4",
    ajax: {
        url: 'ajax/ajax.aeropuertos.php',
        dataType: 'json',
        delay: 250,
        data: function(params) {
            return {
                q: params.term,
                page: params.page
            };
        },
        processResults: function(data, params) {
            params.page = params.page || 1;
            return {
                results: data.items,
                pagination: {
                    more: (params.page * 30) < data.total_count
                }
            };
        },
        cache: false
    },
    minimumInputLength: 3,
    templateResult: formatRepo,
    templateSelection: formatRepoSelection
});


/*=============================================
FORMATOS AL PRECIO FINAL
=============================================*/

function formatoNumeros() {

    $("#cotizacionNuevoAdultosCantidad").number(true, 0);
    $("#cotizacionNuevoAdultosCostoUnitario").number(true, 2);
    $("#cotizacionNuevoAdultosFee").number(true, 2);

    $("#cotizacionNuevoNinosCantidad").number(true, 0);
    $("#cotizacionNuevoNinosCostoUnitario").number(true, 2);
    $("#cotizacionNuevoNinosFee").number(true, 2);

    $("#cotizacionNuevoDetraccion").number(true, 0);
    $("#cotizacionNuevoCambioMoneda").number(true, 2);

    $("#cotizacionNuevoServicioTraslados").number(true, 2);
    $("#cotizacionNuevoServicioAlojamiento").number(true, 2);
    $("#cotizacionNuevoServicioIncluido").number(true, 2);
    $("#cotizacionNuevoServicioDesayuno").number(true, 2);
    $("#cotizacionNuevoServicioTarjeta").number(true, 2);
    $("#cotizacionNuevoServicioMaletas").number(true, 2);

};

/*=============================================
FORMATO DATERANGEPICKER
=============================================*/

$(".cotizacionNuevoFecha").daterangepicker({
    parentEl: "#modalNuevoItinerario",
    timePicker: true,
    startDate: moment().startOf('hour'),
    endDate: moment().startOf('hour').add(52, 'hour'),
    locale: {
        format: 'DD MMMM, YYYY hh:mm A'
    }
});



/*=============================================
FUNCIÓN PRECIO TOTAL
=============================================*/

function precioTotal() {

    var AdultosCantidad = $("#cotizacionNuevoAdultosCantidad").val();
    var AdultosCostoUnitario = $("#cotizacionNuevoAdultosCostoUnitario").val();
    var AdultosFee = $("#cotizacionNuevoAdultosFee").val();
    
    var NuevoAdultosCobrar = (Number(AdultosCantidad) * Number(AdultosCostoUnitario) ) + ( Number(AdultosCantidad) * Number(AdultosFee));
    var NuevoAdultosPagarAV = (Number(AdultosCantidad) * Number(AdultosCostoUnitario));
    var NuevoAdultosGanancia = (Number(AdultosCantidad) * Number(AdultosFee))

    $("#cotizacionNuevoAdultosCobrar").val(NuevoAdultosCobrar);
    $("#cotizacionNuevoAdultosPagarAV").val(NuevoAdultosPagarAV);
    $("#cotizacionNuevoAdultosGanancia").val(NuevoAdultosGanancia);
    
  
    
    var NinosCantidad = $("#cotizacionNuevoNinosCantidad").val();
    var NinosCostoUnitario = $("#cotizacionNuevoNinosCostoUnitario").val();
    var NinosFee = $("#cotizacionNuevoNinosFee").val();
    
    var NuevoNinosCobrar = (Number(NinosCantidad) * Number(NinosCostoUnitario) ) + ( Number(NinosCantidad) * Number(NinosFee));
    var NinosPagarAV = (Number(NinosCantidad) * Number(NinosCostoUnitario));
    var NuevoNinosGanancia = (Number(NinosCantidad) * Number(NinosFee))

    $("#cotizacionNuevoNinosCobrar").val(NuevoNinosCobrar);
    $("#cotizacionNuevoNinosPagarAV").val(NinosPagarAV);
    $("#cotizacionNuevoNinosGanancia").val(NuevoNinosGanancia);


    var CobrarDolares = (NuevoAdultosCobrar + NuevoNinosCobrar);
    $("#cotizacionNuevoTotalCobrarDolares").val(CobrarDolares);

    var GananciaTotal = (NuevoAdultosGanancia + NuevoNinosGanancia);
    $("#cotizacionNuevoGananciaTotal").val(GananciaTotal);

    var PagarAVTotal = (NuevoAdultosPagarAV + NinosPagarAV);
    $("#cotizacionNuevoTotalAV").val(PagarAVTotal);

    var CambioMoneda = $("#cotizacionNuevoCambioMoneda").val();

    var CobrarSoles = (CobrarDolares * CambioMoneda);
    $("#cotizacionNuevoTotalCobrarSoles").val(CobrarSoles);

    if(CobrarDolares != "" && CobrarDolares != null ){
        $("#cotizacionNuevoTotalCobrarDolares").addClass("is-valid");
    }

    if(CambioMoneda != "" && CambioMoneda != null ){
        $("#cotizacionNuevoTotalCobrarSoles").addClass("is-valid");
    }

    var Detraccion = $("#cotizacionNuevoDetraccion").val();

    if(Detraccion != "" && Detraccion != null ){


        var DetraccionRestar = (CobrarDolares*Detraccion)/100;

        CobrarDolaresNuevo = CobrarDolares - DetraccionRestar; 
        CobrarSolesNuevo   = (CobrarDolares - DetraccionRestar)*CambioMoneda;

        $("#cotizacionNuevoTotalCobrarDolares").val(CobrarDolaresNuevo);
        $("#cotizacionNuevoTotalCobrarSoles").val(CobrarSolesNuevo);

        

    }

};



/*=============================================
AGREGANDO COTIZACION
=============================================*/
function adicionarCotizacion() {

    if($("#hidden_cotizacion_id").val() == ""){
        adicionarCotizacion();
    }else {
        adicionarPropuesta();
    }

}

function adicionarCotizacion() {

    var cotizacionNuevoCliente = $("#cotizacionNuevoCliente option:selected").val();
    var cotizacionNuevoUsuarioCreacion = $("#hidden_usuario_creacion").val();
    var cotizacionNuevoIdSolicitud = $("#hidden_solicitud_id").val();

    if ($("#hidden_cotizacion_id").val() == "") {

        var datosCotizacion = new FormData();

        datosCotizacion.append("cotizacionNuevoIdSolicitud", cotizacionNuevoIdSolicitud);
        datosCotizacion.append("cotizacionNuevoCliente", cotizacionNuevoCliente);
        datosCotizacion.append("cotizacionNuevoUsuarioCreacion", cotizacionNuevoUsuarioCreacion);


        //console.log("cotizacionNuevoCliente",cotizacionNuevoCliente);
        //console.log("cotizacionNuevoUsuarioCreacion",cotizacionNuevoUsuarioCreacion);
        //console.log("cotizacionNuevoIdSolicitud",cotizacionNuevoIdSolicitud);

        $.ajax({

            url: "ajax/ajax.cotizaciones.php",
            method: "POST",
            data: datosCotizacion,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta) {

                $("#hidden_cotizacion_id").val(respuesta["id_cotizacion"]);
                adicionarPropuesta();

            }

        });

    }

    if ($("#hidden_cotizacion_id").val() != "") {

        adicionarPropuesta();

    }
}

/*=============================================
AGREGANDO PROPUESTA
=============================================*/

function adicionarPropuesta() {

    var coti_id = $("#hidden_cotizacion_id").val()

    var cotizacionNuevoCotizacion = $("#hidden_cotizacion_id").val();
    var cotizacionNuevoTipoViaje = $('select[name=cotizacionNuevoTipoViaje] option').filter(':selected').val();
    var cotizacionNuevoAerolinea = $("#cotizacionNuevoAerolinea option:selected").val();
    var cotizacionNuevoAdultosCantidad = $("#cotizacionNuevoAdultosCantidad").val();
    var cotizacionNuevoAdultosCostoUnitario = $("#cotizacionNuevoAdultosCostoUnitario").val();
    var cotizacionNuevoAdultosFee = $("#cotizacionNuevoAdultosFee").val();
    var cotizacionNuevoNinosCantidad = $("#cotizacionNuevoNinosCantidad").val();
    var cotizacionNuevoNinosCostoUnitario = $("#cotizacionNuevoNinosCostoUnitario").val();
    var cotizacionNuevoNinosFee = $("#cotizacionNuevoNinosFee").val();    
    var cotizacionNuevoDetraccion = $("#cotizacionNuevoDetraccion").val();
    var cotizacionNuevoCambioMoneda = $("#cotizacionNuevoCambioMoneda").val();
    var cotizacionNuevoUsuarioCreacion = $("#hidden_usuario_creacion").val();

    var datosPropuesta = new FormData();

    datosPropuesta.append("cotizacionNuevoCotizacion", cotizacionNuevoCotizacion);
    datosPropuesta.append("cotizacionNuevoTipoViaje", cotizacionNuevoTipoViaje);
    datosPropuesta.append("cotizacionNuevoAerolinea", cotizacionNuevoAerolinea);
    datosPropuesta.append("cotizacionNuevoAdultosCantidad", cotizacionNuevoAdultosCantidad);
    datosPropuesta.append("cotizacionNuevoAdultosCostoUnitario", cotizacionNuevoAdultosCostoUnitario);
    datosPropuesta.append("cotizacionNuevoAdultosFee", cotizacionNuevoAdultosFee);
    datosPropuesta.append("cotizacionNuevoNinosCantidad", cotizacionNuevoNinosCantidad);
    datosPropuesta.append("cotizacionNuevoNinosCostoUnitario", cotizacionNuevoNinosCostoUnitario);
    datosPropuesta.append("cotizacionNuevoNinosFee", cotizacionNuevoNinosFee);
    datosPropuesta.append("cotizacionNuevoDetraccion", cotizacionNuevoDetraccion);
    datosPropuesta.append("cotizacionNuevoCambioMoneda", cotizacionNuevoCambioMoneda);
    datosPropuesta.append("cotizacionNuevoUsuarioCreacion", cotizacionNuevoUsuarioCreacion);

    /*
    for (var value of datosPropuesta.values()) {
        console.log("datosPropuesta : ", value);
     }
    */

     console.log("cotizacionNuevoCotizacion", cotizacionNuevoCotizacion);
     console.log("cotizacionNuevoTipoViaje", cotizacionNuevoTipoViaje);
     console.log("cotizacionNuevoAerolinea", cotizacionNuevoAerolinea);
     console.log("cotizacionNuevoAdultosCantidad", cotizacionNuevoAdultosCantidad);
     console.log("cotizacionNuevoAdultosCostoUnitario", cotizacionNuevoAdultosCostoUnitario);
     console.log("cotizacionNuevoAdultosFee", cotizacionNuevoAdultosFee);
     console.log("cotizacionNuevoNinosCantidad", cotizacionNuevoNinosCantidad);
     console.log("cotizacionNuevoNinosCostoUnitario", cotizacionNuevoNinosCostoUnitario);
     console.log("cotizacionNuevoNinosFee", cotizacionNuevoNinosFee);
     console.log("cotizacionNuevoDetraccion", cotizacionNuevoDetraccion);
     console.log("cotizacionNuevoCambioMoneda", cotizacionNuevoCambioMoneda);
     console.log("cotizacionNuevoUsuarioCreacion", cotizacionNuevoUsuarioCreacion);

    $.ajax({

        url: "ajax/ajax.propuestas.php",
        method: "POST",
        data: datosPropuesta,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            console.log("respuesta", respuesta);

            $("#hidden_propuesta_id").val(respuesta["id_propuesta"]);

            adicionarItinerario();
            

        }

    });

}


/*=============================================
AGREGANDO ITINERARIO
=============================================*/

function adicionarItinerario() {

    var filas = [];

    $('#tablaItinerario tr').each(function() {

        var idPropuesta = $("#hidden_propuesta_id").val();
        var origen = $(this).find('td').eq(1).text();
        var destino = $(this).find('td').eq(3).text();
        var fecha = $(this).find('td').eq(5).text();
        var usuarioCreacion = $("#hidden_usuario_creacion").val();

        var fila = {
            idPropuesta,
            origen,
            destino,
            fecha,
            usuarioCreacion
        };
        filas.push(fila);

    });

    cotizacionNuevoItinerario = new Array();

    $.ajax({
        type: "POST",
        url: "ajax/ajax.itinerarios.php",
        data: { cotizacionNuevoItinerario: JSON.stringify(filas) },
        beforeSend: function(){

            $('#modalNuevoPropuesta').modal('hide');
            $.blockUI({message: $('.body-block-example-2')});
            
        },
        success: function(respuesta) {

            if (respuesta == "ok") {
                setTimeout(mensajePropuestaRegistrada, 5800);
            }
        }
    });
}


function mensajePropuestaRegistrada() {

    tablaPropuestas();


    botonesCotizacion();


    Swal.fire({
        type: "success",
        title: "La propuesta a sido registrada correctamente",
        showConfirmButton: true,
        confirmButtonText: "Cerrar",
        closeOnConfirm: false
    }).then((result) => {
        if (result.value) {

            $('#cotizacionNuevoCliente').attr("disabled", true);
            //$('#modalNuevoPropuesta').modal('toggle');
            limpiar();

        }
    });


}

/*=============================================
LIMPIAR CAMPOS DEL MODAL PROPUESTA
=============================================*/

function limpiarModalPropuesta() {

    $("[name=cotizacionNuevoTipoViaje]").prop("checked", false);
    $('#cotizacionNuevoAerolinea').val(null).trigger('change');
    $("#cotizacionNuevoTipoMoneda").val("");

    $("#cotizacionNuevoAdultosCantidad").val("");
    $("#cotizacionNuevoAdultosCostoUnitario").val("");
    $("#cotizacionNuevoAdultosFee").val("");

    $("#cotizacionNuevoNinosCantidad").val("");
    $("#cotizacionNuevoNinosCostoUnitario").val("");
    $("#cotizacionNuevoNinosFee").val("");

    $("#cotizacionNuevoDetraccion").val("");
    $("#cotizacionNuevoCambioMoneda").val("");

    $("#cotizacionNuevoServicioTraslados").val("");
    $("#cotizacionNuevoServicioAlojamiento").val("");
    $("#cotizacionNuevoServicioIncluido").val("");
    $("#cotizacionNuevoServicioDesayuno").val("");
    $("#cotizacionNuevoServicioTarjeta").val("");
    $("#cotizacionNuevoServicioMaletas").val("");

    $("#tablaItinerario").html("");

}

/*=============================================
LIMPIAR CAMPOS DEL MODAL ITINERARIO
=============================================*/


function limpiarModalItinerarioCrear() {

    $('#itinerarioNuevoOrigen').val(null).trigger('change');
    $('#itinerarioNuevoDestino').val(null).trigger('change');
    $('#itinerarioNuevoFechaVuelo').val(null).trigger('change');

}


/*=============================================
ACTUALIZA LA TABLA DE PROPUESTAS
=============================================*/

function tablaPropuestas() {

    var idCotizacion = $("#hidden_cotizacion_id").val();
    var datostablaPropuesta = new FormData();
    datostablaPropuesta.append("idCotizacion", idCotizacion);
    
    $.ajax({

        url: "ajax/ajax.propuestas.php",
        method: "POST",
        data: datostablaPropuesta,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            $("#tablaPropuesta").html('');
            $("#tablaPropuesta").html(respuesta);

        }

    });

};

/*=============================================
BOTONES CABECERA COTIZACION
=============================================*/

function botonesCotizacion() {

    if($("#hidden_propuesta_id").val() != "" ){

        var divBotonesCotizacion =  '<button type="button" class="btn-shadow btn btn-focus btnGenerarPDF">'+
                                        '<span class="btn-icon-wrapper pr-1 opacity-7">'+
                                            '<i class="pe-7s-add-user pe-7s-w-20"></i>'+
                                        '</span>'+
                                        'Generar PDF'+
                                    '</button> '+
                                    ' <button type="button" class="btn-shadow btn btn-alternate btnEnviarCorreo">'+
                                        '<span class="btn-icon-wrapper pr-1 opacity-7">'+
                                            '<i class="pe-7s-add-user pe-7s-w-20"></i>'+
                                        '</span>'+
                                        'Enviar Correo'+
                                    '</button>';

        $("#divBotonesCotizacion").html(divBotonesCotizacion);

    } else {

        var divBotonesCotizacion =  '<button type="button" class="btn-shadow btn btn-primary" data-toggle="modal" data-target="#modalNuevoCliente">'+
                                        '<span class="btn-icon-wrapper pr-2 opacity-7">'+
                                            '<i class="pe-7s-add-user pe-7s-w-20"></i>'+
                                        '</span>'+
                                        'Agregar Cliente'+
                                    '</button>';

        $("#divBotonesCotizacion").html(divBotonesCotizacion);

    }
};


/*=============================================
CONSULTA X ID PROPUESTAS DATOS
=============================================*/

$(".btnEditarPropuesta").click(function() {

    var idPropuesta = $(this).attr("idPropuesta");

    console.log(idPropuesta);


});


/*=============================================
ACTUALIZAR PROPUESTAS ESTADO
=============================================*/

$('.btnCambiarPropuesta').change(function() {

    var idPropuesta = $(this).attr("idPropuesta");
    var estadoPropuesta = $(this).attr("estadoPropuesta");

    var cambiar = "";

    if (estadoPropuesta == "1"){
        // console.log('entro en 1');
        estadoPropuesta = $(this).attr("estadoPropuesta","0");
        cambiar = "0";
        
    }
    
    if (estadoPropuesta == "0"){
        // console.log('entro en 0');
        estadoPropuesta = $(this).attr("estadoPropuesta","1");
        cambiar = "1";
        
    }

    //console.log('idPropuesta', idPropuesta);
    //console.log('estadoPropuesta', estadoPropuesta);

    var actualizarEstadoPropuesta = new FormData();
    actualizarEstadoPropuesta.append("idPropuestaEstado", idPropuesta);
    actualizarEstadoPropuesta.append("estadoPropuesta", cambiar);
    
    $.ajax({

        url: "ajax/ajax.propuestas.php",
        method: "POST",
        data: actualizarEstadoPropuesta,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            console.log(respuesta);

        }

    });

});