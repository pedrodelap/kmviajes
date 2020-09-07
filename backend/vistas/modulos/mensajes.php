<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Mensajes
                    <div class="page-title-subheading">This is an example dashboard created using build-in elements and components.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
            </div>
        </div>
    </div>
<<<<<<< HEAD
    <div class="row">
=======
    <div class="row animated fadeIn">
>>>>>>> 90cfe57fea136401cc7ad60f34fbe43057d7108d

        <!--=====================================
                        MENSAJES
        ======================================-->    

        <div class="col-md-6">
            <div class="app-inner-layout__sidebar card bg-white" style="flex: 0 0 420px;">
                <div id="bandejaMensajes">
                    <div>
                    <h5 class="card-title">Bandeja de Entrada</h5>
                        <hr>
                    </div>
                    <?php
                        $mostrarMensajes = new ControladorMensajes();
                        $mostrarMensajes -> ctrMostrarMensajes();
                        $mostrarMensajes -> ctrBorrarMensajes();
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="app-inner-layout__content card">
                <div>
                    &nbsp;
                    <div>
                        &nbsp;
                        <button id="enviarCorreoMasivo" class="btn btn-success">Enviar mensaje a todos los usuarios</button>
                    </div>                        
                    <div id="lecturaMensajes" class="bg-white">
                        <div id="visorMensajes">
                            <?php
                                $responderMensajes = new ControladorMensajes();
                                $responderMensajes -> ctrResponderMensajes();
                                $responderMensajes -> ctrMensajesMasivos();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--====  Fin de MENSAJES  ====-->
        
    </div>
</div>


<script>
    $(window).on("load",function(){

        var datos = new FormData();

        datos.append("revisionMensajes", 1);

        $.ajax({
<<<<<<< HEAD
                url:"ajax/revision.ajax.php",
=======
                url:"ajax/ajax.revision.php",
>>>>>>> 90cfe57fea136401cc7ad60f34fbe43057d7108d
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success: function(respuesta){}

            });


    })
</script>














