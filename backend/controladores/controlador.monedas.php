<?php

class ControladorMonedas{

	#MOSTRAR MONEDAS
	#-----------------------------------------------------	
	static public function ctrMostrarMonedas($item, $valor){

		$tabla = "tb_monedas";

		$respuesta = ModeloMonedas::mdlMostrarMonedas($tabla, $item, $valor);

		return $respuesta;

	}

	#CREAR MONEDAS
	#-----------------------------------------------------	
	static public function ctrCrearMoneda(){

		if(isset($_POST["monedaNuevoNombre"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["monedaNuevoNombre"]) &&			   			   
			   preg_match('/^[0-9,.]+$/', $_POST["monedaNuevoCompra"]) &&
			   preg_match('/^[0-9,.]+$/', $_POST["monedaNuevoVenta"]) ){

				$tabla = "tb_monedas";

				$datos = array("nombre"=>mb_strtoupper($_POST["monedaNuevoNombre"]),
							   "simbolo"=>mb_strtoupper($_POST["monedaNuevoSimbolo"]),
							   "compra"=>str_replace(",", ".", $_POST["monedaNuevoCompra"]), 
							   "venta"=>str_replace(",", ".", $_POST["monedaNuevoVenta"]));

			   	$respuesta = ModeloMonedas::mdlIngresarMoneda($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					Swal.fire({
						  type: "success",
						  title: "La moneda ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
						  }).then((result) => {
									if (result.value) {

										window.location = "monedas";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					Swal.fire({
						  type: "error",
						  title: "¡La moneda no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
						  }).then((result) => {
							if (result.value) {

								window.location = "monedas";

							}
						})

			  	</script>';

			}

		}

	}

	#EDITAR MONEDA
	#-----------------------------------------------------	
	static public function ctrEditarMoneda(){

		if(isset($_POST["monedaEditarNombre"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["monedaEditarNombre"]) &&			   			   
				preg_match('/^[0-9,.]+$/', $_POST["monedaEditarCompra"]) &&
				preg_match('/^[0-9,.]+$/', $_POST["monedaEditarVenta"])){

			   	$tabla = "tb_monedas";

				$datos = array("id"=>$_POST["idMoneda"],
							   "nombre"=>mb_strtoupper($_POST["monedaEditarNombre"]),
							   "simbolo"=>mb_strtoupper($_POST["monedaEditarSimbolo"]),
							   "compra"=>str_replace(",", ".", $_POST["monedaEditarCompra"]), 
							   "venta"=>str_replace(",", ".", $_POST["monedaEditarVenta"]));

			   	$respuesta = ModeloMonedas::mdlEditarMoneda($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					Swal.fire({
						  type: "success",
						  title: "La moneda ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
						  }).then((result) => {
									if (result.value) {

										window.location = "monedas";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					Swal.fire({
						  type: "error",
						  title: "¡La moneda no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
						  }).then((result) => {
							if (result.value) {

							window.location = "monedas";

							}
						})

			  	</script>';



			}

		}

	}

	#ELIMINAR MONEDA
	#-----------------------------------------------------	
	static public function ctrEliminarMoneda(){

		if(isset($_GET["idMoneda"])){

			$tabla ="tb_monedas";
			$datos = $_GET["idMoneda"];

			$respuesta = ModeloMonedas::mdlEliminarMoneda($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				Swal.fire({
					  type: "success",
					  title: "La moneda ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then((result) => {
								if (result.value) {

								window.location = "monedas";

								}
							})

				</script>';

			}		

		}

	}

}

