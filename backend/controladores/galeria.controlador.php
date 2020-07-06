<?php

class ControladorGaleria{

	#MOSTRAR IMAGEN GALERIA AJAX
	#------------------------------------------------------------
	public static function ctrMostrarImagen($datos){

		list($ancho, $alto) = getimagesize($datos);

		if($ancho < 1024 || $alto < 768){

			echo 0;

		}

		else{

			$aleatorio = mt_rand(100, 999);

			$ruta = "../vistas/assets/images/galeria/galeria".$aleatorio.".jpg";

			$ruta2 = "vistas/assets/images/galeria/galeria".$aleatorio.".jpg";

			$nuevo_ancho = 1024;
			$nuevo_alto = 768;

			$origen = imagecreatefromjpeg($datos);

			#imagecreatetruecolor — Crear una nueva imagen de color verdadero
			$destino = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);

			#imagecopyresized() - copia una porción de una imagen a otra imagen. 

			#bool imagecopyresized( $destino, $origen, int $destino_x, int $destino_y, int $origen_x, int $origen_y, int $destino_w, int $destino_h, int $origen_w, int $origen_h)

			imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);

			imagejpeg($destino, $ruta);

			ModeloGaleria::mdlSubirImagenGaleria($ruta2, "tb_galeria");

			$respuesta = ModeloGaleria::mdlMostrarImagenGaleria($ruta2, "tb_galeria");

			echo $respuesta["v_ruta"];

		}

	}

	#MOSTRAR IMAGENES EN LA VISTA
	#------------------------------------------------------------

	public static function ctrMostrarImagenVista(){

		$respuesta = ModeloGaleria::mdlMostrarImagenVista("tb_galeria");

		foreach($respuesta as $row => $item){

			echo '<li id="'.$item["id_galeria"].'" class="bloqueGaleria">
					<span class="fa fa-times eliminarFoto" ruta="'.$item["v_ruta"].'"></span>
					<a rel="grupo" href="'.$item["v_ruta"].'">
					<img src="'.$item["v_ruta"].'" class="handleImg">
					</a>
				</li>';

		}

	}

	#ELIMINAR ITEM DE LA GALERIA
	#-----------------------------------------------------------
	public static function ctrEliminarGaleria($datos){

		$respuesta = ModeloGaleria::mdlEliminarGaleria($datos, "tb_galeria");

		echo '<script> console.log("rutaGaleria",'.$datos["rutaGaleria"].'</script>';

		unlink("../".$datos["rutaGaleria"]);

		echo $respuesta;

	}

	#ACTUALIZAR ORDEN 
	#---------------------------------------------------
	public static function ctrActualizarOrden($datos){

		ModeloGaleria::mdlActualizarOrden($datos, "tb_galeria");

		$respuesta = ModeloGaleria::mdlSeleccionarOrden("tb_galeria");

		foreach($respuesta as $row => $item){

			echo '<li id="'.$item["id_galeria"].'" class="bloqueGaleria">
					<span class="fa fa-times eliminarFoto" ruta="'.$item["v_ruta"].'"></span>
					<a rel="grupo" href="'.$item["v_ruta"].'">
					<img src="'.$item["v_ruta"].'" class="handleImg">
					</a>
				</li>';

		}


	}

}