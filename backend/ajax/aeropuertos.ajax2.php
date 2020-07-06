<?php

require_once "../controladores/aeropuertos.controlador.php";
require_once "../modelos/aeropuertos.modelo.php";

class AjaxAeropuertos{

	#CONSULTAR AEROPUERTO POR ID
	#----------------------------------------------------------

	public $origenId;

	public function ajaxSelectAeropuertoPorId(){

		$valor = $this->origenId;

		$respuesta = ControladorAeropuertos::ctrSelectAeropuertosPorId($valor);

		$aeropuerto = array();

		$i = 0;
		
		foreach ($respuesta[1] as $key) 
		{
			$respuesta[1][$i]['desc'] = $key['nombre_aeropuerto'];;
			$respuesta[1][$i]['id'] = $key['id_aeropuerto'];
			$i++;
		}
	
		$aeropuerto['items'] = $respuesta[1];
		
		echo json_encode($aeropuerto);



	}

}

/*=============================================
CONSULTAR AEROPUERTO por id
=============================================*/	

if(isset($_GET["origenId"])){

	$AeropuertoPorId = new AjaxAeropuertos();
	$AeropuertoPorId -> origenId = $_GET["origenId"];
	$AeropuertoPorId -> ajaxSelectAeropuertoPorId();

}