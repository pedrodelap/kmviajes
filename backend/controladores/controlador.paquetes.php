<?php



class ControladorPaquetes{

	#MOSTRAR PAQUETES
	#-----------------------------------------------------
	static public function ctrMostrarPaquetes($item, $valor){

		$tabla = "tb_paquetes";

		$respuesta = ModeloPaquetes::mdlMostrarPaquetes($tabla, $item, $valor);

		return $respuesta;

	}

	#CREAR AEROLINEA
	#-----------------------------------------------------
	static public function ctrCrearPaquete(){

		if(isset($_POST["aerolineaNuevoNombre"])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["aerolineaNuevoCodigo"]) &&
               preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["aerolineaNuevoNombre"]) &&
               preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["aerolineaNuevoTipoPaquete"])){

			   	$tabla = "tb_aerolineas";

				$datos = array("codigo"=>mb_strtoupper($_POST["aerolineaNuevoCodigo"]),
							   "url"=>mb_strtoupper($_POST["aerolineaNuevoURL"]),
							   "compania"=>$_POST["aerolineaNuevoNombre"],
							   "direccion"=>$_POST["aerolineaNuevoDireccion"],
                               "telefono"=>$_POST["aerolineaNuevoTelefono"],
                               "telefono_carga"=>$_POST["aerolineaNuevoTelefonoCarga"],
                               "tipo"=>$_POST["aerolineaNuevoTipoPaquete"]);


			   	$respuesta = ModeloPaquetes::mdlIngresarPaquete($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					Swal.fire({
						  type: "success",
						  title: "La aerolinea ha sido guardada correctamente",
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

	#SELECT PAQUETES
	#-----------------------------------------------------
	static public function ctrSelectPaquetes($valor){

		$tabla = "tb_aerolineas";

		$respuesta = ModeloPaquetes::mdlSelectPaquetes($tabla, $valor);

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

}

