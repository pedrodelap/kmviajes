<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Calificación Hotel
                    <div class="page-title-subheading">Calificaciones realizadas sobre hoteles
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
                                <th>Hotel</th>
                                <th>Cliente</th>
                                <th>DOC</th>
                                <th>Contacto</th>
                                <th>Email</th>
                                <th>Valor</th>
                                <th>Observaciones</th>
                                <th>Fecha</th>
                            </tr>

                        </thead>
                        <tbody>

                            <?php

                                $ventas = ControladorReporte::mdlReporteCalificacionHotel();

                                foreach ($ventas as $key => $value) {

                                    echo '<tr>

                                            <td>'.$value["titulo"].'</td>

                                            <td>'.$value["nombre"].'</td>

                                            <td>'.$value["nombres"].' '.$value["apellidos"].'</td>

                                            <td>'.$value["numero_documento"].'</td>

                                            <td>'.$value["telefono"].'</td>

                                            <td>'.$value["correo"].'</td>

                                            <td>'.$value["valor"].'</td>

                                            <td>'.$value["mejorar"].'</td>

                                            <td>'.$value["fecha_registro"].'</td>
                                            

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