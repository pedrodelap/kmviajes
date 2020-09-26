<?php

class ModeloPaqueteFront{
    
    static public function mdlObtenetPaqueteById($id){
        
      $stmt = Conexion::conectar()->prepare("SELECT p.id_paquete,
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
                                            c.nombre as 'nombreCampania',
                                            ci.nombre as 'nombreCiudad',
                                            h.nombre  as 'nombreHotel',
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

    }

    static public function mdlListarTodosPaquetesDisponibles($filter){
       
      
      $term = '%'.$filter.'%';

        
        $stmt = Conexion::conectar()->prepare("SELECT p.id_paquete,
                                               p.titulo,
                                               p.descripcion_corta,
                                               p.precio_dolar,
                                               p.precio_sol,
                                               p.foto_corta,
                                               p.flag 
                                               from tb_campanias_x_paquetes cp 
                                               inner join tb_paquetes p 
                                               on cp. id_paquete = p.id_paquete 
                                               inner join tb_ciudades ci 
                                               on p.id_ciudad = ci.id_ciudad 
                                               where p.titulo like :term or ci.nombre like :term
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

    static public function mdlCrearSolicitudPaso1( $datos){

      $stmt = Conexion::conectar()->prepare("CALL usp_insert_cliente(:nombres, :apellidos, :numero_documento, :telefono, :correo)");

       $stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);		
      $stmt->bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
      $stmt->bindParam(":numero_documento", $datos["numero_documento"], PDO::PARAM_STR);
      $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
      $stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
  
      if($stmt->execute()){
  
        return $stmt -> fetch();
        
  
      }else{
  
        return "error";
      
      }
  
      $stmt->close();
      $stmt = null;
  
    }


    static public function mdlCrearSolicitudPaso2( $datos,$idCliente){

       $stmt = Conexion::conectar()->prepare("CALL usp_insert_solicitud(:id_paquete, :id_ciudad, :fecha_inicio , :fecha_fin, :numero_ninios, :pAdultos, :pComentario,:pServicios,:pIdCliente)");
        $stmt->bindParam(":id_paquete", $datos["id_paquete"], PDO::PARAM_INT);		
        $stmt->bindParam(":id_ciudad", $datos["id_ciudad"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha_inicio", $datos["fecha_inicio"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_fin", $datos["fecha_fin"], PDO::PARAM_STR);
        $stmt->bindParam(":numero_ninios", $datos["numero_ninios"], PDO::PARAM_INT);
        $stmt->bindParam(":pAdultos", $datos["numero_adultos"], PDO::PARAM_INT);
        $stmt->bindParam(":pComentario", $datos["comentario"], PDO::PARAM_STR);
        $stmt->bindParam(":pServicios", $datos["servicios"], PDO::PARAM_STR);
        $stmt->bindParam(":pIdCliente", $idCliente, PDO::PARAM_INT);

      if($stmt->execute()){
        return $stmt -> fetch();
        
      }else{
        return "error";
      }
  
      $stmt->close();
      $stmt = null;
  
    }



}