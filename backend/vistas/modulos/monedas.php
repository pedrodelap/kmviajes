<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Tipos de Cambio de Moneda
                    <div class="page-title-subheading">This is an example dashboard created using build-in elements and components.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
<<<<<<< HEAD
                <button type="button" class="btn-shadow btn btn-info" data-toggle="modal" data-target="#modalNuevoMoneda">
=======
                <button type="button" class="btn-shadow btn btn-primary" data-toggle="modal" data-target="#modalNuevoMoneda">
>>>>>>> 90cfe57fea136401cc7ad60f34fbe43057d7108d
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="pe-7s-add-user pe-7s-w-20"></i>
                    </span>
                    Agregar Moneda
                </button>
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
                    <h5 class="card-title">Listado de Monedas </h5>

                        <!--=====================================
                                        MONEDAS
                        ======================================-->

<<<<<<< HEAD
                        <table class="table table-striped table-bordered tablas">
=======
                        <table class="table table-striped table-bordered tablas mb-0 table table-borderless table-hover">
>>>>>>> 90cfe57fea136401cc7ad60f34fbe43057d7108d

                            <thead>
                            
                                <tr>
                                    
                                    <th style="width:10px">#</th>
                                    <th>Nombre</th>
                                    <th>Simbolo</th>
                                    <th>Compra</th>
                                    <th>Venta</th>
                                    <th>Acciones</th>

                                </tr> 

                            </thead> 
                            <tbody>

                                <?php

                                $item = null;
                                $valor = null;

                                $monedas = ControladorMonedas::ctrMostrarMonedas($item, $valor);

                                foreach ($monedas as $key => $value) {
                                    

                                    echo '<tr>

                                            <td>'.($key+1).'</td>

                                            <td>'.$value["nombre"].'</td>

                                            <td>'.$value["simbolo"].'</td>

                                            <td>'.$value["compra"].'</td>

                                            <td>'.$value["venta"].'</td>

<<<<<<< HEAD
                                            <td>

                                            <div class="btn-group">
                                                
                                                <button class="btnEditarMoneda mb-2 mr-2 border-0 btn-transition btn btn-outline-warning"  data-toggle="modal" data-target="#modalEditarMoneda" idMoneda="'.$value["id_moneda"].'"><i class="lnr-pencil btn-icon-wrapper">&nbsp;</i>Editar</button>';
                                                                
                                                if($_SESSION["perfil"] == "Administrador"){
                                                        
                                                    echo '<button class="btnEliminarMoneda mb-2 mr-2 border-0 btn-transition btn btn-outline-danger" idMoneda="'.$value["id_moneda"].'"><i class="lnr-cross btn-icon-wrapper">&nbsp;</i>Eliminar</button>';
                                                
                                                }

                                            echo '</div>  

                                            </td>
=======
                                            <td>                                                
                                                <span><button class="btn btn-secondary fa fa-edit btnEditarMoneda" idMoneda="'.$value["id_moneda"].'" data-toggle="modal" data-target="#modalEditarMoneda"></button></span>&nbsp;';
                                                                
                                                if($_SESSION["perfil"] == "Administrador"){

                                                    echo '<span><button class="btn btn-danger fa fa-times btnEliminarMoneda" idMoneda="'.$value["id_moneda"].'"></button></span>';
                                                
                                                }

                                       echo '</td>
>>>>>>> 90cfe57fea136401cc7ad60f34fbe43057d7108d

                                        </tr>';
                                
                                    }

                                ?>
                            
                            </tbody>

                        </table>
                        
                        <!--====  Fin de MONEDAS  ====-->
                 </div>
            </div>
        </div>
    </div>

</div>


<!--=====================================
MODAL AGREGAR MONEDA
======================================-->

<div class="modal fade" id="modalNuevoMoneda" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form role="form" method="post">

                <!--=====================================
                CABEZA DEL MODAL
<<<<<<< HEAD
                style="background:#495057; color:white"
                ======================================-->

                <div class="modal-header" style="background:#495057; color:white">
=======
                ======================================-->

                <div class="modal-header">
>>>>>>> 90cfe57fea136401cc7ad60f34fbe43057d7108d
                    <h5 class="modal-title" id="exampleModalLongTitle">Agregar moneda</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">

                    <!-- ENTRADA PARA EL NOMBRE -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Nombre" name="monedaNuevoNombre" type="text" class="form-control" required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA EL SIMBOLO -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Simbolo" name="monedaNuevoSimbolo" type="text" class="form-control" required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA LA COMPRA -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Compra" name="monedaNuevoCompra" type="text" class="form-control" required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA LA VENTA -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Venta" name="monedaNuevoVenta" type="text" class="form-control" required>
                    </div>
                    <br>

                </div>

                <!--=====================================
                PIE DEL MODAL
                ======================================-->

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar moneda</button>
                </div>
            
            </form>

            <?php

                $crearMoneda = new ControladorMonedas();
                $crearMoneda -> ctrCrearMoneda();

            ?>

        </div>
    </div>
</div>

<!--=====================================
MODAL EDITAR MONEDA
======================================-->

<div class="modal fade" id="modalEditarMoneda" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form role="form" method="post">

                <!--=====================================
                CABEZA DEL MODAL
<<<<<<< HEAD
                style="background:#495057; color:white"
                ======================================-->

                <div class="modal-header" style="background:#495057; color:white">
=======
                ======================================-->

                <div class="modal-header">
>>>>>>> 90cfe57fea136401cc7ad60f34fbe43057d7108d
                    <h5 class="modal-title" id="exampleModalLongTitle">Editar moneda</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">

                    <!-- ENTRADA ID MONEDA -->
                    <input type="hidden" id="idMoneda" name="idMoneda">

                    <!-- ENTRADA PARA EL NOMBRE -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Nombre" name="monedaEditarNombre" id="monedaEditarNombre" type="text" class="form-control" required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA EL SIMBOLO -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Simbolo" name="monedaEditarSimbolo" id="monedaEditarSimbolo" type="text" class="form-control" required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA LA COMPRA -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Compra" name="monedaEditarCompra" id="monedaEditarCompra" type="text" class="form-control" required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA LA VENTA -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Venta" name="monedaEditarVenta" id="monedaEditarVenta" type="text" class="form-control" required>
                    </div>
                    <br>


                </div>

                <!--=====================================
                PIE DEL MODAL
                ======================================-->

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Editar moneda</button>
                </div>
            
            </form>

            <?php

                $editarMoneda = new ControladorMonedas();
                $editarMoneda -> ctrEditarMoneda();

            ?>

        </div>
    </div>
</div>


<?php

  $eliminarMoneda = new ControladorMonedas();
  $eliminarMoneda -> ctrEliminarMoneda();

?>

