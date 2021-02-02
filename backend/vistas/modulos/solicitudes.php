<div class="app-main__inner">

    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Solicitudes
                    <div class="page-title-subheading">Se muestran las solicitudes generadas desde la web para la
                        validación y seguimiento de las mismas.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">

                <button type="button" class="btn-shadow btn btn-primary btnPrueba">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="pe-7s-add-user pe-7s-w-20"></i>
                    </span>
                    Bandeja de Solicitudes
                </button>

            </div>
        </div>
    </div>

    <div class="row animated fadeIn">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Listado de Solicitudes </h5>

                    <!--=====================================
                                        CLIENTES
                        table table-striped table-bordered dt-responsive tablas align-middle text-truncate mb-0 table-borderless table-hover
                        ======================================-->

                    <table class="table table-striped table-bordered tablas mb-0 table table-borderless table-hover">

                        <thead>

                            <tr>

                                <th style="width:10px">#</th>
                                <th>Solicitante</th>

                                <th>Paquete</th>
                                <th>Fecha de registro</th>
                                <th>Estado Solicitud</th>
                                <th>Acciones</th>

                            </tr>

                        </thead>
                        <tbody>

                            <?php

                                $item = null;

                                $valor = null;

                                $solicitudes = ControladorSolicitudes::ctrMostrarSolicitudes($item, $valor);

                                foreach ($solicitudes as $key => $value) {

                                    if( "" == $value["id_paquete"] ){

                                        $solicitante= $value["solicitante"];

                                        $paquete = '<div class="badge badge-pill badge-light" onclick="btnDetalleSinPaqueteSolicitud('.$value["id_solicitud"].')">Sin Paquete</div>';

                                    } else {

                                        $paquete = '<div class="badge badge-pill badge-primary" onclick="btnDetallePaqueteSolicitud('.$value["id_paquete"].')">Paquete</div>';
                                    }

                                    switch ($value["estado_solicitud"]) 
                                    {
                                        case "Registrada":

                                            $estado_solictud = '<div class="estadoSolicitudRegistrada badge badge-pill badge-secondary" idSolicitud="'.$value["id_solicitud"].'">registrada</div>' ;
                                            break;

                                        case "Cotizada":

                                            $estado_solictud = '<div class="badge badge-pill badge-info" idSolicitud="'.$value["id_solicitud"].'">cotizada</div>' ;
                                            break;

                                        case "Aceptada":
                                        
                                            $estado_solictud = '<div class="estadoSolicitudAceptada badge badge-pill badge-warning" idSolicitud="'.$value["id_solicitud"].'">aceptada</div>' ;
                                            break;

                                        case "Reservada":
                                            
                                            $estado_solictud = '<div class="estadoSolicitud badge badge-pill badge-secondary" idSolicitud="'.$value["id_solicitud"].'">en reserva</div>' ;
                                            break;

                                        case "Pagada":
                                        
                                            $estado_solictud = '<div class="estadoSolicitudPagada badge badge-pill badge-success" idSolicitud="'.$value["id_solicitud"].'" idVenta="'.$value["id_venta"].'" idDoc="'.$value["id_documento"].'">Pagada</div>' ;
                                            break;
                                        
                                        case "Cancelada":
                                            
                                            $estado_solictud = '<div class="badge badge-pill badge-danger" idSolicitud="'.$value["id_solicitud"].'">cancelada</div>' ;
                                            break;

                                        case "Completa":
                                            
                                                $estado_solictud = '<div class="badge badge-pill badge-alternate" idSolicitud="'.$value["id_solicitud"].'">Completa</div>' ;
                                                break;

                                    }                                 

                                    echo '<tr>

                                            <td>'.($key+1).'</td>

                                            <td><button class="mb-2 mr-2 btn btn-link text-left" onclick="btmMostrarSolicitante('.$value["id_cliente"].')" idCliente="'.$value["id_cliente"].'">'.$value["solicitante"].'<span class="badge badge-primary badge-dot badge-dot-lg"> </span></button></td>

                                            <td>'.$paquete.'</td>

                                            <td>'.$value["fecha_registro"].'</td>

                                            <td>'.$estado_solictud.'</td>

                                            <td>';
                                                if($value["estado_solicitud"] != "Completa"){
                                                    echo '<span><button class="btn btn-secondary fa fa-edit btnEditarSolicitud" idSolicitud="'.$value["id_solicitud"].'" data-toggle="modal" data-target="#modalEditarCliente"></button></span>&nbsp;';

                                                    if($_SESSION["perfil"] == "Administrador" ){

                                                        echo '<span><button class="btn btn-danger fa fa-times btnEliminarSolicitud" idSolicitud="'.$value["id_solicitud"].'"></button></span>';
                                                    }
                                                };

                                      echo '</td>

                                        </tr>';

                                    }

                                ?>

                        </tbody>

                    </table>

                    <!--====  Fin de CLIENTES  ====-->
                </div>
            </div>
        </div>
    </div>
</div>

<!--=====================================
MODAL MOSTRAR DATOS SOLICITANTE
======================================-->

<div class="modal fade" id="modalDatosSolicitante" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Datos Solicitante</h5>
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
                    <label for="solicitanteNombre" class="">Nombre</label>
                    <input name="solicitanteNombre" id="solicitanteNombre" class="form-control" readonly>
                </div>

                <div class="position-relative form-group">
                    <label for="solicitanteTelefono" class="">Teléfono </label>
                    <input name="solicitanteTelefono" id="solicitanteTelefono" class="form-control" readonly>
                </div>

                <div class="position-relative form-group">
                    <label for="solicitanteCorreo" class="">Correo electrónico</label>
                    <input name="solicitanteCorreo" id="solicitanteCorreo" class="form-control" readonly>
                </div>

            </div>

            <!--=====================================
                PIE DEL MODAL
                ======================================-->

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
            </div>

        </div>
    </div>
</div>

<!--=====================================
MODAL MOSTRAR DATOS PAQUETE
======================================-->

<div class="modal fade" id="modalDatosPaquete" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Datos del Paquete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

            <div class="modal-body">

                <!-- DATOS DEL PAQUETE -->

                <div class="p-0 card-body">
                    <ul class="tabs-animated-shadow tabs-animated nav nav-justified tabs-shadow-bordered p-3">
                        <li class="nav-item">
                            <a role="tab" class="nav-link active" id="tab-c-0" data-toggle="tab" href="#tab-animated-0">
                                <span>Datos Iniciales</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a role="tab" class="nav-link" id="tab-c-1" data-toggle="tab" href="#tab-animated-1">
                                <span>Detalle del Paquete Turístico</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a role="tab" class="nav-link" id="tab-c-2" data-toggle="tab" href="#tab-animated-2">
                                <span>Imagenes</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-animated-0" role="tabpanel">
                            <div class="scroll-area-sm">
                                <div class="scrollbar-container">
                                    <div class="p-3">
                                        <div id="datosPaqueteMostrar1"
                                            class="vertical-without-time vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane" id="tab-animated-1" role="tabpanel">
                            <div class="scroll-area-sm">
                                <div class="scrollbar-container">
                                    <div class="p-3">
                                        <div
                                            class="vertical-without-time vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                <div><span class="vertical-timeline-element-icon bounce-in"><i
                                                            class="badge badge-dot badge-dot-xl badge-success">
                                                        </i></span>
                                                    <div class="vertical-timeline-element-content bounce-in">
                                                        <h4 class="timeline-title">All Hands Meeting</h4>
                                                        <p>Lorem ipsum dolor sic amet, today at <a
                                                                href="javascript:void(0);">12:00 PM</a></p><span
                                                            class="vertical-timeline-element-date"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                <div><span class="vertical-timeline-element-icon bounce-in"><i
                                                            class="badge badge-dot badge-dot-xl badge-warning">
                                                        </i></span>
                                                    <div class="vertical-timeline-element-content bounce-in">
                                                        <p>Another meeting today, at <b class="text-danger">12:00 PM</b>
                                                        </p>
                                                        <p>Yet another one, at <span class="text-success">15:00
                                                                PM</span></p><span
                                                            class="vertical-timeline-element-date"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                <div><span class="vertical-timeline-element-icon bounce-in"><i
                                                            class="badge badge-dot badge-dot-xl badge-danger">
                                                        </i></span>
                                                    <div class="vertical-timeline-element-content bounce-in">
                                                        <h4 class="timeline-title">Build the production release</h4>
                                                        <p>Lorem ipsum dolor sit amit,consectetur eiusmdd tempor
                                                            incididunt ut labore et dolore magna elit enim at minim
                                                            veniam quis nostrud</p><span
                                                            class="vertical-timeline-element-date"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                <div><span class="vertical-timeline-element-icon bounce-in"><i
                                                            class="badge badge-dot badge-dot-xl badge-primary">
                                                        </i></span>
                                                    <div class="vertical-timeline-element-content bounce-in">
                                                        <h4 class="timeline-title text-success">Something not important
                                                        </h4>
                                                        <p>Lorem ipsum dolor sit amit,consectetur elit enim at minim
                                                            veniam quis nostrud</p><span
                                                            class="vertical-timeline-element-date"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                <div><span class="vertical-timeline-element-icon bounce-in"><i
                                                            class="badge badge-dot badge-dot-xl badge-success">
                                                        </i></span>
                                                    <div class="vertical-timeline-element-content bounce-in">
                                                        <h4 class="timeline-title">All Hands Meeting</h4>
                                                        <p>Lorem ipsum dolor sic amet, today at <a
                                                                href="javascript:void(0);">12:00 PM</a></p><span
                                                            class="vertical-timeline-element-date"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                <div><span class="vertical-timeline-element-icon bounce-in"><i
                                                            class="badge badge-dot badge-dot-xl badge-warning">
                                                        </i></span>
                                                    <div class="vertical-timeline-element-content bounce-in">
                                                        <p>Another meeting today, at <b class="text-danger">12:00 PM</b>
                                                        </p>
                                                        <p>Yet another one, at <span class="text-success">15:00
                                                                PM</span></p><span
                                                            class="vertical-timeline-element-date"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                <div><span class="vertical-timeline-element-icon bounce-in"><i
                                                            class="badge badge-dot badge-dot-xl badge-danger">
                                                        </i></span>
                                                    <div class="vertical-timeline-element-content bounce-in">
                                                        <h4 class="timeline-title">Build the production release</h4>
                                                        <p>Lorem ipsum dolor sit amit,consectetur eiusmdd tempor
                                                            incididunt ut labore et dolore magna elit enim at minim
                                                            veniam quis nostrud</p><span
                                                            class="vertical-timeline-element-date"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                <div><span class="vertical-timeline-element-icon bounce-in"><i
                                                            class="badge badge-dot badge-dot-xl badge-primary">
                                                        </i></span>
                                                    <div class="vertical-timeline-element-content bounce-in">
                                                        <h4 class="timeline-title text-success">Something not important
                                                        </h4>
                                                        <p>Lorem ipsum dolor sit amit,consectetur elit enim at minim
                                                            veniam quis nostrud</p><span
                                                            class="vertical-timeline-element-date"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-animated-2" role="tabpanel">

                            <div class="card-body">
                                <div class="slick-slider-responsive">
                                    <div>
                                        <div class="slider-item">1</div>
                                    </div>
                                    <div>
                                        <div class="slider-item">2</div>
                                    </div>
                                    <div>
                                        <div class="slider-item">3</div>
                                    </div>
                                    <div>
                                        <div class="slider-item">4</div>
                                    </div>
                                    <div>
                                        <div class="slider-item">5</div>
                                    </div>
                                    <div>
                                        <div class="slider-item">6</div>
                                    </div>
                                    <div>
                                        <div class="slider-item">7</div>
                                    </div>
                                    <div>
                                        <div class="slider-item">8</div>
                                    </div>
                                    <div>
                                        <div class="slider-item">9</div>
                                    </div>
                                    <div>
                                        <div class="slider-item">10</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>


            </div>

            <!--=====================================
                PIE DEL MODAL
                ======================================-->

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
            </div>

        </div>
    </div>
</div>


<!--=====================================
MODAL MOSTRAR DATOS SOLICITANTE
======================================-->

<div class="modal fade" id="modalEnviarDocumentos" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Enviar documentos </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

            <div class="modal-body">
                <div class="position-relative form-group"><label for="exampleEmail" class="">Constancia de pago
                        realizado por el cliente, ver el
                    </label>
                    <a id="enlace-doc-electronico" href="#" target="_blank">documento electrónico aquí</a>
                </div>
                <hr />
                <!-- ENTRADA PARA LOS NOMBRES -->
                <div class="position-relative form-group"><label for="exampleFile" class="">Adjuntar
                    </label><input name="file" id="exampleFile" type="file" class="form-control-file">
                    <small class="form-text text-muted">Adjuntar PDF que contiene los tickets</small>
                </div>

            </div>

            <!--=====================================
                PIE DEL MODAL
                ======================================-->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                <button type="submit" id="btnCompleto" class="btn btn-primary"
                    onclick="guardarEnvioDocumentos()">Enviar</button>
            </div>

        </div>
    </div>
</div>

<script>
$(window).on("load", function() {

    var datos = new FormData();

    datos.append("revisionSolicitudes", 1);

    $.ajax({
        url: "ajax/ajax.revision.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta) {}

    });


})
</script>