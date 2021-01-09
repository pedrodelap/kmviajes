$(document).ready(function () {
    $("#loading-backend").hide();
});

function generateXML(id) {

    var formPago = new FormData();

    formPago.append("id_venta", id);
    formPago.append("xml", true);
    $.ajax({

        url: "ajax/ajax.ventas.php",
        method: "POST",
        data: formPago,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "text",
        beforeSend: function () {
            $("#loading-backend").show();
        },
        success: function (respuesta) {
            $("#loading-backend").hide();

            console.log(respuesta);

            Swal.fire({
                title: "Información",
                text: "Documento generado correctamente.",
                icon: "success",
                confirmButtonText: "Cerrar",
                closeOnConfirm: false
            }).then((result) => {

            });
        }

    });
};

function generatePDF(id) {

    var formPago = new FormData();
    formPago.append("id_venta", id);
    formPago.append("pdf", true);
    $.ajax({

        url: "ajax/ajax.ventas.php",
        method: "POST",
        data: formPago,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "text",
        beforeSend: function () {
            $("#loading-backend").show();
        },
        success: function (respuesta) {
            $("#loading-backend").hide();

            console.log(respuesta);
            window.open('/PDF/invoice/document_' + id + '.pdf', '_blank');
        }

    });
};