<?php

require_once "../../controladores/controlador.suscriptores.php";
require_once "../../modelos/modelo.suscriptores.php";

class ImpresionSuscriptores{

public static function imprimirSuscriptores(){

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->AddPage();

$html1 = <<<EOF
	
	<table>
		<tr>
			<td style="width:540px"><img src="images/back.jpg"></td>
		</tr>

		<tr>
			<td width="200px"></td>
			<td style="width:140px"><img src="images/logotipo.jpg"></td>
			<td width="200px"></td>
		</tr>
	</table>

	<table style="border: 1px solid #333; text-align:center; line-height: 20px; font-size:10px">
		<tr>
			<td style="border: 1px solid #666; background-color:#333; color:#fff">Nombre</td>
			<td style="border: 1px solid #666; background-color:#333; color:#fff">Email</td>
			<td style="border: 1px solid #666; background-color:#333; color:#fff">Telefono</td>
		</tr>
	</table>

EOF;

$pdf->writeHTML($html1, false, false, false, false, ''); 

$respuesta = ControladorSuscriptores::ctrImpresionSuscriptores("tb_suscriptores");

foreach ($respuesta as $row => $item) {

$html2 = <<<EOF

	<table style="border: 1px solid #333; text-align:center; line-height: 20px; font-size:10px">
		<tr>
			<td style="border: 1px solid #666;">$item[v_nombre]</td>
			<td style="border: 1px solid #666;">$item[v_email]</td>
			<td style="border: 1px solid #666;">$item[v_telefono]</td>
		</tr>
	</table>

EOF;

$pdf->writeHTML($html2, false, false, false, false, ''); 	

}

$pdf->Output('suscriptores.pdf');

}

}

$a = new ImpresionSuscriptores();
$a -> imprimirSuscriptores();

?>