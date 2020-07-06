<?php

require_once "conexion.php";

class ModeloItinerarios{

	/*=============================================
	CREAR ITINERARIO
	=============================================*/

	static public function mdlCrearItinerario($tabla, $datos){

		$resultado = "error";

		foreach ($datos as $dato) {
		
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_propuesta, aeropuerto_origen, aeropuerto_destino, fecha_viaje, usuario_creacion, fecha_creacion, usuario_modificacio, fecha_modificacion, estado) VALUES (:id_propuesta, :aeropuerto_origen, :aeropuerto_destino, :fecha_viaje, :usuario_creacion, NOW(), :usuario_modificacio, NOW(), 1)");

			$stmt->bindParam(":id_propuesta", $dato["idPropuesta"], PDO::PARAM_INT);
			$stmt->bindParam(":aeropuerto_origen", $dato["origen"], PDO::PARAM_INT);
			$stmt->bindParam(":aeropuerto_destino", $dato["destino"], PDO::PARAM_INT);
			$stmt->bindParam(":fecha_viaje", $dato["fecha"], PDO::PARAM_STR);
			$stmt->bindParam(":usuario_creacion", $dato["usuarioCreacion"], PDO::PARAM_STR);
			$stmt->bindParam(":usuario_modificacio", $dato["usuarioCreacion"], PDO::PARAM_STR);

			if($stmt->execute()){

				$resultado = "ok";

			}

		}

		return $resultado;

		$stmt->close();
		
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