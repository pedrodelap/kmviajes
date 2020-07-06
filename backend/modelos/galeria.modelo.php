<?php

require_once "conexion.php";

class ModeloGaleria{

	#SUBIR LA RUTA DE LA IMAGEN
	#------------------------------------------------------------
	public static function mdlSubirImagenGaleria($datos, $tabla){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (v_ruta) VALUES (:ruta)");

		$stmt -> bindParam(":ruta", $datos, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";
		}
		else{

			return "error";
		}

		$stmt->close();
	}

	#SELECCIONAR LA RUTA DE LA IMAGEN
	#------------------------------------------------------------
	public static function mdlMostrarImagenGaleria($datos, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT v_ruta FROM $tabla WHERE v_ruta = :ruta");

		$stmt -> bindParam(":ruta", $datos, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

	}

	#MOSTRAR IMAGEN EN LA VISTA
	#---------------------------------------------------------
	public static function mdlMostrarImagenVista($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id_galeria, v_ruta FROM $tabla ORDER BY i_orden ASC");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

	}

	#ELIMINAR ITEM DE LA GALERIA
	#-----------------------------------------------------------

	public static function mdlEliminarGaleria($datos, $tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_galeria = :id");

		$stmt -> bindParam(":id", $datos["idGaleria"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";
		}

		else{

			return "error";
		}

		$stmt->close();

	}

	#ACTUALIZAR ORDEN 
	#---------------------------------------------------

	public static function mdlActualizarOrden($datos, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET i_orden = :orden WHERE id_galeria = :id");

		$stmt -> bindParam(":orden", $datos["ordenItem"], PDO::PARAM_INT);
		$stmt -> bindParam(":id", $datos["ordenGaleria"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		}

		else{
			return "error";
		}

		$stmt -> close();

	}

	#SELECCIONAR ORDEN 
	#---------------------------------------------------

	public static function mdlSeleccionarOrden($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id_galeria, v_ruta FROM $tabla ORDER BY i_orden ASC");

		$stmt -> execute();

		return $stmt->fetchAll();

		$stmt->close();

	}


}