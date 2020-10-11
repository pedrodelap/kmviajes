<div class="app-header-right">
            <div class="header-dots">

            <?php

                if($_SESSION["perfil"] == 'Administrador'){

            ?>

                    <ul class="header-megamenu nav">
                    <?php

                        $revisarMensajes = new ControladorSolicitudes();
                        $revisarMensajes -> ctrSolicitudesSinRevisar();

                    ?>
                    <?php

                        $revisarMensajes = new ControladorMensajes();
                        $revisarMensajes -> ctrMensajesSinRevisar();

                    ?>
                        <li class="btn-group nav-item "><i class=""></i>
                            <a href="suscriptores" class="p-1 mr-0 btn btn-link">
                                <span class="icon-wrapper icon-wrapper-alt rounded-circle">
                                    <span class="icon-wrapper-bg bg-primary"></span>
                                        <i class="text-primary fas fa-users"></i>
                                        <span class="badge badge-dot badge-dot-sm badge-primary"></span>
                                </span>
                            </a>
                        </li>
                    </ul>

            <?php

                }

            ?>

            </div>

            <div class="header-btn-lg pr-0">
                <div class="widget-content p-0">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="btn-group">
                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                    <img width="42" class="rounded-circle" src="<?php echo $_SESSION["foto"];?>" alt="">
                                    <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                </a>
                                <div tabindex="-1" role="menu" aria-hidden="true" class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-menu-header">
                                        <div class="dropdown-menu-header-inner bg-info">
                                            <div class="menu-header-image opacity-2" style="background-image: url('vistas/assets/images/dropdown-header/city3.jpg');"></div>
                                            <div class="menu-header-content text-left">
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left mr-3">
                                                            <img width="42" class="rounded-circle" src="<?php echo $_SESSION["foto"];?>" alt="">
                                                        </div>
                                                        <div class="widget-content-left">
                                                            <div class="widget-heading"><?php echo $_SESSION["nombres"].' '.$_SESSION["apellidos"];?>
                                                            </div>
                                                            <div class="widget-subheading opacity-10"><?php echo $_SESSION["perfil"];?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="scroll-area-xs" style="height: 150px;">
                                        <div class="scrollbar-container ps">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                <?php
                                                    if($_SESSION["perfil"] == 'Administrador'){

                                                        $cantidadMensajes = new ControladorMensajes();
                                                        $cantidadMensajes -> ctrCantidadMensajesSinRevisar();
                                                    }
                                                    if($_SESSION["perfil"] == 'Administrador'){

                                                        $cantidadSolicitudes = new ControladorSolicitudes();
                                                        $cantidadSolicitudes -> ctrCantidadSolicitudesSinRevisar();
                                                    }
                                                ?>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="perfil" class="nav-link">Editar Perfil 
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="perfil" class="nav-link">Términos y Condiciones
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="salir" class="nav-link">Salir
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="widget-content-left  ml-3 header-user-info">
                            <div class="widget-heading">
                            <?php echo $_SESSION["nombres"].' '.$_SESSION["apellidos"];?>
                            </div>
                            <div class="widget-subheading">
                            <?php echo $_SESSION["perfil"];?>
                            </div>
                        </div>
   
                    </div>
                </div>
            </div>

        </div>