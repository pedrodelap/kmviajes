<?php

require_once "conexion.php";

class ModeloPaquetes{

	#CREAR PAQUETE
	#------------------------------------------------------------
	static public function mdlCrearPaquetes($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("CALL usp_insert_paquete(:titulo, :id_aerolinea, :descripcion_corta, :descripcion_larga, :id_ciudad, :precio_sol, :precio_dolar, :fecha_inicio, :fecha_fin, :cantidad_adultos, :cantidad_ninios, :fecha_mostrar)");
		
		$stmt->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
		$stmt->bindParam(":id_aerolinea", $datos["id_aerolinea"], PDO::PARAM_INT);
		$stmt->bindParam(":descripcion_corta", $datos["descripcion_corta"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion_larga", $datos["descripcion_larga"], PDO::PARAM_STR);
		$stmt->bindParam(":id_ciudad", $datos["id_ciudad"], PDO::PARAM_INT);
		$stmt->bindParam(":precio_sol", $datos["precio_sol"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_dolar", $datos["precio_dolar"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_inicio", $datos["fecha_inicio"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_fin", $datos["fecha_fin"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad_adultos", $datos["cantidad_adultos"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad_ninios", $datos["cantidad_ninios"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_mostrar", $datos["fecha_mostrar"], PDO::PARAM_STR);

		if($stmt->execute()){

			return $stmt -> fetch();

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	#MOSTRAR PAQUETES
	#------------------------------------------------------------
	static public function mdlMostrarPaquetes($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

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
													 FROM tb_paquetes paquete
											   INNER JOIN tb_aerolineas aerolinea
											           ON ( aerolinea.id_aerolinea = paquete.id_aerolinea)
											   INNER JOIN tb_ciudades ciudad
											           ON ( ciudad.id_ciudad = paquete.id_ciudad)
											   INNER JOIN tb_paises paises
											           ON ( paises.id_pais = ciudad.id_pais)");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	#SELECT PAQUETES
	#------------------------------------------------------------
	static public function mdlSelectPaquetes($tabla, $valor){

		$term = '%'.$valor.'%';

		$stmt = Conexion::conectar()->prepare("SELECT id_paquete, CONCAT('(',codigo,') - ',compania) as 'paquete' FROM tb_paquetes WHERE compania LIKE :term OR codigo LIKE :term ");

		$stmt->bindParam(":term",$term, PDO::PARAM_STR);

		$stmt->execute();

		$stat[0] = true;

		$stat[1] = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $stat;

		$stmt -> close();

		$stmt = null;

	}
	
	#EDITAR PAQUETE
	#------------------------------------------------------------
	static public function mdlEditarPaquete($tabla, $datos){

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

	#ELIMINAR PAQUETE
	#------------------------------------------------------------
	static public function mdlEliminarPaquete($tabla, $datos){

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

	#SELECT PAQUETES
	#------------------------------------------------------------
	static public function mdlSelectCiudades($tabla, $valor){

		$term = '%'.$valor.'%';

		$stmt = Conexion::conectar()->prepare("SELECT  ciudad.id_ciudad 'id_ciudad',
													   CONCAT(ciudad.nombre,' (',aeropuerto.codigo,'), ',pais.nombre) 'nombre_ciudad'
											     FROM  tb_ciudades ciudad
										   INNER JOIN  tb_aeropuertos aeropuerto
										           ON  (aeropuerto.id_ciudad = ciudad.id_ciudad)
										   INNER JOIN  tb_paises pais
										           ON  (pais.id_pais = ciudad.id_pais)
											    WHERE  pais.nombre LIKE :term
												   OR  ciudad.nombre LIKE :term
												   OR  aeropuerto.nombre LIKE :term
												   OR  aeropuerto.codigo LIKE :term");

		$stmt->bindParam(":term",$term, PDO::PARAM_STR);

		$stmt->execute();

		$stat[0] = true;

		$stat[1] = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $stat;

		$stmt -> close();

		$stmt = null;

	}


	#CREAR PAQUETE x CAMPANA
	#------------------------------------------------------------
	static public function mdlCrearPaquetexCampana($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_campania, id_paquete, fecha_inicio, fecha_fin, estado) VALUES (:id_campana, :id_paquete, :fecha_inicio, :fecha_fin, 1)");

		$stmt->bindParam(":id_campana", $datos["id_campana"], PDO::PARAM_STR);
		$stmt->bindParam(":id_paquete", $datos["id_paquete"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_inicio", $datos["fecha_inicio"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_fin", $datos["fecha_fin"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	#CREAR PAQUETE x IMAGES
	#------------------------------------------------------------
	static public function mdlCrearPaquetexImages($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_paquete, id_imagen, ruta_imagen, fecha_registro, estado) VALUES (:id_paquete, :id_imagen, :ruta_imagen, NOW(), 1)");

		$stmt->bindParam(":id_paquete", $datos["id_paquete"], PDO::PARAM_INT);
		$stmt->bindParam(":id_imagen", $datos["id_imagen"], PDO::PARAM_INT);
		$stmt->bindParam(":ruta_imagen", $datos["ruta_imagen"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	#CREAR PAQUETE x SERVICIOS
	#------------------------------------------------------------
	static public function mdlCrearPaquetexServicios($tabla, $id, $valor){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_paquete, id_servicio, estado) VALUES (:id_paquete, :id_servicio, 1)");

		$stmt->bindParam(":id_paquete", $id, PDO::PARAM_INT);
		$stmt->bindParam(":id_servicio", $valor, PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

}