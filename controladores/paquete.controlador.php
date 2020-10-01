<?php

class ControladorPaqueteFront{

    static public function ctrlistarTodosPaquetesDisponibles($filter){

        $respuesta = ModeloPaqueteFront::mdlListarTodosPaquetesDisponibles($filter);

        $html = "";
        foreach ($respuesta as $key => $value) {
            $ruta = "index.php?ruta=detallepaquete&id=".$value["id_paquete"];

            echo '<div class="col-md-4" id="paquete_'.$value["id_paquete"].'" >
                    <div class="box-image-text">
                        <div class="image"><img src="backend/'.$value["ruta_imagen"].'" alt="" class="img-fluid">
                            <div class="overlay d-flex align-items-center justify-content-center">
                            <div class="content">
                                <div class="name">
                                <h3><a href="#" class="color-white" style="text-decoration: none;">'.$value["precio_sol"].' S/. o '.$value["precio_dolar"].' $</a></h3>
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

    static public function ctrListarPaquetePorCampania($id_campania){

        $respuesta = ModeloPaqueteFront::mdlListarPaquetePorCampania($id_campania);
        return $respuesta;
    
    }

    static public function ctrListarFotosPorPaquete($id){

        $respuesta = ModeloPaqueteFront::mdlListarFotosPorPaquete($id);
        return $respuesta;
    
    }

    static public function ctrCrearClienteSolicitudPersonalizada($datosCliente){

        $resultado = "";

        if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $datosCliente["nombres"]) &&
        preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $datosCliente["apellidos"]) &&			   
        preg_match('/^[a-zA-Z0-9. ]+$/', $datosCliente["numero_documento"]) &&
        preg_match('/^[0-9]+$/', $datosCliente["numero_documento"]) &&
        preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $datosCliente["correo"]) &&
        preg_match('/^[()\-0-9 ]+$/', $datosCliente["telefono"] )){


            $respuesta = ModeloPaqueteFront::mdlCrearClienteSolicitudPersonalizada($datosCliente);
    
		    $resultado = $respuesta;

        }else {

            $respuesta= "errorValidacionCliente";

        }

        return $respuesta;

    }

    static public function ctrCrearSolicitudPersonalizada($datosSolicitud){

        $respuesta = ModeloPaqueteFront::mdlCrearSolicitudPersonalizada($datosSolicitud);
    
		return $respuesta;

    }

    static public function ctrCrearSolicitudPersonalizadaHistorial($datosCliente){

        $respuesta = ModeloPaqueteFront::mdlCrearClienteSolicitudPersonalizada($datosCliente);
    
		return $respuesta;

    }

   
}
