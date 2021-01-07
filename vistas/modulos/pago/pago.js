var amountHabitacion = 0;
$(document).ready(function () {

    $('#pagar-form input[type=text]').on('keyup', function () {
        cardFormValidate();
    });

    $(".my-rating-hotel").starRating({

        starShape: 'rounded',
        starSize: 16,
        emptyColor: 'lightgray',
        hoverColor: '#da4d4d',
        activeColor: '#da4d4d',
        useGradient: true,
        readOnly: true
    });
    $("#divInvoice").hide();

    $('#needInvoice').change(function () {
        if (this.checked) {
            debugger;
            $("#divInvoice").show();
        } else {
            $("#divInvoice").hide();
        }
    });

    $(".div-habitacion-pago").click(function () {
        if (!$(this).hasClass("div-habitacion-pago-selected")) {
            $(".div-habitacion-pago").removeClass("div-habitacion-pago-selected");
            $(this).find("input[type=radio]").prop("checked", true);
            var roomPrice = $(this).find("input[type=hidden]").val();
            var amount = $("#amount").val();
            amountHabitacion = parseFloat(roomPrice);
            newAmount = parseFloat(amount) + amountHabitacion;

            $("#tr-cambio-habitacion").toggle();

            $("#th-cambio-habitacion").text("$ " + amountHabitacion.toFixed(2));
            $("#th-amount-total").text("$ " + newAmount.toFixed(2));
            $("#span-total").text(newAmount.toFixed(2));

            $(this).addClass("div-habitacion-pago-selected");
        }


    });
});


function cardFormValidate() {
    var cardValid = 0;

    //card number validation
    $('#card_number').validateCreditCard(function (result) {
        if (result.valid) {
            $("#card_number").removeClass('required');
            switch (result.card_type.name) {
                case "visa":
                    $("#type").html('<img class="img_card " src="https://img.icons8.com/color/48/000000/visa.png"/>');
                    break;
                case "mastercard":
                    $("#type").html('<img class="img_card"  src="https://img.icons8.com/fluent/48/000000/mastercard.png"/>');
                    break;
                case "amex":
                    $("#type").html('<img class="img_card"  src="https://img.icons8.com/fluent/48/000000/amex.png"/>');

                    break;
                case "diners_club_international":
                    $("#type").html('<img class="img_card"  src="https://img.icons8.com/color/48/000000/diners-club.png"/>');
                    break;

                case "maestro":
                    $("#type").html('<img class="img_card"  src="https://img.icons8.com/color/48/000000/discover.png"/>');

                    break;
                default:
                    $("#type").html('<img class="img_card"  src="https://img.icons8.com/android/48/000000/bank-card-back-side.png"/>');

                    break;
            }
            tipoTarjeta = result.card_type.name;
            $("#card_number").removeClass("inp-icon-fail");
            $("#card_number").addClass("inp-icon");
            $("#btn_pagar").prop('disabled', false);
            cardValid = 1;
        } else {

            $("#card_number").removeClass("inp-icon");
            $("#card_number").addClass("inp-icon-fail");
            $("#btn_pagar").prop('disabled', true);
            cardValid = 0;
        }
    });

    //card details validation
    var cardName = $("#name_on_card").val();
    var expMonth = $("#expiry_month").val();
    var expYear = $("#expiry_year").val();
    var cvv = $("#cvv").val();
    var regName = /^[a-z ,.'-]+$/i;
    var regMonth = /^01|02|03|04|05|06|07|08|09|10|11|12$/;
    var regYear = /^2020|2021|2022|2023|2024|2025|2026|2027|2028|2029|2030|2031|2031|2032|2033|2034|2035$/;
    var regCVV = /^[0-9]{3,3}$/;
    if (cardValid == 0) {
        $("#card_number").addClass('required');
        $("#card_number").focus();
        return false;
    } else if (!regMonth.test(expMonth)) {
        $("#card_number").val(cc_format($("#card_number").val()));
        $("#card_number").removeClass('required');
        $("#expiry_month").addClass('required');
        $("#expiry_month").focus();
        return false;
    } else if (!regYear.test(expYear)) {
        $("#card_number").removeClass('required');
        $("#expiry_month").removeClass('required');
        $("#expiry_year").addClass('required');
        $("#expiry_year").focus();
        return false;
    } else if (!regCVV.test(cvv)) {
        $("#card_number").removeClass('required');
        $("#expiry_month").removeClass('required');
        $("#expiry_year").removeClass('required');
        $("#cvv").addClass('required');
        $("#cvv").focus();
        return false;
    } else if (!regName.test(cardName)) {
        $("#card_number").removeClass('required');
        $("#expiry_month").removeClass('required');
        $("#expiry_year").removeClass('required');
        $("#cvv").removeClass('required');
        $("#name_on_card").addClass('required');
        $("#name_on_card").focus();
        return false;
    } else {
        $("#card_number").removeClass('required');
        $("#expiry_month").removeClass('required');
        $("#expiry_year").removeClass('required');
        $("#cvv").removeClass('required');
        $("#name_on_card").removeClass('required');
        return true;
    }
}

function cc_format(value) {
    var v = value.replace(/\s+/g, '').replace(/[^0-9]/gi, '')
    var matches = v.match(/\d{4,16}/g);
    var match = matches && matches[0] || ''
    var parts = []
    for (i = 0, len = match.length; i < len; i += 4) {
        parts.push(match.substring(i, i + 4))
    }
    if (parts.length) {
        return parts.join(' ')
    } else {
        return value
    }
}

var tipoTarjeta = "VISA";

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
    var cuotas = $("#FormaPago_NroCuotas").val();
    var ruc = $("#txtRuc").val();
    var razon_social = $("#txtRazon").val();
    var idHabitacion = $('input[name="habitacionRadio"]:checked').val();
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
    formPago.append("cuotas", cuotas);
    formPago.append("ruc", ruc);
    formPago.append("razon_social", razon_social);
    formPago.append("pagar", pagar);
    formPago.append("idHabitacion", idHabitacion);

    numPasajeros = $("#pasajeros").text();
    var arrayPasajeros = [];
    for (i = 0; i < numPasajeros; i++) {
        var objPasajero = {
            "firstname": $("#firstname" + i).val(),
            "lastname": $("#lastname" + i).val(),
            "docnumberType": $("#docnumberType" + i).val(),
            "docNumber": $("#docNumber" + i).val()
        };
        arrayPasajeros.push(objPasajero);
    }

    formPago.append("pasajeros", JSON.stringify(arrayPasajeros));


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

                        window.location.href = '/index.php?ruta=seguimiento&codseg=' + referenceCode;
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

function savePasajeros() {
    numPasajeros = $("#pasajeros").text();

    var arrayPasajeros = [];
    for (i = 0; i < numPasajeros; i++) {
        var objPasajero = {
            "firstname": $("#firstname" + i).val(),
            "lastname": $("#lastname" + i).val(),
            "docnumberType": $("#docnumberType" + i).val(),
            "docNumber": $("#docNumber" + i).val()
        };
        arrayPasajeros.push(objPasajero);
    }


    console.log(arrayPasajeros);
    var formPago = new FormData();
    formPago.append("invoice", true);
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
            debugger;

            console.log(respuesta);
        }

    });
};
