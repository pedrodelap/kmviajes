<?php

require_once "../controladores/controlador.paquetes.php";
require_once "../modelos/modelo.paquetes.php";

class AjaxPaquetes{

	#REGISTRAR PROPUESTA
	#----------------------------------------------------------

	public $paqueteTitulo;
	public $paqueteCampana;
	public $paqueteAerolinea;
	public $paqueteCiudad;
	public $paqueteHotel;
	public $paquetePrecioSoles;
	public $paquetePrecioDolares;
	public $paqueteCantidadAdultos;
	public $paqueteCantidadNinos;
	public $paqueteFechaMostrar;
	public $paqueteFechaInicio;
	public $paqueteFechaFin;
	public $paqueteDescripcionCorta;
	public $paqueteDescripcionLarga;
	public $paqueteDetalle;

	public $id_paquete;

	public function ajaxCrearPaquete(){

		$datos = array("titulo"=>$this->paqueteTitulo,					
					"id_aerolinea"=>$this->paqueteAerolinea,
					"id_ciudad"=>$this->paqueteCiudad,
					"id_hotel"=>$this->paqueteHotel,
					"precio_sol"=>$this->paquetePrecioSoles,
					"precio_dolar"=>$this->paquetePrecioDolares,
					"cantidad_adultos"=>$this->paqueteCantidadAdultos,
					"cantidad_ninios"=>$this->paqueteCantidadNinos,
					"fecha_mostrar"=>$this->paqueteFechaMostrar,
					"fecha_inicio"=>$this->paqueteFechaInicio,
					"fecha_fin"=>$this->paqueteFechaFin,
					"descripcion_corta"=>$this->paqueteDescripcionCorta,
					"detalle"=>$this->paqueteDetalle);
		
		$respuesta = ControladorPaquetes::ctrCrearPaquete($datos);

		$this->id_paquete = $respuesta["id_paquete"];

		$datos2 = array("id_campana"=>$this->paqueteCampana,
						"id_paquete"=>$this->id_paquete,
						"fecha_inicio"=>$this->paqueteFechaInicio,
						"fecha_fin"=>$this->paqueteFechaFin);

		$respuesta2 = ControladorPaquetes::ctrCrearPaquetexCampana($datos2);

		echo json_encode($respuesta);

	}

	#CONSULTAR CIUDAD
	#----------------------------------------------------------

	public $searchTerm;

	public function ajaxSelectCiudad(){

		$valor = $this->searchTerm;

		$respuesta = ControladorPaquetes::ctrSelectCiudades($valor);

		$ciudad = array();

		$i = 0;
		
		foreach ($respuesta[1] as $key) 
		{
			$respuesta[1][$i]['desc'] = $key['nombre_ciudad'];;
			$respuesta[1][$i]['id'] = $key['id_ciudad'];
			$i++;
		}
	
		$ciudad['items'] = $respuesta[1];
		
		echo json_encode($ciudad);

	}

	#CREAR IMAGENES DEL PAQUETE
	#----------------------------------------------------------

	public $idPaqueteImg;

	public function ajaxCrearImagenesDePaquete(){

		$numero = 1;

		$status = false;

		$respuesta = "";

		$directorio = opendir("../vistas/images/paquetes/temporal");

		while ( $archivo = readdir($directorio)) {

			$nuevoNombre = '';

			// Comprobamos que el archivo no sea un directorio
			if (!is_dir($archivo)) {

				$fecha_hora =  date("Ymdhis");

				$nuevoNombre  = ''.$this->idPaqueteImg.'_img_'.$numero.'_'.$fecha_hora.'.png';
				$rutaArchivo1 = "../vistas/images/paquetes/temporal/".$archivo;
				$rutaArchivo2 = "../vistas/images/paquetes/".$nuevoNombre;

				$ruta_imagen = "vistas/images/paquetes/".$nuevoNombre;

				if (rename ($rutaArchivo1, $rutaArchivo2))
				{
					$status = true;
				}
				else
				{
					$status = false;
				}

				$datos = array("id_paquete"=>$this->idPaqueteImg,
					           "id_imagen"=>$numero,
					           "ruta_imagen"=>$ruta_imagen);

				$respuesta = ControladorPaquetes::ctrCrearPaquetexImages($datos);

				$numero = $numero + 1;

			}
		
		}

		echo json_encode($respuesta);

	}

	#REGISTRAR SERVICIOS DEL PAQUETE
	#----------------------------------------------------------

	public $idPaqueteServicio;
	public $servicioArray;

	public function ajaxCrearServiciosDePaquete(){

		$respuesta = ControladorPaquetes::ctrCrearServiciosDePaquete($this->idPaqueteServicio, $this->servicioArray);

		echo json_encode($respuesta);

	}

}

/*=============================================
REGISTRAR PAQUETE
=============================================*/	

if(isset($_POST["nuevoPaqueteTitulo"])){

	$paquete = new AjaxPaquetes();
	$paquete -> paqueteTitulo = $_POST["nuevoPaqueteTitulo"];
	$paquete -> paqueteCampana = $_POST["nuevoPaqueteCampana"];
	$paquete -> paqueteAerolinea = $_POST["nuevoPaqueteAerolinea"];	
	$paquete -> paqueteCiudad = $_POST["nuevoPaqueteCiudad"];
	$paquete -> paqueteHotel = $_POST["nuevoPaqueteHotel"];
	$paquete -> paquetePrecioSoles = $_POST["nuevoPaquetePrecioSoles"];	
	$paquete -> paquetePrecioDolares = $_POST["nuevoPaquetePrecioDolares"];
	$paquete -> paqueteCantidadAdultos = $_POST["nuevoPaqueteCantidadAdultos"];
	$paquete -> paqueteCantidadNinos = $_POST["nuevoPaqueteCantidadNinos"];
	$paquete -> paqueteFechaMostrar = $_POST["nuevoPaqueteFechaMostrar"];
	$paquete -> paqueteFechaInicio = $_POST["nuevoPaqueteFechaInicio"];
	$paquete -> paqueteFechaFin = $_POST["nuevoPaqueteFechaFin"];
	$paquete -> paqueteDescripcionCorta = $_POST["nuevoPaqueteDescripcionCorta"];
	$paquete -> paqueteDescripcionLarga = $_POST["nuevoPaqueteDescripcionLarga"];
	$paquete -> paqueteDetalle = $_POST["nuevoPaqueteDetalle"];
	$paquete -> ajaxCrearPaquete();

}


/*=============================================
CONSULTAR AEROLINEAS
=============================================*/	

if(isset($_GET['q'])){

	$searchTerm = new AjaxPaquetes();
	$searchTerm -> searchTerm = $_GET["q"];
	$searchTerm -> ajaxSelectCiudad();

}


/*=============================================
REGISTRAR IMAGENES DEL PAQUETE
=============================================*/	

if(isset($_POST["idPaqueteImagen"])){

	$paquete = new AjaxPaquetes();
	$paquete -> idPaqueteImg = $_POST["idPaqueteImagen"];
	$paquete -> ajaxCrearImagenesDePaquete();

}


/*=============================================
REGISTRAR SERVICIOS DEL PAQUETE
=============================================*/	

if(isset($_POST["Servicio"])){

	$paquete = new AjaxPaquetes();
	$paquete -> idPaqueteServicio = $_POST["idPaqueteServicio"];
	$paquete -> servicioArray = $_POST["servicioArray"];
	$paquete -> ajaxCrearServiciosDePaquete();

}
