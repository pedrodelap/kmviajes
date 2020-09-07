<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Cotizaciones
                    <div class="page-title-subheading">This is an example dashboard created using build-in elements and components.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
<<<<<<< HEAD
                <a href="cotizacion-crear" class="btn-shadow btn btn-info">
=======
                <a href="cotizacion-crear" class="btn-shadow btn btn-primary">
>>>>>>> 90cfe57fea136401cc7ad60f34fbe43057d7108d
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="pe-7s-add-user pe-7s-w-20"></i>
                    </span>
                    Agregar Cotizacion
                </a>
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
                   
                    <h5 class="card-title">Listado de Cotizaciones </h5>

                        <!--=====================================
                                        LISTADO COTIZACIONES
                        ======================================-->

<<<<<<< HEAD
                        <table class="table table-striped table-bordered dt-responsive tablas align-middle text-truncate mb-0 table-borderless table-hover">
=======
                        <table class="table table-striped table-bordered tablas mb-0 table table-borderless table-hover">
>>>>>>> 90cfe57fea136401cc7ad60f34fbe43057d7108d

                            <thead>
                            
                                <tr>
                                    
                                    <th style="width:10px">Id</th>
                                    <th>Cliente</th>
                                    <th>Usuario Mod.</th>
                                    <th>Fecha Mod.</th>
                                    <th>Estado</th>
                                    <th>PDF</th>
                                    <th>Enviar</th>
                                    <th class="text-center">Acciones</th>

                                </tr> 

                            </thead> 
                            <tbody>

                                <?php

                                $item = null;
                                $valor = null;

                                $cotizaciones = ControladorCotizaciones::ctrMostrarCotizaciones($item, $valor);

                                foreach ($cotizaciones as $key => $value) {
                                    

                                    echo '<tr>

                                            <td>'.$value["id_cotizacion"].'</td>

                                            <td>'.$value["cliente"].'</td>

                                            <td>'.$value["usuario_modificacion"].'</td>

                                            <td>'.$value["fecha_modificacion"].'</td>

                                            <td class="text-center">';

                                                if( $value["venta"] == 0 ){

                                                    echo '<a href="#" class="mb-2 mr-2 badge badge-info">Cotizacion</a>';
                                                }else{
                                                    echo '<a href="#" class="mb-2 mr-2 badge badge-success">Venta</a>';
                                                }

                                    echo '</td>

                                            <td><a href="#" class="mb-2 mr-2 badge badge-focus">Generar PDF</a></td>

                                            <td><a href="#" class="mb-2 mr-2 badge badge-alternate">Enviar Correo</a></td>

                                            <td class="text-center">

                                            <div role="group" class="btn-group-sm btn-group">
                                                
<<<<<<< HEAD
                                                <button class="btnEditarCotizacion border-0 btn-transition btn btn-outline-warning" idCotizacion="'.$value["id_cotizacion"].'"><i class="lnr-pencil btn-icon-wrapper">&nbsp;</i>Editar</button>';
                                                                
                                                if($_SESSION["perfil"] == "Administrador"){
                                                        
                                                    echo '<button class="btnEliminarCotizacion border-0 btn-transition btn btn-outline-danger" idCotizacion="'.$value["id_cotizacion"].'"><i class="lnr-cross btn-icon-wrapper">&nbsp;</i>Eliminar</button>';
                                                
=======
                                                <span><button class="btn btn-secondary fa fa-edit btnEditarCotizacion" idCotizacion="'.$value["id_cotizacion"].'"></button></span>&nbsp;';

                                                if($_SESSION["perfil"] == "Administrador"){

                                                    echo '<span><button class="btn btn-danger fa fa-times btnEliminarCotizacion" idCotizacion="'.$value["id_cotizacion"].'"></button></span>';                                                        
                                               
>>>>>>> 90cfe57fea136401cc7ad60f34fbe43057d7108d
                                                }

                                            echo '</div>  

                                            </td>

                                        </tr>';
                                
                                    }

                                ?>
                            
                            </tbody>

                        </table>

                        <!--====  Fin de LISTADO COTIZACIONES  ====-->

                 </div>
            </div>
        </div>
    </div>

</div>


<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div class="modal fade" id="modalNuevoCliente" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Agregar cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">

                    <!-- ENTRADA PARA LOS NOMBRES -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Nombres" name="clienteNuevoNombres" type="text" class="form-control" required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA LOS APELLIDOS -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Apellidos" name="clienteNuevoApellidos" type="text" class="form-control" required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA EL TIPO DOCUMENTO -->
                    <div class="input-group">               
                        <span class="input-group-text"><i class="lnr-menu"></i></span>
                        <select class="mb-2 form-control form-control" name="clienteNuevoTipoDocumento">                    
                            <option value="">Tpo documento</option>
                            <option value="DNI">DNI</option>
                            <option value="RUC">RUC</option>
                            <option value="PASAPORTE">PASAPORTE</option>
                            <option value="CARNET EXT.">CARNET EXT.</option>
                            <option value="OTROS">OTROS</option>                      
                        </select>
                    </div>
                    <br>

                    <!-- ENTRADA PARA EL NUMERO DE DOCUMENTO -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ion-android-apps"></i></span>
                        </div>
                        <input placeholder="Numero documento" name="clienteNuevoNumeroDocumento" type="text" class="form-control" required>
                    </div>
                    <br>               

                    <!-- ENTRADA PARA EL CORREO ELECTRONICO -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="">@</i></span>
                        </div>
                        <input placeholder="Correo electronico" name="clienteNuevoCorreo" type="email" class="form-control" required>
                    </div>
                    <br>       

                    <!-- ENTRADA PARA EL TELEFONO -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-phone-handset"></i></span>
                        </div>
                        <input placeholder="Telefono" name="clienteNuevoTelefono" type="text" class="form-control" required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-calendar-full"></i></span>
                        </div>                        
                        <input class="form-control input-mask-trigger" name="clienteNuevoFechaNacimiento" placeholder="Fecha de Nacimiento"data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" im-insert="false">
                    </div>
                    <br>


                </div>

                <!--=====================================
                PIE DEL MODAL
                ======================================-->

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar cliente</button>
                </div>
            
            </form>

            <?php

                $crearCliente = new ControladorClientes();
                $crearCliente -> ctrCrearCliente();

            ?>

        </div>
    </div>
</div>

<!--=====================================
MODAL EDITAR CLIENTE
======================================-->

<div class="modal fade" id="modalEditarCliente" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Editar cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">

                    <!-- ENTRADA ID CLIENTE -->
                    <input type="hidden" id="idCliente" name="idCliente">

                    <!-- ENTRADA PARA LOS NOMBRES -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Nombres" name="clienteEditarNombres" id="clienteEditarNombres" type="text" class="form-control" required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA LOS APELLIDOS -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Apellidos" name="clienteEditarApellidos" id="clienteEditarApellidos" type="text" class="form-control" required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA EL TIPO DOCUMENTO -->
                    <div class="input-group">               
                        <span class="input-group-text"><i class="lnr-menu"></i></span>
                        <select class="mb-2 form-control form-control" name="clienteEditarTipoDocumento">
                            <option value="" id="clienteEditarTipoDocumento"></option>
                            <option value="DNI">DNI</option>
                            <option value="RUC">RUC</option>
                            <option value="PASAPORTE">PASAPORTE</option>
                            <option value="CARNET EXT.">CARNET EXT.</option>
                            <option value="OTROS">OTROS</option>                      
                        </select>
                    </div>
                    <br>

                    <!-- ENTRADA PARA EL NUMERO DE DOCUMENTO -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ion-android-apps"></i></span>
                        </div>
                        <input placeholder="Numero documento" name="clienteEditarNumeroDocumento" id="clienteEditarNumeroDocumento" type="text" class="form-control" required>
                    </div>
                    <br>               

                    <!-- ENTRADA PARA EL CORREO ELECTRONICO -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="">@</i></span>
                        </div>
                        <input placeholder="Correo electronico" name="clienteEditarCorreo" id="clienteEditarCorreo" type="email" class="form-control" required>
                    </div>
                    <br>       

                    <!-- ENTRADA PARA EL TELEFONO -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-phone-handset"></i></span>
                        </div>
                        <input placeholder="Telefono" name="clienteEditarTelefono" id="clienteEditarTelefono" type="text" class="form-control" required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-calendar-full"></i></span>
                        </div>                        
                        <input class="form-control input-mask-trigger" name="clienteEditarFechaNacimiento" id="clienteEditarFechaNacimiento" placeholder="Fecha de Nacimiento"data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" im-insert="false">
                    </div>
                    <br>


                </div>

                <!--=====================================
                PIE DEL MODAL
                ======================================-->

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Editar cliente</button>
                </div>
            
            </form>

            <?php

                $editarCliente = new ControladorClientes();
                $editarCliente -> ctrEditarCliente();

            ?>

        </div>
    </div>
</div>


<?php

  $eliminarCliente = new ControladorClientes();
  $eliminarCliente -> ctrEliminarCliente();

?>

