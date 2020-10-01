/*=============================================
MODAL APPENDTO BODY PAQUETES
=============================================*/

$('#modalNuevoPaquete').appendTo("body");
$('#modalEditarPaquete').appendTo("body");
$('#modalPaqueteAgragarImagenes').appendTo("body");

/*=============================================
SELECCIONAR AEROLINEA / BUSCAR AEROLINEA
=============================================*/

$(".paqueteAerolinea").select2({
    dropdownParent: $('#modalNuevoPaquete'),
    placeholder: "Buscar Aerolínea",
    theme: "bootstrap4",
    ajax: {
        url: 'ajax/ajax.aerolineas.php',
        dataType: 'json',
        delay: 250,
        data: function(params) {
            return {
                q: params.term,
                page: params.page
            };
        },
        processResults: function(data, params) {
            params.page = params.page || 1;
            return {
                results: data.items,
                pagination: {
                    more: (params.page * 30) < data.total_count
                }
            };
        },
        cache: false
    },
    minimumInputLength: 3,
    templateResult: formatRepo,
    templateSelection: formatRepoSelection
});


/*=============================================
SELECCIONAR CIUDAD / BUSCAR CIUDAD
=============================================*/

$(".paqueteCiudad").select2({
    dropdownParent: $('#modalNuevoPaquete'),
    placeholder: "Buscar Ciudad",
    theme: "bootstrap4",
    ajax: {
        url: 'ajax/ajax.paquetes.php',
        dataType: 'json',
        delay: 250,
        data: function(params) {
            return {
                q: params.term,
                page: params.page
            };
        },
        processResults: function(data, params) {
            params.page = params.page || 1;
            return {
                results: data.items,
                pagination: {
                    more: (params.page * 30) < data.total_count
                }
            };
        },
        cache: false
    },
    minimumInputLength: 3,
    templateResult: formatRepo,
    templateSelection: formatRepoSelection
});


/*=============================================
SELECCIONAR CAPAÑA EN PAQUETES / CAPAÑA EN PAQUETES
=============================================*/

$(".campanaEnPaquete").select2({
    dropdownParent: $('#modalNuevoPaquete'),
    placeholder: "Buscar Campaña",
    theme: "bootstrap4",
    ajax: {
        url: 'ajax/ajax.campana.php',
        dataType: 'json',
        delay: 250,
        data: function(params) {
            return {
                q: params.term,
                page: params.page
            };
        },
        processResults: function(data, params) {
            params.page = params.page || 1;
            return {
                results: data.items,
                pagination: {
                    more: (params.page * 30) < data.total_count
                }
            };
        },
        cache: false
    },
    minimumInputLength: 3,
    templateResult: formatRepo,
    templateSelection: formatRepoSelection
});


/*=============================================
FORMATOS INICIALES PAQUETTES TURISTICOS
=============================================*/

function formatoNumeros() {

    $("#nuevoPaquetePrecioSoles").number(true, 2);
    $("#nuevoPaquetePrecioDolares").number(true, 2);

    $("#nuevoPaqueteCantidadAdultos").number(true, 0);
    $("#nuevoPaqueteCantidadAdultos").number(true, 0);

};


$(document).keyup(function(e) {
    if (e.keyCode == 27 && $('#modalPaqueteAgragarImagenes').is(':visible'))  {
        //alert('Esc key is press');
        $('#modalNuevoPaquete').modal('show');
    }
});

/*=============================================
MOSTRAR MODAL PROPUESTA CUANDO CIERRO MODAL ADICIONAR ITINERARIO
=============================================*/

function mostrarModalPaquetes() {

    $('#modalNuevoPaquete').modal('show');

};

/*=============================================

=============================================*/
$(".btnAgregarImagenesPaquete").click(function() {

    document.getElementById('previsualizarPaquete').removeAttribute('src');

    $("#campanaNuevoImagen").val('');
    $("#modalPaquete").text("Agregar Imagen");
    $("#btnPaquete").text("Agregar Imagen");
    $('#modalNuevoPaquete').modal('hide');
    $('#modalPaqueteAgragarImagenes').modal('show');
    
});


/*=============================================
PREVISUALIZAR FOTO DE LA CAMPAñA
=============================================*/
$(".paqueteNuevoImagenVisualizar").change(function() {

    var imagen = this.files[0];

    /*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

    if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {

        $(".campanaNuevoImagen").val("");

        Swal.fire({
            title: "Error al subir la imagen",
            text: "¡La imagen debe estar en formato JPG o PNG!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
        });

    } else if (imagen["size"] > 2000000) {

        $(".campanaNuevoImagen").val("");

        Swal.fire({
            title: "Error al subir la imagen",
            text: "¡La imagen no debe pesar más de 2MB!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
        });

    } else {

        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);

        $(datosImagen).on("load", function(event) {

            var rutaImagen = event.target.result;

            $(".previsualizarPaquete").attr("src", rutaImagen);

        })

    }
});


/*=============================================

=============================================*/
$(".nuevoPaqueteImagenTemporal").click(function() {

    var files = $('#campanaNuevoImagen')[0].files[0];

    var formData = new FormData();
        
    formData.append('file',files);
    formData.append('PaqueteImagenTemporal',files);

    $.ajax({
        url: 'ajax/ajax.paquetes.upImage.php',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success:function(data,output){
            $('#divGaleriaPaqueteNuevo').hide();
            $('#divGaleriaPaqueteNuevo').html(data);
            $('#divGaleriaPaqueteNuevo').fadeIn("slow");

        }

    });

    $('#modalPaqueteAgragarImagenes').modal('hide');
    $('#modalNuevoPaquete').modal('show');
    
    
});

/*=============================================
LIMPIAR DATOS MODAL AGREGAR PAQUETE TURISTICO
=============================================*/

function limpiarModalAgregarPaqueteTuristico() {
 
    $('#itinerarioNuevoOrigen').val(null).trigger('change');
    $('#itinerarioNuevoDestino').val(null).trigger('change');
    $('#itinerarioNuevoFechaVuelo').val(null).trigger('change');

};


/*=============================================
AGREGAR PAQUETE TURISTICO
=============================================*/

var idPaquete = "";

$(".adicionarPaqueteTuristico").click(function() {

    var nuevoPaquete = true;
    var nuevoPaqueteTitulo = $("#nuevoPaqueteTitulo").val();
    var nuevoPaqueteCampana = $("#nuevoCampanadePaquete option:selected").val();
    var nuevoPaqueteAerolinea = $("#nuevoPaqueteAerolinea option:selected").val();
    var nuevoPaqueteCiudad = $("#nuevoPaqueteCiudad option:selected").val();
    var nuevoPaquetePrecioSoles = $("#nuevoPaquetePrecioSoles").val();
    var nuevoPaquetePrecioDolares = $("#nuevoPaquetePrecioDolares").val();
    var nuevoPaqueteCantidadAdultos = $("#nuevoPaqueteCantidadAdultos").val();
    var nuevoPaqueteCantidadNinos = $("#nuevoPaqueteCantidadNinos").val();
    var nuevoPaqueteFechaMostrar = $('#nuevoPaqueteFecha').val();
    var nuevoPaqueteFechaInicio = $('#nuevoPaqueteFecha').data('daterangepicker').startDate.format('DD-MM-YYYY');
    var nuevoPaqueteFechaFin = $('#nuevoPaqueteFecha').data('daterangepicker').endDate.format('DD-MM-YYYY');
    var nuevoPaqueteDescripcionCorta = $('#nuevoPaqueteDescripcionCorta').val();
    var nuevoPaqueteDescripcionLarga = $('#nuevoPaqueteDescripcionLarga').val();

    var datosPaquetes = new FormData();

    datosPaquetes.append("nuevoPaquete", nuevoPaquete);
    datosPaquetes.append("nuevoPaqueteTitulo", nuevoPaqueteTitulo);
    datosPaquetes.append("nuevoPaqueteCampana", nuevoPaqueteCampana);
    datosPaquetes.append("nuevoPaqueteAerolinea", nuevoPaqueteAerolinea);
    datosPaquetes.append("nuevoPaqueteCiudad", nuevoPaqueteCiudad);
    datosPaquetes.append("nuevoPaquetePrecioSoles", nuevoPaquetePrecioSoles);
    datosPaquetes.append("nuevoPaquetePrecioDolares", nuevoPaquetePrecioDolares);
    datosPaquetes.append("nuevoPaqueteCantidadAdultos", nuevoPaqueteCantidadAdultos);
    datosPaquetes.append("nuevoPaqueteCantidadNinos", nuevoPaqueteCantidadNinos);
    datosPaquetes.append("nuevoPaqueteFechaMostrar", nuevoPaqueteFechaMostrar);
    datosPaquetes.append("nuevoPaqueteFechaInicio", nuevoPaqueteFechaInicio);
    datosPaquetes.append("nuevoPaqueteFechaFin", nuevoPaqueteFechaFin);
    datosPaquetes.append("nuevoPaqueteDescripcionCorta", nuevoPaqueteDescripcionCorta);
    datosPaquetes.append("nuevoPaqueteDescripcionLarga", nuevoPaqueteDescripcionLarga);

    /*
    for (var value of datosPaquetes.values()) {
        console.log("datosPaquetes : ", value); 
     }
     */

    console.log("antes del Ajax");

     $.ajax({

        url: "ajax/ajax.paquetes.php",
        method: "POST",
        data: datosPaquetes,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            idPaquete = respuesta["id_paquete"];

            adicionarPaqueteTuristicoImagenes(idPaquete);
 
        }

    });

});



function adicionarPaqueteTuristicoImagenes(idPaquete) {

    var idPaqueteImagen = idPaquete;

    var datosImagen = new FormData();

    datosImagen.append("idPaqueteImagen", idPaqueteImagen);

    $.ajax({

        url: "ajax/ajax.paquetes.php",
        method: "POST",
        data: datosImagen,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            if(respuesta == 'ok' ){

                adicionarPaqueteTuristicoServicios(idPaquete);

            }

        }

    });

};


function adicionarPaqueteTuristicoServicios(idPaquete) {

    var Servicio = true;

    var servicioArray = [];

    var datosServicios = new FormData();

    $('.chkServicio').each(function() {

        if ($(this).is(":checked")) {

            servicioArray.push($(this).val());

        }
        
    });

    servicioArray = servicioArray.toString();

    datosServicios.append("Servicio", Servicio);

    datosServicios.append("servicioArray", servicioArray);

    datosServicios.append("idPaqueteServicio", idPaquete);

    $.ajax({

        url: "ajax/ajax.paquetes.php",
        method: "POST",
        data: datosServicios,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            if(respuesta == 'ok' ){

                Swal.fire({
                    type: "success",
                    title: "¡El Paquete Turístico ha sido guardado correctamente!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                    }).then((result) => {
                            
                        if (result.value) {

                            window.location = "paquetes";

                        }
                });

            }

        }

    });

};


/*=============================================
FORMATO DATERANGEPICKER
=============================================*/
$(".paqueteNuevoFecha").daterangepicker({
    parentEl: "#modalNuevoPaquete",
    
    locale: {
        format: 'DD MMMM, YYYY'
    },        
    drops: ('down'),
    opens: ('left') 
});








