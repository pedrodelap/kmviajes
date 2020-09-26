<?php

require_once "../backend/modelos/conexion.php";

require_once "../controladores/paquete.controlador.php";
require_once "../modelos/paquete.modelo.php";

class AjaxPaquetes{

	#EDITAR CLIENTE
	#----------------------------------------------------------

	public $buscar;

	public function ajaxBuscarPaquetes(){

		$valor = $this->buscar;

		$respuesta = ControladorPaqueteFront::ctrlistarTodosPaquetesDisponibles($valor);

		return $respuesta;


	}

	public function ajaxListCiudaddes(){

		$respuesta = ControladorPaqueteFront::ctrListarCiudad();
		return $respuesta;
	}


	#CONSULTAR CLIENTES
	#----------------------------------------------------------

	
	public $id_paquete;
	public $id_ciudad;
	public $fecha_inicio;
	public $fecha_fin;
	public $numero_ninios;
	public $numero_adultos;
	public $comentario;
	public $servicios;
	public $nombres;
	public $apellidos;
	public $numero_documento;
	public $telefono;
	public $correo;

	public function ajaxCrearSolicitud(){

		$datos = array(
						  "nombres"=>$this->nombres,
						  "apellidos"=>$this->apellidos,
						  "numero_documento"=>$this->numero_documento,
						  "telefono"=>$this->telefono,
						  "correo"=>$this->correo,
						  "servicios"=>$this->servicios,
						  "numero_ninios"=>$this->numero_ninios,
						  "numero_adultos"=>$this->numero_adultos,
						  "comentario"=>$this->comentario,
						  "fecha_inicio"=>$this->fecha_inicio,
						  "fecha_fin"=>$this->fecha_fin,
						  "id_ciudad"=>$this->id_ciudad,
						  "id_paquete"=>$this->id_paquete
					);
		
		$respuesta = ControladorPaqueteFront::ctrCrearSolicitud($datos);

		echo json_encode($respuesta);

	}

}
/*=============================================
EDITAR CLIENTE
=============================================*/	


if(isset($_POST["txtBuscar"])){

	$cliente = new AjaxPaquetes();
	$cliente -> buscar = $_POST["txtBuscar"];
	$cliente -> ajaxBuscarPaquetes();

}

if(isset($_POST["txtNombre"])){

	$solicitud = new AjaxPaquetes();
	$solicitud -> nombres = $_POST["txtNombre"];
	$solicitud -> apellidos = $_POST["txtApellidos"];
	$solicitud -> telefono = $_POST["txtTelefono"];
	$solicitud -> numero_documento = $_POST["txtDocumento"];
	$solicitud -> correo = $_POST["txtCorreo"];	
	//$solicitud -> fecha = $_POST["txtFecha"];

	$split = explode('-', $_POST["txtFecha"]);
	$solicitud -> fecha_inicio = $split[0];
	$solicitud -> fecha_fin = $split[1];

	$solicitud -> numero_adultos = $_POST["txtAdultos"];
	$solicitud -> numero_ninios = $_POST["txtNinios"];
	$solicitud -> servicios = $_POST["txtServicios"];
	$solicitud -> comentario = $_POST["txtObservacion"];	
	$solicitud -> id_paquete = $_POST["id_paquete"];
	$solicitud -> id_ciudad = $_POST["id_ciudad"];

	$solicitud -> ajaxCrearSolicitud();

}


if(isset($_POST["ciudad"])){

	$cliente = new AjaxPaquetes();
	$cliente -> ajaxListCiudaddes();

}