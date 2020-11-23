<?php
	
	$codigoSeguimiento = $_GET["codseg"];
	$paquete = ControladorPaqueteFront::ctrObtenetPaqueteByCodigoSeguimiento($codigoSeguimiento);
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


			<button type="button" data-toggle="modal" data-target="#calificar-modal" class="btn btn-template-outlined btn-sm">Aceptar</button>

			<div class="container px-1 px-md-4 py-5 mx-auto">
				<div class="card">
				</div>
				<div id="content">
					<div class="container">
						<div class="row">

							<div id="checkout" class="col-lg-9">
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
																if($count <= 1 ){
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
																	$htmlAction = '<button type="button" data-toggle="modal" data-target="#pagar-modal" class="btn btn-template-outlined btn-sm">Realizar Pago</button>';
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
							<div class="col-lg-3">
								<div id="order-summary" class="box mb-4 p-0">
									<div class="box-header mt-0">
										<h3>Informacion</h3>
									</div>
									<p class="text-muted text-small"><?php echo $paquete["descripcion_corta"]; ?></p>
									<div class="table-responsive">
										<table class="table">
											<tbody>
												<tr>
													<th colspan="2"><?php echo $paquete["titulo"]; ?></th>
												</tr>
											
												<tr>
													<td>Destino</td>
													<th><?php echo $paquete["ciudad"]; ?></th>
												</tr>
												<!--
												<tr>
													<td>Pasajeros</td>
													<th><?php //echo $paquete["pasajeros"]; ?></th>
												</tr>
												-->
												<tr>
													<td>Fecha*</td>
													<th><?php echo $paquete["fecha_mostrar"]; ?></th>
												</tr>

												<input type="hidden" id="amount" value="<?php echo $paquete["precio_dolar"]; ?>"/>
												<input type="hidden" id="description" value="<?php echo $paquete["titulo"]; ?>"/>
												<input type="hidden" id="phone" value="<?php echo $paquete["telefono"]; ?>"/>
												<input type="hidden" id="merchantPayerId" value="<?php echo $paquete["id_cliente"]; ?>"/>
												<input type="hidden" id="dniNumber" value="<?php echo $paquete["numero_documento"]; ?>"/>
												<input type="hidden" id="id_solicitud" value="<?php echo $paquete["id_solicitud"]; ?>"/>
											</tbody>
										</table>
									</div>
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


<!-- Login Modal-->


 <div id="pagar-modal" tabindex="-1" role="dialog" aria-labelledby="login-modalLabel" aria-hidden="true" class="modal fade">
        <div role="document" class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
			<img src="https://img.icons8.com/material-rounded/24/000000/lock.png"/>
              <h4 id="login-modalLabel" class="modal-title">Realizar Pago</h4>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            	<div class="modal-body">
					<input type="hidden" id="codigoSeguimiento" value="<?php echo $codigoSeguimiento ?>"/>
					<div class="row">
						<div class="col-sm-6">
							<div class="image">
								<img src="backend/vistas/images/paquetes/74_img_4_20200926051408.png" alt="" class="img-fluid">
							</div>
							<div class="table-responsive">
							<table class="table">
								<tbody>
								<tr>
									<th colspan="2"><?php echo $paquete["titulo"]; ?></th>
								</tr>
								<tr>
									<td>Destino</td>
									<th><?php echo $paquete["ciudad"]; ?></th>
								</tr>
								<tr>
									<td>Fecha</td>
									<th><?php echo $paquete["fecha_fin"]; ?></th>
								</tr>
								<tr class="total">
									<td>Total</td>
									<th>$<?php echo number_format($paquete["precio_dolar"],2); ?></th>
								</tr>
								</tbody>
							</table>
               			 </div>
						</div>
						<div class="col-sm-6">
							

							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label for="card_number"><b>Número de tarjeta</b></label>
										<div class="input-group mb-3">
										
										<div class="input-group-append">
											<span class="input-group-text" style="padding:0 5px;" id="type"><img class="img_card" src="https://img.icons8.com/android/48/000000/bank-card-back-side.png"/></span>
										</div>
										<input id="card_number" maxlength="16" type="text" placeholder="Numero de tarjeta" class="form-control">
										</div>
									</div>
								</div>
							</div>
						
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<label for="expiry_month"><b>Mes expiración</b></label>
										<input id="expiry_month" type="text" maxlength="2" placeholder="MM" class="form-control">
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label for="expiry_year"><b>Año expiración</b></label>
										<input id="expiry_year" type="text" maxlength="4" placeholder="AAAA" class="form-control">
									</div>
								</div>
								
								<div class="col-sm-4">
									<div class="form-group">
										<label for="cvv"><b>CVV</b></label>
										<input id="cvv" type="password" maxlength="4" placeholder="000" class="form-control">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label for="name_on_card"><b>Titular de tarjeta</b></label>
										<input id="name_on_card" type="text" class="form-control" placeholder="" require/>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label for="txtCorreo"><b>Correo contacto</b></label>
										<input id="txtCorreo" type="email" disabled class="form-control" value="<?php echo $paquete["correo"];?>" require/>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
										<button onclick="realizarPago()" id="btn_pagar" class="btn  btn-primary" style="float: right;">Confirmar pago de $<?php echo number_format($paquete["precio_dolar"],2)?></button>
								</div>
							</div>
							
							
						</div>
						
					</div>
					
			   </div>
			   
          </div>
        </div>
	  </div>
	  


	  <!-- Login modal end-->
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
						<p>Para poder seguir mejorando necesitamos, necesitamos de su apoyo para completar un cuestinario sobre los servicios contratados</p>
						<h4>Servicios Contratados</h4>
						<div class="table-responsive">
							<table class="table table-hover">
								<?php 
									$servicios = ControladorPaqueteFront::ctrListarServiciosPorPaquete($paquete['id_paquete']);			
									foreach ($servicios as $key => $value) {
										
										if($value["calificable"] == 1){
											echo '<tr><td style="padding:4px;font-size:12px;">'.$value["nombre"].'</td><td style="padding:4px"><div class="my-rating-4" data-rating="0"></div></td></tr>';
										}
									}
								?>
							</table>
						</div>
						<p>Nos gustaria conocer su opinion del Hotel <b><?php  echo $paquete['nombre_hotel'];?> </b>
						
						<div class="table-responsive">
							<table class="table table-hover">
								<tr>
									<td style="padding:4px;font-size:12px;padding:3px"><h4>Servicios ofrecidos por el Hotel:</h4></td>
									<td style="padding:4px"><div id="idHotelAll"  data-rating="0"></div></td>
								</tr>
								<tr>
									<td style="font-size:12px;padding:3px">Aparcamiento</td>
									<td style="padding:4px"><div id="idHotelServ1" class="hotel-service-rating" data-rating="0"></div></td>
								</tr>
								<tr>
									<td style="font-size:12px;padding:3px">WIFI</td>
									<td style="padding:4px"><div id="idHotelServ2" class="hotel-service-rating" data-rating="0"></div></td>
								</tr>
								<tr>
									<td style="font-size:12px;padding:3px">Piscina</td>
									<td style="padding:4px"><div id="idHotelServ3" class="hotel-service-rating" data-rating="0"></div></td>
								</tr>
								<tr>
									<td style="font-size:12px;padding:3px">Aire acondicionado</td>
									<td style="padding:4px"><div id="idHotelServ4" class="hotel-service-rating" data-rating="0"></div></td>
								</tr>
								<tr>
									<td style="font-size:12px;padding:3px">Lavanderia</td>
									<td style="padding:4px"><div id="idHotelServ5" class="hotel-service-rating" data-rating="0"></div></td>
								</tr>
								<tr>
									<td style="font-size:12px;padding:3px">SPA</td>
									<td style="padding:4px"><div id="idHotelServ6" class="hotel-service-rating" data-rating="0"></div></td>
								</tr>
								<tr>
									<td style="font-size:12px;padding:3px">Gimnasio</td>
									<td style="padding:4px"><div id="idHotelServ7" class="hotel-service-rating" data-rating="0"></div></td>
								</tr>
								<tr>
									<td style="font-size:12px;padding:3px">Restaurante</td>
									<td style="padding:4px"><div id="idHotelServ8" class="hotel-service-rating" data-rating="0"></div></td>
								</tr>
								<tr>
									<td style="font-size:12px;padding:3px">Bar</td>
									<td style="padding:4px"><div id="idHotelServ9" class="hotel-service-rating" data-rating="0"></div></td>
								</tr>
								<tr>
									<td style="font-size:12px;padding:3px">Pet friendly</td>
									<td style="padding:4px"><div id="idHotelServ10" class="hotel-service-rating" data-rating="0"></div></td>
								</tr>
							</table>
						</div>
						<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="name_on_card"><b>Favor si desea registrar un comentario adicional en forma general:</b></label>
								<textarea placeholder="Comentarios adicionales" name="comentarios" rows="3" class="form-control" required></textarea>
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