<?php

require_once "../controladores/controlador.monedas.php";
require_once "../modelos/modelo.monedas.php";

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