
<div class="app-container app-theme-white body-tabs-shadow">
    <div class="app-container">
        <div class="h-100">
            <div class="h-100 no-gutters row">
                <div class="d-none d-lg-block col-lg-4">
                    <div class="slider-light">
                        <div class="slick-slider">
                            <div>
                                <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-plum-plate" tabindex="-1">
                                    <div class="slide-img-bg" style="background-image: url('vistas/assets/images/originals/city.jpg');"></div>
                                    <div class="slider-content">
                                        <h3>Perfect Balance</h3>
                                        <p>ArchitectUI is like a dream. Some think it's too good to be true! Extensive collection of unified React Boostrap Components and Elements.</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-premium-dark" tabindex="-1">
                                    <div class="slide-img-bg" style="background-image: url('vistas/assets/images/originals/citynights.jpg');"></div>
                                    <div class="slider-content">
                                        <h3>Scalable, Modular, Consistent</h3>
                                        <p>Easily exclude the components you don't require. Lightweight, consistent Bootstrap based styles across all elements and components</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-sunny-morning" tabindex="-1">
                                    <div class="slide-img-bg" style="background-image: url('vistas/assets/images/originals/citydark.jpg');"></div>
                                    <div class="slider-content">
                                        <h3>Complex, but lightweight</h3>
                                        <p>We've included a lot of components that cover almost all use cases for any type of application.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="h-100 d-flex bg-white justify-content-center align-items-center col-md-12 col-lg-8">
                    <div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-9">
                        <div class="app-logo"></div>
                        <h4 class="mb-0">
                            <span class="d-block">Bienvenido de vuelta,</span>
                            <span>Inicia sesión en tu cuenta.</span></h4>
                            <!-- <h6 class="mt-3">No account? <a href="#" class="text-primary">Sign up now</a></h6> -->
                        <div class="divider row"></div>
                        <div>
                            <form method="post">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="ingUsuario" class="">Usuario</label><input name="ingUsuario" id="ingUsuario" placeholder="Email here..." type="text" class="form-control" value="kmpio"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="ingPassword" class="">Contraseña</label><input name="ingPassword" id="ingPassword" placeholder="Password here..." type="password" class="form-control" value="123456"></div>
                                    </div>
                                </div>
                                <div class="position-relative form-check"><input name="check" id="exampleCheck" type="checkbox" class="form-check-input"><label for="exampleCheck" class="form-check-label">Recordar contraseña </label></div>
                                <div class="divider row"></div>
                                <div class="d-flex align-items-center">
                                    <div class="ml-auto"><a href="#" class="btn-lg btn btn-link">Recuperar contraseña </a>
                                        <button type="submit" class="btn btn-primary btn-lg">Ingresar al Dashboard </button>
                                    </div>
                                </div>
                            </form>
                            <?php
                                    $login = new ControladorUsuarios();
                                    $login -> ctrIngresoUsuario();
                                ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>