<?php

require_once "controlador.apiCall.php";

class ControladorPaqueteFront{

    static public function ctrlistarTodosPaquetesDisponibles($filter){

        $respuesta = ModeloPaqueteFront::mdlListarTodosPaquetesDisponibles($filter);

        $html = "";
        foreach ($respuesta as $key => $value) {
            $ruta = "index.php?ruta=detallepaquete&id=".$value["id_paquete"];

            echo '<div class="col-md-4" id="paquete_'.$value["id_paquete"].'" >
                    <div class="box-image-text">
                        <div class="image"><img src="backend/'.$value["ruta_imagen"].'" alt="" class="img-fluid">
                            <div class="overlay d-flex align-items-center justify-content-center">
                            <div class="content">
                                <div class="name">
                                <h3><a href="#" class="color-white" style="text-decoration: none;">$ '.number_format($value["precio_dolar"],2).' o S/ '.number_format($value["precio_sol"],2).'</a></h3>
                                </div>
                                <div class="text">
                                    <p class="buttons"><button idPaquete="'.$value["id_paquete"].'" class=" btn-buscar2 btn btn-template-outlined-white">Ver</button></p>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="content">
                        <h4><a href="'.$ruta.'">'.$value["titulo"].'</a></h4>
                        <p>'.$value["descripcion_corta"].'</p>
                        </div>';
                        if(!$value["necesita_reserva"]){
                            echo '<div class="ribbon-holder">
                                    <div class="ribbon sale">Oferta</div>
                                </div>';
                        }
                        
                echo '</div>
                </div>';
        }

        

    }

    static public function ctrObtenetPaqueteById($id){

        $respuesta = ModeloPaqueteFront::mdlObtenetPaqueteById($id);
        return $respuesta;
    
    }

    static public function ctrListarServiciosPorPaquete($id){

        $respuesta = ModeloPaqueteFront::mdlListarServiciosPorPaquete($id);
        return $respuesta;
    
    }

    static public function ctrListarCiudad(){

        $respuesta = ModeloPaqueteFront::mdlListarCiudad();


        foreach ($respuesta as $key => $value) {
           
            echo '<option value='.$value["id_ciudad"].'>'.$value["nombre"].'</option>';
                    
        }
    
    }

    static public function ctrListarPaquetePorCampania($id_campania){

        $respuesta = ModeloPaqueteFront::mdlListarPaquetePorCampania($id_campania);
        return $respuesta;
    
    }

    static public function ctrListarFotosPorPaquete($id){

        $respuesta = ModeloPaqueteFront::mdlListarFotosPorPaquete($id);
        return $respuesta;
    
    }

    static public function ctrCrearClienteSolicitudPersonalizada($datosCliente){

        $resultado = "";

        if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $datosCliente["nombres"]) &&
        preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $datosCliente["apellidos"]) &&			   
        preg_match('/^[a-zA-Z0-9. ]+$/', $datosCliente["numero_documento"]) &&
        preg_match('/^[0-9]+$/', $datosCliente["numero_documento"]) &&
        preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $datosCliente["correo"]) &&
        preg_match('/^[()\-0-9 ]+$/', $datosCliente["telefono"] )){


            $respuesta = ModeloPaqueteFront::mdlCrearClienteSolicitudPersonalizada($datosCliente);
    
		    $resultado = $respuesta;

        }else {

            $respuesta= "errorValidacionCliente";

        }

        return $respuesta;

    }

    static public function ctrCrearSolicitudPersonalizada($datosSolicitud){

        $respuesta = ModeloPaqueteFront::mdlCrearSolicitudPersonalizada($datosSolicitud);
    
		return $respuesta;

    }

    static public function ctrCrearSolicitudPersonalizadaHistorial($datosCliente){

        $respuesta = ModeloPaqueteFront::mdlCrearClienteSolicitudPersonalizada($datosCliente);
    
		return $respuesta;

    }

    static public function ctrCrearVenta($datosVenta){

        $respuesta = ModeloPaqueteFront::mdlCrearVenta($datosVenta);
    
		return $respuesta;

    }

    static public function ctrCrearPasajero($datosPasajero){

        $respuesta = ModeloPaqueteFront::mdlCrearPasajero($datosPasajero);
    
		return $respuesta;

    }

    static public function ctrEnviarPagoPasarella($data){

        //"ApiKey~merchantId~referenceCode~tx_value~currency"
        $signature = md5("4Vj8eK4rloUd272L48hsrarnUA~508029~".$data["referenceCode"]."~".$data["amount"]."~".$data["currency"]);
        $datosPago = array(
            "language" => "es",
            "command" => "SUBMIT_TRANSACTION",
            "merchant" => array(
               "apiKey" => "4Vj8eK4rloUd272L48hsrarnUA",
               "apiLogin" => "pRRXKOl8ikMmt9u"
            ),
            "transaction" => array(
               "order" => array(
                    "accountId" => "512323",
                    "referenceCode" => $data["referenceCode"],
                    "description" => $data['description'],
                    "language" => "es",
                    "signature" => $signature,    
                    "additionalValues" => array(
                        "TX_VALUE" => array( 
                            "value" => $data['amount'],
                            "currency" => $data['currency']
                        )
                    ),
                    "buyer" => array(
                        "dniNumber" => $data['dniNumber'],
                        "emailAddress" => $data['emailAddress'],
                        "fullName" => $data['fullName'],
                        "shippingAddress" => array(
                            "country" => "PE",
                            "phone" => $data['phone']
                        ),
                        "dniType" => "DNI",
                        "contactPhone" => $data['phone']
                    ),
                    "shippingAddress" => array(
                        "country" => "PE",
                        "phone"=> $data['phone']
                    )
                ),
               "payer" => array(
                    "dniNumber" => $data['dniNumber'],
                    "emailAddress" => $data['emailAddress'],
                    "fullName" => $data['fullName'],
                    "dniType" => "DNI",
                    "billingAddress" => array(
                        "country" =>"PE",
                        "phone" => $data['phone']
                    ),
                    "contactPhone" => $data['phone'],
                    "merchantPayerId" => $data['merchantPayerId']
                ),
               "creditCard" => array(
                    "number" => $data['number'],
                    "securityCode" => $data['securityCode'],
                    "expirationDate" => $data['expirationDate'],
                    "name" => $data['fullName'],
                    "processWithoutCvv2" => false
                ),
               "extraParameters" => array(
                  "INSTALLMENTS_NUMBER" => $data['cuotas']
               ),
               "type" => "AUTHORIZATION_AND_CAPTURE",
               "paymentMethod" => $data['paymentMethod'],
               "paymentCountry" => "PE"
               
            ),
            "test" => true
        );
        $url = "https://sandbox.api.payulatam.com/payments-api/4.0/service.cgi";

        $respuesta = CallApi::httpPost($url, $datosPago);
        return $respuesta;
    }

    static public function ctrObtenetPaqueteByCodigoSeguimiento($codigoSeguimiento){
        $respuesta = ModeloPaqueteFront::mdlObtenetPaqueteByCodigoSeguimiento($codigoSeguimiento);
		return $respuesta;

    }

    static public function ctrObtenerHistoricoSeguimiento($codigoSeguimiento){
        $respuesta = ModeloPaqueteFront::mdlObtenerHistoricoSeguimiento($codigoSeguimiento);
		return $respuesta;

    }

    static public function ctrObtenerHistoricoSeguimientoSinAprobado($codigoSeguimiento){
        $respuesta = ModeloPaqueteFront::mdlObtenerHistoricoSeguimiento2($codigoSeguimiento);
		return $respuesta;

    }

    static public function ctrSelectSearchPaisCiudad($valor){

		$respuesta = ModeloPaqueteFront::mdlSelectCiudades($valor);

		return $respuesta;

    }

    static public function ctrCrearHistorialSolicitud($datosVenta){

        $respuesta = ModeloPaqueteFront::mdlCrearHisorialSolicitud($datosVenta);
    
		return $respuesta;

    }

    static public function ctrObtenerClienteByEmail($email){

        $respuesta = ModeloPaqueteFront::mdlObtenerClienteByEmail($email);
    
		return $respuesta;

    }

    static public function ctrListaHabitacionesByHotel($idPaquete){
        $respuesta = ModeloPaqueteFront::mdlListaHabitacionesByHotel($idPaquete);
        return $respuesta;
    }


    
    static public function ctrInsertarCalificacionAerolinea($datosCalificar){

        $respuesta = ModeloPaqueteFront::mdlInsertarCalificacionAerolinea($datosCalificar);
		return $respuesta;
    }

    static public function ctrInsertarCalificacionHotel($datosCalificar){

        $respuesta = ModeloPaqueteFront::mdlInsertarCalificacionHotel($datosCalificar);
		return $respuesta;
    }

    static public function ctrInsertarCalificacionComentario($datosCalificar){

        $respuesta = ModeloPaqueteFront::mdlInsertarCalificacionComentario($datosCalificar);
		return $respuesta;
    }

    static public function ctrInsertarCalificacionServicio($datosCalificar){

        $respuesta = ModeloPaqueteFront::mdlInsertarCalificacionServicio($datosCalificar);
		return $respuesta;
    }
   
}