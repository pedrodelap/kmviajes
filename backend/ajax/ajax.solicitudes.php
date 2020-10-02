<?php

require_once "../controladores/controlador.solicitudes.php";
require_once "../modelos/modelo.solicitudes.php";

class AjaxSolicitudes{

    #EDITAR CAMPAÑA
	#----------------------------------------------------------

	public $idPaqueteDeSolicitud;

	public function ajaxMostrarPaqueteDeSolicitud(){

		$item = "id_paquete";
		
		$valor = $this->idPaqueteDeSolicitud;

		$respuesta = ControladorSolicitudes::ctrMostrarPaqueteDeSolicitud($item, $valor);

		echo json_encode($respuesta);

    }
    
}

/*=============================================
CONSULTAR CAMPAÑAS
=============================================*/	

if(isset($_POST["idPaqueteDeSolicitud"])){

	$cliente = new AjaxSolicitudes();
	$cliente -> idPaqueteDeSolicitud = $_POST["idPaqueteDeSolicitud"];
    $cliente -> ajaxMostrarPaqueteDeSolicitud();

}