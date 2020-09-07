<?php

require_once "../controladores/controlador.usuarios.php";
require_once "../modelos/modelo.usuarios.php";

class AjaxUsuarios{

	/*=============================================
	CONSULTAR USUARIO
	=============================================*/	

	public $idUsuario;

	public function ajaxConsultarUsuario(){

		$item = "id_usuario";
		$valor = $this->idUsuario;

		$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

		echo json_encode($respuesta);

	}

}

/*=============================================
EDITAR USUARIO
=============================================*/	

if(isset($_POST["idUsuario"])){

	$usuario = new AjaxUsuarios();
	$usuario -> idUsuario = $_POST["idUsuario"];
	$usuario -> ajaxConsultarUsuario();

}