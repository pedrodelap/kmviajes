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

		$datosPaqueteMostrar = "";
		
		foreach($respuesta as $row => $item){

			$datosPaqueteMostrar .= '<div class="vertical-timeline-item vertical-timeline-element">
										<div><span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-primary"> </i></span>
											<div class="vertical-timeline-element-content bounce-in">
												<h4 class="timeline-title">'.$item["titulo"].'</h4>
										</div>
									</div>
									<div class="vertical-timeline-item vertical-timeline-element">
										<div><span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-primary"> </i></span>
											<div class="vertical-timeline-element-content bounce-in">
												<h4 class="timeline-title"></h4>
												<p>Aerolínea </p><span class="vertical-timeline-element-date">'.$item["aerolinea_nombre"].'</span></div>
												<p>Ciudad </p><span class="vertical-timeline-element-date">'.$item["ciudad_pais"].'</span></div>
										</div>
									</div>						
									
									<div class="vertical-timeline-item vertical-timeline-element">
										<div><span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-success"> </i></span>
											<div class="vertical-timeline-element-content bounce-in">
												<h4 class="timeline-title">Datos del Paquete</h4>
												<p>Monto en nuevos soles <b class="text-primary">S/. '.$item["precio_sol"].'</b></p>
												<p>Monto en nuevos dolares <b class="text-primary">$ '.$item["precio_dolar"].'</b></p>
												<p>Cantidad Adultos / niños <span class="text-success">'.$item["cantidad_adultos"].' '.$item["cantidad_ninios"].'</span></p><span class="vertical-timeline-element-date"></span></div>
										</div>
									</div>
									<div class="vertical-timeline-item vertical-timeline-element">
										<div><span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-warning"> </i></span>
											<div class="vertical-timeline-element-content bounce-in">
												<p>Fecha de duración del paquete turístico<b class=""></b></p>
												<p>'.$item["fecha_mostrar"].' </p><span class="vertical-timeline-element-date"></span></div>
										</div>
									</div>';
			}

		return $datosPaqueteMostrar;

	}


	
	#CREAR SOLICITUDES
	#-----------------------------------------------------
	static public function ctrCrearSolicitud(){


		if(isset($_POST["hidden_cliente_desde_cotizacion"])){

			$clienteDesdeCotizacion = $_POST["hidden_cliente_desde_cotizacion"];

		}

		if(isset($_POST["clienteNuevoNombres"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["clienteNuevoNombres"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["clienteNuevoApellidos"]) &&			   
			   preg_match('/^[a-zA-Z. ]+$/', $_POST["clienteNuevoTipoDocumento"]) &&
			   preg_match('/^[0-9]+$/', $_POST["clienteNuevoNumeroDocumento"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["clienteNuevoCorreo"]) &&
			   preg_match('/^[()\-0-9 ]+$/', $_POST["clienteNuevoTelefono"])){

			   	$tabla = "tb_clientes";

				$datos = array("nombres"=>mb_strtoupper($_POST["clienteNuevoNombres"]),
							   "apellidos"=>mb_strtoupper($_POST["clienteNuevoApellidos"]),
							   "tipo_documento"=>$_POST["clienteNuevoTipoDocumento"],
							   "numero_documento"=>$_POST["clienteNuevoNumeroDocumento"],
							   "correo"=>mb_strtolower($_POST["clienteNuevoCorreo"]),
							   "telefono"=>$_POST["clienteNuevoTelefono"],
							   "fecha_nacimiento"=>$_POST["clienteNuevoFechaNacimiento"]);


			   	$respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					Swal.fire({
						  type: "success",
						  title: "El cliente ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
						  }).then((result) => {
									if (result.value) {';

										if(isset($_POST["hidden_cliente_desde_cotizacion"])){

											echo'window.location = "cotizacion-crear";';

										} else {

											echo'window.location = "clientes";';

										}
										
								echo'}
								})

					</script>';

				}

			}else{

				echo'<script>

					Swal.fire({
						  type: "error",
						  title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
						  }).then((result) => {
							if (result.value) {';

								if(isset($_POST["hidden_cliente_desde_cotizacion"])){

									echo'window.location = "cotizacion-crear";';

								} else {

									echo'window.location = "clientes";';

								}

						echo'}
						})

			  	</script>';

			}

		}

	}

	#EDITAR SOLICITUDES
	#-----------------------------------------------------
	static public function ctrEditarSolicitud(){

		if(isset($_POST["clienteEditarNombres"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["clienteEditarNombres"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["clienteEditarApellidos"]) &&			   
			   preg_match('/^[a-zA-Z. ]+$/', $_POST["clienteEditarTipoDocumento"]) &&
			   preg_match('/^[0-9]+$/', $_POST["clienteEditarNumeroDocumento"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["clienteEditarCorreo"]) &&
			   preg_match('/^[()\-0-9 ]+$/', $_POST["clienteEditarTelefono"])){

			   	$tabla = "tb_clientes";

				$datos = array("id"=>$_POST["idCliente"],
							   "nombres"=>mb_strtoupper($_POST["clienteEditarNombres"]),
							   "apellidos"=>mb_strtoupper($_POST["clienteEditarApellidos"]),
							   "tipo_documento"=>$_POST["clienteEditarTipoDocumento"],
							   "numero_documento"=>$_POST["clienteEditarNumeroDocumento"],
							   "correo"=>mb_strtolower($_POST["clienteEditarCorreo"]),
							   "telefono"=>$_POST["clienteEditarTelefono"],
							   "fecha_nacimiento"=>$_POST["clienteEditarFechaNacimiento"]);

			   	$respuesta = ModeloClientes::mdlEditarCliente($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					Swal.fire({
						  type: "success",
						  title: "El cliente ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
						  }).then((result) => {
									if (result.value) {

										window.location = "clientes";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					Swal.fire({
						  type: "error",
						  title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
						  }).then((result) => {
							if (result.value) {

							window.location = "clientes";

							}
						})

			  	</script>';



			}

		}

	}

	#ELIMINAR SOLICITUDES
	#-----------------------------------------------------
	static public function ctrEliminarSolicitud(){

		if(isset($_GET["idCliente"])){

			$tabla ="tb_clientes";
			$datos = $_GET["idCliente"];

			$respuesta = ModeloClientes::mdlEliminarCliente($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				Swal.fire({
					  type: "success",
					  title: "El cliente ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then((result) => {
								if (result.value) {

								window.location = "clientes";

								}
							})

				</script>';

			}		

		}

	}

}

