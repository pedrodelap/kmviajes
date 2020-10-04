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

	#Enviar Mensajes
	#------------------------------------------------------------
	public static function ctrEnviarMail($datos){

		//echo("<script>console.log('PHP: paso 1');</script>");
		if(isset($datos)){

			//echo("<script>console.log('xxx".$datos["mailTo"]."');</script>");
			$email = $datos["mailTo"];
			$nombre = $datos["nombreCliente"];
			$titulo = $datos["tituloMail"];
			$contenido =$datos["enviarMensaje"];

			$para = $email . ', ';
			$para .= 'rarg15@gmail.com';

			//$título = 'Respuesta a su mensaje';

			$mensaje ='<html>
							<head>
								<title>Respuesta a su Mensaje</title>
							</head>

							<body>
								<h1>Hola '.$nombre.'</h1>
								<p>'.$contenido.'</p>
								<hr>
								KM Viajes y Aventura<br> 
								Lima - Perú</br> 
								WhatsApp: +57 301 391 74 61</br> 
								pedrodelap@gmail.com</p>

								<h3><a href="http://www.kmviajes.com" target="blank">www.kmviajes.com</a></h3>

								<a href="http://www.facebook.com" target="blank"><img src="https://s23.postimg.org/cb2i89a23/facebook.jpg"></a> 
								<a href="http://www.youtube.com" target="blank"><img src="https://s23.postimg.org/mcbxvbciz/youtube.jpg"></a> 
								<a href="http://www.twitter.com" target="blank"><img src="https://s23.postimg.org/tcvcacox7/twitter.jpg"></a> 
								<br>

								<img src="https://s23.postimg.org/dsnyjtesr/unnamed.jpg">
							</body>

					   </html>';

		   $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
		   $cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		   $cabeceras .= 'From: <rarg15@gmail.com>' . "\r\n";

		   $envio = mail($para, $titulo, $mensaje, $cabeceras);
		  
		   

		}

	}

}