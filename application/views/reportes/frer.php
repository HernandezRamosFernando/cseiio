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

        global $datos_plantel;
        global $nombre_ciclo;
        global $dias;
        global $mes;
        global $ano;

        $image_file =base_url().'assets/img/logo_cseiio2.png';
        $this->Image($image_file, 20, 8, 41, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

       
        
        $image_file =base_url().'assets/img/logo_gobierno.png';
		$this->Image($image_file, 397, 8, 13, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

        $encabezado_tabla = '';

        $encabezado ='
        <span style="text-align:center;font-size:12.5pt;  font-weight:bold">COLEGIO SUPERIOR PARA LA EDUCACIÓN INTEGRAL INTERCULTURAL DE OAXACA</span>
<p style="text-align:center;font-size:11.3pt;  font-weight:bold">DEPARTAMENTO DE CONTROL ESCOLAR</p>
<h5 style="text-align:center;background-color:#e9e9e9;font-size:10pt;  font-weight:bold">FORMATO DE REGISTRO DE EXÁMENES DE REGULARIZACIÓN (F-RER)</h5>
<table>
<tbody>
<tr>
<td style="text-align:left"><span style="font-weight: bold;">NOMBRE DEL PLANTEL:</span> '.$datos_plantel->nombre_largo.' DE '.$datos_plantel->nombre_plantel.'</td>
<td style="text-align:right"><span style="font-weight: bold;">CICLO ESCOLAR: </span> '.$nombre_ciclo.'</td>
</tr>

<tr>
<td style="text-align:left"><span style="font-weight: bold;">CLAVE C.C.T: </span> '.$datos_plantel->cct_plantel.'</td>
<td style="text-align:right"><span style="font-weight: bold;">PERIODO DE REGULARIZACIÓN: </span> DE '.$mes.' DEL '.$ano.'</td>
</tr>

<tr>
<td style="text-align:left"><span style="font-weight: bold;">LOCALIDAD Y MUNICIPIO: </span> '.$datos_plantel->nombre_localidad.','.$datos_plantel->nombre_municipio.', '.$datos_plantel->nombre_distrito.', '.$datos_plantel->nombre_estado.'</td>
<td style="text-align:right"></td>
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
        $this->writeHTMLCell($w = 0, $h = 30, $x = '12', $y = '12', $encabezado, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);

        //$this->SetX(0);
        $this->writeHTMLCell($w = 70, $h = 50, $x = '358', $y = '50', $html_materias_1, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);

        $this->writeHTMLCell($w = 70, $h = 50, $x = '358', $y = '85', $html_materias_2, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);

        $this->writeHTMLCell($w = 70, $h = 50, $x = '358', $y = '122', $html_materias_3, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);

        $this->writeHTMLCell($w = 70, $h = 50, $x = '358', $y = '157', $html_materias_4, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);
		
	}

//variable de tipo global por asi decirlo pque contiene los datos del revisor.y el nombre del jefe del depto
//respectivamente
public $revisor_plantel;
public $jefe_escolar;

public function set_revisor($dato){
    $this->revisor_plantel=$dato;
}

public function get_revisor(){
    return $this->revisor_plantel;
}

public function set_jefe_escolar($dato){
    $this->jefe_escolar=$dato;
}

public function get_jefe_escolar(){
    return $this->jefe_escolar;
}


	// Page footer
	public function Footer() {
        global $datos_plantel;

        $nombre_revisor="";

            if ($this->get_revisor()[0]->nombre!=null){

                $nombre_revisor=$this->get_revisor()[0]->nombre." ".$this->get_revisor()[0]->primer_apellido." ".$this->get_revisor()[0]->segundo_apellido;
            }

        $html ='
        <br>
        <br>
        <br>
        <br>
        <br>
        <table>
        <tbody>
        <tr>
        <td><br>'.$datos_plantel->director.'<br>_________________________________<br>NOMBRE Y FIRMA DEL DIRECTOR <br>DEL PLANTEL</td>
        <td><br>_________________________________<br>SELLO DEL PLANTEL</td>
        <td><br>'.$this->get_jefe_escolar()[0]->valor.'<br>_________________________________<br>JEFE DEL DEPARTAMENTO<br>DE CONTROL ESCOLAR</td>
        <td><br>_________________________________<br>SELLO CONTROL ESCOLAR</td>
        </tr>

        <tr>
        <td colspan="4" height="50"></td>
        </tr>
        
        <tr>
        <td></td>
        <td></td>
        <td><br>'.$nombre_revisor.'<br>_________________________________<br>REVISÓ Y CONFRONTÓ</td>
        <td><span style="text-align:left;font-size:4px">ORIGINAL.- DEPTO. CONTROL ESCOLAR.<br>COPIA.- PLANTEL.</span></td>
        </tr>
        </tbody>
        </table>
        ';
		// Position at 15 mm from bottom
		//$image_file =base_url().'plantilla/img/pie.png';
		//$this->Image($image_file, 150,275, 50, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		//$this->SetY(0);
		// Set font
		//$this->SetFont('helvetica', 'I', 8);
        // Page number
        //$this->Cell(0, 0, 'TEST CELL STRETCH: no stretch', 1, 1, 'C', 0, '', 0);
        $this->writeHTMLCell($w = 0, $h = 50, $x = '12', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);
        $this->SetY(-15);
		$this->Cell(0, 10, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
    
    
}

//aqui termina la clase----------------------------------------------------------------------------------------------------



$GLOBALS['datos_plantel'] = $encabezado;
$GLOBALS['nombre_ciclo'] = $nombre_ciclo_escolar;
$GLOBALS['dias'] = $dias_periodo;
$GLOBALS['mes']=$mes;
$GLOBALS['ano']=$ano;



//global $nombre_ciclo;
//global $dias;

// create new PDF document
$medidas = array(279.4,431.8);
// create new PDF document
$pdf = new MYPDF('L', 'mm',$medidas, true, 'UTF-8', false);
// set document information
$pdf->set_revisor($revisor);
$pdf->set_jefe_escolar($jefe_escolar);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Control Escolar CSEIIO');
$pdf->SetTitle('FRER');
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
$pdf->SetMargins(12,55,7);//izquierdo,arriba,derecho
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(68);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 84);

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



//foliador de regularizaciones
$contador=1;//se reinicia cada vez
$foliador=1;

function nombre_grupo($valor){
    $resultado="";

    switch(intval($valor)){
        case 1:
        $resultado = "PRIMERO";
        break;

        case 2:
        $resultado = "SEGUNDO";
        break;

        case 3:
        $resultado = "TERCERO";
        break;

        case 4:
        $resultado = "CUARTO";
        break;

        case 5:
        $resultado = "QUINTO";
        break;

        case 6:
        $resultado = "SEXTO";
        break;
    }

    return $resultado;
}



/////////////////////////// datos de alumnos con grupo
    $html="";
    foreach($regularizaciones_con_grupo as $estudiante){
        $claves_califiaciones="";
        $aprobadas_sumar = 0;
        foreach($materias_regularizadas_con_grupo[$contador-1] as $materia){
            $claves_califiaciones.='<td style="width:65px">'.$materia->id_materia.'</td>';
            $claves_califiaciones.='<td style="width:50px">'.$materia->calificacion.'</td>';
            if(intval($materia->calificacion)>=6){
                $aprobadas_sumar+=1;
            }
        }

        if(sizeof($materias_regularizadas_con_grupo[$contador-1])==1){
            $claves_califiaciones.='<td style="width:65px"></td>';
            $claves_califiaciones.='<td style="width:50px"></td>';

            $claves_califiaciones.='<td style="width:65px"></td>';
            $claves_califiaciones.='<td style="width:50px"></td>';

            $claves_califiaciones.='<td style="width:65px"></td>';
            $claves_califiaciones.='<td style="width:50px"></td>';
        }

        else if(sizeof($materias_regularizadas_con_grupo[$contador-1])==2){
            $claves_califiaciones.='<td style="width:65px"></td>';
            $claves_califiaciones.='<td style="width:50px"></td>';

            $claves_califiaciones.='<td style="width:65px"></td>';
            $claves_califiaciones.='<td style="width:50px"></td>';
        }

        else if(sizeof($materias_regularizadas_con_grupo[$contador-1])==3){
            $claves_califiaciones.='<td style="width:65px"></td>';
            $claves_califiaciones.='<td style="width:50px"></td>';
        }

        $claves="";
        $adeudos = 0;
        //echo sizeof($materias_debe_estudiante_sin_grupo[0]);
        if(sizeof($materias_debe_estudiante_con_grupo[$contador-1])>0){
            foreach($materias_debe_estudiante_con_grupo[$contador-1] as $materia){
            $claves.=$materia->id_materia.",";
            $adeudos+=1;
            }
        }
        
        $claves=trim ($claves,',');

        $ultimo_semestre="";
        $ultimo_grupo="";

        $cadena = explode("-",$datos_frer_estudiante_con_grupo[$contador-1]->ultimo_semestre_cursado);
        $ultimo_semestre=$cadena[0]; // porción semestre
        $ultimo_grupo=$cadena[1]; // porción grupo

        $html.='<tr >
        <td style="width:30px;text-align:center" height="15.5">'.$foliador.'</td>
        <td style="width:85px">'.nombre_grupo($ultimo_semestre).' "'.$ultimo_grupo.'"</td>
        <td style="width:50px">'.$datos_estudiantes_con_grupo[$contador-1]->matricula.'</td>
        <td style="width:100px">'.$datos_estudiantes_con_grupo[$contador-1]->primer_apellido.'</td>
        <td style="width:100px">'.$datos_estudiantes_con_grupo[$contador-1]->segundo_apellido.'</td>
        <td style="width:128px">'.$datos_estudiantes_con_grupo[$contador-1]->nombre.'</td>
        <td style="width:38px;text-align:center" >'.(intval($datos_frer_estudiante_con_grupo[$contador-1]->numero_adeudos)+$aprobadas_sumar).'</td>
        '.$claves_califiaciones.'
        <td style="width:50px;text-align:center">'.($adeudos>0?'2':'1').'</td>
        <td style="width:165px">'.$datos_frer_estudiante_con_grupo[$contador-1]->observaciones.'</td>
        </tr>';
        $contador+=1;
        $foliador+=1;
    }

    ////////////////////////////fin de datos estudinates con grupos



    /////////////////////////// datos de alumnos sin grupo

    $contador=1;//se reinicia cada vez
    $html2="";
    foreach($regularizaciones_sin_grupo as $estudiante){
        $claves_califiaciones="";
        $aprobadas_sumar=0;
        foreach($materias_regularizadas_sin_grupo[$contador-1] as $materia){
            $claves_califiaciones.='<td style="width:65px">'.$materia->id_materia.'</td>';
            $claves_califiaciones.='<td style="width:50px">'.$materia->calificacion.'</td>';

            if(intval($materia->calificacion)>=6){
                $aprobadas_sumar+=1;
            }
        }
        

        if(sizeof($materias_regularizadas_sin_grupo[$contador-1])==1){
            $claves_califiaciones.='<td style="width:65px"></td>';
            $claves_califiaciones.='<td style="width:50px"></td>';

            $claves_califiaciones.='<td style="width:65px"></td>';
            $claves_califiaciones.='<td style="width:50px"></td>';

            $claves_califiaciones.='<td style="width:65px"></td>';
            $claves_califiaciones.='<td style="width:50px"></td>';
        }

        else if(sizeof($materias_regularizadas_sin_grupo[$contador-1])==2){
            $claves_califiaciones.='<td style="width:65px"></td>';
            $claves_califiaciones.='<td style="width:50px"></td>';

            $claves_califiaciones.='<td style="width:65px"></td>';
            $claves_califiaciones.='<td style="width:50px"></td>';
        }

        else if(sizeof($materias_regularizadas_sin_grupo[$contador-1])==3){
            $claves_califiaciones.='<td style="width:65px"></td>';
            $claves_califiaciones.='<td style="width:50px"></td>';
        }

        //materias que debe

        $claves="";
        $adeudos = 0;
        //echo sizeof($materias_debe_estudiante_sin_grupo[0]);
        if(sizeof($materias_debe_estudiante_sin_grupo[$contador-1])>0){
            foreach($materias_debe_estudiante_sin_grupo[$contador-1] as $materia){
            $claves.=$materia->id_materia.",";
            $adeudos+=1;
            }
        }
        
        $claves=trim ($claves,',');

        $ultimo_semestre="";
        $ultimo_grupo="";

        $cadena = explode("-",$datos_frer_estudiante_sin_grupo[$contador-1]->ultimo_semestre_cursado);
        $ultimo_semestre=$cadena[0]; // porción semestre
        $ultimo_grupo=$cadena[1]; // porción grupo


        $html2.='<tr>
        <td style="width:30px;text-align:center" height="15.5">'.$foliador.'</td>
        <td style="width:85px">'.nombre_grupo($ultimo_semestre).' "'.$ultimo_grupo.'"</td>
        <td style="width:50px">'.$datos_estudiantes_sin_grupo[$contador-1]->matricula.'</td>
        <td style="width:100px">'.$datos_estudiantes_sin_grupo[$contador-1]->primer_apellido.'</td>
        <td style="width:100px">'.$datos_estudiantes_sin_grupo[$contador-1]->segundo_apellido.'</td>
        <td style="width:128px">'.$datos_estudiantes_sin_grupo[$contador-1]->nombre.'</td>
        <td style="width:38px;text-align:center">'.(intval($datos_frer_estudiante_sin_grupo[$contador-1]->numero_adeudos)+$aprobadas_sumar).'</td>
        '.$claves_califiaciones.'
        <td style="width:50px;text-align:center">'.($adeudos>0?'2':'1').'</td>
        <td style="width:165px">'.$datos_frer_estudiante_sin_grupo[$contador-1]->observaciones.'</td>
        </tr>';
        $contador+=1;
        $foliador+=1;
    }

    ////////////////////////////fin de datos estudinates con grupos



$cintillo = '<tr><td style="background-color:gray;text-align:center" height="15.5">'.$foliador.'</td>
<td style="background-color:gray"></td>
<td style="background-color:gray"></td>
<td style="background-color:gray"></td>
<td style="background-color:gray"></td>
<td style="background-color:gray"></td>
<td style="background-color:gray"></td>
<td style="background-color:gray"></td>
<td style="background-color:gray"></td>
<td style="background-color:gray"></td>
<td style="background-color:gray"></td>
<td style="background-color:gray"></td>
<td style="background-color:gray"></td>
<td style="background-color:gray"></td>
<td style="background-color:gray"></td>
<td style="background-color:gray"></td>
<td style="background-color:gray"></td>
</tr>';

$filas_faltantes="";

for ($x=$foliador+1;$x<=30;$x++){
    $filas_faltantes .= '<tr><td style="text-align:center" height="15.5">'.$x.'</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                </tr>';

}


$cuerpo_tabla = '
<table border="1" style="font-size:7pt">
<thead>
<tr style="font-size:5 pt;text-align:center">
        <td border="1" style="width:30px;background-color:#f8facb" rowspan="2"><br><br><br>N/P</td>
        <td border="1" style="width:85px;background-color:#f8facb" rowspan="2"><br><br>ÚLTIMO MOD/SEM CURSADO (GRUPO)</td>
        <td border="1" style="width:50px;background-color:#f8facb" rowspan="2"><br><br><br>MATRÍCULA</td>
        <td border="1" style="width:328px;background-color:#f8facb">NOMBRE DEL ALUMNO</td>
        <td border="1" style="width:38px;background-color:#f8facb" rowspan="2"><br><br>NUM. ADEUDOS</td>
        <td border="1" style="width:65px;background-color:#f8facb" rowspan="2"><br><br><br>CLAVE</td>
        <td border="1" style="width:50px;background-color:#f8facb" rowspan="2"><br><br><br>CALIF</td>
        <td border="1" style="width:65px;background-color:#f8facb" rowspan="2"><br><br><br>CLAVE</td>
        <td border="1" style="width:50px;background-color:#f8facb" rowspan="2"><br><br><br>CALIF</td>
        <td border="1" style="width:65px;background-color:#f8facb" rowspan="2"><br><br><br>CLAVE</td>
        <td border="1" style="width:50px;background-color:#f8facb" rowspan="2"><br><br><br>CALIF</td>
        <td border="1" style="width:65px;background-color:#f8facb" rowspan="2"><br><br><br>CLAVE</td>
        <td border="1" style="width:50px;background-color:#f8facb" rowspan="2"><br><br><br>CALIF</td>
        <td border="1" style="width:50px;background-color:#f8facb" rowspan="2"><br><br><br>SIT. ALUM.</td>
        <td border="1" style="width:165px;background-color:#f8facb" rowspan="2"><br><br><br>OBSERVACIONES</td>
        </tr>

        <tr style="font-size:5 pt;text-align:center">
        <td border="1" style="width:100px;background-color:#f8facb"><br><br><br>PRIMER APELLIDO</td>
        <td border="1" style="width:100px;background-color:#f8facb"><br><br><br>SEGUNDO APELLIDO</td>
        <td border="1" style="width:128px;background-color:#f8facb"><br><br><br>NOMBRE(S)</td>
        </tr>
    </thead>
        <tbody>
'.$html.$html2.$cintillo.$filas_faltantes.'
</tbody>
</table>
';

// print a block of text using Write()
// output the HTML content
$pdf->writeHTML($cuerpo_tabla, true, 0, true, true);


//Close and output PDF document
$pdf->Output('FRER.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>