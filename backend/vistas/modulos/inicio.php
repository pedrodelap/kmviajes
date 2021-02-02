<div class="app-main__inner">

    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Dashboard
                    <div class="page-title-subheading">
                    </div>
                </div>
            </div>
            <div class="page-title-actions">


            </div>
        </div>
    </div>

    <div class="row animated fadeIn">
        <div class="col-lg-12 col-xl-6">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Comparación de Solicitud VS Ventas</h5>
                    <div class="widget-chart-wrapper widget-chart-wrapper-lg opacity-10 m-0">
                        <div style="height: 227px;">
                            <canvas id="solicitud-ventas-grafico"></canvas>
                        </div>
                    </div>
                    <h5 class="card-title">Total mensual</h5>
                    <div class="mt-3 row">
                        <div class="col-sm-12 col-md-4">
                            <div class="widget-content p-0">
                                <div class="widget-content-outer">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-numbers text-dark">
                                                <?php $resultado = (ControladorReporte::ctrObtenerTotalSolicitudesMesActual());
                                                
                                                echo $resultado[0]["TOTAL"];
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-progress-wrapper mt-1">
                                        <!--<div class="progress-bar-xs progress-bar-animated-alt progress">
                                            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="65"
                                                aria-valuemin="0" aria-valuemax="100" style="width: 65%;"></div>
                                        </div>-->
                                        <div class="progress-sub-label">
                                            <div class="sub-label-left font-size-md">Solicitudes</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="widget-content p-0">
                                <div class="widget-content-outer">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-numbers text-dark">
                                                $ <?php $resultado = (ControladorReporte::ctrObtenerTotalMontoVentaMesActual());
                                                echo number_format($resultado[0]["TOTAL"],2);
                                                
                                                ?></div>
                                        </div>
                                    </div>
                                    <div class="widget-progress-wrapper mt-1">

                                        <div class="progress-sub-label">
                                            <div class="sub-label-left font-size-md">Monto Ventas</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="widget-content p-0">
                                <div class="widget-content-outer">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-numbers text-dark">
                                                <?php $resultado = (ControladorReporte::ctrObtenerTotalPasajeroMesActual());
                                                 echo $resultado[0]["TOTAL"]; 
                                                
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-progress-wrapper mt-1">

                                        <div class="progress-sub-label">
                                            <div class="sub-label-left font-size-md">Pasajeros</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-6">
            <div class="main-card mb-3 card">
                <div class="grid-menu grid-menu-2col">
                    <h5 class="card-title" style="margin:20px;">Reporte Total</h5>
                    <div class="no-gutters row">
                        <div class="col-sm-6">
                            <div class="widget-chart widget-chart-hover">
                                <div class="icon-wrapper rounded-circle">
                                    <div class="icon-wrapper-bg bg-primary"></div>
                                    <i class="lnr-cog text-primary"></i>
                                </div>
                                <div class="widget-numbers">
                                    <?php $resultado = (ControladorReporte::ctrObtenerTotalPasajeros());
                                                
                                                echo $resultado[0]["TOTAL"];
                                                ?>
                                </div>
                                <div class="widget-subheading">Total pasajeros</div>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="widget-chart widget-chart-hover">
                                <div class="icon-wrapper rounded-circle">
                                    <div class="icon-wrapper-bg bg-info"></div>
                                    <i class="lnr-graduation-hat text-info"></i>
                                </div>
                                <div class="widget-numbers"><?php $resultado = (ControladorReporte::ctrObtenerTotalIncidentes());
                                                
                                                echo $resultado[0]["TOTAL"];
                                                ?></div>
                                <div class="widget-subheading">Total incidentes</div>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="widget-chart widget-chart-hover">
                                <div class="icon-wrapper rounded-circle">
                                    <div class="icon-wrapper-bg bg-danger"></div>
                                    <i class="lnr-laptop-phone text-danger"></i>
                                </div>
                                <div class="widget-numbers"><?php $resultado = (ControladorReporte::ctrObtenerTotalCalificacion());
                                                
                                                echo $resultado[0]["TOTAL"];
                                                ?></div>
                                <div class="widget-subheading">Total feedback</div>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="widget-chart widget-chart-hover br-br">
                                <div class="icon-wrapper rounded-circle">
                                    <div class="icon-wrapper-bg bg-success"></div>
                                    <i class="lnr-screen"></i>
                                </div>
                                <div class="widget-numbers">$ <?php $resultado = (ControladorReporte::ctrObtenerTotalMontoVentas());
                                                
                                                echo number_format($resultado[0]["TOTAL"],2);
                                                ?></div>
                                <div class="widget-subheading">Total Ventas</div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Comparitva de estados</h5>
                    <canvas id="canvas"></canvas>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div id="calendar-bg-events"></div>
                </div>
            </div>

        </div>
    </div>
</div>