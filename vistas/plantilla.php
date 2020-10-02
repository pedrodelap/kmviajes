<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>KM Viajes y Aventura</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vistas/assets/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vistas/assets/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Google fonts - Roboto-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,700">
    <!-- Bootstrap Select-->
    <link rel="stylesheet" href="vistas/assets/vendor/bootstrap-select/css/bootstrap-select.min.css">
    <!-- owl carousel-->
    <link rel="stylesheet" href="vistas/assets/vendor/owl.carousel/assets/owl.carousel.css">
    <link rel="stylesheet" href="vistas/assets/vendor/owl.carousel/assets/owl.theme.default.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="vistas/assets/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="vistas/assets/css/custom.css">

    <link rel="stylesheet" href="backend/vistas/assets/css/select2.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!-- Favicon and apple touch icons-->
    <link rel="shortcut icon" href="vistas/assets/img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="vistas/assets/img/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="57x57" href="vistas/assets/img/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="72x72" href="vistas/assets/img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="vistas/assets/img/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="vistas/assets/img/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="vistas/assets/img/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="vistas/assets/img/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="vistas/assets/img/apple-touch-icon-152x152.png">

    

</head>

<body>
    <div id="all">

    <!-- Top bar-->
    <?php include "vistas/modulos/secciones/top-bar.php"; ?>
    <!-- Top bar end-->

    <?php
        if(isset($_GET["ruta"])){

            if($_GET["ruta"] == "detallepaquete" ||
               $_GET["ruta"] == "seguimiento")
            {

            include "vistas/modulos/".$_GET["ruta"]."/".$_GET["ruta"].".php";

            }else
            {
                #include "modulos/404.php";
                include "vistas/modulos/principal.php";
            }

        }else
        {
                #include "modulos/404.php";
                include "vistas/modulos/principal.php";
        }

    ?>

      <!-- Navbar Start-->
      <?php include "vistas/modulos/secciones/main-footer.php"; ?>
      <!-- Navbar End-->


    </div>
    <!-- Javascript files-->

    <script src="vistas/assets/vendor/jquery/jquery.min.js"></script>
    <script src="vistas/assets/vendor/popper.js/umd/popper.min.js"> </script>
    <script src="vistas/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vistas/assets/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vistas/assets/vendor/waypoints/lib/jquery.waypoints.min.js"> </script>
    <script src="vistas/assets/vendor/jquery.counterup/jquery.counterup.min.js"> </script>
    <script src="vistas/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="vistas/assets/vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js"></script>
    <script src="vistas/assets/js/jquery.parallax-1.1.3.js"></script>
    <script src="backend/vistas/assets/js/vendors/select2.min.js"></script>

    <script src="vistas/assets/vendor/jquery.scrollto/jquery.scrollTo.min.js"></script>

    <!--Datepickers-->
    <script src="backend/vistas/assets/js/vendors/moment-with-locales.min.js"></script>
    <script src="backend/vistas/assets/js/vendors/form-components/daterangepicker.js"></script>
    <script src="backend/vistas/assets/js/scripts-init/sweet-alerts.js"></script>

    <!--SweetAlert2-->        
    <script src="backend/vistas/assets/js/scripts-init/sweet-alerts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="https://kit.fontawesome.com/d43bc8ede4.js" crossorigin="anonymous"></script>

    <script src="vistas/assets/js/front.js"></script>
    <script src="vistas/modulos/listapaquetes/listapaquetes.js"></script>
    <script src="vistas/modulos/detallepaquete/detallepaquete.js"></script>
    <script src="vistas/modulos/seguimiento/seguimiento.js"></script>


</body>

</html>