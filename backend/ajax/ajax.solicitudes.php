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
    
}

/*=============================================
CONSULTAR CAMPAÑAS
=============================================*/	

if(isset($_POST["idPaqueteDeSolicitudT"])){

	$cliente = new AjaxSolicitudes();
	$cliente -> idPaqueteDeSolicitudT = $_POST["idPaqueteDeSolicitudT"];
    $cliente -> ajaxMostrarPaqueteDeSolicitud();

}