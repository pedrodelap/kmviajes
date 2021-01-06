function setupViewSeguimiento(idPaquete, fechaInicio, horaInicio, fechaFin, horaFin, checkin, checkout) {

    obtenerClientesDelPaquete(idPaquete, obtenerServiciosDelPaquete);
}

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
        success: function (respuesta) {

            console.info(respuesta);
            $("ulContenidoClientes").empty();
            respuesta.forEach(element => {
                $("#ulContenidoClientes").append('<li class="list-group-item">' +
                    '<div class= "todo-indicator bg-info"></div>' +
                    '<div class="widget-content p-0">' +
                    '<div class="widget-content-wrapper">' +
                    '<div class="widget-content-left mr-2">' +
                    '<div class="custom-checkbox custom-control">' +
                    '<input type="checkbox" id="checkbox_pasajero_' + element['id_pasajero'] + '" class="custom-control-input">' +
                    '<label class="custom-control-label" for="checkbox_pasajero_' + element['id_pasajero'] + '">&nbsp;</label>' +
                    '</div>' +
                    '</div>' +
                    '<div class="widget-content-left">' +
                    '<div class="widget-heading">' + element['apellidos'] + " " + element["nombres"] +
                    '</div>' +
                    '<div class="widget-subheading"><i><b>' + element['tipo_doc'] + '</b>' + element['nro_doc'] + '</i></div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</li>');
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
        success: function (respuesta) {

            console.info(respuesta);
            $('#section-seguimiento').css('display', 'flex');

        }

    });
}