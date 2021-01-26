<div class="app-main__inner">

    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Analytics Dashboard
                    <div class="page-title-subheading">This is an example dashboard created using build-in elements and
                        components.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <button type="button" data-toggle="tooltip" title="Example Tooltip" data-placement="bottom"
                    class="btn-shadow mr-3 btn btn-dark">
                    <i class="fa fa-star"></i>
                </button>
                <div class="d-inline-block dropdown">
                    <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        class="btn-shadow dropdown-toggle btn btn-info">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-business-time fa-w-20"></i>
                        </span>
                        Buttons
                    </button>
                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link">
                                    <i class="nav-link-icon lnr-inbox"></i>
                                    <span>
                                        Inbox
                                    </span>
                                    <div class="ml-auto badge badge-pill badge-secondary">86</div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link">
                                    <i class="nav-link-icon lnr-book"></i>
                                    <span>
                                        Book
                                    </span>
                                    <div class="ml-auto badge badge-pill badge-danger">5</div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link">
                                    <i class="nav-link-icon lnr-picture"></i>
                                    <span>
                                        Picture
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a disabled class="nav-link disabled">
                                    <i class="nav-link-icon lnr-file-empty"></i>
                                    <span>
                                        File Disabled
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row animated fadeIn">
        <div class="col-lg-12 col-xl-6">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Reporte mensual</h5>
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
                                                
                                                echo $resultado[0]["TOTAL"];
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
                                                
                                                echo $resultado[0]["TOTAL"];
                                                ?></div>
                                <div class="widget-subheading">Total Ventas</div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>