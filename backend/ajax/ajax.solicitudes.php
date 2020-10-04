<?php

require_once "../controladores/controlador.solicitudes.php";
require_once "../modelos/modelo.solicitudes.php";

class AjaxSolicitudes{

    #EDITAR CAMPAÑA
	#----------------------------------------------------------

	public $idPaqueteDeSolicitudT;

	public function ajaxMostrarPaqueteDeSolicitud(){

		$item = "id_paquete";
		
		//echo var_dump($item);

		$valor = $this->idPaqueteDeSolicitudT;

		$respuesta = ControladorSolicitudes::ctrMostrarPaqueteDeSolicitud($item, $valor);

		echo json_encode($respuesta);


	}
	
	public $idSolicitud;
	
	public function ajaxEstadoRegistradaACotizada(){

		$datos = array("id_solicitud"=>$this->idSolicitud,					
					"estado_solicitud"=>"Cotizada");

		$respuesta = ControladorSolicitudes::ctrEstadoRegistradaACotizada($datos);

		echo json_encode($respuesta);

    }


}

/*=============================================
CONSULTAR CAMPAÑAS
=============================================*/	

if(isset($_POST["idPaqueteDeSolicitudT"])){

	$cliente = new AjaxSolicitudes();
	$cliente -> idPaqueteDeSolicitudT = $_POST["idPaqueteDeSolicitudT"];
    $cliente -> ajaxMostrarPaqueteDeSolicitud();

}

/*=============================================
CONSULTAR CAMPAÑAS
=============================================*/	

if(isset($_POST["Reservada"])){

	$cliente = new AjaxSolicitudes();
	$cliente -> idSolicitud = $_POST["idSolicitud"];
    $cliente -> ajaxEstadoRegistradaACotizada();

}