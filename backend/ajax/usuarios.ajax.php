<?php

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

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