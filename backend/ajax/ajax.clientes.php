<?php

require_once "../controladores/controlador.clientes.php";
require_once "../modelos/modelo.clientes.php";

class AjaxClientes{

	#EDITAR CLIENTE
	#----------------------------------------------------------

	public $idCliente;

	public function ajaxEditarCliente(){

		$item = "id_cliente";
		
		$valor = $this->idCliente;

		$respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);

		echo json_encode($respuesta);


	}


	#MOSTRAR CLIENTE DESDE SOLICITUD
	#----------------------------------------------------------

	public $idClienteSolicitud;

	public function ajaxMostrarClienteSolicitud(){

		$item = "id_cliente";
		
		$valor = $this->idClienteSolicitud;

		$respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);

		echo json_encode($respuesta);


	}



	#CONSULTAR CLIENTES
	#----------------------------------------------------------

	public $searchTerm;

	public function ajaxSelectCliente(){

		$valor = $this->searchTerm;

		$respuesta = ControladorClientes::ctrSelectClientes($valor);

		$country = array();

		$i = 0;
		
		foreach ($respuesta[1] as $key) 
		{
			$respuesta[1][$i]['desc'] = $key['nombre'];;
			$respuesta[1][$i]['id'] = $key['id_cliente'];
			$i++;
		}
	
		$country['items'] = $respuesta[1];
		
		echo json_encode($country);

	}

}

/*=============================================
CONSULTAR CLIENTES
=============================================*/	

if(isset($_GET['q'])){

	$searchTerm = new AjaxClientes();
	$searchTerm -> searchTerm = $_GET["q"];
	$searchTerm -> ajaxSelectCliente();

}

/*=============================================
EDITAR CLIENTE
=============================================*/	


if(isset($_POST["idCliente"])){

	$cliente = new AjaxClientes();
	$cliente -> idCliente = $_POST["idCliente"];
	$cliente -> ajaxEditarCliente();

}


/*=============================================
CONSULTAR CLIENTE DESDE SOLICITUD
=============================================*/	


if(isset($_POST["idClienteDato"])){

	$cliente = new AjaxClientes();
	$cliente -> idClienteSolicitud = $_POST["idClienteSolicitud"];
	$cliente -> ajaxMostrarClienteSolicitud();

}