<?php

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


$template = new ControladorPlantilla();
$template -> ctrPlantilla();