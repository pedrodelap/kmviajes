<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Slide
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
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Agregar los Sliders Principales </h5>

                    <!--=====================================
                                    SUBIR SLIDE
                    ======================================-->

                    <div id="imgSlide">
                        <p><span class="fa fa-arrow-down"></span> Arrastra aquí tu imagen, tamaño recomendado: 1600px * 600px</p>
                        <ul id="columnasSlide">
                            <?php
                            $slide = new ControladorSlide();
                            $slide->ctrMostrarImagenVista();
                            ?>
                        </ul>
                        <button id="ordenarSlide" class="btn btn-warning pull-right" style="margin:10px 30px">Ordenar Slides</button>
                        <button id="guardarSlide" class="btn btn-primary pull-right" style="display:none; margin:10px 30px">Guardar Orden Slides</button>
                    </div>

                    <!--====  Fin de LISTADO COTIZACIONES  ====-->

                </div>

                <hr>

                <div class="card-body">

                    <h5 class="card-title">Edite el contenido de los Sliders</h5>

                    <!--=====================================
                                    CONTENIDO SLIDE
                    ======================================-->

                    <div id="textoSlide">
                        <ul id="ordenarTextSlide">
                            <?php

                            $slide = new ControladorSlide();
                            $slide->ctrEditorSlide();

                            ?>
                        </ul>
                    </div>

                    <!--====  Fin de CONTENIDO SLIDE  ====-->

                </div>

            </div>
        </div>
    </div>
</div>