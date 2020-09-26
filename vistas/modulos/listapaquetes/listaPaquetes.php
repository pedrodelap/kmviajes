
<div id ="data"> 
</div>
<section class="bar background-white no-mb">
    <div data-animate="fadeInUpBig" class="container"> 
        <div class="row">
        <div class="col-md-12">
            <div class="heading text-center">
           
            <h2>Catálogo paquetes turísticos</h2>
            </div>
            <p class="lead">Viaje a Perú descubra con nosotros las ciudades más importantes del país, Lima, Cusco, Arequipa, Puno y otros. Todos estos destinos ofrecen un sinfín de actividades, riqueza paisajística, geográfica y una identidad cultural única.</p>
            <div class="get-it">
        <div class="container">
          <div class="row">
            <div class="col-lg-8 text-center p-3">
                <div class="form-group">
                        <input id="txtBuscar" type="text" placeholder="Ingresa el destino" class="form-control">
                 </div>
            </div>
            <div class="col-lg-4 text-center p-3"> <button class="btn btn-outline-primary btn-buscar">Encuentra tu paquete</button></div>
          </div>
        </div>
    </div>
            <div class="row  text-center" id="content-data-paquete">
            
            </div>
            <div class="pages">
                <p class="loadMore text-center"><a href="#" class="btn btn-template-outlined"><i class="fa fa-chevron-down"></i> Mostrar más</a></p>
                
            </div>
            <div class="see-more text-center">
            <p>Desea consultar un paquete personalizado?</p><a href="#" data-toggle="modal" data-target="#login-modal" class="btn btn-template-outlined">Descubrir más paquetes</a>
            </div>
        </div>
        </div>
    </div>
</section>

<!-- Login Modal-->
<div id="login-modal" tabindex="-1" role="dialog" aria-labelledby="login-modalLabel" aria-hidden="true" class="modal fade">
        <div role="document" class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 id="login-modalLabel" class="modal-title">Solicitud Personalizada</h4>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
              
              <input type="hidden" id="id_paquete"/>
                  <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="txtNombre">Apellidos y nombre(s)</label>
                            <input id="txtNombre" type="text" placeholder="Nombres completos" class="form-control">
                        </div>
                    </div>
                 
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="txtTelefono">Número de contacto</label>
                            <input id="txtTelefono" type="tel" placeholder="+51 999999999" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="txtDocumento">Número de documento</label>
                            <input id="txtDocumento" type="text" placeholder="DNI o Pasaporte" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="txtCorreo">Correo contacto</label>
                            <input id="txtCorreo" type="email" placeholder="viajero@mail.com" class="form-control">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="destination">Destino</label>
                            <select id="id_ciudad" class="bs-select form-control">
                                
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="txtFechaInicio">Fechas</label>
                            <div class="input-daterange input-group" id="datepicker">
                                <input type="text" class="form-control cotizacionNuevoFecha" id="txtFecha" placeholder="Ingresar fecha de viajes"/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="txtAdultos">Viajeros Adultos</label>
                            <input type="number" id="txtAdultos" value="2" class="form-control">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="txtNinios">Viajeros Niños</label>
                            <input type="number" value="2" id = "txtNinios" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="txtViajeros">Servicios que desearía contar</label><br/>
                            <label class="checkbox-inline"> Todo incluido <input class="checkboxService" type="checkbox" value="allIn"></label>
                            <label class="checkbox-inline"> Hotel 4 y 5 <input class="checkboxService" type="checkbox" value="hotel4_5"></label>
                            <label class="checkbox-inline"> Traslados <input class="checkboxService" type="checkbox" value="traslados"></label>
                            <label class="checkbox-inline"> Tarjeta asistencia <input class="checkboxService" type="checkbox" value="tarjeta_asistencia"></label>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="txtObservacion">Comentarios</label>
                            <textarea id="txtObservacion" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                        <button onclick="registroSolicitud()" class="btn btn-lg btn-outline-dark"><i class="fa fa-sign-in"></i> Enviar</button>
                        </div>
                    </div>
                    </div>
              
              <p class="text-center text-muted"><a href="customer-register.html"><strong>Conoce más</strong></a>Sobre el trato de tus datos personales</p>
            </div>
          </div>
        </div>
      </div>

