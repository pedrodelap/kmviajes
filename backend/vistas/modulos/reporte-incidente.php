<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Calificación Hotel
                    <div class="page-title-subheading">Incidentes registrados asociados a paquetes
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row animated fadeIn">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">

                    <h5 class="card-title">Listado de incidentes </h5>

                    <!--=====================================
                                        LISTADO COTIZACIONES
                        ======================================-->

                    <table class="table table-striped table-bordered tablas mb-0 table table-borderless table-hover">

                        <thead>

                            <tr>


                                <th>Paquete</th>
                                <th>Cliente</th>
                                <th>Tipo</th>
                                <th>Servicio</th>
                                <th>Comentario</th>

                                <th>Fecha</th>
                            </tr>

                        </thead>
                        <tbody>

                            <?php

                                $ventas = ControladorReporte::ctrReporteIncidente();

                                foreach ($ventas as $key => $value) {

                                    echo '<tr>

                                           
                                            <td>'.$value["titulo"].'</td>
                                            <td>'.$value["nombres"].' '.$value["apellidos"].'</td>

                                            <td>'.$value["tipo"].'</td>

                                            <td>'.$value["nombre"].'</td>

                                            <td>'.$value["comentario"].'</td>

                                          

                                            <td>'.$value["registro"].'</td>
                                            

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