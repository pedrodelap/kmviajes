/*=============================================
MODAL APPENDTO BODY USUARIO
=============================================*/

$('#modalNuevoUsuario').appendTo("body");
$('#modalEditarUsuario').appendTo("body");

/*=============================================
Mostrar Formulario Registro Perfil
=============================================*/
$("#registrarPerfil").click(function() {

    $("#formularioPerfil").toggle("fast");

})

$("#subirFotoPerfil").change(function() {

    $("#subirFotoPerfil").attr("name", "nuevaImagen");

});

/*=============================================
Mostrar Formulario Editar Perfil
=============================================*/
$("#btnEditarPerfil").click(function() {

    var idUsuario = $('#editarId').val();

    var datos = new FormData();
    datos.append("idUsuario", idUsuario);

    $.ajax({

        url: "ajax/ajax.usuarios.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {        

            $("#editarUsuario").val(respuesta["usuario"]);
            $("#editarNombre").val(respuesta["nombres"]);
            $("#editarApellido").val(respuesta["apellidos"]);
            $("#editarTelefono").val(respuesta["telefono"]);
            $("#editarPerfilCbx").html(respuesta["perfil"]);
            $("#editarPerfilCbx").val(respuesta["perfil"]);
            $("#editarTipoDocumentoCbx").html(respuesta["tipo_documento"]);
            $("#editarTipoDocumentoCbx").val(respuesta["tipo_documento"]);
            $("#editarNumeroDocumento").val(respuesta["numero_documento"]);
            $("#editarEmail").val(respuesta["correo"]);
            $("#fotoActual").val(respuesta["foto"]);

            if (respuesta["foto"] != "") {

                $(".previsualizar").attr("src", respuesta["foto"]);

            }
        }

    });

    $("#editarPerfil").hide("fast");
    $("#formEditarPerfil").show("fast");

})

$("#btnEditarPerfilCancelar").click(function() {

    $("#formEditarPerfil").hide("fast");
    $("#editarPerfil").show("fast");

})

$("#cambiarFotoPerfil").change(function() {

    $("#cambiarFotoPerfil").attr("name", "editarImagen")

});


/*=============================================
EDITAR USUARIO
=============================================*/

$(".table").on("click", ".btnEditarUsuario", function() {
    
    console.log("dentro");


    var idUsuario = $(this).attr("idUsuario");

    var datos = new FormData();
    datos.append("idUsuario", idUsuario);

    $.ajax({

        url: "ajax/ajax.usuarios.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            $("#idUsuarioEditar").val(respuesta["id_usuario"]);
            $("#usuarioEditar").val(respuesta["usuario"]);
            $("#usuarioEditarNombres").val(respuesta["nombres"]);
            $("#usuarioEditarApellidos").val(respuesta["apellidos"]);
            $("#usuarioEditarTipoDocumento").html(respuesta["tipo_documento"]);
            $("#usuarioEditarTipoDocumento").val(respuesta["tipo_documento"]);
            $("#usuarioEditarNumeroDocumento").val(respuesta["numero_documento"]);
            $("#usuarioEditarTelefono").val(respuesta["telefono"]);
            $("#usuarioEditarCorreo").val(respuesta["correo"]);

        }

    })

    $('#modalEditarUsuario').modal('show');

})

/*=============================================
ELIMINAR USUARIO
=============================================*/

$(".tablas").on("click", ".btnEliminarUsuario", function() {

    var idUsuario = $(this).attr("idUsuario");

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