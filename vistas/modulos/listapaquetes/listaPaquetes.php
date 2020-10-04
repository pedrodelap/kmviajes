<section class="bar background-white no-mb">
	<div data-animate="fadeInUpBig" class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="heading text-center">
					<h2>Catálogo paquetes turísticos</h2>
				</div>
				<p class="lead">
					Viaje a Perú descubra con nosotros las ciudades más importantes del
					país, Lima, Cusco, Arequipa, Puno y otros. Todos estos destinos
					ofrecen un sinfín de actividades, riqueza paisajística, geográfica y
					una identidad cultural única.
				</p>
				<div>
					<div class="container">
						<div class="row">
							<div class="col-lg-8 text-center p-3">
								<div class="form-group">
									<input id="txtBuscar" type="text" placeholder="Ingresa el destino"
										class="form-control" />
								</div>
							</div>
							<div class="col-lg-4 text-center p-3">
								<button class="btn btn-outline-primary btn-buscar">
									Encuentra tu paquete
								</button>
							</div>
						</div>
					</div>
				</div>
				<div class="row text-center" id="content-data-paquete"></div>
				<div class="pages">
					<p class="loadMore text-center">
						<a href="#" class="btn btn-template-outlined"><i class="fa fa-chevron-down"></i> Mostrar más</a>
					</p>
				</div>
				<div class="see-more text-center">
					<p>Desea consultar un paquete personalizado?</p>
					<a href="#" data-toggle="modal" data-target="#modal-soluciud-personalizada"
						class="btn btn-template-outlined">Descubrir más paquetes</a>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Login Modal-->
<div id="modal-soluciud-personalizada" tabindex="-1" role="dialog" aria-labelledby="login-modalLabel" aria-hidden="true"
	class="modal fade">
	<div role="document" class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 id="login-modalLabel" class="modal-title">
					Solicitud Personalizada
				</h4>
				<button type="button" data-dismiss="modal" aria-label="Close" class="close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<input type="hidden" id="id_paquete" />
				<div class="row">

					<div class="col-sm-3">
						<div class="form-group">
							<label for="SolicitudPersonalizadaNombres">Nombres</label>
							<input id="SolicitudPersonalizadaNombres" type="text" placeholder="Nombres completos" class="form-control" require/>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<label for="SolicitudPersonalizadaApellidos">Apellidos</label>
							<input id="SolicitudPersonalizadaApellidos" type="text" placeholder="Nombres completos" class="form-control" require/>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<label for="SolicitudPersonalizadaTelefono">Número de contacto</label>
							<input id="SolicitudPersonalizadaTelefono" type="tel" placeholder="(+51) ___-___-___" class="form-control" maxlength="9" require/>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<label for="SolicitudPersonalizadaDocumento">Número de documento</label>
							<input id="SolicitudPersonalizadaDocumento" type="text" placeholder="DNI o Pasaporte" class="form-control" maxlength="15" />
						</div>
					</div>

				</div>
				<div class="row">

					<div class="col-sm-6">
						<div class="form-group">
							<label for="SolicitudPersonalizadaCorreo">Correo contacto</label>
							<input id="SolicitudPersonalizadaCorreo" type="email" placeholder="viajero@mail.com" class="form-control" require/>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="SolicitudPersonalizadaCiudad">Destino</label>							
							
							
							<select style="width: 100%;height:36px" class="form-control" name="SolicitudPersonalizadaCiudad" id="SolicitudPersonalizadaCiudad">
                            </select>

						</div>
					</div>

				</div>

				<div class="row">
					<div class="col-sm-4">
						<div class="form-group">
							<label for="txtFechaInicio">Fechas</label>
							<div class="input-daterange input-group" id="datepicker">
								<input type="text" class="form-control cotizacionNuevoFecha" id="SolicitudPersonalizadaFecha"
									placeholder="Ingresar fecha de viajes" />
							</div>
						</div>
					</div>

					<div class="col-sm-4">
						<div class="form-group">
							<label for="SolicitudPersonalizadaAdultos">Viajeros Adultos</label>
							<input type="number" id="SolicitudPersonalizadaAdultos" value="1" class="form-control" />
						</div>
					</div>

					<div class="col-sm-4">
						<div class="form-group">
							<label for="SolicitudPersonalizadaNinos">Viajeros Niños</label>
							<input type="number" id="SolicitudPersonalizadaNinos" value="0" class="form-control" />
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<label for="txtViajeros">Servicios que desearía contar</label>
							<select style="width: 100%" multiple="multiple" name ="SolicitudPersonalizadaServicios" id="SolicitudPersonalizadaServicios">
								<option value="allIn" data-badge="allIn">Todo incluido</option>
								<option value="hotel4_5" data-badge="hotel4_5">Hotel 4 y 5</option>
								<option value="translado" data-badge="allIn">Traslados</option>
								<option value="tarjeta_asistencia" data-badge="tarjeta">Tarjeta asistencia</option>
							</select>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<label for="SolicitudPersonalizadaObservacion">Comentarios</label>
							<textarea id="SolicitudPersonalizadaObservacion" class="form-control" rows="2"></textarea>
						</div>
					</div>
				</div>
				
				<div class="modal-footer">
					<button onclick="registroSolicitud()" class="btn btn-primary">Enviar Solicitud</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
				  </div>

			</div>
		</div>
	</div>

</div>