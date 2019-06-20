<?php
//============================================================+
// File name   : example_003.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 003 for TCPDF class
//               Custom Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Custom Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

	//Page header
	public function Header() {
		
	
		
	}


	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		//$image_file =base_url().'plantilla/img/pie.png';
		//$this->Image($image_file, 150,275, 50, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		$this->Cell(0, 10, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}

// create new PDF document
$pdf = new MYPDF("L", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Control Escolar CSEIIO');
$pdf->SetTitle('PDF Carta Compromiso');
$pdf->SetSubject('Carta Compromiso CSEIIO');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(20, 7,19);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica','', 10);

// add a page
$pdf->AddPage();

// set some text to print
$titulo='<h4 style="text-align:center;width:100px">COLEGIO SUPERIOR PARA LA EDUCACION INTEGRAL INTERCULTURAL DE OAXACA</h4><h6 style="text-align:center">DEPARTAMENTO DE CONTROL ESCOLAR</h6>
<h4 style="background-color:gray">CONCENTRADO DE DATOS ESTADISTICOS</h4>';

$encabezado='
<div>
<table style="font-size:7pt" border="1">

<tbody>
<tr>
<td style="text-align:left;width:130px">NOMBRE DEL PLANTEL:</td>
<td style="text-align:left;width:480px">XXXXXXXXXX</td>
</tr>

<tr style="text-align:left">
<td>CLAVE CT:</td>
<td>XXXXXXXXXX</td>
</tr>

<tr style="text-align:left">
<td>LOCALIDAD Y MUNICIPIO:</td>
<td>XXXXXXXX</td>
</tr>

<tr style="text-align:left">
<td>CICLO ESCOLAR:</td>
<td>XXXXXXXXXXX</td>
</tr>
</tbody>

</table>
</div>
';

$total_grupos='
<div>
<table border="1" style="font-size:7pt">
<tbody>

<tr>
<td style="width:252px" colspan="4">TOTAL DE GRUPOS POR SEMESTRE</td>
</tr>


<tr>
<td style="width:63px;height:15px"  colspan="1"></td>
<td style="width:63px"  colspan="1"></td>
<td style="width:63px"  colspan="1"></td>
<td style="width:63px"  colspan="1">TOTAL</td>
</tr>


<tr>
<td style="width:63px;height:20px"  colspan="1"></td>
<td style="width:63px"  colspan="1"></td>
<td style="width:63px"  colspan="1"></td>
<td style="width:63px"  colspan="1"></td>
</tr>


</tbody>
</table>
</div>
';

//----------------------------------


$matricula_final_modulo_anterior='
<div>
<table border="1">
<tbody>

<tr>
<td style="width:130px" rowspan="3"></td>
<td style="width:159px" colspan="3"></td>
<td style="width:159px" colspan="3"></td>
<td style="width:159px" colspan="3"></td>
</tr>

<tr>
<td style="width:53px"></td>
<td style="width:53px"></td>
<td style="width:53px"></td>
<td style="width:53px"></td>
<td style="width:53px"></td>
<td style="width:53px"></td>
<td style="width:53px"></td>
<td style="width:53px"></td>
<td style="width:53px"></td>
</tr>


<tr>
<td style="width:53px"></td>
<td style="width:53px"></td>
<td style="width:53px"></td>
<td style="width:53px"></td>
<td style="width:53px"></td>
<td style="width:53px"></td>
<td style="width:53px"></td>
<td style="width:53px"></td>
<td style="width:53px"></td>
</tr>


</tbody>
</table>
</div>
';

$total_grupos_abajo='
<div>
<table border="1">
<tbody>

<tr>
<td style="width:63px;height:30px"></td>
<td style="width:63px"></td>
<td style="width:63px"></td>
<td style="width:63px"></td>
</tr>

<tr>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>

</tbody>
</table>
</div>
';




$modulo ='
<div>
<table border="1">
<tbody>

<tr>
<td style="width:130px"></td>
<td style="width:53px"></td>
<td style="width:53px"></td>
<td style="width:53px"></td>
<td style="width:53px"></td>
<td style="width:53px"></td>
<td style="width:53px"></td>
<td style="width:53px"></td>
<td style="width:53px"></td>
<td style="width:53px"></td>
</tr>

<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>

<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>

<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>

<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>

<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>

<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>

<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>

<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>

<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>

<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>

<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>

<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>

<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>

<tbody>
</table>
</div>
';


$pdf->writeHTMLCell($w = 0, $h = 50, $x = '21', $y = '', $titulo, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);

$pdf->writeHTMLCell($w = 0, $h = 50, $x = '21', $y = '30', $encabezado, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);

$pdf->writeHTMLCell($w = 0, $h = 50, $x = '196', $y = '30', $total_grupos, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);

//$pdf->writeHTMLCell($w = 0, $h = 50, $x = '21', $y = '35', $matricula_final_modulo_anterior, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);

//$pdf->writeHTMLCell($w = 0, $h = 50, $x = '196', $y = '35', $total_grupos_abajo, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);

//$pdf->writeHTMLCell($w = 0, $h = 50, $x = '21', $y = '50', $modulo, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);

// print a block of text using Write()
// output the HTML content
//$pdf->writeHTML($titulo.$encabezado.$total_grupos, true, 0, true, true);


//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>