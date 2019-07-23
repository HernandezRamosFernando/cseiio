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

    public $mes;
    public $nombre_bic;
    public $cct;
    public $ciclo_escolar;
    public $fecha_hora;
    public $clave;
    public $unidad_contenido;
    public $asesor;
    public $director;

	//Page header
	public function Header() {

		// Titulo
		//$this->SetXY(25,10);
		//$this->Cell(0,0, '<p>COLEGIO SUPERIOR PARA LA EDUCACION INTEGRAL INTERCULTURAL DE OAXACA</p>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->writeHTMLCell($w = 0, $h = 0, $x = '0', $y = '10', '<p style="font-size:7pt;font-weight: bold">COLEGIO SUPERIOR PARA LA EDUCACION INTEGRAL INTERCULTURAL DE OAXACA</p>', $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);
        $this->writeHTMLCell($w = 0, $h = 0, $x = '0', $y = '15', '<p style="font-size:6pt;font-weight: bold">DEPARTAMENTO DE CONTROL ESCOLAR</p>', $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);
        $this->writeHTMLCell($w = 0, $h = 0, $x = '0', $y = '22', '<p style="font-size:7pt;font-weight: bold">ACTA DE EXAMEN DE REGULARIZACION</p>', $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);
        $this->writeHTMLCell($w = 0, $h = 0, $x = '0', $y = '27', '<p style="font-size:7pt;font-weight: bold">'.$this->mes.'</p>', $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);//MES

        $encabezado = '
        <table border="1" style="font-size:7pt">
        <tbody>
        <tr>
        <td colspan="3" style="font-weight: bold;text-align:left"> '.$this->nombre_bic.'</td>
        </tr>

        <tr>
        <td style="text-align:left"> C.C.T.:'.$this->cct.'</td>
        <td></td>
        <td style="text-align:left"> CICLO ESCOLAR:'.$this->ciclo_escolar.'</td>
        </tr>

        <tr>
        <td style="text-align:left"> FECHA Y HORA DE APLICACION DE EXAMEN</td>
        <td colspan="2" style="text-align:left"> '.$this->fecha_hora.'</td>
        </tr>

        <tr>
        <td colspan="3"></td>
        </tr>

        <tr>
        <td style="text-align:left"> CLAVE:'.$this->clave.'</td>
        <td colspan="2"></td>
        </tr>

        <tr>
        <td colspan="3" style="text-align:left"> UNIDAD DE CONTENIDO:'.$this->unidad_contenido.'</td>
        </tr>
        </tbody>
        </table>
        ';

        $this->writeHTMLCell($w = 0, $h = 0, $x = '15', $y = '34', $encabezado, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);
	}


	// Page footer
	public function Footer() {

        $tabla_firmas='
        <table border="1">
        <tbody>
        <tr>
        <td style="height:80px">'.$this->asesor.'</td>
        <td>'.$this->director.'</td>
        </tr>
        </tbody>
        </table>
        ';

        $tabla_titulos='
        <table>
        <tbody>
        <tr>
        <td >NOMBRE Y FIRMA DEL ASESOR(A)</td>
        <td>NOMBRE, FIRMA Y SELLO DEL DIRECTOR DEL PLANTEL</td>
        </tr>
        </tbody>
        </table>
        ';

        $valido='
        <table border="1">
        <tbody>
        <tr>
        <td style="height:20px;width:305px;text-align:left"> VALIDO:</td>
        </tr>
        </tbody>
        </table>
        ';

        $this->writeHTMLCell($w = 0, $h = 0, $x = '15', $y = '210', $tabla_firmas, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);
        $this->writeHTMLCell($w = 0, $h = 0, $x = '15', $y = '235', $tabla_titulos, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);
        $this->writeHTMLCell($w = 0, $h = 0, $x = '15', $y = '250', $valido, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);
        //$this->writeHTMLCell($w = 0, $h = 0, $x = '15', $y = '210', $tabla_firmas, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		$this->Cell(0, 10, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

//------------------------------pasar variables

$pdf->mes = $mes;
$pdf->nombre_bic = $plantel->nombre_plantel;
$pdf->cct = $plantel->cct_plantel;
$pdf->ciclo_escolar = "2019-2020";
$pdf->fecha_hora = $fecha_hora->fecha_calificacion." ".$fecha_hora->hora." HRS";
$pdf->clave = $materia->clave;
$pdf->unidad_contenido = $materia->unidad_contenido;
$pdf->asesor = $asesor->nombre." ".$asesor->primer_apellido." ".$asesor->segundo_apellido;
$pdf->director = $plantel->director;

//--------------------------------------------

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Control Escolar CSEIIO');
$pdf->SetTitle('PDF Acta de Regularizacion');
$pdf->SetSubject('Acta de Regularizacion CSEIIO');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(15,60,19);
$pdf->SetHeaderMargin(60);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 146);

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


function numero_a_letra($numero){

    $respuesta = "";

    switch($numero){

        case 0:
        $respuesta="/";
        break;

        case 5:
        $respuesta="CINCO";
        break;

        case 6:
        $respuesta="SEIS";
        break;

        case 7:
        $respuesta="SIETE";
        break;

        case 8:
        $respuesta="OCHO";
        break;

        case 9:
        $respuesta="NUEVE";
        break;

        case 10:
        $respuesta="DIEZ";
        break;

    }

    return $respuesta;
}


function rellenar($con_grupo,$sin_grupo){
    $foliador = 1;
    $respuesta='';

    foreach($con_grupo as $estudiante){

        $respuesta.='
        <tr>
        <td style="width:30px;height:20px">'.$foliador.'</td>
        <td style="width:50px">'.($estudiante->ultimo_grupo[0]).'</td>
        <td style="width:40px">'.($estudiante->ultimo_grupo[1]).'</td>
        <td style="width:75px">'.$estudiante->matricula.'</td>
        <td style="width:110px">'.$estudiante->primer_apellido.'</td>
        <td style="width:110px">'.$estudiante->segundo_apellido.'</td>
        <td style="width:120px">'.$estudiante->nombre.'</td>
        <td style="width:42.5px">'.$estudiante->calificacion.'</td>
        <td style="width:42.5px">'.numero_a_letra(intval($estudiante->calificacion)).'</td>
        </tr>';

        $foliador+=1;

    }

    $respuesta.='
        <tr style="background-color:gray">
        <td style="width:30px;height:20px"></td>
        <td style="width:50px"></td>
        <td style="width:40px"></td>
        <td style="width:75px"></td>
        <td style="width:110px"></td>
        <td style="width:110px"></td>
        <td style="width:120px"></td>
        <td style="width:42.5px"></td>
        <td style="width:42.5px"></td>
        </tr>';

        foreach($sin_grupo as $estudiante){

            $respuesta.='
            <tr>
            <td style="width:30px;height:20px">'.$foliador.'</td>
            <td style="width:50px">'.($estudiante->ultimo_grupo[0]).'</td>
            <td style="width:40px">'.($estudiante->ultimo_grupo[1]).'</td>
            <td style="width:75px">'.$estudiante->matricula.'</td>
            <td style="width:110px">'.$estudiante->primer_apellido.'</td>
            <td style="width:110px">'.$estudiante->segundo_apellido.'</td>
            <td style="width:120px">'.$estudiante->nombre.'</td>
            <td style="width:42.5px">'.$estudiante->calificacion.'</td>
            <td style="width:42.5px">'.numero_a_letra(intval($estudiante->calificacion)).'</td>
            </tr>';
    
            $foliador+=1;
    
        }



    return $respuesta;
}


////datos-------------------------------------
$tabla = '
<table border="1" style="font-size:6pt">
<tbody>
<tr>
<td style="width:30px;font-weight: bold" rowspan="2">N.P.</td>
<td style="width:50px;font-weight: bold" rowspan="2">SEMESTRE</td>
<td style="width:40px;font-weight: bold" rowspan="2">GRUPO</td>
<td style="width:75px;font-weight: bold" rowspan="2">MATRICULA</td>
<td style="width:340px;font-weight: bold" colspan="3">NOMBRE DEL ALUMNO</td>
<td style="width:85px;font-weight: bold" colspan="2">CALIFICACION</td>
</tr>

<tr>
<td style="width:110px;font-weight: bold">PATERNO</td>
<td style="width:110px;font-weight: bold">MATERNO</td>
<td style="width:120px;font-weight: bold">NOMBRE(S)</td>
<td style="width:42.5px;font-weight: bold">NUMERO</td>
<td style="width:42.5px;font-weight: bold">LETRA</td>
</tr>

'.rellenar($estudiantes_con_grupo,$estudiantes_sin_grupo).'

</tbody>
</table>
';

//$pdf->writeHTMLCell($w = 0, $h = 0, $x = '15', $y = '0', $tabla, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);//MES
$pdf->writeHTML($tabla, true, false, true, false, '');
//------------------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>