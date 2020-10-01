$(document).ready(function () {
    listarPaquetesDisponibles();
    listarCiudades();

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
    var SolicitudPersonalizadaCiudad = $("#SolicitudPersonalizadaCiudad").val();
    var SolicitudPersonalizadaFecha = $("#SolicitudPersonalizadaFecha").val();
    var SolicitudPersonalizadaFechaInicio = $('#SolicitudPersonalizadaFecha').data('daterangepicker').startDate.format('DD-MM-YYYY');
    var nSolicitudPersonalizadaFechaFin = $('#SolicitudPersonalizadaFecha').data('daterangepicker').endDate.format('DD-MM-YYYY');
    var SolicitudPersonalizadaAdultos = $("#SolicitudPersonalizadaAdultos").val();
    var SolicitudPersonalizadaNinos = $("#SolicitudPersonalizadaNinos").val();
    var SolicitudPersonalizadaObservacion = $("#SolicitudPersonalizadaObservacion").val();
    var SolicitudPersonalizadaObservacionPaquete = $("#id_paquete").val();
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
    SolicitudPersonalizada.append("SolicitudPersonalizadaObservacionPaquete", SolicitudPersonalizadaObservacionPaquete);
    SolicitudPersonalizada.append("SolicitudPersonalizadaNueva", SolicitudPersonalizadaNueva);

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

            if(respuesta == "errorValidacionCliente"){

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

            if(respuesta != "errorValidacionCliente"){

                //console.log("ingreso al segundo if");
                Swal.fire({
                    type: "success",
                    title: "La propuesta a sido registrada correctamente",
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



function registroSolicitudDos() {

    var txtNombre = $("#txtNombre2").val();
    var txtApellidos = '';
    var nombreSeparete = txtNombre.split(" ");
    if (nombreSeparete.length > 1) {
        txtNombre = nombreSeparete[0];
        var txtApellidos = nombreSeparete[1];
    }

    var txtTelefono = $("#txtTelefono2").val();
    var txtDocumento = $("#txtDocumento2").val();
    var txtCorreo = $("#txtCorreo2").val();
    var id_paquete = $("#id_paquete2").val();

    var datosForm = new FormData();

    datosForm.append("txtNombre", txtNombre);
    datosForm.append("txtApellidos", txtApellidos);
    datosForm.append("txtTelefono", txtTelefono);
    datosForm.append("txtCorreo", txtCorreo);
    datosForm.append("txtFecha", "1-2");
    datosForm.append("txtDocumento", txtDocumento);

    datosForm.append("id_paquete", id_paquete);
    datosForm.append("nuevaSolicitud", "true");

    console.log("datosForm: ", datosForm);

    $.ajax({

        url: "ajax/ajax.paquete.php",
        method: "POST",
        data: datosForm,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {    
            
            $('#solicitud-modal-dos').modal('hide');

        }

    });
}