<?php

require_once "conexion.php";

class ModeloMonedas{


	/*=============================================
	CREAR MONEDA
	=============================================*/

	static public function mdlIngresarMoneda($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, simbolo, compra, venta, fecha_creacion, estado) VALUES (:nombre, :simbolo, :compra, :venta, NOW(), 1)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":simbolo", $datos["simbolo"], PDO::PARAM_STR);
		$stmt->bindParam(":compra", $datos["compra"], PDO::PARAM_STR);
		$stmt->bindParam(":venta", $datos["venta"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR MONEDAS
	=============================================*/

	static public function mdlMostrarMonedas($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id_moneda DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	
	/*=============================================
	EDITAR MONEDA
	=============================================*/

	static public function mdlEditarMoneda($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, simbolo = :simbolo, compra = :compra, venta = :venta WHERE id_moneda = :id_moneda");

		$stmt->bindParam(":id_moneda", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":simbolo", $datos["simbolo"], PDO::PARAM_STR);
		$stmt->bindParam(":compra", $datos["compra"], PDO::PARAM_STR);
		$stmt->bindParam(":venta", $datos["venta"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ELIMINAR MONEDA
	=============================================*/

	static public function mdlEliminarMoneda($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_moneda = :id");

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