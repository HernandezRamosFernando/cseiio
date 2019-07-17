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

	public $num_dias_mes;
	public $cadena_dias_html;
	public $cadena_columnas_html;
	public $mes_seleccionado='';
	public $anio_seleccionado='';
	public $cct='';
	public $semestre='';
	public $plantel='';
	public $datos_grupo='';
	public $nombre_dias_cadena_html='';

	

	public function set_plantel($plantel){
	$this->plantel=$plantel;
}

public function set_datos_grupo($grupo){
	$this->datos_grupo=$grupo;
}


		public function set_semestre($semestre){
	$this->semestre=$semestre;
}


	public function set_cct($cct){
	$this->cct=$cct;
}


public function set_mes($mes){
	$this->mes_seleccionado=$mes;
}

public function set_anio($anio){
	$this->anio_seleccionado=$anio;
}

	public function set_dias_mes(){
		$numero= cal_days_in_month(CAL_GREGORIAN,$this->mes_seleccionado,$this->anio_seleccionado);
    	$this->num_dias_mes = $numero;
    }


    public function get_num_dias(){
    	return $this->num_dias_mes;
    }


	public function get_nombre_dia($fecha){
   $fechats = strtotime($fecha); //pasamos a timestamp

//el parametro w en la funcion date indica que queremos el dia de la semana
//lo devuelve en numero 0 domingo, 1 lunes,....
switch (date('w', $fechats)){
    case 0: return "D"; break;
    case 1: return "L"; break;
    case 2: return "M"; break;
    case 3: return "M"; break;
    case 4: return "J"; break;
    case 5: return "V"; break;
    case 6: return "S"; break;
}

}


public function get_nombre_mes($mes){
   
switch ($mes){
    case 1: return "ENERO"; break;
    case 2: return "FEBRERO"; break;
    case 3: return "MARZO"; break;
    case 4: return "ABRL"; break;
    case 5: return "MAYO"; break;
    case 6: return "JUNIO"; break;
    case 7: return "JULIO"; break;
    case 8: return "AGOSTO"; break;
    case 9: return "SEPTIEMBRE"; break;
    case 10: return "OCTUBRE"; break;
    case 11: return "NOVIEMBRE"; break;
    case 12: return "DICIEMBRE"; break;
}

}



    public function get_cadena_html(){
		
    	return $this->cadena_dias_html;
    }

    public function get_nombre_dias_cadena_html(){
		
    	return $this->nombre_dias_cadena_html;
    }

    public function get_columnas_html(){
		
    	return $this->cadena_columnas_html;
    }

    public function cadena_html(){
    	$this->cadena_dias_html='';
    	$this->cadena_columnas_html='';
    	$fondo_celda='';

    	$tamanio=56/$this->num_dias_mes;
    	for($x=1;$x<=$this->num_dias_mes;$x++){

    		$fondo_celda='';

    			$dia=$this->get_nombre_dia($this->anio_seleccionado.'-'.$this->mes_seleccionado.'-'.$x);
		    	
               if($dia=='D' || $dia=='S'){
               	$fondo_celda=' background-color: #e3e3e3';
               }
				$this->cadena_dias_html.='<td WIDTH="'.$tamanio.'%" style="text-align:center;'.$fondo_celda.'">'.$x.'</td>';

				$this->nombre_dias_cadena_html.='<td WIDTH="'.$tamanio.'%" style="text-align:center;'.$fondo_celda.'">'.$dia.'</td>';


				$this->cadena_columnas_html.='<td WIDTH="'.$tamanio.'%" style="'.$fondo_celda.'"></td>';

		}
    }

    public function set_ciclo_escolar($ciclo){
    $this->dato_ciclo_escolar = $ciclo;
    }

	//Page header
	public function Header() {

		$html='<div style="text-align: center;" ><span ><strong>ASISTENCIA MENSUAL DE ALUMNOS</strong></span></div> <br>
<table>
<tbody>
<tr>
<td style="font-weight: bold;" WIDTH="9%">PLANTEL:</td>
<td WIDTH="77%" style="border-bottom-style: solid;">'.$this->plantel.'</td>
<td style="font-weight: bold;" WIDTH="4%">CCT:</td>
<td WIDTH="10%" style="border-bottom-style: solid;">'.$this->cct.'</td>
</tr>
</tbody>
</table>

<table>
<tbody>

<tr>
<td style="font-weight: bold;" WIDTH="9%">DOCENTE:</td>
<td WIDTH="55%" style="border-bottom-style: solid;">'.(($this->datos_grupo[0]->nombre===null)? 'SIN PROFESOR ASIGNADO' : $this->datos_grupo[0]->nombre.' '.$this->datos_grupo[0]->primer_apellido.' '.$this->datos_grupo[0]->segundo_apellido).'</td>
<td style="font-weight: bold;" WIDTH="8%">MODULO:</td>
<td WIDTH="11%" style="border-bottom-style: solid;">'.$this->semestre.'</td>
<td style="font-weight: bold;" WIDTH="7%">GRUPO:</td>
<td WIDTH="10%" style="border-bottom-style: solid;">'.$this->datos_grupo[0]->nombre_grupo.'</td>
</tr>

<tr>
<td style="font-weight: bold;" >MATERIA:</td>
<td style="border-bottom-style: solid;">'.$this->datos_grupo[0]->unidad_contenido.'</td>
<td style="font-weight: bold;" >MES:</td>
<td style="border-bottom-style: solid;">'.$this->get_nombre_mes($this->mes_seleccionado).'</td>
<td style="font-weight: bold;" >AÑO:</td>
<td style="border-bottom-style: solid;">'.$this->anio_seleccionado.'</td>
</tr>

</tbody>
</table>
<div><span style="font-weight:bold">Simbología:</span></div>

<table border="1">
<tbody>
<tr>
<td style="font-weight: bold;" WIDTH="12%">Presente= . </td>
<td style="font-weight: bold;" WIDTH="12%">Tarde= R</td>
<td style="font-weight: bold;" WIDTH="12%">Injustificado= /</td>
<td style="font-weight: bold;" WIDTH="12%">Justificado= J</td>
</tr>
</tbody>
</table>
';

$this->SetFont('helvetica', 'B',8);

		$this->writeHTMLCell($w =310, $h =59.8, $x =21, $y = 28, $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);

		// Logo
		$image_file =base_url().'assets/img/cabecera.png';
		$this->Image($image_file, 176,6, 90, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

		$image_file =base_url().'assets/img/ladoderecho.png';
		$this->Image($image_file, 332, 40, 15, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);


		// Set font
		$this->SetFont('helvetica', 'B',6);



		// Titulo
		$this->SetXY(25,26);
		$this->Cell(0,0, '"2019, AÑO POR LA ERRADICACIÓN DE LA VIOLENCIA CONTRA LA MUJER"', 0, false, 'C', 0, '', 0, false, 'M', 'M');



		

		
	}

	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		
		$image_file =base_url().'assets/img/pie.png';
		$this->Image($image_file,280,190, 65, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		$this->Cell(0, 10, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}




// create new PDF document

$pdf = new MYPDF('L', PDF_UNIT,"LEGAL", true, 'UTF-8', false);
$pdf->set_mes($mes);
$pdf->set_anio($anio);
$pdf->set_cct($cct_plantel);
$pdf->set_semestre($semestre);
$pdf->set_plantel($nombre_plantel);
$pdf->set_datos_grupo($datos_grupo);
$pdf->set_dias_mes();
$pdf->cadena_html();

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Control Escolar CSEIIO');
$pdf->SetTitle('PDF Lista de asistencia');
$pdf->SetSubject('PDF Lista de asistencia');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(20,55,23);
$pdf->SetHeaderMargin(55);
$pdf->SetFooterMargin(25);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE,25);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica','', 8);

// add a page
$pdf->AddPage();

// set some text to print
$html_2='';
$html_1='<br>
<br>
<table border="1">
<thead>
<tr>
<td style="font-weight: bold;text-align:center" WIDTH="36%" rowspan="2"><BR>NOMBRE DEL ESTUDIANTE</td>
'.$pdf->get_nombre_dias_cadena_html().'
<td style="font-weight: bold;text-align:center" WIDTH="8%" colspan="4">TOTAL</td>
</tr>
<tr>

'.$pdf->get_cadena_html().'
<td style="font-weight: bold;text-align:center" WIDTH="2%">.</td>
<td style="font-weight: bold;text-align:center" WIDTH="2%">R</td>
<td style="font-weight: bold;text-align:center" WIDTH="2%">/</td>
<td style="font-weight: bold;text-align:center" WIDTH="2%">J</td>
</tr>


</thead>
<tbody>';



foreach ($lista_alumnos as $a) {

$html_2.='<tr>
<td style="font-weight: bold;" WIDTH="15%">'.$a->nombre.'</td>
<td style="font-weight: bold;" WIDTH="11%">'.$a->primer_apellido.'</td>
<td style="font-weight: bold;" WIDTH="10%">'.$a->segundo_apellido.'</td>
'.$pdf->get_columnas_html().'
<td style="font-weight: bold;" WIDTH="2%"></td>
<td style="font-weight: bold;" WIDTH="2%"></td>
<td style="font-weight: bold;" WIDTH="2%"></td>
<td style="font-weight: bold;" WIDTH="2%"></td>

</tr>';
}

$html_3 ='<tr>
<td WIDTH="92%" colspan="'.$pdf->get_num_dias().'" style="border-left-color:white;border-bottom-color:white"><span style="text-align:right; font-weight:bold">TOTAL</span></td>
<td style="font-weight: bold;" WIDTH="2%"></td>
<td style="font-weight: bold;" WIDTH="2%"></td>
<td style="font-weight: bold;" WIDTH="2%"></td>
<td style="font-weight: bold;" WIDTH="2%"></td>

</tr></tbody>
</table>';





// print a block of text using Write()
// output the HTML content
$pdf->writeHTML($html_1.$html_2.$html_3, true, 0, true, true);


//Close and output PDF document
$pdf->Output('Lista de Asistencia.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>