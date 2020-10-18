<?php

class ControladorSlide{

	#MOSTRAR IMAGEN SLIDE AJAX
	#------------------------------------------------------------

	public static function ctrMostrarImagen($datos){

		#getimagesize - Obtiene el tamaño de una imagen

		#LIST(): Al igual que array(), no es realmente una función, es un constructor del lenguaje. list() se utiliza para asignar una lista de variables en una sola operación.

		list($ancho, $alto) = getimagesize($datos["imagenTemporal"]);
		
		if($ancho < 1000 || $alto < 400){

			echo 0;

		}

		else{

			$aleatorio = mt_rand(100, 999);

			$v_ruta_back = "../vistas/assets/images/slide_back/".$aleatorio.".jpg";

			$v_ruta_back2 = "vistas/assets/images/slide_back/".$aleatorio.".jpg";                  
			
			#imagecreatefromjpeg — Crea una nueva imagen a partir de un fichero o de una URL

			$origen = imagecreatefromjpeg($datos["imagenTemporal"]);

			#imagecrop() — Recorta una imagen usando las coordenadas, el tamaño, x, y, ancho y alto dados

			$destino = imagecrop($origen, ["x"=>0, "y"=>0, "width"=>1600, "height"=>600]);
			
			#imagejpeg() — Exportar la imagen al navegador o a un fichero

			imagejpeg($destino, $v_ruta_back);

			$v_ruta_front = "../vistas/assets/images/slide_front/".$aleatorio.".jpg";

			$v_ruta_front2 = "vistas/assets/images/slide_front/".$aleatorio.".jpg";   

			$origen2 = imagecreatefromjpeg($datos["imagenTemporal"]);

			imagejpeg($origen2, $v_ruta_front);

			ModeloSlide::mdlSubirImagenSlide($v_ruta_back2, $v_ruta_front2, "tb_slide");

			$respuesta = ModeloSlide::mdlMostrarImagenSlide($v_ruta_back, "tb_slide");

			$enviarDatos = array("ruta"=>$respuesta["v_ruta_back"],
				                 "titulo"=>$respuesta["v_titulo"],
				                 "descripcion"=>$respuesta["v_descripcion"]);
						 
			echo json_encode($enviarDatos);
		}

	}

	#MOSTRAR IMAGENES EN LA VISTA
	#------------------------------------------------------------

	public static function ctrMostrarImagenVista(){

		$respuesta = ModeloSlide::mdlMostrarImagenVista("tb_slide");

		foreach($respuesta as $row => $item){

			# echo '<li id="'.$item["id_slide"].'" class="bloqueSlide"><span class="fa fa-times eliminarSlide" ruta="'.$item["v_ruta"].'"></span><img src="'.substr($item["v_ruta"], 6).'" class="handleImg"></li>';
			echo '<li id="'.$item["id_slide"].'" class="bloqueSlide"><span class="fa fa-times eliminarSlide" ruta="'.$item["v_ruta_back"].'"></span><img src="'.$item["v_ruta_back"].'" class="handleImg"></li>';

		}

	}

	#MOSTRAR IMAGENES EN EL EDITOR
	#------------------------------------------------------------

	public static function ctrEditorSlide(){

		$respuesta = ModeloSlide::mdlMostrarImagenVista("tb_slide");

		foreach($respuesta as $row => $item){

			echo '<li id="item'.$item["id_slide"].'">
					<span class="lnr-pencil editarSlide btn-primary"></span>
					<img src="'.$item["v_ruta_back"].'" style="float:initial; margin-bottom:10px" width="80%">
					<h1>'.$item["v_titulo"].'</h1>
					<p>'.$item["v_descripcion"].'</p>
				</li>';

		}

	}

	#ELIMINAR ITEM DEL SLIDE
	#-----------------------------------------------------------
	public static function ctrEliminarSlide($datos){

		$respuesta = ModeloSlide::mdlEliminarSlide($datos, "tb_slide");

		unlink($datos["rutaSlide"]);

		echo $respuesta;

	}

	#ACTUALIZAR ITEM DEL SLIDE
	#-----------------------------------------------------------

	public static function ctrActualizarSlide($datos){

		ModeloSlide::mdlActualizarSlide($datos, "tb_slide");
		$respuesta = ModeloSlide::mdlSeleccionarActualizacionSlide($datos, "tb_slide");

		$enviarDatos = array("titulo"=>$respuesta["v_titulo"],
			                 "descripcion"=>$respuesta["v_descripcion"]);
		
		echo json_encode($enviarDatos);
	}

	#ACTUALIZAR ORDEN 
	#---------------------------------------------------
	public static function ctrActualizarOrden($datos){

		ModeloSlide::mdlActualizarOrden($datos, "tb_slide");

		$respuesta = ModeloSlide::mdlSeleccionarOrden("tb_slide");

		foreach($respuesta as $row => $item){

			echo'<li id="item'.$item["id_slide"].'">
			     <span class="fa fa-pencil editarSlide" style="background:blue"></span>
			     <img src="'.substr($item["v_ruta_back"], 6).'" style="float:left; margin-bottom:10px" width="80%">
			     <h1>'.$item["v_titulo"].'</h1>
			     <p>'.$item["v_descripcion"].'</p>
			     </li>';

		}

	}

}