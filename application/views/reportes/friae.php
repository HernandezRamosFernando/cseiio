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
/*		
		// Logo
		//$image_file =base_url().'assets/img/cabecera.png';
		$this->Image($image_file, 110, 10, 90, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

		//$image_file =base_url().'assets/img/ladoderecho.png';
		$this->Image($image_file, 190, 50, 15, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);


		// Set font
		$this->SetFont('helvetica', 'B',6);


		$image_file =base_url().'assets/img/fondocseiio.png';
		$this->Image($image_file,60,90,86,'', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);


		// Titulo
		$this->SetXY(25,31);
		$this->Cell(0,0, '"2019, AÑO POR LA ERRADICACIÓN DE LA VIOLENCIA CONTRA LA MUJER"', 0, false, 'C', 0, '', 0, false, 'M', 'M');
*/
		
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

function filas_vacias_califiacion($materias){
    $numero_materias=sizeof($materias[0]);

    if($numero_materias==14){
        return $html_catorce_columnas='
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
        ';
    }

    if($numero_materias==13){
        return $html_trece_columnas='
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
        ';
    }

    if($numero_materias==12){
        return $html_doce_columnas='
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
        ';
    }

    if($numero_materias==9){
        return $html_nueve_columnas='
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        ';
    }

    if($numero_materias==8){
        return $html_ocho_columnas='
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        ';
    }

    else{
        return "";
    }

}

 function celdas_materias($materias){
    $numero_materias=sizeof($materias[0]);

    if($numero_materias==14){
        return $html_catorce_columnas='
        <td style="width:28px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][0]->id_materia.'</td>
        <td style="width:28px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][1]->id_materia.'</td>
        <td style="width:28px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][2]->id_materia.'</td>
        <td style="width:28px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][3]->id_materia.'</td>
        <td style="width:28px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][4]->id_materia.'</td>
        <td style="width:28px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][5]->id_materia.'</td>
        <td style="width:28px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][6]->id_materia.'</td>
        <td style="width:28px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][7]->id_materia.'</td>
        <td style="width:28px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][8]->id_materia.'</td>
        <td style="width:28px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][9]->id_materia.'</td>
        <td style="width:28px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][10]->id_materia.'</td>
        <td style="width:28px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][11]->id_materia.'</td>
        <td style="width:28px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][12]->id_materia.'</td>
        <td style="width:28px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][13]->id_materia.'</td>
        ';
    }


    if($numero_materias==13){
        return $html_trece_columnas='
        <td style="width:28px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][0]->id_materia.'</td>
        <td style="width:28px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][1]->id_materia.'</td>
        <td style="width:28px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][2]->id_materia.'</td>
        <td style="width:28px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][3]->id_materia.'</td>
        <td style="width:28px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][4]->id_materia.'</td>
        <td style="width:28px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][5]->id_materia.'</td>
        <td style="width:28px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][6]->id_materia.'</td>
        <td style="width:28px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][7]->id_materia.'</td>
        <td style="width:28px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][8]->id_materia.'</td>
        <td style="width:28px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][9]->id_materia.'</td>
        <td style="width:28px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][10]->id_materia.'</td>
        <td style="width:28px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][11]->id_materia.'</td>
        <td style="width:28px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][12]->id_materia.'</td>
        ';
    }

    if($numero_materias==12){
        return $html_doce_columnas='
        <td style="width:31px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][0]->id_materia.'</td>
        <td style="width:31px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][1]->id_materia.'</td>
        <td style="width:31px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][2]->id_materia.'</td>
        <td style="width:31px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][3]->id_materia.'</td>
        <td style="width:31px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][4]->id_materia.'</td>
        <td style="width:31px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][5]->id_materia.'</td>
        <td style="width:31px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][6]->id_materia.'</td>
        <td style="width:31px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][7]->id_materia.'</td>
        <td style="width:31px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][8]->id_materia.'</td>
        <td style="width:31px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][9]->id_materia.'</td>
        <td style="width:31px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][10]->id_materia.'</td>
        <td style="width:31px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][11]->id_materia.'</td>
        ';
    }

    if($numero_materias==9){
        return $html_nueve_columnas='
        <td style="width:41px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][0]->id_materia.'</td>
        <td style="width:41px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][1]->id_materia.'</td>
        <td style="width:41px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][2]->id_materia.'</td>
        <td style="width:41px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][3]->id_materia.'</td>
        <td style="width:41px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][4]->id_materia.'</td>
        <td style="width:41px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][5]->id_materia.'</td>
        <td style="width:41px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][6]->id_materia.'</td>
        <td style="width:41px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][7]->id_materia.'</td>
        <td style="width:41px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][8]->id_materia.'</td>
        ';
    }

    if($numero_materias==8){
        return $html_ocho_columnas='
        <td style="width:46px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][0]->id_materia.'</td>
        <td style="width:46px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][1]->id_materia.'</td>
        <td style="width:46px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][2]->id_materia.'</td>
        <td style="width:46px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][3]->id_materia.'</td>
        <td style="width:46px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][4]->id_materia.'</td>
        <td style="width:46px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][5]->id_materia.'</td>
        <td style="width:46px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][6]->id_materia.'</td>
        <td style="width:46px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][7]->id_materia.'</td>
        ';
    }

    else{
        return "";
    }
}



$medidas = array(279.4,431.8);
// create new PDF document
$pdf = new MYPDF('L', 'mm',$medidas, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Control Escolar CSEIIO');
$pdf->SetTitle('FRIAE');
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
$pdf->SetMargins(20, 5,19);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 5);

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

/////CONVIERTE LAS CALIFICACIONES A LETRAS
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


//carga los datos de los renglones de la tabla
$contador=0;

$filas_faltantes = 35-sizeof($datos_estudiante);
$filas_faltantes_html="";
if($filas_faltantes>0){
for($i=0;$i<$filas_faltantes;$i++){
$filas_faltantes_html.='<tr>
<td> </td>
<td> </td>
<td> </td>
<td> </td>
<td> </td>
<td> </td>
<td> </td>
<td> </td>
<td> </td>
<td> </td>
<td> </td>
<td> </td>
<td> </td>
<td> </td>'.filas_vacias_califiacion($materias_estudiantes).'
<td> </td>
<td> </td>
<td> </td>
<td> </td>
<td> </td>
<td> </td>
<td> </td>
<td> </td>
</tr>';
}
}

else{
    $filas_faltantes_html="";
}


$html_pos_materias='
<td style="width:40px;background-color:#f8facb">SIT. ALUM. FIN DEL MODULO</td>
<td style="width:25px;background-color:#f8facb">NUMERO ADEUDOS AL FIN DEL MODULO(todos los modulos cursados y actual) antes de periodo de regularizacion</td>
<td style="width:70px;background-color:#f8facb">CLAVE U.C. DE ADEUDOS FIN DEL MODULO(todos los modulos cursados y actual antes de periodo de regularizacion)</td>
<td style="width:25px;background-color:#f8facb">NUMERO ADEUDOS DE TODOS LOS MODULOS CURSADOS (despues del periodo de regularizacion)</td>
<td style="width:70px;background-color:#f8facb">CLAVE U.C. DE ADEUDOS EN TODOS LOS MODULOS CURSADOS (despues del periodo de regularizacion)</td>
<td style="width:40px;background-color:#f8facb">SIT. ALUM. DESPUES DEL PERIODO DE REGULARIZACION</td>
<td style="width:40px;background-color:#f8facb">FECHA DE BAJA</td>
<td style="width:40px;background-color:#f8facb">FECHA DE NACIMIENTO</td>
';

////////////////////////////////////////////////////////

$registros_html='';
foreach($datos_estudiante as $estudiante){
//$renglon ='<tr style="font-size:5 pt;text-align:center">';
$renglon = '';
$renglon.='<td height="15">'.($contador+1).'</td>';//np
$renglon.='<td>'.$estudiante->matricula.'</td>';//matricula estudiante
$renglon.='<td>'.$estudiante->curp.'</td>';//curp estudiante
$renglon.='<td>'.$estudiante->sexo.'</td>';//sexo
$renglon.='<td>'.$estudiante->primer_apellido.'</td>';//primer apellido
$renglon.='<td>'.$estudiante->segundo_apellido.'</td>';//segundo apellido
$renglon.='<td>'.$estudiante->nombre.'</td>';//nombre estudiante

//calculo de su edad
$fecha_nacimiento = new DateTime($estudiante->fecha_nacimiento);
$fecha_actual = new DateTime(date("Y-m-d"));
$dias = $fecha_actual->diff($fecha_nacimiento);
$edad = intval(($dias->days)/365);
//////
$renglon.='<td>'.$edad.'</td>';//edad estudiante

if($datos_friae->semestre!='1'){
    if($datos_friae_estudiante[$contador][0]->tipo_ingreso_inscripcion=="INCORPORADO"){
        $renglon.='<td>I</td>';//tipo ingreso estudiante
    }

    else if($datos_friae_estudiante[$contador][0]->tipo_ingreso_inscripcion=="TRASLADO"){
        $renglon.='<td>T</td>';//tipo ingreso estudiante
    }

    else if($datos_friae_estudiante[$contador][0]->tipo_ingreso_inscripcion=="PORTABILIDAD"){
        $renglon.='<td>P.E.</td>';//tipo ingreso estudiante
    }

    else if($datos_friae_estudiante[$contador][0]->tipo_ingreso_inscripcion=="REPETIDOR"){
        $renglon.='<td>R</td>';//tipo ingreso estudiante
    }

    else if($datos_friae_estudiante[$contador][0]->tipo_ingreso_inscripcion=="REINGRESO"){
        $renglon.='<td></td>';//tipo ingreso estudiante
    }
    
    if($datos_friae_estudiante[$contador][0]->estatus_inscripcion=="REGULAR"){
        $renglon.='<td>1</td>';//tipo ingreso estudiante
    }

    else if($datos_friae_estudiante[$contador][0]->estatus_inscripcion=="IRREGULAR"){
        $renglon.='<td>2</td>';//tipo ingreso estudiante
    }

    else{
        $renglon.='<td></td>';//tipo ingreso estudiante
    }

    

    $renglon.='<td>'.$datos_friae_estudiante[$contador][0]->numero_adeudos_inscripcion.'</td>';//tipo ingreso estudiante
    $renglon.='<td>'.$datos_friae_estudiante[$contador][0]->id_materia_adeudos_inscripcion.'</td>';//tipo ingreso estudiante
    $renglon.='<td>'.$datos_friae_estudiante[$contador][0]->adeudos_primera_regularizacion.'</td>';//tipo ingreso estudiante
    $renglon.='<td>'.$datos_friae_estudiante[$contador][0]->id_materia_adeudos_primera_regularizacion.'</td>';//tipo ingreso estudiante
}

else{
    $renglon.='<td>'.($datos_friae_estudiante[$contador][0]->tipo_ingreso_inscripcion=="REPETIDOR"?"R":"").'</td>';//tipo ingreso estudiante
}



///------------------aqui se van a cargar las materias del estudiante

foreach($materias_estudiantes[$contador] as $materia){
    if($datos_friae_estudiante[$contador][0]->tipo_ingreso_fin_semestre!="BAJA" && $materia->calificacion_final==""){
        $promedio_modular = (intval($materia->primer_parcial)+intval($materia->segundo_parcial)+intval($materia->tercer_parcial))/3;
        $promedio_final = (intval($materia->examen_final)+$promedio_modular)/2;
        $promedio_final = round($promedio_final,0,PHP_ROUND_HALF_UP);
        if($materia->tipo=='EXTRAESCOLAR'){
            $renglon.='<td>'.extraescolar($promedio_final).'</td>';
        }

        else{
            $renglon.='<td>'.$promedio_final.'</td>';
        }
        
    }

    else{
        if($materia->tipo=='EXTRAESCOLAR'){
            $renglon.='<td>'.extraescolar($materia->calificacion_final).'</td>';
        }

        else{
            $renglon.='<td>'.$materia->calificacion_final.'</td>';
        }
    }

}


if($datos_friae_estudiante[$contador][0]->tipo_ingreso_fin_semestre=='REINGRESO'){
    if(intval($datos_friae_estudiante[$contador][0]->adeudos_fin_semestre)>0){
        $renglon.='<td>2</td>';//tipo ingreso estudiante
    }

    else{
        $renglon.='<td>1</td>';//tipo ingreso estudiante
    }
    
}

else if($datos_friae_estudiante[$contador][0]->tipo_ingreso_fin_semestre=='BAJA'){
    $renglon.='<td>3</td>';//tipo ingreso estudiante
    //$renglon ='<tr style="font-size:5 pt;text-align:center";background-color:gray>'.$renglon;
}

else if($datos_friae_estudiante[$contador][0]->tipo_ingreso_fin_semestre==''){
    $renglon.='<td></td>';//tipo ingreso estudiante
}

else if($datos_friae_estudiante[$contador][0]->tipo_ingreso_fin_semestre=='REPROBADO'){
    $renglon.='<td>4</td>';//tipo ingreso estudiante
}

else if($datos_friae_estudiante[$contador][0]->tipo_ingreso_fin_semestre=='SIN DERECHO'){
    $renglon.='<td>2</td>';//tipo ingreso estudiante
}







if($datos_friae_estudiante[$contador][0]->tipo_ingreso_fin_semestre=='REPROBADO'){
    $renglon.='<td></td>';//tipo ingreso estudiante
    $renglon.='<td></td>';//tipo ingreso estudiante
    $renglon.='<td></td>';//tipo ingreso estudiante
    $renglon.='<td></td>';//tipo ingreso estudiante
    $renglon.='<td></td>';//tipo ingreso estudiante
}

else{

$renglon.='<td>'.$datos_friae_estudiante[$contador][0]->adeudos_fin_semestre.'</td>';//tipo ingreso estudiante
$renglon.='<td>'.$datos_friae_estudiante[$contador][0]->id_materia_adeudos_fin_semestre.'</td>';//tipo ingreso estudiante

$renglon.='<td>'.$datos_friae_estudiante[$contador][0]->adeudos_segunda_regularizacion.'</td>';//tipo ingreso estudiante
$renglon.='<td>'.$datos_friae_estudiante[$contador][0]->id_materia_adeudos_segunda_regularizacion.'</td>';//tipo ingreso estudiante

if($datos_friae_estudiante[$contador][0]->tipo_ingreso_despues_regularizacion=="REINGRESO"){

    if(intval($datos_friae_estudiante[$contador][0]->adeudos_segunda_regularizacion)>0){
        $renglon.='<td>2</td>';//tipo ingreso estudiante
    }
    else{
        $renglon.='<td>1</td>';//tipo ingreso estudiante
    }
    
}



else if($datos_friae_estudiante[$contador][0]->tipo_ingreso_despues_regularizacion=="SIN DERECHO"){
    $renglon.='<td>S/D</td>';//tipo ingreso estudiante
}

else if($datos_friae_estudiante[$contador][0]->tipo_ingreso_despues_regularizacion=="REPROBADO"){
    $renglon.='<td></td>';//tipo ingreso estudiante
}


else if($datos_friae_estudiante[$contador][0]->tipo_ingreso_despues_regularizacion=="BAJA" || $datos_friae_estudiante[$contador][0]->tipo_ingreso_despues_regularizacion==""){
    $renglon.='<td></td>';//tipo ingreso estudiante
}


}

$renglon.='<td>'.$datos_friae_estudiante[$contador][0]->baja.'</td>';//tipo ingreso estudiante
$renglon.='<td>'.$estudiante->fecha_nacimiento.'</td>';//matricula estudiante


//
$renglon.='</tr>';

//<tr style="font-size:5 pt;text-align:center">
if($datos_friae_estudiante[$contador][0]->tipo_ingreso_fin_semestre=='BAJA'){
$renglon = '<tr style="font-size:5 pt;text-align:center;background-color:#ececec">'.$renglon;
}

else{
    $renglon = '<tr style="font-size:5 pt;text-align:center">'.$renglon;
}
$registros_html.=$renglon;
$contador+=1;
}

/////////////////////////////////////

function primer_semestre($semestre,$materias_estudiantes,$html_pos_materias){        

    if($semestre=='1'){

        return '<tr style="font-size:4 pt;text-align:center">
<td style="width:20px;background-color:#f8facb"><br><br><br><br><br>N/P</td>
<td style="width:35px;background-color:#f8facb"><br><br><br><br><br>MATRICULA</td>
<td style="width:75px;background-color:#f8facb"><br><br><br><br><br>CURP</td>
<td style="width:20px;background-color:#f8facb"><br><br><br><br><br>SEXO</td>
<td style="width:70px;background-color:#f8facb"><br><br><br><br><br>PRIMER APELLIDO</td>
<td style="width:70px;background-color:#f8facb"><br><br><br><br><br>SEGUNDO APELLIDO</td>
<td style="width:85px;background-color:#f8facb"><br><br><br><br><br>NOMBRE(S)</td>
<td style="width:25px;background-color:#f8facb"><br><br><br><br>EDAD ACTUAL</td>
<td style="width:50px;background-color:#f8facb"><br><br><br><br><br>SITUACION ALUMNO</td>
'.celdas_materias($materias_estudiantes).$html_pos_materias.'
</tr>';

    }

    else{
        
        
        $regreso = '<tr style="font-size:4 pt;text-align:center">
        <td style="width:20px;background-color:#f8facb"><br><br><br><br><br>N/P</td>
        <td style="width:35px;background-color:#f8facb"><br><br><br><br><br>MATRICULA</td>
        <td style="width:75px;background-color:#f8facb"><br><br><br><br><br>CURP</td>
        <td style="width:20px;background-color:#f8facb"><br><br><br><br><br>SEXO</td>
        <td style="width:70px;background-color:#f8facb"><br><br><br><br><br>PRIMER APELLIDO</td>
        <td style="width:70px;background-color:#f8facb"><br><br><br><br><br>SEGUNDO APELLIDO</td>
        <td style="width:85px;background-color:#f8facb"><br><br><br><br><br>NOMBRE(S)</td>
        <td style="width:25px;background-color:#f8facb"><br><br><br><br>EDAD ACTUAL</td>
        <td style="width:50px;background-color:#f8facb"><br><br><br><br><br>TIPO INGRESO</td>
        <td style="width:40px;background-color:#f8facb"><br><br><br><br>ESTATUS INICIO DEL SEMESTRE</td>
        <td style="width:25px;background-color:#f8facb"><br>NUMERO DE ADEUDOS INICIO DEL SEMESTRE</td>
        <td style="width:70px;background-color:#f8facb"><br><br><br><br>CLAVE U.C. ADEUDOS SEMESTRES ANTERIORES</td>';

        if($semestre=="1" || $semestre=="3" || $semestre=="5"){
            $regreso.='<td style="width:25px;background-color:#f8facb">NUMERO DE ADEUDOS DESPUES DE REGULARIZACION DE OCTUBRE</td>
            <td style="width:70px;background-color:#f8facb"><br><br><br>CLAVE U.C. ADEUDOS DESPUES DE LA REGULARIZACION DE OCTUBRE</td>'.celdas_materias($materias_estudiantes).$html_pos_materias.'
            </tr>';
            
        }

        else{
            $regreso.='<td style="width:25px;background-color:#f8facb">NUMERO DE ADEUDOS DESPUES DE REGULARIZACION DE MAYO</td>
            <td style="width:70px;background-color:#f8facb"><br><br><br>CLAVE U.C. ADEUDOS DESPUES DE LA REGULARIZACION DE MAYO</td>'.celdas_materias($materias_estudiantes).$html_pos_materias.'
            </tr>';
        }

        return $regreso;

     
    }

}

//carga los datos de encabezados
$pre_materias ='
<h5 style="text-align:center">COLEGIO SUPERIOR PARA LA EDUCACION INTEGRAL INTERCULTURAL DE OAXACA</h5>
<p style="text-align:center">DEPARTAMENTO DE CONTROL ESCOLAR</p>
<h5 style="text-align:center;background-color:#e9e9e9">FORMATO DE REGISTRO DE INSCRIPCION Y ACREDITACION ESCOLAR</h5>

<table>
<tbody>
<tr>
<td>Nombre del Plantel:'.$datos_friae->nombre_plantel.'</td>
<td style="text-align:right">Ciclo escolar:'.$datos_friae->nombre_ciclo_escolar.'</td>
</tr>

<tr>
<td>Clave cct:'.$datos_friae->cct_plantel.'</td>
<td style="text-align:right">Semestre:'.$datos_friae->semestre.'</td>
</tr>

<tr>
<td>Localidad y municipio:'.$datos_friae->nombre_localidad.','.$datos_friae->nombre_municipio.'</td>
<td style="text-align:right">Grupo:'.$datos_friae->nombre_grupo.'</td>
</tr>

<tr>
<td> </td>
<td> </td>
</tr>

</tbody>
</table>

<table border="1">
<tbody>'.primer_semestre($datos_friae->semestre,$materias_estudiantes,$html_pos_materias).$registros_html.'
</tbody>
</table>
';


$firmas = '
<table style="font-size:6pt">
<tbody>
<tr>
<td><p>'.$director.'</p><p>_________________________</p><p>NOMBRE Y FIRMA DEL DIRETOR(A)</p><p>DEL PLANTEL</p></td>
<td><p></p><p>_________________________</p><p>SELLO DEL PLANTEL</p></td>
<td><p>DAVID ERNESTO HERNANDEZ AVENDAÑO</p><p>_________________________</p><p>JEFE DEL DEPARTAMENTO DE</p><p>CONTROL ESCOLAR</p></td>
<td><p></p><p>_________________________</p><p>SELLO CONTROL ESCOLAR</p></td>
<td><p></p><p>_________________________</p><p>REVISO Y VALIDO</p></td>
</tr>
</tbody>
</table>
';




// print a block of text using Write()
// output the HTML content
$pdf->writeHTML($pre_materias, true, 0, true, true);
$pdf->writeHTMLCell($w = 0, $h = 20, $x = '20', $y = '250', $firmas, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);


//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>