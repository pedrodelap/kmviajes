$(document).ready(function () {

    $("#loading-airplane").hide();
    console.info("hide");
    listarPaquetesDisponibles();
    listarCiudades();

    $('#SolicitudPersonalizadaCiudad').select2({

        closeOnSelect: false,
        placeholder: "Placeholder",
        allowHtml: true,
        allowClear: true,
        tags: true,
        width: 'resolve'
    });

    $("#SolicitudPersonalizadaServicios").select2({
        closeOnSelect: false,
        placeholder: "Placeholder",
        allowHtml: true,
        allowClear: true,
        tags: true,
        width: 'resolve'
    });



    $("#SolicitudPersonalizadaPaisCiudad").autocomplete({
        source: function (request, response) {

            $.ajax({
                url: "ajax/ajax.paquete.php",
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        select: function (event, ui) {
            $('#SolicitudPersonalizadaPaisCiudad').val(ui.item.label); // display the selected text
            $('#SolicitudPersonalizadaPaisCiudadId').val(ui.item.value); // save selected id to input
            return false;
        }
    });

});

$(".btn-buscar").click(function (e) {

    listarPaquetesDisponibles();

});

function listarPaquetesDisponibles() {


    var txtBuscar = $("#txtBuscar").val();

    var datos = new FormData();
    datos.append("txtBuscar", txtBuscar);
    console.log('load');

    $.ajax({
        url: "ajax/ajax.paquete.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "text",
        success: function (respuesta) {

            $("#content-data-paquete").html(respuesta);

        }
    });
};



function listarCiudades() {

    var datos = new FormData();
    datos.append("ciudad", "ciudad");


    $.ajax({
        url: "ajax/ajax.paquete.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "text",
        success: function (respuesta) {
            $("#SolicitudPersonalizadaCiudad").html(respuesta);

        }
    });
};




function registroSolicitud() {

    var SolicitudPersonalizadaNombres = $("#SolicitudPersonalizadaNombres").val();
    var SolicitudPersonalizadaApellidos = $("#SolicitudPersonalizadaApellidos").val();
    var SolicitudPersonalizadaTelefono = $("#SolicitudPersonalizadaTelefono").val();
    var SolicitudPersonalizadaDocumento = $("#SolicitudPersonalizadaDocumento").val();
    var SolicitudPersonalizadaCorreo = $("#SolicitudPersonalizadaCorreo").val();
    var SolicitudPersonalizadaCiudad = $("#SolicitudPersonalizadaPaisCiudadId").val();
    var SolicitudPersonalizadaFecha = $("#SolicitudPersonalizadaFecha").val();
    var SolicitudPersonalizadaFechaInicio = $('#SolicitudPersonalizadaFecha').data('daterangepicker').startDate.format('DD-MM-YYYY');
    var nSolicitudPersonalizadaFechaFin = $('#SolicitudPersonalizadaFecha').data('daterangepicker').endDate.format('DD-MM-YYYY');
    var SolicitudPersonalizadaAdultos = $("#SolicitudPersonalizadaAdultos").val();
    var SolicitudPersonalizadaNinos = $("#SolicitudPersonalizadaNinos").val();
    var SolicitudPersonalizadaObservacion = $("#SolicitudPersonalizadaObservacion").val();
    var SolicitudPersonalizadaIdPaquete = $("#id_paquete").val();
    //Servicios
    var SolicitudPersonalizadaServicios = $("#SolicitudPersonalizadaServicios").val().toString();
    var SolicitudPersonalizadaNueva = true;

    var SolicitudPersonalizada = new FormData();

    SolicitudPersonalizada.append("SolicitudPersonalizadaNombres", SolicitudPersonalizadaNombres);
    SolicitudPersonalizada.append("SolicitudPersonalizadaApellidos", SolicitudPersonalizadaApellidos);
    SolicitudPersonalizada.append("SolicitudPersonalizadaTelefono", SolicitudPersonalizadaTelefono);
    SolicitudPersonalizada.append("SolicitudPersonalizadaDocumento", SolicitudPersonalizadaDocumento);
    SolicitudPersonalizada.append("SolicitudPersonalizadaCorreo", SolicitudPersonalizadaCorreo);
    SolicitudPersonalizada.append("SolicitudPersonalizadaCiudad", SolicitudPersonalizadaCiudad);
    SolicitudPersonalizada.append("SolicitudPersonalizadaFecha", SolicitudPersonalizadaFecha);
    SolicitudPersonalizada.append("SolicitudPersonalizadaFechaInicio", SolicitudPersonalizadaFechaInicio);
    SolicitudPersonalizada.append("nSolicitudPersonalizadaFechaFin", nSolicitudPersonalizadaFechaFin);
    SolicitudPersonalizada.append("SolicitudPersonalizadaAdultos", SolicitudPersonalizadaAdultos);
    SolicitudPersonalizada.append("SolicitudPersonalizadaNinos", SolicitudPersonalizadaNinos);
    SolicitudPersonalizada.append("SolicitudPersonalizadaObservacion", SolicitudPersonalizadaObservacion);
    SolicitudPersonalizada.append("SolicitudPersonalizadaIdPaquete", SolicitudPersonalizadaIdPaquete);
    SolicitudPersonalizada.append("SolicitudPersonalizadaNueva", SolicitudPersonalizadaNueva);
    SolicitudPersonalizada.append("SolicitudPersonalizadaServicios", SolicitudPersonalizadaServicios);

    /*
    for (var value of SolicitudPersonalizada.values()) {
        console.log(value); 
     };*/

    $.ajax({

        url: "ajax/ajax.paquete.php",
        method: "POST",
        data: SolicitudPersonalizada,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            if (respuesta == "errorValidacionCliente") {

                //console.log("ingreso al primer if");
                Swal.fire({
                    type: "error",
                    title: "¡Los datos del solicitante no pueden ir vacíos o llevar caracteres especiales!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                }).then((result) => {
                    if (result.value) {

                        $('#modal-soluciud-personalizada').modal('hide');

                    }
                });
            }

            if (respuesta != "errorValidacionCliente") {

                //console.log("ingreso al segundo if");
                Swal.fire({
                    type: "success",
                    title: "La solicitud a sido registrada correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                }).then((result) => {
                    if (result.value) {

                        $('#modal-soluciud-personalizada').modal('hide');
                        limpiarSolicitudPersonalizada();

                    }
                });

            }

        }

    });
};

function limpiarSolicitudPersonalizada() {

    $("#SolicitudPersonalizadaNombres").val('');
    $("#SolicitudPersonalizadaApellidos").val('');
    $("#SolicitudPersonalizadaTelefono").val('');
    $("#SolicitudPersonalizadaDocumento").val('');
    $("#SolicitudPersonalizadaCorreo").val('');
    $("#SolicitudPersonalizadaCiudad").val('');
    $("#SolicitudPersonalizadaAdultos").val('');
    $("#SolicitudPersonalizadaNinos").val('');
    $("#SolicitudPersonalizadaObservacion").val('');

}



