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
							<table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee">
							<tbody>
								<tr>
									<td>
										<table align="center" width="750px" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="width:750px!important">
										<tbody>
											<tr>
												<td>
													<table width="690" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee">
													<tbody>
														<tr>
															<td colspan="3" height="80" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="padding:0;margin:0;font-size:0;line-height:0">
																<table width="690" align="center" border="0" cellspacing="0" cellpadding="0">
																<tbody>
																	<tr>
																		<td width="30"></td>
																		<td align="left" valign="middle" style="padding:0;margin:0;font-size:0;line-height:0"><a href="#" target="_blank" ><img src="https://firebasestorage.googleapis.com/v0/b/tenedores-45125.appspot.com/o/logo.png?alt=media&token=9de47a27-776f-49cc-9171-fa1dcdecc8f2" alt="codexworld" class="CToWUd"></a></td>
																		<td width="30"></td>
																	</tr>
																   </tbody>
																</table>
															  </td>
														</tr>
														<tr>
															<td colspan="3" align="center">
																<table width="630" align="center" border="0" cellspacing="0" cellpadding="0">
																<tbody>
																	<tr>
																		<td colspan="3" height="60"></td></tr><tr><td width="25"></td>
																		<td align="center">
																			<h1 style="font-family:HelveticaNeue-Light,arial,sans-serif;font-size:48px;color:#404040;line-height:48px;font-weight:bold;margin:0;padding:0">¡Bienvenido '.$nombre.' a nuestra agencia! </h1>
																		</td>
																		<td width="25"></td>
																	</tr>
																	<tr>
																		<td colspan="3" height="40"></td></tr><tr><td colspan="5" align="center">
																			<p style="color:#404040;font-size:16px;line-height:24px;font-weight:lighter;padding:0;margin:0">Hemos creado un código de seguimiento <b>'.$contenido.'</b> para poder ayudarte a un mejor control e identificación de tu solicitud.</p><br>
																			<p style="color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0">
																				Con el código podrá verificar el estado del proceos de cotización hasta la compra final, cualquier consulta podria contactarse con la agencia indicando los últimos 8 digitos del código.</p>
																		</td>
																	</tr>
																	<tr>
																	<td colspan="4">
																		<div style="width:100%;text-align:center;margin:30px 0">
																			<table align="center" cellpadding="0" cellspacing="0" style="font-family:HelveticaNeue-Light,Arial,sans-serif;margin:0 auto;padding:0">
																			<tbody>
																				<tr>
																					<td align="center" style="margin:0;text-align:center"><a href="http://localhost/kmviajes/index.php?ruta=seguimiento&codseg='.$contenido.'" style="font-size:21px;line-height:22px;text-decoration:none;color:#ffffff;font-weight:bold;border-radius:2px;background-color:#0096d3;padding:14px 40px;display:block;letter-spacing:1.2px" target="_blank" >Acceder a KM Viajes!</a></td>
																				  </tr>
																			   </tbody>
																			</table>
																		   </div>
																	   </td>
																   </tr>
																<tr><td colspan="3" height="30"></td></tr>
															 </tbody>
															</table>
														 </td>
													   </tr>
													
													<tr bgcolor="#ffffff">
														<td width="30" bgcolor="#eeeeee"></td>
														<td>
															<table width="570" align="center" border="0" cellspacing="0" cellpadding="0">
															<tbody>
																<tr>
																	<td colspan="4" align="center">&nbsp;</td>
																  </tr>
																<tr>
																	<td colspan="4" align="center"><h2 style="font-size:24px">¡Campañas del mes!</h2></td>
																  </tr>
																<tr>
																	<td colspan="4">&nbsp;</td>
																  </tr>
																<tr>
																	<td width="300" align="right" valign="top"><img src="https://firebasestorage.googleapis.com/v0/b/tenedores-45125.appspot.com/o/mail1.jpg?alt=media&token=7ded5e84-e6db-44ac-8104-29a2fe5a9e7b" alt="tool" width="300" height="120" class="CToWUd"></td>
																	<td width="30"></td>
																	<td align="left" valign="middle">
																		<h3 style="color:#404040;font-size:18px;line-height:24px;font-weight:bold;padding:0;margin:0"></h3>
																		<div style="line-height:5px;padding:0;margin:0">&nbsp;</div>
																		<div style="color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0">México, te invitamos a conocer el pais norteño y disfrutar lo mejor de la cutlura</div>
																		<div style="line-height:10px;padding:0;margin:0">&nbsp;</div>
																	  </td>
																	<td width="30"></td>
																</tr>
																<tr>
																	<td colspan="5" height="40" style="padding:0;margin:0;font-size:0;line-height:0"></td>
																  </tr>
																<tr>
																	<td width="300" align="right" valign="top"><img src="https://firebasestorage.googleapis.com/v0/b/tenedores-45125.appspot.com/o/mail2.jpg?alt=media&token=71ff4adc-3752-4568-a1cc-a771d33f2de5" alt="no fees" width="120" height="120" class="CToWUd"></td>
																	<td width="30"></td>
																	<td align="left" valign="middle">
																		<h3 style="color:#404040;font-size:18px;line-height:24px;font-weight:bold;padding:0;margin:0">Cusco</h3>
																		  <div style="line-height:5px;padding:0;margin:0">&nbsp;</div>
																		  <div style="color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0">Conoce Cusco y todo lo que tiene que ofrecerte, dejate enamorar de lo mejor de este magnifico lugar</div>
																		  <div style="line-height:10px;padding:0;margin:0">&nbsp;</div>
																	  </td>
																	<td width="30"></td>
																</tr>
																<tr>
																	<td colspan="5" height="40" style="padding:0;margin:0;font-size:0;line-height:0"></td>
																   </tr>
																<tr>
																	<td width="300" align="right" valign="top"><img src="https://firebasestorage.googleapis.com/v0/b/tenedores-45125.appspot.com/o/mail3.jpg?alt=media&token=4c039491-a75f-4661-a3de-f922bf410e9a" alt="creditibility" width="120" height="120" class="CToWUd"></td>
																	<td width="30"></td>
																	<td align="left" valign="middle">
																		<h3 style="color:#404040;font-size:18px;line-height:24px;font-weight:bold;padding:0;margin:0">Europa</h3>
																		  <div style="line-height:5px;padding:0;margin:0">&nbsp;</div>
																		  <div style="color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0">Un destino, que facilita conocer más de un pais, decideté a viajar y disfrutar este destino!</div>
																		  <div style="line-height:10px;padding:0;margin:0">&nbsp;</div>
																	   </td>
																	<td width="30"></td>
																</tr>
																<tr>
																	<td colspan="4">&nbsp;</td>
																</tr>
															  </tbody>
															</table>
															<table width="570" align="center" border="0" cellspacing="0" cellpadding="0">
															<tbody>
																<tr>
																	<td>
																		<h2 style="color:#404040;font-size:22px;font-weight:bold;line-height:26px;padding:0;margin:0">&nbsp;</h2>
																		<div style="color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0">Disfruta de tus aventuras con KM Viajes.</div>
																	  </td>
																  </tr>
																<tr>
																	<td align="center">
																		<div style="text-align:center;width:100%;padding:40px 0">
																			<table align="center" cellpadding="0" cellspacing="0" style="margin:0 auto;padding:0">
																			<tbody>
																				<tr>
																					<td align="center" style="margin:0;text-align:center"><a href="#" style="font-size:18px;font-family:HelveticaNeue-Light,Arial,sans-serif;line-height:22px;text-decoration:none;color:#ffffff;font-weight:bold;border-radius:2px;background-color:#00a3df;padding:14px 40px;display:block" target="_blank" >Visitar Ahora!</a></td>
																				</tr>
																			   </tbody>
																			 </table>
																		  </div>
																	</td>
															  </tr><tr><td>&nbsp;</td>
															  </tr></tbody></table></td>
														<td width="30" bgcolor="#eeeeee"></td>
													</tr>
													  </tbody>
													</table>
													  <table align="center" width="750px" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="width:750px!important">
													<tbody>
														<tr>
															<td>
																<table width="630" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee">
																<tbody>
																	<tr><td colspan="2" height="30"></td></tr>
																	<tr>
																		<td width="360" valign="top">
																			<div style="color:#a3a3a3;font-size:12px;line-height:12px;padding:0;margin:0">© 2020 KM Viajes. All rights reserved.</div>
																			<div style="line-height:5px;padding:0;margin:0">&nbsp;</div>
																			<div style="color:#a3a3a3;font-size:12px;line-height:12px;padding:0;margin:0">Made in Perú</div>
																		</td>
																		  <td align="right" valign="top">
																			<span style="line-height:20px;font-size:10px"><a href="https://www.facebook.com/codexworld" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://www.facebook.com/codexworld&amp;source=gmail&amp;ust=1603079165386000&amp;usg=AFQjCNFXfc88itEKse9SAKQbhvoz420DWA"><img src="https://ci5.googleusercontent.com/proxy/rKlW5Ik5LFEGY9ZT3BKOQ_Otmu9S8vmIg2rniN3gNGQvm-nsIUrpVipbg_Zcu-ORsjXL=s0-d-e1-ft#http://i.imgbox.com/BggPYqAh.png" alt="fb" class="CToWUd"></a>&nbsp;</span>
																			<span style="line-height:20px;font-size:10px"><a href="https://twitter.com/codexworldblog" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://twitter.com/codexworldblog&amp;source=gmail&amp;ust=1603079165386000&amp;usg=AFQjCNE9bebPKB8oNcWp0F6XmsyaS_E43A"><img src="https://ci5.googleusercontent.com/proxy/SCuEHZMrJ75RmREB1BNFz6QpnKY0L92b3gkaDZ2ijlxJP_WBoZX7mnrNHQNfp7KRIK5q=s0-d-e1-ft#http://i.imgbox.com/j3NsGLak.png" alt="twit" class="CToWUd"></a>&nbsp;</span>
																			<span style="line-height:20px;font-size:10px"><a href="https://plus.google.com/+codexworld" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://plus.google.com/%2Bcodexworld&amp;source=gmail&amp;ust=1603079165386000&amp;usg=AFQjCNGP1cYosK4H31PY3J4VRf98lRJqhg"><img src="https://ci5.googleusercontent.com/proxy/Sx_93Sf4nBRzdPKNXzVZyBXuO-RMhfXkNpl1fgkpu6BhKxk5ZKpeSrlFOIMutz4OGzb1=s0-d-e1-ft#http://i.imgbox.com/wFyxXQyf.png" alt="g" class="CToWUd"></a>&nbsp;</span>
																		  </td>
																	</tr>
																	<tr><td colspan="2" height="5"></td></tr>
																   
																  </tbody>
																</table>
															   </td>
														  </tr>
													  </tbody>
													</table>
												  </td>
											</tr>
										  </tbody>
										</table>
									</td>
								</tr>
							 </tbody>
							</table>
							</body>
					   </html>';

		   	$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
		   	$cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		   	$cabeceras .= 'From: <rarg15@gmail.com>' . "\r\n";

		   $envio = mail($para, $titulo, $mensaje, $cabeceras);

		}

	}

}