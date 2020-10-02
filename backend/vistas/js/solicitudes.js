/*=============================================
MODAL APPENDTO BODY CLIENTE
=============================================*/

$('#modalDatosSolicitante').appendTo("body");

$('#modalDatosPaquete').appendTo("body");


/*=============================================
MOSTRAR DATOS DEL CLIENTE
=============================================*/

$(".btmMostrarSolicitante").click(function() {

    var idClienteSolicitud = $(this).attr("idCliente");
    var idClientes = new FormData();
    idClientes.append("idClienteSolicitud", idClienteSolicitud);
    idClientes.append("idClienteDato", true);

    $.ajax({

        url: "ajax/ajax.clientes.php",
        method: "POST",
        data: idClientes,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            $nombreCompleto = respuesta["nombres"] + ' ' + respuesta["apellidos"];         
            $("#solicitanteNombre").val($nombreCompleto);
            $("#solicitanteTelefono").val(respuesta["numero_documento"]);
            $("#solicitanteCorreo").val(respuesta["correo"])
            $('#modalDatosSolicitante').modal('show');

        }

    });

});


/*=============================================
MOSTRAR DETALLE DEL PAQUETE DE LA SOLICITUD
=============================================*/

$(".btnDetallePaqueteSolicitud2").click(function() {

    var idPaqueteDeSolicitud = $(this).attr("idPaqueteDeSolicitud");

    console.log("idPaqueteDeSolicitud: ",idPaqueteDeSolicitud);

    var datos = new FormData();

    datos.append("idPaqueteDeSolicitud", idPaqueteDeSolicitud);

    $.ajax({

        url: "ajax/ajax.solicitudes.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            console.log("respuesta: ",respuesta);

            $('#modalDatosPaquete').modal('show');

        }

    });


});



/*=============================================
CAMBIAR ESTADO DE LA SOLICITUD DE REGISTRADA A COTIZADA
=============================================*/

$(".table").on("click", ".estadoSolicitudRegistrada", function() {

    var idSolicitud = $(this).attr("idSolicitud");
    console.log("idSolicitud", idSolicitud);

    Swal.fire({
        title: '¿Está seguro de cambiar la solicitud a Cotizada?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#16aaff',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, cambiar la solicitud a Cotizada!'
    }).then((result) => {
        if (result.value) {

            console.log("idSolicitud", idSolicitud);
        }

    })

});


/*=============================================
CAMBIAR ESTADO DE LA SOLICITUD DE REGISTRADA A COTIZADA
=============================================*/

$(".table").on("click", ".estadoSolicitudCotizada", function() {

    var idSolicitud = $(this).attr("idSolicitud");
    console.log("idSolicitud", idSolicitud);

    Swal.fire({
        title: '¿Está seguro de cambiar la solicitud a En Reserva?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3ac47d',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, cambiar la solicitud a En Reserva!'
    }).then((result) => {
        if (result.value) {

            console.log("idSolicitud", idSolicitud);
        }

    })

});