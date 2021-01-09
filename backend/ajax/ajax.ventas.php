<?php

require_once "../controladores/controlador.ventas.php";
require_once "../modelos/modelo.ventas.php";

class AjaxVentas{

	public function ajaxGenerarDocXML($idVenta){

        $datosVenta = ControladorVentas::ctrObtenetDatosParaDocumentoElectronico($idVenta);
        
        //guardarBD
        if($datosVenta["id_documento"] == "-1"){
            
            ControladorVentas::ctrCrearDocumentoElectronico($datosVenta);
        }
        $respuesta = ControladorVentas::generateDocument($datosVenta,'XML');
        echo json_encode($respuesta);
        
    }
    
    public function ajaxGenerarDocPDF($idVenta){

        $datosVenta = ControladorVentas::ctrObtenetDatosParaDocumentoElectronico($idVenta);

       
        return ControladorVentas::generateDocument($datosVenta,'PDF');
    }
    
    

}

/*=============================================
CONSULTAR HOTELES
=============================================*/	

if(isset($_POST['xml'])){

	$pagar = new AjaxVentas();
	$pagar -> ajaxGenerarDocXML($_POST["id_venta"]);
}

if(isset($_POST['pdf'])){

	$pagar = new AjaxVentas();
	$pagar -> ajaxGenerarDocPDF($_POST["id_venta"]);

}