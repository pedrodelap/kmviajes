<?php

require_once "conexion.php";

class ModeloSuscriptores{

	#MOSTRAR Suscriptores EN LA VISTA
	#------------------------------------------------------------
	public static function mdlMostrarSuscriptores($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id_suscriptor, v_nombre, v_email, v_telefono FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

	}

	#BORRAR Suscriptores
	#-----------------------------------------------------
	public static function mdlBorrarSuscriptores($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_suscriptor = :id");

		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}

		else{

			return "error";

		}

		$stmt->close();

	}

	#SELECCIONAR SUSCRIPTORES SIN REVISAR
	#------------------------------------------------------------
	public static function mdlSuscriptoresSinRevisar($tabla){
	
		$stmt = Conexion::conectar()->prepare("SELECT i_revision FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

	}

	#SUSCRIPTORES REVISADOS
	#------------------------------------------------------------
	public static function mdlSuscriptoresRevisados($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET i_revision = :revision");

		$stmt->bindParam(":revision", $datosModel, PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}

		else{

			return "error";

		}

		$stmt->close();

	}

}


