<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Documento electrónicos generados
                    <div class="page-title-subheading">En esta sección podrás generar el documento electrónico de venta
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <a href="cotizacion-crear" class="btn-shadow btn btn-primary">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="pe-7s-add-user pe-7s-w-20"></i>
                    </span>
                    Generar documento
                </a>
            </div>
        </div>
    </div>

    <div class="row animated fadeIn">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                   
                    <h5 class="card-title">Listado de documentos generados </h5>

                        <!--=====================================
                                        LISTADO COTIZACIONES
                        ======================================-->

                        <table class="table table-striped table-bordered tablas mb-0 table table-borderless table-hover">

                            <thead>
                            
                                <tr>
                                    
                                    <th style="width:10px">Id</th>
                                    <th>Tipo Doc</th>
                                    <th>Serie</th>
                                    <th>Correlativo</th>
                                    <th>Fecha</th>
                                    <th>Total Neto</th>
                                    <th>Cliente</th>
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

                                            <td>

                                                <span><button class="btn btn-secondary fa fa-edit btnEditarCotizacion" idCotizacion="'.$value["id_cotizacion"].'"></button></span>&nbsp;';

                                                if($_SESSION["perfil"] == "Administrador"){

                                                    echo '<span><button class="btn btn-danger fa fa-times btnEliminarCliente" idCotizacion="'.$value["id_cotizacion"].'"></button></span>';

                                                }

                                      echo '</td>

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

<div class="modal fade" id="modalRegistroDocumento" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form role="form" method="post">

                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Generar Documento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">

                    <div class="input-group">               
                        <span class="input-group-text"><i class="lnr-menu"></i></span>
                        <select class="mb-2 form-control form-control" name="docElectronicoTipo">                    
                            <option>Tipo documento</option>
                            <option value="03">Boleta</option>
                            <option value="01">Factura</option>
                        </select>
                    </div>
                    <!-- ENTRADA PARA LOS NOMBRES -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Serie" id="docElectronicoSerie" type="text" class="form-control" required>
                    </div>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Correlativo" id="docElectronicoCorrelativo" type="text" class="form-control" required>
                    </div>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-calendar-full"></i></span>
                        </div>                        
                        <input class="form-control input-mask-trigger" id="docElectronicoFecha" placeholder="Fecha de Emisión"data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" im-insert="false">
                    </div>

                    <div class="input-group">               
                        <span class="input-group-text"><i class="lnr-menu"></i></span>
                        <select class="mb-2 form-control form-control" name="docElectronicoTipo">                    
                            <option>Tipo moneda</option>
                            <option value="PEN">Soles</option>
                            <option value="USD">Dolares</option>
                        </select>
                    </div>
                    
                    <div class="input-group">               
                        <span class="input-group-text"><i class="lnr-menu"></i></span>
                        <select class="mb-2 form-control form-control" name="docElectronicoTipo">                    
                            <option>Cliente</option>
                        </select>
                    </div>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Monto bruto" id="docElectronicoMontoBruto" type="text" class="form-control" required>
                    </div>
                    
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Monto neto" id="docElectronicoMontoNeto" type="text" class="form-control" required>
                    </div>
                    
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Monto IGV" id="docElectronicoMontoIGV" type="text" class="form-control" required>
                    </div>

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
                ======================================-->

                <div class="modal-header">
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

