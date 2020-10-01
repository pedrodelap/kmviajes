<?php

require_once "conexion.php";

class ModeloSolicitudes{

	#CREAR SOLICITUDES
	#------------------------------------------------------------
	static public function mdlIngresarSolicitude($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombres, apellidos, tipo_documento, numero_documento, correo, telefono, fecha_nacimiento, fecha_creacion, estado) VALUES (:nombres, :apellidos, :tipo_documento, :numero_documento, :correo, :telefono, :fecha_nacimiento, NOW(), 1)");

		$stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
		$stmt->bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_documento", $datos["tipo_documento"], PDO::PARAM_STR);
		$stmt->bindParam(":numero_documento", $datos["numero_documento"], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	#MOSTRAR SOLICITUDES
	#------------------------------------------------------------
	static public function mdlMostrarSolicitudes($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("CALL usp_listar_solicitudes()");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	#MOSTRAR PAQUETE DE SOLICITUD
	#------------------------------------------------------------
	static public function MostrarPaqueteDeSolicitud($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT paquete.id_paquete,
														paquete.titulo,
														paquete.id_ciudad,
														CONCAT(ciudad.nombre,' - ',paises.nombre) AS ciudad_pais,
														paquete.id_aerolinea,
														aerolinea.compania AS aerolinea_nombre,
														paquete.descripcion_corta,
														paquete.descripcion_larga,
														paquete.precio_sol,
														paquete.precio_dolar,
														paquete.fecha_inicio,
														paquete.fecha_fin,
														paquete.cantidad_adultos,
														paquete.cantidad_ninios,
														paquete.foto_corta,
														paquete.foto_larga,
														paquete.flag,
														paquete.fecha_mostrar
												  FROM  $tabla paquete
											INNER JOIN  tb_aerolineas aerolinea
													ON  ( aerolinea.id_aerolinea = paquete.id_aerolinea)
											INNER JOIN  tb_ciudades ciudad
													ON  ( ciudad.id_ciudad = paquete.id_ciudad)
											INNER JOIN  tb_paises paises
													ON  ( paises.id_pais = ciudad.id_pais)
												 WHERE  paquete.$item = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

		if($stmt -> execute()){

			return $stmt -> fetch();

		}else{

			return 'error';

		}

		$stmt -> close();

		$stmt = null;

	}


	#EDITAR SOLICITUDES
	#------------------------------------------------------------
	static public function mdlEditarSolicitud($tabla, $datos){
	}

	#ELIMINAR SOLICITUDES
	#------------------------------------------------------------
	static public function mdlSolicitud($tabla, $datos){
	}

	#ACTUALIZAR SOLICITUDES
	#------------------------------------------------------------
	static public function mdlActualizarSolicitud($tabla, $item1, $valor1, $valor){
	}


	#SOLICITUDES REVISADOS
	#------------------------------------------------------------
	public static function mdlSolicitudesRevisadas($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET revision = :revision");

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