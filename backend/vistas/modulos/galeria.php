<div class="app-main__inner">

    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Galeria
                    <div class="page-title-subheading">This is an example dashboard created using build-in elements and components.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
            </div>
        </div>
    </div>
    <div class="row animated fadeIn">
        <div class="col-md-12">
            <div class="main-card mb-3 card">

                <!--=====================================
                GALERIA ADMINISTRABLE          
                ======================================-->
                <div class="card-body">
                    <h5 class="card-title">Garleria de Imagenes </h5>

                    <div id="galeria" >
                        <hr>
                        <p>
                            <span class="fa fa-arrow-down"></span>  Arrastra aquí tu imagen (Tamaño recomendado: 1024px * 768px, peso permitido: 2Mb)
                        </p>
                        <ul id="lightbox">
                            <?php
                            $slide = new ControladorGaleria();
                            $slide -> ctrMostrarImagenVista();
                            ?>
                        </ul>
                        <button id="ordenarGaleria" class="btn btn-warning pull-right" style="margin:10px 30px">Ordenar Imágenes</button>
                        <button id="guardarGaleria" class="btn btn-primary pull-right" style="margin:10px 30px; display:none">Guardar Orden Imágenes</button>
                    </div>
                </div>
                <!--====  Fin de GALERIA ADMINISTRABLE  ====-->

            </div>
        </div>
    </div>
</div>









