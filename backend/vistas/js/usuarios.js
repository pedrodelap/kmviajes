/*=============================================
MODAL APPENDTO BODY USUARIO
=============================================*/

$('#modalNuevoUsuario').appendTo("body");
$('#modalEditarUsuario').appendTo("body");

/*=============================================
EDITAR USUARIO
=============================================*/

$(".tablas").on("click", ".btnEditarUsuario", function() {

    var idUsuario = $(this).attr("idUsuario");

    var datos = new FormData();
    datos.append("idUsuario", idUsuario);

    $.ajax({


        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            $("#idUsuario").val(respuesta["id_usuario"]);
            $("#usuarioEditarNombres").val(respuesta["nombres"]);
            $("#usuarioEditarApellidos").val(respuesta["apellidos"]);
            $("#usuarioEditarTipoDocumento").val(respuesta["usuario"]);
            $("#usuarioEditarTipoDocumento").val(respuesta["password"]);
            $("#usuarioEditarNumeroDocumento").val(respuesta["foto"]);
            $("#usuarioEditarCorreo").val(respuesta["estado"]);

        }

    })

})

/*=============================================
ELIMINAR USUARIO
=============================================*/

$(".tablas").on("click", ".btnEliminarUsuario", function() {

    var idUsuario = $(this).attr("idUsuario");
    console.log("idUsuario", idUsuario);

    Swal.fire({
        title: '¿Está seguro de borrar el usuario?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar usuario!'
    }).then((result) => {
        if (result.value) {

            window.location = "index.php?ruta=usuarios&idUsuario=" + idUsuario;
        }

    })

})