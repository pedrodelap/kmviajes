<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Nueva Cotizacion
                    <div class="page-title-subheading">Easily create beautiful form multi step wizards!</div>
                </div>
            </div>
            <div class="page-title-actions" id="divBotonesCotizacion">
            </div>
       </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card element-block-example">
                <div class="card-body">

                    <h5 class="card-title">Seleccionar Cliente </h5>

                        <!--=====================================
                                        NUEVA COTIZACION
                        ======================================-->

                        <div class="position-relative form-group">
                            <select class="form-control" name="cotizacionNuevoCliente" id="cotizacionNuevoCliente">
                            </select>
                            <input type="hidden" id="hidden_cotizacion_id" value="" >
                            <input type="hidden" id="hidden_propuesta_id" value="" >
                            <input type="hidden" id="hidden_usuario_creacion" value="<?php echo $_SESSION["usuario"];?>">
                        </div>

                        <h5 class="card-title">Agregar Propuesta </h5>

                        <button type="button" class="btn-shadow btn btn-primary" onclick="validarClienteSeleccionado()" >
                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                <i class="pe-7s-add-user pe-7s-w-20"></i>
                            </span>
                            Crear Propuesta
                        </button>
                        <hr>

                        <table class="table-striped  dt-responsive tablas align-middle text-truncate table table-borderless table-hover">

                            <thead>

                                <tr>
                                    <th>Id</th>
                                    <th>Viaje</th>
                                    <th>Aerolinea</th>
                                    <th>Cant. Pasajeros</th>
                                    <th>Moneda</th>
                                    <th>Cant. SF</th>
                                    <th>Cant. FEE</th>
                                    <th>Estado</th>
                                    <th>Usuario Mod.</th>
                                    <th>Fecha Mod.</th>
                                    <th>Acciones</th>
                                </tr> 

                            </thead>

                            <tbody id="tablaPropuesta" >

                            </tbody>

                        </table>

                        <!--====  Fin de NUEVA COTIZACION  ====-->

                 </div>
            </div>
        </div>
    </div>

    <div class="body-block-example-2 d-none">
        <div class="loader">   
            <div class="square-spin">
                <div style="background-color: rgb(63, 106, 216);"></div>
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
                style="background:#495057; color:white"
                ======================================-->

                <div class="modal-header" style="background:#495057; color:white">
                    <h5 class="modal-title" id="exampleModalLongTitle">Agregar cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">

                    <input type="hidden" id="hidden_cliente_desde_cotizacion" value=true >

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
                        <select class="form-control" name="clienteNuevoTipoDocumento">                    
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
                            <span class="input-group-text"><i class="">@</i></span>
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
MODAL CREAR PROPUESTA 
======================================-->
               
<div class="modal fade" id="modalNuevoPropuesta" tabindex="-1" role="dialog" aria-labelledby="modalPropuesta" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">            

                <!--=====================================
                CABEZA DEL MODAL
                style="background:#495057; color:white"
                ======================================-->

                <div class="modal-header">
                    <h5 class="modal-title" id="modalPropuesta">Crear Propuesta </h5>
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
                                    <em>1</em><span>Account Information</span>
                                </a>
                            </li>
                            <li>
                                <a href="#step-2">
                                    <em>2</em><span>Payment Information</span>
                                </a>
                            </li>
                            <li>
                                <a href="#step-3">
                                    <em>3</em><span>Payment Information</span>
                                </a>
                            </li>
                        </ul>

                        <div class="form-wizard-content">

                            <div id="step-1">
                                <div id="accordion" class="accordion-wrapper mb-3">
                                    <div class="card">
                                        <div id="headingOne" class="card-header">
                                            <button type="button" aria-expanded="false" aria-controls="collapseOne" class="text-left m-0 p-0 btn btn-link btn-block">
                                                <span class="form-heading">Account Information<p>Enter your user informations below</p></span>
                                            </button>
                                        </div>
                                        <div data-parent="#accordion" id="collapseOne" aria-labelledby="headingOne" class="collapse show">
                                            
                                            <div class="card-body">
                                                <div class="position-relative form-group">
                                                    <div class="grid-menu grid-menu-3col">
                                                        <div class="no-gutters row">
                                                            <div class="col-sm-4">
                                                                <div class="btn-icon-vertical btn-square btn-transition btn btn-outline-primary"><i class="lnr-license btn-icon-wrapper btn-icon-lg mb-3"></i>Solo ida
                                                                    <div class="custom-radio custom-control">
                                                                        <input type="radio" value="Solo ida" id="TipoViajeSoloIda" name="cotizacionNuevoTipoViaje" class="custom-control-input">
                                                                        <label class="custom-control-label" for="TipoViajeSoloIda"></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="btn-icon-vertical btn-square btn-transition btn btn-outline-primary"><i class="lnr-map btn-icon-wrapper btn-icon-lg mb-3"> </i>Ida y vuelta
                                                                    <div class="custom-radio custom-control">
                                                                        <input type="radio" value="Ida y vuelta" id="TipoViajeIdaYVuelta" name="cotizacionNuevoTipoViaje" class="custom-control-input">
                                                                        <label class="custom-control-label" for="TipoViajeIdaYVuelta"></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="btn-icon-vertical btn-square btn-transition btn btn-outline-primary"><i class="lnr-music-note btn-icon-wrapper btn-icon-lg mb-3"></i>Destinos Múltiples
                                                                    <div class="custom-radio custom-control">
                                                                        <input type="radio" value="Destinos Múltiples" id="TipoViajeDestinosMultiples" name="cotizacionNuevoTipoViaje" class="custom-control-input">
                                                                        <label class="custom-control-label" for="TipoViajeDestinosMultiples"></label>
                                                                    </div>
                                                                </div>
                                                            </div>                                                            

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="position-relative form-group">
                                                    <label for="cotizacionNuevoAerolinea">Aerolínea</label>
                                                    <select class="form-control" name="cotizacionNuevoAerolinea" id="cotizacionNuevoAerolinea">
                                                    </select>
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

                                                <div class="col-6 col-md-3">
                                                    <div class="position-relative form-group">
                                                    <label for="cotizacionNuevoTipoMoneda">Tipo moneda </label>
                                                    <select class="form-control" name="cotizacionNuevoTipoMoneda" id="cotizacionNuevoTipoMoneda" required>
                                                        <option value='' selected disabled hidden>Seleccionar moneda</option>
                                                        <?php

                                                            $item = null;
                                                            
                                                            $valor = null;

                                                            $tipoMonedas = ControladorMonedas::ctrMostrarMonedas($item, $valor);

                                                            foreach ($tipoMonedas as $key => $value) {

                                                                echo '<option value="'.$value["id_moneda"].'">'.$value["nombre"].'</option>';
                                                            }

                                                        ?>
                                                    </select>
                                                    </div>
                                                </div>

                                                <div class="col-6 col-md-2">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoDetraccion">Detracción </label>
                                                        <div class="input-group">
                                                            <input name="cotizacionNuevoDetraccion" id="cotizacionNuevoDetraccion" class="form-control" maxlength="2" onkeyup="precioTotal()" required>
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">%</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-6 col-md-2">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoTotalFEE ">Total FEE </label>
                                                        <div class="input-group">
                                                            <input name="cotizacionNuevoTotalFEE" id="cotizacionNuevoTotalFEE" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-6 col-md-2">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoTotalCF">Total CF </label>
                                                        <div class="input-group">
                                                            <input name="cotizacionNuevoTotalCF" id="cotizacionNuevoTotalCF" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-6 col-md-2">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoTotal">Total Ganancia </label>
                                                        <div class="input-group">
                                                            <input name="cotizacionNuevoTotal" id="cotizacionNuevoTotal" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <hr>
                                            <div class="form-row">

                                                <div class="col-6 col-md-1">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoAdultosCantidad">&nbsp;</label>
                                                        <h5 class="card-title">Adultos </h5>
                                                    </div>
                                                </div>

                                                <div class="col-6 col-md-2">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoAdultosCantidad">Cant. Adultos </label>
                                                        <input name="cotizacionNuevoAdultosCantidad" id="cotizacionNuevoAdultosCantidad" class="form-control" onkeyup="precioTotal()">
                                                    </div>
                                                </div>                                                  

                                                <div class="col-6 col-md-2">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoAdultosSF">SF Adultos </label>
                                                        <input name="cotizacionNuevoAdultosSF" id="cotizacionNuevoAdultosSF" class="form-control" onkeyup="precioTotal()">
                                                    </div>
                                                </div>

                                                <div class="col-6 col-md-2">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoAdultosFee">FEE Adultos </label>
                                                        <input name="cotizacionNuevoAdultosFee" id="cotizacionNuevoAdultosFee" class="form-control" onkeyup="precioTotal()">
                                                    </div>
                                                </div>

                                                <div class="col-6 col-md-2">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoAdultosTotalCF">Total CF Adultos </label>
                                                    <input name="cotizacionNuevoAdultosTotalCF" id="cotizacionNuevoAdultosTotalCF" class="form-control" onkeyup="precioTotal()" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-6 col-md-2">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoAdultosTotalGanancia">Total Ganancia Adultos </label>
                                                        <input name="cotizacionNuevoAdultosTotalGanancia" id="cotizacionNuevoAdultosTotalGanancia" class="form-control" onkeyup="precioTotal()" readonly>
                                                    </div>
                                                </div>

                                            </div>

                                            <hr>
                                            <div class="form-row">

                                                <div class="col-6 col-md-1">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoNinioCantidad">&nbsp;</label>
                                                        <h5 class="card-title">Niños </h5>
                                                    </div>
                                                </div>

                                                <div class="col-6 col-md-2">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoNinioCantidad">Cant. Niños </label>
                                                    <input name="cotizacionNuevoNinioCantidad" id="cotizacionNuevoNinioCantidad" class="form-control" onkeyup="precioTotal()">
                                                    </div>
                                                </div>                                                

                                                <div class="col-6 col-md-2">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoNinioSF">SF Niños </label>
                                                        <input name="cotizacionNuevoNinioSF" id="cotizacionNuevoNinioSF" class="form-control" onkeyup="precioTotal()">
                                                    </div>
                                                </div>

                                                <div class="col-6 col-md-2">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoNinioFee">FEE Niños</label>
                                                        <input name="cotizacionNuevoNinioFee" id="cotizacionNuevoNinioFee" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-6 col-md-2">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoNinioTotalCF">Total CF Niños</label>
                                                    <input name="cotizacionNuevoNinioTotalCF" id="cotizacionNuevoNinioTotalCF" class="form-control" onkeyup="precioTotal()" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-6 col-md-2">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoNinioTotalGanancia">Total Ganancia Niños</label>
                                                        <input name="cotizacionNuevoNinioTotalGanancia" id="cotizacionNuevoNinioTotalGanancia" class="form-control" onkeyup="precioTotal()" readonly>
                                                    </div>
                                                </div>

                                            </div>

                                            <hr>
                                            <div class="form-row">

                                                <div class="col-6 col-md-1">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoInfanteCantidad">&nbsp;</label>
                                                        <h5 class="card-title">Infante </h5>
                                                    </div>
                                                </div>

                                                <div class="col-6 col-md-2">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoInfanteCantidad">Cant. Infante </label>
                                                    <input name="cotizacionNuevoInfanteCantidad" id="cotizacionNuevoInfanteCantidad" class="form-control" onkeyup="precioTotal()">
                                                    </div>
                                                </div>

                                                <div class="col-6 col-md-2">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoInfanteSF">SF Infante </label>
                                                        <input name="cotizacionNuevoInfanteSF" id="cotizacionNuevoInfanteSF" class="form-control" onkeyup="precioTotal()">
                                                    </div>
                                                </div>

                                                <div class="col-6 col-md-2">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoInfanteFee">FEE Infante </label>
                                                        <input name="cotizacionNuevoInfanteFee" id="cotizacionNuevoInfanteFee" class="form-control" onkeyup="precioTotal()">
                                                    </div>
                                                </div>

                                                <div class="col-6 col-md-2">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoInfanteTotalCF">Total CF Infante </label>
                                                    <input name="cotizacionNuevoInfanteTotalCF" id="cotizacionNuevoInfanteTotalCF" class="form-control" onkeyup="precioTotal()" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-6 col-md-2">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoInfanteTotalGanancia">Total Ganancia Infante </label>
                                                        <input name="cotizacionNuevoInfanteTotalGanancia" id="cotizacionNuevoInfanteTotalGanancia" class="form-control" onkeyup="precioTotal()" readonly>
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
                                                <span class="form-heading">Account Information<p>Enter your user informations below</p></span>
                                            </button>
                                        </div>
                                        <div data-parent="#accordion" id="collapseOne" aria-labelledby="headingOne" class="collapse show">
                                            <div class="card-body">

                                                <div class="position-relative form-group">
                                                    <button type="button" class="btn-shadow btn btn-primary" id="btnAgregarItinerario" onclick="addItenerario()">
                                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                                            <i class="pe-7s-add-user pe-7s-w-20"></i>
                                                        </span>
                                                        Agregar Itinerario
                                                    </button>
                                                </div>

                                                <hr>

                                                <h5 class="card-title">Table de Itinerarios</h5>
                                                <table class="mb-0 table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th> # </th>
                                                        <th>Origen</th>
                                                        <th>Destino</th>
                                                        <th>Fecha Vuelo</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="tablaItinerario">

                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="clearfix">
                        <button type="button" class="btn-shadow float-left btn btn-link" onclick="limpiar()">Limpiar Propuesta</button>

                        <button type="button" class="btn-shadow btn-wide float-right btn-pill btn-hover-shine btn btn-primary" onclick="adicionarCotizacion()" >Terminar</button>

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
MODAL CREAR ITINERARIO 
======================================-->
               
<div class="modal fade" id="modalNuevoItinerario" tabindex="-1" role="dialog" aria-labelledby="modalItinerario" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalItinerario"></h5>
                <input type="hidden" id="hidden_itinerario">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="mostrarModalPropuesta()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-row">
                    <div class="col-md-12">
                        <div class="position-relative form-group">
                            <label for="itinerarioNuevoOrigen">Origen</label>
                            <select class="form-control input-lg cotizacionNuevoAeropuerto" id="itinerarioNuevoOrigen" >
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="position-relative form-group">
                            <label for="itinerarioNuevoDestino">Destino</label>
                            <select class="form-control input-lg cotizacionNuevoAeropuerto" id="itinerarioNuevoDestino" >
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="position-relative form-group">
                            <label for="itinerarioNuevoFechaVuelo">Fecha Vuelo</label>
                            <input type="text" class="form-control cotizacionNuevoFecha" id="itinerarioNuevoFechaVuelo" placeholder="Ingresar fecha de vuelo"/>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="mostrarModalPropuesta()">Salir</button>
                <button type="button" id="btnItinerario" class="btn btn-primary" onclick="itinerarioActualizar()"></button>
            </div>
        </div>
    </div>
</div>

