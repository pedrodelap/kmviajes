<?php

require_once "conexion.php";

class ModeloAeropuertos{

	#MOSTRAR AEROPUERTOS
	#------------------------------------------------------------
	static public function mdlMostrarAeropuertos($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id_aeropuerto DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	#SELECT AEROPUERTOS
	#------------------------------------------------------------
	static public function mdlSelectAeropuertos($tabla, $valor){

		$term = '%'.$valor.'%';

		$stmt = Conexion::conectar()->prepare("SELECT aeropuerto.id_aeropuerto 'id_aeropuerto',
		                                              CONCAT(ciudad.nombre,' (',aeropuerto.codigo,'), ',aeropuerto.nombre,'(',aeropuerto.codigo,'), ',pais.nombre) 'nombre_aeropuerto'
   												 FROM tb_aeropuertos aeropuerto
                                           INNER JOIN tb_ciudades ciudad
	 											   ON (aeropuerto.id_ciudad = ciudad.id_ciudad)
										   INNER JOIN tb_paises pais
	                                               ON (pais.id_pais = ciudad.id_pais)
											    WHERE pais.nombre LIKE :term
												   OR ciudad.nombre LIKE :term
												   OR aeropuerto.nombre LIKE :term
												   OR aeropuerto.codigo LIKE :term ");

		$stmt->bindParam(":term",$term, PDO::PARAM_STR);

		$stmt->execute();

		$stat[0] = true;

		$stat[1] = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $stat;

		$stmt -> close();

		$stmt = null;

	}

	#SELECT AEROPUERTOSxID
	#------------------------------------------------------------
	static public function mdlSelectAeropuertosPorId($tabla, $valor){

		$term = '%'.$valor.'%';

		$stmt = Conexion::conectar()->prepare("SELECT aeropuerto.id_aeropuerto 'id_aeropuerto',
		                                              CONCAT(ciudad.nombre,' (',aeropuerto.codigo,'), ',aeropuerto.nombre,'(',aeropuerto.codigo,'), ',pais.nombre) 'nombre_aeropuerto'
   												 FROM tb_aeropuertos aeropuerto
                                           INNER JOIN tb_ciudades ciudad
	 											   ON (aeropuerto.id_ciudad = ciudad.id_ciudad)
										   INNER JOIN tb_paises pais
	                                               ON (pais.id_pais = ciudad.id_pais)
											    WHERE aeropuerto.codigo = :term ");

		$stmt->bindParam(":term",$term, PDO::PARAM_STR);

		$stmt->execute();

		$stat[0] = true;

		$stat[1] = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $stat;

		$stmt -> close();

		$stmt = null;

	}

	#ELIMINAR AEROPUERTO
	#------------------------------------------------------------
	static public function mdlEliminarAeropuerto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_aeropuerto = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

}