<?php

require_once "conexion.php";

class ModeloMensajes{

	#MOSTRAR MENSAJES EN LA VISTA
	#------------------------------------------------------------
	public static function mdlMostrarMensajes($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id_mensajes, v_nombre, v_email, v_mensaje, v_fecha_registro FROM $tabla ORDER BY v_fecha_registro DESC"); 

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();
	}

	#BORRAR MENSAJES
	#-----------------------------------------------------
	public static function mdlBorrarMensajes($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_mensajes = :id");

		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}

		else{

			return "error";

		}

		$stmt->close();

	}

	#ENVIAR EMAIL MASIVOS
	#-------------------------------------------------
	public static function seleccionarEmailSuscriptores($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT v_nombre, v_email FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

	}

	#SELECCIONAR MENSAJES SIN REVISAR
	#------------------------------------------------------------
	public static function mdlMensajesSinRevisar($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT i_revision FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

	}

	#MENSAJES REVISADOS
	#------------------------------------------------------------
	public static function mdlMensajesRevisados($datosModel, $tabla){

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