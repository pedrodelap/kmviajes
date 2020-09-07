<?php

require_once "../controladores/controlador.aeropuertos.php";
require_once "../modelos/modelo.aeropuertos.php";

class AjaxAeropuertos{

	#CONSULTAR AEROPUERTO
	#----------------------------------------------------------

	public $searchTerm;

	public function ajaxSelectAeropuerto(){

		$valor = $this->searchTerm;

		$respuesta = ControladorAeropuertos::ctrSelectAeropuertos($valor);

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
CONSULTAR AEROPUERTO
=============================================*/	

if(isset($_GET['q'])){

	$searchTerm = new AjaxAeropuertos();
	$searchTerm -> searchTerm = $_GET["q"];
	$searchTerm -> ajaxSelectAeropuerto();

}