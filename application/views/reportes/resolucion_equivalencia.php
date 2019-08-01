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
				// get the current page break margin
		$bMargin = $this->getBreakMargin();
		// get current auto-page-break mode
		$auto_page_break = $this->AutoPageBreak;
		// disable auto-page-break
		$this->SetAutoPageBreak(false, 0);
		// set bacground image
		//$img_file = base_url().'assets/img/plantilla.jpg';
		//$this->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
		// restore auto-page-break status
		$this->SetAutoPageBreak($auto_page_break, $bMargin);
		// set the starting point for the page content
		$this->setPageMark();
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
		
	}
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

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
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<span style="text-align:center;font-weight:bold">'.$nombre_completo.'</span>

<br>
<br>
<br>

<span style="text-align:justify">En el <span style="font-weight:bold">'.$escuela_procedencia.'</span>, Clave: <span style="font-weight:bold">'.$cct_procedencia.'</span> durante el (los) periodo(s) escolar(es) de <span style="font-weight:bold">'.$ciclos_escolares.'</span> según documentación integrada en el Departamento de Control Escolar perteneciente al Colegio Superior para la Educación Integral Intercultural de Oaxaca (C.S.E.I.I.O), con lo que se hizo la equiparación, y le tiene por acreditado (d)el <span style="font-weight:bold">primer'.$semestre_acreditado.'</span> semestre en el Bachillerato Integral Comunitario de '.$nombre_plantel_inscrito.' Clave: <span style="font-weight:bold">'.$plantel_inscrito.'</span>, con un promedio de <span style="font-weight:bold">'.$promedio_acreditado.'</span>.
</span>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<span style="text-align:LEFT;">Oaxaca de Juárez, Oax. a '.$fecha_expedicion.'.</span>
<br>
<br>
<br>
<br>
Expediente: <span style="font-weight:bold">'.$num_folio.'</span>
<br>
<br>
<br>
<span style="text-align:RIGTH;"><STRONG>DAVID ERNESTO HERNANDEZ AVENDAÑO</STRONG></span>
<br>
<span style="text-align:RIGTH;"><STRONG>Jefe del Departamento de Control Escolar</STRONG></span>
<br>
<br>
<br>
<br>
Elaboró y registró: J.L.H.P
<br>
<br>
<br>
<br>
<br>

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