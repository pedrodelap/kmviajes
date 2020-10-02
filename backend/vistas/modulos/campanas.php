<div class="app-main__inner">

    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Campañas Turisticas
                    <div class="page-title-subheading">This is an example dashboard created using build-in elements and components.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">

                    <button type="button" class="btn-shadow btn btn-primary" data-toggle="modal" data-target="#modalNuevoCampana">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="pe-7s-add-user pe-7s-w-20"></i>
                        </span>
                        Campañas Turisticas
                    </button>

            </div>
        </div>
    </div>

    <div class="row animated fadeIn">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Campañas Turisticas </h5>

                        <!--=====================================
                                        CAMPAÑAS
                        table table-striped table-bordered dt-responsive tablas align-middle text-truncate mb-0 table-borderless table-hover
                        ======================================-->

                        <table class="table table-striped table-bordered tablas mb-0 table table-borderless table-hover">

                            <thead>
                            
                                <tr>
                                    
                                    <th style="width:10px">#</th>

                                    <th>Nombre</th>

                                    <th>Descripción</th>

                                    <th>Nuevo / Oferta</th>

                                    <th class="text-right">Acciones</th>

                                </tr> 

                            </thead> 
                            <tbody>

                                <?php

                                $item = null;

                                $valor = null;

                                $descripcion_corta = "";

                                $clientes = ControladorCampanas::ctrMostrarCampanas($item, $valor);

                                foreach ($clientes as $key => $value) {

                                    $descripcion_corta = $value["descripcion_corta"];

                                    $cuerpo = "";

                                    $flag_nuevo = "";
                                    
                                    $flag_oferta = "";

                                    if( 85 < strlen($descripcion_corta))
                                    {
                                        $descripcion_corta = substr($descripcion_corta,0,strpos($descripcion_corta,' ',85));
                                        $descripcion_corta .= " ...";
                                    }
                                    
                                    if( 1 == $value["flag_nuevo"] ){

                                        $flag_nuevo = '<div class="badge badge-pill badge-success">Nueva</div>';

                                    }

                                    if( 1 == $value["flag_oferta"] ){

                                        $flag_oferta = '<div class="badge badge-pill badge-info">Oferta</div>';

                                    }

                                    if( 0 == $value["flag_oferta"] && 0 == $value["flag_nuevo"] ){

                                        $flag_oferta = '<div class="badge badge-pill badge-warning">Sin etiqueta</div>';

                                    }

                                      echo '<td>'.($key+1).'</td>

                                            <td>'.$value["nombre"].'</td>

                                            <td>'.$descripcion_corta.'</td>

                                            <td>'.$flag_nuevo.' '.$flag_oferta.'</td>

                                            <td class="text-right">
                                
                                                <span><button class="btn btn-secondary fa fa-edit btnEditarCliente" idCampana="'.$value["id_campania"].'" data-toggle="modal" data-target="#modalEditarCliente"></button></span>&nbsp;';

                                                if($_SESSION["perfil"] == "Administrador"){

                                                    echo '<span><button class="btn btn-danger fa fa-times btnEliminarCliente" idCampana="'.$value["id_campania"].'"></button></span>';
                                                }

                                      echo '</td>

                                        </tr>';

                                    }

                                ?>

                            </tbody>

                        </table>
                        
                        <!--====  Fin de CAMPAÑAS  ====-->
                </div>
            </div>
        </div>
    </div>
</div>


<!--=====================================
MODAL AGREGAR CAMPAÑA TURISTICA 
======================================-->

<div class="modal fade" id="modalNuevoCampana" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form role="form" method="post" enctype="multipart/form-data"  id="formCapana">

                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Nueva Campañas turisticas </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">

                    <!-- ENTRADA PARA EL NOMBRE -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-images"></i></span>
                        </div>
                        <input placeholder="Nombre" name="campanaNuevoNombre" type="text" class="form-control" required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA LA DESCRIPCION CORTA -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-file-word"></i></span>
                        </div>
                        <input placeholder="Descripcion corta" name="campanaNuevoDescripcionCorta" type="text" class="form-control" required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA LA DESCRIPCION LARGA -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-file-word"></i></span>
                        </div>
                        <textarea placeholder="Descripcion larga" name="campanaNuevoDescripcionLarga" rows="3" class="form-control" required></textarea>
                    </div>
                    <br>

                    <!-- ENTRADA PARA MARCAR LA OFERTA-->
                    <h5 class="card-title">Ribbon para la imagen</h5>
                    <div class="position-relative form-group">
                        <div>
                            <div class="custom-checkbox custom-control custom-control-inline">
                                <input type="checkbox" id="chklCampanaRibbonNuevo" name="chklCampanaRibbon[]" value="1" class="custom-control-input">
                                    <label class="custom-control-label" for="chklCampanaRibbonNuevo">Nuevo</label>
                            </div>
                            <div class="custom-checkbox custom-control custom-control-inline">
                                <input type="checkbox" id="chklCampanaRibbonOferta" name="chklCampanaRibbon[]" value="1" class="custom-control-input">
                                    <label class="custom-control-label" for="chklCampanaRibbonOferta">Oferta</label>
                            </div>
                        </div>
                    </div>

                    <!-- ENTRADA PARA IMAGEN-->
                    <div class="input-group">
                        <input type="file" class="form-control-file campanaNuevoImagen" name="campanaNuevoImagen">
                        <small class="form-text text-muted">Agrege una imagen para la campaña con las dimensiones 540x290.</small>
                    </div>
                    <br>

                    <div class="text-center">
                        <img src="vistas/images/campana/campana_default.png" class="img-thumbnail previsualizar" width="100px">
                    </div>
                </div>

                <!--=====================================
                PIE DEL MODAL
                ======================================-->

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar campaña turistica</button>
                </div>
            
            </form>

            <?php

                $crearCampana = new ControladorCampanas();
                $crearCampana -> ctrCrearCampana();

            ?>

        </div>
    </div>
</div>

<!--=====================================
MODAL EDITAR CAMPAÑA TURISTICA 
======================================-->

<div class="modal fade" id="modalEditarCampana" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form role="form" method="post">

                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Editar Campañas turisticas </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">

                    <!-- ENTRADA PARA EL NOMBRE -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Nombre" name="campanaEditarNombre" type="text" class="form-control" required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA LA DESCRIPCION CORTA -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Descripcion corta" name="campanaEditarDescripcionCorta" type="text" class="form-control" required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA LA DESCRIPCION LARGA -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <textarea placeholder="Descripcion larga" name="campanaEditarDescripcionLarga" class="form-control" required></textarea>
                    </div>
                    <br>

                    <!-- ENTRADA PARA MARCAR LA OFERTA-->
                    <div class="input-group">
                        <div class="custom-checkbox custom-control">
                            <input type="checkbox" name="campanaEditarOferta" class="custom-control-input">
                                <label class="custom-control-label" for="exampleCustomCheckbox">Marcar como Oferta </label>
                        </div>
                    </div>
                    <br>

                     <!-- ENTRADA PARA IMAGEN-->
                    <div class="input-group">
                            <input name="file" name="campanaEditarImagen" type="file" class="form-control-file">
                                <small class="form-text text-muted">Agrege una imagen para la campaña con las dimensiones 540x290.</small>
                    </div>

                </div>

                <!--=====================================
                PIE DEL MODAL
                ======================================-->

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar campaña turistica</button>
                </div>
            
            </form>

            <?php

                $editarCampana = new ControladorCampanas();
                $editarCampana -> ctrEditarCampana();

            ?>

        </div>>
    </div>
</div>


<?php

  $eliminarCampana = new ControladorCampanas();
  $eliminarCampana -> ctrEliminarCampana();

?>

