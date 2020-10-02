<?php
	
	$codigoSeguimiento = $_GET["codseg"];
	$paquete = ControladorPaqueteFront::ctrObtenetPaqueteByCodigoSeguimiento($codigoSeguimiento);
?>

<div id="heading-breadcrumbs">
	<div class="container">
		<div class="row d-flex align-items-center flex-wrap">
			<div class="col-md-7">
				<h1 class="h2">KM Viajes</h1>
			</div>
			<div class="col-md-5">
				<ul class="breadcrumb d-flex justify-content-end">
					<li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
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
				<p class="lead">
				Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat
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
							$count = 1;
							$historial = ControladorPaqueteFront::ctrObtenerHistoricoSeguimiento($codigoSeguimiento);
							foreach ($historial as $value) {
								echo "<li class='step0 active'></li>";
								$count +=1;
								
							}
							
							for ($i = $count; $i <= 5; $i++) {
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

													foreach ($historial as $value) {
														
														$htmlAction = "";
														$stepNumber = 1;
														$estadoSolicitud = $value[1];
														
														
														switch ($estadoSolicitud) {
															case "Solicitud Registrada":
																$htmlAction = '<button type="button" class="btn btn-sm btn-default" disabledt="">Sin acción</button>';
																
															break;
															case "Solicitud Cotizada":
																if($stepNumber <=3 ){
																	$htmlAction = '<a href="#" class="btn btn-template-outlined btn-sm">Cancelar</a>';
																}
																else{
																	$htmlAction = '<button type="button" class="btn btn-sm btn-default" disabledt="">Sin acción</button>';
																}
																
															break;
															case "Solicitud Reservada":
																if($stepNumber <=3 ){
																	$htmlAction = '<a href="#" data-toggle="modal" data-target="#pagar-modal" class="btn btn-template-outlined btn-sm">Pagar</a>';
																}
																else{
																	$htmlAction = '<button type="button" class="btn btn-sm btn-default" disabledt="">Sin acción</button>';
																}
															break;
															case "Solicitud Pagada":
																if($stepNumber <=3 ){
																	$htmlAction = '<button type="button" class="btn btn-sm btn-default" disabledt="">Sin acción</button>';
																}
																else{
																	$htmlAction = '<button type="button" class="btn btn-sm btn-default" disabledt="">Sin acción</button>';
																}
															break;
															default:
																if($stepNumber <=3 ){
																	$htmlAction = '<button type="button" class="btn btn-sm btn-default" disabledt="">Sin acción</button>';
																}
																else{
																	$htmlAction = '<button type="button" class="btn btn-sm btn-default" disabledt="">Sin acción</button>';
																}
															break;
															
														}
														$stepNumber += 1;
														
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
										<h3>Información</h3>
									</div>
									<p class="text-muted text-small">Shipping and additional costs are calculated based
										on the values you have entered.</p>
									<div class="table-responsive">
										<table class="table">
											<tbody>
												<tr>
													<td>Descripción</td>
													<th>Berlin</th>
												</tr>
												<tr>
													<td>Pasajeros</td>
													<th>4 Adultos - 2 Niños</th>
												</tr>
												<tr>
													<td>Fecha*</td>
													<th>2020-12-30</th>
												</tr>
												<tr class="total">
													<td>Total</td>
													<th>$456.00</th>
												</tr>
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