<?php 

    session_start(); 
    
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="es">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>KM Viajes y Aventuras</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <link rel="stylesheet" href="vistas/assets/css/select2.min.css">
    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <link rel="shortcut icon" href="vistas/assets/images/favicon.ico" />
    <link rel="stylesheet" href="vistas/assets/css/base.min.css">
    <link rel="stylesheet" href="vistas/assets/css/style.css">
    <link rel="stylesheet" href="vistas/assets/css/custom.css">

    <!--SCRIPTS INCLUDES-->

    <!--CORE-->
    <script src="vistas/assets/js/vendors/jquery-3.3.1.min.js"></script>
    <script src="vistas/assets/js/vendors/jquery-ui.min.js"></script>
    <script src="vistas/assets/js/vendors/bootstrap.bundle.min.js"></script>
    <script src="vistas/assets/js/vendors/moment-with-locales.min.js"></script>
    <script src="vistas/assets/js/vendors/metismenu.js"></script>
    <script src="vistas/assets/js/scripts-init/app.js"></script>
    <script src="vistas/assets/js/scripts-init/demo.js"></script>

    <!--FORMS-->

    <!-- jQuery Number -->
    <script src="vistas/assets/js/vendors/jquerynumber.min.js"></script>

    <!--Clipboard-->
    <script src="vistas/assets/js/vendors/form-components/clipboard.js"></script>
    <script src="vistas/assets/js/scripts-init/form-components/clipboard.js"></script>

    <!--Datepickers-->
    <script src="vistas/assets/js/vendors/form-components/datepicker.js"></script>
    <script src="vistas/assets/js/vendors/form-components/daterangepicker.js"></script>
    <script src="vistas/assets/js/scripts-init/form-components/datepicker.js"></script>

    <!--Multiselect-->
    <script src="vistas/assets/js/vendors/form-components/bootstrap-multiselect.js"></script>
    <script src="vistas/assets/js/vendors/select2.min.js"></script>
    <script src="vistas/assets/js/scripts-init/form-components/input-select.js"></script>

    <!--Form Validation-->
    <script src="vistas/assets/js/vendors/form-components/form-validation.js"></script>
    <script src="vistas/assets/js/scripts-init/form-components/form-validation.js"></script>

    <!--Form Wizard-->
    <script src="vistas/assets/js/vendors/form-components/form-wizard.js"></script>
    <script src="vistas/assets/js/scripts-init/form-components/form-wizard.js"></script>

    <!--Input Mask-->
    <script src="vistas/assets/js/vendors/form-components/input-mask.js"></script>
    <script src="vistas/assets/js/scripts-init/form-components/input-mask.js"></script>

    <!--Chart.js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script src="vistas/assets/js/scripts-init/charts/chartsjs-utils.js"></script>
    <script src="vistas/assets/js/scripts-init/charts/chartjs.js"></script>

    <!--RangeSlider-->
    <script src="vistas/assets/js/vendors/form-components/wnumb.js"></script>
    <script src="vistas/assets/js/vendors/form-components/range-slider.js"></script>
    <script src="vistas/assets/js/scripts-init/form-components/range-slider.js"></script>

    <!--Textarea Autosize-->
    <script src="vistas/assets/js/vendors/form-components/textarea-autosize.js"></script>
    <script src="vistas/assets/js/scripts-init/form-components/textarea-autosize.js"></script>

    <!--Toggle Switch -->
    <script src="vistas/assets/js/vendors/form-components/toggle-switch.js"></script>


    <!--COMPONENTS-->

    <!--BlockUI -->
    <script src="vistas/assets/js/vendors/blockui.js"></script>
    <script src="vistas/assets/js/scripts-init/blockui.js"></script>

    <!--Calendar -->
    <script src="vistas/assets/js/vendors/calendar.js"></script>
    <script src="vistas/assets/js/scripts-init/calendar.js"></script>

    <!--Slick Carousel -->
    <script src="vistas/assets/js/vendors/carousel-slider.js"></script>
    <script src="vistas/assets/js/scripts-init/carousel-slider.js"></script>

    <!--Circle Progress -->
    <script src="vistas/assets/js/vendors/circle-progress.js"></script>
    <script src="vistas/assets/js/scripts-init/circle-progress.js"></script>

    <!--CountUp -->
    <script src="vistas/assets/js/vendors/count-up.js"></script>
    <script src="vistas/assets/js/scripts-init/count-up.js"></script>

    <!--Cropper -->
    <script src="vistas/assets/js/vendors/cropper.js"></script>
    <script src="vistas/assets/js/vendors/jquery-cropper.js"></script>
    <script src="vistas/assets/js/scripts-init/image-crop.js"></script>

    <!--Maps -->
    <script src="vistas/assets/js/vendors/gmaps.js"></script>
    <script src="vistas/assets/js/vendors/jvectormap.js"></script>
    <script src="vistas/assets/js/scripts-init/maps-word-map.js"></script>
    <script src="vistas/assets/js/scripts-init/maps.js"></script>

    <!--Guided Tours -->
    <script src="vistas/assets/js/vendors/guided-tours.js"></script>
    <script src="vistas/assets/js/scripts-init/guided-tours.js"></script>

    <!--Ladda Loading Buttons -->
    <script src="vistas/assets/js/vendors/ladda-loading.js"></script>
    <script src="vistas/assets/js/vendors/spin.js"></script>
    <script src="vistas/assets/js/scripts-init/ladda-loading.js"></script>

    <!--Rating -->
    <script src="vistas/assets/js/vendors/rating.js"></script>
    <script src="vistas/assets/js/scripts-init/rating.js"></script>

    <!--Perfect Scrollbar -->
    <script src="vistas/assets/js/vendors/scrollbar.js"></script>
    <!-- <script src="vistas/assets/js/scripts-init/scrollbar.js"></script> -->

    <!--Toastr-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" crossorigin="anonymous">
    </script>
    <script src="vistas/assets/js/scripts-init/toastr.js"></script>

    <!--SweetAlert2-->
    <script src="vistas/assets/js/scripts-init/sweet-alerts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    <!--Tree View -->
    <script src="vistas/assets/js/vendors/treeview.js"></script>
    <script src="vistas/assets/js/scripts-init/treeview.js"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="vistas/assets/css/datatables.min.css">
    <link rel="stylesheet" href="vistas/assets/js/vendors/datatable.responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="vistas/assets/js/vendors/datatables.bootstrap/css/dataTables.bootstrap4.min.css">
    <script src="vistas/assets/js/vendors/datatables.min.js"></script>
    <script src="vistas/assets/js/vendors/datatable.responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="vistas/assets/js/vendors/datatables.bootstrap/js/dataTables.bootstrap4.min.js"></script>

    <!--Tables Init-->
    <script src="vistas/assets/js/scripts-init/tables.js"></script>


    <script src="https://kit.fontawesome.com/d43bc8ede4.js" crossorigin="anonymous"></script>
</head>

<body>

    <?php if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") { ?>

    <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-footer fixed-sidebar">
        <!--Header START-->
        <div class="app-header header-shadow bg-warm-flame header-text-dark">

            <?php include "vistas/modulos/sectores/header.php"; ?>

            <div class="app-header__content">

                <?php include "vistas/modulos/sectores/header-left.php"; ?>

                <?php include "vistas/modulos/sectores/header-right.php"; ?>

            </div>

        </div>
        <!--Header END-->

        <div class="app-main">
            <div class="app-sidebar sidebar-shadow bg-secondary sidebar-text-light">

                <?php include "vistas/modulos/sectores/sidebar-shadow.php"; ?>

                <?php include "vistas/modulos/sectores/sidebar.php"; ?>

            </div>
            <div class="app-main__outer">

                <?php 

                        if(isset($_GET["ruta"])){

                            if($_GET["ruta"] == "inicio" ||
                               $_GET["ruta"] == "clientes" ||
                               $_GET["ruta"] == "aerolineas" ||
                               $_GET["ruta"] == "monedas" ||
                               $_GET["ruta"] == "usuarios" ||
                               $_GET["ruta"] == "campanas" ||
                               $_GET["ruta"] == "paquetes" ||
                               $_GET["ruta"] == "hoteles" ||
                               $_GET["ruta"] == "cotizacion-crear" ||
                               $_GET["ruta"] == "cotizaciones" ||
                               $_GET["ruta"] == "carousel" ||
                               $_GET["ruta"] == "galeria" ||
                               $_GET["ruta"] == "solicitudes" ||
                               $_GET["ruta"] == "mensajes" ||
                               $_GET["ruta"] == "perfil" ||
                               $_GET["ruta"] == "slide" ||
                               $_GET["ruta"] == "suscriptores" ||
                               $_GET["ruta"] == "salir" || 
                               $_GET["ruta"] == "ventas" ||
                               $_GET["ruta"] == "venta-docelectronico" ||
                               $_GET["ruta"] == "solicitud-calificar" ||
                               $_GET["ruta"] == "reporte-ventas" ||
                               $_GET["ruta"] == "reporte-calificacion-hotel" ||
                               $_GET["ruta"] == "reporte-calificacion-aero" ||
                               $_GET["ruta"] == "reporte-calificacion-comentario" ||
                               $_GET["ruta"] == "reporte-registro" ||
                               $_GET["ruta"] == "reporte-incidente" ){

                                include "modulos/".$_GET["ruta"].".php";

                            }else{

                                #include "modulos/404.php";
                                include "modulos/inicio.php";

                            }

                        }else{

                        include "modulos/inicio.php";

                        }

                        ?>

                <?php include "vistas/modulos/sectores/footer.php"; ?>

            </div>
        </div>
    </div>

    <div class="app-drawer-overlay d-none animated fadeIn"></div>

    <div id="loading-backend">
        <div class="d-flex justify-content-center">
            <div class="spinner-border" role="status">
                <span class="sr-only">Cargando...</span>
            </div>
        </div>
    </div>
    <!--DRAWER END-->


    <?php } else {

                include "vistas/modulos/login.php";
            
            } ?>

    <!--Tables Init-->
    <script src="vistas/js/inicio.js"></script>
    <script src="vistas/js/plantilla.js"></script>
    <script src="vistas/js/clientes.js"></script>
    <script src="vistas/js/monedas.js"></script>
    <script src="vistas/js/aerolineas.js"></script>
    <script src="vistas/js/cotizacion-crear.js"></script>

    <script src="vistas/js/campanas.js"></script>
    <script src="vistas/js/paquetes.js"></script>
    <script src="vistas/js/solicitudes.js"></script>
    <script src="vistas/js/solicitud-calificar.js"></script>

    <script src="vistas/js/galeria.js"></script>
    <script src="vistas/js/mensajes.js"></script>
    <script src="vistas/js/usuarios.js"></script>
    <script src="vistas/js/slide.js"></script>


    <script src="vistas/js/ventas.js"></script>

</body>

</html>