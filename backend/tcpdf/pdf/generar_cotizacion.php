<?php

require_once "../../controladores/controlador.suscriptores.php";
require_once "../../modelos/modelo.suscriptores.php";

class GenerarCotizacion{

public static function imprimirCotizacion(){

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->AddPage();
$html1 = <<<EOF
	
	<table>
    

        <tr>
            <td colspan="3" style=" line-height: 20px; border: 0.5px solid black;font-size:14px;text-align: center;vertical-align: middle;">
                    COTIZACIÓN #HAS12312SAS 
            </td>
        </tr>
        <tr>
            <td colspan="3"> </td>
        </tr>
		<tr>
			<td width="200px"></td>
			<td style="width:140px"><img src="images/logotipo.jpg"></td>
			<td width="200px"></td>
        </tr>
        
    </table>

    <table style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:10px">
        <tr>
            <td width="200px" style="text-align:left">
                <table style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:10px">
                    <tr>
                        <td><b>KM VIAJES Y AVENTURA</b></td>
                    </tr>
                    <tr>
                        <td>RUC 20602008283</td>
                    </tr>
                    <tr>
                        <td>Agencia de Viajes</td>  
                    </tr>
                </table>
            </td>
            <td width="340px" style="text-align:right">
                <table style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:10px">
                    <tr>
                        <td>Fecha emitida: <b>2020-12-12</b></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table>

        <tr>
			<td style="width:540px:height:30px;text-align: center;vertical-align: middle;"></td>
        </tr>
		<tr>
			<td style="width:540px:height:30px;text-align: center;vertical-align: middle;"><hr/></td>
        </tr>
    </table>

    <table style="border: 1px solid #333; text-align:center; line-height: 20px; font-size:10px">
        <tr>
            <td colspan="3">PROPUESTA #1</td>
        </tr>
		<tr>
			<td width="380px" style="border: 1px solid #666; background-color:#333; color:#fff">Descripción</td>
			<td width="80px" style="border: 1px solid #666; background-color:#333; color:#fff">Cantidad</td>
			<td width="80px" style="border: 1px solid #666; background-color:#333; color:#fff">Precio</td>
		</tr>
	</table>

EOF;

$pdf->writeHTML($html1, false, false, false, false, ''); 



$html2 = <<<EOF

    <table style="border: 0.5px solid #333; text-align:center; line-height: 20px; font-size:10px">
		<tr>
            <td  width="380px"  style="border: 1px solid #666;">Paquete Turistico Cancún
            <br /> Hotel 5 estrellas
            <br /> Desayuno incluido
            <br /> Tarjeta asistencia
            <br /> Traslados
            </td>
			<td width="80px" style="border: 1px solid #666;vertical-align: middle;">2</td>
			<td width="80px" style="border: 1px solid #666;vertical-align: middle;">$ 1,000.00</td>
		</tr>
	</table>
	<table style="border: 0.5px solid #333; text-align:right;vertical-align: middle;line-height: 20px; font-size:10px">
		<tr>
            <td>TOTAL Dolares</td>
            <td>USD 2,000.00</td>
        </tr>
        <tr>
            <td>TOTAL Soles</td>
            <td>S/. 7,000.00</td>
		</tr>
	</table>

EOF;

$pdf->writeHTML($html2, false, false, false, false, '');  	



//$pdf->Output('suscriptores.pdf');
$pdf->Output(__DIR__ . '/cotizacion.pdf', 'F');
$pdf->Output('cotizacion.pdf');
//$pdf_string = $pdf->Output('pseudo.pdf', 'S');
//file_put_contents('./mydir/myfile.pdf', $pdf_string);

}

}

$a = new GenerarCotizacion();
$a -> imprimirCotizacion();

?>