function registroSolicitud2() {

    var SolicitudPersonalizadaNombres = $("#SolicitudPersonalizadaNombres").val();
    var SolicitudPersonalizadaApellidos = $("#SolicitudPersonalizadaApellidos").val();
    var SolicitudPersonalizadaTelefono = $("#SolicitudPersonalizadaTelefono").val();
    var SolicitudPersonalizadaDocumento = $("#SolicitudPersonalizadaDocumento").val();
    var SolicitudPersonalizadaCorreo = $("#SolicitudPersonalizadaCorreo").val();
    var SolicitudPersonalizadaAdultos = $("#SolicitudPersonalizadaAdultos").val();
    var SolicitudPersonalizadaNinos = $("#SolicitudPersonalizadaNinos").val();
    var SolicitudPersonalizadaObservacion = $("#SolicitudPersonalizadaObservacion").val();
    var SolicitudPersonalizadaIdPaquete = $("#id_paquete2").val();
    var SolicitudPersonalizadaNueva2 = true;

    var SolicitudPersonalizada = new FormData();

    SolicitudPersonalizada.append("SolicitudPersonalizadaNombres", SolicitudPersonalizadaNombres);
    SolicitudPersonalizada.append("SolicitudPersonalizadaApellidos", SolicitudPersonalizadaApellidos);
    SolicitudPersonalizada.append("SolicitudPersonalizadaTelefono", SolicitudPersonalizadaTelefono);
    SolicitudPersonalizada.append("SolicitudPersonalizadaDocumento", SolicitudPersonalizadaDocumento);
    SolicitudPersonalizada.append("SolicitudPersonalizadaCorreo", SolicitudPersonalizadaCorreo);
    SolicitudPersonalizada.append("SolicitudPersonalizadaAdultos", SolicitudPersonalizadaAdultos);
    SolicitudPersonalizada.append("SolicitudPersonalizadaNinos", SolicitudPersonalizadaNinos);
    SolicitudPersonalizada.append("SolicitudPersonalizadaObservacion", SolicitudPersonalizadaObservacion);
    SolicitudPersonalizada.append("SolicitudPersonalizadaIdPaquete", SolicitudPersonalizadaIdPaquete);
    SolicitudPersonalizada.append("SolicitudPersonalizadaNueva2", SolicitudPersonalizadaNueva2);


    $.ajax({

        url: "ajax/ajax.paquete.php",
        method: "POST",
        data: SolicitudPersonalizada,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        beforeSend: function () {

            $("#loading-airplane").show();
        
        },
        success: function (respuesta) {

            $("#loading-airplane").hide();

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

                        $('#modal-soluciud-paquete').modal('hide');

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

                        $('#modal-soluciud-paquete').modal('hide');
                        limpiarSolicitudPersonalizada();

                    }
                });

            }

        }

    });
};