<?php

require_once "../controladores/aerolineas.controlador.php";
require_once "../modelos/aerolineas.modelo.php";

class AjaxAerolineas{

	#EDITAR AEROLINEA
	#----------------------------------------------------------

	public $idAerolinea;

	public function ajaxEditarAerolinea(){

		$item = "id_aerolinea";
		$valor = $this->idAerolinea;

		$respuesta = ControladorAerolineas::ctrMostrarAerolineas($item, $valor);

		echo json_encode($respuesta);


	}

	#CONSULTAR AEROLINEAS
	#----------------------------------------------------------

	public $searchTerm;

	public function ajaxSelectAerolinea(){

		$valor = $this->searchTerm;

		$respuesta = ControladorAerolineas::ctrSelectAerolineas($valor);

		$aerolinea = array();

		$i = 0;
		
		foreach ($respuesta[1] as $key) 
		{
			$respuesta[1][$i]['desc'] = $key['aerolinea'];;
			$respuesta[1][$i]['id'] = $key['id_aerolinea'];
			$i++;
		}
	
		$aerolinea['items'] = $respuesta[1];
		
		echo json_encode($aerolinea);

	}

}

/*=============================================
EDITAR AEROLINEA
=============================================*/	

if(isset($_POST["idAerolinea"])){

	$aerolinea = new AjaxAerolineas();
	$aerolinea -> idAerolinea = $_POST["idAerolinea"];
	$aerolinea -> ajaxEditarAerolinea();

}

/*=============================================
CONSULTAR AEROLINEAS
=============================================*/	

if(isset($_GET['q'])){

	$searchTerm = new AjaxAerolineas();
	$searchTerm -> searchTerm = $_GET["q"];
	$searchTerm -> ajaxSelectAerolinea();

}