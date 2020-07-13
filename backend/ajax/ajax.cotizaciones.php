<?php

require_once "../controladores/controlador.cotizaciones.php";
require_once "../modelos/modelo.cotizaciones.php";

class AjaxCotizaciones{

	#REGISTRAR COTIZACION
	#----------------------------------------------------------

	public $idCliente;
	public $usuarioCreacion;	

	public function ajaxCrearCotizacion(){

		$datos = array("idCliente"=>$this->idCliente,
					   "usuario_creacion"=>$this->usuarioCreacion);
	
		$respuesta = ControladorCotizaciones::ctrCrearCotizacion($datos);

		echo json_encode($respuesta);

	}

}

/*=============================================
REGISTRAR COTIZACION
=============================================*/	


if(isset($_POST["cotizacionNuevoCliente"])){

	$cotizacion = new AjaxCotizaciones();
	$cotizacion -> idCliente = $_POST["cotizacionNuevoCliente"];
	$cotizacion -> usuarioCreacion = $_POST["cotizacionNuevoUsuarioCreacion"];	
	$cotizacion -> ajaxCrearCotizacion();

}
