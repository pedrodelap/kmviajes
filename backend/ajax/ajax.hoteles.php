<?php

require_once "../controladores/controlador.hoteles.php";
require_once "../modelos/modelo.hoteles.php";

class AjaxHoteles{

	#EDITAR HOTEL
	#----------------------------------------------------------

	public $idHotel;

	public function ajaxEditarAerolinea(){

		$item = "id_aerolinea";
		$valor = $this->idAerolinea;

		$respuesta = ControladorAerolineas::ctrMostrarAerolineas($item, $valor);

		echo json_encode($respuesta);


	}

	#CONSULTAR HOTELES
	#----------------------------------------------------------

	public $searchTerm;

	public function ajaxSelectHotel(){

		$valor = $this->searchTerm;

		$respuesta = ControladorHoteles::ctrSelectHoteles($valor);

		$hotel = array();

		$i = 0;
		
		foreach ($respuesta[1] as $key) 
		{
			$respuesta[1][$i]['desc'] = $key['hotel'];;
			$respuesta[1][$i]['id'] = $key['id_hotel'];
			$i++;
		}
	
		$hotel['items'] = $respuesta[1];
		
		echo json_encode($hotel);

	}

}

/*=============================================
CONSULTAR HOTELES
=============================================*/	

if(isset($_GET['q'])){

	$searchTerm = new AjaxHoteles();
	$searchTerm -> searchTerm = $_GET["q"];
	$searchTerm -> ajaxSelectHotel();

}