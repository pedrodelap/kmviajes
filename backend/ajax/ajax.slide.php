<?php

require_once "../modelos/modelo.slide.php";
require_once "../controladores/controlador.slide.php";

#CLASE Y MÉTODOS
#-------------------------------------------------------------

class Ajax{

	#SUBIR LA IMAGEN DEL SLIDE
	#----------------------------------------------------------

	public $nombreImagen;
	public $imagenTemporal;

	public function AjaxGestorSlide(){

		$datos = array("nombreImagen"=>$this->nombreImagen,
			           "imagenTemporal"=>$this->imagenTemporal);

		$respuesta = ControladorSlide::ctrMostrarImagen($datos);

		echo $respuesta;

	}

	#ELIMINAR ITEM SLIDE
	#----------------------------------------------------------
	public $idSlide;
	public $rutaSlide;

	public function AjaxEliminarSlide(){

		$datos = array("idSlide" => $this->idSlide, 
			           "rutaSlide" => $this->rutaSlide);

		$respuesta = ControladorSlide::ctrEliminarSlide($datos);

		echo $respuesta;

	}

	#ACTUALIZAR ITEM SLIDE
	#----------------------------------------------------------
	public $enviarId;
	public $enviarTitulo;
	public $enviarDescripcion;

	public function AjaxActualizarSlide(){

		$datos = array("enviarId" => $this->enviarId, 
			           "enviarTitulo" => $this->enviarTitulo,
			           "enviarDescripcion" => $this->enviarDescripcion);

		$respuesta = ControladorSlide::ctrActualizarSlide($datos);

		echo $respuesta;

	}

	#ACTUALIZAR ORDEN
	#---------------------------------------------
	
	public $actualizarOrdenSlide;
	public $actualizarOrdenItem;

	public function AjaxActualizarOrden(){

		$datos = array("ordenSlide" => $this->actualizarOrdenSlide,
			           "ordenItem" => $this->actualizarOrdenItem);

		$respuesta = ControladorSlide::ctrActualizarOrden($datos);

		echo $respuesta;

	}

}

#OBJETOS
#-----------------------------------------------------------
if(isset($_FILES["imagen"]["name"])){

	$a = new Ajax();
	$a -> nombreImagen = $_FILES["imagen"]["name"];
	$a -> imagenTemporal = $_FILES["imagen"]["tmp_name"];
	$a -> AjaxGestorSlide();

}

if(isset($_POST["idSlide"])){

	$b = new Ajax();
	$b -> idSlide = $_POST["idSlide"];
	$b -> rutaSlide = $_POST["rutaSlide"];
	$b -> AjaxEliminarSlide();	

}

if(isset($_POST["enviarId"])){

	$c = new Ajax();
	$c -> enviarId = $_POST["enviarId"];
	$c -> enviarTitulo = $_POST["enviarTitulo"];
	$c -> enviarDescripcion = $_POST["enviarDescripcion"];
	$c -> AjaxActualizarSlide();	

}

if(isset($_POST["actualizarOrdenSlide"])){

	$d = new Ajax();
	$d -> actualizarOrdenSlide = $_POST["actualizarOrdenSlide"];
	$d -> actualizarOrdenItem = $_POST["actualizarOrdenItem"];
	$d -> AjaxActualizarOrden();

}
