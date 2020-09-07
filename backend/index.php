<?php

<<<<<<< HEAD
require_once "controladores/plantilla.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/clientes.controlador.php";
require_once "controladores/monedas.controlador.php";
require_once "controladores/aerolineas.controlador.php";
require_once "controladores/aeropuertos.controlador.php";
require_once "controladores/cotizaciones.controlador.php";
require_once "controladores/propuestas.controlador.php";
require_once "controladores/galeria.controlador.php";
require_once "controladores/mensajes.controlador.php";
require_once "controladores/perfiles.controlador.php";
require_once "controladores/slide.controlador.php";
require_once "controladores/suscriptores.controlador.php";

require_once "modelos/usuarios.modelo.php";
require_once "modelos/clientes.modelo.php";
require_once "modelos/monedas.modelo.php";
require_once "modelos/aerolineas.modelo.php";
require_once "modelos/aeropuertos.modelo.php";
require_once "modelos/cotizaciones.modelo.php";
require_once "modelos/propuestas.modelo.php";
require_once "modelos/itinerarios.modelo.php";
require_once "modelos/galeria.modelo.php";
require_once "modelos/mensajes.modelo.php";
require_once "modelos/perfiles.modelo.php";
require_once "modelos/slide.modelo.php";
require_once "modelos/suscriptores.modelo.php";
=======
require_once "controladores/controlador.aerolineas.php";
require_once "controladores/controlador.aeropuertos.php";
require_once "controladores/controlador.clientes.php";
require_once "controladores/controlador.cotizaciones.php";
require_once "controladores/controlador.galeria.php";
require_once "controladores/controlador.mensajes.php";
require_once "controladores/controlador.monedas.php";
require_once "controladores/controlador.perfiles.php";
require_once "controladores/controlador.propuestas.php";
require_once "controladores/controlador.slide.php";
require_once "controladores/controlador.suscriptores.php";
require_once "controladores/controlador.usuarios.php";
require_once "controladores/plantilla.php";


require_once "modelos/modelo.aerolineas.php";
require_once "modelos/modelo.aeropuertos.php";
require_once "modelos/modelo.clientes.php";
require_once "modelos/modelo.cotizaciones.php";
require_once "modelos/modelo.galeria.php";
require_once "modelos/modelo.itinerarios.php";
require_once "modelos/modelo.mensajes.php";
require_once "modelos/modelo.monedas.php";
require_once "modelos/modelo.perfiles.php";
require_once "modelos/modelo.propuestas.php";
require_once "modelos/modelo.slide.php";
require_once "modelos/modelo.suscriptores.php";
require_once "modelos/modelo.usuarios.php";

>>>>>>> 90cfe57fea136401cc7ad60f34fbe43057d7108d

$template = new ControladorPlantilla();
$template -> ctrPlantilla();