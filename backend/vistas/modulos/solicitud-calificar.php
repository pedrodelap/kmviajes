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

    <div class="row animated fadeIn">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                   
                    <h5 class="card-title">Listado de paquetes</h5>

                        <!--=====================================
                                        LISTADO COTIZACIONES
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

                                    if ($value["estado_solicitud"]=="Pagada") {
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
                                                
                                                    $estado_solictud = '<div class="estadoSolicitud badge badge-pill badge-success" idSolicitud="'.$value["id_solicitud"].'">Pagada</div>' ;
                                                    break;
                                                
                                                case "Cancelada":
                                                    
                                                    $estado_solictud = '<div class="badge badge-pill badge-danger" idSolicitud="'.$value["id_solicitud"].'">cancelada</div>' ;
                                                    break;

                                            }                                 

                                            echo '<tr>

                                                    <td>'.($key+1).'</td>

                                                    <td><button class="mb-2 mr-2 btn btn-link text-left" onclick="btmMostrarSolicitante('.$value["id_cliente"].')" idCliente="'.$value["id_cliente"].'">'.$value["solicitante"].'<span class="badge badge-primary badge-dot badge-dot-lg"> </span></button></td>

                                                    <td>'.$paquete.'</td>

                                                    <td>'.$value["fecha_registro"].'</td>

                                                    <td>'.$estado_solictud.'</td>

                                                    <td>';
                                        
                                                        if($_SESSION["perfil"] == "Administrador"){

                                                            echo '<span><button class="btn btn-danger fa btnModalCalificar" data-toggle="modal" data-target="#modalCalificar" idSolicitud="'.$value["id_solicitud"].'">Validar</button></span>';
                                                        }

                                            echo '</td>

                                                </tr>';
                                         }              
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
MODAL EDITAR CLIENTE
======================================-->

<div class="modal fade" id="modalCalificar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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

