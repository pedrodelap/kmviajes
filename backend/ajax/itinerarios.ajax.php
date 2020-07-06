<?php

require_once "../controladores/itinerarios.controlador.php";
require_once "../modelos/itinerarios.modelo.php";

class AjaxItinerarios{

	#REGISTRAR ITINERARIO
	#----------------------------------------------------------

	public $itinerarioNuevo;

	public function ajaxCrearItinerario(){

		$datos = $this->itinerarioNuevo;

		$respuesta = ControladorItinerarios::ctrCrearItinerario($datos);

		echo $respuesta;

	}

}

/*=============================================
REGISTRAR ITINERARIO
=============================================*/	


if(isset($_POST["cotizacionNuevoItinerario"])){

	$itinerario = new AjaxItinerarios();
	$itinerario -> itinerarioNuevo = json_decode($_POST['cotizacionNuevoItinerario'], true);
	$itinerario -> ajaxCrearItinerario();

}