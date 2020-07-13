/*=============================================
MODAL APPENDTO BODY modalEdtarPerfiles
=============================================*/

$('.modalEdtarPerfiles').appendTo("body");

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

            console.log("idUsuario: ", idUsuario);
            

            $("#editarUsuario").val(respuesta["usuario"]);
            $("#editarNombre").val(respuesta["nombres"]);
            $("#editarApellido").val(respuesta["apellidos"]);
            $("#editarTelefono").val(respuesta["telefono"]);
            $("#editarPerfilCbx").html(respuesta["perfil"]);
            $("#editarPerfilCbx").val(respuesta["perfil"]);
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

$("#cambiarFotoPerfil").change(function() {

    $("#cambiarFotoPerfil").attr("name", "editarImagen")

});