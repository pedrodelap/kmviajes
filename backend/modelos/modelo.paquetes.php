<?php

require_once "conexion.php";

class ModeloPaquetes{

	#CREAR PAQUETE
	#------------------------------------------------------------
	static public function mdlCrearPaquetes($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("CALL usp_insert_paquete(:titulo, :id_aerolinea, :descripcion_corta, :descripcion_larga, :detalle, :id_ciudad, :id_hotel, :precio_sol, :precio_dolar, :fecha_inicio, :fecha_fin, :cantidad_adultos, :cantidad_ninios, :fecha_mostrar, :precio_soles_ninios, :precio_dolares_ninios, :hora, :hora_llegada, :cantidad_dias, :cantidad_noches);");
		
		$stmt->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
		$stmt->bindParam(":id_aerolinea", $datos["id_aerolinea"], PDO::PARAM_INT);
		$stmt->bindParam(":descripcion_corta", $datos["descripcion_corta"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion_larga", $datos["descripcion_larga"], PDO::PARAM_STR);
		$stmt->bindParam(":detalle", $datos["detalle"], PDO::PARAM_STR);
		$stmt->bindParam(":id_ciudad", $datos["id_ciudad"], PDO::PARAM_INT);
		$stmt->bindParam(":id_hotel", $datos["id_hotel"], PDO::PARAM_INT);
		$stmt->bindParam(":precio_sol", $datos["precio_sol"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_dolar", $datos["precio_dolar"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_inicio", $datos["fecha_inicio"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_fin", $datos["fecha_fin"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad_adultos", $datos["cantidad_adultos"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad_ninios", $datos["cantidad_ninios"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_mostrar", $datos["fecha_mostrar"], PDO::PARAM_STR);

		$stmt->bindParam(":precio_soles_ninios", $datos["precio_soles_ninios"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_dolares_ninios", $datos["precio_dolares_ninios"], PDO::PARAM_STR);
		$stmt->bindParam(":hora", $datos["hora"], PDO::PARAM_STR);
		$stmt->bindParam(":hora_llegada", $datos["hora_llegada"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad_dias", $datos["cantidad_dias"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad_noches", $datos["cantidad_noches"], PDO::PARAM_STR);

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

	#CONSULTAR PAQUETE PARA COTIZACION PDF	
	#-----------------------------------------------------
	static public function mdlObtenetPaqueteByIdSolicitud($id){

		$stmt = Conexion::conectar()->prepare(  "SELECT p.id_paquete,
														p.titulo,
														p.descripcion_corta,
														p.descripcion_larga,
														p.precio_dolar,
														p.precio_sol,
														p.fecha_inicio,
														p.fecha_fin,
														p.cantidad_adultos,
														p.cantidad_ninios,
														p.foto_larga,
														p.flag,
														p.fecha_mostrar,
														c.nombre as 'nombreCampania',
														ci.nombre as 'nombreCiudad',
														h.nombre  as 'nombreHotel',
														cp.id_campania,
														a.compania,
														p.detalle,
														p.informacion_hotel,
														p.informacion_traslados,
														p.consideraciones,
														s.codigo_seguimiento,
														s.numero_adultos,
														s.numero_ninios,
														cli.nombres,
														cli.apellidos,
														cli.numero_documento
												   from tb_campanias_x_paquetes cp
                                             inner join tb_paquetes p on cp. id_paquete = p.id_paquete
											 inner join tb_solicitud s on s.id_paquete = p.id_paquete
											 inner join tb_clientes cli on cli.id_cliente = s.id_cliente	   
                                             inner join tb_campenias c on cp.id_campania = c.id_campania
                                             inner join tb_ciudades ci on p.id_ciudad = ci.id_ciudad
                                             left join tb_hoteles h on p.id_hotel = h.id_hotel
                                             left join tb_aerolineas a on a.id_aerolinea = p.id_aerolinea
												 WHERE s.id_solicitud =:id");
												 
		$stmt -> bindParam(":id", $id, PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

        $stmt = null;

    }

	#MOSTRAR Clientes del Paquete
	#------------------------------------------------------------

	static public function mdlObtenerClientesDelPaquete($idPaquete){
		$stmt = Conexion::conectar()->prepare("SELECT 
												p.nombres,
												p.apellidos,
												p.id_pasajero,
												p.tipo_doc,
												p.nro_doc,
												s.id_solicitud
												FROM tb_pasajero p 
												INNER JOIN tb_venta v on p.id_venta = p.id_venta
												INNER JOIN tb_solicitud s on s.id_solicitud = v.id_solicitud
												INNER JOIN tb_paquetes pa on pa.id_paquete = s.id_paquete
												WHERE pa.id_paquete = :idPaquete");
		
		$stmt->bindParam(":idPaquete", $idPaquete, PDO::PARAM_INT);
		
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	}


	#MOSTRAR Servicios por paquete
	#------------------------------------------------------------
	static public function mdlListarServiciosPorPaquete($idPaquete){
       
        $stmt = Conexion::conectar()->prepare("SELECT s.nombre, s.icono, s.descripcion,s.calificable,s.id_servicio from tb_servicios_x_paquetes sp
                                              join  tb_servicios s on s.id_servicio = sp.id_servicio
                                               WHERE sp.id_paquete =:idPaquete");
        $stmt -> bindParam(":idPaquete", $idPaquete, PDO::PARAM_INT);
        $stmt -> execute();
        return $stmt -> fetchAll();
        $stmt -> close();
        $stmt = null;
    }
}