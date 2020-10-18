<?php

class ControladorPropuestas{

	/*=============================================
	CREAR PROPUESTA
	=============================================*/

	static public function ctrCrearPropuesta($datos){

		$tabla = "tb_propuestas";

		$respuesta = ModeloPropuestas::mdlCrearPropuesta($tabla, $datos);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR PROPUESTA
	=============================================*/

	static public function ctrConsultarPropuestas($valor, $item){

		$tabla = "tb_propuestas";

		$tablaPropuesta = '';

		$respuesta = ModeloPropuestas::mdlConsultarPropuestas($tabla, $valor, $item);

		foreach ($respuesta as $key => $value) {

			$tablaPropuesta .= '<tr>

									<td>'.$value["id_cotizacion"].'</td>

									<td>'.$value["tipo_viaje"].'</td>

									<td>'.$value["aerolinea"].'</td>

									<td>'.$value["cantidad_pasajeros"].'</td>

									<td>'.$value["nombre"].'</td>
									
									<td>'.$value["cantidad_sf"].'</td>
									
									<td>'.$value["cantidad_fee"].'</td>
									
									<td>'.$value["estado"].'</td>									

									<td>'.$value["usuario_modificacion"].'</td>

									<td>'.$value["fecha_modificacion"].'</td>

									<td class="text-center">

										<div role="group" class="btn-group-sm btn-group">

											<button class="btnEditarPropuesta border-0 btn-transition btn btn-outline-warning"  data-toggle="modal" data-target="#modalEditarCliente" idPropuesta="'.$value["id_propuesta"].'"><i class="lnr-pencil btn-icon-wrapper">&nbsp;</i>Editar</button>

											<button class="btnEliminarPropuesta border-0 btn-transition btn btn-outline-danger" idPropuesta="'.$value["id_propuesta"].'"><i class="lnr-cross btn-icon-wrapper">&nbsp;</i>Eliminar</button>

										</div>

									</td>

								</tr>';

		}

		return $tablaPropuesta;

	}

}