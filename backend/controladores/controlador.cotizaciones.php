<?php

class ControladorCotizaciones{

	#CREAR COTIZACION
	#-----------------------------------------------------	
	static public function ctrCrearCotizacion($datos){

		$tabla = "tb_cotizaciones";

		$respuesta = ModeloCotizaciones::mdlCrearCotizacion($tabla, $datos);

		return $respuesta;

	}

	#MOSTRAR PROPUESTA
	#-----------------------------------------------------	
	static public function ctrMostrarCotizaciones($item, $valor){

		$tabla = "tb_cotizaciones";

		$respuesta = ModeloCotizaciones::mdlMostrarCotizaciones($tabla, $item, $valor);

		return $respuesta;

	}

}