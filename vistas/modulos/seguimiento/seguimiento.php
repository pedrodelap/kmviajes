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
					<h2>Modulo de seguimiento</h2>
				</div>
				<p>
				Hola <b><?php echo $paquete["nombres"]." ".$paquete["apellidos"]; ?></b>, te mostramos los datos de la solicitud y te guiaremos en el paso a paso para completar con la compra del servicio<br>
				Los pasos se iran complentando cuando cada responsable, el asesor o el cliente, confirme el estado del proceso.
				</p>
			</div>
		</div>

		<div class="col-md-12">

			<div class="card">
				
				<div class="row d-flex justify-content-between px-3 top">
					<div class="d-flex">
						<h5>SOLICITUTD <span class="text-primary font-weight-bold">#<?php echo $codigoSeguimiento; ?></span></h5>
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
					<div class="row d-flex icon-content"> <img class="icon" src="https://img.icons8.com/wired/64/000000/form.png"/>
						<div class="d-flex flex-column">
							<p class="font-weight-bold">Solicitud<br>Registrada</p>
						</div>
					</div>
					<div class="row d-flex icon-content"> <img  class="icon" src="https://img.icons8.com/carbon-copy/100/000000/invoice-1.png"/>
						<div class="d-flex flex-column">
							<p class="font-weight-bold">Solicitud<br>Cotizada</p>
						</div>
					</div>
					<div class="row d-flex icon-content"> <img class="icon" src="https://img.icons8.com/dotty/80/000000/cruise-control-on.png"/>
						<div class="d-flex flex-column">
							<p class="font-weight-bold">Solicitud<br>Reservada</p>
						</div>
					</div>
					<div class="row d-flex icon-content"> <img class="icon"  src="https://img.icons8.com/ios-filled/50/000000/paid-bill.png"/>
						<div class="d-flex flex-column">
							<p class="font-weight-bold">Solicitud<br>Pagada</p>
						</div>
					</div>
					<div class="row d-flex icon-content"> <img  class="icon" src="https://img.icons8.com/ios-filled/50/000000/passenger-with-baggage.png"/>
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

							<div id="checkout" class="col-md-8">
								<div class="box">
									<ul class="nav nav-pills nav-fill">
										<li class="nav-item"><a href="#" class="nav-link active"><i
													class="fa fa-eye"></i><br>Detalle de notificaciones</a></li>
									</ul>

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
																$htmlAction = '<button type="button" class="btn btn-sm btn-default" disabled>Sin acción</button>';
																
															break;
															case "Cotizada":
																if($count <= 2 ){
																	$htmlAction = '<button type="button" data-toggle="modal" data-target="#cotizacion-modal" class="btn btn-template-outlined btn-sm">Aceptar</button>';
																}
																else{
																	$htmlAction = '<a class="btn btn-sm btn-default" href="backend/tcpdf/pdf/'.$codigoSeguimiento.'.pdf" target="_blank">Ver Cotización</a>';
																}
																
															break;
															case "Aprobada":
																$htmlAction = '<button type="button" class="btn btn-sm btn-default" disabled>Sin acción</button>';
																
															break;
															case "Reservada":
																if($count == 3 ){
																	$htmlAction = '<a href="index.php?ruta=pago&codseg='.$codigoSeguimiento.'"  class="btn btn-template-outlined btn-sm">Realizar Pago</a>';
																}
																else{
																	$htmlAction = '<button type="button" class="btn btn-sm btn-default" disabled>Sin acción</button>';
																}
															break;
															case "Pagada":
																if($count == 5 ){
																	$htmlAction = '<button type="button" data-toggle="modal" data-target="#calificar-modal" class="btn btn-sm btn-warning" >Notificar a Asesor</button>';
																}
																else{
																	$htmlAction = '<button type="button" class="btn btn-sm btn-default" disabled>Sin acción</button>';
																}
															break;
															case "Completa":
																if($count == 6 ){
																	$htmlAction = '<button type="button" class="btn btn-sm btn-success">Calificar Servicios</button>';
																}
																else{
																	$htmlAction = '<button type="button" class="btn btn-sm btn-default" disabled>Sin acción</button>';
																}
															break;
															default:
																if($count <=3 ){
																	$htmlAction = '<button type="button" class="btn btn-sm btn-default" disabled>Sin acción</button>';
																}
																else{
																	$htmlAction = '<button type="button" class="btn btn-sm btn-default" disabled>Sin acción</button>';
																}
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
                        <hr/>

                        <?php 
							$nombreHotel = $paquete["nombre_hotel"];
                            $nombreCiudad = $paquete["ciudad"];
                            echo '<h4>Viaje</h4> <span>'.$paquete["fecha_mostrar"].'</span>' ;
                            echo '<hr/><h4>Hotel</h4><span style="font-style: italic;font-size:13px;">'.$nombreHotel.' de '.$nombreCiudad.'</span>';
                            echo '<div id="idHotelServ3" class="my-rating-hotel" data-rating="'.$paquete["calificacion"].'"></div>';
                           
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
                                    <th style="text-align:right;"><?php echo '$ '.number_format($paquete["precio_dolar"],2);?></th>
                                </tr>
                                <tr class="total">
                                    <td>Total</td>
                                    <th style="text-align:right;"><?php echo '$ '.number_format($pasajeros * $paquete["precio_dolar"],2);?></th>
                                </tr>
                                </tbody>
							</table>
							<input type="hidden" id="id_solicitud" value="<?php echo $paquete["id_solicitud"]; ?>"/>
                        </div><!--table-responsive-->
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
	<button type="button" data-toggle="modal" data-target="#calificar-modal" class="btn btn-template-outlined btn-sm">Aceptar</button>

			
</div>
<!-- Container-->

	<div id="cotizacion-modal" tabindex="-1" role="dialog" aria-labelledby="cotizacion-modalLabel" aria-hidden="true" class="modal fade">
		<div role="document" class="modal-dialog ">
				<div class="modal-content">
					<div class="modal-header">
					<h4 id="cotizacion-modalLabel" class="modal-title">Confirmación de Cotización</h4>
					<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
					</div>
					<div class="modal-body">
						<p>Es necesario confirmar la cotización para poder activar el proceso de pago, puede revisarla <a href="<?php echo "backend/tcpdf/pdf/".$codigoSeguimiento.'.pdf' ?>" target="_blank">aqui</a> o revisar su bandeja. Si se encuentra conforme con la cotización favor de aceptar la cotización</p>
					</div>
					<div class="modal-footer">
						<button onclick="registrarEstado()" id="btn_pagar" class="btn btn-primary">Aceptar Cotización</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
					</div>
			</div>
		</div>
	</div>	 
		 
<!-- Login modal end-->
<div id="calificar-modal" tabindex="-1" role="dialog" aria-labelledby="calificar-modalLabel" aria-hidden="true" class="modal fade">
	<div role="document" class="modal-dialog ">
			<div class="modal-content">
				<div class="modal-header">
				<h4 id="calificar-modalLabel" class="modal-title">Módulo de calificación</h4>
				<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
				</div>
				<div class="modal-body">
					<p>Para poder seguir mejorando, necesitamos contar con su apoyo para completar un cuestinario sobre los servicios contratados</p>
					<h4>Servicios Contratados</h4>
					<div class="table-responsive">
						<table class="table table-hover">
							<?php 
								$servicios = ControladorPaqueteFront::ctrListarServiciosPorPaquete($paquete['id_paquete']);			
								foreach ($servicios as $key => $value) {
									
									if($value["calificable"] == 1){
										echo '<tr><td style="padding:4px;font-size:14px;">'.$value["nombre"].'</td><td style="padding:4px"><div class="my-rating-4" data-rating="0"></div></td></tr>';
									}
								}
							?>
						</table>
					</div>
					<p>Nos gustaria conocer su opinion del Hotel <b><?php  echo $paquete['nombre_hotel'];?> </b>
					<div class="table-responsive">
						<table class="table table-hover">
							<tr>
								<td style="padding:4px;font-size:12px;padding:3px"><h4 style="margin:0 auto">Servicios ofrecidos por el Hotel:</h4></td>
								<td style="padding:4px"><div id="idHotelAll"  data-rating="0"></div></td>
							</tr>
							
						</table>
						
					</div>
					
					<div id="divCalificarHotel" style="display:none;">
						<p>Nos podría ayudar marcando los servicios prestados por el hotel <b><?php  echo $paquete['nombre_hotel'];?> </b>
						<div style="float: left; width:50%">
							<div class="table-responsive">
								<table class="table table-hover">
									<tr>
										<td style="font-size:14px;padding:3px">Aparcamiento</td>
										<td style="padding:4px;  width: 90px;">
											<div class="onoffswitch2">
												<input type="checkbox" name="onOffAparcamiento" class="onoffswitch2-checkbox" id="onOffAparcamiento" >
												<label class="onoffswitch2-label" for="onOffAparcamiento">
													<span class="onoffswitch2-inner"></span>
													<span class="onoffswitch2-switch"></span>
												</label>
											</div>
										</td>
									</tr>
								</table>
							</div>
						</div>

						<div style="float: left; width:50%">
							<div class="table-responsive">
								<table class="table table-hover">
									<tr>
									<td style="font-size:14px;padding:3px">WIFI</td>
										<td style="padding:4px;width: 90px;">
											<div class="onoffswitch2">
												<input type="checkbox" name="onOffWifi" class="onoffswitch2-checkbox" id="onOffWifi" >
												<label class="onoffswitch2-label" for="onOffWifi">
													<span class="onoffswitch2-inner"></span>
													<span class="onoffswitch2-switch"></span>
												</label>
											</div>
										</td>
									</tr>
								</table>
							</div>
						</div>

						<div style="float: left; width:50%">
							<div class="table-responsive">
								<table class="table table-hover">
									<tr>
									<td style="font-size:14px;padding:3px">Piscina</td>
										<td style="padding:4px;width: 90px;">
											<div class="onoffswitch2">
												<input type="checkbox" name="onOffPiscina" class="onoffswitch2-checkbox" id="onOffPiscina" >
												<label class="onoffswitch2-label" for="onOffPiscina">
													<span class="onoffswitch2-inner"></span>
													<span class="onoffswitch2-switch"></span>
												</label>
											</div>
										</td>
									</tr>
								</table>
							</div>
						</div>

						<div style="float: left; width:50%">
							<div class="table-responsive">
								<table class="table table-hover">
									<tr>
									<td style="font-size:14px;padding:3px">Aire acondicionado</td>
										<td style="padding:4px;width: 90px;">
											<div class="onoffswitch2">
												<input type="checkbox" name="onOffAire" class="onoffswitch2-checkbox" id="onOffAire" >
												<label class="onoffswitch2-label" for="onOffAire">
													<span class="onoffswitch2-inner"></span>
													<span class="onoffswitch2-switch"></span>
												</label>
											</div>
										</td>
									</tr>
								</table>
							</div>
						</div>

						<div style="float: left; width:50%">
							<div class="table-responsive">
								<table class="table table-hover">
									<tr>
									<td style="font-size:14px;padding:3px">Lavanderia</td>
										<td style="padding:4px;width: 90px;">
											<div class="onoffswitch2">
												<input type="checkbox" name="onOffLavanderia" class="onoffswitch2-checkbox" id="onOffLavanderia" >
												<label class="onoffswitch2-label" for="onOffLavanderia">
													<span class="onoffswitch2-inner"></span>
													<span class="onoffswitch2-switch"></span>
												</label>
											</div>
										</td>
									</tr>
								</table>
							</div>
						</div>

						<div style="float: left; width:50%">
							<div class="table-responsive">
								<table class="table table-hover">
									<tr>
									<td style="font-size:14px;padding:3px">SPA</td>
										<td style="padding:4px;width: 90px;">
											<div class="onoffswitch2">
												<input type="checkbox" name="onOffSpa" class="onoffswitch2-checkbox" id="onOffSpa" >
												<label class="onoffswitch2-label" for="onOffSpa">
													<span class="onoffswitch2-inner"></span>
													<span class="onoffswitch2-switch"></span>
												</label>
											</div>
										</td>
									</tr>
								</table>
							</div>
						</div>

						<div style="float: left; width:50%">
							<div class="table-responsive">
								<table class="table table-hover">
									<tr>
									<td style="font-size:14px;padding:3px">Gimnasio</td>
										<td style="padding:4px;width: 90px;">
											<div class="onoffswitch2">
												<input type="checkbox" name="onOffGym" class="onoffswitch2-checkbox" id="onOffGym" >
												<label class="onoffswitch2-label" for="onOffGym">
													<span class="onoffswitch2-inner"></span>
													<span class="onoffswitch2-switch"></span>
												</label>
											</div>
										</td>
									</tr>
								</table>
							</div>
						</div>

						<div style="float: left; width:50%">
							<div class="table-responsive">
								<table class="table table-hover">
									<tr>
									<td style="font-size:14px;padding:3px">Restaurante</td>
										<td style="padding:4px;width: 90px;">
											<div class="onoffswitch2">
												<input type="checkbox" name="onOffRestaurant" class="onoffswitch2-checkbox" id="onOffRestaurant" >
												<label class="onoffswitch2-label" for="onOffRestaurant">
													<span class="onoffswitch2-inner"></span>
													<span class="onoffswitch2-switch"></span>
												</label>
											</div>
										</td>
									</tr>
								</table>
							</div>
						</div>

						<div style="float: left; width:50%">
							<div class="table-responsive">
								<table class="table table-hover">
									<tr>
									<td style="font-size:14px;padding:3px">Bar</td>
										<td style="padding:4px;width: 90px;">
											<div class="onoffswitch2">
												<input type="checkbox" name="onOffBar" class="onoffswitch2-checkbox" id="onOffBar" >
												<label class="onoffswitch2-label" for="onOffBar">
													<span class="onoffswitch2-inner"></span>
													<span class="onoffswitch2-switch"></span>
												</label>
											</div>
										</td>
									</tr>
								</table>
							</div>
						</div>

						<div style="float: left; width:50%">
							<div class="table-responsive">
								<table class="table table-hover">
									<tr>
									<td style="font-size:14px;padding:3px">Pet friendly</td>
										<td style="padding:4px;width: 90px;">
											<div class="onoffswitch2">
												<input type="checkbox" name="onOffPet" class="onoffswitch2-checkbox" id="onOffPet" >
												<label class="onoffswitch2-label" for="onOffPet">
													<span class="onoffswitch2-inner"></span>
													<span class="onoffswitch2-switch"></span>
												</label>
											</div>
										</td>
									</tr>
								</table>
							</div>
						</div>
						
					</div>
					
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="name_on_card"><b>Favor si desea registrar un comentario adicional en forma general:</b></label>
								<textarea placeholder="Comentarios adicionales" name="comentarios" rows="3" class="form-control" required></textarea>
							</div>
						</div>	
					</div>
				</div>
				<div class="modal-footer">
					<button onclick="realizarPago()" id="btn_pagar" class="btn btn-primary">Enviar</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
				</div>
		</div>
	</div>
</div>	 




