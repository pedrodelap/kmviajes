<?php

require_once "conexion.php";

class ModeloReporte{

static public function mdlObtenerDatosDashboardGrafico(){

    $stmt = Conexion::conectar()->prepare("SELECT 
                                                DATE_FORMAT(fecha_registro,'%Y-%m') AS 'month', 
                                                count(1) AS 'qSolicitud',
                                                ufnt_obtener_ventas_por_mes_anio(YEAR(fecha_registro) , MONTH(fecha_registro) ) AS 'qVentas' 
                                                FROM tb_solicitud s
                                            GROUP BY  month,qVentas 
                                            order by month");
    $stmt -> execute();
    return $stmt -> fetchAll();
    $stmt -> close();
    $stmt = null;
}


static public function mdlObtenerTotalPasajeroMesActual(){

    $stmt = Conexion::conectar()->prepare("SELECT count(1) as TOTAL FROM tb_pasajero p
                                            JOIN tb_venta v on p.id_venta = v.id_venta
                                            WHERE fecha_creacion between '2021-01-01' and '2021-01-31'");
    $stmt -> execute();
    return $stmt -> fetchAll();
    $stmt -> close();
    $stmt = null;
}

static public function mdlObtenerTotalMontoVentaMesActual(){

    $stmt = Conexion::conectar()->prepare("SELECT sum(monto) as TOTAL from tb_venta
                                            where fecha_creacion between '2021-01-01' and '2021-01-31'");
    $stmt -> execute();
    return $stmt -> fetchAll();
    $stmt -> close();
    $stmt = null;
}

static public function mdlObtenerTotalSolicitudesMesActual(){

    $stmt = Conexion::conectar()->prepare("SELECT count(1) as TOTAL from tb_solicitud
                                            where fecha_registro between '2021-01-01' and '2021-01-31'");
    $stmt -> execute();
    return $stmt -> fetchAll();
    $stmt -> close();
    $stmt = null;
}


static public function mdlObtenerTotalPasajeros(){

    $stmt = Conexion::conectar()->prepare("SELECT count(1) as TOTAL FROM tb_pasajero p");
    $stmt -> execute();
    return $stmt -> fetchAll();
    $stmt -> close();
    $stmt = null;
}

static public function mdlObtenerTotalMontoVentas(){

    $stmt = Conexion::conectar()->prepare("SELECT sum(monto) as TOTAL from tb_venta");
    $stmt -> execute();
    return $stmt -> fetchAll();
    $stmt -> close();
    $stmt = null;
}

static public function mdlObtenerTotalIncidentes(){

    $stmt = Conexion::conectar()->prepare("SELECT  count(1) as TOTAL from tb_incidente");
    $stmt -> execute();
    return $stmt -> fetchAll();
    $stmt -> close();
    $stmt = null;
}


static public function mdlObtenerTotalCalificacion(){

    $stmt = Conexion::conectar()->prepare("SELECT  count(1) as TOTAL from tb_calificacion_aerolinea");
    $stmt -> execute();
    return $stmt -> fetchAll();
    $stmt -> close();
    $stmt = null;
}


static public function mdlReporteVentas(){

    $stmt = Conexion::conectar()->prepare("SELECT 
    p.titulo,
    v.ruc,
    v.razon_social,
    c.numero_documento,
    c.nombres,
    c.apellidos,
    v.monto,
    v.nro_operacion,
    s.codigo_seguimiento,
    v.fecha_creacion
     from tb_venta v
    join tb_solicitud s 
    on v.id_solicitud = s.id_solicitud
    join tb_clientes c on s.id_cliente = c.id_cliente
    join tb_paquetes p on p.id_paquete = s.id_paquete");
    $stmt -> execute();
    return $stmt -> fetchAll();
    $stmt -> close();
    $stmt = null;
}
static public function mdlReporteCalificacionAero(){

    $stmt = Conexion::conectar()->prepare("SELECT 
    p.titulo,
    c.numero_documento,
    c.nombres,
    c.apellidos,
    c.telefono,
    c.correo,
    a.compania,
    v.valor,
    v.mejorar,
    v.fecha_registro
     from tb_calificacion_aerolinea v
    join tb_solicitud s 
    on v.id_solicitud = s.id_solicitud
    join tb_clientes c on s.id_cliente = c.id_cliente
    join tb_paquetes p on p.id_paquete = s.id_paquete
    join tb_aerolineas a on a.id_aerolinea  = v.id_aerolinea");
    $stmt -> execute();
    return $stmt -> fetchAll();
    $stmt -> close();
    $stmt = null;
}

static public function mdlReporteCalificacionHotel(){

    $stmt = Conexion::conectar()->prepare("SELECT 
    p.titulo,
    c.numero_documento,
    c.nombres,
    c.apellidos,
    c.telefono,
    c.correo,
    a.nombre,
    v.valor,
    v.mejorar,
    v.fecha_registro
     from tb_calificacion_hotel v
    join tb_solicitud s 
    on v.id_solicitud = s.id_solicitud
    join tb_clientes c on s.id_cliente = c.id_cliente
    join tb_paquetes p on p.id_paquete = s.id_paquete
    join tb_hoteles a on a.id_hotel  = v.id_hotel");
    $stmt -> execute();
    return $stmt -> fetchAll();
    $stmt -> close();
    $stmt = null;
}

static public function mdlReporteCalificacionComentario(){

    $stmt = Conexion::conectar()->prepare("SELECT p.titulo,
                                            v.mejorar,
                                            v.fecha_registro,
                                            c.nombres,
                                            c.apellidos,
                                            c.telefono,
                                            c.correo 
                                            from tb_calificacion_comentario v
                                        join tb_solicitud s 
                                    on v.id_solicitud = s.id_solicitud
                                    join tb_paquetes p on p.id_paquete = s.id_paquete
                                     join tb_clientes c on s.id_cliente = c.id_cliente;");
    $stmt -> execute();
    return $stmt -> fetchAll();
    $stmt -> close();
    $stmt = null;
}

static public function mdlReporteIncidente(){

    $stmt = Conexion::conectar()->prepare("SELECT DISTINCT comentario,tipo,registro, pa.nombres, pa.apellidos, ser.nombre,paq.titulo FROM tb_incidente i
    JOIN tb_incidente_pasajero p on i.id_incidente = p.id_incidente
    JOIN tb_incidente_servicio s on s.id_incidente = i.id_incidente
    JOIN tb_pasajero pa on pa.id_pasajero = p.id_pasajero
    JOIN tb_servicios ser on ser.id_servicio =s.id_servicio
    JOIN tb_paquetes paq on paq.id_paquete = i.id_paquete;");
    $stmt -> execute();
    return $stmt -> fetchAll();
    $stmt -> close();
    $stmt = null;
}


static public function mdlReporteChecks(){

    $stmt = Conexion::conectar()->prepare("SELECT 
    p.titulo,
    p.fecha_inicio,
    p.fecha_fin,
    p.hora_vuelo_ida,
    p.hora_vuelo_regreso,
    ci.checkin_vuelo_fecha,
    ci.checkin_vuelo_hora,
    ci.checkin_hotel_fecha_hora,
    co.checkout_vuelo_fecha,
    co.checkout_vuelo_hora,
    co.checkout_hotel_fecha_hora,
    ci.comentarios,
    co.comentarios as comentariosOut
     from tb_paquetes p 
    JOIN tb_seguimiento_checkin ci on ci.id_paquete = p.id_paquete
    JOIN tb_seguimiento_checkout co on co.id_paquete = p.id_paquete;");
    $stmt -> execute();
    return $stmt -> fetchAll();
    $stmt -> close();
    $stmt = null;
}
}