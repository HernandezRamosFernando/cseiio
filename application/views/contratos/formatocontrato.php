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
		$this->SetFont('helvetica', 'B', 10);
		// Title
		$this->Cell(0, 10, '<< Colegio Superior para la Educación Integral Intercultural de Oaxaca >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
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
<span style="text-align:RIGTH;">ASUNTO: CARTA COMPROMISO</span>
<br>
<span style="text-align:LEFT;"><STRONG>LIC. HERIBERTO RÍOS COLIN</STRONG></span>
<br>
<span style="text-align:LEFT;"><STRONG>JEFE DEL DEPARTAMENTO DE CONTROL ESCOLAR</STRONG></span>
<br>
<span style="text-align:LEFT;"><STRONG>OFICINAS CENTRALES, OAXACA, OAX.</STRONG></span>
<br>
<br>

<span style="text-align:justify;">Solicito a usted de la manera más atenta, se me otorgue prórroga de 30 (treinta) días para la entrega completa de mi expediente
ante esta Jefatura de Control Escolar, ya que por motivos estrictamente personales no cuento con mi documentación completa  en este momento, razón por la cual hago el siguiente 
compromiso y para ello proporciono los siguientes datos:
</span>
<br>

<div style="text-align: center; background-color:#58ACFA" ><span ><strong> CARTA COMPROMISO </strong></span></div>


<table  border="1">


<tbody>
<tr>
<td colspan="3">Nombre del Aspirante:'.$aspirante_plantel[0]->nombre.' '.$aspirante_plantel[0]->apellido_paterno.' '.$aspirante_plantel[0]->apellido_materno.'</td>
</tr>

<tr>
<td>Semestre:'.$aspirante_plantel[0]->semestre.'</td>
<td colspan="2">Grupo:</td>
</tr>

<tr><td colspan="3">Nombre del Bachillerato:'.$aspirante_plantel[0]->nombre_plantel.'</td></tr>

<tr>
<td>Cct:'.$aspirante_plantel[0]->cct.'</td>
<td>Fecha:'.date("Y-m-d").'</td>
<td>Ciclo Escolar:</td>
</tr>

</tbody>

</table>

<br>
<br>

<table  border="1">
<thead>
<tr>
    <th>N.P</th>
		<th>Documento</th>
		<th>Observaciones</th>
</tr>
</thead>

<tbody>';

$html_2 = "";
$contador = 1;
foreach($documentos as $documento){
$html_2 .= '<tr>
<td>'.$contador.'</td>
<td>'.$documento->nombre_documento.'</td>
<td>'.$documento->observacion.'</td>
</tr>';
$contador+=1;
};

$html_3 = '</tbody>
</table>



<br>
<br>
<span style="text-align:justify">Se hace la observación que la prórroga de tiempo es aplicable solo en los casos de certificación parcial
y cuando medie juicio civil por correcciones de nombre, apellido o algún dato del acta de nacimiento.<br>
Estoy consiente del compromiso que suscribo, sabedor de una vez que entregue mi documentación completa, gozaré de matrícula y estaré oficialmente inscrito.
Por lo tanto de no ser Alumno oficial del CSEIIO los semestres que haya cursado en el plantel no se reconocerán y ante de el incumplimiento y la falta 
de estos requisitos, seré dado de baja del Bachillerato en el que obtuve mi alta. Firmo la presente a mi enterea satisfacción en a los días del mes del año.
</span>

<br>
<br>
<br>
<br>
<br>
<p style="text-align:center">FIRMANDO DE CONFORMIDAD</p>
<br>
<table  border="1">
<tbody>
<tr>
<td><br><br><br><br><br><br></td>
<td></td>
<td>Vo. Bo.</td>
</tr>

<tr>
<td style="text-align:center">Nombre y firma del aspirante</td>
<td style="text-align:center">Nombre y firma del tutor o responsable</td>
<td style="text-align:center">El director</td>
</tr>
</tbody>
</table>
';

// print a block of text using Write()
// output the HTML content
$pdf->writeHTML($html_1.$html_2.$html_3, true, 0, true, true);


//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>