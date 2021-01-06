<?php 
    $paquetes = ControladorSolicitudes::ctrConsultarCotizacionSeguimiento();
   

?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Paquetes vendidos
                    <div class="page-title-subheading">En esta sección podrás hacer seguimiento a los paquetes vendidos
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--=====================================      LISTADO PAQUETES  ======================================-->
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">Seguimiento de paquetes
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <button class="active btn btn-focus">Última semana</button>
                            <button class="btn btn-focus">Todo el mes</button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive card-body">
                    <table class="table table-striped table-bordered tablas mb-0 table table-borderless table-hover">


                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Paquete</th>
                                <th class="text-center">Destino</th>
                                <th class="text-center">Fechas</th>
                                <th class="text-center">Vendió</th>
                                <th class="text-center">Monto bruto</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php 

                            foreach ($paquetes as $key => $value) {

                                $estadoPaquete = "badge-info";
                                if(getdate() > strtotime($value["fecha_inicio"])){
                                    
                                }
                                else{
                                    if(getdate() < strtotime($value["fecha_inicio"])){
                                        $estadoPaquete = "badge-warning";
                                    }

                                    if(getdate() > strtotime($value["fecha_fin"])){
                                        $estadoPaquete = "badge-danger";
                                    }
                                }
                                
                                
                               echo '<tr>
                                    <td class="text-center text-muted">#'.$value["id_paquete"].'</td>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-3">
                                                    <div class="widget-content-left">
                                                        <img width="120" class="rounded-circle" src="'.$value["ruta_imagen"].'" alt="">
                                                    </div>
                                                </div>
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading">'.$value["titulo"].'</div>
                                                    <div class="widget-subheading opacity-7">'.$value["campania"].'</div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">'.$value["ciudad"].'</td>
                                    <td class="text-center">
                                        <div class="badge '.$estadoPaquete.'">'.$value["fecha_mostrar"].'</div>
                                    </td>
                                    <td class="text-right" style="width: 140px;">
                                        <div>'.$value["num_paquete"].' paquetes</div>
                                    </td>
                                    <td class="text-right" style="width: 150px;">
                                        <div>$ '.number_format($value["monto"],2).'</div>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm" onclick="setupViewSeguimiento('.$value["id_paquete"].',\''.$value["fecha_inicio"].'\',\''.$value["hora_vuelo_ida"].'\',\''.$value["fecha_fin"].'\',\''.$value["hora_vuelo_regreso"].'\',\''.$value["id_seguimiento_checkin"].'\',\''.$value["id_seguimiento_checkout"].'\')">Detalle</button>
                                    </td>
                                </tr>';
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!--====  Fin de LISTADO COTIZACIONES  ====-->

    <!--=====================================      CHECK PAQUETE  ======================================-->

    <div id="section-seguimiento" class="row" style="display:none">
        <div class="col-md-12 col-lg-8">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div id="smartwizard3" class="forms-wizard-vertical">
                        <ul class="forms-wizard">
                            <li>
                                <a href="#step-122">
                                    <em>1</em><span>CHECK IN</span>
                                </a>
                            </li>
                            <li>
                                <a href="#step-222">
                                    <em>2</em><span>CHECK OUT</span>
                                </a>
                            </li>
                            <li>
                                <a href="#step-322">
                                    <em>3</em><span>Cerrado </span>
                                </a>
                            </li>
                        </ul>
                        <div class="form-wizard-content">
                            <div id="step-122">
                                <div class="card-body">
                                    <form>
                                        <h5 class="card-title">Vuelo de ida</h5>
                                        <div class="form-row">

                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label
                                                        for="fechaInicioIda">Fecha
                                                        programda</label><input name="fechaInicioIda"
                                                        id="fechaInicioIda" placeholder="date placeholder" type="text"
                                                        readonly class="form-control"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label
                                                        for="horaInicioIda">Hora
                                                        programada</label><input name="horaInicioIda" id="horaInicioIda"
                                                        placeholder="time placeholder" type="text" readonly
                                                        class="form-control"></div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label
                                                        for="fechaInicioIdaReal">Fecha
                                                        real</label><input name="fechaInicioIdaReal"
                                                        id="fechaInicioIdaReal" placeholder="date placeholder"
                                                        type="date" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label
                                                        for="horaInicioIdaReal">Horal
                                                        real</label><input name="horaInicioIdaReal"
                                                        id="horaInicioIdaReal" placeholder="time placeholder"
                                                        type="time" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                    </form>

                                    <form>
                                        <h5 class="card-title">Check-in Hotel</h5>
                                        <div class="form-row">

                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label
                                                        for="checkinHotel">Fecha</label><input name="checkinHotel"
                                                        id="checkinHotel" placeholder="date placeholder" type="text"
                                                        class="form-control"></div>
                                            </div>

                                        </div>
                                    </form>

                                </div>
                            </div>
                            <div id="step-222">
                                <div class="card-body">

                                    <form>
                                        <h5 class="card-title">Check-out Hotel</h5>
                                        <div class="form-row">

                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="exampleDate">Fecha
                                                        real</label><input name="date" id="exampleDate"
                                                        placeholder="date placeholder" type="text" class="form-control">
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                    <form>
                                        <h5 class="card-title">Vuelo de regreso</h5>
                                        <div class="form-row">

                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="exampleDate">Fecha
                                                        programda</label><input name="date" id="exampleDate"
                                                        placeholder="date placeholder" type="text" readonly
                                                        class="form-control"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="exampleTime">Hora
                                                        programada</label><input name="time" id="exampleTime"
                                                        placeholder="time placeholder" type="text" readonly
                                                        class="form-control"></div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="exampleDate">Fecha
                                                        real</label><input name="date" id="exampleDate"
                                                        placeholder="date placeholder" type="date" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="exampleTime">Horal
                                                        real</label><input name="time" id="exampleTime"
                                                        placeholder="time placeholder" type="time" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <div id="step-322">
                                <div class="no-results">
                                    <div class="swal2-icon swal2-success swal2-animate-success-icon">
                                        <div class="swal2-success-circular-line-left"
                                            style="background-color: rgb(255, 255, 255);"></div>
                                        <span class="swal2-success-line-tip"></span>
                                        <span class="swal2-success-line-long"></span>
                                        <div class="swal2-success-ring"></div>
                                        <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);">
                                        </div>
                                        <div class="swal2-success-circular-line-right"
                                            style="background-color: rgb(255, 255, 255);"></div>
                                    </div>
                                    <div class="results-subtitle mt-4">Seguimiento Finalizado!</div>
                                    <div class="results-title">You arrived at the last form wizard step!</div>
                                    <div class="mt-3 mb-3"></div>
                                    <div class="text-center">
                                        <button class="btn-shadow btn-wide btn btn-success btn-lg">Finalizar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="clearfix">
                        <button type="button" id="reset-btn22" class="btn-shadow float-left btn btn-link">Reset</button>
                        <button type="button" id="next-btn22"
                            class="btn-shadow btn-wide float-right btn-pill btn-hover-shine btn btn-primary">Next</button>
                        <button type="button" id="prev-btn22"
                            class="btn-shadow float-right btn-wide btn-pill mr-3 btn btn-outline-secondary">Previous</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-lg-4">
            <div class="main-card mb-3 card">

                <div class="card-header-tab card-header">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal">

                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="lnr-user icon-gradient bg-ripe-malin"> </i> Viajeros</span></div>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="scroll-area-md">
                    <div class="scrollbar-container">
                        <ul class="todo-list-wrapper list-group list-group-flush" id="ulContenidoClientes">

                        </ul>
                    </div>
                </div>
                <div class="d-block text-right card-footer">
                    <button class="mr-2 btn btn-link btn-sm">Cancelar</button>
                    <button class="btn btn-success btn-lg">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!--====  Fin de LISTADO COTIZACIONES  ====-->

</div>

<!--=====================================
MODAL EDITAR CLIENTE
======================================-->

<div class="modal fade" id="modalCalificar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form role="form" method="post">

                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Confirmar Viaje</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">

                    <p>Es necesario corroborar los datos ofrecidos en el paquete vendido</p>
                    <div class="widget-content-left mr-3">

                        <table>
                            <tr>
                                <td>
                                    ¿El vuelo de ida cumplió con la fecha programada?
                                </td>
                                <td> <input id="chkToggle1" type="checkbox" data-toggle="toggle" checked></td>
                            </tr>
                            <tr>
                                <td>
                                    ¿Se cumplió con el traslado?
                                </td>
                                <td> <input id="chkToggle1" type="checkbox" data-toggle="toggle" checked></td>
                            </tr>
                            <tr>
                                <td>
                                    ¿Se cumplió la fecha de hospedaje?
                                </td>
                                <td> <input id="chkToggle1" type="checkbox" data-toggle="toggle" checked></td>
                            </tr>
                            <tr>
                                <td>
                                    ¿El hotel cumplió con los servicios ofrecidos?
                                </td>
                                <td> <input id="chkToggle1" type="checkbox" data-toggle="toggle" checked></td>
                            </tr>
                            <tr>
                                <td>
                                    ¿El cliente ocasionó algún incidente?
                                </td>
                                <td> <input id="chkToggle1" type="checkbox" data-toggle="toggle" checked></td>
                            </tr>
                            <tr>
                                <td>
                                    ¿El vuelo de regreso cumplió con la fecha programada?
                                </td>
                                <td> <input id="chkToggle1" type="checkbox" data-toggle="toggle" checked></td>
                            </tr>

                            <tr>
                                <td>
                                    Comentarios:
                                </td>
                                <td>
                                    <textarea></textarea>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!--=====================================
                PIE DEL MODAL
                ======================================-->

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
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