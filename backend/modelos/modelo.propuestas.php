<?php

require_once "conexion.php";

class ModeloPropuestas{

	#CREAR PROPUESTA
	#-----------------------------------------------------
	static public function mdlCrearPropuesta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("CALL usp_insert_propuesta(:id_cotizacion, 
																		 :tipo_viaje,
																		 :id_aerolinea,
																		 :adultos_cantidad,
																		 :adultos_costo_unitario,
																		 :adultos_fee,
																		 :ninio_cantidad,
																		 :ninio_costo_unitario,
																		 :ninio_fee,
																		 :detraccion,
																		 :tipo_cambio,
																		 :usuario_creacion)");

		$stmt->bindParam(":id_cotizacion", $datos["id_cotizacion"], PDO::PARAM_INT);
		$stmt->bindParam(":tipo_viaje", $datos["tipo_viaje"], PDO::PARAM_STR);
		$stmt->bindParam(":id_aerolinea", $datos["id_aerolinea"], PDO::PARAM_INT);
		$stmt->bindParam(":adultos_cantidad", $datos["adultos_cantidad"], PDO::PARAM_INT);
		$stmt->bindParam(":adultos_costo_unitario", $datos["adultos_costo_unitario"], PDO::PARAM_STR);
		$stmt->bindParam(":adultos_fee", $datos["adultos_fee"], PDO::PARAM_STR);
		$stmt->bindParam(":ninio_cantidad", $datos["ninio_cantidad"], PDO::PARAM_INT);
		$stmt->bindParam(":ninio_costo_unitario", $datos["ninio_costo_unitario"], PDO::PARAM_STR);
		$stmt->bindParam(":ninio_fee", $datos["ninio_fee"], PDO::PARAM_STR);		
		$stmt->bindParam(":detraccion", $datos["detraccion"], PDO::PARAM_INT);
		$stmt->bindParam(":tipo_cambio", $datos["tipo_cambio"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario_creacion", $datos["usuario_creacion"], PDO::PARAM_STR);
		
		if($stmt->execute()){

			return $stmt -> fetch();

		}else{

			return "error";
		
		}

		$stmt -> close();
		$stmt = null;

	}

	#CONSULTAR PROPUESTAS
	#-----------------------------------------------------
	static public function mdlConsultarPropuestas($tabla, $valor, $item){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("CALL usp_listar_propuestas(:id_cotizacion)");

			$stmt->bindParam(":id_cotizacion", $valor, PDO::PARAM_INT);

			if($stmt->execute()){

				return $stmt -> fetchAll();

			}else{

				return "error";
			
			}

		}

		$stmt->close();
		
		$stmt = null;

	}

	#ACTUALIZAR PROPUESTAS ESTADO
	#------------------------------------------------------------
	static public function mdlActualizarEstadoPropuesta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = :estado WHERE id_propuesta = :id_propuesta");

		$stmt->bindParam(":id_propuesta", $datos["id_propuesta"], PDO::PARAM_INT);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

}