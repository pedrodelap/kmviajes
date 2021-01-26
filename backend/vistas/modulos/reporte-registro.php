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
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Hora Ida</th>
                                <th>Hora Regreso</th>
                                <th>Fecha Real</th>
                                <th>Hora Real</th>
                                <th>Fecha Hotel</th>
                                <th>Fecha Real Regreso</th>
                                <th>Hora Real Regreso</th>
                                <th>Fecha Hotel Regreso</th>
                                <th>Comentario</th>
                                <th>Comentario Regreso</th>
                            </tr>

                        </thead>
                        <tbody>

                            <?php


                                $ventas = ControladorReporte::ctrReporteChecks();

                                foreach ($ventas as $key => $value) {

                                    echo '<tr>

                                            <td>'.$value["titulo"].'</td>

                                            <td>'.$value["fecha_inicio"].'</td>

                                            <td>'.$value["fecha_fin"].'</td>

                                            <td>'.$value["hora_vuelo_ida"].'</td>

                                            <td>'.$value["hora_vuelo_regreso"].'</td>

                                            <td>'.$value["checkin_vuelo_fecha"].'</td>

                                            <td>'.$value["checkin_vuelo_hora"].'</td>

                                            <td>'.$value["checkin_hotel_fecha_hora"].'</td>

                                            <td>'.$value["checkout_vuelo_fecha"].'</td>

                                            <td>'.$value["checkout_vuelo_hora"].'</td>

                                            <td>'.$value["checkout_hotel_fecha_hora"].'</td>

                                            <td>'.$value["comentarios"].'</td>

                                            <td>'.$value["comentariosOut"].'</td>

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