<section class="bar background-pentagon no-mb">
        <div id="content">
          <div id="contact" class="container">
            <div class="row">
              <div class="col-lg-8">
                <section class="bar">
                  <div class="heading">
                    <h2>We are here to help you</h2>
                  </div>
                  <p class="lead">Are you curious about something? Do you have some kind of problem with our products? As am hastily invited settled at limited civilly fortune me. Really spring in extent an by. Judge but built gay party world. Of so am he remember although required. Bachelor unpacked be advanced at. Confined in declared marianne is vicinity.</p>
                  <p class="text-sm">Please feel free to contact us, our customer service center is working for you 24/7.</p>
                  <div class="heading">
                    <h3>FORMULARIO DE CONTACTO</h3>
                  </div>
                  <?php

                    $mensajes = new MensajesController();
                    $mensajes -> registroMensajesController();

                    ?>
                  <form method="post" onsubmit="return validarMensaje()">
                    <div class="row">
                      <div class="col-md-9">
                        <div class="form-group">
                          <label for="firstname">Nombres y Apellidos</label>
                          <input name="nombres" id="nombres" type="text" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="lastname">Celular</label>
                          <input name="telefono" id="telefono" type="text" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="email">Correo</label>
                          <input type="email" name="email" id="email" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="subject">Asunto</label>
                          <input name="asunto" id="asunto" type="text" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="message">Mensaje</label>
                          <textarea name="mensaje" id="mensaje" class="form-control"></textarea>
                        </div>
                      </div>
                      <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-template-outlined"><i class="fa fa-envelope-o"></i> Send message</button>
                      </div>
                    </div>
                  </form>        
                </section>
              </div>
              <div class="col-lg-4">
                <section class="bar mb-0">
                  <h3 class="text-uppercase">Address</h3>
                  <p class="text-sm">13/25 New Avenue<br>New Heaven<br>45Y 73J<br>England<br><strong>Great Britain</strong></p>
                  <h3 class="text-uppercase">Call center</h3>
                  <p class="text-muted text-sm">This number is toll free if calling from Great Britain otherwise we advise you to use the electronic form of communication.</p>
                  <p><strong>+33 555 444 333</strong></p>
                  <h3 class="text-uppercase">Electronic support</h3>
                  <p class="text-muted text-sm">Please feel free to write an email to us or to use our electronic ticketing system.</p>
                  <ul class="text-sm">
                    <li><strong><a href="mailto:">info@fakeemail.com</a></strong></li>
                    <li><strong><a href="#">Ticketio</a></strong> - our ticketing support platform</li>
                  </ul>
                </section>
              </div>
            </div>
          </div>
        </div>
      </section>
