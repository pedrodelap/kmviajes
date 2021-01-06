<?php

class ControladorVenta{

	
	#LISTAR VENTAS 
	#---------------------------------------------------
	public static function ctrListarVentas($datos){

		ModeloSlide::mdlActualizarOrden($datos, "tb_slide");

		$respuesta = ModeloSlide::mdlSeleccionarOrden("tb_slide");

	}

}