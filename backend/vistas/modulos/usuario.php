<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Usuarios
                    <div class="page-title-subheading">This is an example dashboard created using build-in elements and components.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <button type="button" class="btn-shadow btn btn-info" data-toggle="modal" data-target="#modalNuevoUsuario">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="pe-7s-add-user pe-7s-w-20"></i>
                    </span>
                    Agregar Usuario
                </button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                   
                    <h5 class="card-title">Listado de Usuarios </h5>

                        <!--=====================================
                                        USUARIOS
                        ======================================-->

                        <table class="table table-striped table-bordered dt-responsive tablas">
                                    table table-hover table-striped table-bordered
                            <thead>
                            
                                <tr>

                                    <th style="width:10px">#</th>
                                    <th>Nombre</th>
                                    <th>Usuario</th>
                                    <th>Perfil</th>
                                    <th>telefono</th>
                                    <th>correo</th>
                                    <th>Ultimo login</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>

                                </tr> 

                            </thead> 
                            <tbody>

                                <?php

                                $item = null;
                                $valor = null;

                                $clientes = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

                                foreach ($clientes as $key => $value) {
                                    

                                    echo '<tr>

                                            <td>'.($key+1).'</td>

                                            <td>'.$value["nombres"].' '.$value["apellidos"].'</td>

                                            <td>'.$value["usuario"].'</td>

                                            <td>'.$value["perfil"].'</td>

                                            <td>'.$value["telefono"].'</td>

                                            <td>'.$value["correo"].'</td>

                                            <td>'.$value["ultimo_login"].'</td>

                                            <td>'.$value["estado"].'</td>

                                            <td>

                                            <div class="btn-group">
                                                
                                                <button class="btnEditarUsuario btn-square br-bl btn-transition btn btn-outline-warning "  data-toggle="modal" data-target="#modalEditarUsuario" idUsuario="'.$value["id_cliente"].'"><i class="lnr-pencil btn-icon-wrapper"></i></button>';
                                                                
                                                if($_SESSION["perfil"] == "Administrador"){
                                                        
                                                    echo '<button class="btnEliminarUsuario btn-square br-bl btn-transition btn btn-outline-danger" idUsuario="'.$value["id_cliente"].'"><i class="lnr-cross btn-icon-wrapper"></i></button>';
                                                
                                                }

                                            echo '</div>  

                                            </td>

                                        </tr>';
                                
                                    }

                                ?>
                            
                            </tbody>

                        </table>

                        <!--====  Fin de USUARIOS  ====-->                        

                 </div>
            </div>
        </div>
    </div>
</div>


<!--=====================================
MODAL AGREGAR USUARIO
======================================-->

<div class="modal fade" id="modalNuevoUsuario" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form role="form" method="post">

                <!--=====================================
                CABEZA DEL MODAL
                style="background:#495057; color:white"
                ======================================-->

                <div class="modal-header" style="background:#495057; color:white">
                    <h5 class="modal-title" id="exampleModalLongTitle">Agregar cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">

                    <!-- ENTRADA PARA LOS NOMBRES -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Nombres" name="clienteNuevoNombres" type="text" class="form-control" required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA LOS APELLIDOS -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Apellidos" name="clienteNuevoApellidos" type="text" class="form-control" required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA EL TIPO DOCUMENTO -->
                    <div class="input-group">               
                        <span class="input-group-text"><i class="lnr-menu"></i></span>
                        <select class="mb-2 form-control form-control" name="clienteNuevoTipoDocumento">                    
                            <option value="">Tpo documento</option>
                            <option value="DNI">DNI</option>
                            <option value="RUC">RUC</option>
                            <option value="PASAPORTE">PASAPORTE</option>
                            <option value="CARNET EXT.">CARNET EXT.</option>
                            <option value="OTROS">OTROS</option>                      
                        </select>
                    </div>
                    <br>

                    <!-- ENTRADA PARA EL NUMERO DE DOCUMENTO -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ion-android-apps"></i></span>
                        </div>
                        <input placeholder="Numero documento" name="clienteNuevoNumeroDocumento" type="text" class="form-control" required>
                    </div>
                    <br>               

                    <!-- ENTRADA PARA EL CORREO ELECTRONICO -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="">@</i></span>
                        </div>
                        <input placeholder="Correo electronico" name="clienteNuevoCorreo" type="email" class="form-control" required>
                    </div>
                    <br>       

                    <!-- ENTRADA PARA EL TELEFONO -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-phone-handset"></i></span>
                        </div>
                        <input placeholder="Telefono" name="clienteNuevoTelefono" type="text" class="form-control" required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-calendar-full"></i></span>
                        </div>                        
                        <input class="form-control input-mask-trigger" name="clienteNuevoFechaNacimiento" placeholder="Fecha de Nacimiento"data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" im-insert="false">
                    </div>
                    <br>


                </div>

                <!--=====================================
                PIE DEL MODAL
                ======================================-->

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar cliente</button>
                </div>
            
            </form>

            <?php

                $crearUsuario = new ControladorUsuarios();
                $crearUsuario -> ctrCrearUsuario();

            ?>

        </div>
    </div>
</div>

<!--=====================================
MODAL EDITAR USUARIO
======================================-->

<div class="modal fade" id="modalEditarUsuario" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form role="form" method="post">

                <!--=====================================
                CABEZA DEL MODAL
                style="background:#495057; color:white"
                ======================================-->

                <div class="modal-header" style="background:#495057; color:white">
                    <h5 class="modal-title" id="exampleModalLongTitle">Editar cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">

                    <!-- ENTRADA ID CLIENTE -->
                    <input type="hidden" id="idUsuario" name="idUsuario">

                    <!-- ENTRADA PARA LOS NOMBRES -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Nombres" name="clienteEditarNombres" id="clienteEditarNombres" type="text" class="form-control" required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA LOS APELLIDOS -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Apellidos" name="clienteEditarApellidos" id="clienteEditarApellidos" type="text" class="form-control" required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA EL TIPO DOCUMENTO -->
                    <div class="input-group">               
                        <span class="input-group-text"><i class="lnr-menu"></i></span>
                        <select class="mb-2 form-control form-control" name="clienteEditarTipoDocumento">
                            <option value="" id="clienteEditarTipoDocumento"></option>
                            <option value="DNI">DNI</option>
                            <option value="RUC">RUC</option>
                            <option value="PASAPORTE">PASAPORTE</option>
                            <option value="CARNET EXT.">CARNET EXT.</option>
                            <option value="OTROS">OTROS</option>                      
                        </select>
                    </div>
                    <br>

                    <!-- ENTRADA PARA EL NUMERO DE DOCUMENTO -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ion-android-apps"></i></span>
                        </div>
                        <input placeholder="Numero documento" name="clienteEditarNumeroDocumento" id="clienteEditarNumeroDocumento" type="text" class="form-control" required>
                    </div>
                    <br>               

                    <!-- ENTRADA PARA EL CORREO ELECTRONICO -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="">@</i></span>
                        </div>
                        <input placeholder="Correo electronico" name="clienteEditarCorreo" id="clienteEditarCorreo" type="email" class="form-control" required>
                    </div>
                    <br>       

                    <!-- ENTRADA PARA EL TELEFONO -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-phone-handset"></i></span>
                        </div>
                        <input placeholder="Telefono" name="clienteEditarTelefono" id="clienteEditarTelefono" type="text" class="form-control" required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-calendar-full"></i></span>
                        </div>                        
                        <input class="form-control input-mask-trigger" name="clienteEditarFechaNacimiento" id="clienteEditarFechaNacimiento" placeholder="Fecha de Nacimiento"data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" im-insert="false">
                    </div>
                    <br>


                </div>

                <!--=====================================
                PIE DEL MODAL
                ======================================-->

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Editar cliente</button>
                </div>
            
            </form>

            <?php

                $editarUsuario = new ControladorUsuarios();
                $editarUsuario -> ctrEditarUsuario();

            ?>

        </div>
    </div>
</div>


<?php

  $eliminarUsuario = new ControladorUsuarios();
  $eliminarUsuario -> ctrEliminarUsuario();

?>

