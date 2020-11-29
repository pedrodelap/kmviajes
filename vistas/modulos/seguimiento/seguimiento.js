$(document).ready(function () {
    //card validation on input fields
    $('#pagar-modal input[type=text]').on('keyup', function () {
        cardFormValidate();
    });

    $(".my-rating-4").starRating({
        totalStars: 5,
        starShape: 'rounded',
        starSize: 25,
        emptyColor: 'lightgray',
        hoverColor: '#da4d4d',
        activeColor: '#da4d4d',
        useGradient: true
    });
    $("#idHotelAll").starRating({
        totalStars: 5,
        starShape: 'rounded',
        starSize: 25,
        disableAfterRate: false,
        emptyColor: 'lightgray',
        hoverColor: '#da4d4d',
        activeColor: '#da4d4d',
        useGradient: false,
        minRating: 1,
        initialRating: 0,
        callback: function (currentRating, $el) {
            console.log(currentRating);

            if (currentRating > 3) {
                $("#divCalificarHotel").show();
            }
        }
    });

    var navListItems = $('div.setup-panel div a'),
        allWells = $('.setup-content'),
        allNextBtn = $('.nextBtn');

    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-success').addClass('btn-default');
            $item.addClass('btn-success');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    allNextBtn.click(function () {
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url']"),
            isValid = true;

        $(".form-group").removeClass("has-error");
        for (var i = 0; i < curInputs.length; i++) {
            if (!curInputs[i].validity.valid) {
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-success').trigger('click');

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