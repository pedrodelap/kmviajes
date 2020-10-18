
<input type="hidden" id="hidden_cotizacion_id" value="" >

<input type="hidden" id="hidden_solicitud_id" value="">

<?php


$IdSolicitud = "";

$IdCotizacion = "";

if(isset($_GET['idSolicitud'])){

    $itemSolicitud = 'id_solicitud';

    $IdSolicitud = $_GET['idSolicitud'];

    $cliente = ControladorSolicitudes::ctrMostrarSolicitudes($itemSolicitud, $IdSolicitud);

    $item = 'id_cliente';

    $valor = $cliente['id_cliente'];

    $datosCliente = ControladorClientes::ctrMostrarClientes($item, $valor);

    $nombre = $datosCliente['nombres'].' '.$datosCliente['apellidos'];

    $item = 'id_cliente';

    $valor = $cliente['id_cliente'];

    $Cotizacion = ControladorSolicitudes:: ctrConsultrarIdCotizacion($IdSolicitud, $itemSolicitud);

    $IdCotizacion = $Cotizacion['id_cotizacion'];

    echo"<script>

    $(document).ready(function() {

        console.log('IdSolicitud','".$IdSolicitud."');
        console.log('IdCotizacion','".$IdCotizacion."');

        var newOption = new Option('".$nombre."', '".$valor."', true, true);
        $('#cotizacionNuevoCliente').append(newOption);
        $('#cotizacionNuevoCliente').prop('disabled', false);
        $('#hidden_solicitud_id').val('".$IdSolicitud."');
        $('#hidden_cotizacion_id').val('".$IdCotizacion."');

    });

    </script>";

}

?>


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
    <div class="row animated fadeIn">
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
                            
                            
                            <input type="hidden" id="hidden_propuesta_id" value="" >
                            <input type="hidden" id="hidden_usuario_creacion" value="<?php echo $_SESSION["usuario"];?>">
                        </div>

                        <h5 class="card-title">Agregar Propuesta </h5>

                        <button type="button" class="btn-shadow btn btn-primary" onclick="validarClienteSeleccionado()" >
                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                <i class="fas fa-file-powerpoint"></i>
                            </span>
                            Crear Propuesta
                        </button>&nbsp;

                        
                        <a href="tcpdf/pdf/cotizacion_personal.php?idSolicitud=61" target="blank">
                            <button type="button" class="btn-shadow btn btn-alternate">
                                <span class="btn-icon-wrapper pr-2 opacity-7">
                                    <i class="fas fa-file-pdf"></i>
                                </span>
                                Generar PDF
                            </button>&nbsp;
                        </a>

                        <button type="button" class="btn-shadow btn btn-focus" onclick="validarClienteSeleccionado()" >
                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                <i class="fas fa-envelope"></i>
                            </span>
                            Enviar Correo
                        </button>&nbsp;


                        <hr>

                        <table class="table-striped  dt-responsive tablas align-middle text-truncate table table-borderless table-hover">

                            <thead>

                                <tr>
                                    <th>Id</th>
                                    <th>Viaje</th>
                                    <th>Aerolinea</th>
                                    <th>Cant. Pasajeros</th>
                                    <th>Detraccion</th>
                                    <th>Costo</th>
                                    <th>Cuota</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr> 

                            </thead>

                            <tbody id="tablaPropuesta" >

                            <?php

                            

                            if(isset($_GET['idSolicitud'])){

                               $IdSolicitudTabla = $_GET['idSolicitud'];

                                $cliente = ControladorSolicitudes::ctrMostrarSolicitudes($item, $IdSolicitudTabla);
                                                            
                                $item = null;

                                $valor = $IdCotizacion;

                                $respuesta = ControladorPropuestas::ctrConsultarPropuestas($valor, $item);

                                echo $respuesta;


                            }

                            ?>

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
                ======================================-->

                <div class="modal-header">
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
                                    <em>1</em><span>Información Básica</span>
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

                                        <!--
                                        <div id="headingOne" class="card-header">
                                            <button type="button" aria-expanded="false" aria-controls="collapseOne" class="text-left m-0 p-0 btn btn-link btn-block">
                                                <span class="form-heading">Información inicial<p>Registre los datos iniciales para la propuesta de viaje</p></span>
                                            </button>
                                        </div>
                                        -->                                        
                                        <div data-parent="#accordion" id="collapseOne" aria-labelledby="headingOne" class="collapse show">
                                            
                                            <div class="card-body">

                                            
                                                <h5 class="card-title">Seleccione el tipo de viaje y la Aerolínea</h5>
                                                <div class="form-row">

                                                    <div class="col-md-6">
                                                        <div class="position-relative form-group">
                                                            <label for="cotizacionNuevoTipoViaje">Tipo de Viaje</label>
                                                            <select class="form-control" name="cotizacionNuevoTipoViaje" id="cotizacionNuevoTipoViaje">
                                                                <option value="solo ida">Solo ida</option>
                                                                <option value="ida y vuelta">Ida y vuelta</option>
                                                                <option value="destinos múltiples">Destinos múltiples</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="position-relative form-group">
                                                            <label for="cotizacionNuevoAerolinea">Aerolínea</label>
                                                            <select class="form-control" name="cotizacionNuevoAerolinea" id="cotizacionNuevoAerolinea">
                                                            </select>
                                                        </div>
                                                    </div>
                                                
                                                </div>
                                                
                                                <hr>
                                                <h5 class="card-title">Ingrese los precios a los servicios disponibles</h5>
                                                
                                                <div class="form-row">
                                                    <?php
                                                    /*
                                                    <div class="grid-menu grid-menu-xl grid-menu-2col">
                                                        <div class="no-gutters row">

                                                        

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
                                                    
                                                            
                                                        </div>
                                                    </div>
                                                    */
                                                    ?>
                                                    <div class="col-md-2">
                                                        <div class="position-relative form-group">
                                                            <label for="cotizacionNuevoServicioTraslados">Traslados</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-car-side"></i></span>
                                                                </div>
                                                                <input name="cotizacionNuevoServicioTraslados" id="cotizacionNuevoServicioTraslados" type="text" class="form-control  input-mask-trigger" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'prefix': '$ ', 'placeholder': '0'" im-insert="true" style="text-align: right;">                                                            </div> 
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="position-relative form-group">
                                                            <label for="cotizacionNuevoServicioAlojamiento">Noche de Alojamiento</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-hotel"></i></span>
                                                                </div>
                                                                <input name="cotizacionNuevoServicioAlojamiento" id="cotizacionNuevoServicioAlojamiento" type="text" class="form-control input-mask-trigger" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'prefix': '$ ', 'placeholder': '0'" im-insert="true" style="text-align: right;">
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="position-relative form-group">
                                                            <label for="cotizacionNuevoServicioIncluido">Sistema todo incluido</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-utensils"></i></span>
                                                                </div>
                                                                <input name="cotizacionNuevoServicioIncluido" id="cotizacionNuevoServicioIncluido" type="text" class="form-control input-mask-trigger" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'prefix': '$ ', 'placeholder': '0'" im-insert="true" style="text-align: right;">
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="position-relative form-group">
                                                            <label for="cotizacionNuevoServicioDesayuno">Desayuno</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-mug-hot"></i></span>
                                                                </div>
                                                                <input name="cotizacionNuevoServicioDesayuno" id="cotizacionNuevoServicioDesayuno" type="text" class="form-control input-mask-trigger" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'prefix': '$ ', 'placeholder': '0'" im-insert="true" style="text-align: right;">
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="position-relative form-group">
                                                            <label for="cotizacionNuevoServicioTarjeta">Tarjeta de Asistencia</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-credit-card"></i></span>
                                                                </div>
                                                                <input name="cotizacionNuevoServicioTarjeta" id="cotizacionNuevoServicioTarjeta" type="text" class="form-control input-mask-trigger" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'prefix': '$ ', 'placeholder': '0'" im-insert="true" style="text-align: right;">
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="position-relative form-group">
                                                            <label for="cotizacionNuevoServicioMaletas">Rastro de maletas</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                                                                </div>
                                                                <input name="cotizacionNuevoServicioMaletas" id="cotizacionNuevoServicioMaletas" type="text" class="form-control input-mask-trigger" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'prefix': '$ ', 'placeholder': '0'" im-insert="true" style="text-align: right;">
                                                            </div> 
                                                        </div>
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
                                            <hr>
                                            <div class="form-row">
                                                <div class="col-6 col-md-1">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoAdultosCantidad">&nbsp;</label>
                                                        <h5 class="card-title">Adultos </h5>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-1">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoAdultosCantidad">Cantidad</label>
                                                        <input name="cotizacionNuevoAdultosCantidad" id="cotizacionNuevoAdultosCantidad" class="form-control" onkeyup="precioTotal()">
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-2">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoAdultosCostoUnitario">Costo Unitario Adultos $ </label>
                                                        <input name="cotizacionNuevoAdultosCostoUnitario" id="cotizacionNuevoAdultosCostoUnitario" class="form-control" onkeyup="precioTotal()">
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-2">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoAdultosFee">Cuota (FEE) Adultos</label>
                                                        <input name="cotizacionNuevoAdultosFee" id="cotizacionNuevoAdultosFee" class="form-control" onkeyup="precioTotal()">
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-2">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoAdultosCobrar">Total Cobrar por Adultos </label>
                                                        <input name="cotizacionNuevoAdultosCobrar" id="cotizacionNuevoAdultosCobrar" class="form-control" onkeyup="precioTotal()" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-2">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoAdultosPagarAV">Pagar AV Mayorista </label>
                                                    <input name="cotizacionNuevoAdultosPagarAV" id="cotizacionNuevoAdultosPagarAV" class="form-control" onkeyup="precioTotal()" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-2">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoAdultosGanancia">Ganancia por Adultos </label>
                                                        <input name="cotizacionNuevoAdultosGanancia" id="cotizacionNuevoAdultosGanancia" class="form-control" onkeyup="precioTotal()" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="form-row">

                                                <div class="col-6 col-md-1">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoNinosCantidad">&nbsp;</label>
                                                        <h5 class="card-title">Niños </h5>
                                                    </div>
                                                </div>

                                                <div class="col-6 col-md-1">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoNinosCantidad">Cantidad</label>
                                                        <input name="cotizacionNuevoNinosCantidad" id="cotizacionNuevoNinosCantidad" class="form-control" onkeyup="precioTotal()">
                                                    </div>
                                                </div>                                                  

                                                <div class="col-6 col-md-2">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoNinosCostoUnitario">Costo Unitario Niños $ </label>
                                                        <input name="cotizacionNuevoNinosCostoUnitario" id="cotizacionNuevoNinosCostoUnitario" class="form-control" onkeyup="precioTotal()">
                                                    </div>
                                                </div>

                                                <div class="col-6 col-md-2">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoNinosFee">Cuota (FEE) Niños</label>
                                                        <input name="cotizacionNuevoNinosFee" id="cotizacionNuevoNinosFee" class="form-control" onkeyup="precioTotal()">
                                                    </div>
                                                </div>

                                                <div class="col-6 col-md-2">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoNinosCobrar">Total Cobrar por Niños </label>
                                                        <input name="cotizacionNuevoNinosCobrar" id="cotizacionNuevoNinosCobrar" class="form-control" onkeyup="precioTotal()" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-6 col-md-2">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoNinosPagarAV">Pagar AV Mayorista </label>
                                                    <input name="cotizacionNuevoNinosPagarAV" id="cotizacionNuevoNinosPagarAV" class="form-control" onkeyup="precioTotal()" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-6 col-md-2">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoNinosGanancia">Ganancia por Niños </label>
                                                        <input name="cotizacionNuevoNinosGanancia" id="cotizacionNuevoNinosGanancia" class="form-control" onkeyup="precioTotal()" readonly>
                                                    </div>
                                                </div>

                                                


                                            </div>

                                            <hr>
                                            <div class="form-row">

                                                <div class="col-6 col-md-2">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoDetraccion">Agregar Detracción</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">%</span>
                                                            </div>
                                                            <input name="cotizacionNuevoDetraccion" id="cotizacionNuevoDetraccion" class="form-control" maxlength="2" onkeyup="precioTotal()" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-6 col-md-2">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoCambioMoneda">Cambio a Nuevos Soles S/. </label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">S/.</span>
                                                            </div>
                                                            <input name="cotizacionNuevoCambioMoneda" id="cotizacionNuevoCambioMoneda" class="form-control" onkeyup="precioTotal()" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-6 col-md-2">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoTotalCobrarSoles">Total Cobrar en Soles S/. </label>
                                                        <div class="input-group">
                                                            <input name="cotizacionNuevoTotalCobrarSoles" id="cotizacionNuevoTotalCobrarSoles" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-6 col-md-2">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoTotalCobrarDolares">Total Cobrar en Dolares $</label>
                                                        <div class="input-group">
                                                            <input name="cotizacionNuevoTotalCobrarDolares" id="cotizacionNuevoTotalCobrarDolares" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-6 col-md-2">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoTotalAV">Pagar AV Total</label>
                                                        <div class="input-group">
                                                            <input name="cotizacionNuevoTotalAV" id="cotizacionNuevoTotalAV" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-6 col-md-2">
                                                    <div class="position-relative form-group">
                                                        <label for="cotizacionNuevoGananciaTotal">Ganancia Total</label>
                                                        <div class="input-group">
                                                            <input name="cotizacionNuevoGananciaTotal" id="cotizacionNuevoGananciaTotal" class="form-control" readonly>
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