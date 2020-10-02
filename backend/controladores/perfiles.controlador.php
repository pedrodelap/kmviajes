<?php

class ControladorPerfiles{

	#GUARDAR PERFIL
	#------------------------------------------------------------
	public static function nuevoUsuarioController(){

		$ruta = "";

		if(isset($_POST["nuevoUsuario"])){	

			if(isset($_FILES["nuevaImagen"]["tmp_name"])){

				$imagen = $_FILES["nuevaImagen"]["tmp_name"];

				$aleatorio = mt_rand(100, 999);

				$ruta = "vistas/assets/images/perfiles/perfil".$aleatorio.".jpg";
				         

				$origen = imagecreatefromjpeg($imagen);

				$destino = imagecrop($origen, ["x"=>0, "y"=>0, "width"=>100, "height"=>100]);

				imagejpeg($destino, $ruta);

			}

			if($ruta == ""){

				$ruta = "vistas/assets/images/perfiles/photo.jpg";

			}

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"])&&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["nuevoEmail"])){

				$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$datosController = array("usuario"=>$_POST["nuevoUsuario"],
									     "nombre"=>$_POST["nuevoNombre"],
										 "password"=>$encriptar,
										 "email"=>$_POST["nuevoEmail"],
										 "perfil"=>$_POST["nuevoPerfil"],
										 "foto"=> $ruta);

				$respuesta = PerfilesModel::guardarPerfilModel($datosController, "tb_usuarios");

				if($respuesta == "ok"){

					echo'<script>

						Swal.fire({
							  title: "¡OK!",
							  text: "¡El usuario ha sido creado correctamente!",
							  icon: "success",
							  confirmButtonText: "Cerrar",
							  closeOnConfirm: false
							}).then((result) => {
								 if (isConfirm) {	   
								    window.location = "perfil";
								  } 
						});


					</script>';

				}

			}

			else{

				echo '<div class="alert alert-warning"><b>¡ERROR!</b> No ingrese caracteres especiales</div>';
			}

		}

	}

	#VISUALIZAR LOS PERFILES
	#------------------------------------------------------------

	public static function verPerfilesController(){

		$respuesta = PerfilesModel::verPerfilesModel("tb_usuarios");

		foreach($respuesta as $row => $item){
      
			echo ' <tr>
			        <td>'.$item["id_usuario"].'</td>
			        <td>'.$item["perfil"].'</td>
			        <td>'.$item["correo"].'</td>
					<td>
						<a href="#perfil'.$item["id_usuario"].'" data-toggle="modal"><span class="btn btn-info fa fa-edit"></span></a>

						<a href="index.php?ruta=perfil&idBorrarUsuario='.$item["id_usuario"].'&borrarImg='.$item["foto"].'"><span class="btn btn-danger fa fa-times"></span></a>
					</td>
			      </tr>

				  <!-- Modal -->
				  <div class="modal fade modalEdtarPerfiles" id="perfil'.$item["id_usuario"].'" tabindex="-1" role="dialog" aria-labelledby="perfil'.$item["id_usuario"].'ModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
						  <div class="modal-content">
							  <div class="modal-header">
								  <h5 class="modal-title" id="perfil'.$item["id_usuario"].'ModalLabel">Editar Usuario</h5>
								  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									  <span aria-hidden="true">&times;</span>
								  </button>
							  </div>
							  <form style="padding:20px" method="post" enctype="multipart/form-data">
								<div class="modal-body">

										<input name="editarId" type="hidden" value="'.$item["id_usuario"].'">
									
										<div class="form-group">
										
											<input name="editarUsuario" type="text" class="form-control" value="'.$item["usuario"].'" required>

										</div>

										<div class="form-group">
										
											<input name="editarNombre" type="text" class="form-control" value="'.$item["nombres"].'" required>

										</div>                                        

										<div class="form-group">

											<input name="editarPassword" type="password" placeholder="Ingrese la Contraseña hasta 10 caracteres" maxlength="10" class="form-control" required>

										</div>

										<div class="form-group">

											<input name="editarEmail" type="email" value="'.$item["correo"].'" class="form-control" required>

										</div>

										<div class="form-group">

											<select name="editarPerfil" class="form-control" required>
												<option value="" selected>Seleccione el Rol</option>
												<option value="Administrador">Administrador</option>
												<option value="Editor">Editor</option>
											</select>

										</div>

										<div class="form-group text-center">

											<img src="'.$item["foto"].'" width="10%" class="rounded-circle">

											<input type="hidden" value="'.$item["foto"].'" name="editarFoto">
											
											<input type="file" class="btn btn-default" id="cambiarFotoPerfil" style="display:inline-block; margin:10px 0">

											<p class="text-center" style="font-size:12px">Tamaño recomendado de la imagen: 100px * 100px, peso máximo 2MB</p>

										</div>

								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
									<input type="submit" id="guardarPerfil" value="Actualizar Perfil" class="btn btn-primary">
								</div>
							  </form>
						  </div>
					  </div>
				  </div>';


		}

	}

	#EDITAR PERFIL
	#------------------------------------------------------------

	public static function editarUsuarioController(){

		echo'<script> console.log("editarFoto : editarFoto"); </script>';

		$ruta = "";

		if(isset($_POST["editarId"])){

			if(isset($_FILES["editarFoto"]["tmp_name"])){	

				echo'<script> console.log("editarFoto : editarFotorTmpName"); </script>';
				
				$imagen = $_FILES["editarFoto"]["tmp_name"];

				$aleatorio = mt_rand(100, 999);

				$ruta = "vistas/assets/images/perfiles/perfil".$aleatorio.".jpg";

				$origen = imagecreatefromjpeg($imagen);

				$destino = imagecrop($origen, ["x"=>0, "y"=>0, "width"=>100, "height"=>100]);

				imagejpeg($destino, $ruta);

				echo'<script> console.log("editarFoto : editarFoto"); </script>';

			}


			if($ruta == ""){

				$ruta = $_POST["editarFoto"];
			}

			if($ruta != "" && $_POST["editarFoto"] != "vistas/assets/images/perfiles/photo.jpg"){

				unlink($_POST["editarFoto"]);
			
			}

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarUsuario"]) && 
			   preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["editarNombre"]) && 
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editarEmail"])){


				$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$datosController = array("id"=>$_POST["editarId"],
										 "usuario"=>$_POST["editarUsuario"],
										 "nombre"=>$_POST["editarNombre"],
										 "email"=>$_POST["editarEmail"],
						                 "password"=>$encriptar,						                 
						                 "perfil"=>$_POST["editarPerfil"],
					 	                 "foto"=>$ruta);

				// echo'<script> console.log("editarId : ","'.$_POST["editarId"].'"); </script>';

				$respuesta = PerfilesModel::editarPerfilModel($datosController, "tb_usuarios");

				if($respuesta == "ok"){

					if(isset($_POST["actualizarSesion"])){

						$_SESSION["id"] = $_POST["editarId"];
						$_SESSION["usuario"] = $_POST["editarUsuario"];
						$_SESSION["nombre"] = $_POST["editarNombre"];
						$_SESSION["password"] = $encriptar;
						$_SESSION["email"] = $_POST["editarEmail"];
						$_SESSION["foto"] = $ruta;
						$_SESSION["perfil"] = $_POST["editarPerfil"];


					}

					echo'<script>

						Swal.fire({
							  title: "¡OK!",
							  text: "¡El usuario ha sido editado correctamente!",
							  icon: "success",
							  confirmButtonText: "Cerrar",
							  closeOnConfirm: false
						 }).then((result) => {
								if (result.value) {
									window.location = "perfil";
								}
						});

					</script>';

				}

				else{

					echo '<div class="alert alert-warning"><b>¡ERROR!</b> No ingrese caracteres especiales</div>';
				}
				

			}



		}

	}

	#BORRAR PERFIL
	#------------------------------------------------------------

	public static function borrarPerfilController(){

		
		if(isset($_GET["idBorrarUsuario"])){

			$datosController = $_GET["idBorrarUsuario"];

			if($_GET["borrarImg"] != 'vistas/assets/images/perfiles/photo.jpg'){

				unlink($_GET["borrarImg"]);

			}

			$respuesta = PerfilesModel::borrarPerfilModel($datosController, "tb_usuarios");

			if($respuesta == "ok"){

					echo'<script>

					Swal.fire({
						  title: "¡OK!",
						  text: "¡El usuario se ha borrado correctamente!",
						  icon: "success",
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
					}).then((result) => {
							if (result.value) {
								window.location = "perfil";
							}
					});

				</script>';

			}

		}


	}


}