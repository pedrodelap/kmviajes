<?php

require_once "../controladores/controlador.cotizaciones.php";
require_once "../modelos/modelo.cotizaciones.php";

class AjaxCotizaciones{

	#REGISTRAR COTIZACION
	#----------------------------------------------------------

	public $idCliente;
	public $idSolicitud;
	public $usuarioCreacion;

	public function ajaxCrearCotizacion(){

		$datos = array("idCliente"=>$this->idCliente,
					   "id_solicitud"=>$this->idSolicitud,
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
	$cotizacion -> idSolicitud = $_POST["cotizacionNuevoIdSolicitud"];	
	$cotizacion -> usuarioCreacion = $_POST["cotizacionNuevoUsuarioCreacion"];
	$cotizacion -> ajaxCrearCotizacion();

}
