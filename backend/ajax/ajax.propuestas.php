<?php

require_once "../controladores/controlador.propuestas.php";
require_once "../modelos/modelo.propuestas.php";

class AjaxPropuestas{

	#REGISTRAR PROPUESTA
	#----------------------------------------------------------

	public $propuestaIDCotizacion;
	public $propuestaTipoViaje;
	public $propuestaIDAerolinea;
	public $propuestaIDTipoMoneda;
	public $propuestaDetraccion;
	public $propuestaAdultosCantidad;
	public $propuestaAdultosSF;
	public $propuestaAdultosFee;
	public $propuestaNinioCantidad;
	public $propuestaNinioSF;
	public $propuestaNinioFee;
	public $propuestaInfanteCantidad;
	public $propuestaInfanteSF;
	public $propuestaInfanteFee;
	public $propuestaUsuarioCreacion;

	public function ajaxCrearPropuesta(){

		$datos = array("id_cotizacion"=>$this->propuestaIDCotizacion,
					"tipo_viaje"=>$this->propuestaTipoViaje,
					"id_aerolinea"=>$this->propuestaIDAerolinea,
					"id_moneda"=>$this->propuestaIDTipoMoneda,
					"detracion"=>$this->propuestaDetraccion,
					"adultos_cantidad"=>$this->propuestaAdultosCantidad,
					"adultos_sf"=>$this->propuestaAdultosSF,
					"adultos_fee"=>$this->propuestaAdultosFee,
					"ninio_cantidad"=>$this->propuestaNinioCantidad,
					"ninio_sf"=>$this->propuestaNinioSF,
					"ninio_fee"=>$this->propuestaNinioFee,
					"infante_cantidad"=>$this->propuestaInfanteCantidad,
					"infante_sf"=>$this->propuestaInfanteSF,
					"infante_fee"=>$this->propuestaInfanteFee,				   
					"usuario_creacion"=>$this->propuestaUsuarioCreacion);
		
		$respuesta = ControladorPropuestas::ctrCrearPropuesta($datos);

		echo json_encode($respuesta);

	}

	#CONSULTAR PROPUESTA
	#----------------------------------------------------------

	public $idCotizacion;

	public function ajaxConsultarPropuestas(){

		$item = null;

		$valor = $this->idCotizacion;

		$respuesta = ControladorPropuestas::ctrConsultarPropuestas($valor, $item);

		echo json_encode($respuesta);

	}

	#EDIAR PROPUESTA
	#----------------------------------------------------------

	public $idPropuesta;

	public function ajaxEditarPropuesta(){

		$item = "id_propuesta";
		
		$valor = $this->idPropuesta;

		$respuesta = ControladorPropuestas::ctrConsultarPropuestas($valor, $item);

		echo json_encode($respuesta);

	}

}

/*=============================================
REGISTRAR PROPUESTA
=============================================*/	

if(isset($_POST["cotizacionNuevoCotizacion"])){

	$propuesta = new AjaxPropuestas();
	$propuesta -> propuestaIDCotizacion = $_POST["cotizacionNuevoCotizacion"];
	$propuesta -> propuestaTipoViaje = $_POST["cotizacionNuevoTipoViaje"];	
	$propuesta -> propuestaIDAerolinea = $_POST["cotizacionNuevoAerolinea"];	
	$propuesta -> propuestaIDTipoMoneda = $_POST["cotizacionNuevoTipoMoneda"];	
	$propuesta -> propuestaDetraccion = $_POST["cotizacionNuevoDetraccion"];
	$propuesta -> propuestaAdultosCantidad = $_POST["cotizacionNuevoAdultosCantidad"];
	$propuesta -> propuestaAdultosSF = $_POST["cotizacionNuevoAdultosSF"];
	$propuesta -> propuestaAdultosFee = $_POST["cotizacionNuevoAdultosFee"];
	$propuesta -> propuestaNinioCantidad = $_POST["cotizacionNuevoNinioCantidad"];
	$propuesta -> propuestaNinioSF = $_POST["cotizacionNuevoNinioSF"];
	$propuesta -> propuestaNinioFee = $_POST["cotizacionNuevoNinioFee"];
	$propuesta -> propuestaInfanteCantidad = $_POST["cotizacionNuevoInfanteCantidad"];
	$propuesta -> propuestaInfanteSF = $_POST["cotizacionNuevoInfanteSF"];
	$propuesta -> propuestaInfanteFee = $_POST["cotizacionNuevoInfanteFee"];	
	$propuesta -> propuestaUsuarioCreacion = $_POST["cotizacionNuevoUsuarioCreacion"];
	$propuesta -> ajaxCrearPropuesta();

}


/*=============================================
CONSULTAR PROPUESTA
=============================================*/	

if(isset($_POST["idCotizacion"])){

	$cotizacion = new AjaxPropuestas();
	$cotizacion -> idCotizacion = $_POST["idCotizacion"];
	$cotizacion -> ajaxConsultarPropuestas();

}


/*=============================================
EDIAR PROPUESTA
=============================================*/	

if(isset($_POST["idPropuesta"])){

	$propuesta = new AjaxPropuestas();
	$propuesta -> idPropuesta = $_POST["idPropuesta"];
	$propuesta -> ajaxEditarPropuesta();

}