<?php

class ControladorUsuarios{

	#INGRESO DE USUARIO
	#------------------------------------------------------------	
	public static function ctrIngresoUsuario(){

		if(isset($_POST["ingUsuario"])){

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])){

				$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$tabla = "tb_usuarios";
				$item = "usuario";
				$valor = $_POST["ingUsuario"];

				$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

				if($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] == $encriptar){

					if($respuesta["estado"] == 1){

						$_SESSION["iniciarSesion"] = "ok";
						$_SESSION["id_usuario"] = $respuesta["id_usuario"];
						$_SESSION["nombres"] = $respuesta["nombres"];
						$_SESSION["apellidos"] = $respuesta["apellidos"];
						$_SESSION["usuario"] = $respuesta["usuario"];
						$_SESSION["correo"] = $respuesta["correo"];
						$_SESSION["foto"] = $respuesta["foto"];
						$_SESSION["perfil"] = $respuesta["perfil"];

						/*=============================================
						REGISTRAR FECHA PARA SABER EL ÚLTIMO LOGIN
						=============================================*/

						date_default_timezone_set('America/Lima');

						$fecha = date('Y-m-d');
						$hora = date('H:i:s');

						$fechaActual = $fecha.' '.$hora;

						$item1 = "ultimo_login";
						$valor1 = $fechaActual;

						$item2 = "id_usuario";
						$valor2 = $respuesta["id_usuario"];

						$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

						if($ultimoLogin == "ok"){

							if($_SESSION["perfil"] == "Administrador"){

								echo '<script>

									window.location = "inicio";

								</script>';

							}else if($_SESSION["perfil"] == "Vendedor"){

								echo '<script>

									window.location = "ventas";

								</script>';

							}else{

								echo '<script>

									window.location = "inicio";

								</script>';

							}		

						}				
						
					}else{
						echo '<br><div class="alert alert-danger" role="alert">El usuario aún no está activado.</div>';						

					}		

				}else{
					echo '<br><div class="alert alert-danger" role="alert"><strong>Error al ingresar!,</strong> vuelve a intentarlo.</div>';
				}

			}	

		}

	}

	#REGISTRO DE USUARIO
	#------------------------------------------------------------	
	public static function ctrCrearUsuario(){

		if(isset($_POST["nuevoUsuario"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])){

			   	/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = "";

				if(isset($_FILES["nuevaFoto"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/usuarios/".$_POST["nuevoUsuario"];

					mkdir($directorio, 0755);

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["nuevaFoto"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tabla = "usuarios";

				$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$datos = array("nombre" => $_POST["nuevoNombre"],
					           "usuario" => $_POST["nuevoUsuario"],
					           "password" => $encriptar,
					           "perfil" => $_POST["nuevoPerfil"],
					           "foto"=>$ruta);

				$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);
			
				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El usuario ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){
						
							window.location = "usuarios";

						}

					});
				

					</script>';


				}	


			}else{

				echo '<script>

					swal({

						type: "error",
						title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){
						
							window.location = "usuarios";

						}

					});
				

				</script>';

			}


		}


	}

	#MOSTRAR USUARIO
	#------------------------------------------------------------	
	public static function ctrMostrarUsuarios($item, $valor){

		$tabla = "tb_usuarios";

		$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

		return $respuesta;
	}

	#EDITAR USUARIO
	#------------------------------------------------------------	
	public static function ctrEditarUsuario(){

		if(isset($_POST["editarUsuario"])){

			echo'<script> console.log("ctrEditarUsuario : true"); </script>';

			if(preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["editarUsuario"]) && 
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"]) && 
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarApellido"]) && 
			   preg_match('/^[0-9 ]+$/', $_POST["editarTelefono"]) && 
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editarEmail"])){
				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = $_POST["fotoActual"];

				if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){

					echo'<script> console.log("1er If"); </script>';

					list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);
				
					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/images/usuarios/".$_POST["editarUsuario"]."" ;

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["fotoActual"])){

						unlink($_POST["fotoActual"]);

					}else{

						mkdir($directorio, 0755);

					}

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["editarFoto"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$ruta = "vistas/images/usuarios/".$_POST["editarUsuario"].".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["editarFoto"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$ruta = "vistas/images/usuarios/".$_POST["editarUsuario"].".png";

						$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tabla = "tb_usuarios";

				if( preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){

					$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

					$tabla = "tb_usuarios";
					$item = "id_usuario";
					$valor = $_SESSION["id_usuario"];
	
					$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);
	
					if($respuesta["password"] == $encriptar){

						echo'<script> console.log("password correcto"); </script>';
						echo'<script> console.log("'.$respuesta["password"].'"); </script>';

						if($_POST["editarPasswordNuevo"] != "" ){

							if( preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPasswordNuevo"])){

								$encriptar = crypt($_POST["editarPasswordNuevo"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

							} else {

								echo'<script>
							
								Swal.fire({
									  type: "error",
									  title: "¡La nueva contraseña no puede ir vacía o llevar caracteres especiales!",
									  showConfirmButton: true,
									  confirmButtonText: "Cerrar",
									  closeOnConfirm: false
									  }).then((result) => {
												if (result.value) {
							
													window.location = "perfil";
							
												}
											})
							
								</script>';
							
							}
						
						}

						$tabla = "tb_usuarios";

						$datos = array("id" => $_POST["editarId"],
									   "nombres" => $_POST["editarNombre"],
									   "apellidos" => $_POST["editarApellido"],
									   "usuario" => $_POST["editarUsuario"],
									   "password" => $encriptar,
									   "perfil" => $_POST["editarPerfilCbx"],
									   "tipo_documento" => $_POST["editarTipoDocumentoCbx"],
									   "numero_documento" => $_POST["editarNumeroDocumento"],
									   "telefono" => $_POST["editarTelefono"],
									   "correo" => $_POST["editarEmail"],
									   "foto" => $ruta);

						$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

						if($respuesta == "ok"){

							if($_POST["actualizarSesion"] == "ok"){

								$_SESSION["nombres"] = $_POST["editarNombre"];
								$_SESSION["apellidos"] = $_POST["editarApellido"];
								$_SESSION["usuario"] = $_POST["editarUsuario"];
								$_SESSION["correo"] = $_POST["editarEmail"];
								$_SESSION["foto"] = $ruta;
								$_SESSION["perfil"] = $_POST["editarPerfilCbx"];

							}

							echo'<script>
							
								Swal.fire({
									type: "success",
									title: "¡El usuario ha sido editado correctamente!",
									showConfirmButton: true,
									confirmButtonText: "Cerrar",
									closeOnConfirm: false
									}).then((result) => {
											if (result.value) {
						
												window.location = "perfil";
						
											}
										})
					  
						  	</script>';
							
						}

					} else {

						echo'<script>
					
						Swal.fire({
							  type: "error",
							  title: "¡La contraseña es incorrecta!",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar",
							  closeOnConfirm: false
							  }).then((result) => {
										if (result.value) {
					
											window.location = "perfil";
					
										}
									})
					
						</script>';
					
					}

				} else {

					echo'<script>
				
					Swal.fire({
						  type: "error",
						  title: "¡La contraseña no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
						  }).then((result) => {
									if (result.value) {
				
										window.location = "perfil";
				
									}
								})
				
					</script>';
				
				}
			
			}else{

				echo'<script>

				  Swal.fire({
					type: "error",
					title: "¡Los datos no pueden vacíos o llevar caracteres especiales!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
					}).then((result) => {
							  if (result.value) {

								window.location = "perfil";

							  }
						  })

			  	</script>';

			}

		}

	}	

	#BORRAR USUARIO
	#------------------------------------------------------------	
	public static function ctrBorrarUsuario(){

		if(isset($_GET["idUsuario"])){

			$tabla ="tb_usuarios";
			$datos = $_GET["idUsuario"];

			/*
			if($_GET["fotoUsuario"] != ""){

				unlink($_GET["fotoUsuario"]);
				rmdir('vistas/img/usuarios/'.$_GET["usuario"]);

			}*/

			echo'<script> console.log("ruta'.$_GET["ruta"].'"); </script>';

			$respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					Swal.fire({
							title: "¡OK!",
							text: "¡El usuario se ha borrado correctamente!",
							icon: "success",
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then((result) => {
								if (result.value) {';

									if(isset($_GET["ruta"])){

										echo 'window.location = "usuarios";';

									} else {

										echo 'window.location = "perfil";';

									}
							echo'}
						});

				</script>';

			}

		}

	}	

}
	

