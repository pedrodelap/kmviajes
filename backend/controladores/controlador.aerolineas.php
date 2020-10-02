<?php

class ControladorAerolineas{

	#MOSTRAR AEROLINEAS
	#-----------------------------------------------------
	static public function ctrMostrarAerolineas($item, $valor){

		$tabla = "tb_aerolineas";

		$respuesta = ModeloAerolineas::mdlMostrarAerolineas($tabla, $item, $valor);

		return $respuesta;

	}

	#CREAR AEROLINEA
	#-----------------------------------------------------
	static public function ctrCrearAerolinea(){

		if(isset($_POST["aerolineaNuevoNombre"])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["aerolineaNuevoCodigo"]) &&
               preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["aerolineaNuevoNombre"]) &&
               preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["aerolineaNuevoTipoAerolinea"])){

			   	$tabla = "tb_aerolineas";

				$datos = array("codigo"=>mb_strtoupper($_POST["aerolineaNuevoCodigo"]),
							   "url"=>mb_strtoupper($_POST["aerolineaNuevoURL"]),
							   "compania"=>$_POST["aerolineaNuevoNombre"],
							   "direccion"=>$_POST["aerolineaNuevoDireccion"],
                               "telefono"=>$_POST["aerolineaNuevoTelefono"],
                               "telefono_carga"=>$_POST["aerolineaNuevoTelefonoCarga"],
                               "tipo"=>$_POST["aerolineaNuevoTipoAerolinea"]);


			   	$respuesta = ModeloAerolineas::mdlIngresarAerolinea($tabla, $datos);

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

										window.location = "aerolineas";

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

								window.location = "aerolineas";

							}
						})

			  	</script>';

			}

		}

	}

	#SELECT AEROLINEAS
	#-----------------------------------------------------
	static public function ctrSelectAerolineas($valor){

		$tabla = "tb_aerolineas";

		$respuesta = ModeloAerolineas::mdlSelectAerolineas($tabla, $valor);

		return $respuesta;

	}

	#EDITAR AEROLINEA
	#-----------------------------------------------------
	static public function ctrEditarAerolinea(){

		if(isset($_POST["aerolineaEditarNombre"])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["aerolineaEditarCodigo"]) &&
               preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["aerolineaEditarNombre"]) &&
               preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["aerolineaEditarTipoAerolinea"])){

			   	$tabla = "tb_aerolineas";

				$datos = array("id"=>mb_strtoupper($_POST["idAerolinea"]),
                               "codigo"=>mb_strtoupper($_POST["aerolineaEditarCodigo"]),
							   "url"=>mb_strtoupper($_POST["aerolineaEditarURL"]),
							   "compania"=>$_POST["aerolineaEditarNombre"],
							   "direccion"=>$_POST["aerolineaEditarDireccion"],
                               "telefono"=>$_POST["aerolineaEditarTelefono"],
                               "telefono_carga"=>$_POST["aerolineaEditarTelefonoCarga"],
                               "tipo"=>$_POST["aerolineaEditarTipoAerolinea"]);


			   	$respuesta = ModeloAerolineas::mdlEditarAerolinea($tabla, $datos);

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

										window.location = "aerolineas";

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

							window.location = "aerolineas";

							}
						})

			  	</script>';



			}

		}

	}

	#ELIMINAR AEROLINEA
	#-----------------------------------------------------
	static public function ctrEliminarAerolinea(){

		if(isset($_GET["idAerolinea"])){

			$tabla ="tb_aerolineas";
			$datos = $_GET["idAerolinea"];

			$respuesta = ModeloAerolineas::mdlEliminarAerolinea($tabla, $datos);

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

								window.location = "aerolineas";

								}
							})

				</script>';

			}		

		}

	}

}

