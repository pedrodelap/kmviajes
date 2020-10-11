<?php

require_once "../controladores/controlador.suscriptores.php";
require_once "../modelos/modelo.suscriptores.php";

require_once "../controladores/controlador.mensajes.php";
require_once "../modelos/modelo.mensajes.php";

require_once "../controladores/controlador.solicitudes.php";
require_once "../modelos/modelo.solicitudes.php";

#CLASE Y MÉTODOS
#-------------------------------------------------------------
class Ajax{

	#REVISAR MENSAJES
	#----------------------------------------------------------
	public $revisionMensajes;

	public function gestorRevisionMensajesAjax(){

		$datos = $this->revisionMensajes;

		$respuesta = ControladorMensajes::mensajesRevisadosController($datos);

		echo $respuesta;

	}

	#REVISAR SUSCRIPTORES
	#----------------------------------------------------------

	public $revisionSuscriptores;

	public function gestorRevisionSuscriptoresAjax(){

		$datos = $this->revisionSuscriptores;

		$respuesta = SuscriptoresController::suscriptoresRevisadosController($datos);

		echo $respuesta;

	}

	#REVISAR SUSCRIPTORES
	#----------------------------------------------------------

	public $revisionSolicitudes;

	public function gestorRevisionSolicitudesAjax(){

		$datos = $this->revisionSolicitudes;

		$respuesta = ControladorSolicitudes::ctrSolicitudesRevisadasController($datos);

		echo $respuesta;

	}

}

#OBJETOS
#-----------------------------------------------------------
if(isset($_POST["revisionMensajes"])){

	$a = new Ajax();
	$a -> revisionMensajes = $_POST["revisionMensajes"];
	$a -> gestorRevisionMensajesAjax();

}

if(isset($_POST["revisionSuscriptores"])){

	$b = new Ajax();
	$b -> revisionSuscriptores = $_POST["revisionSuscriptores"];
	$b -> gestorRevisionSuscriptoresAjax();

}

if(isset($_POST["revisionSolicitudes"])){

	$c = new Ajax();
	$c -> revisionSolicitudes = $_POST["revisionSolicitudes"];
	$c -> gestorRevisionSolicitudesAjax();

}
