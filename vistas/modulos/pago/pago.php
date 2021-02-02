<?php
	$codigoSeguimiento = $_GET["codseg"];
    $paquete = ControladorPaqueteFront::ctrObtenetPaqueteByCodigoSeguimiento($codigoSeguimiento);
    $pasajeros = $paquete["pasajeros"] + $paquete["ninos"];
?>


<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
                <h1 class="h2"><a href="principal" style="text-decoration: none">KM Viajes</a></h1>
            </div>
            <div class="col-md-5">
                <ul class="breadcrumb d-flex justify-content-end">
                    <li class="breadcrumb-item"><a href="principal">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">SOLICITUTD</a></li>
                    <li class="breadcrumb-item active"><?php echo $codigoSeguimiento; ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div id="content">
    <div class="container">
        <section class="no-mb bar">
            <div class="project owl-carousel">
                <?php
					
					$servicios = ControladorPaqueteFront::ctrListarFotosPorPaquete($paquete["id_paquete"]);

					foreach ($servicios as $key => $value) {
                        echo '<div class="item"><img src="backend/'.$value["ruta_imagen"].'" alt="" class="img-fluid"></div>';
                    }

				?>

            </div>

        </section>
        <section class="no-mb bar">

            <div class="row portfolio-project">
                <div class="col-md-8">

                    <!--pasajeros-->
                    <div class="heading">
                        <h4>Información de pasajeros</h4>
                        <p>Verifica que los datos ingresados sean correctos ya que una vez emitido el boleto emitido no
                            podrá ser cambiado.</p>
                    </div>
                    <div class="container">
                        <div class="row">
                            <!--pasajero-->
                            <?php 
                            for ($i = 0; $i <$pasajeros; $i++) {
                              echo  '<div class="col-md-12 card">
                                    <hr/>
                                    <h5>Pasajero #'.($i + 1).'</h5>
                                    <form>
                                        <div class="row">
                                            <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="firstname">Nombres</label>
                                                <input id="firstname'.$i.'" type="text" class="form-control">
                                            </div>
                                            </div>
                                            <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="lastname">Apellidos</label>
                                                <input id="lastname'.$i.'" type="text" class="form-control">
                                            </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="docnumberType">Tipo de documento</label>
                                                    <select class="form-control" id="docnumberType'.$i.'">
                                                        <option selected="selected" value="DNI">DNI</option>
                                                        <option value="CEX">Carné de extranjería</option>
                                                        <option value="PSP">Pasaporte</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="docNumber">Número documento</label>
                                                    <input id="docNumber'.$i.'" type="text" class="form-control">
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </form>
                                </div>';
                            }
                            
                            ?>
                            <!--pasajero-->

                        </div>
                    </div>
                    <!--fin form pasajeros-->
                    <!--fin pasajeros-->
                    <br />
                    <!--habitaciones-->
                    <div class="heading">
                        <h4>Selección de habitación</h4>
                        <p>Se muestran los tipos de habitaciones disponibles</p>
                    </div>
                    <div class="container">
                        <div class="row">
                            <!--habitacion-->
                            <div class="col-sm-12 card" id="habitacion-form">

                                <?php 
                                        $habitaciones = ControladorPaqueteFront::ctrListaHabitacionesByHotel($paquete["id_paquete"]);
                                        foreach ($habitaciones as $key => $value) {
                                            $selected = $value["flag_default"] == 1?"div-habitacion-pago-selected":"";
                                            $monto_adicional = $value["monto_adicional"] > 0?"+ $<span style='font-size:18px;'>".$value["monto_adicional"]."</span>":"<span style='font-size:16px;'>SIN COSTO</span>";
                                            $checked =  $value["flag_default"] == 1?"checked":"";
                                            echo ' <hr /><div class="row div-habitacion-pago '.$selected.'">
                                                    <div class="col-sm-5">
                                                        <div class="d-flex flex-wrap justify-content-between text-xs">
                                                            <p class="date-comments">
                                                                <span> <i class="fa fa-user"></i> '.$pasajeros.' persona(s) en la habitación</span>
                                                            </p>
                                                            <p class="date-comments">
                                                                <span> <i class="fa fa-bed"></i> '.$value["nombre"].'</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div>
                                                            <p class="author-category">
                                                                <span style="font-size:14px">Precio con esta habitación</span>
                                                            </p>
                                                            <p style="font-weight:800">
                                                                '.$monto_adicional.'
                                                            </p>
                                                            <input type="hidden" value="'.$value["monto_adicional"].'"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">

                                                        <div class="box-footer text-center">
                                                            <div class="tag-blue">

                                                            </div>
                                                            <input type="radio" id="habitacionRadio" name="habitacionRadio" value="'.$value["id_habitacion"].'" '.$checked.'/>

                                                        </div>
                                                    </div>
                                                 </div>';
                                        }
                                ?>




                                <!--habitacion-->

                            </div>
                        </div>
                    </div>

                    <!--fin habitacion-->
                    <br />
                    <div class="heading">
                        <h4>Selecciona el medio de pago</h4>
                        <p>Selecciona tu método de pago (el pago se llevará a cabo una vez presiones el botón pagar
                            al
                            final del formulario).</p>
                    </div>
                    <div class="container">

                        <div class="row">

                            <div class="col-sm-12 card" id="pagar-form">
                                <hr />
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="card_number"><b>Número de tarjeta</b></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" style="padding:0 5px;" id="type"><img
                                                            class="img_card"
                                                            src="https://img.icons8.com/android/48/000000/bank-card-back-side.png" /></span>
                                                </div>
                                                <input id="card_number" maxlength="16" type="text"
                                                    placeholder="Numero de tarjeta" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="expiry_month"><b>Mes expiración</b></label>
                                            <input id="expiry_month" type="text" maxlength="2" placeholder="MM"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="expiry_year"><b>Año expiración</b></label>
                                            <input id="expiry_year" type="text" maxlength="4" placeholder="AAAA"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="name_on_card"><b>Titular de tarjeta</b></label>
                                            <input id="name_on_card" type="text" class="form-control"
                                                placeholder="Nombre como figura en la tarjeta" require />
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="cvv"><b>CVV</b></label>
                                            <input id="cvv" type="password" maxlength="4" placeholder="000"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="cvv"><b>Cuotas</b></label>
                                            <select class="form-control" id="FormaPago_NroCuotas">

                                                <option selected="selected" value="1">Sin cuotas</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="txtCorreo"><b>Correo contacto</b></label>
                                            <input id="txtCorreo" type="email" class="form-control"
                                                value="<?php echo $paquete["correo"];?>" require />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">

                                        <div class="checkbox">
                                            <label><input id="needInvoice" type="checkbox"><b> Solicitar
                                                    Factura</b></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                    </div>

                                </div>
                                <div class="row" id="divInvoice">
                                    <div class="col-sm-6" id="ruc">
                                        <div class="form-group">
                                            <label for="txtCorreo"><b>RUC</b></label>
                                            <input id="txtRuc" type="text" class="form-control" require />
                                        </div>

                                    </div>
                                    <div class="col-sm-6" id="razon_social">
                                        <div class="form-group">
                                            <label for="txtCorreo"><b>Razón Social</b></label>
                                            <input id="txtRazon" type="text" class="form-control" require />
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!--btn Pagar-->
                        <div class="row">
                            <div class="col-sm-12">
                                <button onclick="realizarPago()" id="btn_pagar" class="btn btn-lg btn-primary"
                                    style="float: right;">Confirmar pago de $<span id="span-total">
                                        <?php echo number_format($pasajeros * $paquete["precio_dolar"],2);?></span></button>
                            </div>
                        </div>
                        <!--btn Pagar-->
                    </div>
                    <!--fin form pasajeros-->
                </div>


                <div class="col-md-4  project-more">
                    <div class="scroll card" style="padding: 10px">
                        <div class="heading">
                            <h3>Información del Paquete</h3>
                        </div>
                        <h3><?php echo $paquete["titulo"]; ?></h3>
                        <?php
							$compania = $paquete["compania"];
							echo '<h4>Aeorolinea</h4><span>'.$compania.'</span>' 
                        ?>
                        <hr />

                        <?php 
							$nombreHotel = $paquete["nombre_hotel"];
                            $nombreCiudad = $paquete["ciudad"];
                            echo '<h4>Viaje</h4> <span>'.$paquete["fecha_mostrar"].'</span>' ;
                            echo '<hr/><h4>Hotel</h4><span style="font-style: italic;font-size:13px;">'.$nombreHotel.' de '.$nombreCiudad.'</span>';

                            $stars = "";
                            for ($i = 1; $i <= $paquete["calificacion"]; $i++) {
                                $stars .= "<li class='star selected' title='Poor' data-value='1'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>";
                            }
                            echo "<div class='rating-stars'>
                                    <ul id='starsHotelView'>
                                        ".$stars."
                                    </ul>
                            </div>";
                            

                            //echo '<div id="idHotelServ3" class="my-rating-hotel" data-rating="'.$paquete["calificacion"].'"></div>';
                           
                        ?>
                        <div style="padding:5px;">
                            <?php 
                            $servicios = ControladorPaqueteFront::ctrListarServiciosPorPaquete($paquete["id_paquete"]);
                            
							foreach ($servicios as $key => $value) {
                                echo '<span style="float:left;font-size:13px;width:50%;margin-bottom:2px"><i class="'.$value["icono"].'" style="color:#da4d4d" aria-hidden="true"></i> '.$value["nombre"].'</span>';
                            }
                            ?>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Pasajeros</td>
                                        <th style="text-align:right;"><span id="pasajeros"><?php 
                                    
                                    echo $pasajeros;
                                    ?></span></th>
                                    </tr>

                                    <tr>
                                        <td>Precio Dolares x Unid.</td>
                                        <th style="text-align:right;">
                                            <?php echo '$ '.number_format($paquete["precio_dolar"],2);?></th>
                                    </tr>

                                    <tr id="tr-cambio-habitacion" style="display:none">
                                        <td>Cambio de Habitación</td>
                                        <th style="text-align:right;" id="th-cambio-habitacion"></th>
                                    </tr>
                                    <tr class="total">
                                        <td>Total</td>
                                        <th style="text-align:right;" id="th-amount-total">
                                            <?php echo '$ '.number_format($pasajeros * $paquete["precio_dolar"],2);?>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                            <input type="hidden" id="codigoSeguimiento" value="<?php echo $codigoSeguimiento ?>" />
                            <input type="hidden" id="amount"
                                value="<?php echo $pasajeros * $paquete["precio_dolar"]; ?>" />
                            <input type="hidden" id="description" value="<?php echo $paquete["titulo"]; ?>" />
                            <input type="hidden" id="phone" value="<?php echo $paquete["telefono"]; ?>" />
                            <input type="hidden" id="merchantPayerId" value="<?php echo $paquete["id_cliente"]; ?>" />
                            <input type="hidden" id="dniNumber" value="<?php echo $paquete["numero_documento"]; ?>" />
                            <input type="hidden" id="id_solicitud" value="<?php echo $paquete["id_solicitud"]; ?>" />
                        </div>
                        <!--table-responsive-->
                    </div>
                </div>
            </div>
        </section>
    </div>

</div>