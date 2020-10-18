<?php

require_once "../controladores/controlador.propuestas.php";
require_once "../modelos/modelo.propuestas.php";

class AjaxPropuestas{

	#REGISTRAR PROPUESTA
	#----------------------------------------------------------

	public $propuestaIDCotizacion;
	public $propuestaTipoViaje;	
	public $propuestaIDAerolinea;	
	public $propuestaAdultosCantidad;
    public $propuestaAdultosCostoUnitario;
    public $propuestaAdultosFee;
    public $propuestaNinosCantidad;
    public $propuestaNinosCostoUnitario;
    public $propuestaNinosFee;
    public $propuestaDetraccion;
	public $propuestaCambioMoneda;
    public $propuestaUsuarioCreacion;

	public function ajaxCrearPropuesta(){

		$datos = array("id_cotizacion"=>$this->propuestaIDCotizacion,
					   "tipo_viaje"=>$this->propuestaTipoViaje,
					   "id_aerolinea"=>$this->propuestaIDAerolinea,
					   "adultos_cantidad"=>$this->propuestaAdultosCantidad,
					   "adultos_costo_unitario"=>$this->propuestaAdultosCostoUnitario,
					   "adultos_fee"=>$this->propuestaAdultosFee,
					   "ninio_cantidad"=>$this->propuestaNinosCantidad,
					   "ninio_costo_unitario"=>$this->propuestaNinosCostoUnitario,
					   "ninio_fee"=>$this->propuestaNinosFee,
					   "detraccion"=>$this->propuestaDetraccion,
					   "tipo_cambio"=>$this->propuestaCambioMoneda,				   
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


	#ACTUALIZAR PROPUESTAS ESTADO
	#----------------------------------------------------------

	public $estadoidPropuesta;
	public $estadoPropuesta;

	public function ajaxActualizarEstadoPropuesta(){

		$datos = array("id_propuesta"=>$this->estadoidPropuesta,
					   "estado"=>$this->estadoPropuesta);

		$respuesta = ControladorPropuestas::ctrActualizarEstadoPropuesta($datos);

		echo $respuesta;


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
	$propuesta -> propuestaAdultosCantidad = $_POST["cotizacionNuevoAdultosCantidad"];
    $propuesta -> propuestaAdultosCostoUnitario = $_POST["cotizacionNuevoAdultosCostoUnitario"];
    $propuesta -> propuestaAdultosFee = $_POST["cotizacionNuevoAdultosFee"];
    $propuesta -> propuestaNinosCantidad = $_POST["cotizacionNuevoNinosCantidad"];
    $propuesta -> propuestaNinosCostoUnitario = $_POST["cotizacionNuevoNinosCostoUnitario"];
    $propuesta -> propuestaNinosFee = $_POST["cotizacionNuevoNinosFee"];
    $propuesta -> propuestaDetraccion = $_POST["cotizacionNuevoDetraccion"];
    $propuesta -> propuestaCambioMoneda = $_POST["cotizacionNuevoCambioMoneda"];
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

/*=============================================
ACTUALIZAR PROPUESTAS ESTADO
=============================================*/	

if(isset($_POST["idPropuestaEstado"])){

	$propuesta = new AjaxPropuestas();
	$propuesta -> estadoidPropuesta = $_POST["idPropuestaEstado"];
	$propuesta -> estadoPropuesta = $_POST["estadoPropuesta"];
	$propuesta -> ajaxActualizarEstadoPropuesta();

}