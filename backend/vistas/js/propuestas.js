/*=============================================
EDITAR PROPUESTA
=============================================*/

$(".tablas").on("click", ".btnEditarPropuesta", function () {

    var idCliente = $(this).attr("idPropuesta");

    var datos = new FormData();
    datos.append("idPropuesta", idPropuesta);

    $.ajax({

        url: "ajax/ajax.propuestas.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            $("#hidden_propuesta_id").val(respuesta["id_propuesta"]);
            $("#hidden_cotizacion_id").val(respuesta["id_cotizacion"]);


            $("#cotizacionEditarAerolinea").html(respuesta["id_moneda"]);
            $("#cotizacionEditarAerolinea").val(respuesta["id_aerolinea"]);

            $("#cotizacionEditarTipoMoneda").html(respuesta["id_moneda"]);
            $("#cotizacionEditarTipoMoneda").val(respuesta["id_moneda"]);


            $("#idCliente").val(respuesta["tipo_viaje"]);

            $("[name='tipo_viaje']:checked").val();

            $("#cotizacionEditarCantidadAdultos").val(respuesta["adultos_cantidad"]);
            $("#cotizacionEditarPrecioAdultos").val(respuesta["adultos_precio"]);
            $("#cotizacionEditarComisionAdultos").val(respuesta["adultos_comision"]);
            $("#cotizacionEditarCantidadMenores").val(respuesta["menores_cantidad"]);
            $("#cotizacionEditarPrecioMenores").val(respuesta["menores_precio"]);
            $("#cotizacionEditarComisionMenores").val(respuesta["menores_comision"]);
            $("#cotizacionEditarDetraccion").val(respuesta["detracion"]);

        }

    });

});

/*=============================================
ELIMINAR CLIENTE
=============================================*/

$(".tablas").on("click", ".btnEliminarCliente", function () {

    var idCliente = $(this).attr("idCliente");
    console.log("idCliente", idCliente);

    Swal.fire({
        title: '¿Está seguro de borrar el cliente?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar cliente!'
    }).then((result) => {
        if (result.value) {

            window.location = "index.php?ruta=clientes&idCliente=" + idCliente;
        }

    })

})