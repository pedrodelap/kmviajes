<?php

class MensajesController{

	public static function registroMensajesController(){

		if(isset($_POST["nombres"])){

			if(preg_match('/^[a-zA-Z\s]+$/', $_POST["nombres"]))
			{ 
			   
			   	#ENVIAR EL CORREO ELECTRÓNICO
			   	#------------------------------------------------------
			   	#mail(Correo destino, asunto del mensaje, mensaje, cabecera del correo);
				
				$correoDestino = "pedrodelap@gmail.com";
				$asunto = "Mensaje de la web";
				$mensaje = "Nombre: ".$_POST["nombres"]."\n"."\n".
						   "Email: ".$_POST["email"]."\n"."\n".
                           "Mensaje: ".$_POST["mensaje"]."\n";

                $cabecera = "From: Sitio web" . "\r\n" .
                "CC: ".$_POST['email'];

				
			   	$envio = mail($correoDestino, $asunto, $mensaje, $cabecera);
				
			   	$datosController = array("nombre"=>$_POST["nombres"],
										 "telefono"=>$_POST["telefono"],
										 "email"=>$_POST["email"],
										 "asunto"=>$_POST["asunto"],
										 "mensaje"=>$_POST["mensaje"]);

			   	#ALMACENAR EN BASE DE DATOS EL SUSCRIPTOR
			   	#-------------------------------------------------------

				$datosSuscriptor = $_POST["email"];
				   
			   	$revisarSuscriptor = MensajesModel::revisarSuscriptorModel($datosSuscriptor, "tb_suscriptores");

				if($revisarSuscriptor == 0 ){

			   		MensajesModel::registroSuscriptoresModel($datosController, "tb_suscriptores");

			   	}
 
			   	#ALMACENAR EN BASE DE DATOS EL MENSAJE
			   	#-------------------------------------------------------  

			   $respuesta = MensajesModel::registroMensajesModel($datosController, "tb_mensajes");	

			   
			   if($envio == true && $respuesta == "ok"){
				
					echo'<script>

						Swal.fire({
							type: "success",
							title: "¡OK!",
							text: "¡El mensaje ha sido enviado correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then((result) => {
										if (result.value) {
										}
									})

					</script>';

				}


			}

			else{

				echo '<div class="alert alert-danger">¡No se puedo enviar el mensaje, debe completar los campos.!</div>';

			}


		}

	}
}