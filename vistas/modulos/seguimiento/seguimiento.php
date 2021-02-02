<?php
	
	$codigoSeguimiento = $_GET["codseg"];
	$paquete = ControladorPaqueteFront::ctrObtenetPaqueteByCodigoSeguimiento($codigoSeguimiento);
	$pasajeros = $paquete["pasajeros"] + $paquete["ninos"];
?>
<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
                <h1 class="h2"><a href="principal" style="text-decoration: none">KM Viajes</a></h1>
            </div>
            <div class="col-md-5">
                <ul class="breadcrumb d-flex justify-content-end">
                    <li class="breadcrumb-item"><a href="principal">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">SOLICITUTD </a></li>
                    <li class="breadcrumb-item active"><?php echo $codigoSeguimiento; ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Container-->
<div class="container">
    <section class="bar">
        <div class="row">
            <div class="col-md-12">
                <div class="heading">
                    <h2>Módulo de seguimiento</h2>
                </div>
                <p>
                    Hola <b><?php echo $paquete["nombres"]." ".$paquete["apellidos"]; ?></b>, te mostramos los datos de
                    la solicitud y te guiaremos en el paso a paso para completar con la compra del servicio<br>
                    Los pasos se iran complentando cuando cada responsable, el asesor o el cliente, confirme el estado
                    del proceso.
                </p>
            </div>
        </div>

        <div class="col-md-12">

            <div class="card">

                <div class="row d-flex justify-content-between px-3 top">
                    <div class="d-flex">
                        <h5>SOLICITUTD <span
                                class="text-primary font-weight-bold">#<?php echo $codigoSeguimiento; ?></span></h5>
                    </div>

                </div> <!-- Add class 'active' to progress -->
                <div class="row d-flex justify-content-center">
                    <div class="col-12">
                        <ul id="progressbar" class="text-center">
                            <?php 
								$count = 0;
								$historial = ControladorPaqueteFront::ctrObtenerHistoricoSeguimientoSinAprobado($codigoSeguimiento);
								$historial2 = ControladorPaqueteFront::ctrObtenerHistoricoSeguimiento($codigoSeguimiento);
								foreach ($historial as $value) {
									echo "<li class='step0 active'></li>";
									$count +=1;
									
								}
								
								for ($i = $count; $i <= 4; $i++) {
									echo '<li class="step0"></li>';
								}
							?>
                        </ul>
                    </div>
                </div>
                <div class="row justify-content-between top">
                    <div class="row d-flex icon-content"> <img class="icon"
                            src="https://img.icons8.com/wired/64/000000/form.png" />
                        <div class="d-flex flex-column">
                            <p class="font-weight-bold">Solicitud<br>Registrada</p>
                        </div>
                    </div>
                    <div class="row d-flex icon-content"> <img class="icon"
                            src="https://img.icons8.com/carbon-copy/100/000000/invoice-1.png" />
                        <div class="d-flex flex-column">
                            <p class="font-weight-bold">Solicitud<br>Cotizada</p>
                        </div>
                    </div>
                    <div class="row d-flex icon-content"> <img class="icon"
                            src="https://img.icons8.com/dotty/80/000000/cruise-control-on.png" />
                        <div class="d-flex flex-column">
                            <p class="font-weight-bold">Solicitud<br>Reservada</p>
                        </div>
                    </div>
                    <div class="row d-flex icon-content"> <img class="icon"
                            src="https://img.icons8.com/ios-filled/50/000000/paid-bill.png" />
                        <div class="d-flex flex-column">
                            <p class="font-weight-bold">Solicitud<br>Pagada</p>
                        </div>
                    </div>
                    <div class="row d-flex icon-content"> <img class="icon"
                            src="https://img.icons8.com/ios-filled/50/000000/passenger-with-baggage.png" />
                        <div class="d-flex flex-column">
                            <p class="font-weight-bold">Solicitud<br>Completa!</p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="">

                <div id="content">
                    <div class="">
                        <div class="row portfolio-project">

                            <div id="checkout" class="col-md-8 card">
                                <div class="box">
                                    <div class="heading">
                                        <h4>Historial de eventos</h4>
                                    </div>
                                    <p>Se muestra los cambios de estados de la solicitud, desde la solicutd hasta la
                                        etapa final de la misma.</p>

                                    <div class="content">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Id Historial</th>
                                                        <th>Fecha</th>
                                                        <th>Estado</th>
                                                        <th>Acción</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
												
													foreach ($historial2 as $value) {
														
														$htmlAction = "";
														
														$estadoSolicitud = $value[1];
														
														switch ($estadoSolicitud) {
															case "Registrada":
																$htmlAction = '-';
																
															break;
															case "Cotizada":
																if($count <= 2 ){
																	$htmlAction = '<button type="button" data-toggle="modal" data-target="#cotizacion-modal" class="btn btn-template-outlined btn-sm">Aceptar</button>';
																}
																else{
																	$htmlAction = '<a class="btn btn-sm btn-default" href="backend/tcpdf/pdf/Cotizacion-paquete-BARRANQUILLA-27-01-2021.pdf" target="_blank">Ver Cotización</a>';
																}
																
															break;
															case "Aprobada":
																$htmlAction = '-';
																
															break;
															case "Reservada":
																if($count == 3 ){
																	$htmlAction = '<a href="index.php?ruta=pago&codseg='.$codigoSeguimiento.'"  class="btn btn-template-outlined btn-sm">Realizar Pago</a>';
																}
																else{
																	$htmlAction = '-';
																}
															break;
															case "Pagada":
																$htmlAction = '-';
																
															break;
															case "Completa":
																$htmlAction = '-';
															break;
															default:
																$htmlAction = '-';
															break;
															
														}														
														
														echo '<tr>
																<th>#'.$value[0].'</th>
																<td>'.$value[2].'</td>
																<td>
																	<span class="badge badge-info">'.$estadoSolicitud.'</span>
																</td>
																<td>'.$htmlAction.'</td>
															</tr>';

													}
												?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="col-md-4  project-more">
                                <div class="scroll card" style="padding: 10px">
                                    <div class="heading">
                                        <h3>Información del Paquete</h3>
                                    </div>
                                    <h3><?php echo $paquete["titulo"]; ?></h3>
                                    <?php
							$compania = $paquete["compania"];
							echo '<h4>Aeorolinea</h4><span>'.$compania.'</span>' 
                        ?>
                                    <hr />

                                    <?php 
							$nombreHotel = $paquete["nombre_hotel"];
                            $nombreCiudad = $paquete["ciudad"];
                            echo '<h4>Viaje</h4> <span>'.$paquete["fecha_mostrar"].'</span>' ;
                            echo '<hr/><h4>Hotel</h4><span style="font-style: italic;font-size:13px;">'.$nombreHotel.' de '.$nombreCiudad.'</span>';
                            
                            $stars = "";
                            for ($i = 1; $i <= $paquete["calificacion"]; $i++) {
                                $stars .= "<li class='star selected' title='Poor' data-value='1'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>";
                            }
                            echo "<div class='rating-stars'>
                                    <ul id='starsHotelView'>
                                        ".$stars."
                                    </ul>
                            </div>";
                            
                           
                        ?>
                                    <div style="padding:5px;">
                                        <?php 
                            $servicios = ControladorPaqueteFront::ctrListarServiciosPorPaquete($paquete["id_paquete"]);
                            
							foreach ($servicios as $key => $value) {
                                echo '<span style="float:left;font-size:13px;width:50%;margin-bottom:2px"><i class="'.$value["icono"].'" style="color:#da4d4d" aria-hidden="true"></i> '.$value["nombre"].'</span>';
                            }
                            ?>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Pasajeros</td>
                                                    <th style="text-align:right;"><?php 
                                    
                                    echo $pasajeros;
                                    ?></th>
                                                </tr>

                                                <tr>
                                                    <td>Precio Dolares x Unid.</td>
                                                    <th style="text-align:right;">
                                                        <?php echo '$ '.number_format($paquete["precio_dolar"],2);?>
                                                    </th>
                                                </tr>
                                                <tr class="total">
                                                    <td>Total</td>
                                                    <th style="text-align:right;">
                                                        <?php echo '$ '.number_format($pasajeros * $paquete["precio_dolar"],2);?>
                                                    </th>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <input type="hidden" id="id_solicitud"
                                            value="<?php echo $paquete["id_solicitud"]; ?>" />
                                        <input type="hidden" id="id_hotel"
                                            value="<?php echo $paquete["id_hotel"]; ?>" />
                                        <input type="hidden" id="id_aerolinea"
                                            value="<?php echo $paquete["id_aerolinea"]; ?>" />
                                    </div>
                                    <!--table-responsive-->
                                    <?PHP 
										if($count<4){
											echo '<button id="btn-anular" type="button" data-toggle="modal"
                                        data-target="#anular-modal" class="btn btn-lg btn-warning"><i
                                            class="fa fa-warning"></i>Anular
                                        Solicitud</button>';
										}
										else{
											
											if($count == 5){
												echo '<button id="btn-comentario" type="button" data-toggle="modal"
												data-target="#calificar-modal" class="btn btn-info"><i
													class="fa fa-edit"></i>Registrar
												comentario</button>';
											}
										}
									?>



                                </div>
                            </div>


                        </div>
                    </div>



                    <!--. <div class="card"> 
                    <div class="row d-flex justify-content-between px-3 top">
                        <div class="d-flex">
                            <h6><span class="text-primary font-weight-bold">2020-05-27 11:26:08 AM </span>REQUEST CREATED</h6>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-between px-3 top">
                        <div class="d-flex">
                            <h6><span class="text-primary font-weight-bold">2020-06-04 06:59:48 AM </span>ATTEMPT 1 COMPLETED. ~ ***[AUTO GENERATED BY GRASSHOPPERS]***</h6>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-between px-3 top">
                        <div class="d-flex">
                            <h6><span class="text-primary font-weight-bold">2020-06-04 06:59:48 AM </span>RETURN TO VENDOR RECORD CREATED ~ RC806_118 </h6>
                        </div>
                    </div>
                </div>-->
                </div>
            </div>

    </section>


</div>
<!-- Container-->

<div id="cotizacion-modal" tabindex="-1" role="dialog" aria-labelledby="cotizacion-modalLabel" aria-hidden="true"
    class="modal fade">
    <div role="document" class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="cotizacion-modalLabel" class="modal-title">Confirmación de Cotización</h4>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <p>Es necesario confirmar la cotización para poder activar el proceso de pago, puede revisarla <a
                        href="<?php echo "backend/tcpdf/pdf/".$codigoSeguimiento.'.pdf' ?>" target="_blank">aqui</a> o
                    revisar su bandeja. Si se encuentra conforme con la cotización favor de aceptar la cotización</p>
            </div>
            <div class="modal-footer">
                <button onclick="registrarEstado()" id="btn_pagar" class="btn btn-primary">Aceptar Cotización</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
            </div>
        </div>
    </div>
</div>

<!-- Login modal end-->
<div id="calificar-modal" tabindex="-1" role="dialog" aria-labelledby="calificar-modalLabel" aria-hidden="true"
    class="modal fade">
    <div role="document" class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="calificar-modalLabel" class="modal-title">Módulo de calificación</h4>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <p>Para poder seguir mejorando, necesitamos contar con su apoyo para completar un cuestinario sobre los
                    servicios contratados</p>

                <div>
                    <hr />
                    <p>¿Cómo calificarias a la aerolinea <b><?php echo $paquete["compania"];?></b>?</p>
                    <div class='rating-stars text-center'>
                        <ul id='starsAerolinea' class='stars' data-relation="divMenos3Stars">
                            <li class='star' title='Fatal' data-value='1'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li class='star' title='Por mejorar' data-value='2'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li class='star' title='Bueno' data-value='3'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li class='star' title='Excelente' data-value='4'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li class='star' title='Super recomendado!!' data-value='5'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                        </ul>
                    </div>

                    <div id="divMenos3Stars" style="display:none">
                        <p>¿En que podemos mejorar?
                        <div class="content-div-Aerolinea d-flex flex-wrap">
                            <div class="card div-calificacion-tipo">Limpieza
                            </div>
                            <div class="card div-calificacion-tipo">Tiempo
                            </div>
                            <div class="card div-calificacion-tipo">Calidad de servicios
                            </div>
                            <div class="card div-calificacion-tipo">Seguridad
                            </div>
                            <div class="card div-calificacion-tipo">Problemas con pasajeros
                            </div>
                        </div>
                    </div>

                    <hr />
                    <p>¿Cómo calificarias al hotel <b><?php echo $nombreHotel ;?></b>?</p>
                    <div class='rating-stars text-center'>
                        <ul id='starsHotel' class='stars' data-relation="divMenos3Stars2">
                            <li class='star' title='Fatal' data-value='1'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li class='star' title='Por mejorar' data-value='2'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li class='star' title='Bueno' data-value='3'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li class='star' title='Excelente' data-value='4'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li class='star' title='Super recomendado!!' data-value='5'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                        </ul>
                    </div>


                    <div id="divMenos3Stars2" style="display:none">
                        <p>¿En que podemos mejorar?
                        <div class="content-div-hotel d-flex flex-wrap">
                            <div class="card div-calificacion-tipo">Limpieza
                            </div>
                            <div class="card div-calificacion-tipo">Habitaciones
                            </div>
                            <div class="card div-calificacion-tipo">Calidad de servicios
                            </div>
                            <div class="card div-calificacion-tipo">Seguridad
                            </div>
                            <div class="card div-calificacion-tipo">Problemas con huéspedes
                            </div>
                        </div>
                    </div>
                </div>

                <hr />
                <h4>Servicios Contratados</h4>
                <div class="table-responsive">
                    <table id="tableServices-calificable" class="table table-hover">
                        <?php 
                                $servicios = ControladorPaqueteFront::ctrListarServiciosPorPaquete($paquete['id_paquete']);	
                               // echo  json_encode($servicios);
								foreach ($servicios as $key => $value) {
									
									if($value["calificable"] == 1){
                                        echo "<tr><td style='padding:4px;font-size:14px;'>".$value["nombre"]."</td><td style='padding:4px'>
                                            <div class='rating-stars text-center'>
                                            <ul id='starsServicios-".$value["id_servicio"]."' class='stars' data-service='".$value["id_servicio"]."'>
                                                <li class='star' title='Poor' data-value='1'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star' title='Fair' data-value='2'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star' title='Good' data-value='3'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star' title='Excellent' data-value='4'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star' title='WOW!!!' data-value='5'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                            </ul>
                                        </div>
                                        </td></tr>";
									}
								}
							?>
                    </table>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="name_on_card"><b>Favor si desea registrar un comentario adicional en forma
                                    general:</b></label>
                            <textarea placeholder="Comentarios adicionales" id="comentarioCalificacion"
                                name="comentarioCalificacion" rows="3" class="form-control" required></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button onclick="guardarCalificacion()" id="btn_pagar" class="btn btn-primary">Enviar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
            </div>
        </div>
    </div>
</div>

<div id="anular-modal" tabindex="-1" role="dialog" aria-labelledby="anular-modalLabel" aria-hidden="true"
    class="modal fade">
    <div role="document" class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="anular-modalLabel" class="modal-title">Confirmación de anulación</h4>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <p>Estimado <?php echo $paquete["nombres"];?> ¿Se encuentra seguro de realizar la anulación?</p>
            </div>
            <div class="modal-footer">
                <button onclick="" id="btn_pagar" class="btn btn-primary">Anular solicitud</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>