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
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Control Escolar CSEIIO');
$pdf->SetTitle('Lista de calificaciones');
$pdf->SetSubject('Lista de calificaciones CSEIIO');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(20, 5,19);
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

$titulo = '
<h6 style="text-align:center">COLEGIO SUPERIOR PARA LA EDUCACION INTEGRAL INTERCULTURAL DE OAXACA</h6>
<h6 style="text-align:center">DEPARTAMENTO DE CONTROL ESCOLAR</h6>
<p style="text-align:center;font-size:6pt">CONCENTRADO DE CALIFICACIONES MODULAR</p>
';

$datos_cabecera='
<div>
<table style="font-size:7pt">
<tbody>
<tr>
<td style="text-align:left">NOMBRE DEL PLANTEL:</td>
<td></td>
<td style="text-align:right">GRUPO:</td>
<td></td>
</tr>

<tr>
<td style="text-align:left">CLAVE C.T.:</td>
<td></td>
<td style="text-align:right">PERIODO:</td>
<td></td>
</tr>

<tr>
<td style="text-align:left">LOCALIDAD Y MUNICIPIO:</td>
<td></td>
<td style="text-align:right">CICLO ESCOLAR:</td>
<td></td>
</tr>

<tr>
<td style="text-align:left">UNIDAD DE CONTENIDO:</td>
<td></td>
<td></td>
<td></td>
</tr>

<tr>
<td style="text-align:left">CLAVE:</td>
<td></td>
<td></td>
<td></td>
</tr>


</tbody>
</table>
</div>
';

$encabezado_tabla_a='
<div>
<table border="1" style="font-size:6pt">
<tbody>
<tr>
<td style="width:20px;height:25px;background-color:#e9e9e9">NO.</td>
<td style="width:280px;height:25px;background-color:#e9e9e9">NOMBRE DEL ALUMNO</td>
<td style="width:35px;height:25px;background-color:#e9e9e9">MAR</td>
<td style="width:35px;height:25px;background-color:#e9e9e9">MAY</td>
<td style="width:35px;height:25px;background-color:#e9e9e9">JUN</td>
<td style="width:35px;height:25px;background-color:#e9e9e9">PROM. MOD.</td>
<td style="width:35px;height:25px;background-color:#e9e9e9">EXA. FINAL</td>
<td style="width:35px;height:25px;background-color:#e9e9e9">CAL. FINAL</td>
<td style="width:90px;height:25px;background-color:#e9e9e9">FECHA DE BAJA</td>
</tr>
</tbody>
</table>
<div>
';



$encabezado_tabla_b='
<div>
<table border="1" style="font-size:6pt">
<tbody>
<tr>
<td style="width:20px;height:25px;background-color:#e9e9e9">NO.</td>
<td style="width:280px;height:25px;background-color:#e9e9e9">NOMBRE DEL ALUMNO</td>
<td style="width:35px;height:25px;background-color:#e9e9e9">SEP</td>
<td style="width:35px;height:25px;background-color:#e9e9e9">NOV</td>
<td style="width:35px;height:25px;background-color:#e9e9e9">DIC</td>
<td style="width:35px;height:25px;background-color:#e9e9e9">PROM. MOD.</td>
<td style="width:35px;height:25px;background-color:#e9e9e9">EXA. FINAL</td>
<td style="width:35px;height:25px;background-color:#e9e9e9">CAL. FINAL</td>
<td style="width:90px;height:25px;background-color:#e9e9e9">FECHA DE BAJA</td>
</tr>
</tbody>
</table>
<div>
';

function rellenar_lista($estudiantes){
    $respuesta='';
    $contador=1;

    foreach($estudiantes as $estudiante){
        $respuesta.='
        <div>
        <table border="1" style="font-size:6pt">
        <tbody>
        <tr>
        <td style="width:20px:">'.$contador.'</td>
        <td style="width:280px;height:15px"></td>
        <td style="width:35px"></td>
        <td style="width:35px"></td>
        <td style="width:35px"></td>
        <td style="width:35px"></td>
        <td style="width:35px"></td>
        <td style="width:35px"></td>
        <td style="width:90px"></td>
        </tr>
        </tbody>
        </table>
        <div>
        ';
        $contador+=1;
    }

}

$datos_estudiantes='
<div>
<table border="1" style="font-size:6pt">
<tbody>
<tr>
<td style="width:20px:"></td>
<td style="width:280px;height:15px"></td>
<td style="width:35px"></td>
<td style="width:35px"></td>
<td style="width:35px"></td>
<td style="width:35px"></td>
<td style="width:35px"></td>
<td style="width:35px"></td>
<td style="width:90px"></td>
</tr>
</tbody>
</table>
<div>
';

$pdf->writeHTMLCell($w = 0, $h = 50, $x = '', $y = '5', $titulo, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);

$pdf->writeHTMLCell($w = 0, $h = 50, $x = '', $y = '19', $datos_cabecera, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);

$pdf->writeHTMLCell($w = 0, $h = 50, $x = '', $y = '37', $encabezado_tabla_a, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);

$pdf->writeHTMLCell($w = 0, $h = 50, $x = '', $y = '44', $datos_estudiantes, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);

// print a block of text using Write()
// output the HTML content
//$pdf->writeHTML($titulo.$datos_cabecera, true, 0, true, true);


//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>