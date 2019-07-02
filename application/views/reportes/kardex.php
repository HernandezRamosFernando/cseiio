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
$pdf->SetTitle('PDF Kardex');
$pdf->SetSubject('Kardex CSEIIO');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(20, 5,19);
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
$encabezado ='<h6 style="text-align:center">COLEGIO SUPERIOR PARA LA EDUCACION INTEGRAL INTERCULTURAL DE OAXACA</h6>
<h6 style="text-align:center">DEPARTAMENTO DE CONTROL ESCOLAR</h6>
<h5 style="text-align:center">K A R D E X</h5>
<p style="text-align:center;font-weight: bold;font-size:5pt">'.$estudiante->nombre_plantel.'</p>';


// print a block of text using Write()
// output the HTML content
$pdf->writeHTML($encabezado, true, 0, true, true);

//curp
$pdf->writeHTMLCell($w = 50, $h = 5, $x = '110', $y = '24', '<p>'.$estudiante->curp.'</p>', $border = 1, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);
$pdf->writeHTMLCell($w = 50, $h = 3, $x = '110', $y = '30', '<p style="font-size:6pt">CURP</p>', $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);
//matricula
$pdf->writeHTMLCell($w = 30, $h = 5, $x = '165', $y = '24', '<p>'.$estudiante->matricula.'</p>', $border = 1, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);
$pdf->writeHTMLCell($w = 50, $h = 3, $x = '156', $y = '30', '<p style="font-size:6pt">MATRICULA</p>', $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);


//recuadro de foto
$pdf->writeHTMLCell($w = 25, $h = 30, $x = '14', $y = '34','<p></p>', $border = 1, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);


$nombre = '
<table border="1">
<tbody>
<tr>
<td style="text-align:center;width:179px;font-size:8pt">'.$estudiante->primer_apellido.'</td>
<td style="text-align:center;width:179px;font-size:8pt">'.$estudiante->segundo_apellido.'</td>
<td style="text-align:center;width:179px;font-size:8pt">'.$estudiante->nombre.'</td>
</tr>
</tbody>
</table>
';

$nombre_titulo = '
<table>
<tbody>
<tr>
<td style="text-align:center;width:179px;font-size:6pt">PRIMER APELLIDO</td>
<td style="text-align:center;width:179px;font-size:6pt">SEGUNDO APELLIDO</td>
<td style="text-align:center;width:179px;font-size:6pt">NOMBRE</td>
</tr>
</tbody>
</table>
';

$pdf->writeHTMLCell($w = 30, $h = 5, $x = '42', $y = '34', $nombre, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);
$pdf->writeHTMLCell($w = 30, $h = 5, $x = '42', $y = '39', $nombre_titulo, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);

$domicilio = '
<table border="1" style="font-size:8pt">
<tbody>
<tr>
<td style="text-align:center;width:179px;height:27px">'.$estudiante->calle.'</td>
<td style="text-align:center;width:254px">'.$estudiante->nombre_localidad.','.$estudiante->nombre_municipio.'</td>
<td style="text-align:center;width:104px">'.$estudiante->cp.'</td>
</tr>
</tbody>
</table>
';

$domicilio_titulo = '
<table>
<tbody>
<tr>
<td style="text-align:center;width:179px;font-size:6pt">DOMICILIO</td>
<td style="text-align:center;width:254px;font-size:6pt">LOCALIDAD Y MUNICIPIO</td>
<td style="text-align:center;width:104px;font-size:6pt">C. P.</td>
</tr>
</tbody>
</table>
';

$pdf->writeHTMLCell($w = 30, $h = 5, $x = '42', $y = '43', $domicilio, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);
$pdf->writeHTMLCell($w = 30, $h = 5, $x = '42', $y = '51', $domicilio_titulo, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);


//lugar de nacimiento
$pdf->writeHTMLCell($w = 153, $h = 5, $x = '42', $y = '56', '<p>'.$estudiante->lugar_nacimiento.'</p>', $border = 1, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);
$pdf->writeHTMLCell($w = 153, $h = 5, $x = '42', $y = '61', '<p style="font-size:7pt">LUGAR DE NACIMIENTO</p>', $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);

//sexo
$pdf->writeHTMLCell($w = 10, $h = 5, $x = '82', $y = '68', '<p style="font-size:7pt">SEXO</p>', $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);
$pdf->writeHTMLCell($w = 10, $h = 5, $x = '94', $y = '68', '<p>'.$estudiante->sexo.'</p>', $border = 1, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);

//fecha_nacimiento
$pdf->writeHTMLCell($w = 20, $h = 5, $x = '150', $y = '68', '<p style="font-size:7pt">FECHA DE NACIMIENTO</p>', $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);
$pdf->writeHTMLCell($w = 25, $h = 5, $x = '170', $y = '68', '<p>'.$estudiante->fecha_nacimiento.'</p>', $border = 1, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);

//nombre tutor
$pdf->writeHTMLCell($w = 40, $h = 5, $x = '14', $y = '77', '<p style="font-size:7pt">NOMBRE DEL TUTOR</p>', $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);
$pdf->writeHTMLCell($w = 145, $h = 5, $x = '50', $y = '77', '<p>'.$estudiante->nombre_tutor.' '.$estudiante->primer_apellido_tutor.' '.$estudiante->segundo_apellido_tutor.'</p>', $border = 1, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);


//observaciones
$pdf->writeHTMLCell($w = 40, $h = 5, $x = '14', $y = '85', '<p style="font-size:7pt">OBSERVACIONES</p>', $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);
$pdf->writeHTMLCell($w = 145, $h = 5, $x = '50', $y = '85', '<p></p>', $border = 1, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);

//espacio vacio
$pdf->writeHTMLCell($w = 145, $h = 5, $x = '50', $y = '90', '<p></p>', $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);
///////////////////encabezosooo---------------------------------------------

function extraescolar($calificacion){
    $regreso = "";
    switch(intval($calificacion)){
        case 10:
        $regreso = "E";
        break;

        case 9:
        $regreso = "MB";
        break;

        case 8:
        $regreso = "B";
        break;

        case 7:
        $regreso = "R";
        break;

        case 6:
        $regreso = "S";
        break;
    }

    return $regreso;
}

function renglones($materias,$regularizaciones_aprobadas){
    $renglones = '';
    foreach($materias as $materia){//materias de grupo
        $promedio_modular = (intval($materia->primer_parcial)+intval($materia->segundo_parcial)+intval($materia->tercer_parcial))/3;

        if($promedio_modular>0 && $promedio_modular<6){
            $promedio_modular=5;
        }

        else{
            $promedio_modular = round($promedio_modular,0,PHP_ROUND_HALF_UP);
        }

       $renglones.='<tr>
       <td style="width:50px;text-align:center">'.$materia->id_materia.'</td>
       <td style="width:200px">'.$materia->unidad_contenido.'</td>
       <td style="width:40px;text-align:center">'.($materia->primer_parcial=="0"?"/":$materia->primer_parcial).'</td>
       <td style="width:40px;text-align:center">'.($materia->segundo_parcial=="0"?"/":$materia->segundo_parcial).'</td>
       <td style="width:40px;text-align:center">'.($materia->tercer_parcial=="0"?"/":$materia->tercer_parcial).'</td>
   
   
       <td style="width:40px;text-align:center">'.($promedio_modular=="0"?"/":$promedio_modular).'</td>
       <td style="width:40px;text-align:center">'.($materia->examen_final=="0"?"/":$materia->examen_final).'</td>';
       if($materia->tipo=="EXTRAESCOLAR"){
        $renglones.='<td style="width:40px;text-align:center">'.extraescolar($materia->calificacion_final).'</td>';
       }

       else{
        $renglones.='<td style="width:40px;text-align:center">'.($materia->calificacion_final).'</td>';
       }
       
   
       $renglones.='<td style="width:87px;text-align:center">'.materia_regularizada_fecha($materia->id_materia,$regularizaciones_aprobadas).'</td>
       <td style="width:40px;text-align:center">'.materia_regularizada_calificacion($materia->id_materia,$regularizaciones_aprobadas).'</td>
   
       </tr>
   ' ;
    }

    return $renglones;
}


function nombre_modulo($semestre){
    $modulo='';
switch($semestre){
    case "1":
    $modulo = "PRIMER";
    break;

    case "2":
    $modulo = "SEGUNDO";
    break;

    case "3":
    $modulo = "TERCER";
    break;

    case "4":
    $modulo = "CUARTO";
    break;

    case "5":
    $modulo = "QUINTO";
    break;

    case "6":
    $modulo = "SEXTO";
    break;
}

return $modulo;
}


function materia_regularizada_fecha($id_materia,$regularizaciones){
    $respuesta="";
    foreach($regularizaciones as $regularizacion){
        if($regularizacion->id_materia==$id_materia){
            $respuesta = $regularizacion->fecha_calificacion;
        }
    }

    return $respuesta;
}

function materia_regularizada_calificacion($id_materia,$regularizaciones){
    $respuesta="";
    foreach($regularizaciones as $regularizacion){
        if($regularizacion->id_materia==$id_materia){
            $respuesta = $regularizacion->calificacion;
        }
    }

    return $respuesta;
}


function crear_tabla_materias_semestre($grupos,$regularizaciones_aprobadas){
   $tablas='';

   foreach($grupos as $materias_grupo){//grupos de materias
    $tabla = '
    <table border="1" style="font-size:7pt">
    <tbody>
    <tr>
    <td style="width:50px;background-color:#cfcfcf;text-align:center" rowspan="3"> <br><br> CLAVE</td>
    <td style="width:200px;background-color:#cfcfcf">CICLO ESCOLAR: '.$materias_grupo[0]->nombre_ciclo_escolar.'</td>
    <td style="width:120px;text-align:center;background-color:#cfcfcf" colspan="3">PARCIALES</td>
    <td style="width:40px;text-align:center;background-color:#cfcfcf" rowspan="3">PROM. MOD.</td>
    <td style="width:40px;text-align:center;background-color:#cfcfcf" rowspan="3">EXAM. MOD.</td>
    <td style="width:40px;text-align:center;background-color:#cfcfcf" rowspan="3">CALIF. FINAL</td>
    <td style="width:127px;text-align:center;background-color:#cfcfcf" colspan="2">REGULARIZACION</td>

    </tr>

    <tr>
  
    <td style="width:200px;background-color:#cfcfcf">'.nombre_modulo($materias_grupo[0]->semestre).' MODULO</td>
    <td style="width:40px;text-align:center;background-color:#cfcfcf" rowspan="2">1ER</td>
    <td style="width:40px;text-align:center;background-color:#cfcfcf" rowspan="2">2DO</td>
    <td style="width:40px;text-align:center;background-color:#cfcfcf" rowspan="2">3ER</td>


    <td style="width:87px;background-color:#cfcfcf;text-align:center" rowspan="2">FECHA</td>
    <td style="width:40px;background-color:#cfcfcf;text-align:center" rowspan="2">CALIF</td>
    </tr>

    <tr>
  
    <td style="width:200px;background-color:#cfcfcf">UNIDAD DE CONTENIDO</td>


    </tr>
    
    '.renglones($materias_grupo,$regularizaciones_aprobadas).'
    
    </tbody>
    </table>
    <p></p>
    ';

    $tablas.=$tabla;
   }

    return $tablas;
}


function renglones_materias_revalidadas($materias,$bachillerato_procedencia,$datos_resolucion){
    $renglones = '';
    $contador=0;
    foreach($materias as $materia){
        $renglones.='<tr>
        <td style="width:50px;text-align:center">'.$materia->clave.'</td>
        <td style="width:200px">'.$materia->unidad_contenido.'</td>';

        if($contador==0){
            $renglones .= '<td style="width:200px;text-align:left;font-size:6pt" rowspan="'.sizeof($materias).'">
            <p>NOMBRE DE LA INSTITUCION:'.$bachillerato_procedencia->nombre_escuela_procedencia.'</p>
            <p>CCT:'.$bachillerato_procedencia->cct_escuela_procedencia.'</p>
            <p>'.$bachillerato_procedencia->lugar_escuela.'</p>
            <p>CICLO ESCOLAR:</p>
            <p>FOLIO DE EQUIVALENCIA:'.$datos_resolucion->folio.'</p>
            <p>FECHA DE EXPEDICION DE EQUIVALENCIA:'.$datos_resolucion->fecha_expedicion.'</p>
            </td>
            <td style="width:40px;text-align:center" rowspan="'.sizeof($materias).'"><br><br><br><br><br><br><br>'.$datos_resolucion->promedio_acreditado.'</td>';

        }

        $renglones.='
    
        <td style="width:87px;text-align:center"></td>
        <td style="width:40px;text-align:center"></td>
    
        </tr>';

        $contador+=1;
    }
    
       return $renglones;
}


function tabla_portabilidad($materias_semestre,$bachillerato_procedencia,$datos_resolucion){
    $tabla = '';

    foreach($materias_semestre as $semestre){
        $tabla .= '<table border="1" style="font-size:7pt">
        <tbody>
        <tr>
        <td style="width:50px;background-color:#cfcfcf;text-align:center" rowspan="3"> <br><br> CLAVE</td>
        <td style="width:200px;background-color:#cfcfcf">CICLO ESCOLAR:</td>
        <td style="width:120px;text-align:center;background-color:#cfcfcf" colspan="3">PARCIALES</td>
        <td style="width:40px;text-align:center;background-color:#cfcfcf" rowspan="3">PROM. MOD.</td>
        <td style="width:40px;text-align:center;background-color:#cfcfcf" rowspan="3">EXAM. MOD.</td>
        <td style="width:40px;text-align:center;background-color:#cfcfcf" rowspan="3">CALIF. FINAL</td>
        <td style="width:127px;text-align:center;background-color:#cfcfcf" colspan="2">REGULARIZACION</td>
    
        </tr>
    
        <tr>
      
        <td style="width:200px;background-color:#cfcfcf">'.nombre_modulo($semestre[0]->semestre).' MODULO</td>
        <td style="width:40px;text-align:center;background-color:#cfcfcf" rowspan="2">1ER</td>
        <td style="width:40px;text-align:center;background-color:#cfcfcf" rowspan="2">2DO</td>
        <td style="width:40px;text-align:center;background-color:#cfcfcf" rowspan="2">3ER</td>
    
    
        <td style="width:87px;background-color:#cfcfcf;text-align:center" rowspan="2">FECHA</td>
        <td style="width:40px;background-color:#cfcfcf;text-align:center" rowspan="2">CALIF</td>
        </tr>
    
        <tr>
      
        <td style="width:200px;background-color:#cfcfcf">UNIDAD DE CONTENIDO</td>
    
    
        </tr>
        
        '.renglones_materias_revalidadas($semestre,$bachillerato_procedencia,$datos_resolucion).'
        
        </tbody>
        </table>
        <p></p>
        ';
    }
    

    return $tabla;
}




//tablas de datos de materias de estudiante
if($portabilidad=="no"){
    $pdf->writeHTML(crear_tabla_materias_semestre($materias_grupo,$regularizaciones_aprobadas), true, 0, true, true);
}

else{
    $pdf->writeHTML(tabla_portabilidad($materias_revalidadas,$bachillerato_procedencia,$datos_resolucion), true, 0, true, true);
    $pdf->writeHTML(crear_tabla_materias_semestre($materias_grupo,$regularizaciones_aprobadas), true, 0, true, true);
}



//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>