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
        $encabezado_tabla = '<tr style="font-size:5 pt;text-align:center">
        <td border="1" style="width:30px;background-color:#f8facb"><br><br><br>N/P</td>
        <td border="1" style="width:55px;background-color:#f8facb"><br><br>ULTIMO MOD/SEM CURSADO (GRUPO)</td>
        <td border="1" style="width:45px;background-color:#f8facb"><br><br><br>MATRICULA</td>
        <td border="1" style="width:70px;background-color:#f8facb"><br><br><br>PRIMER APELLIDO</td>
        <td border="1" style="width:70px;background-color:#f8facb"><br><br><br>SEGUNDO APELLIDO</td>
        <td border="1" style="width:85px;background-color:#f8facb"><br><br><br>NOMBRE(S)</td>
        <td border="1" style="width:30px;background-color:#f8facb"><br><br>NUM ADEUDOS</td>
        <td border="1" style="width:85px;background-color:#f8facb"><br><br><br>CLAVE</td>
        <td border="1" style="width:50px;background-color:#f8facb"><br><br><br>CALIFICACION</td>
        <td border="1" style="width:85px;background-color:#f8facb"><br><br><br>CLAVE</td>
        <td border="1" style="width:50px;background-color:#f8facb"><br><br><br>CALIFICACION</td>
        <td border="1" style="width:85px;background-color:#f8facb"><br><br><br>CLAVE</td>
        <td border="1" style="width:50px;background-color:#f8facb"><br><br><br>CALIFICACION</td>
        <td border="1" style="width:85px;background-color:#f8facb"><br><br><br>CLAVE</td>
        <td border="1" style="width:50px;background-color:#f8facb"><br><br><br>CALIFICACION</td>
        <td border="1" style="width:210px;background-color:#f8facb"><br><br><br>OBSERVACIONES</td>
        </tr>';

        $encabezado ='<h5 style="text-align:center">COLEGIO SUPERIOR PARA LA EDUCACION INTEGRAL INTERCULTURAL DE OAXACA</h5>
<p style="text-align:center">DEPARTAMENTO DE CONTROL ESCOLAR</p>
<h5 style="text-align:center;background-color:#e9e9e9">FORMATO DE REGISTRO DE INSCRIPCION Y ACREDITACION ESCOLAR</h5>
<table>
<tbody>
<tr>
<td style="text-align:left">Nombre del Plantel:xxxxxxxxx</td>
<td style="text-align:right">Ciclo escolar:xxxxxxxxxx</td>
</tr>

<tr>
<td style="text-align:left">Clave cct:xxxxxxxxxxxxxx</td>
<td style="text-align:right">Semestre:xxxxxxxxxxxxx</td>
</tr>

<tr>
<td style="text-align:left">Localidad y municipio:xxxxxxxxxxxx</td>
<td style="text-align:right">Grupo:xxxxxxxxxxx</td>
</tr>
<br>
'.$encabezado_tabla.'

</tbody>
</table>
';

$html_materias_1='
<table border="1">
<tbody>
<tr>
<td style="font-size:5 pt;text-align:center;width:35px">CLAVE</td>
<td style="font-size:5 pt;text-align:center;width:200px"> UNIDADES DE CONTENIDO</td>
</tr>
<tr>
<td style="font-size:5 pt;text-align:center">C1001</td>
<td style="font-size:5 pt;text-align:left"> IDENTIDAD Y VALORES COMUNITARIOS</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C1011</td>
<td style="font-size:5 pt;text-align:left"> LENGUA INDIGENA I</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C1012</td>
<td style="font-size:5 pt;text-align:left"> INGLES I</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C1013</td>
<td style="font-size:5 pt;text-align:left"> INFORMATICA I</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C1014</td>
<td style="font-size:5 pt;text-align:left"> TALLER DE LECTURA Y REDACCION I</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C1021</td>
<td style="font-size:5 pt;text-align:left"> INTRODUCCION A LAS CIENCIAS SOCIALES I</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C1031</td>
<td style="font-size:5 pt;text-align:left"> QUIMICA I</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C1041</td>
<td style="font-size:5 pt;text-align:left"> MATEMATICAS I</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C1051</td>
<td style="font-size:5 pt;text-align:left"> METODOS DE INVESTIGACION I</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C1061</td>
<td style="font-size:5 pt;text-align:left"> FORMACION PARA EL DESARROLLO COMUNITARIO I</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C1EC1</td>
<td style="font-size:5 pt;text-align:left"> EXPRESIONES CULTURALES I</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C1FF2</td>
<td style="font-size:5 pt;text-align:left"> FORMACION FISICA I</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C1OT3</td>
<td style="font-size:5 pt;text-align:left"> ORIENTACION Y TUTORIA</td>
</tr>
</tbody>
</table>
';



$html_materias_2='
<table border="1">
<tbody>
<tr>
<td style="font-size:5 pt;text-align:center;width:35px">CLAVE</td>
<td style="font-size:5 pt;text-align:center;width:200px">UNIDADES DE CONTENIDO</td>
</tr>
<tr>
<td style="font-size:5 pt;text-align:center">C2002</td>
<td style="font-size:5 pt;text-align:left"> ETICA Y VALORES</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C2011</td>
<td style="font-size:5 pt;text-align:left"> LENGUA INDIGENA II</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C2012</td>
<td style="font-size:5 pt;text-align:left"> INGLES II</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C2013</td>
<td style="font-size:5 pt;text-align:left"> INFORMATICA II</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C2014</td>
<td style="font-size:5 pt;text-align:left"> TALLER DE LECTURA Y REDACCION II</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C2022</td>
<td style="font-size:5 pt;text-align:left"> HISTORIA LOCAL, REGIONAL Y ESTATAL</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C2031</td>
<td style="font-size:5 pt;text-align:left"> QUIMICA II</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C2032</td>
<td style="font-size:5 pt;text-align:left"> GEOGRAFIA</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C2041</td>
<td style="font-size:5 pt;text-align:left"> MATEMATICAS II</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C2151</td>
<td style="font-size:5 pt;text-align:left"> METODOS DE INVESTIGACION II</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C2061</td>
<td style="font-size:5 pt;text-align:left"> FORMACION PARA EL DESARROLLO COMUNITARIO II</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C2ECI</td>
<td style="font-size:5 pt;text-align:left"> EXPRESIONES CULTURALES II</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C2FF2</td>
<td style="font-size:5 pt;text-align:left"> FORMACION FISICA II</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C2OT3</td>
<td style="font-size:5 pt;text-align:left"> ORIENTACION Y TUTORIA</td>
</tr>
</tbody>
</table>
';


$html_materias_3='
<table border="1">
<tbody>
<tr>
<td style="font-size:5 pt;text-align:center;width:35px">CLAVE</td>
<td style="font-size:5 pt;text-align:center;width:200px"> UNIDADES DE CONTENIDO</td>
</tr>
<tr>
<td style="font-size:5 pt;text-align:center">C3103</td>
<td style="font-size:5 pt;text-align:left"> ESTETICA</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C3011</td>
<td style="font-size:5 pt;text-align:left"> LENGUA INDIGENA III</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C3012</td>
<td style="font-size:5 pt;text-align:left"> INGLES III</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C3113</td>
<td style="font-size:5 pt;text-align:left"> INFORMATICA III</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C3015</td>
<td style="font-size:5 pt;text-align:left"> LITERATURA I</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C3023</td>
<td style="font-size:5 pt;text-align:left"> HISTORIA DE MEXICO I</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C3033</td>
<td style="font-size:5 pt;text-align:left"> FISICA I</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C3034</td>
<td style="font-size:5 pt;text-align:left"> BIOLOGIA I</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C3041</td>
<td style="font-size:5 pt;text-align:left"> MATEMATICAS III</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C3061</td>
<td style="font-size:5 pt;text-align:left"> FORMACION PARA EL DESARROLLO COMUNITARIO III</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C3EC1</td>
<td style="font-size:5 pt;text-align:left"> EXPRESIONES CULTURALES III</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C1FF2</td>
<td style="font-size:5 pt;text-align:left"> FORMACION FISICA III</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C3OT3</td>
<td style="font-size:5 pt;text-align:left"> ORIENTACION Y TUTORIA III</td>
</tr>
</tbody>
</table>
';


$html_materias_4='
<table border="1">
<tbody>
<tr>
<td style="font-size:5 pt;text-align:center;width:35px">CLAVE</td>
<td style="font-size:5 pt;text-align:center;width:200px"> UNIDADES DE CONTENIDO</td>
</tr>
<tr>
<td style="font-size:5 pt;text-align:center">C4004</td>
<td style="font-size:5 pt;text-align:left"> FILOSOFIA</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C4011</td>
<td style="font-size:5 pt;text-align:left"> LENGUA INDIGENA IV</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C4012</td>
<td style="font-size:5 pt;text-align:left"> INGLES IV</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C4015</td>
<td style="font-size:5 pt;text-align:left"> LITERATURA II</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C4023</td>
<td style="font-size:5 pt;text-align:left"> HISTORIA DE MEXICO II</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C4033</td>
<td style="font-size:5 pt;text-align:left"> FISICA II</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C4034</td>
<td style="font-size:5 pt;text-align:left"> BIOLOGIA II</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C4041</td>
<td style="font-size:5 pt;text-align:left"> MATEMATICAS IV</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C4061</td>
<td style="font-size:5 pt;text-align:left"> FORMACION PARA EL DESARROLLO COMUNITARIO IV</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C4EC1</td>
<td style="font-size:5 pt;text-align:left"> EXPRESIONES CULTURALES IV</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C4FF2</td>
<td style="font-size:5 pt;text-align:left"> FORMACION FISICA IV</td>
</tr>

<tr>
<td style="font-size:5 pt;text-align:center">C4OT3</td>
<td style="font-size:5 pt;text-align:left"> ORIENTACION Y TUTORIA IV</td>
</tr>

</tbody>
</table>
';

		
		
		// Titulo
		//$this->SetXY(25,31);
		//$this->Cell(0,0, '"2019, AÑO POR LA ERRADICACIÓN DE LA VIOLENCIA CONTRA LA MUJER"', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->writeHTMLCell($w = 0, $h = 50, $x = '21', $y = '', $encabezado, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);

        //$this->SetX(0);
        $this->writeHTMLCell($w = 70, $h = 50, $x = '347', $y = '45', $html_materias_1, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);

        $this->writeHTMLCell($w = 70, $h = 50, $x = '347', $y = '80', $html_materias_2, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);

        $this->writeHTMLCell($w = 70, $h = 50, $x = '347', $y = '117', $html_materias_3, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);

        $this->writeHTMLCell($w = 70, $h = 50, $x = '347', $y = '152', $html_materias_3, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);
		
	}


	// Page footer
	public function Footer() {

        $html ='
        <table>
        <tbody>
        <tr>
        <td>hola</td>
        <td>hola</td>
        <td>hola</td>
        <td>hola</td>
        </tr>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <tr>
        <td></td>
        <td></td>
        <td></td>
        <td>hola</td>
        </tr>
        </tbody>
        </table>
        ';
		// Position at 15 mm from bottom
		//$image_file =base_url().'plantilla/img/pie.png';
		//$this->Image($image_file, 150,275, 50, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		//$this->SetY(0);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
        // Page number
        //$this->Cell(0, 0, 'TEST CELL STRETCH: no stretch', 1, 1, 'C', 0, '', 0);
        $this->writeHTMLCell($w = 0, $h = 50, $x = '21', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);
        $this->SetY(-15);
		$this->Cell(0, 10, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}

// create new PDF document
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
$pdf->SetMargins(20,56.1,19);//izquierdo,arriba,derecho
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(68);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 90);

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
$encabezado ='<h5 style="text-align:center">COLEGIO SUPERIOR PARA LA EDUCACION INTEGRAL INTERCULTURAL DE OAXACA</h5>
<p style="text-align:center">DEPARTAMENTO DE CONTROL ESCOLAR</p>
<h5 style="text-align:center;background-color:#e9e9e9">FORMATO DE REGISTRO DE INSCRIPCION Y ACREDITACION ESCOLAR</h5>
<table>
<tbody>
<tr>
<td>Nombre del Plantel:xxxxxxxxx</td>
<td style="text-align:right">Ciclo escolar:xxxxxxxxxx</td>
</tr>

<tr>
<td>Clave cct:xxxxxxxxxxxxxx</td>
<td style="text-align:right">Semestre:xxxxxxxxxxxxx</td>
</tr>

<tr>
<td>Localidad y municipio:xxxxxxxxxxxx</td>
<td style="text-align:right">Grupo:xxxxxxxxxxx</td>
</tr>

<tr>
<td> </td>
<td> </td>
</tr>

</tbody>
</table>
';


        //<td border="1" style="width:30px;background-color:#f8facb"><br><br><br>N/P</td>
        //<td border="1" style="width:55px;background-color:#f8facb"><br><br>ULTIMO MOD/SEM CURSADO (GRUPO)</td>
        //<td border="1" style="width:45px;background-color:#f8facb"><br><br><br>MATRICULA</td>
        //<td border="1" style="width:70px;background-color:#f8facb"><br><br><br>PRIMER APELLIDO</td>
        //<td border="1" style="width:70px;background-color:#f8facb"><br><br><br>SEGUNDO APELLIDO</td>
        //<td border="1" style="width:85px;background-color:#f8facb"><br><br><br>NOMBRE(S)</td>
        //<td border="1" style="width:30px;background-color:#f8facb"><br><br>NUM ADEUDOS</td>
        //<td border="1" style="width:85px;background-color:#f8facb"><br><br><br>CLAVE</td>
        //<td border="1" style="width:30px;background-color:#f8facb"><br><br>CALIFICACION</td>
        //<td border="1" style="width:85px;background-color:#f8facb"><br><br><br>CLAVE</td>
        //<td border="1" style="width:30px;background-color:#f8facb"><br><br>CALIFICACION</td>
        //<td border="1" style="width:85px;background-color:#f8facb"><br><br><br>CLAVE</td>
        //<td border="1" style="width:30px;background-color:#f8facb"><br><br>CALIFICACION</td>
        //<td border="1" style="width:85px;background-color:#f8facb"><br><br><br>CLAVE</td>
        //<td border="1" style="width:30px;background-color:#f8facb"><br><br>CALIFICACION</td>
        //<td border="1" style="width:210px;background-color:#f8facb"><br><br><br>OBSERVACIONES</td>
function rellenar(){
    $html="";
    for($i=0;$i<30;$i++){
        $html.='<tr>
        <td style="width:30px"></td>
        <td style="width:55px"></td>
        <td style="width:45px"></td>
        <td style="width:70px"></td>
        <td style="width:70px"></td>
        <td style="width:85px"></td>
        <td style="width:30px"></td>
        <td style="width:85px"></td>
        <td style="width:50px"></td>
        <td style="width:85px"></td>
        <td style="width:50px"></td>
        <td style="width:85px"></td>
        <td style="width:50px"></td>
        <td style="width:85px"></td>
        <td style="width:50px"></td>
        <td style="width:210px"></td>
        </tr>';
    }

    return $html;
}


$encabezado_tabla = '
<table border="1">
<tbody>
'.rellenar().'
</tbody>
</table>
';

// print a block of text using Write()
// output the HTML content
$pdf->writeHTML($encabezado_tabla, true, 0, true, true);


//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>