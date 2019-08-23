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

	public $dato_plantel;
	public $dato_ciclo_escolar;


	public function set_plantel($dato){
    $this->dato_plantel = $dato;
    }


    public function set_ciclo_escolar($ciclo){
    $this->dato_ciclo_escolar = $ciclo;
    }

	//Page header
	public function Header() {
		

		$html = '<div style="text-align: center;" ><span ><strong>FORMATO DE OBSERVACIONES EN EXPEDIENTES </strong></span></div>
<br>
<table border="1">
<tbody>

<tr>
<td style="background-color:#E6E6E6; font-weight: bold;" WIDTH="11%">DIRECTOR(A):</td>
<td WIDTH="55%">'.$this->dato_plantel->director.'</td>
<td style="background-color:#E6E6E6; font-weight: bold;" WIDTH="15%">FECHA:</td>
<td WIDTH="20%">'.date("d/m/Y").'</td>
</tr>

<tr>
<td style="background-color:#E6E6E6; font-weight: bold;" >PLANTEL:</td>
<td>'.$this->dato_plantel->nombre_largo.' DE '.$this->dato_plantel->nombre_plantel.'</td>
<td style="background-color:#E6E6E6; font-weight: bold;" >CICLO ESCOLAR:</td>
<td>'.$this->dato_ciclo_escolar->nombre_ciclo_escolar.'</td>
</tr>

</tbody>
</table>
<p style="text-align: justify">CON MOTIVO DE SUBSANAR TODAS LAS INCONSISTENCIAS (FALTA DE DOCUMENTACIÓN) EN EXPEDIENTE DE LOS ASPIRANTES A SER ALUMNOS DEL PLANTEL A SU CARGO, ENTREGO A USTED LA RELACIÓN DE LOS MISMOS, EXHORTÁNDOLOS A QUE EN UNA REUNIÓN CON LOS PADRES DE FAMILIA O TUTORES SEAN INFORMADOS DE LA SITUACIÓN DEL ASPIRANTE, LO CUAL DEBERÁ SER ENTREGADA EN UN PLAZO NO MAYOR A 10 DÍAS HÁBILES.</p> <table border="1" width="100%">
<tbody>
<tr>
<td style="background-color:#E6E6E6; font-weight: bold; text-align: center;" WIDTH="5%">NP</td>
<td style="background-color:#E6E6E6; font-weight: bold; text-align: center;" WIDTH="10%">MOD/SEM<BR>GRUPO</td>
<td style="background-color:#E6E6E6; font-weight: bold; text-align: center;" WIDTH="35%">NOMBRE DEL ASPIRANTE</td>
<td style="background-color:#E6E6E6; font-weight: bold; text-align: center;" WIDTH="50%">DOCUMENTO(S) PENDIENTES</td>
</tr>
</tbody>
</table>
<br>

<div align="center">
 <img src="'.base_url().'assets/img/fondocseiio.png'.'" alt="Smiley face" height="300" width="300"></div';
     $this->writeHTMLCell($w =234.5, $h ='', $x =21, $y = 28, $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);


		// Logo
		$image_file =base_url().'assets/img/cabecera.png';
		$this->Image($image_file, 176,6, 90, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

		$image_file =base_url().'assets/img/ladoderecho.png';
		$this->Image($image_file, 257, 40, 15, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);


		// Set font
		$this->SetFont('helvetica', 'B',6);


		


		// Titulo
		$this->SetXY(25,26);
		$this->Cell(0,0, '"2019, AÑO POR LA ERRADICACIÓN DE LA VIOLENCIA CONTRA LA MUJER"', 0, false, 'C', 0, '', 0, false, 'M', 'M');



		

		
	}

	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$html = '<br><br><br><br><br><br><table border="0">
<tbody>

<tr>
<td style="font-weight: bold; text-align: center; border-bottom:solid 1px #000000;" WIDTH="35%">'.$this->dato_plantel->director.'</td>
<td WIDTH="30%"></td>
<td style="font-weight: bold; text-align: center; border-bottom:solid 1px #000000;" WIDTH="35%"></td>
</tr>


<tr>
<td style="font-weight: bold; text-align: center;" WIDTH="35%">RECIBÍ</td>
<td WIDTH="30%"></td>
<td style="font-weight: bold; text-align: center;" WIDTH="35%">ENTREGUÉ</td>
</tr>



</tbody>
</table>';




     $this->writeHTMLCell($w = 0, $h = 0, $x ='', $y ='', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);

		$image_file =base_url().'assets/img/pie.png';
		$this->Image($image_file,206,190, 65, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		$this->Cell(0, 10, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}


function semestre_en_letra($semestre){
	$resultado='';
	switch ($semestre) {
    case '1':
        $resultado="PRIMERO";
        break;
    case '2':
        $resultado="SEGUNDO";
        break;
    case '3':
         $resultado="TERCERO";
        break;
    case '4':
         $resultado="CUARTO";
        break;
    case '5':
         $resultado="QUINTO";
        break;
    case '6':
         $resultado="SEXTO";
        break;
    default:
       $resultado="";
    
}

return $resultado;
}


// create new PDF document
$pdf = new MYPDF('L', PDF_UNIT,"LETTER", true, 'UTF-8', false);

$pdf->set_plantel($dato_plantel[0]);
$pdf->set_ciclo_escolar($ciclo_escolar[0]);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Control Escolar CSEIIO');
$pdf->SetTitle('PDF Formato observaciones en expedientes');
$pdf->SetSubject('PDF Formato observaciones en expedientes');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(20,81,23);
$pdf->SetHeaderMargin(10);
$pdf->SetFooterMargin(60);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE,60);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica','', 9);

// add a page
$pdf->AddPage();

// set some text to print
$html_2='';
$html_3='';
$html_1 ='
';

$html_2.='<table border="1" width="100%">
<tbody>';
$tmp_num_control='';
$lista_observaciones='';
$nombre_completo='';
$observaciones='';
$cont=1;
$num_alumno=1;

foreach ($lista_doc as $lista) {

if($tmp_num_control==''){
	$tmp_num_control=$lista->no_control;
}
$observaciones= $lista->observacion;
if($observaciones==''){
	$observaciones='SIN OBSERVACIÓN';
}

$nombre_del_grupo='SIN GRUPO';

if($lista->nombre_grupo!=null){
   $nombre_del_grupo=$lista->nombre_grupo;
}

if($tmp_num_control!=$lista->no_control){
	$html_2.='<tr>
		<td WIDTH="5%" style="text-align:center">'.$num_alumno.'</td>
		<td WIDTH="10%">'.semestre_en_letra($lista->semestre_en_curso).' "'.$nombre_del_grupo.'"</td>
		<td WIDTH="35%">'.$nombre_completo.'</td>
		<td WIDTH="50%">'.$lista_observaciones.'</td></tr>';
	$tmp_num_control=$lista->no_control;
	$lista_observaciones='';
	$nombre_completo='';
	$num_alumno++;
	
}

if(strlen($lista_observaciones)!=0){
$lista_observaciones.='<br>';
}
	$lista_observaciones.='<strong>'.strtoupper($lista->nombre_documento).'.- </strong>'.strtoupper($observaciones).'.';
	$nombre_completo=$lista->nombre.' '.$lista->primer_apellido.' '.$lista->segundo_apellido;

if(sizeof($lista_doc)==$cont){
	$html_2.='<tr>
		<td WIDTH="5%" style="text-align:center">'.$num_alumno.'</td>
		<td  WIDTH="10%">'.semestre_en_letra($lista->semestre_en_curso).' "'.$nombre_del_grupo.'"</td>
		<td WIDTH="35%">'.$nombre_completo.'</td>
		<td WIDTH="50%">'.$lista_observaciones.'</td></tr>';

}

$cont=$cont+1;
}




$html_2.='
</tbody>
</table>';
if(sizeof($lista_doc)==0){
	$html_2='<h4><span style="text-align:center">------NO SE HAN ENCONTRADO ALUMNOS CON ADEUDO DE DOCUMENTACIÓN--------</span><h4>';
}
$html_3.='<br>';
// print a block of text using Write()
// output the HTML content
$pdf->writeHTML($html_1.$html_2.$html_3, true, 0, true, true);


//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>