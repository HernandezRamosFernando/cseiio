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
/*		
		// Logo
		//$image_file =base_url().'assets/img/cabecera.png';
		$this->Image($image_file, 110, 10, 90, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

		//$image_file =base_url().'assets/img/ladoderecho.png';
		$this->Image($image_file, 190, 50, 15, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);


		// Set font
		$this->SetFont('helvetica', 'B',6);


		$image_file =base_url().'assets/img/fondocseiio.png';
		$this->Image($image_file,60,90,86,'', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);


		// Titulo
		$this->SetXY(25,31);
		$this->Cell(0,0, '"2019, AÑO POR LA ERRADICACIÓN DE LA VIOLENCIA CONTRA LA MUJER"', 0, false, 'C', 0, '', 0, false, 'M', 'M');
*/
		
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
$medidas = array(279.4,431.8);
// create new PDF document
$pdf = new MYPDF('L', 'mm',$medidas, true, 'UTF-8', false);

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
$pdf->SetMargins(20, PDF_MARGIN_TOP,19);
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
$html_1 ='
<h5 style="text-align:center">COLEGIO SUPERIOR PARA LA EDUCACION INTEGRAL INTERCULTURAL DE OAXACA</h5>
<p style="text-align:center">DEPARTAMENTO DE CONTROL ESCOLAR</p>
<h5 style="text-align:center;background-color:#e9e9e9">FORMATO DE REGISTRO DE INSCRIPCION Y ACREDITACION ESCOLAR</h5>

<table>
<tbody>
<tr>
<td>Nombre del Plantel: aqui va el nombre</td>
<td style="text-align:right">Ciclo escolar: aqui va el ciclo</td>
</tr>

<tr>
<td>Clave cct: aqui va el cct</td>
<td style="text-align:right">Semestre: aqui va el semestre</td>
</tr>

<tr>
<td>Localidad y municipio: aqui va el localidad y municipio</td>
<td style="text-align:right">Grupo: aqui va el grupo</td>
</tr>

<tr>
<td> </td>
<td> </td>
</tr>

</tbody>
</table>

<table border="1">
<tbody>
<tr style="font-size:6 pt;text-align:center">
<td style="vertical-align: middle">N/P</td>
<td>MATRICULA</td>
<td>CURP</td>
<td>SEXO</td>
<td>PRIMER APELLIDO</td>
<td>SEGUNDO APELLIDO</td>
<td>NOMBRE(S)</td>
<td>EDAD ACTUAL</td>
<td>TIPO INGRESO</td>
<td>ESTATUS INICIO DEL SEMESTRE</td>
<td>NUMERO DE ADEUDOS INICIO DEL SEMESTRE</td>
<td>CLAVE U.C. ADEUDOS SEMESTRES ANTERIORES</td>
<td>NUMERO DE ADEUDOS DESPUES DE REGULARIZACION DE MAYO</td>
<td>CLAVE U.C. ADEUDOS DESPUES DE LA REGULARIZACION DE MAYO</td>
</tr>
</tbody>
</table>
';

// print a block of text using Write()
// output the HTML content
$pdf->writeHTML($html_1, true, 0, true, true);


//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>