<?php

require_once "../controladores/controlador.ventas.php";
require_once "../modelos/modelo.ventas.php";

class AjaxSeguimiento{

	public function ajaxRegistrarCheck($datosPago){

        if($datosPago["checkTipo"] == "Check-In"){
            $respuesta = ControladorVentas::ctrRegistrarCheckIn($datosPago);
            echo json_encode($respuesta);
            
        }
        else{
            $respuesta = ControladorVentas::ctrRegistrarCheckOut($datosPago);
            echo json_encode($respuesta);
            
        }
        
    }

    public function ajaxRegistrarIncidente($datosIncidente){
        $incidenteId = ControladorVentas::ctrRegistrarIncidente($datosIncidente);

        $pasajeronJson = json_decode($datosIncidente["incidentePasajero"]);
			foreach($pasajeronJson as $item){
				$datosPasajero = array(
                                    "id_incidente"=>$incidenteId[0],				   
								    "id_pasajero"=>$item
								    );	
                ControladorVentas::ctrRegistrarIncidentePasajero($datosPasajero);
            }
        $servicioJson = json_decode($datosIncidente["servicio"]);
			foreach($servicioJson as $item){
				$datosPasajero = array(
                                    "id_incidente"=>$incidenteId[0],				   
								    "id_servicio"=>$item
								    );	
                ControladorVentas::ctrRegistrarIncidenteServicio($datosPasajero);
            }
            echo json_encode($incidenteId);  

    }

}

if(isset($_POST['check'])){

	$pagar = new AjaxSeguimiento();
	$datosPago = array("idPaquete"=>$_POST["idPaquete"],
						"fecha_vuelo_real"=>$_POST["fecha_vuelo_real"],
					  	"hora_vuelo_real"=>$_POST["hora_vuelo_real"],
                        "fecha_hotel_real"=>$_POST["fecha_hotel_real"],
                        "comentarios" => $_POST["check_comentarios"],
						"checkTipo"=>$_POST["checkTipo"]
					);
	$pagar -> ajaxRegistrarCheck($datosPago);
}

if(isset($_POST['incidente'])){
    $incidente = new AjaxSeguimiento();
   
    $datosIncidente = array("idPaquete" => $_POST["idPaquete"],
                            "comentarioIncidente" => $_POST["comentarioIncidente"],
                            "incidentePasajero"=> $_POST["incidentePasajero"],
                            "tipos" => implode(",",json_decode($_POST["tipos"])),
                            "servicio" => $_POST["servicio"]
                            );

    $incidente -> ajaxRegistrarIncidente($datosIncidente);
}