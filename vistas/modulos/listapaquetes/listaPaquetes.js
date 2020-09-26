$(document).ready(function () {
    console.log("xxxdentro");
    listarPaquetesDisponibles();
    listarCiudades();
});

$(".btn-buscar").click(function (e) {

    listarPaquetesDisponibles();

});




function listarPaquetesDisponibles() {

    console.log("dentro");
    var txtBuscar = $("#txtBuscar").val();

    var datos = new FormData();
    datos.append("txtBuscar", txtBuscar);
    console.log('load');

    $.ajax({
        url: "ajax/ajax.paquete.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "text",
        success: function (respuesta) {
            console.log(respuesta)
            $("#content-data-paquete").html(respuesta);

        }
    });
}



function listarCiudades() {

    var datos = new FormData();
    datos.append("ciudad", "ciudad");


    $.ajax({
        url: "ajax/ajax.paquete.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "text",
        success: function (respuesta) {
            $("#id_ciudad").html(respuesta);

        }
    });
}


function registroSolicitud() {

    var txtNombre = $("#txtNombre").val();
    var txtApellidos = '';
    var nombreSeparete = txtNombre.split(" ");
    if (nombreSeparete.length > 1) {
        txtNombre = nombreSeparete[0];
        var txtApellidos = nombreSeparete[1];
    }

    var txtTelefono = $("#txtTelefono").val();
    var txtDocumento = $("#txtDocumento").val();
    var txtCorreo = $("#txtCorreo").val();
    var txtFecha = $("#txtFecha").val();
    var txtAdultos = $("#txtAdultos").val();
    var txtNinios = $("#txtNinios").val();
    var txtServicios = $('.checkboxService:checked').val();

    var txtObservacion = $("#txtObservacion").val();
    var id_paquete = $("#id_paquete").val();
    var id_ciudad = $("#id_ciudad").val();

    var datosForm = new FormData();

    datosForm.append("txtNombre", txtNombre);
    datosForm.append("txtApellidos", txtApellidos);
    datosForm.append("txtTelefono", txtTelefono);
    datosForm.append("txtCorreo", txtCorreo);
    datosForm.append("txtFecha", txtFecha);
    datosForm.append("txtDocumento", txtDocumento);


    datosForm.append("txtAdultos", txtAdultos);
    datosForm.append("txtNinios", txtNinios);
    datosForm.append("txtServicios", txtServicios);

    datosForm.append("txtObservacion", txtObservacion);
    datosForm.append("id_paquete", id_paquete);
    datosForm.append("id_ciudad", id_ciudad);
    datosForm.append("nuevaSolicitud", "true");


    $.ajax({

        url: "ajax/ajax.paquete.php",
        method: "POST",
        data: datosForm,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);

        }

    });
}