<?php

class ControladorItinerarios{

	#CREAR PROPUESTA
	#------------------------------------------------------------	
	static public function ctrCrearItinerario($datos){

		$tabla = "tb_itinerarios";

		$respuesta = ModeloItinerarios::mdlCrearItinerario($tabla, $datos);

		return $respuesta;

	}

}