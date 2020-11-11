<?php

class ControladorHoteles{

	#MOSTRAR HOTELES
	#-----------------------------------------------------
	static public function ctrMostrarHoteles($item, $valor){

		$tabla = "tb_hoteles";

		$respuesta = ModeloHoteles::mdlMostrarHoteles($tabla, $item, $valor);

		return $respuesta;

	}

	#SELECT HOTELES
	#-----------------------------------------------------
	static public function ctrSelectHoteles($valor){

		$tabla = "tb_hoteles";

		$respuesta = ModeloHoteles::mdlSelectHoteles($tabla, $valor);

		return $respuesta;

	}	
	
	#CREAR HOTELES
	#-----------------------------------------------------
	static public function ctrCrearHotel(){


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

			   	$tabla = "tb_hoteles";

				$datos = array("nombres"=>mb_strtoupper($_POST["clienteNuevoNombres"]),
							   "apellidos"=>mb_strtoupper($_POST["clienteNuevoApellidos"]),
							   "tipo_documento"=>$_POST["clienteNuevoTipoDocumento"],
							   "numero_documento"=>$_POST["clienteNuevoNumeroDocumento"],
							   "correo"=>mb_strtolower($_POST["clienteNuevoCorreo"]),
							   "telefono"=>$_POST["clienteNuevoTelefono"],
							   "fecha_nacimiento"=>$_POST["clienteNuevoFechaNacimiento"]);


			   	$respuesta = ModeloHoteles::mdlIngresarHotel($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					Swal.fire({
						  type: "success",
						  title: "El hotel ha sido guardado correctamente",
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
						  title: "¡El hotel no puede ir vacío o llevar caracteres especiales!",
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

	#EDITAR CLIENTE
	#-----------------------------------------------------
	static public function ctrEditarHotel(){

		if(isset($_POST["clienteEditarNombres"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["clienteEditarNombres"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["clienteEditarApellidos"]) &&			   
			   preg_match('/^[a-zA-Z. ]+$/', $_POST["clienteEditarTipoDocumento"]) &&
			   preg_match('/^[0-9]+$/', $_POST["clienteEditarNumeroDocumento"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["clienteEditarCorreo"]) &&
			   preg_match('/^[()\-0-9 ]+$/', $_POST["clienteEditarTelefono"])){

			   	$tabla = "tb_hoteles";

				$datos = array("id"=>$_POST["idHotel"],
							   "nombres"=>mb_strtoupper($_POST["clienteEditarNombres"]),
							   "apellidos"=>mb_strtoupper($_POST["clienteEditarApellidos"]),
							   "tipo_documento"=>$_POST["clienteEditarTipoDocumento"],
							   "numero_documento"=>$_POST["clienteEditarNumeroDocumento"],
							   "correo"=>mb_strtolower($_POST["clienteEditarCorreo"]),
							   "telefono"=>$_POST["clienteEditarTelefono"],
							   "fecha_nacimiento"=>$_POST["clienteEditarFechaNacimiento"]);

			   	$respuesta = ModeloHoteles::mdlEditarHotel($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					Swal.fire({
						  type: "success",
						  title: "El hotel ha sido cambiado correctamente",
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
						  title: "¡El hotel no puede ir vacío o llevar caracteres especiales!",
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

	#ELIMINAR CLIENTE
	#-----------------------------------------------------
	static public function ctrEliminarHotel(){

		if(isset($_GET["idHotel"])){

			$tabla ="tb_hoteles";
			$datos = $_GET["idHotel"];

			$respuesta = ModeloHoteles::mdlEliminarHotel($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				Swal.fire({
					  type: "success",
					  title: "El hotel ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then((result) => {
								if (result.value) {

								window.location = "hoteles";

								}
							})

				</script>';

			}		

		}

	}

}

