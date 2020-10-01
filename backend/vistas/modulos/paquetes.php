<div class="app-main__inner">

    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Paquetes Turísticos
                    <div class="page-title-subheading">This is an example dashboard created using build-in elements and components.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">

                    <button type="button" class="btn-shadow btn btn-primary" data-toggle="modal" data-target="#modalNuevoPaquete">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="pe-7s-add-user pe-7s-w-20"></i>
                        </span>
                        Agregar Paquetes Turísticos
                    </button>

            </div>
        </div>
    </div>

    <div class="row animated fadeIn">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Listado de Paquetes Turísticos </h5>

                        <!--=====================================
                                        PAQUETES
                        table table-striped table-bordered dt-responsive tablas align-middle text-truncate mb-0 table-borderless table-hover
                        ======================================-->

                        <table class="table table-striped table-bordered tablas mb-0 table table-borderless table-hover">

                            <thead>

                                <tr>

                                    <th style="width:10px">#</th>

                                    <th>Titulo</th>

                                    <th>Aerolínea</th>

                                    <th>Ciudad</th>

                                    <th>Precio S/.</th>

                                    <th>Precio $</th>

                                    <th>Fecha </th>

                                    <th>Cant. Adultos / Niños</th>

                                    <th>Acciones</th>

                                </tr> 

                            </thead> 
                            <tbody>

                                <?php

                                $item = null;
                                $valor = null;

                                $paquetes = ControladorPaquetes::ctrMostrarPaquetes($item, $valor);

                                foreach ($paquetes as $key => $value) {
                                    

                                    echo '<tr>

                                            <td>'.($key+1).'</td>

                                            <td>'.$value["titulo"].'</td>

                                            <td>'.$value["aerolinea_nombre"].'</td>                                            

                                            <td>'.$value["ciudad_pais"].'</td>

                                            <td>'.$value["precio_sol"].' S/.</td>

                                            <td>'.$value["precio_dolar"].'$</td>

                                            <td>'.$value["fecha_mostrar"].'</td>

                                            <td>'.$value["cantidad_adultos"].' / '.$value["cantidad_ninios"].'</td>

                                            <td>

                                                <span><button class="btn btn-secondary fa fa-edit btnEditarPaquete" idPaquete="'.$value["id_paquete"].'" data-toggle="modal" data-target="#modalEditarPaquete"></button></span>&nbsp;';

                                                if($_SESSION["perfil"] == "Administrador"){

                                                    echo '<span><button class="btn btn-danger fa fa-times btnEliminarPaquete" idPaquete="'.$value["id_paquete"].'"></button></span>';
                                                }

                                      echo '</td>

                                        </tr>';

                                    }

                                ?>

                            </tbody>

                        </table>
                        
                        <!--====  Fin de PAQUETES  ====-->
                </div>
            </div>
        </div>
    </div>
</div>


<!--=====================================
MODAL AGREGAR PAQUETE
======================================-->

<div class="modal fade" id="modalNuevoPaquete" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Agregar Paquete turístico</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">

                    <div id="smartwizard">
                        <ul class="forms-wizard">
                            <li>
                                <a href="#step-1">
                                    <em>1</em><span>Configuración Inicial</span>
                                </a>
                            </li>
                            <li>
                                <a href="#step-2">
                                    <em>2</em><span>Datos del Paquete Turístico</span>
                                </a>
                            </li>
                            <li>
                                <a href="#step-3">
                                    <em>3</em><span>Imagenes</span>
                                </a>
                            </li>
                        </ul>

                        <div class="form-wizard-content">

                            <div id="step-1">
                                <div id="accordion" class="accordion-wrapper mb-3">
                                    <div class="card">
                                                                                    
                                        <div class="card-body">

                                            <div class="form-row">

                                                <div class="col-md-3">
                                                    <div class="position-relative form-group"><label for="nuevoPaqueteTitulo">Titulo</label><input name="nuevoPaqueteTitulo" id="nuevoPaqueteTitulo" placeholder="Ingresar Titulo" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="position-relative form-group"><label for="nuevoCampanadePaquete">Campaña</label>

                                                        <select class="form-control campanaEnPaquete" name="nuevoCampanadePaquete" id="nuevoCampanadePaquete">
                                                        </select>                                                   

                                                    </div>
                                                </div>                                                

                                                <div class="col-md-3">
                                                    <div class="position-relative form-group"><label for="nuevoPaqueteAerolinea">Aerolíneas </label>

                                                        <select class="form-control paqueteAerolinea" name="nuevoPaqueteAerolinea" id="nuevoPaqueteAerolinea">
                                                        </select>                                                   

                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="position-relative form-group"><label for="nuevoPaqueteCiudad">Ciudad</label>

                                                        <select class="form-control paqueteCiudad" name="nuevoPaqueteCiudad" id="nuevoPaqueteCiudad">
                                                        </select>                                                   

                                                    </div>
                                                </div>                                                

                                            </div>

                                            <hr>

                                            <div class="form-row">

                                                <div class="grid-menu grid-menu-xl grid-menu-2col">
                                                    <div class="no-gutters row">

                                                    <?php

                                                        $item = null;

                                                        $valor = null;

                                                        $i = 1;

                                                        $servicios = ControladorServicios::ctrMostrarServicios($item, $valor);

                                                        foreach ($servicios as $key => $value) {

                                                            echo '<div class="col-sm-4 col-xl-2">
                                                                    <div class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                                                        <i class="'.$value["icono"].' icon-gradient bg-strong-bliss btn-icon-wrapper btn-icon-md mb-0"></i>
                                                                        <div class="custom-checkbox custom-control">
                                                                            <input type="checkbox" id="chkServicio_'.$value["id_servicio"].'" value="'.$value["id_servicio"].'" class="chkServicio custom-control-input">
                                                                            <label class="custom-control-label" for="chkServicio_'.$value["id_servicio"].'">'.$value["nombre"].'
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                  </div>';

                                                            $i ++;
                                                        }

                                                    ?>
                                                        
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>                                            
                            </div>

                            <div id="step-2">
                                <div id="accordion" class="accordion-wrapper mb-3">
                                    <div class="card">

                                        <div class="card-body">

                                            <div class="form-row">

                                                <div class="col-md-2">
                                                    <div class="position-relative form-group"><label for="nuevoPaquetePrecioSoles">Precio Soles</label>
                                                        <div class="input-group">
                                                            <input name="nuevoPaquetePrecioSoles" id="nuevoPaquetePrecioSoles" placeholder="" type="text" class="form-control">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">S/.</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="position-relative form-group"><label for="nuevoPaquetePrecioDolares">Precio Dolares</label>
                                                        <div class="input-group">
                                                            <input name="nuevoPaquetePrecioDolares" id="nuevoPaquetePrecioDolares" placeholder="" type="text" class="form-control">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">$</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="position-relative form-group"><label for="nuevoPaqueteCantidadAdultos">Cantidad Adultos</label><input name="nuevoPaqueteCantidadAdultos"  maxlength="2" id="nuevoPaqueteCantidadAdultos" placeholder="" type="text" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="position-relative form-group"><label for="nuevoPaqueteCantidadNinos">Cantidad Niños</label><input name="nuevoPaqueteCantidadNinos"  maxlength="2" id="nuevoPaqueteCantidadNinos" placeholder="" type="text" class="form-control">
                                                    </div>
                                                </div>   

                                                <div class="col-md-4">
                                                    <div class="position-relative form-group"><label for="nuevoPaqueteFecha">Fecha de Fin</label><input name="nuevoPaqueteFecha" id="nuevoPaqueteFecha" placeholder="" type="text" class="form-control paqueteNuevoFecha">
                                                    </div>
                                                </div>

                                             

                                            </div>

                                            <hr>

                                            <div class="form-row">

                                                <div class="col-12 col-md-12">
                                                    <div class="position-relative form-group">
                                                        <label for="nuevoPaqueteDescripcionCorta">Descripcion corta </label>
                                                        <div class="input-group">
                                                            <input name="nuevoPaqueteDescripcionCorta" id="nuevoPaqueteDescripcionCorta" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-12">
                                                    <div class="position-relative form-group">
                                                        <label for="nuevoPaqueteDescripcionLarga ">Descripcion larga </label>
                                                        <div class="input-group">
                                                        <textarea placeholder="" name="nuevoPaqueteDescripcionLarga" id="nuevoPaqueteDescripcionLarga" class="form-control" rows="2" required></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>    

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div id="step-3">
                                <div id="accordion" class="accordion-wrapper mb-3">
                                    <div class="card">
                                        <div id="headingOne" class="card-header">
                                            <button type="button" aria-expanded="false" aria-controls="collapseOne" class="text-left m-0 p-0 btn btn-link btn-block">
                                                <span class="form-heading">Agrege Imágenes al Paquete Turístico<p>Recuerde que las dimensiones de las imagenes deben ser de 600x440</p></span>
                                            </button>
                                        </div>
                                        <div data-parent="#accordion" id="collapseOne" aria-labelledby="headingOne" class="collapse show">
                                            <div class="card-body">

                                                <div class="position-relative form-group">
                                                    <button type="button" class="btn-shadow btn btn-primary btnAgregarImagenesPaquete">
                                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                                            <i class="pe-7s-add-user pe-7s-w-20"></i>
                                                        </span>
                                                        Agregar Imagenes
                                                    </button>
                                                </div>

                                                <hr>

                                                <h5 class="card-title">Lista de imagenes del Paquete Turístico</h5>

                                                <div id="divGaleriaPaqueteNuevo"></div>
   
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="clearfix">
                        <button type="button" class="btn-shadow float-left btn btn-link" onclick="limpiarPaquete()">Limpiar Paquete Turístico </button>

                        <button type="button" class="btn-shadow btn-wide float-right btn-pill btn-hover-shine btn btn-primary adicionarPaqueteTuristico">Terminar</button>

                        <button type="button" id="next-btn" class="btn-shadow float-right btn-wide btn-pill mr-3 btn btn-outline-secondary">Siguiente</button>
                        <button type="button" id="prev-btn" class="btn-shadow float-right btn-wide btn-pill btn btn-outline-secondary">Anterior</button>

                        
                    </div>


                </div>

                <!--=====================================
                PIE DEL MODAL
                ======================================-->

        </div>
    </div>
</div>

<!--=====================================
MODAL EDITAR PAQUETES
======================================-->

<div class="modal fade" id="modalEditarPaquete" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <form role="form" method="post">

                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Editar Paquete turístico</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">
                </div>

                <!--=====================================
                PIE DEL MODAL
                ======================================-->

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Editar Paquete turístico</button>
                </div>
            
            </form>

            <?php

                $editarPaquete = new ControladorPaquetes();
                $editarPaquete -> ctrEditarPaquete();

            ?>

        </div>
    </div>
</div>


<?php

  $eliminarPaquete = new ControladorPaquetes();
  $eliminarPaquete -> ctrEliminarPaquete();

?>



<!--=====================================
MODAL CREAR ITINERARIO 
======================================-->
               
<div class="modal fade" id="modalPaqueteAgragarImagenes" tabindex="-1" role="dialog" aria-labelledby="modalItinerario" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPaquete"></h5>
                <input type="hidden" id="hidden_itinerario">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="mostrarModalPaquetes()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-row">
                    <div class="col-md-12">
                        <div class="position-relative form-group">
                            
                            <!-- ENTRADA PARA IMAGEN-->
                            <div class="input-group">
                                <form method="post" id="upload_form">                            
                                    <input type="file" class="form-control-file paqueteNuevoImagenVisualizar" id="campanaNuevoImagen">
                                    <small class="form-text text-muted">Agrege una imagen para la campaña con las dimensiones 540x290.</small>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                
                <div class="text-center">
                    <img src=""" class="img-thumbnail previsualizarPaquete" id="previsualizarPaquete" width="100px">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="mostrarModalPaquetes()">Salir</button>
                <button type="button" id="btnPaquete" class="btn btn-primary nuevoPaqueteImagenTemporal"></button>
            </div>
        </div>
    </div>
</div>