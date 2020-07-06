/*=============================================
MODAL APPENDTO BODY AEROLINEA
=============================================*/

$('#modalNuevoAerolinea').appendTo("body");
$('#modalEditarAerolinea').appendTo("body");

/*=============================================
EDITAR AEROLINEA
=============================================*/

$(".tablas").on("click", ".btnEditarAerolinea", function() {

    var idAerolinea = $(this).attr("idAerolinea");

    var datos = new FormData();
    datos.append("idAerolinea", idAerolinea);

    $.ajax({

        url: "ajax/aerolineas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            $("#idAerolinea").val(respuesta["id_aerolinea"]);
            $("#aerolineaEditarCodigo").val(respuesta["codigo"]);
            $("#aerolineaEditarURL").val(respuesta["url"]);
            $("#aerolineaEditarNombre").val(respuesta["compania"]);
            $("#aerolineaEditarDireccion").val(respuesta["direccion"]);
            $("#aerolineaEditarTelefono").val(respuesta["telefono"]);
            $("#aerolineaEditarTelefonoCarga").val(respuesta["telefono_carga"]);
            $("#aerolineaEditarTipoAerolinea").html(respuesta["tipo"]);
            $("#aerolineaEditarTipoAerolinea").val(respuesta["tipo"]);

        }

    });

});

/*=============================================
ELIMINAR AEROLINEA
=============================================*/

$(".tablas").on("click", ".btnEliminarAerolinea", function() {

    var idAerolinea = $(this).attr("idAerolinea");
    console.log("idAerolinea", idAerolinea);

    Swal.fire({
        title: '¿Está seguro de borrar la Aerolinea?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar aerolinea!'
    }).then((result) => {
        if (result.value) {

            window.location = "index.php?ruta=aerolineas&idAerolinea=" + idAerolinea;
        }

    });

});