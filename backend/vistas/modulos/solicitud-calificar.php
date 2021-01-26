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
                                        <button type="button"  class="btn btn-primary btn-sm" onclick="mostrarModalCheck('.$value["id_paquete"].',\''.$value["fecha_inicio"].'\',\''.$value["hora_vuelo_ida"].'\',\''.$value["fecha_fin"].'\',\''.$value["hora_vuelo_regreso"].'\',\''.$value["id_seguimiento_checkin"].'\',\''.$value["id_seguimiento_checkout"].'\')">Detalle</button>
                                        <button type="button" class="btn btn-warning btn-sm" onclick="mostrarModalRegistroIncidencia('.$value["id_paquete"].');">Incidencia</button>
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
</div>

<!--=====================================
MODAL REGISTRO CHECKIN
======================================-->

<div class="modal fade" id="modalCheck" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Datos de registro <span
                        id="tipo-check">Check-In</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

            <div class="modal-body">

                <!-- ENTRADA PARA LOS NOMBRES -->



                <div class="form-row">
                    <div class="col-md-6">
                        <div class="position-relative form-group"><label for="fecha_vuelo" class="">Fecha vuelo
                                programado</label><input readonly name="fecha_vuelo" id="fecha_vuelo"
                                class="form-control"></div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative form-group"><label for="hora_vuelo" class="">Hora vuelo
                                programado</label><input readonly name="hora_vuelo" id="hora_vuelo"
                                class="form-control"></div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6">
                        <div class="position-relative form-group"><label for="fecha_vuelo_real" class="">Fecha
                                vuelo real</label><input name="fecha_vuelo_real" id="fecha_vuelo_real"
                                placeholder="Fecha real del vuelo" class="form-control dateFormat"></div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative form-group"><label for="hora_vuelo_real" class="">Hora
                                vuelo real</label><input name="hora_vuelo_real" id="hora_vuelo_real"
                                placeholder="Hora real del vuelo" type="time" class="form-control"></div>
                    </div>
                </div>

                <div class="position-relative form-group">
                    <label for="fecha_hotel_real" class="">Fecha llegada a hotel</label>
                    <input name="fecha_hotel_real" id="fecha_hotel_real" class="form-control dateFormat">
                </div>
                <div class="position-relative form-group"><label for="check_comentarios"
                        class="">Comentarios</label><textarea name="check_comentarios" id="check_comentarios"
                        class="form-control"></textarea></div>


            </div>

            <!--=====================================
                PIE DEL MODAL
                ======================================-->

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                <button type="submit" class="btn btn-primary" id="btn-check" onclick="guardarcheck()">Guardar</button>
            </div>

        </div>
    </div>
</div>


<!--=====================================
MODAL REGISTRO INCIDENTE
======================================-->

<div class="modal fade" id="modalIncidente" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Registro de incidente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

            <div class="modal-body">

                <!-- ENTRADA PARA LOS NOMBRES -->

                <div class="position-relative form-group">
                    <label for="fecha_vuelo_real" class="">Pasajeros</label>
                    <select style="width: 100%" multiple="multiple" class="form-control" name="incidentePasajero"
                        id="incidentePasajero">


                    </select>
                </div>

                <div class="position-relative form-group">
                    <label for="hora_vuelo_real" class=""><b>Servicios</b>
                    </label>
                    <form class="">
                        <fieldset class="position-relative form-group">
                            <div class="position-relative form-check"><label class="form-check-label"><input
                                        type="checkbox" value="Aerolinea" class="form-check-input tipo_incidente">
                                    Relación con la
                                    aerolinea</label>
                            </div>
                            <div class="position-relative form-check"><label class="form-check-label"><input
                                        type="checkbox" value="Hotel" class="form-check-input tipo_incidente"> Relación
                                    con el
                                    hotel</label>
                            </div>
                            <div class="position-relative form-check"><label class="form-check-label"><input
                                        type="checkbox" value="Otros" class="form-check-input tipo_incidente">
                                    Otro</label></div>
                        </fieldset>
                    </form>
                </div>

                <div class="position-relative form-group">
                    <label for="hora_vuelo_real" class=""><b>Servicios ofrecidos</b>
                    </label>
                    <p>Seleccionar si el cliente reporta un problema con los servicios que contrató en la compra del
                        paquete</p>
                    <form class="">
                        <fieldset class="position-relative form-group" id="form-servicios-ofrecidos">

                        </fieldset>

                    </form>


                </div>

                <div class="position-relative form-group"><label for="exampleText" class="">Comentarios</label><textarea
                        name="comentarioIncidente" id="comentarioIncidente" class="form-control"></textarea></div>

            </div>

            <!--=====================================
                PIE DEL MODAL
                ======================================-->

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                <button type="submit" class="btn btn-primary" id="btn-incidente"
                    onclick="guardarincidente()">Guardar</button>
            </div>

        </div>
    </div>
</div>


<?php

  $eliminarCliente = new ControladorClientes();
  $eliminarCliente -> ctrEliminarCliente();

?>