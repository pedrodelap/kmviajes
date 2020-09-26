<?php

class ControladorPaqueteFront{

    static public function ctrlistarTodosPaquetesDisponibles($filter){

        $respuesta = ModeloPaqueteFront::mdlListarTodosPaquetesDisponibles($filter);

        $html = "";
        foreach ($respuesta as $key => $value) {
            $ruta = "index.php?ruta=detallepaquete&id=".$value["id_paquete"];

            echo '<div class="col-md-4" id="paquete_'.$value["id_paquete"].'" >
                    <div class="box-image-text">
                        <div class="image"><img src="vistas/assets/img/catalogo_tours/5.jpg" alt="" class="img-fluid">
                            <div class="overlay d-flex align-items-center justify-content-center">
                            <div class="content">
                                <div class="name">
                                <h3><a href="#" class="color-white" style="text-decoration: none;">'.$value["precio_sol"].' o '.$value["precio_dolar"].'</a></h3>
                                </div>
                                <div class="text">
                                    <p class="buttons"><button idPaquete="'.$value["id_paquete"].'" class=" btn-buscar2 btn btn-template-outlined-white">Ver</button></p>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="content">
                        <h4><a href="'.$ruta.'">'.$value["titulo"].'</a></h4>
                        <p>'.$value["descripcion_corta"].'</p>
                        </div>';
                        if($value["flag"]){
                            echo '<div class="ribbon-holder">
                                    <div class="ribbon sale">Oferta</div>
                                </div>';
                        }
                        
                echo '</div>
                </div>';
        }

        

    }

    static public function ctrObtenetPaqueteById($id){

        $respuesta = ModeloPaqueteFront::mdlObtenetPaqueteById($id);
        return $respuesta;
    
    }
    static public function ctrListarServiciosPorPaquete($id){

        $respuesta = ModeloPaqueteFront::mdlListarServiciosPorPaquete($id);
        return $respuesta;
    
    }

    static public function ctrListarCiudad(){

        $respuesta = ModeloPaqueteFront::mdlListarCiudad();


        foreach ($respuesta as $key => $value) {
           
            echo '<option value='.$value["id_ciudad"].'>'.$value["nombre"].'</option>';
                    
        }
    
    }

    static public function ctrCrearSolicitud($datos){
       
		$respuesta = ModeloPaqueteFront::mdlCrearSolicitudPaso1($datos);
        if($respuesta != 'false'){
            $respuesta = ModeloPaqueteFront::mdlCrearSolicitudPaso2($datos,$respuesta["id_cliente"]);
        }
		return $respuesta;

	}

    
}
