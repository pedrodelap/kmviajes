<?php

class ModeloPaqueteFront{
    
    static public function mdlObtenetPaqueteById($id){

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
														h.aparcamiento,
														h.internet_wifi,
														h.piscina,
														h.aire_acondicionado,		
														h.lavanderia,
														h.spa,
														h.gimnasio,
														h.restaurante,
														h.bar,
														h.mascotas				
												   from tb_campanias_x_paquetes cp
                                             inner join tb_paquetes p on cp. id_paquete = p.id_paquete
                                             inner join tb_campenias c on cp.id_campania = c.id_campania
                                             inner join tb_ciudades ci on p.id_ciudad = ci.id_ciudad
                                             left join tb_hoteles h on p.id_hotel = h.id_hotel
                                             left join tb_aerolineas a on a.id_aerolinea = p.id_aerolinea
												 WHERE p.id_paquete =:id");
												 
		$stmt -> bindParam(":id", $id, PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

        $stmt = null;

    }

    static public function mdlListarTodosPaquetesDisponibles($filter){

		$term = '%'.$filter.'%';

		$stmt = Conexion::conectar()->prepare("SELECT p.id_paquete,
                      								  p.titulo,
													  p.descripcion_corta,
													  p.precio_dolar,
													  p.precio_sol,
													  p.foto_corta,
													  p.flag,
													  ip.`ruta_imagen`
												 FROM tb_campanias_x_paquetes cp 
										   INNER JOIN tb_paquetes p 
										           ON cp. id_paquete = p.id_paquete 
										   INNER JOIN tb_ciudades ci 
										           ON p.id_ciudad = ci.id_ciudad 
										   INNER JOIN (SELECT ip.`id_paquete` ,MAX(ip.`ruta_imagen`) AS ruta_imagen FROM tb_imagenes_paquete ip GROUP BY ip.`id_paquete`) ip
										           ON p.id_paquete = ip.id_paquete
												WHERE p.titulo LIKE :term OR ci.nombre LIKE :term
											 ORDER BY p.titulo");
											 
		$stmt -> bindParam(":term", $term, PDO::PARAM_STR);
		
		$stmt -> execute();
		
		return $stmt -> fetchAll();
		
		$stmt -> close();
		
        $stmt = null;
  
    }

    static public function mdlListarServiciosPorPaquete($id){
       
        $stmt = Conexion::conectar()->prepare("SELECT s.nombre, s.icono, s.descripcion,s.calificable from tb_servicios_x_paquetes sp
                                              join  tb_servicios s on s.id_servicio = sp.id_servicio
                                               WHERE sp.id_paquete =:id");
        $stmt -> bindParam(":id", $id, PDO::PARAM_INT);
        $stmt -> execute();
        return $stmt -> fetchAll();
        $stmt -> close();
        $stmt = null;
    }

    static public function mdlListarCiudad(){
       
      $stmt = Conexion::conectar()->prepare("SELECT id_ciudad,nombre from tb_ciudades");
      $stmt -> execute();
      return $stmt -> fetchAll();
      $stmt -> close();
      $stmt = null;
    }

    static public function mdlListarFotosPorPaquete($id){
      $stmt = Conexion::conectar()->prepare("SELECT ruta_imagen from tb_imagenes_paquete ip
                                             WHERE ip.id_paquete =:id");
      $stmt -> bindParam(":id", $id, PDO::PARAM_INT);
      $stmt -> execute();
      return $stmt -> fetchAll();
      $stmt -> close();
      $stmt = null;
   	}

    static public function mdlListarPaquetePorCampania($id_campania){

      $stmt = Conexion::conectar()->prepare("SELECT p.id_paquete,
                                                	p.titulo,
                                                	p.precio_dolar,
                                                	p.precio_sol,
													ip.ruta_imagen
											   FROM tb_campanias_x_paquetes cp 
                                         INNER JOIN tb_paquetes p 
                                                 ON cp. id_paquete = p.id_paquete 
                                         INNER JOIN (SELECT ip.id_paquete ,MAX(ip.ruta_imagen) AS ruta_imagen
                                               FROM tb_imagenes_paquete ip
                                           GROUP BY ip.id_paquete) ip
                                                 ON p.id_paquete = ip.id_paquete        
											  WHERE cp.id_campania =:id_campania");

		$stmt -> bindParam(":id_campania", $id_campania, PDO::PARAM_INT);
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;

	}
	
	#CREAR CLIENTE
	#------------------------------------------------------------
	static public function mdlCrearClienteSolicitudPersonalizada($datosCliente){

		$stmt = Conexion::conectar()->prepare("CALL usp_insert_cliente(:nombres, :apellidos, :numero_documento, :telefono, :correo);");

		$stmt->bindParam(":nombres", $datosCliente["nombres"], PDO::PARAM_STR);
		$stmt->bindParam(":apellidos", $datosCliente["apellidos"], PDO::PARAM_STR);
		$stmt->bindParam(":numero_documento", $datosCliente["numero_documento"], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datosCliente["correo"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datosCliente["telefono"], PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

        $stmt = null;

	}

	#CREAR CLIENTE
	#------------------------------------------------------------
	static public function mdlCrearSolicitudPersonalizada($datosSolicitud){

		#echo "<script>".var_dump($datosSolicitud)."</script>";

		$stmt = Conexion::conectar()->prepare("CALL usp_insert_solicitud(:id_paquete, :id_ciudad, :fecha_inicio, :fecha_fin, :fecha, :cantidad_ninios, :cantidad_adultos, :comentario, :id_cliente);");

		$stmt->bindParam(":id_paquete", $datosSolicitud["id_paquete"], PDO::PARAM_STR);
		$stmt->bindParam(":id_ciudad", $datosSolicitud["id_ciudad"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_inicio", $datosSolicitud["fecha_inicio"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_fin", $datosSolicitud["fecha_fin"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datosSolicitud["fecha"], PDO::PARAM_STR);		
		$stmt->bindParam(":cantidad_adultos", $datosSolicitud["cantidad_adultos"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad_ninios", $datos["cantidad_ninios"], PDO::PARAM_STR);
		$stmt->bindParam(":comentario", $datosSolicitud["comentario"], PDO::PARAM_STR);
		$stmt->bindParam(":id_cliente", $datosSolicitud["id_cliente"], PDO::PARAM_STR);

		if($stmt->execute()){

			return $stmt -> fetch();

		}else{

			return "error";
		
		}

		$stmt->close();

		$stmt = null;

	}

	#CONSULTAR SOLICITUD POR SEGUIMIENTO
	#------------------------------------------------------------
	static public function mdlObtenetPaqueteByCodigoSeguimiento($codigoSeguimiento){

		$stmt = Conexion::conectar()->prepare("SELECT 
													ifnull(s.fecha_inicio,p.fecha_inicio) as fecha_inicio,
													ifnull(s.fecha_fin,p.fecha_fin) as fecha_fin,
												(CASE
														WHEN s.id_ciudad is null THEN c2.nombre
														else c.nombre
													end ) as ciudad,
												CONCAT( ifnull(s.numero_adultos, 0) , ' Adultos - ', ifnull(s.numero_ninios, 0) , ' Niños') as 'pasajeros',
												ifnull(p.descripcion_corta,'-') as descripcion_corta,
												ifnull(p.titulo,'Solicitud personalizada') as titulo,
												p.precio_dolar,
												p.precio_sol,
												p.fecha_mostrar,
												cc.correo,
												cc.nombres,
												cc.apellidos,
												cc.telefono,
												cc.id_cliente,
												cc.numero_documento,
												s.id_solicitud,
												p.id_paquete,
												h.id_hotel,
												h.nombre as nombre_hotel,
												a.compania,
												h.calificacion,
												ifnull(s.numero_adultos, 0) as pasajeros,
												ifnull(s.numero_ninios, 0)  as ninos
												from tb_solicitud s 
												inner join tb_clientes cc on cc.id_cliente = s.id_cliente
												left join tb_paquetes p on s.id_paquete = p.id_paquete
												left join tb_ciudades c on s.id_ciudad=c.id_ciudad
												left join tb_ciudades c2 on p.id_ciudad=c2.id_ciudad
												left join tb_aerolineas a on a.id_aerolinea = p.id_aerolinea
												inner join tb_hoteles h on h.id_hotel = p.id_hotel
												WHERE s.codigo_seguimiento =:codigoSeguimiento");
												 
		$stmt -> bindParam(":codigoSeguimiento", $codigoSeguimiento, PDO::PARAM_STR);
		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

        $stmt = null;

	}
	
	#CONSULTAR HISTORICO DE SEGUIMIENTO
	#------------------------------------------------------------
	static public function mdlObtenerHistoricoSeguimiento($codigoSeguimiento){

		$stmt = Conexion::conectar()->prepare("SELECT
												sh.id_solicitud_historial as id_solicitud_historial,
                                               
                                                sh.estado_solicitud as estado_solicitud,
                                                sh.fecha_solicitud as fecha_solicitud
												from tb_solicitud s 
												inner join tb_solicitudes_historial sh on sh.id_solicitud = s.id_solicitud
												WHERE s.codigo_seguimiento =:codigoSeguimiento");
												 
		$stmt -> bindParam(":codigoSeguimiento", $codigoSeguimiento, PDO::PARAM_STR);
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

        $stmt = null;

	}
	
	#CONSULTAR HISTORICO DE SEGUIMIENTO
	#------------------------------------------------------------
	static public function mdlObtenerHistoricoSeguimiento2($codigoSeguimiento){

		$stmt = Conexion::conectar()->prepare("SELECT
												sh.id_solicitud_historial as id_solicitud_historial,
                                               
                                                sh.estado_solicitud as estado_solicitud,
                                                sh.fecha_solicitud as fecha_solicitud
												from tb_solicitud s 
												inner join tb_solicitudes_historial sh on sh.id_solicitud = s.id_solicitud
												WHERE s.codigo_seguimiento =:codigoSeguimiento and sh.estado_solicitud <>'Aceptada'");
												 
		$stmt -> bindParam(":codigoSeguimiento", $codigoSeguimiento, PDO::PARAM_STR);
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

        $stmt = null;

    }

		#SELECT AEROPUERTOS
	#------------------------------------------------------------
	static public function mdlSelectCiudades($valor){

		$term = '%'.$valor.'%';

		$stmt = Conexion::conectar()->prepare("SELECT ciudad.id_pais 'id',
		                                              CONCAT(ciudad.nombre,' (',aeropuerto.codigo,'), ',aeropuerto.nombre,'(',aeropuerto.codigo,'), ',pais.nombre) 'name'
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
	#CREAR VENTA
	#------------------------------------------------------------
	static public function mdlCrearVenta($datosVenta){

		$stmt = Conexion::conectar()->prepare("CALL usp_insert_venta(:pId_solicitud, :pNroOperacion, :pRuc, :pRazon);");

		$stmt->bindParam(":pId_solicitud", $datosVenta["solicitud"], PDO::PARAM_INT);
		$stmt->bindParam(":pNroOperacion", $datosVenta["operacion"], PDO::PARAM_STR);
		$stmt->bindParam(":pRuc", $datosVenta["ruc"], PDO::PARAM_STR);
		$stmt->bindParam(":pRazon", $datosVenta["razon_social"], PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

        $stmt = null;

	}

	#CREAR PASAJERO
	#------------------------------------------------------------
	static public function mdlCrearPasajero($datosPasajero){

		$stmt = Conexion::conectar()->prepare("CALL usp_insert_pasajero(:pId_venta, :pNombres, :pApellidos, :pTipoDoc, :pNroDoc);");

		$stmt->bindParam(":pId_venta", $datosPasajero["venta"], PDO::PARAM_INT);
		$stmt->bindParam(":pNombres", $datosPasajero["nombres"], PDO::PARAM_STR);
		$stmt->bindParam(":pApellidos", $datosPasajero["apellidos"], PDO::PARAM_STR);
		$stmt->bindParam(":pTipoDoc", $datosPasajero["tipoDoc"], PDO::PARAM_STR);
		$stmt->bindParam(":pNroDoc", $datosPasajero["NroDoc"], PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

        $stmt = null;

	}

	#CREAR HISTORIAL SOLICITUD
	#------------------------------------------------------------
	static public function mdlCrearHisorialSolicitud($datosVenta){

		$stmt = Conexion::conectar()->prepare("CALL usp_insert_estado_cotizacion_estado(:pId_solicitud, :pestado);");

		$stmt->bindParam(":pId_solicitud", $datosVenta["solicitud"], PDO::PARAM_INT);
		$stmt->bindParam(":pestado", $datosVenta["estado"], PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

        $stmt = null;

	}

	static public function mdlObtenetPaqueteByIdCalificar($id){

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
														p.consideraciones							
												   from tb_campanias_x_paquetes cp
                                             inner join tb_paquetes p on cp. id_paquete = p.id_paquete
                                             inner join tb_campenias c on cp.id_campania = c.id_campania
                                             inner join tb_ciudades ci on p.id_ciudad = ci.id_ciudad
                                             left join tb_hoteles h on p.id_hotel = h.id_hotel
                                             left join tb_aerolineas a on a.id_aerolinea = p.id_aerolinea
												 WHERE p.id_paquete =:id");
												 
		$stmt -> bindParam(":id", $id, PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

        $stmt = null;

	}
	
	//OBTENER CLIENTE POR DNI

	static public function mdlObtenerClienteByEmail($email){
		$stmt = Conexion::conectar()->prepare(  "SELECT * from tb_clientes c
												 WHERE  c.correo = :email");
												 
		$stmt -> bindParam(":email", $email, PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetch();
		$stmt -> close();
        $stmt = null;
	}
	
	//OBTENER SERVICIOS DE HOTEL
	static public function mdlObtenerServiciosHotel($idHotel){
		$stmt = Conexion::conectar()->prepare(  "SELECT * from tb_hoteles c
												 WHERE  c.correo = :email");
												 
		$stmt -> bindParam(":email", $email, PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetch();
		$stmt -> close();
        $stmt = null;
	}

}