<?php

require_once "../backend/modelos/conexion.php";


require_once "../controladores/mensajes.controlador.php";
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


	#CREAR SOLICITUD PERSONAZALIZADA
	#----------------------------------------------------------

	public $nombres;
	public $apellidos;
	public $telefono;
	public $documento;
	public $correo;
	public $idcliente;
	public $idpaquete;
	public $ciudad;
	public $fecha;
	public $fechaInicio;
	public $fechaFin;
	public $adultos;
	public $ninos;
	public $observacion;
	public $nueva;

	public function ajaxCrearSolicitudPersonalizada(){

		$respuesta = null;

		$datosCliente = array("nombres"=>strtoupper($this->nombres),
							  "apellidos"=>strtoupper($this->apellidos),
							  "telefono"=>$this->telefono,
							  "numero_documento"=>$this->documento,
							  "correo"=>strtoupper($this->correo));

		$respuesta = ControladorPaqueteFront::ctrCrearClienteSolicitudPersonalizada($datosCliente);

		if($respuesta != "errorValidacionCliente"){

			$this->idcliente = $respuesta[0];

			if ($this->idpaquete == "" ){

				$this->idpaquete = null;
			}

			$datosSolicitud = array("id_cliente"=>$this->idcliente,				   
									"id_ciudad"=>$this->ciudad,
									"fecha_mostrar"=>$this->fecha,
									"fecha_inicio"=>$this->fechaInicio,
									"fecha_fin"=>$this->fechaFin,
									"cantidad_adultos"=>$this->adultos,
									"cantidad_ninios"=>$this->ninos,
									"comentario"=>$this->observacion,
									"id_paquete"=>$this->idpaquete);		

			$respuesta = ControladorPaqueteFront::ctrCrearSolicitudPersonalizada($datosSolicitud);

			$respuesta = json_encode($respuesta);

			//enviar mail
			$datosMail = array("mailTo" => $datosCliente["correo"],
								"nombreCliente" => $datosCliente["nombres"],
								"tituloMail" => "Solicitud Registrada #".$resultado,
								"enviarMensaje" => "<p>Mensaje contenido ".$resultado." </p>");

			//echo "<script>".var_dump($datosSolicitud)."</script>";
            //echo("<script>console.log('PHP: ');</script>");
			
            //$mail = MensajesController::ctrEnviarMail($datosMail);

		}

		echo json_encode($respuesta);;

	}

}

/*=============================================
LISTAR / BUSCAR PAQUETES
=============================================*/

if(isset($_POST["txtBuscar"])){

	$cliente = new AjaxPaquetes();
	$cliente -> buscar = $_POST["txtBuscar"];
	$cliente -> ajaxBuscarPaquetes();

}


/*=============================================
SOLICITUD PERSONALIZADA NUEVA
=============================================*/

if(isset($_POST["SolicitudPersonalizadaNueva"])){

	$solicitud = new AjaxPaquetes();

	$solicitud -> nombres = $_POST["SolicitudPersonalizadaNombres"];
	$solicitud -> apellidos = $_POST["SolicitudPersonalizadaApellidos"];
	$solicitud -> telefono = $_POST["SolicitudPersonalizadaTelefono"];
	$solicitud -> documento = $_POST["SolicitudPersonalizadaDocumento"];
	$solicitud -> correo = $_POST["SolicitudPersonalizadaCorreo"];
	$solicitud -> ciudad = $_POST["SolicitudPersonalizadaCiudad"];
	$solicitud -> fecha = $_POST["SolicitudPersonalizadaFecha"];
	$solicitud -> fechaInicio = $_POST["SolicitudPersonalizadaFechaInicio"];
	$solicitud -> fechaFin = $_POST["nSolicitudPersonalizadaFechaFin"];
	$solicitud -> adultos = $_POST["SolicitudPersonalizadaAdultos"];
	$solicitud -> ninos = $_POST["SolicitudPersonalizadaNinos"];
	$solicitud -> observacion = $_POST["SolicitudPersonalizadaObservacion"];
	$solicitud -> idpaquete = $_POST["SolicitudPersonalizadaIdPaquete"];
	$solicitud -> nueva = $_POST["SolicitudPersonalizadaNueva"];
	$solicitud -> servicios = $_POST["SolicitudPersonalizadaServicios"];

	$solicitud -> ajaxCrearSolicitudPersonalizada();

}

if(isset($_POST["SolicitudPersonalizadaNueva2"])){

	$solicitud = new AjaxPaquetes();

	$solicitud -> nombres = $_POST["SolicitudPersonalizadaNombres"];
	$solicitud -> apellidos = $_POST["SolicitudPersonalizadaApellidos"];
	$solicitud -> telefono = $_POST["SolicitudPersonalizadaTelefono"];
	$solicitud -> documento = $_POST["SolicitudPersonalizadaDocumento"];
	$solicitud -> correo = $_POST["SolicitudPersonalizadaCorreo"];
	$solicitud -> ciudad = $_POST["SolicitudPersonalizadaCiudad"];
	$solicitud -> fecha = $_POST["SolicitudPersonalizadaFecha"];
	$solicitud -> fechaInicio = $_POST["SolicitudPersonalizadaFechaInicio"];
	$solicitud -> fechaFin = $_POST["nSolicitudPersonalizadaFechaFin"];
	$solicitud -> adultos = $_POST["SolicitudPersonalizadaAdultos"];
	$solicitud -> ninos = $_POST["SolicitudPersonalizadaNinos"];
	$solicitud -> observacion = $_POST["SolicitudPersonalizadaObservacion"];
	$solicitud -> idpaquete = $_POST["SolicitudPersonalizadaIdPaquete"];
	$solicitud -> nueva = $_POST["SolicitudPersonalizadaNueva"];
	$solicitud -> servicios = $_POST["SolicitudPersonalizadaServicios"];

	$solicitud -> ajaxCrearSolicitudPersonalizada();

}

if(isset($_POST["ciudad"])){

	$cliente = new AjaxPaquetes();
	$cliente -> ajaxListCiudaddes();

}