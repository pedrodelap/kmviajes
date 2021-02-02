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

                                <th>Paquete</th>
                                <th>RUC</th>
                                <th>R. Social</th>
                                <th>DOC</th>
                                <th>Cliente</th>
                                <th>Monto</th>
                                <th>Nro. Operación</th>
                                <th>Fecha</th>
                            </tr>

                        </thead>
                        <tbody>

                            <?php

                                $ventas = ControladorReporte::ctrReporteVentas();

                                foreach ($ventas as $key => $value) {

                                    echo '<tr>

                                            <td>'.$value["titulo"].'</td>

                                            <td>'.$value["ruc"].'</td>

                                            <td>'.$value["razon_social"].'</td>

                                            <td>'.$value["numero_documento"].'</td>

                                            <td>'.$value["nombres"].' '.$value["apellidos"].'</td>

                                            <td>$ '.number_format($value["monto"],2).'</td>

                                            <td>'.$value["nro_operacion"].'</td>

                                            <td>'.$value["fecha_creacion"].'</td>
                                            

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