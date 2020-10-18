<?php

require_once "../controladores/monedas.controlador.php";
require_once "../modelos/monedas.modelo.php";

class AjaxMonedas{

	/*=============================================
	EDITAR MONEDA
	=============================================*/	

	public $idmoneda;

	public function ajaxEditarMoneda(){

		$item = "id_moneda";
		$valor = $this->idMoneda;

		$respuesta = ControladorMonedas::ctrMostrarMonedas($item, $valor);

		echo json_encode($respuesta);

	}

}

/*=============================================
EDITAR MONEDA
=============================================*/	

if(isset($_POST["idMoneda"])){

	$moneda = new AjaxMonedas();
	$moneda -> idMoneda = $_POST["idMoneda"];
	$moneda -> ajaxEditarMoneda();

}