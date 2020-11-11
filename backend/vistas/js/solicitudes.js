/*=============================================
MODAL APPENDTO BODY CLIENTE
=============================================*/

$('#modalDatosSolicitante').appendTo("body");

$('#modalDatosPaquete').appendTo("body");


/*=============================================
MOSTRAR DATOS DEL CLIENTE
=============================================*/

function btmMostrarSolicitante( idCliente) {

    var idClienteSolicitud = idCliente;
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
}

/*=============================================
MOSTRAR DETALLE DEL PAQUETE DE LA SOLICITUD
=============================================*/

function btnDetallePaqueteSolicitud( idPaqueteDeSolicitudT) {

    var idPaqueteDeSolicitudT = idPaqueteDeSolicitudT;

    //console.log("idPaqueteDeSolicitudT: ",idPaqueteDeSolicitudT);

    var datos = new FormData();

    datos.append("idPaquete", true);
    datos.append("idPaqueteDeSolicitudT", idPaqueteDeSolicitudT);

    $.ajax({

        url: "ajax/ajax.solicitudes.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            if(respuesta != "error"){

                //console.log("en el If ");
                //console.log("respuesta: ",respuesta);
                $('#datosPaqueteMostrar1').html(respuesta);
                $("#solicitanteTelefono").val(respuesta["numero_documento"]);
                $('#modalDatosPaquete').modal('show');

            }else{

                console.log("en el Else ");
                console.log("respuesta: ",respuesta);

            }



        }

    });

}

/*=============================================
CAMBIAR ESTADO DE LA SOLICITUD DE REGISTRADA A COTIZADA
=============================================*/

$(".table").on("click", ".estadoSolicitudRegistrada", function() {

    var idSolicitud = $(this).attr("idSolicitud");

    var datos = new FormData();

    datos.append("idSolicitud", idSolicitud);
    datos.append("Cotizada", true);

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

            $.ajax({

                url: "ajax/ajax.solicitudes.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta) {
        
                    if(respuesta == "ok"){
        
                        console.log("respuesta: ",respuesta);

                        Swal.fire({
                            type: "success",
                            title: "La solicitud ha sido cambiada correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                            }).then((result) => {
                                      if (result.value) {
  
                                          window.location = "solicitudes";
  
                                      }
                        });
                                
                    }
        
                }
        
            });
            
        }

    })

});


/*=============================================
CAMBIAR ESTADO DE LA SOLICITUD DE REGISTRADA A COTIZADA
=============================================*/

$(".table").on("click", ".estadoSolicitudAceptada", function() {

    var idSolicitud = $(this).attr("idSolicitud");

    var datos = new FormData();

    datos.append("idSolicitud", idSolicitud);
    datos.append("Reservada", true);


    Swal.fire({
        title: '¿Está seguro de cambiar la solicitud a En Reserva?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#6c757d',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, cambiar la solicitud a En Reserva!'
    }).then((result) => {
        if (result.value) {

            console.log("idSolicitud", idSolicitud);

            $.ajax({

                url: "ajax/ajax.solicitudes.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta) {
        
                    if(respuesta == "ok"){
        
                        console.log("respuesta: ",respuesta);

                        Swal.fire({
                            type: "success",
                            title: "La solicitud ha sido cambiada correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                            }).then((result) => {
                                      if (result.value) {
  
                                          window.location = "solicitudes";
  
                                      }
                        });
                                
                    }
        
                }
        
            });


        }

    })

});



/*=============================================
MOSTRAR DETALLE DEL PAQUETE DE LA SOLICITUD
=============================================*/

function btnDetalleSinPaqueteSolicitud(idSolicitudSinPaquete ) {

    var idSolicitud = idSolicitudSinPaquete;

    window.location = "index.php?ruta=cotizacion-crear&idSolicitud="+idSolicitud;

}