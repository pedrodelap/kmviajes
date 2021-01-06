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


	static public function mdlEstadoRegistradaACotizada($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_solicitud, estado_solicitud, fecha_solicitud) VALUES (:id_solicitud, :estado_solicitud, NOW());");

		$stmt->bindParam(":id_solicitud", $datos["id_solicitud"], PDO::PARAM_INT);
		$stmt->bindParam(":estado_solicitud", $datos["estado_solicitud"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

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

	#MOSTRAR CLIENTE
	#------------------------------------------------------------
	static public function mdlConsultrarIdCotizacion($tabla, $valor, $item){

		$stmt = Conexion::conectar()->prepare("SELECT id_cotizacion FROM $tabla WHERE $item = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	#MOSTRAR Paquetes por monto
	#------------------------------------------------------------

	static public function mdlConsultarCotizacionSeguimiento(){
		$stmt = Conexion::conectar()->prepare("SELECT 
												p.id_paquete,
												ip.ruta_imagen,
												p.titulo, 
												ifnull(c.nombre,'') as campania,
												c.nombre as ciudad,
												sum(s.numero_adultos + ifnull(s.numero_ninios,0)) as num_paquete,
												sum(s.numero_adultos * p.precio_dolar) + sum(ifnull(s.numero_ninios,0) * ifnull(p.precio_dolar_ninio,0)) monto,
												p.fecha_inicio,
												p.fecha_fin,
												p.fecha_mostrar,
												p.cantidad_adultos,
												p.cantidad_ninios,
												p.hora_vuelo_ida,
												p.hora_vuelo_regreso,
												ifnull(sci.id_seguimiento_checkin,'-') as id_seguimiento_checkin,
												ifnull(sco.id_seguimiento_checkout,'-') as id_seguimiento_checkout
												FROM tb_solicitud s
												INNER JOIN tb_venta v on s.id_solicitud = v.id_solicitud
												LEFT JOIN tb_paquetes p on p.id_paquete = s.id_paquete
												INNER JOIN (SELECT ip.`id_paquete` ,MAX(ip.`ruta_imagen`) AS ruta_imagen FROM tb_imagenes_paquete ip GROUP BY ip.`id_paquete`) ip
																								ON p.id_paquete = ip.id_paquete
												INNER JOIN tb_ciudades c on p.id_ciudad = c.id_ciudad
												INNER JOIN tb_campanias_x_paquetes cp on cp.id_paquete = p.id_paquete
												INNER JOIN tb_campenias  cc on cc.id_campania = cp.id_campania
												LEFT JOIN tb_seguimiento_checkin sci on sci.id_paquete = p.id_paquete
												LEFT JOIN tb_seguimiento_checkout sco on sco.id_paquete = p.id_paquete
												group by p.id_paquete,ruta_imagen,p.titulo,campania,ciudad,sci.id_seguimiento_checkin,sco.id_seguimiento_checkout,p.hora_vuelo_ida,p.hora_vuelo_regreso");

		
			$stmt -> execute();

			return $stmt -> fetchAll();

			$stmt -> close();

			$stmt = null;
	}
}