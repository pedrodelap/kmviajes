<?php

class ControladorReporte{

    static public function ctrObtenerDatosDashboardGrafico(){
		$respuesta = ModeloReporte::mdlObtenerDatosDashboardGrafico();
		return $respuesta;

    }

    static public function ctrObtenerTotalPasajeroMesActual(){
		$respuesta = ModeloReporte::mdlObtenerTotalPasajeroMesActual();
		return $respuesta;

    }

    static public function ctrObtenerTotalMontoVentaMesActual(){
		$respuesta = ModeloReporte::mdlObtenerTotalMontoVentaMesActual();
		return $respuesta;

    }

    static public function ctrObtenerTotalSolicitudesMesActual(){
		$respuesta = ModeloReporte::mdlObtenerTotalSolicitudesMesActual();
		return $respuesta;

    }

    static public function ctrObtenerTotalPasajeros(){
		$respuesta = ModeloReporte::mdlObtenerTotalPasajeros();
		return $respuesta;

    }

    static public function ctrObtenerTotalMontoVentas(){
		$respuesta = ModeloReporte::mdlObtenerTotalMontoVentas();
		return $respuesta;

    }

    static public function ctrObtenerTotalIncidentes(){
		$respuesta = ModeloReporte::mdlObtenerTotalIncidentes();
		return $respuesta;

    }

    static public function ctrObtenerTotalCalificacion(){
		$respuesta = ModeloReporte::mdlObtenerTotalCalificacion();
		return $respuesta;

    }

    ///REPORTES

    static public function ctrReporteVentas(){
      $respuesta = ModeloReporte::mdlReporteVentas();
      return $respuesta;
  
    }

    static public function ctrReporteCalificacionAero(){
      $respuesta = ModeloReporte::mdlReporteCalificacionAero();
      return $respuesta;
  
    }

    static public function ctrReporteCalificacionHotel(){
      $respuesta = ModeloReporte::mdlReporteCalificacionHotel();
      return $respuesta;
  
    }

    static public function ctrReporteCalificacionComentario(){
      $respuesta = ModeloReporte::mdlReporteCalificacionComentario();
      return $respuesta;
  
    }

    static public function ctrReporteIncidente(){
      $respuesta = ModeloReporte::mdlReporteIncidente();
      return $respuesta;
  
    }

    static public function ctrReporteChecks(){
      $respuesta = ModeloReporte::mdlReporteChecks();
      return $respuesta;
  
    }

}