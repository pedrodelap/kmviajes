<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Perfil
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

        <div class="col-lg-12 col-xl-6">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Perfil</h5>

                    <!--=====================================
                                    PERFIL       
                    ======================================-->
                    <div id="editarPerfil">
                        <h5>Hola <?php echo $_SESSION["usuario"]; ?>
<<<<<<< HEAD
                            <span class="btn btn-info fa fa-edit float-left" id="btnEditarPerfil" style="font-size:10px; margin-right:10px"></span>
=======
                            <span class="btn btn-primary fa fa-edit float-left" id="btnEditarPerfil" style="font-size:10px; margin-right:10px"></span>
>>>>>>> 90cfe57fea136401cc7ad60f34fbe43057d7108d
                        </h5>
                        <div style="position:relative">
                            <img width="42px" src="<?php echo $_SESSION["foto"]; ?> " class="rounded-circle float-right">
                        </div>
                        <hr>
                        <h6>Perfil: <?php
                                    if ($_SESSION["perfil"] == 'Administrador') {

                                        echo "Administrador";
                                    } else {

                                        echo "Editor";
                                    } ?>
                        </h6>

                        <h6>Email: <?php echo $_SESSION["correo"]; ?></h6>
                        <h6>Contraseña: *******</h6>
                    </div>
                    <div id="formEditarPerfil" style="display:none">

<<<<<<< HEAD
                        <form id="formularioPerfil" style="padding:20px" method="post" enctype="multipart/form-data">

                            <input name="editarId" type="hidden" value="<?php echo $_SESSION["id_usuario"]; ?>">
=======
                        <form id="formularioPerfil" style="padding:20px" method="post" enctype="multipart/form-data" role="form">

                            <input name="editarId" id="editarId" type="hidden" value="<?php echo $_SESSION["id_usuario"]; ?>">
>>>>>>> 90cfe57fea136401cc7ad60f34fbe43057d7108d

                            <input name="actualizarSesion" type="hidden" value="ok">

                            <div class="form-group">

<<<<<<< HEAD
                                <input name="editarUsuario" type="text" class="form-control" value="<?php echo $_SESSION["usuario"]; ?>" required>
=======
                                <input type="text" name="editarUsuario" id="editarUsuario" placeholder="Editar Usuario" class="form-control" required>
>>>>>>> 90cfe57fea136401cc7ad60f34fbe43057d7108d

                            </div>

                            <div class="form-group">

<<<<<<< HEAD
                                <input name="editarNombre" type="text" class="form-control" value="<?php echo $_SESSION["nombres"]; ?>" required>
=======
                                <input type="text" name="editarNombre" id="editarNombre" placeholder="Editar Nombres" class="form-control" required>
>>>>>>> 90cfe57fea136401cc7ad60f34fbe43057d7108d

                            </div>

                            <div class="form-group">

<<<<<<< HEAD
                                <input name="editarPassword" type="password" placeholder="Ingrese la Contraseña hasta 10 caracteres" maxlength="10" class="form-control" required>
=======
                                <input type="text" name="editarApellido" id="editarApellido" placeholder="Editar Apellidos" class="form-control" required>
>>>>>>> 90cfe57fea136401cc7ad60f34fbe43057d7108d

                            </div>

                            <div class="form-group">
<<<<<<< HEAD

                                <input name="editarEmail" type="email" value="<?php echo $_SESSION["correo"]; ?>" class="form-control" required>
=======
                                <select class="form-control" name="editarTipoDocumentoCbx">
                                    <option id="editarTipoDocumentoCbx"></option>
                                    <option value="DNI">DNI</option>
                                    <option value="PASAPORTE">PASAPORTE</option>
                                    <option value="CARNET EXT.">CARNET EXT.</option>
                                    <option value="OTROS">OTROS</option>
                                </select>                    
                            </div>

                            <div class="form-group">

                                <input type="text" name="editarNumeroDocumento" id="editarNumeroDocumento" placeholder="Editar numero documento" class="form-control" required>

                            </div>

                            <div class="form-group">

                                <input type="text" name="editarTelefono" id="editarTelefono" placeholder="Editar Telefono" class="form-control" required>

                            </div>

                            <div class="form-group">

                                <input type="email" name="editarEmail" id="editarEmail"  placeholder="Editar Correo"  class="form-control" required>

                            </div>

                            <div class="form-group">
                                <label for="editarPassword">Contraseña Actual</label>
                                <input type="password" name="editarPassword" id="editarPassword" placeholder="Ingrese la Contraseña hasta 10 caracteres" maxlength="10" class="form-control" value="">
>>>>>>> 90cfe57fea136401cc7ad60f34fbe43057d7108d

                            </div>

                            <div class="form-group">
<<<<<<< HEAD

                                <select name="editarPerfil" class="form-control" required>
                                    <option value="" selected>Seleccione el Rol</option>
                                    <option value="Administrador">Administrador</option>
                                    <option value="Editor">Editor</option>
                                </select>

=======
                                <label for="editarPasswordNuevo">Cambiar Contraseña</label>
                                <input type="password" name="editarPasswordNuevo" id="editarPasswordNuevo" placeholder="Ingrese la Contraseña hasta 10 caracteres" maxlength="10" class="form-control">

                            </div>


                            <div class="form-group">
                                <select class="form-control" name="editarPerfilCbx">
                                    <option id="editarPerfilCbx"></option>
                                    <option value="Administrador">Administrador</option>
                                    <option value="Editor">Editor</option>
                                </select>                    
>>>>>>> 90cfe57fea136401cc7ad60f34fbe43057d7108d
                            </div>

                            <div class="form-group text-center">

<<<<<<< HEAD
                                <img src="<?php echo $_SESSION["foto"]; ?>" width="10%" class="rounded-circle">

                                <input type="hidden" value="<?php echo $_SESSION["foto"]; ?>" name="editarFoto">

                                <input type="file" class="btn btn-default" id="cambiarFotoPerfil" style="display:inline-block; margin:10px 0">
=======
                                <img src="vistas/images/usuarios/admin.jpg" width="10%" class="rounded-circle previsualizar">

                                <input type="hidden" name="fotoActual" id="fotoActual">

                                <input type="file" class="btn btn-default" name="editarFoto" style="display:inline-block; margin:10px 0">
>>>>>>> 90cfe57fea136401cc7ad60f34fbe43057d7108d

                                <p class="text-center" style="font-size:12px">Tamaño recomendado de la imagen: 100px * 100px, peso máximo 2MB</p>

                            </div>

                            <input type="submit" id="guardarPerfil" value="Actualizar Perfil" class="btn btn-primary">

<<<<<<< HEAD
=======
                            <input type="button" id="btnEditarPerfilCancelar" value="Cancelar" class="btn">

>>>>>>> 90cfe57fea136401cc7ad60f34fbe43057d7108d
                        </form>

                        <?php

<<<<<<< HEAD
                        $crearPerfil2 = new ControladorPerfiles();
                        $crearPerfil2->editarUsuarioController();
=======
                            $editarUsuario = new ControladorUsuarios();
                            $editarUsuario->ctrEditarUsuario();
>>>>>>> 90cfe57fea136401cc7ad60f34fbe43057d7108d

                        ?>

                    </div>

                    <!--====  Fin de PERFIL  ====-->
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-xl-6">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Usuarios </h5>

                    <!--=====================================
                                    USUARIO       
                    ======================================-->

                    <?php

                    if ($_SESSION["perfil"] == 'Administrador') {

<<<<<<< HEAD
                        echo '<div id="crearPerfil">

                                <button id="registrarPerfil" style="margin-bottom:20px" class="btn-shadow btn btn-info">Registrar un nuevo miembro</button>

                                <form id="formularioPerfil" style="display:none" method="post" enctype="multipart/form-data">
    
                                    <div class="form-group">
            
                                        <input name="nuevoUsuario" type="text" placeholder="Ingrese el Usuario hasta 10 caracteres" maxlength="10" class="form-control"  required>

                                    </div>

                                    <div class="form-group">
            
                                        <input name="nuevoNombre" type="text" placeholder="Ingrese el Nombre hasta 10 caracteres" maxlength="10" class="form-control"  required>

                                    </div>                                                    

                                    <div class="form-group">

                                        <input name="nuevoPassword" type="password" placeholder="Ingrese la Contraseña hasta 10 caracteres" maxlength="10" class="form-control" required>

                                    </div>

                                    <div class="form-group">

                                        <input name="nuevoEmail" type="email" placeholder="Ingrese el Correo Electrónico" class="form-control" required>

                                    </div>

                                    <div class="form-group">

                                        <select name="nuevoPerfil" id="nuevoPerfil" class="form-control" required>
                                            <option value="" selected>Seleccione el Rol</option>
                                            <option value="Administrador">Administrador</option>
                                            <option value="Editor">Editor</option>

                                        </select>

                                    </div>

                                    <div class="form-group text-center">
                                        
                                        <input type="file" class="btn btn-default" id="subirFotoPerfil" style="display:inline-block; margin:10px 0">

                                        <p class="text-center" style="font-size:12px">Tamaño recomendado de la imagen: 100px * 100px, peso máximo 2MB</p>

                                    </div>

                                    <input type="submit" id="guardarPerfil" value="Guardar Perfil" class="btn btn-primary">

                                </form>
                                
                            </div>';

                        $crearPerfil = new ControladorPerfiles();
                        $crearPerfil->nuevoUsuarioController();
=======
                        echo '<div>

                                <br />
                                
                                <button type="button" class="btn-shadow btn btn-primary" data-toggle="modal" data-target="#modalNuevoUsuario">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i class="pe-7s-add-user pe-7s-w-20"></i>
                                    </span>
                                    Agregar Usuario
                                </button>

                                <br /><br />

                            </div>';

                        $crearPerfil = new ControladorUsuarios();
                        $crearPerfil->ctrCrearUsuario();
>>>>>>> 90cfe57fea136401cc7ad60f34fbe43057d7108d
                    }

                    ?>

<<<<<<< HEAD
                    <br />
=======
                    
>>>>>>> 90cfe57fea136401cc7ad60f34fbe43057d7108d

                    <div class="table-responsive">
                        <table id="tablaSuscriptores" class="table table-striped display">
                            <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Perfil</th>
                                    <th>Email</th>
<<<<<<< HEAD
                                    <th></th>
=======
                                    <th>Acciones</th>
>>>>>>> 90cfe57fea136401cc7ad60f34fbe43057d7108d
                                </tr>
                            </thead>
                            <tbody>

<<<<<<< HEAD
                                <?php
                                $verPerfiles = new ControladorPerfiles();
                                $verPerfiles->verPerfilesController();
                                $verPerfiles->borrarPerfilController();
                                ?>
=======
                            <?php

                                $item = null;
                                $valor = null;

                                $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

                                foreach ($respuesta as $row => $value) {


                                    echo   '<tr>
                                                <td>'.$value["id_usuario"].'</td>
                                                <td>'.$value["perfil"].'</td>
                                                <td>'.$value["correo"].'</td>
                                                <td>
                                                    <span class="btnEditarUsuario btn btn-secondary fa fa-edit" idUsuario="'.$value["id_usuario"].'"></span>
                                                    <a href="index.php?ruta=perfil&idBorrarUsuario='.$value["id_usuario"].'&borrarImg='.$value["foto"].'"><span class="btn btn-danger fa fa-times"></span></a>
                                                </td>
                                            </tr>';
                                }

                            ?>
>>>>>>> 90cfe57fea136401cc7ad60f34fbe43057d7108d

                            </tbody>
                        </table>
                    </div>

                    <!--====  Fin de USUARIO  ====-->

                </div>
            </div>
        </div>

    </div>
<<<<<<< HEAD
</div>
=======
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
>>>>>>> 90cfe57fea136401cc7ad60f34fbe43057d7108d
