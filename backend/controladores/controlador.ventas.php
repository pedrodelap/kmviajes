<?php


require_once $_SERVER['DOCUMENT_ROOT']."/controladores/controlador.apiCall.php";

class ControladorVentas{

	
	#LISTAR VENTAS 
	#---------------------------------------------------
	public static function ctrListarVentasOnline(){

		$respuesta = ModeloVentas::mdlListarVentasOnline();
    
		return $respuesta;

	}

	public static function ctrObtenetDatosParaDocumentoElectronico($idVenta){

		$respuesta = ModeloVentas::mdlObtenetDatosParaDocumentoElectronico($idVenta);
		return $respuesta;

	}

	public static function ctrCrearDocumentoElectronico($datosDocumento){

		$respuesta = ModeloVentas::mdlCrearDocumentoElectronico($datosDocumento);
		return $respuesta;

	}

	public static function ctrRegistrarCheckIn($datos){
		$respuesta = ModeloVentas::mdlRegistrarCheckin($datos);
		return $respuesta;
	}

	public static function ctrRegistrarCheckOut($datos){
		$respuesta = ModeloVentas::mdlRegistrarCheckout($datos);
		return $respuesta;
	}

	public static function ctrRegistrarIncidente($datos){
		$respuesta = ModeloVentas::mdlRegistrarIncidente($datos);
		return $respuesta;
	}

	public static function ctrRegistrarIncidenteServicio($datos){
		$respuesta = ModeloVentas::mdlRegistrarIncidenteServicio($datos);
		return $respuesta;
	}

	public static function ctrRegistrarIncidentePasajero($datos){
		$respuesta = ModeloVentas::mdlRegistrarIncidentePasajero($datos);
		return $respuesta;
	}

	public static function generateDocument($datosVenta, $operation){

      
		$numberToText = ControladorVentas::convertir($datosVenta["monto"]);
        $datosPago = array(
            
                "tipoOperacion" => "0101",
                "tipoDoc" => $datosVenta["tipo_documento"],
                "serie" => $datosVenta["serie"],
                "correlativo" => $datosVenta["correlativo"],
                "fechaEmision" => "2020-11-18T00:00:00-05:00",
                "tipoMoneda" => "USD",
                "client" => array(
                  "tipoDoc" =>"1",
                  "numDoc" => $datosVenta["tipo_documento"] == "01"? $datosVenta["ruc"]:$datosVenta["numero_documento"],
                  "rznSocial" => $datosVenta["nombres"].' '.$datosVenta["apellidos"],
                  "address" => array(
                    "direccion"=> "AV LOS GERUNDIOS"
                  )
                ),
                "company" => array(
                  "ruc"=>  20602008283,
                  "razonSocial"=>  "KM VIAJES Y AVENTURA",
                  "address"=> array(
                    "direccion"=> "AV SOL 125 SURCO, LIMA"
                  )
                ),
                "mtoOperGravadas"=> $datosVenta["monto_neto"],
                "mtoIGV"=> $datosVenta["monto_igv"],
                "totalImpuestos"=> $datosVenta["monto_igv"],
                "valorVenta"=> $datosVenta["monto_neto"] ,
                "mtoImpVenta"=> $datosVenta["monto"],
                "ublVersion"=> "2.1",
                "details" => array(
                    array(
                    "codProducto"=> $datosVenta["id_solicitud"],
                    "unidad"=> "PAQ",
                    "descripcion"=> "Paquete de viajes",
                    "cantidad"=> 1,
                    "mtoValorUnitario"=> $datosVenta["monto_neto"],
                    "mtoValorVenta"=> $datosVenta["monto_neto"],
                    "mtoBaseIgv"=> $datosVenta["monto"],
                    "porcentajeIgv"=> 18,
                    "igv"=> $datosVenta["monto_igv"],
                    "tipAfeIgv"=> 10,
                    "totalImpuestos"=> $datosVenta["monto_igv"],
                    "mtoPrecioUnitario"=> $datosVenta["monto"]
                    )
                ),
                "legends" => array(
                  array(
                    "code" => "1000",
                    "value" => "SON ".$numberToText
                  )
                )
               
        );
        if($operation=="XML"){
            $url = "https://facturacion.apisperu.com/api/v1/invoice/send";

            $respuesta = CallApi::httpPostJson($url, $datosPago);
            return $respuesta;
        }
        else{
             $url = "https://facturacion.apisperu.com/api/v1/invoice/pdf";
            
             $respuesta = CallApi::DownloadInvoice($url, $datosPago,"document_".$datosVenta["id_venta"]);
             return $respuesta;
        }
	}
	

	function basico($numero) {
		$valor = array ('uno','dos','tres','cuatro','cinco','seis','siete','ocho',
		'nueve','diez', 'once','doce','trece','catorce','quince','dieciseis','dicisiete','dieciocho','diecinueve','veinte','veintiuno','veintidos','veintitres', 'veinticuatro','veinticinco',
		'veintiséis','veintisiete','veintiocho','veintinueve');
		return $valor[$numero - 1];
	}
		
	function decenas($n) {
		$decenas = array (30=>'treinta',40=>'cuarenta',50=>'cincuenta',60=>'sesenta',
		70=>'setenta',80=>'ochenta',90=>'noventa');
		if( $n <= 29) return ControladorVentas::basico($n);
		$x = $n % 10;
		if ( $x == 0 ) {
		return $decenas[$n];
		} else return $decenas[$n - $x].' y '. ControladorVentas::basico($x);
	}
		
	function centenas($n) {
		$cientos = array (100 =>'cien',200 =>'doscientos',300=>'trecientos',
		400=>'cuatrocientos', 500=>'quinientos',600=>'seiscientos',
		700=>'setecientos',800=>'ochocientos', 900 =>'novecientos');
		if( $n >= 100) {
		if ( $n % 100 == 0 ) {
		return $cientos[$n];
		} else {
		$u = (int) substr($n,0,1);
		$d = (int) substr($n,1,2);
		return (($u == 1)?'ciento':$cientos[$u*100]).' '.ControladorVentas::decenas($d);
		}
		} else return ControladorVentas::decenas($n);
	}
		
	function miles($n) {
		if($n > 999) {
		if( $n == 1000) {return 'mil';}
		else {
		$l = strlen($n);
		$c = (int)substr($n,0,$l-3);
		$x = (int)substr($n,-3);
		if($c == 1) {$cadena = 'mil '.ControladorVentas::centenas($x);}
		else if($x != 0) {$cadena = ControladorVentas::centenas($c).' mil '.ControladorVentas::centenas($x);}
		else $cadena = ControladorVentas::centenas($c). ' mil';
		return $cadena;
		}
		} else return ControladorVentas::centenas($n);
	}
		
	function millones($n) {
		if($n == 1000000) {return 'un millón';}
		else {
		$l = strlen($n);
		$c = (int)substr($n,0,$l-6);
		$x = (int)substr($n,-6);
		if($c == 1) {
		$cadena = ' millón ';
		} else {
		$cadena = ' millones ';
		}
		return ControladorVentas::miles($c).$cadena.(($x > 0)?ControladorVentas::miles($x):'');
		}
	}

	function convertir($valor) {
		$arr = explode(".", $valor);
		$n = $arr[0];
		if (isset($arr[1])) {
            $decimos = strlen($arr[1]) == 1 ? $arr[1] . '0' : $arr[1];
		}
		$num_word = "";
		switch (true) {
			case ( $n >= 1 && $n <= 29) : $num_word = ControladorVentas::basico($n); break;
			case ( $n >= 30 && $n < 100) : $num_word = ControladorVentas::decenas($n); break;
			case ( $n >= 100 && $n < 1000) : $num_word = ControladorVentas::centenas($n); break;
			case ($n >= 1000 && $n <= 999999): $num_word = ControladorVentas::miles($n); break;
			case ($n >= 1000000): $num_word = ControladorVentas::millones($n);
		}

		if (isset($decimos)) {
			$num_word .= " CON $decimos/100 SOLES";
		}
		else{
			$num_word .= " CON 00/100 SOLES";
		}

		return $num_word;
	}

    function number_words($valor,$desc_moneda, $sep, $desc_decimal) {
        $arr = explode(".", $valor);
        $entero = $arr[0];
        if (isset($arr[1])) {
            $decimos = strlen($arr[1]) == 1 ? $arr[1] . '0' : $arr[1];
        }
   
        $fmt = new \NumberFormatter('es', \NumberFormatter::SPELLOUT);
        if (is_array($arr)) {
            $num_word = ($arr[0]>=1000000) ? "{$fmt->format($entero)} " : "{$fmt->format($entero)}";
            if (isset($decimos)) {
                $num_word .= "CON $decimos/100 SOLES";
            }
        }
        return $num_word;
   }

}