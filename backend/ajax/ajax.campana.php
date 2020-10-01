<?php

require_once "../controladores/controlador.campanas.php";
require_once "../modelos/modelo.campanas.php";

class AjaxCampanas{

	#EDITAR CAMPAÑA
	#----------------------------------------------------------

	public $idCampana;

	public function ajaxEditarCampana(){

		$item = "id_cliente";
		
		$valor = $this->idCampana;

		$respuesta = ControladorCampanas::ctrMostrarCampanas($item, $valor);

		echo json_encode($respuesta);


	}


	#CONSULTAR CAMPAÑAS
	#----------------------------------------------------------

	public $searchTerm;

	public function ajaxSelectCampana(){

		$valor = $this->searchTerm;

		$respuesta = ControladorCampanas::ctrSelectCampanas($valor);

		$country = array();

		$i = 0;
		
		foreach ($respuesta[1] as $key) 
		{
			$respuesta[1][$i]['desc'] = $key['nombre'];;
			$respuesta[1][$i]['id'] = $key['id_campania'];
			$i++;
		}
	
		$country['items'] = $respuesta[1];
		
		echo json_encode($country);

	}

}

/*=============================================
CONSULTAR CAMPAÑAS
=============================================*/	

if(isset($_GET['q'])){

	$searchTerm = new AjaxCampanas();
	$searchTerm -> searchTerm = $_GET["q"];
	$searchTerm -> ajaxSelectCampana();

}

/*=============================================
EDITAR CAMPAÑA
=============================================*/	


if(isset($_POST["idCampana"])){

	$cliente = new AjaxCampanas();
	$cliente -> idCampana = $_POST["idCampana"];
	$cliente -> ajaxEditarCampana();

}