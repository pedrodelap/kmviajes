<?php

class ControladorPropuestas{

	#CREAR PROPUESTA
	#------------------------------------------------------------	
	static public function ctrCrearPropuesta($datos){

		$tabla = "tb_propuestas";

		$respuesta = ModeloPropuestas::mdlCrearPropuesta($tabla, $datos);

		return $respuesta;

	}

	#MOSTRAR PROPUESTA
	#------------------------------------------------------------		
	static public function ctrConsultarPropuestas($valor, $item){

		$tabla = "tb_propuestas";

		$tablaPropuesta = '';

		$respuesta = ModeloPropuestas::mdlConsultarPropuestas($tabla, $valor, $item);

		foreach ($respuesta as $key => $value) {

			$tablaPropuesta .= '<tr>

									<td>'.$value["id_cotizacion"].'</td>

									<td>'.$value["tipo_viaje"].'</td>

									<td>'.$value["aerolinea"].'</td>

									<td>'.$value["cantidad"].'</td>

									<td>'.$value["detraccion"].'</td>

									<td>'.$value["costo"].'</td>

									<td>'.$value["cuota"].'</td>';

									if($value["estado"] == 1){

										$tablaPropuesta .= '<td><input type="checkbox" checked data-toggle="toggle" data-size="mini" data-onstyle="primary" class="btn btn-secondary fa fa-edit btnCambiarPropuesta" estadoPropuesta="1" idPropuesta="'.$value["id_propuesta"].'"></td>';

									}else {

										$tablaPropuesta .= '<td><input type="checkbox" data-toggle="toggle" data-size="mini" data-onstyle="primary" class="btn btn-secondary fa fa-edit btnCambiarPropuesta" estadoPropuesta="0" idPropuesta="'.$value["id_propuesta"].'"></td>';

									}

									$tablaPropuesta .= '<td> <span><button class="btn btn-secondary fa fa-edit btnEditarPropuesta" idPropuesta="'.$value["id_propuesta"].'" data-toggle="modal" data-target="#modalEditarCotizacion"></button></span>&nbsp;';

										if($_SESSION["perfil"] == "Administrador"){

											$tablaPropuesta .= '<span><button class="btn btn-danger fa fa-times btnEliminarPropuesta" idPropuesta="'.$value["id_propuesta"].'"></button></span>';
										}											

									$tablaPropuesta .= '</td>

                                </tr>';

		}

		return $tablaPropuesta;

	}

	#ACTUALIZAR COTIZACION ESTADO
	#------------------------------------------------------------
	static public function ctrActualizarEstadoPropuesta($datos){

		$tabla = "tb_propuestas";

		$respuesta = ModeloPropuestas::mdlActualizarEstadoPropuesta($tabla, $datos);

		return $respuesta;
	}

}

