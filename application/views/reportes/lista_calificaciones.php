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

    public function get_nombre_semestre($semestre){
       
     switch ($semestre){
         case 1: return "PRIMER"; break;
         case 2: return "SEGUNDO"; break;
         case 3: return "TERCER"; break;
         case 4: return "CUARTO"; break;
         case 5: return "QUINTO"; break;
         case 6: return "SEXTO"; break;
         
     }
     }

     public function get_nombre_mes($semestre){
       
        switch ($semestre){
            case 1: return "ENERO"; break;
            case 2: return "FEBRERO"; break;
            case 3: return "MARZO"; break;
            case 4: return "ABRIL"; break;
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

	//Page header
	public function Header() {
		$image_file =base_url().'assets/img/logo_cseiio.png';
        $this->Image($image_file, 14, 5, 10, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        
        $image_file =base_url().'assets/img/logo_gobierno.png';
		$this->Image($image_file, 187, 5, 10, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

		
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
		//$this->Cell(0, 10, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
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
$pdf->SetMargins(11, 5,11);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 2);

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
<span style="text-align:center;font-size:8pt;  font-weight:bold">COLEGIO SUPERIOR PARA LA EDUCACION INTEGRAL INTERCULTURAL DE OAXACA</span><br>
<span style="text-align:center;font-size:7.5pt;  font-weight:bold">DEPARTAMENTO DE CONTROL ESCOLAR</span>

<br><span style="text-align:center;font-size:6.5pt;  font-weight:bold">CONCENTRADO DE CALIFICACIONES MODULARES</span>
<br><span style="text-align:center;font-size:6pt;  font-style: italic">'.$pdf->get_nombre_semestre($materia->semestre).' MÓDULO</span>
';

$datos_cabecera='
<div>
<table style="font-size:6pt">
<tbody>
<tr>
<td style="text-align:left;width:18%"><span style="font-weight:bold">NOMBRE DEL PLANTEL:</span></td>
<td style="text-align:left;width:58%">'.$plantel->nombre_largo.' DE '.$plantel->nombre_plantel.'</td>
<td style="text-align:right;width:12%"><span style="font-weight:bold">GRUPO:</span></td>
<td style="text-align:left;width:12%">"'.$materia->nombre_grupo.'"</td>
</tr>

<tr>
<td style="text-align:left"><span style="font-weight:bold">CLAVE C.T.:</span></td>
<td style="text-align:left">'.$plantel->cct_plantel.'</td>
<td style="text-align:right"><span style="font-weight:bold">PERIODO:</span></td>
<td style="text-align:left">'.$materia->periodo.'</td>
</tr>

<tr>
<td style="text-align:left"><span style="font-weight:bold">LOCALIDAD Y MUNICIPIO:</span></td>
<td style="text-align:left">'.$plantel->localidad_municipio.'</td>
<td style="text-align:right"><span style="font-weight:bold">CICLO ESCOLAR:</span></td>
<td style="text-align:left">'.$materia->nombre_ciclo_escolar.'</td>
</tr>

<tr>
<td style="text-align:left"><span style="font-weight:bold">UNIDAD DE CONTENIDO:</span></td>
<td style="text-align:left">'.strtr(strtoupper($materia->unidad_contenido),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ").'</td>
<td></td>
<td></td>
</tr>





<tr>
<td style="text-align:left"><span style="font-weight:bold">CLAVE:</span></td>
<td style="text-align:left">'.$materia->clave.'</td>
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
<tr style="font-weight:bold">
<td style="width:21px;height:25px;background-color:#f8facb"><br><br>NO.</td>
<td style="width:345px;height:25px;background-color:#f8facb"><br><br>NOMBRE DEL ALUMNO</td>
<td style="width:35px;height:25px;background-color:#f8facb"><br><br>MAR</td>
<td style="width:35px;height:25px;background-color:#f8facb"><br><br>MAY</td>
<td style="width:35px;height:25px;background-color:#f8facb"><br><br>JUN</td>
<td style="width:35px;height:25px;background-color:#f8facb">PROM. MOD.</td>
<td style="width:35px;height:25px;background-color:#f8facb">EXA. FINAL</td>
<td style="width:35px;height:25px;background-color:#f8facb">CAL. FINAL</td>
<td style="width:89px;height:25px;background-color:#f8facb"><br><br>FECHA DE BAJA</td>
</tr>
</tbody>
</table>
<div>
';



$encabezado_tabla_b='
<div>
<table border="1" style="font-size:6pt">
<tbody>
<tr style="font-weight:bold">
<td style="width:21px;height:25px;background-color:#f8facb"><br><br>NO.</td>
<td style="width:345px;height:25px;background-color:#f8facb"><br><br>NOMBRE DEL ALUMNO</td>
<td style="width:35px;height:25px;background-color:#f8facb"><br><br>SEP</td>
<td style="width:35px;height:25px;background-color:#f8facb"><br><br>NOV</td>
<td style="width:35px;height:25px;background-color:#f8facb"><br><br>DIC</td>
<td style="width:35px;height:25px;background-color:#f8facb">PROM. MOD.</td>
<td style="width:35px;height:25px;background-color:#f8facb">EXA. FINAL</td>
<td style="width:35px;height:25px;background-color:#f8facb">CAL. FINAL</td>
<td style="width:89px;height:25px;background-color:#f8facb"><br><br>FECHA DE BAJA</td>
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
        <tr style="line-height: 20px;">
        <td style="width:21px">'.$contador.'</td>
        <td style="width:100px;text-align: left">'.$estudiante->primer_apellido.'</td>
        <td style="width:100px;text-align: left">'.$estudiante->segundo_apellido.'</td>
        <td style="width:145px;text-align: left">'.$estudiante->nombre.'</td>
        <td style="width:35px"></td>
        <td style="width:35px"></td>
        <td style="width:35px"></td>
        <td style="width:35px"></td>
        <td style="width:35px"></td>
        <td style="width:35px"></td>
        <td style="width:89px"></td>
        </tr>
        ';
        $contador+=1;
    }
    
    if($contador<35){
        for ($x=$contador;$x<=35;$x++){
            if($x==$contador){
                $respuesta.='<tr style="line-height: 20px;background-color:#909090">
            <td style="width:21px">'.$x.'</td>
            <td style="width:100px"></td>
            <td style="width:100px"></td>
            <td style="width:145px"></td>
            <td style="width:35px"></td>
            <td style="width:35px"></td>
            <td style="width:35px"></td>
            <td style="width:35px"></td>
            <td style="width:35px"></td>
            <td style="width:35px"></td>
            <td style="width:89px"></td>
            </tr>';

            }
            else{
                $respuesta.='<tr style="line-height: 20px;">
            <td style="width:21px">'.$x.'</td>
            <td style="width:100px"></td>
            <td style="width:100px"></td>
            <td style="width:145px"></td>
            <td style="width:35px"></td>
            <td style="width:35px"></td>
            <td style="width:35px"></td>
            <td style="width:35px"></td>
            <td style="width:35px"></td>
            <td style="width:35px"></td>
            <td style="width:89px"></td>
            </tr>';
            }

        }
        
    }
    

    return $respuesta;

}


$date = date_create($fecha_fin);
$cadena_fecha=date_format($date, 'd').' DE '.$pdf->get_nombre_mes(date_format($date, 'm')).' DE '.date_format($date, 'Y');



$datos_estudiantes='
<div>
<table border="1" style="font-size:6pt">
<tbody>
'.rellenar_lista($estudiantes).'
</tbody>
</table>
<div>
<br><span style="font-weight:bold;font-size:6pt;text-align:left">FECHA: '.$cadena_fecha.'</span>
';


$firma_asesor='
<div>
<table border="1" style="font-size:6pt">
<tbody>

<tr>
<td></td>
</tr>

<tr>
<td></td>
</tr>


<tr>
<td></td>
</tr>


</tbody>
</table>
</div>
';


if($materia->tipo_semestre=='A'){
$encabezado_tabla = $encabezado_tabla_a;
}

else{
    $encabezado_tabla = $encabezado_tabla_b;
}

$asesor_nombre = sizeof($asesor)==0?"":($asesor[0]->nombre.' '.$asesor[0]->primer_apellido.' '.$asesor[0]->segundo_apellido);

if($asesor_nombre==""){
    $asesor_nombre="&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;  &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;";
}

$firmas ='
<table style="font-size:7pt">
<tbody>
<tr>
<td><br><br><br><span style="text-decoration: underline;">  '.$asesor_nombre.'  </span><br>NOMBRE Y FIRMA DEL ASESOR</td>
<td><p></p><p>___________________________</p><p>SELLO</p></td>
<td><br><br><br><span style="text-decoration: underline;">  '.$plantel->director.'  </span><br>NOMBRE Y FIRMA DEL DIRECTOR(A)</td>
</tr>
</tbody>
</table>
';

$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '260', $firmas, $border = 0, $ln = 0, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);


$pdf->writeHTMLCell($w = 0, $h = 50, $x = '', $y = '5', $titulo, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);

$pdf->writeHTMLCell($w = 0, $h = 50, $x = '', $y = '24', $datos_cabecera, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);

$pdf->writeHTMLCell($w = 0, $h = 50, $x = '', $y = '44', $encabezado_tabla, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);

$pdf->writeHTMLCell($w = 0, $h = 50, $x = '', $y = '51', $datos_estudiantes, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);

//$pdf->writeHTMLCell($w = 0, $h = 50, $x = '', $y = '75', $firma_asesor, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);

// print a block of text using Write()
// output the HTML content
//$pdf->writeHTML($titulo.$datos_cabecera, true, 0, true, true);


//Close and output PDF document
$pdf->Output('Lista de Calificaciones.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>