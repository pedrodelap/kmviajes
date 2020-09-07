 <div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Aerolineas
                    <div class="page-title-subheading">This is an example dashboard created using build-in elements and components.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
<<<<<<< HEAD
                <button type="button" class="btn-shadow btn btn-info" data-toggle="modal" data-target="#modalNuevoAerolinea">
=======
                <button type="button" class="btn-shadow btn btn-primary" data-toggle="modal" data-target="#modalNuevoAerolinea">
>>>>>>> 90cfe57fea136401cc7ad60f34fbe43057d7108d
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="pe-7s-add-user pe-7s-w-20"></i>
                    </span>
                    Agregar Aerolinea
                </button>
            </div>
        </div>
    </div>

<<<<<<< HEAD
    <div class="row">
=======
    <div class="row animated fadeIn">
>>>>>>> 90cfe57fea136401cc7ad60f34fbe43057d7108d
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">

                    <h5 class="card-title">Listado de Aerolineas </h5>

                        <!--=====================================
                                        AEROLINEAS
                        ======================================-->

                        <table class="table table-striped table-bordered tablas mb-0 table table-borderless table-hover">
<<<<<<< HEAD
=======
                                      
>>>>>>> 90cfe57fea136401cc7ad60f34fbe43057d7108d

                            <thead>
                            
                                <tr>

                                    <th style="width:10px">#</th>
                                    <th>Codigo</th>
                                    <th>Compañia</th>
                                    <th>Direccion</th>
                                    <th>Teléfono</th>
                                    <th>Teléfono Carga</th>
                                    <th>Tipo</th>
<<<<<<< HEAD
                                    <th class="text-center">Acciones</th>
=======
                                    <th>Acciones</th>
>>>>>>> 90cfe57fea136401cc7ad60f34fbe43057d7108d

                                </tr> 

                            </thead> 
                            <tbody>

                                <?php

                                $item = null;
                                $valor = null;

                                $aerolineas = ControladorAerolineas::ctrMostrarAerolineas($item, $valor);

                                foreach ($aerolineas as $key => $value) {


                                    echo '<tr>

                                            <td>'.($key+1).'</td>

                                            <td>'.$value["codigo"].'</td>';

                                            if ($value["url"] == ""){

                                                echo '<td>'.$value["compania"].'</td>';

                                            } else {

                                                echo '<td><a href="'.$value["url"].'" target="_blank">'.$value["compania"].'</a></td>';
                                            }

                                    echo '<td>'.$value["direccion"].'</td>

                                            <td>'.$value["telefono"].'</td>

                                            <td>'.$value["telefono_carga"].'</td>

                                            <td>'.$value["tipo"].'</td>

<<<<<<< HEAD
                                            <td class="text-center">

                                            <div role="group" class="btn-group-sm btn-group">
                                                
                                                <button class="btnEditarAerolinea border-0 btn-transition btn btn-outline-warning"  data-toggle="modal" data-target="#modalEditarAerolinea" idAerolinea="'.$value["id_aerolinea"].'"><i class="lnr-pencil btn-icon-wrapper">&nbsp;</i>Editar</button>';

                                                if($_SESSION["perfil"] == "Administrador"){

                                                    echo '<button class="btnEliminarAerolinea border-0 btn-transition btn btn-outline-danger" idAerolinea="'.$value["id_aerolinea"].'"><i class="lnr-cross btn-icon-wrapper">&nbsp;</i>Eliminar</button>';

                                                }

                                            echo '</div>  

                                            </td>
=======
                                            <td>
                                                
                                                <span><button class="btn btn-secondary fa fa-edit btnEditarAerolinea" idAerolinea="'.$value["id_aerolinea"].'" data-toggle="modal" data-target="#modalEditarAerolinea"></button></span>&nbsp;';

                                                if($_SESSION["perfil"] == "Administrador"){

                                                    echo '<span><button class="btn btn-danger fa fa-times btnEliminarAerolinea" idAerolinea="'.$value["id_aerolinea"].'"></button></span>';

                                                }

                                        echo '</td>
>>>>>>> 90cfe57fea136401cc7ad60f34fbe43057d7108d

                                        </tr>';
                                
                                    }

                                ?>
                            
                            </tbody>

                        </table>

                        <!--====  Fin de AEROLINEAS  ====-->

                 </div>
            </div>
        </div>
    </div>

</div>


<!--=====================================
MODAL AGREGAR AEROLINEA
======================================-->

<div class="modal fade" id="modalNuevoAerolinea" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form role="form" method="post">

                <!--=====================================
                CABEZA DEL MODAL
                style="background:#495057; color:white"
                ======================================-->

<<<<<<< HEAD
                <div class="modal-header" style="background:#495057; color:white">
=======
                <div class="modal-header">
>>>>>>> 90cfe57fea136401cc7ad60f34fbe43057d7108d
                    <h5 class="modal-title" id="exampleModalLongTitle">Agregar aerolinea</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">

                    <!-- ENTRADA PARA EL CODIGO -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Codigo" name="aerolineaNuevoCodigo" type="text" class="form-control" required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA LA URL -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Pagina web" name="aerolineaNuevoURL" type="text" class="form-control" required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA EL NOMBRE -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Nombre de la Aerolinea" name="aerolineaNuevoNombre" type="text" class="form-control" required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA EL DIRECCION -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Direccion" name="aerolineaNuevoDireccion" type="text" class="form-control" required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA EL TELEFONO -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Telefono" name="aerolineaNuevoTelefono" type="text" class="form-control" required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA EL TELEFONO DE CARGA-->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Telefono de carga" name="aerolineaNuevoTelefonoCarga" type="text" class="form-control" required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA EL TIPO DE AEROLINEA -->
                    <div class="input-group">               
                        <span class="input-group-text"><i class="lnr-menu"></i></span>
                        <select class="form-control" name="aerolineaNuevoTipoAerolinea">                    
                            <option value="">Tipo Aerolinea</option>
                            <option value="AEROLÍNEA NACIONAL">AEROLÍNEA NACIONAL</option>
                            <option value="AEROLÍNEA INTERNACIONAL">AEROLÍNEA INTERNACIONAL</option>                    
                        </select>
                    </div>
                    <br>

                </div>

                <!--=====================================
                PIE DEL MODAL
                ======================================-->

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar aerolinea</button>
                </div>
            
            </form>

            <?php

                $crearAerolinea = new ControladorAerolineas();
                $crearAerolinea -> ctrCrearAerolinea();

            ?>

        </div>
    </div>
</div>

<!--=====================================
MODAL EDITAR AEROLINEA
======================================-->

<div class="modal fade" id="modalEditarAerolinea" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form role="form" method="post">

                <!--=====================================
                CABEZA DEL MODAL
<<<<<<< HEAD
                style="background:#495057; color:white"
                ======================================-->

                <div class="modal-header" style="background:#495057; color:white">
=======
                ======================================-->

                <div class="modal-header">
>>>>>>> 90cfe57fea136401cc7ad60f34fbe43057d7108d
                    <h5 class="modal-title" id="exampleModalLongTitle">Editar aerolinea</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">

                    <!-- ENTRADA ID AEROLINEA -->
                    <input type="hidden" id="idAerolinea" name="idAerolinea">

                    <!-- ENTRADA PARA EL CODIGO -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Codigo" name="aerolineaEditarCodigo" id="aerolineaEditarCodigo" type="text" class="form-control" required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA LA URL -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Pagina web" name="aerolineaEditarURL" id="aerolineaEditarURL" type="text" class="form-control">
                    </div>
                    <br>

                    <!-- ENTRADA PARA EL NOMBRE -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Nombre de la Aerolinea" name="aerolineaEditarNombre" id="aerolineaEditarNombre" type="text" class="form-control" required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA EL DIRECCION -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Direccion" name="aerolineaEditarDireccion" id="aerolineaEditarDireccion" type="text" class="form-control">
                    </div>
                    <br>

                    <!-- ENTRADA PARA EL TELEFONO -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Telefono" name="aerolineaEditarTelefono" id="aerolineaEditarTelefono" type="text" class="form-control">
                    </div>
                    <br>

                    <!-- ENTRADA PARA EL TELEFONO DE CARGA-->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Telefono de carga" name="aerolineaEditarTelefonoCarga" id="aerolineaEditarTelefonoCarga" type="text" class="form-control">
                    </div>
                    <br>

                    <!-- ENTRADA PARA EL TIPO DE AEROLINEA -->
                    <div class="input-group">               
                        <span class="input-group-text"><i class="lnr-menu"></i></span>
                        <select class="form-control" name="aerolineaEditarTipoAerolinea">                    
                            <option value="" id="aerolineaEditarTipoAerolinea"></option>
                            <option value="AEROLÍNEA NACIONAL">AEROLÍNEA NACIONAL</option>
                            <option value="AEROLÍNEA INTERNACIONAL">AEROLÍNEA INTERNACIONAL</option>                    
                        </select>
                    </div>
                    <br>

                </div>

                <!--=====================================
                PIE DEL MODAL
                ======================================-->

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Editar aerolinea</button>
                </div>
            
            </form>

            <?php

                $editarAerolinea = new ControladorAerolineas();
                $editarAerolinea -> ctrEditarAerolinea();

            ?>

        </div>
    </div>
</div>


<?php

  $eliminarAerolinea = new ControladorAerolineas();
  $eliminarAerolinea -> ctrEliminarAerolinea();

?>

