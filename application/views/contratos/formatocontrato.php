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
		// Logo
		//$image_file =base_url().'plantilla/img/cabecera.png';
	//	$this->Image($image_file, 120, 10, 80, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

		//$image_file =base_url().'plantilla/img/ladoderecho.png';
	//	$this->Image($image_file, 190, 50, 15, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Set font
		$this->SetFont('helvetica', 'B', 17);
		// Title
		//$this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
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
$pdf->SetAuthor('Recursos Humanos CSEIIO');
$pdf->SetTitle('PDF Contrato');
$pdf->SetSubject('Contrato CSEIIO');
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
$pdf->SetFont('times','', 12);

// add a page
$pdf->AddPage();

// set some text to print
$html ='
<span style="text-align:center;"><h3>CONTRATO INDIVIDUAL DE TRABAJO</h3></span></br>

<span style="text-align:justify;">Que celebran <strong></strong> como patrón y ____________________ trabajador o empleado, bajo las siguientes cláusulas:</span>

<span style="text-align:justify;">1.- Por sus generales, los contratantes declaran lo siguiente:
PATRÓN: Nacionalidad _____________; edad _______ años; sexo ________; estado civil ______________; con domicilio en ____________________.	Y el trabajador 	Nacionalidad _____________; edad _______ años; sexo ________; estado civil ______________; con domicilio en ____________________.
</span>


<p style="text-align:justify;">6.- Quedan establecidos como días de descanso obligatorios con pago de salario íntegro los días primero de enero, el primer lunes de febrero en conmemoración del cinco de febrero, el tercer lunes de febrero en conmemoración del veintiuno de marzo, primero de mayo, dieciséis de septiembre, el tercer lunes de febrero en conmemoración del veinte de noviembre, veinticinco de diciembre y primero de diciembre de cada seis años cuando corresponda a la transmisión del Poder Ejecutivo Federal, en términos del artículo 74 de "LA LEY" </p>



<p style="text-align:justify;">9.- Cuando por cualquiera circunstancia el trabajador o empleado haya que trabajar durante mayor tiempo que el que corresponde a la jornada máxima legal, el patrón retribuirá el tiempo excedente con un 100% más del salario que corresponda a las horas normales, términos del artículo 67 de la Ley Federal del Trabajo, La prolongación de tiempo extraordinario que exceda de nueve horas a la semana, obliga al patrón a pagar al trabajador el tiempo excedente, con un 200% más el salario que corresponde a las horas de jornada, en términos del artículo 68 de la Ley Federal del Trabajo, sin perjuicio de las sanciones establecidas en esta Ley. 
</p>

<p style="text-align:justify;">11.- Ambas partes convienen expresamente en someterse en caso de cualquier diferencia o controversia, al texto de éste contrato y a las disposiciones del Reglamento Interior de Trabajo aprobado por la Junta Federal de Conciliación y Arbitraje, y del cual se entrega un ejemplar al empleado o trabajador en el momento de la celebración de dicho contrato. 
</p>

<p style="text-align:justify;">
13.- Este "CONTRATO" se celebra por tiempo indeterminado según lo establece el artículo 35  de la Ley Federal del Trabajo.

Leído que fue por ambas partes este documento ante los testigos que firman, y enterados de su contenido y sabedores de las obligaciones que por virtud de él contraen, así como de las que la ley les impone, lo firman  en ______________ a los _____________ días del mes de ______________ quedando un ejemplar en poder del trabajador y _______________________ en poder del patón.

</p>


<br/>
<br/>
<span style="text-align:center;">
FIRMA DEL PATRÓN

<br/>
<br/>
<br/>
<br/>

________________________________

<br/>
<br/>
<br/>
<br/>
TESTIGO
<br/>
<br/>
________________________________

</span>
';

// print a block of text using Write()
// output the HTML content
$pdf->writeHTML($html, true, 0, true, true);


//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>