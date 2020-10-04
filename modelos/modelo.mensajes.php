<?php

require_once "backend/modelos/conexion.php";

class MensajesModel{

	#REGISTRO MENSAJES
	#-----------------------------------------------------------
	public static function registroMensajesModel($datos, $tabla){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (v_nombre, v_email, v_asunto, v_mensaje, i_revision, i_estado) VALUES (:v_nombre, :v_email, :v_asunto, :v_mensaje, 0 , 1)");

		$stmt -> bindParam(":v_nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":v_asunto", $datos["asunto"], PDO::PARAM_STR);
		$stmt -> bindParam(":v_email", $datos["email"], PDO::PARAM_STR);
		$stmt -> bindParam(":v_mensaje", $datos["mensaje"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";
		}
		else{

			return "error";
		}

		$stmt->close();

	}

	#REGISTRO SUSCRIPTORES
	#-----------------------------------------------------------
	public static function registroSuscriptoresModel($datos, $tabla){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (v_nombre, v_email, v_telefono, i_revision, i_estado) VALUES (:v_nombre, :v_email, :v_telefono, 0, 1)");

		$stmt -> bindParam(":v_nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":v_email", $datos["email"], PDO::PARAM_STR);
		$stmt -> bindParam(":v_telefono", $datos["telefono"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";
		}
		else{

			return "error";
		}

		$stmt->close();

	}

	#VALIDAR SUSCRIPTOR EXISTENTE
	#-------------------------------------
	public static function revisarSuscriptorModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla WHERE v_email = :v_email");
		
		$stmt->bindParam(":v_email", $datosModel, PDO::PARAM_STR);
		
		$stmt->execute();
		
		return $stmt->fetchAll();
		
		$stmt->close();

	}





	
}