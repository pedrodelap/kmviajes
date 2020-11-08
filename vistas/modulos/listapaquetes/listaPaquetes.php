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
					<!-- <p class="loadMore text-center">
						<a href="#" class="btn btn-template-outlined"><i class="fa fa-chevron-down"></i> Mostrar más</a>
					</p>-->
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

<style>

ul.ui-autocomplete {
    z-index: 1100;
}

.ui-autocomplete {
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 1000;
  display: none;
  float: left;
  min-width: 160px;
  padding: 5px 0;
  margin: 2px 0 0;
  list-style: none;
  font-size: 14px;
  text-align: left;
  background-color: #ffffff;
  border: 1px solid #cccccc;
  border: 1px solid rgba(0, 0, 0, 0.15);
  border-radius: 4px;
  -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
  background-clip: padding-box;
}

.ui-autocomplete > li > div {
  display: block;
  padding: 3px 20px;
  clear: both;
  font-weight: normal;
  line-height: 1.42857143;
  color: #333333;
  white-space: nowrap;
}

.ui-state-hover,
.ui-state-active,
.ui-state-focus {
  text-decoration: none;
  color: #262626;
  background-color: #f5f5f5;
  cursor: pointer;
}

.ui-helper-hidden-accessible {
  border: 0;
  clip: rect(0 0 0 0);
  height: 1px;
  margin: -1px;
  overflow: hidden;
  padding: 0;
  position: absolute;
  width: 1px;
}



</style>


<!-- Login Modal-->
<div id="modal-soluciud-personalizada" tabindex="-1" role="dialog" aria-labelledby="login-modalLabel" aria-hidden="true"
	class="modal fade">
	<div role="document" class="modal-dialog">
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

					<div class="col-sm-6">
						<div class="form-group">
							<label for="SolicitudPersonalizadaNombres">Nombres</label>
							<input id="SolicitudPersonalizadaNombres" type="text" placeholder="Nombres completos" class="form-control" require/>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="SolicitudPersonalizadaApellidos">Apellidos</label>
							<input id="SolicitudPersonalizadaApellidos" type="text" placeholder="Nombres completos" class="form-control" require/>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="SolicitudPersonalizadaTelefono">Número de contacto</label>
							<input id="SolicitudPersonalizadaTelefono" type="tel" placeholder="(+51) ___-___-___" class="form-control" maxlength="9" require/>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="SolicitudPersonalizadaDocumento">Número de documento</label>
							<input id="SolicitudPersonalizadaDocumento" type="text" placeholder="DNI o Pasaporte" class="form-control" maxlength="15" />
						</div>
					</div>

				</div>
				<div class="row">

					<div class="col-sm-12">
						<div class="form-group">
							<label for="SolicitudPersonalizadaCorreo">Correo contacto</label>
							<input id="SolicitudPersonalizadaCorreo" type="email" placeholder="viajero@mail.com" class="form-control" require/>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<label for="SolicitudPersonalizadaPaisCiudad">Destino</label>
							<input id="SolicitudPersonalizadaPaisCiudad" type='text' class="form-control"/>
							<input id="SolicitudPersonalizadaPaisCiudadId" type="hidden" value="">
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
							<label for="SolicitudPersonalizadaServicios">Servicios disponibles</label>
							<select style="width: 100%" multiple="multiple" class="form-control" name ="SolicitudPersonalizadaServicios" id="SolicitudPersonalizadaServicios">
								<option value="1" data-badge="1">Boleto Aéreo</option>
								<option value="2" data-badge="2">Traslados</option>
								<option value="3" data-badge="3">Noche de Alojamiento</option>
								<option value="4" data-badge="4">Sistema todo incluido</option>
								<option value="5" data-badge="5">Desayuno</option>
								<option value="6" data-badge="6">Tarjeta de Asistencia</option>
								<option value="7" data-badge="7">Rastro de maletas</option>							
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