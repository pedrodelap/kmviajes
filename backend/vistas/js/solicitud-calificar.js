$(document).ready(function () {

    $('#modalCheck').appendTo("body");
    $('#modalIncidente').appendTo("body");
    $('.dateFormat').datepicker({
        format: 'dd-mm-yyyy'
    });




});

function obtenerClientesDelPaquete(idPaquete, callback) {
    console.log("obtener clientes " + idPaquete);
    var datos = new FormData();
    datos.append("idPaquete", idPaquete);
    datos.append("clientesDelPaquete", true);

    $.ajax({
        url: "ajax/ajax.paquetes.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        beforeSend: function () {

            $("#incidentePasajero").empty();
            $("#loading-backend").show();
        },
        success: function (respuesta) {

            console.info(respuesta);
            respuesta.forEach(element => {
                $("#incidentePasajero").append('<option value="' + element['id_pasajero'] + '" data-badge="1">' + element['apellidos'] + " " + element["nombres"] + '</option>');
            });
            $("#incidentePasajero").select2({
                closeOnSelect: false,
                placeholder: "Placeholder",
                allowHtml: true,
                allowClear: true,
                tags: true,
                width: 'resolve'
            });

            if (callback != null) {
                callback(idPaquete);
            }
        }

    });
}


function obtenerServiciosDelPaquete(idPaquete) {
    console.log("obtener servicios " + idPaquete);
    var datos = new FormData();
    datos.append("idPaquete", idPaquete);
    datos.append("serviciosDelPaquete", true);

    $.ajax({
        url: "ajax/ajax.paquetes.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        beforeSend: function () {
            $("#form-servicios-ofrecidos").empty();
            $("#loading-backend").show();
        },
        success: function (respuesta) {

            respuesta.forEach(element => {
                console.info(element);
                $("#form-servicios-ofrecidos").append('<div class="position-relative form-check" > <label class="form-check-label"><input ' +
                    'type="checkbox" class="form-check-input servicio_incidente" value="' + element['id_servicio'] + '">' +
                    '<i class="' + element['icono'] + '"></i>' + element['nombre'] + '</label></div>');
            });
            $("#loading-backend").hide();
            $("#modalIncidente").modal('show');



        }

    });
}


function mostrarModalCheck(idPaquete, fechaInicio, horaInicio, fechaFin, horaFin, checkin, checkout) {

    if (checkin != "-" && checkout != "") {
        Swal.fire({
            type: "warning",
            title: "Validación de fechas ya fueron registradas",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: false
        }).then((result) => {

        });
    } else {
        $("#tipo-check").text(checkin == "-" ? "Check-In" : "Check-Out");

        if (checkin == '-') {
            $("#fecha_vuelo").val(fechaInicio);
            $("#hora_vuelo").val(horaInicio);
        } else {
            $("#fecha_vuelo").val(fechaFin);
            $("#hora_vuelo").val(horaFin);
        }
        $("#btn-check").attr("onclick", "guardarcheck(" + idPaquete + ",'" + checkin + "')");
        $("#modalCheck").modal('show');
    }

}
function clearModals() {

}

function mostrarModalRegistroIncidencia(idPaquete) {

    obtenerClientesDelPaquete(idPaquete, obtenerServiciosDelPaquete);
    $("#btn-incidente").attr("onclick", "guardarIncidente(" + idPaquete + ")");
}

function guardarcheck(idPaquete, checkin) {
    var datos = new FormData();

    var fecha_vuelo_real = $("#fecha_vuelo_real").val();
    var hora_vuelo_real = $("#hora_vuelo_real").val();
    var fecha_hotel_real = $("#fecha_hotel_real").val();
    var check_comentarios = $("#check_comentarios").val();

    datos.append("idPaquete", idPaquete);
    datos.append("fecha_vuelo_real", fecha_vuelo_real);
    datos.append("hora_vuelo_real", hora_vuelo_real);
    datos.append("fecha_hotel_real", fecha_hotel_real);
    datos.append("check_comentarios", check_comentarios);
    datos.append("check", true);
    datos.append("checkTipo", checkin == "-" ? "Check-In" : "Check-Out");

    $.ajax({

        url: "ajax/ajax.seguimiento.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            if (respuesta != "false") {

                console.log("respuesta: ", respuesta);

                Swal.fire({
                    type: "success",
                    title: "Se guardó correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                }).then((result) => {
                    if (result.value) {
                        window.location = "solicitud-calificar";
                    }
                });

            }

        }

    });
}


function guardarIncidente(idPaquete) {
    var datos = new FormData();

    var arrayTipo = [];
    var arrayServicios = [];
    $("input:checked").each(function () {
        console.log(this);
        if ($(this).hasClass("tipo_incidente")) {
            var value = $(this).val();
            arrayTipo.push(value);

        }
        if ($(this).hasClass("servicio_incidente")) {
            var value = $(this).val();
            arrayServicios.push(value);

        }
    });

    var comentarioIncidente = $("#comentarioIncidente").val();

    datos.append("idPaquete", idPaquete);
    datos.append("comentarioIncidente", comentarioIncidente);
    datos.append("incidentePasajero", JSON.stringify($("#incidentePasajero").select2("val")));
    datos.append("incidente", true);
    datos.append("tipos", JSON.stringify(arrayTipo));
    datos.append("servicio", JSON.stringify(arrayServicios));
    debugger;
    for (var pair of datos.entries()) {
        console.log(pair[0] + ', ' + pair[1]);
    }
    $.ajax({

        url: "ajax/ajax.seguimiento.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            if (respuesta != "false") {

                console.log("respuesta: ", respuesta);

                Swal.fire({
                    type: "success",
                    title: "Se guardó correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                }).then((result) => {
                    if (result.value) {
                        window.location = "solicitud-calificar";
                    }
                });

            }

        }

    });
}
