<?php

require_once "conexion.php";

class ModeloCotizaciones{

	#CREAR COTIZACION
	#------------------------------------------------------------
	static public function mdlCrearCotizacion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("CALL usp_insert_cotizacion(:id_cliente, :id_solicitud, :usuario_creacion);");
		
		$stmt->bindParam(":id_cliente", $datos["idCliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_solicitud", $datos["id_solicitud"], PDO::PARAM_INT);
		$stmt->bindParam(":usuario_creacion", $datos["usuario_creacion"], PDO::PARAM_STR);

		if($stmt->execute()){

			return $stmt -> fetch();

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

	#MOSTRAR COTIZACION
	#------------------------------------------------------------
	static public function mdlMostrarCotizaciones($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT cotizaciones.id_cotizacion,
												          CONCAT(clientes.nombres,' ',clientes.apellidos) AS cliente,
												    	  cotizaciones.usuario_modificacion,
												   		  cotizaciones.fecha_modificacion,
												   		  cotizaciones.venta,
												          cotizaciones.estado
											         FROM tb_cotizaciones cotizaciones
	                                           INNER JOIN tb_clientes clientes
		                                               ON ( cotizaciones.id_cliente = clientes.id_cliente)
	                                             ORDER BY cotizaciones.fecha_modificacion ASC;");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

}