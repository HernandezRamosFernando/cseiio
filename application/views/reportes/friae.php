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
		$image_file =base_url().'assets/img/logo_cseiio2.png';
        $this->Image($image_file, 20, 10, 41, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

       
        
        $image_file =base_url().'assets/img/logo_gobierno.png';
		$this->Image($image_file, 397, 10, 13, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

/*		//$image_file =base_url().'assets/img/ladoderecho.png';
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
        <td style="width:26px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][0]->id_materia.'</td>
        <td style="width:26px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][1]->id_materia.'</td>
        <td style="width:26px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][2]->id_materia.'</td>
        <td style="width:26px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][3]->id_materia.'</td>
        <td style="width:26px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][4]->id_materia.'</td>
        <td style="width:26px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][5]->id_materia.'</td>
        <td style="width:26px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][6]->id_materia.'</td>
        <td style="width:26px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][7]->id_materia.'</td>
        <td style="width:26px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][8]->id_materia.'</td>
        <td style="width:26px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][9]->id_materia.'</td>
        <td style="width:26px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][10]->id_materia.'</td>
        <td style="width:26px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][11]->id_materia.'</td>
        <td style="width:26px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][12]->id_materia.'</td>
        <td style="width:26px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][13]->id_materia.'</td>
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
        <td style="width:30.33px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][0]->id_materia.'</td>
        <td style="width:30.33px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][1]->id_materia.'</td>
        <td style="width:30.33px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][2]->id_materia.'</td>
        <td style="width:30.33px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][3]->id_materia.'</td>
        <td style="width:30.33px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][4]->id_materia.'</td>
        <td style="width:30.33px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][5]->id_materia.'</td>
        <td style="width:30.33px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][6]->id_materia.'</td>
        <td style="width:30.33px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][7]->id_materia.'</td>
        <td style="width:30.33px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][8]->id_materia.'</td>
        <td style="width:30.33px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][9]->id_materia.'</td>
        <td style="width:30.33px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][10]->id_materia.'</td>
        <td style="width:30.33px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][11]->id_materia.'</td>
        ';
    }

    if($numero_materias==9){
        return $html_nueve_columnas='
        <td style="width:40.44px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][0]->id_materia.'</td>
        <td style="width:40.44px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][1]->id_materia.'</td>
        <td style="width:40.44px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][2]->id_materia.'</td>
        <td style="width:40.44px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][3]->id_materia.'</td>
        <td style="width:40.44px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][4]->id_materia.'</td>
        <td style="width:40.44px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][5]->id_materia.'</td>
        <td style="width:40.44px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][6]->id_materia.'</td>
        <td style="width:40.44px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][7]->id_materia.'</td>
        <td style="width:40.44px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][8]->id_materia.'</td>
        ';
    }

    if($numero_materias==8){
        return $html_ocho_columnas='
        <td style="width:45.5px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][0]->id_materia.'</td>
        <td style="width:45.5px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][1]->id_materia.'</td>
        <td style="width:45.5px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][2]->id_materia.'</td>
        <td style="width:45.5px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][3]->id_materia.'</td>
        <td style="width:45.5px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][4]->id_materia.'</td>
        <td style="width:45.5px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][5]->id_materia.'</td>
        <td style="width:45.5px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][6]->id_materia.'</td>
        <td style="width:45.5px;background-color:#f8facb"><br><br><br><br><br>'.$materias[0][7]->id_materia.'</td>
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
if($datos_friae->semestre!=1){
    $pdf->SetMargins(7,15,7); // Este formato se aplica a partir del 2 semestre
}
else{
    $pdf->SetMargins(20,15,19); //Este formato se aplica unicamente para el 1 semestre
}
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


/**Función que convierte segun numero en la palabra baja para alumnos con ese estatus */
function convierte_palabra($posicion,$contador_materias){
    $regreso = "";
    if($contador_materias==8){
        switch(intval($posicion)){
            case 1:
            $regreso = "B";
            break;
    
            case 3:
            $regreso = "A";
            break;
    
            case 5:
            $regreso = "J";
            break;
    
            case 8:
            $regreso = "A";
            break;
        }

    }
    if($contador_materias==9){
        switch(intval($posicion)){
            case 1:
            $regreso = "B";
            break;
    
            case 3:
            $regreso = "A";
            break;
    
            case 6:
            $regreso = "J";
            break;
    
            case 9:
            $regreso = "A";
            break;
        }

    }

    if($contador_materias==12){
        switch(intval($posicion)){
            case 1:
            $regreso = "B";
            break;
    
            case 4:
            $regreso = "A";
            break;
    
            case 8:
            $regreso = "J";
            break;
    
            case 12:
            $regreso = "A";
            break;
        }

    }

    if($contador_materias==13){
        switch(intval($posicion)){
            case 1:
            $regreso = "B";
            break;
    
            case 5:
            $regreso = "A";
            break;
    
            case 9:
            $regreso = "J";
            break;
    
            case 13:
            $regreso = "A";
            break;
        }

    }

    if($contador_materias==14){
        switch(intval($posicion)){
            case 1:
            $regreso = "B";
            break;
    
            case 5:
            $regreso = "A";
            break;
    
            case 9:
            $regreso = "J";
            break;
    
            case 14:
            $regreso = "A";
            break;
        }

    }
    

    return $regreso;
}





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


function nombre_modulo($num_modulo){
    $regreso = "";
    switch(intval($num_modulo)){
        case 1:
        $regreso = "PRIMERO";
        break;

        case 2:
        $regreso = "SEGUNDO";
        break;

        case 3:
        $regreso = "TERCERO";
        break;

        case 4:
        $regreso = "CUARTO";
        break;

        case 5:
        $regreso = "QUINTO";
        break;

        case 6:
        $regreso = "SEXTO";
        break;
    }

    return $regreso;
}


//carga los datos de los renglones de la tabla
$contador=0;

$filas_faltantes = 35-sizeof($datos_estudiante);
$num_fila= sizeof($datos_estudiante);
$filas_faltantes_html="";
if($filas_faltantes>0){
for($i=0;$i<$filas_faltantes;$i++){

    if($i==0){
        $filas_faltantes_html.='<tr style="background-color:#909090;font-size:5 pt;text-align:center">';
    }
    else{
        $filas_faltantes_html.='<tr style="font-size:5 pt;text-align:center">';
    }
    $num_fila=$num_fila+1;

    if($datos_friae->semestre!=1){
        $filas_faltantes_html.='
        <td height="15"> '.$num_fila.'</td>
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
    else{
       $filas_faltantes_html.='
        <td height="15"> '.$num_fila.'</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>'.filas_vacias_califiacion($materias_estudiantes).'
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


}
}

else{
    $filas_faltantes_html="";
}


$html_pos_materias='
<td style="width:30px;background-color:#f8facb">NÚMERO DE ADEUDOS AL FIN DEL MÓDULO (todos los módulos cursados y actual) antes de periodo de regularización</td>
<td style="width:120px;background-color:#f8facb"><br><br><br><br><br>CLAVE DE U.C. DE ADEUDOS FIN DEL MÓDULO(todos los módulos cursados y actual antes de periodo de regularización)</td>
<td style="width:30px;background-color:#f8facb">NÚMERO DE ADEUDOS EN TODOS LOS MÓDULOS CURSADOS (después del periodo de regularización)</td>
<td style="width:100px;background-color:#f8facb"><br><br><br><br><br>CLAVE U.C. DE ADEUDOS EN TODOS LOS MÓDULOS CURSADOS (después del periodo de regularización)</td>
<td style="width:30px;background-color:#f8facb"><br><br><br><br><br>SIT. ALUM. DESPUÉS DEL PERIODO DE REGULARIZACIÓN</td> ';

if($datos_friae->semestre==1){
    $html_pos_materias='
<td style="width:38px;background-color:#f8facb">NÚMERO DE ADEUDOS AL FIN DEL MÓDULO (todos los módulos cursados y actual) antes de periodo de regularización</td>
<td style="width:140px;background-color:#f8facb"><br><br><br><br><br>CLAVE DE U.C. DE ADEUDOS FIN DEL MÓDULO(todos los módulos cursados y actual antes de periodo de regularización)</td>
<td style="width:37px;background-color:#f8facb">NÚMERO DE ADEUDOS EN TODOS LOS MÓDULOS CURSADOS (después del periodo de regularización)</td>
<td style="width:140px;background-color:#f8facb"><br><br><br><br><br>CLAVE U.C. DE ADEUDOS EN TODOS LOS MÓDULOS CURSADOS (después del periodo de regularización)</td>
<td style="width:30px;background-color:#f8facb"><br><br>SIT. ALUM. DESPUÉS DEL PERIODO DE REGULARIZACIÓN</td> ';
}

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
$renglon.='<td style="width:25px">'.$edad.'</td>';//edad estudiante

if($datos_friae->semestre!='1'){
    if($datos_friae_estudiante[$contador][0]->tipo_ingreso_inscripcion=="INCORPORADO"){
        $renglon.='<td style="width:25px">I</td>';//tipo ingreso estudiante
    }

    else if($datos_friae_estudiante[$contador][0]->tipo_ingreso_inscripcion=="TRASLADO"){
        $renglon.='<td style="width:25px">T</td>';//tipo ingreso estudiante
    }

    else if($datos_friae_estudiante[$contador][0]->tipo_ingreso_inscripcion=="PORTABILIDAD"){
        $renglon.='<td style="width:25px">P.E.</td>';//tipo ingreso estudiante
    }

    else if($datos_friae_estudiante[$contador][0]->tipo_ingreso_inscripcion=="REPETIDOR"){
        $renglon.='<td style="width:25px">R</td>';//tipo ingreso estudiante
    }

    else if($datos_friae_estudiante[$contador][0]->tipo_ingreso_inscripcion=="REINGRESO"){
        $renglon.='<td style="width:25px"></td>';//tipo ingreso estudiante
    }
    
    if($datos_friae_estudiante[$contador][0]->estatus_inscripcion=="REGULAR"){
        $renglon.='<td style="width:40px">1</td>';//tipo ingreso estudiante
    }

    else if($datos_friae_estudiante[$contador][0]->estatus_inscripcion=="IRREGULAR"){
        $renglon.='<td style="width:40px">2</td>';//tipo ingreso estudiante
    }

    else{
        $renglon.='<td style="width:40px"></td>';//tipo ingreso estudiante
    }

    

    $renglon.='<td>'.(($datos_friae_estudiante[$contador][0]->numero_adeudos_inscripcion==0)?"":$datos_friae_estudiante[$contador][0]->numero_adeudos_inscripcion).'</td>';//tipo ingreso estudiante
    $renglon.='<td>'.$datos_friae_estudiante[$contador][0]->id_materia_adeudos_inscripcion.'</td>';//tipo ingreso estudiante
    $renglon.='<td>'.(($datos_friae_estudiante[$contador][0]->adeudos_primera_regularizacion==0)?"":$datos_friae_estudiante[$contador][0]->adeudos_primera_regularizacion).'</td>';//tipo ingreso estudiante
    $renglon.='<td>'.$datos_friae_estudiante[$contador][0]->id_materia_adeudos_primera_regularizacion.'</td>';//tipo ingreso estudiante
}

else{
    $renglon.='<td style="width:50px">'.($datos_friae_estudiante[$contador][0]->tipo_ingreso_inscripcion=="REPETIDOR"?"R":"").'</td>';//tipo ingreso estudiante
}



///------------------aqui se van a cargar las materias del estudiante
$contador_fila=1;
$contador_materias=sizeof($materias_estudiantes[$contador]);
foreach($materias_estudiantes[$contador] as $materia){
    if($datos_friae_estudiante[$contador][0]->tipo_ingreso_fin_semestre!="BAJA" && $materia->calificacion_final==""){
        /**$promedio_modular = (intval($materia->primer_parcial)+intval($materia->segundo_parcial)+intval($materia->tercer_parcial))/3;
        $promedio_final = (intval($materia->examen_final)+$promedio_modular)/2;
        $promedio_final = round($promedio_final,0,PHP_ROUND_HALF_UP);
        if($materia->tipo=='EXTRAESCOLAR'){
            $renglon.='<td>'.extraescolar($promedio_final).'</td>';
        }

        else{
            $promedio_final=($promedio_final==0) ? "" : $promedio_final;
            $renglon.='<td>'.$promedio_final.'</td>';
        }*/
        $renglon.='<td></td>';
    }

    else{
        if($materia->tipo=='EXTRAESCOLAR'){
            
            if($datos_friae_estudiante[$contador][0]->tipo_ingreso_fin_semestre=="BAJA"){
                    $renglon.='<td>'.convierte_palabra($contador_fila,$contador_materias).'</td>';
                $contador_fila++;
                
            }
            else{
                $renglon.='<td>'.extraescolar($materia->calificacion_final).'</td>';
            }

        }

        else{
            if($datos_friae_estudiante[$contador][0]->tipo_ingreso_fin_semestre=="BAJA"){
                    $renglon.='<td>'.convierte_palabra($contador_fila,$contador_materias).'</td>';
                    $contador_fila++;
                
            }
            else{
                $renglon.='<td>'.$materia->calificacion_final.'</td>';
            }
            
            
        }
    }

}


if($datos_friae_estudiante[$contador][0]->tipo_ingreso_fin_semestre=='REINGRESO'){
    if(intval($datos_friae_estudiante[$contador][0]->adeudos_fin_semestre)>0){
        $renglon.='<td style="width:40px;">2</td>';//tipo ingreso estudiante
    }

    else{
        $renglon.='<td style="width:40px;">1</td>';//tipo ingreso estudiante
    }
    
}

else if($datos_friae_estudiante[$contador][0]->tipo_ingreso_fin_semestre=='BAJA'){
    $renglon.='<td style="width:40px;">3</td>';//tipo ingreso estudiante
    //$renglon ='<tr style="font-size:5 pt;text-align:center";background-color:gray>'.$renglon;
}

else if($datos_friae_estudiante[$contador][0]->tipo_ingreso_fin_semestre==''){
    $renglon.='<td style="width:40px;"></td>';//tipo ingreso estudiante
}

else if($datos_friae_estudiante[$contador][0]->tipo_ingreso_fin_semestre=='REPROBADO'){
    $renglon.='<td style="width:40px;">4</td>';//tipo ingreso estudiante
}

else if($datos_friae_estudiante[$contador][0]->tipo_ingreso_fin_semestre=='SIN DERECHO'){
    $renglon.='<td style="width:40px;">2</td>';//tipo ingreso estudiante
}







if($datos_friae_estudiante[$contador][0]->tipo_ingreso_fin_semestre=='REPROBADO'){
    $renglon.='<td style="">'.(($datos_friae_estudiante[$contador][0]->adeudos_fin_semestre==0)?"":$datos_friae_estudiante[$contador][0]->adeudos_fin_semestre).'</td>';//tipo ingreso estudiante
    $renglon.='<td></td>';//tipo ingreso estudiante
    $renglon.='<td></td>';//tipo ingreso estudiante
    $renglon.='<td></td>';//tipo ingreso estudiante
    $renglon.='<td></td>';//tipo ingreso estudiante
}

else{

$renglon.='<td>'.(($datos_friae_estudiante[$contador][0]->adeudos_fin_semestre==0)?"":$datos_friae_estudiante[$contador][0]->adeudos_fin_semestre).'</td>';//tipo ingreso estudiante
$renglon.='<td>'.$datos_friae_estudiante[$contador][0]->id_materia_adeudos_fin_semestre.'</td>';//tipo ingreso estudiante

$adeudos_segunda_regularizacion='';
$id_materia_adeudos_segunda_regularizacion='';

if($datos_friae_estudiante[$contador][0]->tipo_ingreso_fin_semestre!="BAJA"){
    $adeudos_segunda_regularizacion=($datos_friae_estudiante[$contador][0]->adeudos_segunda_regularizacion==0)?"":$datos_friae_estudiante[$contador][0]->adeudos_segunda_regularizacion;

    $id_materia_adeudos_segunda_regularizacion=$datos_friae_estudiante[$contador][0]->id_materia_adeudos_segunda_regularizacion;
}

$renglon.='<td>'.$adeudos_segunda_regularizacion.'</td>';//tipo ingreso estudiante
$renglon.='<td>'.$id_materia_adeudos_segunda_regularizacion.'</td>';//tipo ingreso estudiante

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


$fecha_baja="";
if($datos_friae_estudiante[$contador][0]->baja!=''){
    $fecha_baja=date("d/m/Y", strtotime($datos_friae_estudiante[$contador][0]->baja));
}


$renglon.='<td style="width:40px;">'.$fecha_baja.'</td>';//tipo ingreso estudiante

$fecha_nacimiento="";
if($estudiante->fecha_nacimiento!=''){
    $fecha_nacimiento=date("Y/m/d", strtotime($estudiante->fecha_nacimiento));
}

$renglon.='<td style="width:40px;">'.$fecha_nacimiento.'</td>';//matricula estudiante


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

        return '<tr style="font-size:4 pt;text-align:center"><td style="width:25px;background-color:#f8facb" rowspan="2"><br><br><br><br><br><br><br>N/P</td><td style="width:45px;background-color:#f8facb" rowspan="2"> <br><br><br><br><br><br><br>MATRÍCULA</td><td style="width:100px;background-color:#f8facb" rowspan="2"><br><br><br><br><br><br><br>CURP</td><td style="width:25px;background-color:#f8facb" rowspan="2"><br><br><br><br><br><br><br>SEXO</td><td style="width:244px;background-color:#f8facb" >NOMBRE DEL ALUMNO</td><td style="width:25px;background-color:#f8facb;vertical-align:text-top;" rowspan="2"><br><br><br><br><br><br><br>EDAD ACTUAL</td><td style="width:50px;background-color:#f8facb" rowspan="2"><br><br><br><br><br><br><br>SITUACIÓN ALUMNO</td><td style="width:364px;background-color:#f8facb">(CLAVE-UNIDAD DE CONTENIDO)<br>CALIFICACIÓN</td><td style="width:40px;background-color:#f8facb" rowspan="2"><br><br><br><br><br><br><br>SIT. ALUMNO FIN DEL MÓDULO</td><td style="width:178px;background-color:#f8facb;">ANTES DEL PERIODO DE REGULARIZACIÓN (ENERO)</td><td style="width:207px;background-color:#f8facb">DESPUÉS DEL PERIODO DE REGULARIZACIÓN (ENERO)</td><td style="width:40px;background-color:#f8facb" rowspan="2"><br><br><br><br><br><br><br>FECHA DE BAJA</td><td style="width:40px;background-color:#f8facb" rowspan="2"><br><br><br><br><br><br><br>FECHA DE NACIMIENTO</td> </tr>

        
        <tr style="font-size:4 pt;text-align:center">



<td style="width:72px;background-color:#f8facb"><br><br><br><br><br>PRIMER APELLIDO</td>
<td style="width:72px;background-color:#f8facb"><br><br><br><br><br>SEGUNDO APELLIDO</td>
<td style="width:100px;background-color:#f8facb"><br><br><br><br><br>NOMBRE(S)</td>


'.celdas_materias($materias_estudiantes).$html_pos_materias.'
</tr>';

    }

    else{
        
        

        if($semestre=="1" || $semestre=="3" || $semestre=="5"){

            $regreso ='<tr style="font-size:3.5 pt;text-align:center"><td style="width:20px;background-color:#f8facb" rowspan="2"><br><br><br><br><br><br><br>N/P</td><td style="width:37px;background-color:#f8facb" rowspan="2"><br><br><br><br><br><br><br>MATRÍCULA</td><td style="width:83px;background-color:#f8facb" rowspan="2"><br><br><br><br><br><br><br>CURP</td><td style="width:20px;background-color:#f8facb" rowspan="2"><br><br><br><br><br><br><br>SEXO</td><td style="width:225px;background-color:#f8facb">NOMBRE DEL ALUMNO</td><td style="width:25px;background-color:#f8facb" rowspan="2"><br><br><br><br><br><br><br>EDAD ACTUAL</td><td style="width:25px;background-color:#f8facb" rowspan="2"><br><br><br><br><br>T.I. (TIPO DE INGRESO) I, R, T, P.E.</td>
        <td style="width:40px;background-color:#f8facb" rowspan="2"><br><br><br><br><br><br><br>ESTATUS INICIO DEL MÓDULO</td>

        <td style="width:99px;background-color:#f8facb">ANTES DEL PERIODO DE REGULARIZACIÓN (OCTUBRE)</td>
        <td style="width:102px;background-color:#f8facb">DESPUÉS DEL PERIODO DE REGULARIZACIÓN (OCTUBRE)</td>
        
        <td style="width:364px;background-color:#f8facb">(CLAVE-UNIDAD DE CONTENIDO)<br>CALIFICACIÓN</td><td style="width:40px;background-color:#f8facb" rowspan="2"><br><br><br><br><br><br><br>SIT. ALUMNO FIN DEL MÓDULO (mod. Actual)</td><td style="width:150px;background-color:#f8facb">ANTES DEL PERIODO DE REGULARIZACIÓN (ENERO)</td><td style="width:160px;background-color:#f8facb">DESPUÉS DEL PERIODO DE REGULARIZACIÓN (ENERO)</td><td style="width:40px;background-color:#f8facb" rowspan="2"><br><br><br><br><br><br><br>FECHA DE BAJA</td><td style="width:40px;background-color:#f8facb" rowspan="2"><br><br><br><br><br><br><br>FECHA DE NACIMIENTO</td> </tr>';
        
        $regreso .= '<tr style="font-size:3.5 pt;text-align:center">
        
        
        <td style="width:70px;background-color:#f8facb"><br><br><br><br><br>PRIMER APELLIDO</td>
        <td style="width:70px;background-color:#f8facb"><br><br><br><br><br>SEGUNDO APELLIDO</td>
        <td style="width:85px;background-color:#f8facb"><br><br><br><br><br>NOMBRE(S)</td>

        <td style="width:25px;background-color:#f8facb"><br>NÚMERO DE ADEUDOS INICIO DEL MÓDULO (módulos anteriores)</td>
        <td style="width:74px;background-color:#f8facb"><br><br><br><br><br>CLAVE U.C. ADEUDOS MODULARES ANTERIORES</td> 
        ';

            $regreso.='<td style="width:25px;background-color:#f8facb">NÚMERO DE ADEUDOS DESPUÉS DE LA REGULARIZACIÓN</td>
            <td style="width:77px;background-color:#f8facb"><br><br><br>CLAVE U.C. ADEUDOS DESPUÉS DE LA REGULARIZACIÓN (módulos anteriores)</td>'.celdas_materias($materias_estudiantes).$html_pos_materias.'
            </tr>';
            
        }

        else{

            $regreso ='<tr style="font-size:3.5 pt;text-align:center"><td style="width:20px;background-color:#f8facb" rowspan="2"><br><br><br><br><br><br><br>N/P</td><td style="width:37px;background-color:#f8facb" rowspan="2"><br><br><br><br><br><br><br>MATRÍCULA</td><td style="width:83px;background-color:#f8facb" rowspan="2"><br><br><br><br><br><br><br>CURP</td><td style="width:20px;background-color:#f8facb" rowspan="2"><br><br><br><br><br><br><br>SEXO</td><td style="width:225px;background-color:#f8facb">NOMBRE DEL ALUMNO</td><td style="width:25px;background-color:#f8facb" rowspan="2"><br><br><br><br><br><br><br>EDAD ACTUAL</td><td style="width:25px;background-color:#f8facb" rowspan="2"><br><br><br><br><br>T.I. (TIPO DE INGRESO) I, R, T, P.E.</td>
        <td style="width:40px;background-color:#f8facb" rowspan="2"><br><br><br><br><br><br><br>ESTATUS INICIO DEL MÓDULO</td>

        <td style="width:99px;background-color:#f8facb">ANTES DEL PERIODO DE REGULARIZACIÓN (MAYO)</td>
        <td style="width:102px;background-color:#f8facb">DESPUÉS DEL PERIODO DE REGULARIZACIÓN (MAYO)</td>
        
        <td style="width:364px;background-color:#f8facb">(CLAVE-UNIDAD DE CONTENIDO)<br>CALIFICACIÓN</td><td style="width:40px;background-color:#f8facb" rowspan="2"><br><br><br><br><br><br><br>SIT. ALUMNO FIN DEL MÓDULO (mod. Actual)</td><td style="width:150px;background-color:#f8facb">ANTES DEL PERIODO DE REGULARIZACIÓN (JULIO)</td><td style="width:160px;background-color:#f8facb">DESPUÉS DEL PERIODO DE REGULARIZACIÓN (JULIO)</td><td style="width:40px;background-color:#f8facb" rowspan="2"><br><br><br><br><br><br><br>FECHA DE BAJA</td><td style="width:40px;background-color:#f8facb" rowspan="2"><br><br><br><br><br><br><br>FECHA DE NACIMIENTO</td> </tr>';
        
        $regreso .= '<tr style="font-size:3.5 pt;text-align:center">
        
        
        <td style="width:70px;background-color:#f8facb"><br><br><br><br><br>PRIMER APELLIDO</td>
        <td style="width:70px;background-color:#f8facb"><br><br><br><br><br>SEGUNDO APELLIDO</td>
        <td style="width:85px;background-color:#f8facb"><br><br><br><br><br>NOMBRE(S)</td>

        <td style="width:25px;background-color:#f8facb"><br>NÚMERO DE ADEUDOS INICIO DEL MÓDULO (módulos anteriores)</td>
        <td style="width:74px;background-color:#f8facb"><br><br><br><br><br>CLAVE U.C. ADEUDOS MODULARES ANTERIORES</td> 
        ';
            $regreso.='<td style="width:25px;background-color:#f8facb">NÚMERO DE ADEUDOS DESPUÉS DE LA REGULARIZACIÓN</td>
            <td style="width:77px;background-color:#f8facb"><br><br><br><br><br>CLAVE U.C. ADEUDOS DESPUÉS DE LA REGULARIZACIÓN (módulos anteriores)</td>'.celdas_materias($materias_estudiantes).$html_pos_materias.'
            </tr>';
        }

        return $regreso;

     
    }

}




//carga los datos de encabezados
$pre_materias ='
<h5 style="text-align:center">COLEGIO SUPERIOR PARA LA EDUCACIÓN INTEGRAL INTERCULTURAL DE OAXACA</h5>
<p style="text-align:center">DEPARTAMENTO DE CONTROL ESCOLAR</p>
<h5 style="text-align:center;background-color:#e9e9e9">FORMATO DE REGISTRO DE INSCRIPCIÓN Y ACREDITACIÓN ESCOLAR (F-RIAE)</h5>

<table>
<tbody>
<tr>
<td><span style="font-weight: bold;">NOMBRE DEL PLANTEL: </span>'.$datos_friae->nombre_largo.' DE '.$datos_friae->nombre_plantel.'</td>
<td style="text-align:right"><span style="font-weight: bold;">MÓDULO: </span>'.nombre_modulo($datos_friae->semestre).'</td>
</tr>

<tr>
<td><span style="font-weight: bold;">CLAVE C.C.T: </span>'.$datos_friae->cct_plantel.'</td>
<td style="text-align:right"><span style="font-weight: bold;">CICLO ESCOLAR: </span>'.$datos_friae->nombre_ciclo_escolar.'</td>
</tr>

<tr>
<td><span style="font-weight: bold;">LOCALIDAD Y MUNICIPIO: </span>'.$datos_friae->nombre_localidad.','.$datos_friae->nombre_municipio.', '.$datos_friae->nombre_distrito.', '.$datos_friae->nombre_estado.'</td>
<td style="text-align:right"><span style="font-weight: bold;">GRUPO: </span>"'.$datos_friae->nombre_grupo.'"</td>
</tr>

<tr>
<td> </td>
<td> </td>
</tr>

</tbody>
</table>

<table border="1">
<tbody>'.primer_semestre($datos_friae->semestre,$materias_estudiantes,$html_pos_materias).$registros_html.$filas_faltantes_html.'
</tbody>
</table>';
//style="border: hidden"

if($datos_friae->semestre!=1){
        $pre_materias .='
        <table style="border: hidden">
        <tbody>
        <tr>
        <td style="width:133px;"> </td>
        <td style="width:40px;"> <img src="'.base_url().'assets/img/sexo.png" alt="Smiley face" height="35" width="41"> </td>
        <td style="width:60px;"> </td>
        <td style="width:158px;"> <span style="font-size:5px">ETAPA DE INSCRIPCIÓN</span></td>
        <td style="width:48px;"> <img src="'.base_url().'assets/img/tipo_ingreso.png" alt="Smiley face" height="35" width="41"></td>
        <td style="width:237px;"><img src="'.base_url().'assets/img/inicio_mod.png" alt="Smiley face" height="23" width="23"></td>
        <td style="width:364px;"><span style="font-size:5px;text-align:center"><br>ETAPA DE ACREDITACIÓN</span> </td>
        <td style="width:308px;"> <img src="'.base_url().'assets/img/sit_fin_modulo.png" alt="Smiley face" height="35" width="41"></td>
        
        <td style="width:45px;"> <img src="'.base_url().'assets/img/situacion_despues_de_regu.png" alt="Smiley face" height="35" width="41"></td>
        <td  style="width:40px;"> <img src="'.base_url().'assets/img/fecha_baja.png" alt="Smiley face" height="35" width="41"></td>
        <td  style="width:40px;"> <img src="'.base_url().'assets/img/fecha_nacimiento.png" alt="Smiley face" height="35" width="41"></td>
        </tr>
        
        </tbody>
        </table>';
}
else{
        $pre_materias .='
        <table style="border: hidden">
        <tbody>
        <tr>
        <td style="width:160px;"> </td>
        <td style="width:40px;"> <img src="'.base_url().'assets/img/sexo.png" alt="Smiley face" height="35" width="41"> </td>
        
        <td style="width:70px;"> </td>

        <td style="width:194px;"> <span style="font-size:5px">ETAPA DE INSCRIPCIÓN</span></td>
        <td style="width:50px;"> </td>
        <td style="width:364px;"><span style="font-size:5px;text-align:center"><br>ETAPA DE ACREDITACIÓN</span> </td>
        <td style="width:380px;"> <img src="'.base_url().'assets/img/sit_fin_modulo.png" alt="Smiley face" height="35" width="41"></td>

        <td style="width:45px;"> <img src="'.base_url().'assets/img/situacion_despues_de_regu.png" alt="Smiley face" height="35" width="41"></td>
        <td  style="width:40px;"> <img src="'.base_url().'assets/img/fecha_baja.png" alt="Smiley face" height="35" width="41"></td>
        <td  style="width:40px;"> <img src="'.base_url().'assets/img/fecha_nacimiento.png" alt="Smiley face" height="35" width="41"></td>
        </tr>

        </tbody>
        </table>';

}




$nombre_revisor="";

if ($revisor[0]->nombre!=null){

    $nombre_revisor=$revisor[0]->nombre." ".$revisor[0]->primer_apellido." ".$revisor[0]->segundo_apellido;
}


$firmas = '
<table style="font-size:6pt;">
<tbody>
<tr>
<td><br><br>'.$director.'<br>______________________________<br>NOMBRE Y FIRMA DEL DIRECTOR(A)<br>DEL PLANTEL<br></td>
<td><p></p><p>_________________________</p><p>SELLO DEL PLANTEL</p></td>
<td><br><br>'.$jefe_escolar[0]->valor.'<br>___________________________________<br>JEFE DEL DEPARTAMENTO DE<br>CONTROL ESCOLAR<br></td>
<td><p></p><p>_________________________</p><p>SELLO CONTROL ESCOLAR</p></td>
<td><br><br>'.$nombre_revisor.'<br>_________________________<br>REVISÓ Y VALIDÓ</td>
</tr>
</tbody>
</table>
';

$tabla_escuela="";

$tabla_escuela.='<table style="font-size:4pt;background-color:#e9e9e9" border="1">
<tbody>
<tr>
<td style="width:50px;"><span style="font-weight: bold;">CLAVE</span></td>
<td style="width:230px;"><span style="font-weight: bold;">UNIDAD DE CONTENIDO</span></td>
</tr>';
foreach($materias_grupo as $materia){
    $tabla_escuela.='<tr>';
    $tabla_escuela.='<td>'.$materia->id_materia.'</td>';
    $tabla_escuela.='<td style="text-align:left">'.$materia->unidad_contenido.'</td></tr>';
}
$tabla_escuela.='</tbody>
</table>';



$rubrica='
<table style="font-size:2.7pt;font-weight: bold;text-align:left">
<tbody>
<tr>
<td>ORIGINAL - DEPTO. CONTROL ESCOLAR</td>
</tr>
<tr>
<td>COPIA - PLANTEL</td>
</tr>
</tbody>
</table>';





// print a block of text using Write()
// output the HTML content
$pdf->writeHTML($pre_materias, true, 0, true, true);



if($datos_friae->semestre!=1){
        $pdf->writeHTMLCell($w = 0, $h = 20, $x = '7', $y = '238',$tabla_escuela, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);

        $pdf->writeHTMLCell($w ='310', $h = 20, $x = '100', $y = '250',$firmas, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);

        $pdf->writeHTMLCell($w = '23', $h = '10', $x = '400', $y = '255',$rubrica, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);
}
else{
        $pdf->writeHTMLCell($w = 0, $h = 20, $x = '20', $y = '238',$tabla_escuela, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);

        $pdf->writeHTMLCell($w = '300', $h = 20, $x = '100', $y = '250',$firmas, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);

        $pdf->writeHTMLCell($w = '23', $h = '10', $x = '390', $y = '255',$rubrica, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'C', $autopadding = true);
}



//Close and output PDF document

//error_reporting(E_ALL); Aplicar cuando existan errores y no sabemos donde existe el error.

$pdf->Output('FRIAE.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

?>