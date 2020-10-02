<?php

class ControladorServicios{

	#MOSTRAR CLIENTES
	#-----------------------------------------------------
	static public function ctrMostrarServicios($item, $valor){

		$tabla = "tb_servicios";

		$respuesta = ModeloServicios::mdlMostrarServicios($tabla, $item, $valor);

		return $respuesta;

	}

}

