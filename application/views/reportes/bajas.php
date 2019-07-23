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

        $titulo1="<h6>COLEGIO SUPERIOR PARA LA EDUCACION INTEGRAL INTERCULTURAL DE OAXACA<h6>";
        $titulo2="<h6>DEPARTAMENTO DE CONTROL ESCOLAR<h6>";

        $datos_plantel = '
        <table border="1" style="font-size:7pt">
        <tbody>
        <tr>
        <td style="text-align:left">NOMBRE DEL PLANTEL:</td>
        <td style="text-align:left">xxxxxxxxxxxxxxxxxx</td>
        </tr>

        <tr>
        <td style="text-align:left">CLAVE C.T.:</td>
        <td style="text-align:left">xxxxxxxxxxxxxxxxxx</td>
        </tr>

        <tr>
        <td style="text-align:left">CICLO ESCOLAR</td>
        <td style="text-align:left">xxxxxxxxxxxxxxxxxxxx</td>
        </tr>
        </tbody>
        <table>';
		
        $this->writeHTMLCell($w = 0, $h = 0, $x = '15', $y = '7', $titulo1, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);
        $this->writeHTMLCell($w = 0, $h = 0, $x = '15', $y = '10', $titulo2, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);
        $this->writeHTMLCell($w = 0, $h = 0, $x = '15', $y = '13', '<p style="font-size:7pt">REPORTE DE BAJAS</p>', $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);
        $this->writeHTMLCell($w = 0, $h = 0, $x = '15', $y = '17', $datos_plantel, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);
		
	}


	// Page footer
	public function Footer() {

        $firmas = '
        <table>
        <tbody>
        <tr>

        <td>
        <p>NOMBRE DEL DIRECTOR</p>
        <p>____________________________</p>
        <p>NOMBRE Y FIRMA DEL DIRECTOR</p>
        <p>DEL PLANTEL</p>
        </td>

        <td>
        <p> </p>
        <p>____________________________</p>
        <p>SELLO DEL PLANTEL</p>
        <p></p>
        </td>

        <td>
        <p>HERIBERTO RIOS COLIN</p>
        <p>____________________________</p>
        <p>JEFA DE DEPARTAMENTO</p>
        <p>DE CONTROL ESCOLAR</p>
        </td>


        <td>
        <p> </p>
        <p>____________________________</p>
        <p>SELLO DE CONTROL ESCOLAR</p>
        <p></p>
        </td>

        </tr>
        </tbody>
        </table>
        ';

        $this->writeHTMLCell($w = 0, $h = 0, $x = '15', $y = '160', $firmas, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);
	
	}
}

// create new PDF document
$pdf = new MYPDF("L", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Control Escolar CSEIIO');
$pdf->SetTitle('PDF REPORTE DE BAJAS');
$pdf->SetSubject('REPORTE BAJAS CSEIIO');
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


function rellenar(){
$respuesta="";
    for($i=1;$i<16;$i++){
        $respuesta.='
        <tr style="height:10px">
        <td style="width:70px;text-align:center">'.$i.'</td>
        <td style="width:120px;text-align:center"></td>
        <td style="width:350px;text-align:center"></td>
        <td style="width:200px;text-align:center"></td>
        <td style="width:100px;text-align:center"></td>
        <td style="width:120px;text-align:center"></td>
</tr>
        ';
    }

    return $respuesta;
}


$tabla='
<table border="1">
<tbody>
<tr style="background-color:#ececec;height:10px">
<td style="width:70px;text-align:center">N/P</td>
<td style="width:120px;text-align:center">MODULO/GRUPO</td>
<td style="width:350px;text-align:center">NOMBRE DEL ALUMNO</td>
<td style="width:200px;text-align:center">MOTIVO</td>
<td style="width:100px;text-align:center">FECHA DE BAJA</td>
<td style="width:120px;text-align:center">OBSERVACIONES</td>
</tr>

'.rellenar().'
</tbody>
</table>
';
// print a block of text using Write()
// output the HTML content
$pdf->writeHTMLCell($w = 0, $h = 0, $x = '10', $y = '40', $tabla, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);

//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>