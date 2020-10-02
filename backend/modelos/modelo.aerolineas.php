<?php

require_once "conexion.php";

class ModeloAerolineas{

	#CREAR AEROLINEA
	#------------------------------------------------------------
	static public function mdlIngresarAerolinea($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, url, compania, direccion, telefono, telefono_carga, tipo) VALUES (:codigo, :url, :compania, :direccion, :telefono, :telefono_carga, :tipo )");

        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
        $stmt->bindParam(":url", $datos["url"], PDO::PARAM_STR);
		$stmt->bindParam(":compania", $datos["compania"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono_carga", $datos["telefono_carga"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	#MOSTRAR AEROLINEAS
	#------------------------------------------------------------
	static public function mdlMostrarAerolineas($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id_aerolinea DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	#SELECT AEROLINEAS
	#------------------------------------------------------------
	static public function mdlSelectAerolineas($tabla, $valor){

		$term = '%'.$valor.'%';

		$stmt = Conexion::conectar()->prepare("SELECT id_aerolinea, CONCAT('(',codigo,') - ',compania) as 'aerolinea' FROM tb_aerolineas WHERE compania LIKE :term OR codigo LIKE :term ");

		$stmt->bindParam(":term",$term, PDO::PARAM_STR);

		$stmt->execute();

		$stat[0] = true;

		$stat[1] = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $stat;

		$stmt -> close();

		$stmt = null;

	}
	
	#EDITAR AEROLINEA
	#------------------------------------------------------------
	static public function mdlEditarAerolinea($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET codigo = :codigo, url = :url, compania = :compania, direccion = :direccion, telefono = :telefono, telefono_carga = :telefono_carga, tipo = :tipo WHERE id_aerolinea = :id_aerolinea");

		$stmt->bindParam(":id_aerolinea", $datos["id"], PDO::PARAM_INT);
        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
        $stmt->bindParam(":url", $datos["url"], PDO::PARAM_STR);
		$stmt->bindParam(":compania", $datos["compania"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono_carga", $datos["telefono_carga"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}

	#ELIMINAR AEROLINEA
	#------------------------------------------------------------
	static public function mdlEliminarAerolinea($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_aerolinea = :id");

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