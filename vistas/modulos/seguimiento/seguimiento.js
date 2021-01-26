

$(document).ready(function () {
    //card validation on input fields


    $('#pagar-modal input[type=text]').on('keyup', function () {
        cardFormValidate();
    });

    /* 1. Visualizing things on Hover - See next part for action on click */
    $('.stars li').on('mouseover', function () {
        var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

        // Now highlight all the stars that's not after the current hovered star
        $(this).parent().children('li.star').each(function (e) {
            if (e < onStar) {
                $(this).addClass('hover');
            }
            else {
                $(this).removeClass('hover');
            }
        });

    }).on('mouseout', function () {
        $(this).parent().children('li.star').each(function (e) {
            $(this).removeClass('hover');
        });
    });


    /* 2. Action to perform on click */
    $('.stars li').on('click', function () {
        console.log();
        var onStar = parseInt($(this).data('value'), 10); // The star currently selected
        var stars = $(this).parent().children('li.star');

        for (i = 0; i < stars.length; i++) {
            $(stars[i]).removeClass('selected');
        }

        for (i = 0; i < onStar; i++) {
            $(stars[i]).addClass('selected');
        }

        // JUST RESPONSE (Not needed)
        var q = $(this).parent().find("li.selected");
        var ratingValue = parseInt(q.length, 10);

        console.log(ratingValue);
        console.log($(this).parent('ul').data('relation'));
        if (ratingValue <= 3) {
            $("#" + $(this).parent('ul').data('relation')).fadeIn(500);
        }
        else {
            $("#" + $(this).parent('ul').data('relation')).fadeOut(300);
        }


    });
    $('.div-calificacion-tipo').on('click', function () {
        if (!$(this).hasClass("div-calificacion-tipo-selected")) {
            $(this).addClass("div-calificacion-tipo-selected");
        } else {
            $(this).removeClass("div-calificacion-tipo-selected");
        }

    });

});


function realizarPago() {

    var referenceCode = $("#codigoSeguimiento").val();
    var amount = $("#amount").val();
    var currency = "USD";
    var description = $("#description").val();
    var emailAddress = $("#txtCorreo").val();
    var fullName = $("#name_on_card").val();
    var phone = $("#phone").val();
    var merchantPayerId = $("#merchantPayerId").val();
    var number = $("#card_number").val().replace(/\s/g, '');
    var securityCode = $("#cvv").val();
    var expirationDate = $("#expiry_year").val() + "/" + $("#expiry_month").val();
    var paymentMethod = tipoTarjeta.toUpperCase() == "VISA" ? "VISA" : "MASTERCARD";
    var dniNumber = $("#dniNumber").val();
    var id_solicitud = $("#id_solicitud").val();
    var pagar = true;

    var formPago = new FormData();

    formPago.append("referenceCode", referenceCode);
    formPago.append("amount", amount);
    formPago.append("currency", currency);
    formPago.append("description", description);
    formPago.append("emailAddress", emailAddress);
    formPago.append("fullName", fullName);
    formPago.append("phone", phone);
    formPago.append("merchantPayerId", merchantPayerId);
    formPago.append("number", number);
    formPago.append("securityCode", securityCode);
    formPago.append("expirationDate", expirationDate);
    formPago.append("paymentMethod", paymentMethod);
    formPago.append("dniNumber", dniNumber);
    formPago.append("id_solicitud", id_solicitud);
    formPago.append("pagar", pagar);


    $.ajax({

        url: "ajax/ajax.paquete.php",
        method: "POST",
        data: formPago,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        beforeSend: function () {
            $("#loading-airplane").show();
        },
        success: function (respuesta) {
            $("#loading-airplane").hide();
            var state = respuesta.transactionResponse.state;

            if (state == "APPROVED") {

                Swal.fire({
                    type: "success",
                    title: "El pago se realizó correctamente código:" + respuesta.transactionResponse.orderId,
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                }).then((result) => {
                    if (result.value) {

                        location.reload();
                    }
                });

            }
            else {


                Swal.fire({
                    type: "error",
                    title: respuesta.transactionResponse.paymentNetworkResponseErrorMessage,
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                }).then((result) => {
                    if (result.value) {

                        $('#pagar-modal').modal('hide');

                    }
                });



            }
        }

    });
};


function limpiarDatosTarjeta() {
    $("#card_number").val('');
    $("#cvv").val('');
    $("#expiry_year").val('');
    $("#expiry_month").val('');

}



function registrarEstado() {

    var id_solicitud = $("#id_solicitud").val();
    var estado = "Aceptada";
    var cambiarEstado = true;

    var formPago = new FormData();

    formPago.append("estado", estado);
    formPago.append("id_solicitud", id_solicitud);
    formPago.append("cambiarEstado", cambiarEstado);

    console.log(formPago);
    $.ajax({

        url: "ajax/ajax.paquete.php",
        method: "POST",
        data: formPago,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        beforeSend: function () {
            $("#loading-airplane").show();
        },
        success: function (respuesta) {

            $("#loading-airplane").hide();

            if (respuesta = 'ok') {

                console.log(respuesta);

                Swal.fire({
                    title: "¡OK!",
                    text: "¡Cotización aceptada correctamente!",
                    icon: "success",
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                }).then((result) => {
                    if (result.value) {

                        // location.reload();
                    }
                });

            }

        }

    });
}

function guardarCalificacion() {
    var calificacionAerolinea = $("#starsAerolinea > li.selected").length;
    var calificacionHotel = $("#starsHotel > li.selected").length;
    var id_hotel = $("#id_hotel").val();
    var id_aerolinea = $("#id_aerolinea").val();
    var id_solicitud = $("#id_solicitud").val();

    var mejoraAerolinea = [];
    $(".content-div-Aerolinea > div.div-calificacion-tipo-selected").each(function () {
        mejoraAerolinea.push($(this).text().trim());
    });

    var mejoraHotel = [];
    $(".content-div-hotel > div.div-calificacion-tipo-selected").each(function () {
        mejoraHotel.push($(this).text().trim());
    });

    var arrayServicios = [];

    $("#tableServices-calificable > tbody > tr").each(function () {
        var y = $(this).find("ul");
        var x = $(this).find("ul > li.selected");

        var objServicio = {
            "idServicio": $(y).data('service'),
            "valor": x.length
        };
        arrayServicios.push(objServicio);
    });

    /*var diccionario = {
        "id_solicitud": id_solicitud,
        "id_hotel": id_hotel,
        "id_aerolinea": id_aerolinea,
        "calificacionAerolinea": calificacionAerolinea,
        "calificacionHotel": calificacionHotel,
        "mejoraAerolinea": mejoraAerolinea.toString(),
        "mejoraHotel": mejoraHotel.toString(),
        "servicios": arrayServicios,
        "comentarios": $("#comentarioCalificacion").val()
    }*/

    var formPago = new FormData();
    formPago.append("id_solicitud", id_solicitud);
    formPago.append("id_hotel", id_hotel);
    formPago.append("id_aerolinea", id_aerolinea);
    formPago.append("calificacionAerolinea", calificacionAerolinea);
    formPago.append("calificacionHotel", calificacionHotel);
    formPago.append("mejoraAerolinea", mejoraAerolinea.toString());
    formPago.append("mejoraHotel", mejoraHotel.toString());
    formPago.append("servicios", JSON.stringify(arrayServicios));
    formPago.append("comentarios", $("#comentarioCalificacion").val());
    formPago.append("calificar", true);
    $.ajax({

        url: "ajax/ajax.paquete.php",
        method: "POST",
        data: formPago,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        beforeSend: function () {
            $("#loading-airplane").show();
        },
        success: function (respuesta) {
            $("#loading-airplane").hide();
            console.log(respuesta);

            Swal.fire({
                type: "success",
                title: "Datos enviados correctamente",
                showConfirmButton: true,
                confirmButtonText: "Cerrar",
                closeOnConfirm: false
            }).then((result) => {
                if (result.value) {

                    location.reload();
                }
            });

        }

    });


}