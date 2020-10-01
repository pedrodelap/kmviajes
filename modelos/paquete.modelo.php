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
														a.compania
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
       
        $stmt = Conexion::conectar()->prepare("SELECT s.nombre, s.icono from tb_servicios_x_paquetes sp
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


}