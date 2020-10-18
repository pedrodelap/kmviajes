<?php

require_once "conexion.php";

class ModeloPropuestas{

	/*=============================================
	CREAR PROPUESTA
	=============================================*/

	static public function mdlCrearPropuesta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("CALL usp_insert_propuesta(:id_cotizacion, :tipo_viaje, :id_aerolinea, :id_moneda, :detracion, :adultos_cantidad, :adultos_sf, :adultos_fee, :ninio_cantidad, :ninio_sf, :ninio_fee, :infante_cantidad, :infante_sf, :infante_fee, :usuario_creacion)");

		$stmt->bindParam(":id_cotizacion", $datos["id_cotizacion"], PDO::PARAM_INT);
		$stmt->bindParam(":tipo_viaje", $datos["tipo_viaje"], PDO::PARAM_STR);
		$stmt->bindParam(":id_aerolinea", $datos["id_aerolinea"], PDO::PARAM_INT);
		$stmt->bindParam(":id_moneda", $datos["id_moneda"], PDO::PARAM_INT);
		$stmt->bindParam(":detracion", $datos["detracion"], PDO::PARAM_INT);
		$stmt->bindParam(":adultos_cantidad", $datos["adultos_cantidad"], PDO::PARAM_INT);
		$stmt->bindParam(":adultos_sf", $datos["adultos_sf"], PDO::PARAM_STR);
		$stmt->bindParam(":adultos_fee", $datos["adultos_fee"], PDO::PARAM_STR);
		$stmt->bindParam(":ninio_cantidad", $datos["ninio_cantidad"], PDO::PARAM_INT);
		$stmt->bindParam(":ninio_sf", $datos["ninio_sf"], PDO::PARAM_STR);
		$stmt->bindParam(":ninio_fee", $datos["ninio_fee"], PDO::PARAM_STR);
		$stmt->bindParam(":infante_cantidad", $datos["infante_cantidad"], PDO::PARAM_INT);
		$stmt->bindParam(":infante_sf", $datos["infante_sf"], PDO::PARAM_STR);
		$stmt->bindParam(":infante_fee", $datos["infante_fee"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario_creacion", $datos["usuario_creacion"], PDO::PARAM_STR);

		if($stmt->execute()){

			return $stmt -> fetch();

		}else{

			return "error";
		
		}

		$stmt -> close();
		$stmt = null;

	}


	/*=============================================
	CONSULTAR PROPUESTAS
	=============================================*/

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

}