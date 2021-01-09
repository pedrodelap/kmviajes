<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Ventas
                    <div class="page-title-subheading">Ventas realizadas desde la web
                    </div>
                </div>
            </div>
            <!--<div class="page-title-actions">
                <a href="cotizacion-crear" class="btn-shadow btn btn-primary">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="pe-7s-add-user pe-7s-w-20"></i>
                    </span>
                    Agregar Cotizacion
                </a>
            </div>-->
        </div>
    </div>

    <div class="row animated fadeIn">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">

                    <h5 class="card-title">Listado de ventas </h5>

                    <!--=====================================
                                        LISTADO COTIZACIONES
                        ======================================-->

                    <table class="table table-striped table-bordered tablas mb-0 table table-borderless table-hover">

                        <thead>

                            <tr>

                                <th style="width:10px">Id</th>
                                <th>Nro Operación</th>
                                <th>Fecha</th>
                                <th>Monto</th>
                                <th>Cliente</th>
                                <th>RUC</th>
                                <th>XML</th>
                                <th>PDF</th>
                            </tr>

                        </thead>
                        <tbody>

                            <?php

                                $ventas = ControladorVentas::ctrListarVentasOnline();

                                foreach ($ventas as $key => $value) {

                                    echo '<tr>

                                            <td>'.$value["id_venta"].'</td>

                                            <td>'.$value["nro_operacion"].'</td>

                                            <td>'.$value["fecha_creacion"].'</td>

                                            <td>'.$value["monto"].'</td>

                                            <td>'.$value["nombres"].' '.$value["apellidos"].'</td>

                                            <td>'.$value["ruc"].'</td>

                                            <td><button onclick="generateXML('.$value["id_venta"].')" class="mb-2 mr-2 badge badge-focus">Generar XML</button></td>

                                            <td><button onclick="generatePDF('.$value["id_venta"].')" class="mb-2 mr-2 badge badge-alternate">View PDF</button></td>

                                           

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

<div class="modal fade" id="modalNuevoCliente" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
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

                    <!-- ENTRADA PARA LOS NOMBRES -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Nombres" name="clienteNuevoNombres" type="text" class="form-control"
                            required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA LOS APELLIDOS -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Apellidos" name="clienteNuevoApellidos" type="text" class="form-control"
                            required>
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
                        <input placeholder="Numero documento" name="clienteNuevoNumeroDocumento" type="text"
                            class="form-control" required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA EL CORREO ELECTRONICO -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="">@</i></span>
                        </div>
                        <input placeholder="Correo electronico" name="clienteNuevoCorreo" type="email"
                            class="form-control" required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA EL TELEFONO -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-phone-handset"></i></span>
                        </div>
                        <input placeholder="Telefono" name="clienteNuevoTelefono" type="text" class="form-control"
                            required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-calendar-full"></i></span>
                        </div>
                        <input class="form-control input-mask-trigger" name="clienteNuevoFechaNacimiento"
                            placeholder="Fecha de Nacimiento" data-inputmask-alias="datetime"
                            data-inputmask-inputformat="mm/dd/yyyy" im-insert="false">
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