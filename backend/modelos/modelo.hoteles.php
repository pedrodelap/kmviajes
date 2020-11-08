<?php

require_once "conexion.php";

class ModeloHoteles{

	#CREAR CLIENTE
	#------------------------------------------------------------
	static public function mdlIngresarCliente($tabla, $datos){

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

	#MOSTRAR CLIENTE
	#------------------------------------------------------------
	static public function mdlMostrarHoteles($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT  hotel.id_hotel,
														   CONCAT(ciudad.nombre,', ',pais.nombre) AS 'pais',
														   hotel.codigo,
														   UPPER(hotel.nombre) AS 'nombre',
														   hotel.calificacion,
														   hotel.telefono
													 FROM  tb_hoteles hotel
											   INNER JOIN  tb_ciudades ciudad
	  												   ON  ciudad.id_ciudad = hotel.id_ciudad
	  										   INNER JOIN  tb_paises pais
													   ON  pais.id_pais = ciudad.id_pais
												 ORDER BY  hotel.nombre");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	#SELECT CLIENTE
	#------------------------------------------------------------
	static public function mdlSelectHoteles($tabla, $valor){

		$term = '%'.$valor.'%';

		$stmt = Conexion::conectar()->prepare("SELECT  hotel.id_hotel,
													   UPPER(CONCAT(hotel.nombre,' - ',ciudad.nombre,', ',pais.nombre)) AS 'hotel'
												 FROM  tb_hoteles hotel
										   INNER JOIN  tb_ciudades ciudad
										           ON  ciudad.id_ciudad = hotel.id_ciudad
										   INNER JOIN  tb_paises pais
										           ON  pais.id_pais = ciudad.id_pais
												WHERE  hotel.nombre LIKE :term
											       OR  ciudad.nombre LIKE :term
												   OR  pais.nombre LIKE :term;");

		$stmt->bindParam(":term",$term, PDO::PARAM_STR);

		$stmt->execute();

		$stat[0] = true;

		$stat[1] = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $stat;

		$stmt -> close();

		$stmt = null;

	}

	#EDITAR CLIENTE
	#------------------------------------------------------------
	static public function mdlEditarHotel($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombres = :nombres, apellidos = :apellidos, tipo_documento = :tipo_documento, numero_documento = :numero_documento, telefono = :telefono, correo = :correo, fecha_nacimiento = :fecha_nacimiento WHERE id_cliente = :id_cliente");

		$stmt->bindParam(":id_cliente", $datos["id"], PDO::PARAM_INT);
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

	#ELIMINAR CLIENTE
	#------------------------------------------------------------
	static public function mdlEliminarHotel($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_cliente = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	#ACTUALIZAR CLIENTE
	#------------------------------------------------------------
	static public function mdlActualizarHotel($tabla, $item1, $valor1, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id_cliente = :id");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id_cliente", $valor, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

}