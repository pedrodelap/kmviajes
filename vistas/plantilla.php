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
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="vistas/assets/https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="vistas/assets/https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

  
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

  </head>
  <body>
    <div id="all">


      <section style="background: url('vistas/assets/img/photogrid.jpg') center center repeat; background-size: cover;" class="relative-positioned">
        <!-- Carousel Start-->
        <div class="home-carousel">
          <div class="dark-mask mask-primary"></div>
          <div class="container">
           <!-- <div class="homepage owl-carousel">
              <div class="item">
                <div class="row">
                  <div class="col-md-5 text-right">
                    <p><img src="vistas/assets/img/logo.png" alt="" class="ml-auto"></p>
                    <h1>Multipurpose responsive theme</h1>
                    <p>Business. Corporate. Agency.<br>Portfolio. Blog. E-commerce.</p>
                  </div>
                  <div class="col-md-7"><img src="vistas/assets/img/template-homepage.png" alt="" class="img-fluid"></div>
                </div>
              </div>
              <div class="item">
                <div class="row">
                  <div class="col-md-7 text-center"><img src="vistas/assets/img/template-mac.png" alt="" class="img-fluid"></div>
                  <div class="col-md-5">
                    <h2>46 HTML pages full of features</h2>
                    <ul class="list-unstyled">
                      <li>Sliders and carousels</li>
                      <li>4 Header variations</li>
                      <li>Google maps, Forms, Megamenu, CSS3 Animations and much more</li>
                      <li>+ 11 extra pages showing template features</li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="row">
                  <div class="col-md-5 text-right">
                    <h1>Design</h1>
                    <ul class="list-unstyled">
                      <li>Clean and elegant design</li>
                      <li>Full width and boxed mode</li>
                      <li>Easily readable Roboto font and awesome icons</li>
                      <li>7 preprepared colour variations</li>
                    </ul>
                  </div>
                  <div class="col-md-7"><img src="vistas/assets/img/template-easy-customize.png" alt="" class="img-fluid"></div>
                </div>
              </div>
              <div class="item">
                <div class="row">
                  <div class="col-md-7"><img src="vistas/assets/img/template-easy-code.png" alt="" class="img-fluid"></div>
                  <div class="col-md-5">
                    <h1>Easy to customize</h1>
                    <ul class="list-unstyled">
                      <li>7 preprepared colour variations.</li>
                      <li>Easily to change fonts</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>-->
          </div>
        </div>
        <!-- Carousel End-->
      </section>
      <?php 

      if(isset($_GET["ruta"])){

        if($_GET["ruta"] == "detallepaquete" ||
          $_GET["ruta"] == "listaPaquetes" ||
          $_GET["ruta"] == "seguimiento"){

            include "vistas/modulos/".$_GET["ruta"]."/".$_GET["ruta"].".php";

        }else{

            #include "modulos/404.php";
            include "vistas/modulos/principal.php";

        }

      }else{

        #include "modulos/404.php";
        include "vistas/modulos/principal.php";

    }

      ?>

      
      <!-- FOOTER -->
      <footer class="main-footer">
       
        <div class="copyrights">
          <div class="container">
            <div class="row">
              <div class="col-lg-4 text-center-md">
                <p>&copy; 2020. KM Viajes y Aventura</p>
              </div>
              <div class="col-lg-8 text-right text-center-md">
                <p>Design by <a href="#">KM Viajes </a></p>
                <!-- Please do not remove the backlink to us unless you purchase the Attribution-free License at https://bootstrapious.com/donate. Thank you. -->
              </div>
            </div>
          </div>
        </div>
      </footer>
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
    <script src="vistas/assets/vendor/bootstrap-select/js/bootstrap-select.min.js"></script>
    <script src="vistas/assets/vendor/jquery.scrollto/jquery.scrollTo.min.js"></script>
    <!--Datepickers-->
    <script src="backend/vistas/assets/js/vendors/moment-with-locales.min.js"></script>      
    <script src="backend/vistas/assets/js/vendors/form-components/daterangepicker.js"></script>

    <script src="backend/vistas/assets/js/scripts-init/sweet-alerts.js"></script>

    <script src="vistas/assets/js/front.js"></script>
    <script src="vistas/modulos/listapaquetes/listapaquetes.js"></script>

  </body>
</html>