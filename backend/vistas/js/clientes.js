/*=============================================
MODAL APPENDTO BODY CLIENTE
=============================================*/

$('#modalNuevoCliente').appendTo("body");
$('#modalEditarCliente').appendTo("body");

/*=============================================
EDITAR CLIENTE
=============================================*/

$(".tablas").on("click", ".btnEditarCliente", function () {

    console.log("dentro");
    var idCliente = $(this).attr("idCliente");

    var datos = new FormData();
    datos.append("idCliente", idCliente);

    $.ajax({


        url: "ajax/ajax.clientes.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            $("#idCliente").val(respuesta["id_cliente"]);
            $("#clienteEditarNombres").val(respuesta["nombres"]);
            $("#clienteEditarApellidos").val(respuesta["apellidos"]);
            $("#clienteEditarTipoDocumento").html(respuesta["tipo_documento"]);
            $("#clienteEditarTipoDocumento").val(respuesta["tipo_documento"]);
            $("#clienteEditarNumeroDocumento").val(respuesta["numero_documento"]);
            $("#clienteEditarCorreo").val(respuesta["correo"]);
            $("#clienteEditarTelefono").val(respuesta["telefono"]);
            $("#clienteEditarFechaNacimiento").val(respuesta["fecha_nacimiento"]);

        }

    })

})

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