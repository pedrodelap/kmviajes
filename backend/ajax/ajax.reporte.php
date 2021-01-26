<?php

require_once "../controladores/controlador.reporte.php";
require_once "../modelos/modelo.reporte.php";

class AjaxReporte{
    
    public function ajaxObtenerDatosGrafico(){
        $respuesta = ControladorReporte::ctrObtenerDatosDashboardGrafico();
        echo json_encode($respuesta);
    }
    
}

if(isset($_POST['grafico'])){

	$datos = new AjaxReporte();
	$datos -> ajaxObtenerDatosGrafico();

}