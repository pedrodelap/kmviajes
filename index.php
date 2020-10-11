<?php
require_once "backend/modelos/conexion.php";

require_once "controladores/plantilla.php";
require_once "controladores/controlador.ruta.php";
require_once "controladores/controlador.mensajes.php";
require_once "controladores/paquete.controlador.php";

require_once "modelos/paquete.modelo.php";
require_once "modelos/modelo.mensajes.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();