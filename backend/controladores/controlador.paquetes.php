<?php

class ControladorPaquetes{

	#MOSTRAR PAQUETES
	#-----------------------------------------------------
	static public function ctrMostrarPaquetes($item, $valor){

		$tabla = "tb_paquetes";

		$respuesta = ModeloPaquetes::mdlMostrarPaquetes($tabla, $item, $valor);

		return $respuesta;

	}

	#CREAR PAQUETE
	#-----------------------------------------------------
	static public function ctrCrearPaquete($datos){

		$tabla = "tb_paquetes";

		$respuesta = ModeloPaquetes::mdlCrearPaquetes($tabla, $datos);

		return $respuesta;

	}

	#CREAR PAQUETE x CAMPANA
	#-----------------------------------------------------
	static public function ctrCrearPaquetexCampana($datos){

		$tabla = "tb_campanias_x_paquetes";

		$respuesta = ModeloPaquetes::mdlCrearPaquetexCampana($tabla, $datos);

		return $respuesta;

	}

	#SELECT PAQUETES
	#-----------------------------------------------------
	static public function ctrSelectPaquetes($valor){

		$tabla = "tb_aerolineas";

		$respuesta = ModeloPaquetes::mdlSelectPaquetes($tabla, $valor);

		return $respuesta;

	}


	#SELECT CIUDADES
	#-----------------------------------------------------
	static public function ctrSelectCiudades($valor){

		$tabla = "tb_ciudades";

		$respuesta = ModeloPaquetes::mdlSelectCiudades($tabla, $valor);

		return $respuesta;

	}

	#EDITAR AEROLINEA
	#-----------------------------------------------------
	static public function ctrEditarPaquete(){

		if(isset($_POST["aerolineaEditarNombre"])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["aerolineaEditarCodigo"]) &&
               preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["aerolineaEditarNombre"]) &&
               preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["aerolineaEditarTipoPaquete"])){

			   	$tabla = "tb_aerolineas";

				$datos = array("id"=>mb_strtoupper($_POST["idPaquete"]),
                               "codigo"=>mb_strtoupper($_POST["aerolineaEditarCodigo"]),
							   "url"=>mb_strtoupper($_POST["aerolineaEditarURL"]),
							   "compania"=>$_POST["aerolineaEditarNombre"],
							   "direccion"=>$_POST["aerolineaEditarDireccion"],
                               "telefono"=>$_POST["aerolineaEditarTelefono"],
                               "telefono_carga"=>$_POST["aerolineaEditarTelefonoCarga"],
                               "tipo"=>$_POST["aerolineaEditarTipoPaquete"]);


			   	$respuesta = ModeloPaquetes::mdlEditarPaquete($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					Swal.fire({
						  type: "success",
						  title: "El aerolinea ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
						  }).then((result) => {
									if (result.value) {

										window.location = "PAQUETES";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					Swal.fire({
						  type: "error",
						  title: "La aerolinea no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
						  }).then((result) => {
							if (result.value) {

							window.location = "PAQUETES";

							}
						})

			  	</script>';

			}

		}

	}

	#ELIMINAR AEROLINEA
	#-----------------------------------------------------
	static public function ctrEliminarPaquete(){

		if(isset($_GET["idPaquete"])){

			$tabla ="tb_aerolineas";
			$datos = $_GET["idPaquete"];

			$respuesta = ModeloPaquetes::mdlEliminarPaquete($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				Swal.fire({
					  type: "success",
					  title: "La aerolinea ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then((result) => {
								if (result.value) {

								window.location = "PAQUETES";

								}
							})

				</script>';

			}		

		}

	}

	#CREAR PAQUETE x IMAGES
	#-----------------------------------------------------
	static public function ctrCrearPaquetexImages($datos){

		$tabla = "tb_imagenes_paquete";

		$respuesta = ModeloPaquetes::mdlCrearPaquetexImages($tabla, $datos);

		return $respuesta;

	}


	#CREAR PAQUETE x SERVICIOS
	#-----------------------------------------------------
	static public function ctrCrearServiciosDePaquete($idPaquete, $servicioArray){

		$tabla = "tb_servicios_x_paquetes";

		$id = $idPaquete;

		$respuesta = "";

		$array = explode(",", $servicioArray);

		foreach ($array as $valor) {

			$respuesta = ModeloPaquetes::mdlCrearPaquetexServicios($tabla, $id, $valor);

		}

		return $respuesta;

	}

}

