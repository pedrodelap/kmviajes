<?php

class ControladorCampanas{

	#MOSTRAR CAMPAÑAS
	#-----------------------------------------------------
	static public function ctrMostrarCampanas($item, $valor){

		$tabla = "tb_campenias";

		$respuesta = ModeloCampanas::mdlMostrarCampanas($tabla, $item, $valor);

		return $respuesta;

	}

	#SELECT CAMPAÑAS
	#-----------------------------------------------------
	static public function ctrSelectCampanas($valor){

		$tabla = "tb_campenias";

		$respuesta = ModeloCampanas::mdlSelectCampanas($tabla, $valor);

		return $respuesta;

	}	
	
	#CREAR CAMPAÑA
	#-----------------------------------------------------
	static public function ctrCrearCampana(){

		if(isset($_POST["campanaNuevoNombre"])){

			$id_campana = "";

			$foto_corta = "";

			$foto_larga = "";

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["campanaNuevoNombre"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["campanaNuevoDescripcionCorta"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["campanaNuevoDescripcionLarga"]) ){

			   	$tabla = "tb_campenias";

				$arrayCampanaRibbon = $_REQUEST['chklCampanaRibbon'];

				$flag_nuevo = "";

				$flag_oferta = "";

				echo '<script> console.log("array1 :","'.$arrayCampanaRibbon[0].'")</script>';
				echo '<script> console.log("array2 :","'.$arrayCampanaRibbon[1].'")</script>';

				if($arrayCampanaRibbon[0] == ""){

					$arrayCampanaRibbon[0] = "0";

				}

				if($arrayCampanaRibbon[1] == ""){

					$arrayCampanaRibbon[1] = "0";

				}

				// $array[1] == "" ? $flag_oferta = "0": $flag_oferta = "1";
		

				$datos = array("nombre"=>$_POST["campanaNuevoNombre"],
							   "descripcion_corta" => $_POST["campanaNuevoDescripcionCorta"],
							   "descripcion_larga" => $_POST["campanaNuevoDescripcionLarga"],
							   "flag_nuevo"  => $arrayCampanaRibbon[0],
							   "flag_oferta" => $arrayCampanaRibbon[1]);

				   
				$respuesta = ModeloCampanas::mdlIngresarCampana($tabla, $datos);

				if(isset($_FILES["campanaNuevoImagen"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["campanaNuevoImagen"]["tmp_name"]);

					$nuevoAncho = 500;

					$nuevoAlto = 500;
					
					$id_campana = "";

					// ID Campaña
					$id_campana = ModeloCampanas::mdlMaxIdCampana($tabla);

					echo '<script> console.log("$id_campana: ","'.$id_campana.'")</script>';

					$foto_corta = "vistas/images/campana/foto_corta/".$id_campana."_foto_corta.jpeg";

					$foto_larga = "vistas/images/campana/foto_larga/".$id_campana."_foto_larga.jpeg";

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["campanaNuevoImagen"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$origen = imagecreatefromjpeg($_FILES["campanaNuevoImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $foto_corta);

						imagejpeg($destino, $foto_larga);

					}

				}

				$datos =  array("id_campana"=>$id_campana,
								"foto_corta" => $foto_corta,
								"foto_larga" => $foto_larga);

				$respuesta2 = ModeloCampanas::mdlImagenesCampana($tabla, $datos);
		 
			   	if($respuesta2 == "ok"){

					echo'<script>

					Swal.fire({
						  type: "success",
						  title: "El campana ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
						  }).then((result) => {
									if (result.value) {

										window.location = "campanas";
									}
							 })

					</script>';

				}

			}else{

				echo'<script>

					Swal.fire({
						  type: "error",
						  title: "¡El campana no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
						  }).then((result) => {
							if (result.value) {

								window.location = "campanas";
							}
						})

			  	</script>';

			}

		}

	}

	#EDITAR CAMPAÑA
	#-----------------------------------------------------
	static public function ctrEditarCampana(){

		if(isset($_POST["campanaEditarNombres"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["campanaEditarNombres"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["campanaEditarApellidos"]) &&			   
			   preg_match('/^[a-zA-Z. ]+$/', $_POST["campanaEditarTipoDocumento"]) &&
			   preg_match('/^[0-9]+$/', $_POST["campanaEditarNumeroDocumento"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["campanaEditarCorreo"]) &&
			   preg_match('/^[()\-0-9 ]+$/', $_POST["campanaEditarTelefono"])){

			   	$tabla = "tb_campanas";

				$datos = array("id"=>$_POST["idCampana"],
							   "nombres"=>mb_strtoupper($_POST["campanaEditarNombres"]),
							   "apellidos"=>mb_strtoupper($_POST["campanaEditarApellidos"]),
							   "tipo_documento"=>$_POST["campanaEditarTipoDocumento"],
							   "numero_documento"=>$_POST["campanaEditarNumeroDocumento"],
							   "correo"=>mb_strtolower($_POST["campanaEditarCorreo"]),
							   "telefono"=>$_POST["campanaEditarTelefono"],
							   "fecha_nacimiento"=>$_POST["campanaEditarFechaNacimiento"]);

			   	$respuesta = ModeloCampanas::mdlEditarCampana($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					Swal.fire({
						  type: "success",
						  title: "El campana ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
						  }).then((result) => {
									if (result.value) {

										window.location = "campanas";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					Swal.fire({
						  type: "error",
						  title: "¡El campana no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
						  }).then((result) => {
							if (result.value) {

							window.location = "campanas";

							}
						})

			  	</script>';



			}

		}

	}

	#ELIMINAR CAMPAÑA
	#-----------------------------------------------------
	static public function ctrEliminarCampana(){

		if(isset($_GET["idCampana"])){

			$tabla ="tb_campenias";
			$datos = $_GET["idCampana"];

			$respuesta = ModeloCampanas::mdlEliminarCampana($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				Swal.fire({
					  type: "success",
					  title: "El campana ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then((result) => {
								if (result.value) {

								window.location = "campanas";

								}
							})

				</script>';

			}		

		}

	}

}

