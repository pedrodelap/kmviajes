<?php

require_once "../backend/modelos/conexion.php";
require_once "../modelos/paquete.modelo.php";

require_once "../controladores/controlador.mensajes.php";
require_once "../controladores/paquete.controlador.php";

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

	public function ajaxPagarOnLine($datosPago){

		$respuesta = null;
		$respuesta = ControladorPaqueteFront::ctrEnviarPagoPasarella($datosPago);
		
		
		$statePago = $respuesta["transactionResponse"]["state"];

		if ($statePago == "APPROVED"){
			$orderID = $respuesta["transactionResponse"]["orderId"];
			$datosVenta = array(
				"solicitud"=>$datosPago["id_solicitud"],
				"operacion"=>$orderID,
				"ruc"=>$datosPago["ruc"],
				"razon_social"=>$datosPago["razon_social"],
				"monto"=>$datosPago["amount"],
				"id_habitacion"=>$datosPago["idHabitacion"]
		  );
		  $idVenta = ControladorPaqueteFront::ctrCrearVenta($datosVenta);

		  $pasajeronJson = json_decode($datosPago["pasajeros"]);
			foreach($pasajeronJson as $item){
				$datosPasajero = array("venta"=>$idVenta[0],				   
									"nombres"=>$item->firstname,
									"apellidos"=>$item->lastname,
									"tipoDoc"=>$item->docnumberType,
									"NroDoc"=>$item->docNumber
									);	
				ControladorPaqueteFront::ctrCrearPasajero($datosPasajero);

			}

		}
		echo json_encode($idVenta);
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
							  "correo"=>strtolower($this->correo));

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

			$idSolicitud = $respuesta["codigo_seguimiento"];
			
			//enviar mail
			$datosMail = array("mailTo" => $datosCliente["correo"],
								"nombreCliente" => $datosCliente["nombres"],
								"tituloMail" => "Solicitud Registrada #".$idSolicitud,
								"enviarMensaje" => $idSolicitud);

			//echo "<script>".var_dump($datosSolicitud)."</script>";
            //echo("<script>console.log('PHP: ');</script>");
			
            MensajesController::ctrEnviarMail($datosMail); 

			//$respuesta = json_encode($respuesta);

		}

		echo json_encode($respuesta);;

	}



	public $search;

	public function ajaxSearchPaisCiudad(){

		$valor = $this->search;

		$respuesta = ControladorPaqueteFront::ctrSelectSearchPaisCiudad($valor);

		$i = 0;
		
		foreach ($respuesta[1] as $key) 
		{

			$response[] = array("value"=>$key['id'],"label"=>$key['name']);

			$i++;
		}

		echo json_encode($response);

	}

	public function ajaxCambiarEstadoHistorialSolicitud($datos){

		$datosVenta = array("solicitud"=>$datos["id_solicitud"],
							"estado"=>$datos["estado"]
		);
		ControladorPaqueteFront::ctrCrearHistorialSolicitud($datosVenta);

		echo json_encode('ok');

	}

	public function ajaxValidarCliente($datos){

		$respuesta = ControladorPaqueteFront::ctrObtenerClienteByEmail($datos);
		echo json_encode($respuesta);

	}

	public function ajaxRegistrarCalificacion($datos){

		$respuesta1 = ControladorPaqueteFront::ctrInsertarCalificacionHotel($datos);

		$respuesta2 = ControladorPaqueteFront::ctrInsertarCalificacionAerolinea($datos);

		$respuesta3 = ControladorPaqueteFront::ctrInsertarCalificacionComentario($datos);

		


		$servicioJSON = json_decode($datos["servicios"]);
			foreach($servicioJSON as $item){
				$datoServicio= array("id_solicitud"=>$datos["id_solicitud"],				   
									"id_servicio"=>$item->idServicio,
									"valor"=>$item->valor
									);	
				ControladorPaqueteFront::ctrInsertarCalificacionServicio($datoServicio);

		}

		echo json_encode($respuesta3);

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

	$solicitud -> ajaxCrearSolicitudPersonalizada();

}


if(isset($_POST["SolicitudPersonalizadaNueva2"])){

	$solicitud = new AjaxPaquetes();

	$solicitud -> nombres = $_POST["SolicitudPersonalizadaNombres"];
	$solicitud -> apellidos = $_POST["SolicitudPersonalizadaApellidos"];
	$solicitud -> telefono = $_POST["SolicitudPersonalizadaTelefono"];
	$solicitud -> documento = $_POST["SolicitudPersonalizadaDocumento"];
	$solicitud -> correo = $_POST["SolicitudPersonalizadaCorreo"];
	$solicitud -> adultos = $_POST["SolicitudPersonalizadaAdultos"];
	$solicitud -> ninos = $_POST["SolicitudPersonalizadaNinos"];
	$solicitud -> observacion = $_POST["SolicitudPersonalizadaObservacion"];
	$solicitud -> idpaquete = $_POST["SolicitudPersonalizadaIdPaquete"];
	$solicitud -> nueva = $_POST["SolicitudPersonalizadaNueva2"];

	$solicitud -> ajaxCrearSolicitudPersonalizada();

}

if(isset($_POST["ciudad"])){

	$cliente = new AjaxPaquetes();
	$cliente -> ajaxListCiudaddes();

}

if(isset($_POST["pagar"])){

	$pagar = new AjaxPaquetes();

	$datosPago = array("referenceCode"=>$_POST["referenceCode"],
						"amount"=>$_POST["amount"],
					  	"currency"=>$_POST["currency"],
						"description"=>$_POST["description"],
						"emailAddress"=>$_POST["emailAddress"],
						"fullName"=>$_POST["fullName"],
						"phone"=>$_POST["phone"],
						"merchantPayerId"=>$_POST["merchantPayerId"],
						"number"=>$_POST["number"],
						"securityCode"=>$_POST["securityCode"],
						"expirationDate"=>$_POST["expirationDate"],
						"paymentMethod"=>$_POST["paymentMethod"],
						"dniNumber"=>$_POST["dniNumber"],
						"id_solicitud"=>$_POST["id_solicitud"],
						"ruc" => $_POST["ruc"],
						"razon_social" => $_POST["razon_social"],
						"cuotas" => $_POST["cuotas"],
						"pasajeros" => $_POST["pasajeros"],
						"idHabitacion" => $_POST["idHabitacion"]
					);
	$pagar -> ajaxPagarOnLine($datosPago);

}



if(isset($_POST['search'])){

	$buscarCiudadPais = new AjaxPaquetes();
	$buscarCiudadPais -> search = $_POST["search"];
	$buscarCiudadPais -> ajaxSearchPaisCiudad();

}


if(isset($_POST['cambiarEstado'])){
	$pagar = new AjaxPaquetes();

	$datosPago = array("estado"=>$_POST["estado"],
						"id_solicitud"=>$_POST["id_solicitud"]);
	$pagar -> ajaxCambiarEstadoHistorialSolicitud($datosPago);
}

if(isset($_POST['searchCliente'])){

	$buscarCliente = new AjaxPaquetes();
	$buscarCliente -> ajaxValidarCliente($_POST["searchCliente"]);

}



if(isset($_POST['calificar'])){
    $calificacion = new AjaxPaquetes();
   
    $datos = array("calificacionAerolinea" => $_POST["calificacionAerolinea"],
                            "calificacionHotel" => $_POST["calificacionHotel"],
                            "comentarios"=> $_POST["comentarios"],
							"id_aerolinea" => $_POST["id_aerolinea"],
							"id_hotel" => $_POST["id_hotel"],
                            "id_solicitud" => $_POST["id_solicitud"],
                            "mejoraAerolinea"=> $_POST["mejoraAerolinea"],
							"mejoraHotel" => $_POST["mejoraHotel"],
							"servicios" => $_POST["servicios"]
                            );

    $calificacion -> ajaxRegistrarCalificacion($datos);
}