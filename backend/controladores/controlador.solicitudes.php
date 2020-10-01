<?php

class ControladorSolicitudes{

	#MOSTRAR SOLICITUDES
	#-----------------------------------------------------
	static public function ctrMostrarSolicitudes($item, $valor){

		$tabla = "tb_solicitud";

		$respuesta = ModeloSolicitudes::mdlMostrarSolicitudes($tabla, $item, $valor);

		return $respuesta;

	}

	#MOSTRAR PAQUETE DE SOLICITUD
	#-----------------------------------------------------
	static public function ctrMostrarPaqueteDeSolicitud($item, $valor){

		$tabla = "tb_paquetes";

		$respuesta = ModeloSolicitudes::MostrarPaqueteDeSolicitud($tabla, $item, $valor);

		if ($respuesta != "error"){

			$datosPaqueteMostrar1 ='<div class="vertical-timeline-item vertical-timeline-element">
										<div><span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-primary"> </i></span>
											<div class="vertical-timeline-element-content bounce-in">
												<h4 class="timeline-title">'.$respuesta["titulo"].'</h4>
												<p>Aerolínea <span class="text-primary">S/. '.$respuesta["aerolinea_nombre"].'</span></p>
												<p>Ciudad <span class="text-primary">$ '.$respuesta["ciudad_pais"].'</span></p></div>
										</div>
									</div>									
									<div class="vertical-timeline-item vertical-timeline-element">
										<div><span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-success"> </i></span>
											<div class="vertical-timeline-element-content bounce-in">
												<h4 class="timeline-title">Datos del Paquete</h4>
												<p>Monto en nuevos soles <span class="text-success">S/. '.$respuesta["precio_sol"].'</span></p>
												<p>Monto en nuevos dolares <span class="text-success">$ '.$respuesta["precio_dolar"].'</span></p></div>
										</div>
									</div>
									<div class="vertical-timeline-item vertical-timeline-element">
										<div><span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-warning"> </i></span>
											<div class="vertical-timeline-element-content bounce-in">
												<p>Fecha de duración del paquete turístico<b class=""></b></p>
												<p>'.$respuesta["fecha_mostrar"].' </p><span class="vertical-timeline-element-date"></span></div>
										</div>
									</div>';
			
		}else {

			$datosPaqueteMostrar1 = "error";

		}

		return $datosPaqueteMostrar1;

	}
	
	#CREAR SOLICITUDES
	#-----------------------------------------------------
	static public function ctrCrearSolicitud(){
	}

	#EDITAR SOLICITUDES
	#-----------------------------------------------------
	static public function ctrEditarSolicitud(){
	}

	#ELIMINAR SOLICITUDES
	#-----------------------------------------------------
	static public function ctrEliminarSolicitud(){
	}


	#SOLICITUDES SIN REVISAR
	#------------------------------------------------------------
	public static function ctrCantidadSolicitudesSinRevisar(){

		$respuesta = ModeloMensajes::mdlSolicitudesSinRevisar("tb_solicitud");

		$sumaRevision = 0;

		foreach ($respuesta as $row => $item) {

			if($item["revision"] == 0){

				++$sumaRevision;	
			}

		}
		
		if($sumaRevision != 0) {

			echo '<a href="solicitudes" class="nav-link">Solicitudes
					<div class="ml-auto badge badge-pill badge-info">'.$sumaRevision.'
					</div>
				  </a>';

		}else{

			echo '<a href="solicitudes" class="nav-link">Solicitudes
				  </a>';

		}

	}

	#SOLICITUDES SIN REVISAR
	#------------------------------------------------------------
	public static function ctrSolicitudesSinRevisar(){

		$respuesta = ModeloMensajes::mdlSolicitudesSinRevisar("tb_solicitud");

		$sumaRevision = 0;

		foreach ($respuesta as $row => $item) {

			if($item["revision"] == 0){

				++$sumaRevision;	
			}

		}
		
		if($sumaRevision != 0) {

			echo '<li class="btn-group nav-item ">
					<a href="solicitudes" class="p-1 mr-0 btn btn-link">
						<span class="icon-wrapper icon-wrapper-alt rounded-circle">
							<span class="icon-wrapper-bg bg-danger"></span>
								<i class="text-danger icon-anim-pulse fas fa-envelope-open-text"></i>
								<span class="badge badge-dot badge-dot-sm badge-danger">1</span>
						</span>
					</a>
				</li>';

		}else{

			echo '<li class="btn-group nav-item ">
					<a href="solicitudes" class="p-1 mr-0 btn btn-link">
						<span class="icon-wrapper icon-wrapper-alt rounded-circle">
							<span class="icon-wrapper-bg bg-primary"></span>
								<i class="fas fa-envelope-open-text"></i>
								<span class="badge badge-dot badge-dot-sm"></span>
						</span>
					</a>
				</li>';

		}

	}

	#SOLICITUDES REVISADOS
	#------------------------------------------------------------
	public static function ctrSolicitudesRevisadasController($datos){

		$datosController = $datos;

		$respuesta = ModeloSolicitudes::mdlSolicitudesRevisadas($datosController, "tb_solicitud");

		echo $respuesta;

	}	


}

