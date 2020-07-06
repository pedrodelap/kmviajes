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
    <div class="row">

        <div class="col-lg-12 col-xl-6">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Perfil</h5>

                    <!--=====================================
                                    PERFIL       
                    ======================================-->
                    <div id="editarPerfil">
                        <h5>Hola <?php echo $_SESSION["usuario"]; ?>
                            <span class="btn btn-info fa fa-edit float-left" id="btnEditarPerfil" style="font-size:10px; margin-right:10px"></span>
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

                        <form id="formularioPerfil" style="padding:20px" method="post" enctype="multipart/form-data">

                            <input name="editarId" type="hidden" value="<?php echo $_SESSION["id_usuario"]; ?>">

                            <input name="actualizarSesion" type="hidden" value="ok">

                            <div class="form-group">

                                <input name="editarUsuario" type="text" class="form-control" value="<?php echo $_SESSION["usuario"]; ?>" required>

                            </div>

                            <div class="form-group">

                                <input name="editarNombre" type="text" class="form-control" value="<?php echo $_SESSION["nombres"]; ?>" required>

                            </div>

                            <div class="form-group">

                                <input name="editarPassword" type="password" placeholder="Ingrese la Contraseña hasta 10 caracteres" maxlength="10" class="form-control" required>

                            </div>

                            <div class="form-group">

                                <input name="editarEmail" type="email" value="<?php echo $_SESSION["correo"]; ?>" class="form-control" required>

                            </div>

                            <div class="form-group">

                                <select name="editarPerfil" class="form-control" required>
                                    <option value="" selected>Seleccione el Rol</option>
                                    <option value="Administrador">Administrador</option>
                                    <option value="Editor">Editor</option>
                                </select>

                            </div>

                            <div class="form-group text-center">

                                <img src="<?php echo $_SESSION["foto"]; ?>" width="10%" class="rounded-circle">

                                <input type="hidden" value="<?php echo $_SESSION["foto"]; ?>" name="editarFoto">

                                <input type="file" class="btn btn-default" id="cambiarFotoPerfil" style="display:inline-block; margin:10px 0">

                                <p class="text-center" style="font-size:12px">Tamaño recomendado de la imagen: 100px * 100px, peso máximo 2MB</p>

                            </div>

                            <input type="submit" id="guardarPerfil" value="Actualizar Perfil" class="btn btn-primary">

                        </form>

                        <?php

                        $crearPerfil2 = new ControladorPerfiles();
                        $crearPerfil2->editarUsuarioController();

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
                    }

                    ?>

                    <br />

                    <div class="table-responsive">
                        <table id="tablaSuscriptores" class="table table-striped display">
                            <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Perfil</th>
                                    <th>Email</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $verPerfiles = new ControladorPerfiles();
                                $verPerfiles->verPerfilesController();
                                $verPerfiles->borrarPerfilController();
                                ?>

                            </tbody>
                        </table>
                    </div>

                    <!--====  Fin de USUARIO  ====-->

                </div>
            </div>
        </div>

    </div>
</div>