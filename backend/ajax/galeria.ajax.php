<?php

require_once "../controladores/galeria.controlador.php";
require_once "../modelos/galeria.modelo.php";

#CLASE Y MÉTODOS
#-------------------------------------------------------------
class Ajax{

	#SUBIR LA IMAGEN DE LA GALERIA
	#----------------------------------------------------------
	public $imagenTemporal;

	public function AjaxGestorGaleria(){

		$datos = $this->imagenTemporal;

		$respuesta = ControladorGaleria::ctrMostrarImagen($datos);

		echo $respuesta;

	}

	#ELIMINAR ITEM GALERIA
	#----------------------------------------------------------

	public $idGaleria;
	public $rutaGaleria;

	public function AjaxEliminarGaleria(){

		$datos = array("idGaleria" => $this->idGaleria, 
					   "rutaGaleria" => $this->rutaGaleria);

		$respuesta = ControladorGaleria::ctrEliminarGaleria($datos);

		echo $respuesta;

	}

	#ACTUALIZAR ORDEN
	#---------------------------------------------
	public $actualizarOrdenGaleria;
	public $actualizarOrdenItem;

	public function AjaxActualizarOrden(){
	
		$datos = array("ordenGaleria" => $this->actualizarOrdenGaleria,
			           "ordenItem" => $this->actualizarOrdenItem);

		$respuesta = ControladorGaleria::ctrActualizarOrden($datos);

		echo $respuesta;

	}

}

#OBJETOS
#-----------------------------------------------------------
if(isset($_FILES["imagen"]["tmp_name"])){

	$a = new Ajax();
	$a -> imagenTemporal = $_FILES["imagen"]["tmp_name"];
	$a -> AjaxGestorGaleria();

}

if(isset($_POST["idGaleria"])){

	$b = new Ajax();
	$b -> idGaleria = $_POST["idGaleria"];
	$b -> rutaGaleria = $_POST["rutaGaleria"];
	$b -> AjaxEliminarGaleria();	

}

if(isset($_POST["actualizarOrdenGaleria"])){

	$c = new Ajax();
	$c -> actualizarOrdenGaleria = $_POST["actualizarOrdenGaleria"];
	$c -> actualizarOrdenItem = $_POST["actualizarOrdenItem"];
	$c -> AjaxActualizarOrden();

}