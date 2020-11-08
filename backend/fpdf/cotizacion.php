


<?php 
define('FPDF_FONTPATH','font/'); 
require_once('fpdf.php');
require_once("../phpqrcode/qrlib.php");

$pdf = new FPDF();
$pdf->AddPage('P','A4');
//$pdf->AddPage('P',array(80,200));
$pdf->SetFont('Arial','',12);

$pdf->SetFont('Arial','B',12);

$pdf->Image("logo_empresa.jpg",40,2,25,25);

$pdf->Cell(100);
$pdf->Cell(80,6,"20232222322",'LRT',1,'C',0);

$pdf->Cell(100);
$pdf->Cell(80,6,"FACTURA ELECTRONICA",'LR',1,'C',0);

$pdf->Cell(100);
$pdf->Cell(80,6,"001 - 777",'BLR',0,'C',0);

$pdf->SetAutoPageBreak('auto',2);

$pdf->SetDisplayMode(75);

$pdf->Ln();

$pdf->SetFont('Arial','B',8);
$pdf->Cell(30,6,"RUC:",0,0,'L',0);
$pdf->SetFont('Arial','',8);
$pdf->Cell(30,6,"2030030303012",0,1,'L',0);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(30,6,"CLIENTE:",0,0,'L',0);
$pdf->SetFont('Arial','',8);
$pdf->Cell(30,6,"TAQINI TECHNOLOGY SAC",0,1,'L',0);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(30,6,"DIRECCION:",0,0,'L',0);
$pdf->SetFont('Arial','',8);
$pdf->Cell(30,6,"AV. BOLOGNESI 345 - CHICLAYO - CHICLAYO - LAMBAYEQUE",0,1,'L',0);

$pdf->Ln(3);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(10,6,"ITEM",1,0,'C',0);
$pdf->Cell(20,6,"CANTIDAD",1,0,'C',0);
$pdf->Cell(100,6,"PRODUCTO",1,0,'C',0);
$pdf->Cell(20,6,"V.U.",1,0,'C',0);
$pdf->Cell(25,6,"SUBTOTAL",1,1,'C',0);

$pdf->SetFont('Arial','',8);

for($i=1; $i<=10; $i++){
	$pdf->Cell(10,6,$i,1,0,'C',0);
	$pdf->Cell(20,6,$i+3,1,0,'C',0);
	$pdf->Cell(100,6,"DETALLE DEL PRODUCTO ".$i,1,0,'L',0);
	$pdf->Cell(20,6,$i.".00 ",1,0,'C',0);
	$pdf->Cell(25,6,$i."0.50 ",1,1,'C',0);
}

$pdf->Cell(150,6,"IMPORTE TOTAL",'T',0,'R',0);
$pdf->Cell(25,6,"100.00",1,1,'C',0);

$pdf->Cell(150,6,"OP. GRAVADAS",'',0,'R',0);
$pdf->Cell(25,6,"100.00",1,1,'C',0);
$pdf->Cell(150,6,"OP. INAFECTAS",'',0,'R',0);
$pdf->Cell(25,6,"100.00",1,1,'C',0);
$pdf->Cell(150,6,"OP. EXONERADAS",'',0,'R',0);
$pdf->Cell(25,6,"100.00",1,1,'C',0);
$pdf->Cell(150,6,"IGV",'',0,'R',0);
$pdf->Cell(25,6,"100.00",1,1,'C',0);


//codigo qr
		/*RUC | TIPO DE DOCUMENTO | SERIE | NUMERO | MTO TOTAL IGV | MTO TOTAL DEL COMPROBANTE | FECHA DE EMISION |TIPO DE DOCUMENTO ADQUIRENTE | NUMERO DE DOCUMENTO ADQUIRENTE |*/

$ruc = "20102020201";
$tipo_documento = "01"; //factura
$serie = "F001";
$correlativo = "234";
$igv = 18.00;
$total = 100.00;
$fecha = "2020-08-18";
$tipodoccliente = "6";
$nro_doc_cliente = "20343434343";

$nombrexml = "20102020201-01-F001-23323";

$text_qr = $ruc." | ".$tipo_documento." | ".$serie." | ".$correlativo." | ".$igv." | ".$total." | ".$fecha." | ".$tipodoccliente." | ".$nro_doc_cliente;
$ruta_qr = $nombrexml.'.png';

QRcode::png($text_qr, $ruta_qr, 'Q',15, 0);

$pdf->Image($ruta_qr, 80 , $pdf->GetY(),25,25);

$pdf->Ln(30);
$pdf->Cell(160,6,utf8_decode("Representación impresa de la Factura Electrónica"),0,0,'C',0);


$pdf->Output('I',$nombrexml.'.pdf');
//$pdf->Output('D',$nombrexml.'.pdf');
?>