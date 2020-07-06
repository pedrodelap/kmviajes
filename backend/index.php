<?php

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

$template = new ControladorPlantilla();
$template -> ctrPlantilla();