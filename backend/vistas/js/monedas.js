/*=============================================
MODAL APPENDTO BODY MONEDA
=============================================*/

$('#modalNuevoMoneda').appendTo("body");
$('#modalEditarMoneda').appendTo("body");

/*=============================================
EDITAR MONEDA
=============================================*/

$(".tablas").on("click", ".btnEditarMoneda", function() {

    var idMoneda = $(this).attr("idMoneda");

    var datos = new FormData();
    datos.append("idMoneda", idMoneda);

    $.ajax({


        url: "ajax/monedas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            $("#idMoneda").val(respuesta["id_moneda"]);
            $("#monedaEditarNombre").val(respuesta["nombre"]);
            $("#monedaEditarSimbolo").val(respuesta["simbolo"]);
            $("#monedaEditarCompra").val(respuesta["compra"]);
            $("#monedaEditarVenta").val(respuesta["venta"]);

        }

    });

});

/*=============================================
ELIMINAR MONEDA
=============================================*/

$(".tablas").on("click", ".btnEliminarMoneda", function() {

    var idMoneda = $(this).attr("idMoneda");
    console.log("idMoneda", idMoneda);

    Swal.fire({
        title: '¿Está seguro de borrar la moneda?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar moneda!'
    }).then((result) => {
        if (result.value) {

            window.location = "index.php?ruta=monedas&idMoneda=" + idMoneda;
        }

    });

});