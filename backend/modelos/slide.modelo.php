<?php

require_once "conexion.php";

class ModeloSlide{

	#SUBIR LA RUTA DE LA IMAGEN
	#------------------------------------------------------------

	public static function mdlSubirImagenSlide($datos, $datos2, $tabla){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (v_ruta_back, v_ruta_front) VALUES (:v_ruta_back, :v_ruta_front)");

		$stmt -> bindParam(":v_ruta_back", $datos, PDO::PARAM_STR);
		$stmt -> bindParam(":v_ruta_front", $datos2, PDO::PARAM_STR);

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

	public static function mdlMostrarImagenSlide($datos, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT v_ruta_back, v_titulo, v_descripcion FROM $tabla WHERE v_ruta = :ruta");

		$stmt -> bindParam(":ruta", $datos, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

	}

	#MOSTRAR IMAGEN EN LA VISTA
	#---------------------------------------------------------
	public static function mdlMostrarImagenVista($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id_slide, v_ruta_back, v_titulo, v_descripcion, i_orden FROM $tabla ORDER BY i_orden ASC");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

	}

	#ELIMINAR ITEM DEL SLIDE
	#-----------------------------------------------------------

	public static function mdlEliminarSlide($datos, $tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_slide = :id");

		$stmt -> bindParam(":id", $datos["idSlide"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";
		}

		else{

			return "error";
		}

		$stmt->close();

	}

	#ACTUALIZAR ITEM DEL SLIDE
	#-----------------------------------------------------------
	public static function mdlActualizarSlide($datos, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET v_titulo = :titulo, v_descripcion = :descripcion WHERE id_slide = :id");	

		$stmt -> bindParam(":titulo", $datos["enviarTitulo"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion", $datos["enviarDescripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["enviarId"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";
		}

		else{

			return "error";
		}

		$stmt->close();

	}

	#SELECCIONAR ITEM DEL SLIDE
	#-----------------------------------------------------------

	public static function mdlSeleccionarActualizacionSlide($datos, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT v_titulo, v_descripcion FROM $tabla WHERE id_slide = :id");

		$stmt -> bindParam(":id", $datos["enviarId"], PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

	}

	#ACTUALIZAR ORDEN 
	#---------------------------------------------------

	public static function mdlActualizarOrden($datos, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET i_orden = :orden WHERE id_slide = :id");

		$stmt -> bindParam(":orden", $datos["ordenItem"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["ordenSlide"], PDO::PARAM_INT);

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

		$stmt = Conexion::conectar()->prepare("SELECT id_slide, v_ruta_back, v_titulo, v_descripcion FROM $tabla ORDER BY i_orden ASC");

		$stmt -> execute();

		return $stmt->fetchAll();

		$stmt->close();

	}


}