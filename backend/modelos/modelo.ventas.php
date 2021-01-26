<?
require_once "conexion.php";

class ModeloVentas{

    //OBTENER LISTA DE VENTA
	static public function mdlListarVentasOnline(){
		$stmt = Conexion::conectar()->prepare( "SELECT 
                                                v.id_venta,
                                                v.id_solicitud,
                                                v.nro_operacion,
                                                v.fecha_creacion,
                                                v.ruc,
                                                v.monto,
                                                c.nombres,
                                                c.apellidos,
                                                c.telefono,
                                                c.correo,
                                                d.id_documento
                                                FROM tb_venta v
                                                INNER JOIN tb_solicitud s on s.id_solicitud = v.id_solicitud
                                                INNER JOIN tb_clientes c on c.id_cliente = s.id_cliente
                                                LEFT JOIN tb_documento_electronico d on d.id_venta = v.id_venta
                                                ORDER BY 1 DESC;");
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
        $stmt = null;
    }
    
    static public function mdlObtenetDatosParaDocumentoElectronico($idVenta){

		$stmt = Conexion::conectar()->prepare("SELECT 
                                                    CASE 
                                                        WHEN v.ruc is not null THEN '01'
                                                        WHEN v.ruc is  null THEN '03'
                                                    end as tipo_documento,
                                                    
                                                    CASE 
                                                        WHEN d.id_documento is null THEN (select ifnull(max(id_documento),1) from tb_documento_electronico)
                                                        WHEN d.id_documento is not null THEN d.id_documento
                                                    end as correlativo,
                                                    v.fecha_creacion as fecha_emision,
                                                    c.id_cliente,
                                                    v.monto,
                                                    v.id_venta,
                                                    v.id_solicitud,
                                                    v.ruc,
                                                    c.nombres,
                                                    c.apellidos,
                                                    c.numero_documento,
                                                    ifnull(d.id_documento,-1) as id_documento,
                                                    '0101' as tipo_operacion,
                                                    'USD' as tipo_moneda,
                                                    (v.monto /1.18) as monto_neto,
                                                    (v.monto - (v.monto /1.18)) as monto_igv,
                                                    CASE 
                                                        WHEN v.ruc is not null THEN 'F001'
                                                        WHEN v.ruc is null THEN 'B001'
                                                    end as serie
                                                    FROM tb_venta v
                                                    INNER JOIN tb_solicitud s on s.id_solicitud = v.id_solicitud
                                                    INNER JOIN tb_clientes c on c.id_cliente = s.id_cliente
                                                    LEFT JOIN tb_documento_electronico d on d.id_venta = v.id_venta
                                                    WHERE v.id_venta = :id_venta");
												 
		$stmt -> bindParam(":id_venta", $idVenta, PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

        $stmt = null;

    }
    

    #CREAR DOCUMENTO ELECTRONICO
	#------------------------------------------------------------
	static public function mdlCrearDocumentoElectronico($datosDocumento){

		$stmt = Conexion::conectar()->prepare("CALL usp_insert_doc_electronico(:tipo_operacion, :tipo_documento, :serie, :correlativo, :fecha_emision,:tipo_moneda,:id_cliente,:monto_bruto,:monto_neto,:monto_igv,:id_venta);");

		$stmt->bindParam(":tipo_operacion", $datosDocumento["tipo_operacion"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_documento", $datosDocumento["tipo_documento"], PDO::PARAM_STR);
		$stmt->bindParam(":serie", $datosDocumento["serie"], PDO::PARAM_STR);
		$stmt->bindParam(":correlativo", $datosDocumento["correlativo"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha_emision", $datosDocumento["fecha_emision"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_moneda", $datosDocumento["tipo_moneda"], PDO::PARAM_STR);
		$stmt->bindParam(":id_cliente", $datosDocumento["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":monto_bruto", $datosDocumento["monto"], PDO::PARAM_STR);
		$stmt->bindParam(":monto_neto", $datosDocumento["monto_neto"], PDO::PARAM_STR);
        $stmt->bindParam(":monto_igv", $datosDocumento["monto_igv"], PDO::PARAM_STR);
		$stmt->bindParam(":id_venta", $datosDocumento["id_venta"], PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

        $stmt = null;

    }
    

    #CREAR DOCUMENTO ELECTRONICO
	#------------------------------------------------------------
	static public function mdlRegistrarCheckin($datos){

		$stmt = Conexion::conectar()->prepare("CALL usp_insert_check_in(:idpaquete, :vuelo_fecha, :vuelo_hora, :fecha_hotel, :comentarios);");
    
		$stmt->bindParam(":idpaquete", $datos["idPaquete"], PDO::PARAM_INT);
        $stmt->bindParam(":vuelo_fecha", $datos["fecha_vuelo_real"], PDO::PARAM_STR);
        $stmt->bindParam(":vuelo_hora", $datos["hora_vuelo_real"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_hotel", $datos["fecha_hotel_real"], PDO::PARAM_STR);
        $stmt->bindParam(":comentarios", $datos["comentarios"], PDO::PARAM_STR);
		

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

        $stmt = null;

    }
    
    static public function mdlRegistrarCheckout($datos){

		$stmt = Conexion::conectar()->prepare("CALL usp_insert_check_out(:idpaquete, :vuelo_fecha, :vuelo_hora, :fecha_hotel, :comentarios);");

		$stmt->bindParam(":idpaquete", $datos["idPaquete"], PDO::PARAM_INT);
        $stmt->bindParam(":vuelo_fecha", $datos["fecha_vuelo_real"], PDO::PARAM_STR);
        $stmt->bindParam(":vuelo_hora", $datos["hora_vuelo_real"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_hotel", $datos["fecha_hotel_real"], PDO::PARAM_STR);
        $stmt->bindParam(":comentarios", $datos["comentarios"], PDO::PARAM_STR);
		
		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

        $stmt = null;

    }
    
    static public function mdlRegistrarIncidente($datos){

		$stmt = Conexion::conectar()->prepare("CALL usp_insert_incidente(:idpaquete, :comentario,:tipo);");

		$stmt->bindParam(":idpaquete", $datos["idPaquete"], PDO::PARAM_INT);
        $stmt->bindParam(":comentario", $datos["comentarioIncidente"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo", $datos["tipos"], PDO::PARAM_STR);
		
		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

        $stmt = null;

    }
    
    static public function mdlRegistrarIncidenteServicio($datos){

		$stmt = Conexion::conectar()->prepare("CALL usp_insert_incidente_servicio(:id_incidente, :id_servicio);");

        $stmt->bindParam(":id_incidente", $datos["id_incidente"], PDO::PARAM_INT);
        $stmt->bindParam(":id_servicio", $datos["id_servicio"], PDO::PARAM_INT);
        
		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

        $stmt = null;

    }
    
    static public function mdlRegistrarIncidentePasajero($datos){

		$stmt = Conexion::conectar()->prepare("CALL usp_insert_incidente_pasajero(:id_incidente, :id_pasajero);");

        $stmt->bindParam(":id_incidente", $datos["id_incidente"], PDO::PARAM_INT);
        $stmt->bindParam(":id_pasajero", $datos["id_pasajero"], PDO::PARAM_INT);
        
		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

        $stmt = null;

    }


}