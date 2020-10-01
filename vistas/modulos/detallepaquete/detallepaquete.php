<?php
	
	$idPaquete = $_GET["id"];
	$paquete = ControladorPaqueteFront::ctrObtenetPaqueteById($idPaquete);

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
					<li class="breadcrumb-item"><a href="#">Catálogo</a></li>
					<li class="breadcrumb-item active"><?php echo $paquete["nombreCiudad"]; ?></li>
				</ul>
			</div>
		</div>
	</div>
</div>


<div id="content">
	<div class="container">
		<section class="no-mb bar">
			<div class="row">
				<div class="col-md-12">
					<p class="lead no-mb"><?php echo $paquete["descripcion_corta"]; ?></p>
				</div>
			</div>
		</section>
		<section>

			<div class="project owl-carousel">

				<?php
					
					$servicios = ControladorPaqueteFront::ctrListarFotosPorPaquete($idPaquete);

					foreach ($servicios as $key => $value) {

						echo '<div class="item"><img src="backend/'.$value["ruta_imagen"].'" alt="" class="img-fluid"></div>';

					}

				?>

			</div>

		</section>
		<section class="bar">
			<div class="row portfolio-project">
				<div class="col-md-8">
					<div class="heading">
						<h3><?php

            					$precio_dolar = $paquete["precio_dolar"];
								$precio_sol = $paquete["precio_sol"];
								
								echo $paquete["titulo"].' por $'.$precio_dolar.' o S/.'.$precio_sol; ?>
						</h3>
		
					</div>
					<p><?php echo $paquete["descripcion_larga"]?></p>
				</div>
				<div class="col-md-4 project-more">
					<div class="heading">
						<h3>Información</h3>
					</div>
					<?php
						$nombreCampania = $paquete["nombreCampania"];

						echo '<h4>Campaña</h4>   <p>'.$nombreCampania.'</p>' ;

					?>

					<?php 

						$nombreHotel = $paquete["nombreHotel"];

						$nombreCiudad = $paquete["nombreCiudad"];

						echo '<h4>Hotel/Ciudad</h4>   <p>'.$nombreHotel.'/'.$nombreCiudad.'</p>';
					
					?>
					<?php

						$compania = $paquete["compania"];

						echo '<h4>Aeorolinea</h4>   <p>'.$compania.'</p>' 

					?>
					<?php 

						$cantidad_adultos = $paquete["cantidad_adultos"];

						$cantidad_ninios = $paquete["cantidad_ninios"];

						echo '<h4>Pasajeros</h4>   <p>'.$cantidad_adultos.' Adultos - '.$cantidad_ninios.' Niños</p>' ;

					?>
					<?php 

						$fecha_inicio = $paquete["fecha_inicio"];

						$fecha_fin = $paquete["fecha_fin"];

						echo '<h4>Fechas</h4>   <p>'.$paquete["fecha_mostrar"].'</p>' ;

					?>

				</div>
			</div>
		</section>

		<div id="details" class="box mb-4 mt-4">
			<h4>Servicios incluidos</h4>

			<ul class="fa-ul">

				<?php 

					$servicios = ControladorPaqueteFront::ctrListarServiciosPorPaquete($idPaquete);

					foreach ($servicios as $key => $value) {

						echo '<li><i class="fa-li fa '.$value["icono"].'"></i>'.$value["nombre"].'</li>';

					}
				?>

			</ul>
			<p class="loadMore text-center"><a href="#" data-toggle="modal" data-target="#modal-soluciud-paquete"
					class="btn btn-template-outlined"><i class="fa fa-chevron-down"></i>
					<?php echo 'Reservalo a S/.'.$precio_sol.' o $'.$precio_dolar ?></a></p>
		</div>

		<div class="bar pt-0">
			<section>
				<div class="row portfolio">
					<div class="col-md-12">
						<div class="heading">
							<h3>Relacionados</h3>
						</div>
					</div>

					<?php
					
						$id_campania = $paquete["id_campania"];

						$relacionados = ControladorPaqueteFront::ctrListarPaquetePorCampania($id_campania);

						foreach ($relacionados as $key => $value) {

							$ruta = "index.php?ruta=detallepaquete&id=".$value["id_paquete"];

							echo '<div class="col-md-6 col-lg-3">
									<div class="box-image">
										<div class="image"><img src="backend/'.$value["ruta_imagen"].'" alt="" class="img-fluid">
											<div class="overlay d-flex align-items-center justify-content-center">
												<div class="content">
													<div class="name">
														<h3><a href="#" class="color-white" style="text-decoration: none;">S/.'.$value["precio_sol"].'  o  $'.$value["precio_dolar"].' </a></h3>
													</div>
													<div class="text">
														<p class="buttons"><a href="'.$ruta.'" class=" btn-buscar2 btn btn-template-outlined-white">Ver</a></p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>';

						}

					?>

				</div>

			</section>

		</div>

	</div>

</div>

<!-- Login Modal-->

<div id="modal-soluciud-paquete" tabindex="-1" role="dialog" aria-labelledby="login-modalLabel" aria-hidden="true"
	class="modal fade">
	<div role="document" class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 id="login-modalLabel" class="modal-title">Solicitud del Paquete</h4>
				<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
						aria-hidden="true">×</span></button>
			</div>
			<div class="modal-body">
				<input type="hidden" id="id_paquete2" val="<?php echo $idPaquete ?>" />
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="txtNombre2">Nombres</label>
							<input id="txtNombre2" type="text" placeholder="Nombres completos" class="form-control">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="txtNombre2">Apellidos</label>
							<input id="txtNombre2" type="text" placeholder="Nombres completos" class="form-control">
						</div>
					</div>
				</div>
				<div class="row">

					<div class="col-sm-6">
						<div class="form-group">
							<label for="txtTelefono2">Número de contacto</label>
							<input id="txtTelefono2" type="tel" placeholder="+51 999999999" class="form-control">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="txtDocumento2">Número de documento</label>
							<input id="txtDocumento2" type="text" placeholder="DNI o Pasaporte" class="form-control">
						</div>
					</div>

				</div>
				<div class="row">

					<div class="col-sm-12">
						<div class="form-group">
							<label for="txtCorreo2">Correo contacto</label>
							<input id="txtCorreo2" type="email" placeholder="viajero@mail.com" class="form-control">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button onclick="registroSolicitudxPaquete()" class="btn btn-primary">Enviar Solicitud</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Login modal end-->