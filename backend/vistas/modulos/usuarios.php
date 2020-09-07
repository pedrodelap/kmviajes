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
                <button type="button" class="btn-shadow btn btn-primary" data-toggle="modal" data-target="#modalNuevoUsuario">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="pe-7s-add-user pe-7s-w-20"></i>
                    </span>
                    Agregar Usuario
                </button>
            </div>
        </div>
    </div>
    <div class="row animated fadeIn">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                   
                    <h5 class="card-title">Listado de Usuarios </h5>

                        <!--=====================================
                                        USUARIOS
                        ======================================-->

                        <table class="table table-striped table-bordered tablas mb-0 table table-borderless table-hover">
                                    
                            <thead>
                            
                                <tr>

                                    <th style="width:10px">#</th>
                                    <th>Usuario</th>
                                    <th>Nombre</th>
                                    <th>Perfil</th>
                                    <th>telefono</th>
                                    <th>correo</th>
                                    <th>Ultimo login</th>                                    
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
                            
                                            <td>'.$value["usuario"].'</td>                                            

                                            <td>'.$value["nombres"].' '.$value["apellidos"].'</td>

                                            <td>'.$value["perfil"].'</td>

                                            <td>'.$value["telefono"].'</td>

                                            <td>'.$value["correo"].'</td>

                                            <td>'.$value["ultimo_login"].'</td>

                                            <td>

                                                <span><button class="btn btn-secondary fa fa-edit btnEditarUsuario" idUsuario="'.$value["id_usuario"].'"></button></span>&nbsp;';
                                                                
                                                if($_SESSION["perfil"] == "Administrador"){
                                                        
                                                    echo '<span><button class="btn btn-danger fa fa-times btnEliminarUsuario" idUsuario="'.$value["id_usuario"].'"></button></span>';
                                                                                                    
                                                }

                                            echo '</td>

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
                ======================================-->

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Agregar usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">

                    <!-- ENTRADA PARA EL USUARIO -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Usuario" name="usuarioNuevo" id="usuarioNuevo" type="text" class="form-control" required>
                    </div>
                    <br>                

                    <!-- ENTRADA PARA LOS NOMBRES -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Nombres" name="usuarioNuevoNombres" id="usuarioNuevoNombres" type="text" class="form-control" required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA LOS APELLIDOS -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Apellidos" name="usuarioNuevoApellidos" id="usuarioNuevoApellidos" type="text" class="form-control" required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA EL TIPO DOCUMENTO -->
                    <div class="input-group">               
                        <span class="input-group-text"><i class="lnr-menu"></i></span>
                        <select class="form-control" name="usuarioNuevoTipoDocumento" id="usuarioNuevoTipoDocumento">                    
                            <option value="">Tipo documento</option>
                            <option value="DNI">DNI</option>
                            <option value="PASAPORTE">PASAPORTE</option>
                            <option value="CARNET EXT.">CARNET EXT.</option>
                            <option value="OTROS">OTROS</option>                      
                        </select>
                    </div>
                    <br>                    

                    <!-- ENTRADA PARA EL NUMERO DE DOCUMENTO -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-file-empty"></i></span>
                        </div>
                        <input placeholder="Numero documento" name="usuarioNuevoNumeroDocumento" id="usuarioNuevoNumeroDocumento" type="text" class="form-control" required>
                    </div>
                    <br>               

                    <!-- ENTRADA PARA EL TELEFONO -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-phone-handset"></i></span>
                        </div>
                        <input placeholder="Telefono" name="usuarioNuevoTelefono" id="usuarioNuevoTelefono" type="text" class="form-control" required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA EL CORREO ELECTRONICO -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="">@</i></span>
                        </div>
                        <input placeholder="Correo electronico" name="usuarioNuevoCorreo" id="usuarioNuevoCorreo" type="email" class="form-control" required>
                    </div>
                    <br>

                </div>

                <!--=====================================
                PIE DEL MODAL
                ======================================-->

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar usuario</button>
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
                ======================================-->

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Editar usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">

                    <!-- ENTRADA ID USUARIO -->
                    <input type="hidden" id="idUsuarioEditar" name="idUsuarioEditar">

                    <!-- ENTRADA PARA EL USUARIO -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Usuario" name="usuarioEditar" id="usuarioEditar" type="text" class="form-control" required>
                    </div>
                    <br>                

                    <!-- ENTRADA PARA LOS NOMBRES -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Nombres" name="usuarioEditarNombres" id="usuarioEditarNombres" type="text" class="form-control" required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA LOS APELLIDOS -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-user"></i></span>
                        </div>
                        <input placeholder="Apellidos" name="usuarioEditarApellidos" id="usuarioEditarApellidos" type="text" class="form-control" required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA EL TIPO DOCUMENTO -->
                    <div class="input-group">               
                        <span class="input-group-text"><i class="lnr-menu"></i></span>
                        <select class="form-control" name="usuarioEditarTipoDocumento">
                            <option value="" id="usuarioEditarTipoDocumento"></option>
                            <option value="DNI">DNI</option>
                            <option value="PASAPORTE">PASAPORTE</option>
                            <option value="CARNET EXT.">CARNET EXT.</option>
                            <option value="OTROS">OTROS</option>                      
                        </select>
                    </div>
                    <br>                    

                    <!-- ENTRADA PARA EL NUMERO DE DOCUMENTO -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-file-empty"></i></span>
                        </div>
                        <input placeholder="Numero documento" name="usuarioEditarNumeroDocumento" id="usuarioEditarNumeroDocumento" type="text" class="form-control" required>
                    </div>
                    <br>               

                    <!-- ENTRADA PARA EL TELEFONO -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="lnr-phone-handset"></i></span>
                        </div>
                        <input placeholder="Telefono" name="usuarioEditarTelefono" id="usuarioEditarTelefono" type="text" class="form-control" required>
                    </div>
                    <br>

                    <!-- ENTRADA PARA EL CORREO ELECTRONICO -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="">@</i></span>
                        </div>
                        <input placeholder="Correo electronico" name="usuarioEditarCorreo" id="usuarioEditarCorreo" type="email" class="form-control" required>
                    </div>
                    <br>                

                </div>

                <!--=====================================
                PIE DEL MODAL
                ======================================-->

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Editar usuario</button>
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
  $eliminarUsuario -> ctrBorrarUsuario();

?>

