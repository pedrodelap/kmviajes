/*=============================================
MODAL APPENDTO BODY CLIENTE
=============================================*/


$('#modalNuevoPropuesta').appendTo("body");

$('#modalNuevoItinerario').appendTo("body");


/*=============================================
DOCUMENT READY
=============================================*/

$(document).ready(function() {

    datePicker();
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


    console.log("origenId : ", origenId);
    console.log("destinoId : ", destinoId);
    console.log("origenNombre : ", origenNombre);
    console.log("destinoNombre : ", destinoNombre);
    console.log("fechaVuelo : ", fechaVuelo);


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
        url: 'ajax/clientes.ajax.php',
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
        url: 'ajax/aerolineas.ajax.php',
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
        url: 'ajax/aeropuertos.ajax.php',
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

    $("#cotizacionNuevoDetraccion").number(true, 0);

    $("#cotizacionNuevoAdultosCantidad").number(true, 0);
    $("#cotizacionNuevoAdultosSF").number(true, 2);
    $("#cotizacionNuevoAdultosFee").number(true, 2);

    $("#cotizacionNuevoNinioCantidad").number(true, 0);
    $("#cotizacionNuevoNinioSF").number(true, 2);
    $("#cotizacionNuevoNinioFee").number(true, 2);

    $("#cotizacionNuevoInfanteCantidad").number(true, 0);
    $("#cotizacionNuevoInfanteSF").number(true, 2);
    $("#cotizacionNuevoInfanteFee").number(true, 2);

}

/*=============================================
FORMATO DATERANGEPICKER
=============================================*/

function datePicker() {

    $(".cotizacionNuevoFecha").daterangepicker({
        parentEl: "#modalNuevoItinerario",
        timePicker: true,
        startDate: moment().startOf('hour'),
        endDate: moment().startOf('hour').add(52, 'hour'),
        locale: {
            format: 'DD MMMM, YYYY hh:mm A'
        }
    });

}


/*=============================================
FUNCIÓN PRECIO TOTAL
=============================================*/

function precioTotal() {

    var AdultosCantidad = $("#cotizacionNuevoAdultosCantidad").val();
    var AdultosTotalSF = $("#cotizacionNuevoAdultosSF").val();
    var AdultosFee = $("#cotizacionNuevoAdultosFee").val();
    var AdultosTotalCF = (Number(AdultosCantidad) * Number(AdultosFee));
    var AdultosTotalGanancia = (Number(AdultosTotalSF) + Number(AdultosTotalCF));
    $("#cotizacionNuevoAdultosTotalCF").val(AdultosTotalCF);
    $("#cotizacionNuevoAdultosTotalGanancia").val(AdultosTotalGanancia);

    var NinioCantidad = $("#cotizacionNuevoNinioCantidad").val();
    var NinioTotalSF = $("#cotizacionNuevoNinioSF").val();
    var NinioFee = $("#cotizacionNuevoNinioFee").val();
    var NinioTotalCF = (Number(NinioCantidad) * Number(NinioFee));
    var NinioTotalGanancia = (Number(NinioTotalSF) + Number(NinioTotalCF));
    $("#cotizacionNuevoNinioTotalCF").val(NinioTotalCF);
    $("#cotizacionNuevoNinioTotalGanancia").val(NinioTotalGanancia);

    var InfanteCantidad = $("#cotizacionNuevoInfanteCantidad").val();
    var InfanteTotalSF = $("#cotizacionNuevoInfanteSF").val();
    var InfanteFee = $("#cotizacionNuevoInfanteFee").val();
    var InfanteTotalCF = (Number(InfanteCantidad) * Number(InfanteFee));
    var InfanteTotalGanancia = (Number(InfanteTotalSF) + Number(InfanteTotalCF));
    $("#cotizacionNuevoInfanteTotalCF").val(InfanteTotalCF);
    $("#cotizacionNuevoInfanteTotalGanancia").val(InfanteTotalGanancia);

    var detraccion = $("#cotizacionNuevoDetraccion").val();

    var total = (InfanteTotalGanancia + NinioTotalGanancia + AdultosTotalGanancia) - ((InfanteTotalGanancia + NinioTotalGanancia + AdultosTotalGanancia) * detraccion) / 100;
    $("#cotizacionNuevoTotal").val(total);

    var totalFEE = (Number(AdultosFee) + Number(NinioFee) + Number(InfanteFee));
    $("#cotizacionNuevoTotalFEE").val(totalFEE);

    var totalCF = (Number(AdultosTotalCF) + Number(NinioTotalCF) + Number(InfanteTotalCF));
    $("#cotizacionNuevoTotalCF").val(totalCF);

}

/*=============================================
AGREGANDO ITINERARIOS
=============================================*/

$("#cotizacionNuevoTipoMoneda").change(function() {

    var metodo = $("#cotizacionNuevoTipoMoneda").val();

    if (metodo != "5") {

    }

});

/*=============================================
AGREGANDO COTIZACION
=============================================*/

function adicionarCotizacion() {

    var cotizacionNuevoCliente = $("#cotizacionNuevoCliente option:selected").val();
    var cotizacionNuevoUsuarioCreacion = $("#hidden_usuario_creacion").val();

    if ($("#hidden_cotizacion_id").val() == "") {

        var datosCotizacion = new FormData();

        datosCotizacion.append("cotizacionNuevoCliente", cotizacionNuevoCliente);
        datosCotizacion.append("cotizacionNuevoUsuarioCreacion", cotizacionNuevoUsuarioCreacion);


        $.ajax({

            url: "ajax/cotizaciones.ajax.php",
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
    var cotizacionNuevoTipoViaje = $("[name='cotizacionNuevoTipoViaje']:checked").val();
    var cotizacionNuevoAerolinea = $("#cotizacionNuevoAerolinea option:selected").val();
    var cotizacionNuevoTipoMoneda = $("#cotizacionNuevoTipoMoneda option:selected").val();
    var cotizacionNuevoDetraccion = $("#cotizacionNuevoDetraccion").val();
    var cotizacionNuevoAdultosCantidad = $("#cotizacionNuevoAdultosCantidad").val();
    var cotizacionNuevoAdultosSF = $("#cotizacionNuevoAdultosSF").val();
    var cotizacionNuevoAdultosFee = $("#cotizacionNuevoAdultosFee").val();
    var cotizacionNuevoNinioCantidad = $("#cotizacionNuevoNinioCantidad").val();
    var cotizacionNuevoNinioSF = $("#cotizacionNuevoNinioSF").val();
    var cotizacionNuevoNinioFee = $("#cotizacionNuevoNinioFee").val();
    var cotizacionNuevoInfanteCantidad = $("#cotizacionNuevoInfanteCantidad").val();
    var cotizacionNuevoInfanteSF = $("#cotizacionNuevoInfanteSF").val();
    var cotizacionNuevoInfanteFee = $("#cotizacionNuevoInfanteFee").val();
    var cotizacionNuevoUsuarioCreacion = $("#hidden_usuario_creacion").val();

    var datosPropuesta = new FormData();

    datosPropuesta.append("cotizacionNuevoCotizacion", cotizacionNuevoCotizacion);
    datosPropuesta.append("cotizacionNuevoTipoViaje", cotizacionNuevoTipoViaje);
    datosPropuesta.append("cotizacionNuevoAerolinea", cotizacionNuevoAerolinea);
    datosPropuesta.append("cotizacionNuevoTipoMoneda", cotizacionNuevoTipoMoneda);
    datosPropuesta.append("cotizacionNuevoDetraccion", cotizacionNuevoDetraccion);
    datosPropuesta.append("cotizacionNuevoAdultosCantidad", cotizacionNuevoAdultosCantidad);
    datosPropuesta.append("cotizacionNuevoAdultosSF", cotizacionNuevoAdultosSF);
    datosPropuesta.append("cotizacionNuevoAdultosFee", cotizacionNuevoAdultosFee);
    datosPropuesta.append("cotizacionNuevoNinioCantidad", cotizacionNuevoNinioCantidad);
    datosPropuesta.append("cotizacionNuevoNinioSF", cotizacionNuevoNinioSF);
    datosPropuesta.append("cotizacionNuevoNinioFee", cotizacionNuevoNinioFee);
    datosPropuesta.append("cotizacionNuevoInfanteCantidad", cotizacionNuevoInfanteCantidad);
    datosPropuesta.append("cotizacionNuevoInfanteSF", cotizacionNuevoInfanteSF);
    datosPropuesta.append("cotizacionNuevoInfanteFee", cotizacionNuevoInfanteFee);
    datosPropuesta.append("cotizacionNuevoUsuarioCreacion", cotizacionNuevoUsuarioCreacion);

    for (var value of datosPropuesta.values()) {
        console.log("datosPropuesta : ", value); 
     }


    $.ajax({

        url: "ajax/propuestas.ajax.php",
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
        url: "ajax/itinerarios.ajax.php",
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
    $("#cotizacionNuevoDetraccion").val("");
    $("#cotizacionNuevoTotal").val("");

    $("#cotizacionNuevoAdultosCantidad").val("");
    $("#cotizacionNuevoAdultosSF").val("");
    $("#cotizacionNuevoAdultosFee").val("");
    $("#cotizacionNuevoAdultosTotalCF").val("");
    $("#cotizacionNuevoAdultosTotalGanancia").val("");

    $("#cotizacionNuevoNinioCantidad").val("");
    $("#cotizacionNuevoNinioSF").val("");
    $("#cotizacionNuevoNinioFee").val("");
    $("#cotizacionNuevoNinioTotalCF").val("");
    $("#cotizacionNuevoNinioTotalGanancia").val("");

    $("#cotizacionNuevoInfanteCantidad").val("");
    $("#cotizacionNuevoInfanteSF").val("");
    $("#cotizacionNuevoInfanteFee").val("");
    $("#cotizacionNuevoInfanteTotalCF").val("");
    $("#cotizacionNuevoInfanteTotalGanancia").val("");

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

        url: "ajax/propuestas.ajax.php",
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

}

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
}
