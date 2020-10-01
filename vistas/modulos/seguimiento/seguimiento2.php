<div class="container px-1 px-md-4 py-5 mx-auto">
    <div class="card">
        <div class="row d-flex justify-content-between px-3 top">
            <div class="d-flex">
                <h5>SOLICITUTD <span class="text-primary font-weight-bold">#6152</span></h5>
            </div>
            
        </div> <!-- Add class 'active' to progress -->
        <div class="row d-flex justify-content-center">
            <div class="col-12">
                <ul id="progressbar" class="text-center">
                    <li class="active step0"></li>
                    <li class="active step0"></li>
                    <li class="active step0"></li>
                    <li class="step0"></li>
                    <li class="step0"></li>
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
    <div id="content">
        <div class="container">
          <div class="row">

    <div id="checkout" class="col-lg-9">
              <div class="box">
                  <ul class="nav nav-pills nav-fill">
                    <li class="nav-item"><a href="#" class="nav-link active"><i class="fa fa-eye"></i><br>Detalle de notificaciones</a></li>
                  </ul>
                
                <div class="content">
                  <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Nro Solicitud</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Acción</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th># 1735</th>
                        <td>22/06/2013</td>
                        <td><span class="badge badge-success">Solicitud Registrada</span></td>
                        <td><button type="button" class="btn btn-sm btn-default" disabledt>Sin acción</button></td>
                      </tr>
                      <tr>
                        <th># 1735</th>
                        <td>22/06/2013</td>
                        <td><span class="badge badge-success">Solicitud cotizada</span></td>
                        <td><a href="#" class="btn btn-template-outlined btn-sm">Cancelar</a></td>
                      </tr>
                      <tr>
                        <th># 1735</th>
                        <td>22/06/2013</td>
                       
                        <td><span class="badge badge-info">Cotización Reservada</span></td>
                        <td><a href="#" data-toggle="modal" data-target="#login-modal" class="btn btn-template-outlined btn-sm">Pagar</a></td>
                      </tr>
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
                <p class="text-muted text-small">Shipping and additional costs are calculated based on the values you have entered.</p>
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

 <!-- Login Modal-->

 <div id="login-modal" tabindex="-1" role="dialog" aria-labelledby="login-modalLabel" aria-hidden="true" class="modal fade">
        <div role="document" class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 id="login-modalLabel" class="modal-title">Realizar Pago</h4>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
            <input type="hidden" id="id_paquete" val="<?php echo $idPaquete ?>"/>
                  <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="ccnum">Tarjeta</label>
                            <div class="input-group mb-3">
                            <input id="ccnum" type="text" placeholder="Tarjeta" class="form-control">
                              <div class="input-group-append">
                                <span class="input-group-text" id="type"><img src="https://img.icons8.com/android/20/000000/bank-card-back-side.png"/></span>
                              </div>
                            </div>
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
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="txtCorreo">Correo contacto</label>
                            <input id="txtCorreo" type="email" placeholder="viajero@mail.com" class="form-control">
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
      <!-- Login modal end-->