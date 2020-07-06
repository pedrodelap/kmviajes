<?php

require_once "conexion.php";

class PerfilesModel{

	#GUARDAR PERFIL
	#------------------------------------------------------------
	public static function guardarPerfilModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (v_usuario, v_nombre, v_password, v_email, v_foto, v_perfil, i_estado) VALUES (:v_usuario, :v_nombre, :v_password, :v_email, :v_foto, :v_perfil, 1)");

		$stmt -> bindParam(":v_usuario", $datosModel["usuario"], PDO::PARAM_STR);
		$stmt -> bindParam(":v_nombre", $datosModel["nombre"], PDO::PARAM_STR);		
		$stmt -> bindParam(":v_password", $datosModel["password"], PDO::PARAM_STR);
		$stmt -> bindParam(":v_email", $datosModel["email"], PDO::PARAM_STR);
		$stmt -> bindParam(":v_foto", $datosModel["foto"], PDO::PARAM_STR);
		$stmt -> bindParam(":v_perfil", $datosModel["perfil"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";
		}

		else{

			return "error";
		}

		$stmt->close();

	}

	#VISUALIZAR PERFILES
	#------------------------------------------------------
	public static function verPerfilesModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id_usuario, nombres, apellidos, usuario, PASSWORD, perfil, fecha, tipo_documento, numero_documento, telefono, correo, foto, ultimo_login, estado FROM tb_usuarios WHERE usuario NOT IN ('admin')");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

	}

	#ACTUALIZAR PERFIL
	#---------------------------------------------------
	public static function editarPerfilModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET usuario = :usuario, nombre = :nombre, password = :password, correo = :correo, foto = :foto, perfil = :perfil WHERE id_usuario = :id_usuario");

		$stmt -> bindParam(":id_usuario", $datosModel["id"], PDO::PARAM_INT);
		$stmt -> bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
		$stmt -> bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
		$stmt -> bindParam(":correo", $datosModel["correo"], PDO::PARAM_STR);
		$stmt -> bindParam(":foto", $datosModel["foto"], PDO::PARAM_STR);
		$stmt -> bindParam(":perfil", $datosModel["perfil"], PDO::PARAM_STR);
		

		if($stmt->execute()){

			return "ok";
		}

		else{

			return "error";
		}

		$stmt->close();

	}

	#BORRAR PERFIL
	#-----------------------------------------------------
	public static function borrarPerfilModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_usuario = :id");

		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}

		else{

			return "error";

		}

		$stmt->close();

	}


}