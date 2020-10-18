<?php

class ControladorAeropuertos{

	/*=============================================
	MOSTRAR AEROPUERTOS
	=============================================*/

	static public function ctrMostrarAeropuertos($item, $valor){

		$tabla = "tb_aeropuertos";

		$respuesta = ModeloAeropuertos::mdlMostrarAeropuertos($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	SELECT AEROPUERTOS
	=============================================*/

	static public function ctrSelectAeropuertos($valor){

		$tabla = "tb_aeropuertos";

		$respuesta = ModeloAeropuertos::mdlSelectAeropuertos($tabla, $valor);

		return $respuesta;

	}

	/*=============================================
	SELECT AEROPUERTOS POR ID
	=============================================*/

	static public function ctrSelectAeropuertosPorId($valor){

		$tabla = "tb_aeropuertos";

		$respuesta = ModeloAeropuertos::mdlSelectAeropuertosPorId($tabla, $valor);

		return $respuesta;

	}



	/*=============================================
	ELIMINAR AEROPUERTO
	=============================================*/

	static public function ctrEliminarAeropuerto(){

		if(isset($_GET["idAeropuerto"])){

			$tabla ="tb_aeropuertos";
			$datos = $_GET["idAeropuerto"];

			$respuesta = ModeloAeropuertos::mdlEliminarAeropuerto($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				Swal.fire({
					  type: "success",
					  title: "La aeropuerto ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then((result) => {
								if (result.value) {

								window.location = "aeropuertos";

								}
							})

				</script>';

			}		

		}

	}

}

