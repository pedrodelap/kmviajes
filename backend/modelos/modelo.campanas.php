<?php

require_once "conexion.php";

class ModeloCampanas{

	#CREAR CAMPAÑA
	#------------------------------------------------------------
	static public function mdlIngresarCampana($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre, descripcion_corta, descripcion_larga,flag_nuevo, flag_oferta, fecha_creacion, estado) VALUES (:nombre, :descripcion_corta, :descripcion_larga, :flag_nuevo, :flag_oferta, NOW(), 1 );");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion_corta", $datos["descripcion_corta"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion_larga", $datos["descripcion_larga"], PDO::PARAM_STR);
		$stmt->bindParam(":flag_nuevo", $datos["flag_nuevo"], PDO::PARAM_STR);
		$stmt->bindParam(":flag_oferta", $datos["flag_oferta"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	#MOSTRAR CAMPAÑA
	#------------------------------------------------------------
	static public function mdlMostrarCampanas($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY descripcion_larga DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	#EDITAR CAMPAÑA
	#------------------------------------------------------------
	static public function mdlEditarCampana($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombres = :nombres, apellidos = :apellidos, tipo_documento = :tipo_documento, numero_documento = :numero_documento, telefono = :telefono, correo = :correo, fecha_nacimiento = :fecha_nacimiento WHERE id_campana = :id_campana");

		$stmt->bindParam(":id_campania", $datos["id"], PDO::PARAM_INT);
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

	#ELIMINAR CAMPAÑA
	#------------------------------------------------------------
	static public function mdlEliminarCampana($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_campania = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	#ACTUALIZAR CAMPAÑA
	#------------------------------------------------------------
	static public function mdlActualizarCampana($tabla, $item1, $valor1, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id_campania = :id");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id_campana", $valor, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	#MAXIMO ID CAMPAÑA
	#------------------------------------------------------------
	static public function mdlMaxIdCampana($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT MAX(id_campania) AS id FROM $tabla");

		if($stmt->execute()){

			$result = $stmt->fetchColumn();

			return $result;

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	#REGISTRAR IMAGENES CAMPAÑA 
	#------------------------------------------------------------
	static public function mdlImagenesCampana($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET foto_corta = :foto_corta, foto_larga = :foto_larga WHERE id_campania = :id_campania;");

		$stmt->bindParam(":id_campania", $datos["id_campana"], PDO::PARAM_STR);
		$stmt->bindParam(":foto_corta", $datos["foto_corta"], PDO::PARAM_STR);
		$stmt->bindParam(":foto_larga", $datos["foto_larga"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	#SELECT CAMPAÑAS
	#------------------------------------------------------------
	static public function mdlSelectCampanas($tabla, $valor){

		$term = '%'.$valor.'%';

		$stmt = Conexion::conectar()->prepare("SELECT campenias.id_campania,
													  campenias.nombre 
												 FROM tb_campenias campenias
												WHERE campenias.nombre LIKE :term
												   OR campenias.descripcion_corta LIKE :term");

		$stmt->bindParam(":term",$term, PDO::PARAM_STR);

		$stmt->execute();

		$stat[0] = true;

		$stat[1] = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $stat;

		$stmt -> close();

		$stmt = null;

	}


}