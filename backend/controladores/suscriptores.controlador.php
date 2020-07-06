<?php

class ControladorSuscriptores{

	#MOSTRAR SUSCRIPTORES EN LA VISTA
	#------------------------------------------------------------
	public static function ctrMostrarSuscriptores(){

		$respuesta = ModeloSuscriptores::mdlMostrarSuscriptores("tb_suscriptores");

		foreach ($respuesta as $row => $item){

			echo '<tr>
			        <td>'.$item["v_nombre"].'</td>
					<td>'.$item["v_email"].'</td>
					<td>'.$item["v_telefono"].'</td>
			        <td>
			        	<a href="index.php?action=suscriptores&idBorrar='.$item["id_suscriptor"].'"><span class="btn btn-danger fa fa-times quitarSuscriptor"></span></a>
			        </td>
			        <td>
			        </td>
			      </tr>';

		}

	}

	#BORRAR Suscriptores
	#------------------------------------------------------------

	public static function ctrBorrarSuscriptores(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];

			$respuesta = ModeloSuscriptores::mdlBorrarSuscriptores($datosController, "tb_suscriptores");

			if($respuesta == "ok"){

					echo'<script>

							Swal.fire({
								  title: "¡OK!",
								  text: "¡El suscrito se ha borrado correctamente!",
								  icon: "success",
								  confirmButtonText: "Cerrar",
								  closeOnConfirm: false
								}).then((result) => {
									if (result.value) {	   
									    window.location = "suscriptores";
									  } 
							});


						</script>';

			}

		}

	}

	#IMPRESIÓN SUSCRIPTORES
	#------------------------------------------------------------

	public static function ctrImpresionSuscriptores($datos){

		$datosController = $datos;

		$respuesta = ModeloSuscriptores::mdlMostrarSuscriptores($datosController);
	
		return $respuesta;

	}

	#SUSCRIPTORES SIN REVISAR
	#------------------------------------------------------------
	public static function ctrSuscriptoresSinRevisar(){

		$respuesta = ModeloSuscriptores::mdlSuscriptoresSinRevisar("tb_suscriptores");

		$sumaRevision = 0;

		foreach ($respuesta as $row => $item) {
			
			if($item["revision"] == 0){

				++$sumaRevision;

				echo '<span>'.$sumaRevision.'</span>';

			}					
		
		}

	}

	#SUSCRIPTORES REVISADOS
	#------------------------------------------------------------
	public static function ctrSuscriptoresRevisados($datos){

		$datosController = $datos;

		$respuesta = ModeloSuscriptores::mdlSuscriptoresRevisados($datosController, "suscriptores");

		echo $respuesta;

	}

}