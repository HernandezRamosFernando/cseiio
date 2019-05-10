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
		//$image_file =base_url().'plantilla/img/cabecera.png';
	//	$this->Image($image_file, 120, 10, 80, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

		//$image_file =base_url().'plantilla/img/ladoderecho.png';
	//	$this->Image($image_file, 190, 50, 15, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Set font
		$this->SetFont('helvetica', 'B', 10);
		// Title
		$this->Cell(0, 10, '<< Colegio Superior para la Educación Integral Intercultural de Oaxaca >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
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
$pdf->SetTitle('PDF Ficha de Inscripción');
$pdf->SetSubject('Ficha de Inscripción CSEIIO');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(20,16,19);
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



//operacion para calcular años de nacimiento;


/*$empezar_fecha = strtotime($estudiante[0]->fecha_nacimiento); 

$terminar_fecha = strtotime(date("Y-m-d")); 

$diff = $terminar_fecha - $empezar_fecha; 

$edad=round($diff / 86400);
$edad= 'Difference: '.$difference->y.' years, ' 
                   .$difference->m.' months, ' 
                   .$difference->d.' days';

*/

$datetime1 = new DateTime($estudiante['estudiante'][0]->fecha_nacimiento);

$datetime2 = new DateTime(date("Y-m-d"));

$difference = $datetime1->diff($datetime2);

$edad=$difference->y.' AÑOS';


$sexo=$estudiante['estudiante'][0]->sexo;
	if ($sexo=='H'){
		$sexo= "HOMBRE";
	}

	if ($sexo=='M'){
		$sexo= "MUJER";
	}

$tipo_sangre='';
$alergia='';
$discapacidad='';
$tieneAlergia='NO';
$tieneDiscapacidad='NO';
foreach ($estudiante['expediente_medico'] as $expediente) {

	if($expediente->descripcion=='TIPO DE SANGRE'){
		$tipo_sangre=$expediente->valor;
	}

	if($expediente->descripcion=='ALERGIA'){
		$alergia=$expediente->valor;
	}

	if($expediente->descripcion=='DISCAPACIDAD'){
		$discapacidad=$expediente->valor;
	}
}

if($alergia!=''){
	$tieneAlergia='SI';
}

if($discapacidad!=''){
	$tieneDiscapacidad='SI';
}




$html_1 ='

<div style="text-align: center;" ><span ><strong>FICHA DE INSCRIPCIÓN </strong></span></div>

<br>
<table border="1">
<tbody>

<tr>
<td colspan="2" style="text-align: center; background-color:#58ACFA; font-weight: bold;" > I.- DATOS DEL PLANTEL</td>
</tr>

<tr>
<td colspan="2"><strong>NOMBRE DEL BACHILLERATO: </strong>'.$nombre_plantel.'</td>
</tr>

<tr>
<td colspan="2"> <strong>C.C.T.: </strong>'.$estudiante['estudiante'][0]->Plantel_cct_plantel.'</td>
</tr>


<tr>
<td> <strong>SEMESTRE AL QUE INGRESA: </strong>'.$estudiante['estudiante'][0]->semestre.'</td>
<td> <strong>SITUACIÓN DE INGRESO: </strong>'.$estudiante['estudiante'][0]->tipo_ingreso.'</td>
</tr>

</tbody>
</table>
<br>
<br>

<table  border="1">
<tbody>

<tr>
<td colspan="3" style="text-align: center; background-color:#58ACFA; font-weight: bold;" > II.- DATOS PERSONALES</td>
</tr>

<tr>
<td style="text-align: center;"><strong>APELLIDO PATERNO:</strong><BR>'.strtoupper($estudiante['estudiante'][0]->primer_apellido).'</td>
<td style="text-align: center;"><strong>APELLIDO MATERNO:</strong><BR>'.strtoupper($estudiante['estudiante'][0]->segundo_apellido).'</td>
<td style="text-align: center;"><strong>NOMBRE(S):</strong><BR>'.strtoupper($estudiante['estudiante'][0]->nombre).'</td>
</tr>

</tbody>
</table>

<table  border="1">
<tbody>
<tr ><td colspan="2"><strong>LUGAR DE NACIMIENTO: </strong>'.strtoupper($estudiante['estudiante'][0]->lugar_nacimiento).'</td></tr>
<tr>
<td><strong>CURP: </strong>'.strtoupper($estudiante['estudiante'][0]->curp).'</td>
<td><strong>FECHA DE NACIMIENTO: </strong>'.strtoupper($estudiante['estudiante'][0]->fecha_nacimiento).'</td>
</tr>

<tr>
<td><strong>SEXO: </strong>'.$sexo.'</td>
<td><strong>EDAD: </strong>'.$edad.'</td>
</tr>

<tr>
<td><strong>TELÉFONO: </strong>'.$estudiante['estudiante'][0]->telefono.'</td>
<td><strong>MAIL: </strong>'.$estudiante['estudiante'][0]->correo.'</td>
</tr>


<tr>
<td><strong>NSS: </strong>'.$estudiante['estudiante'][0]->nss.'</td>



<td><strong>TIPO DE SANGRE: </strong> '.$tipo_sangre.'</td>
</tr>



<tr>
<td><strong>¿ALÉRGICO A ALGÚN MEDICAMENTO?: </strong>'.$tieneAlergia.'</td>
<td><strong>MEDICAMENTOS AL QUE ES ALÉRGICO: </strong> '.$alergia.'<BR></td>
</tr>

<tr>
<td><strong>¿PADECE ALGUNA DISCAPACIDAD?: </strong>'.$tieneDiscapacidad.'</td>
<td><strong>DISCAPACIDAD: </strong>'.$discapacidad.'</td>
</tr>


<tr>
<td colspan="2"><strong>FOLIO PROSPERA :</strong>'.$estudiante['estudiante'][0]->folio_programa_social.'</td>
<td></td>
</tr>

</tbody>
</table>

<table  border="1">
<tbody>
<tr>
<td colspan="3" style="text-align: center; font-weight: bold;" >DIRECCIÓN FAMILIAR DEL ESTUDIANTE</td>
</tr>

<tr>
<td style="text-align: center;"><strong>ESTADO:</strong><BR>'.strtoupper($domicilio_estudiante[0]->nombre_estado).'</td>
<td style="text-align: center;"><strong>MUNICIPIO:</strong><BR>'.strtoupper($domicilio_estudiante[0]->nombre_municipio).'</td>
<td style="text-align: center;"><strong>LOCALIDAD:</strong><BR>'.strtoupper($domicilio_estudiante[0]->nombre_localidad).'</td>
</tr>

<tr>
<td ><strong>CALLE Y NÚMERO:</strong> '.strtoupper($estudiante['estudiante'][0]->calle).'</td>
<td ><strong>COLONIA:</strong> '.strtoupper($estudiante['estudiante'][0]->colonia).'</td>
<td ><strong>CÓDIGO POSTAL:</strong> '.$estudiante['estudiante'][0]->cp.'</td>
</tr>

</tbody>
</table>

<br>
<br>
<table  border="1">
<tbody>
<tr>
<td colspan="3" style="text-align: center; background-color:#58ACFA; font-weight: bold;" > III.- DATOS DE TUTOR DEL ASPIRANTE</td>
</tr>

<tr>
<td style="text-align: center;"><strong>APELLIDO PATERNO:</strong><BR> '.((isset($estudiante['tutor'][0]->primer_apellido_tutor))? strtoupper($estudiante['tutor'][0]->primer_apellido_tutor) : "").'</td>
<td style="text-align: center;"><strong>APELLIDO MATERNO:</strong><BR> '.((isset($estudiante['tutor'][0]->segundo_apellido_tutor))? strtoupper($estudiante['tutor'][0]->segundo_apellido_tutor) : "").'</td>
<td style="text-align: center;"><strong>NOMBRE(S):</strong><BR> '.((isset($estudiante['tutor'][0]->nombre_tutor))? strtoupper($estudiante['tutor'][0]->nombre_tutor) : "").'</td>
</tr>


<tr>
<td ><strong>PARENTESCO:</strong><BR>'.((isset($estudiante['tutor'][0]->parentesco)) ? strtoupper($estudiante['tutor'][0]->parentesco) : "").'</td>
<td ><strong>OCUPACIÓN:</strong><BR>'.((isset($estudiante['tutor'][0]->ocupacion)) ? strtoupper($estudiante['tutor'][0]->ocupacion) : "").'</td>
<td ><strong>TELÉFONO PARTICULAR:</strong><BR>'.((isset($estudiante['tutor'][0]->telefono_tutor)) ? strtoupper($estudiante['tutor'][0]->telefono_tutor) : "").'</td>
</tr>

<tr>
<td ><strong>TELÉFONO DE LA COMUNIDAD:</strong><BR>'.((isset($estudiante['tutor'][0]->telefono_comunidad)) ? strtoupper($estudiante['tutor'][0]->telefono_comunidad) : "").'</td>
<td colspan="2"><strong>FOLIO PROSPERA:</strong>'.((isset($estudiante['tutor'][0]->folio_programa_social_tutor)) ? strtoupper($estudiante['tutor'][0]->folio_programa_social_tutor) : "").'</td>
</tr>

</tbody>
</table>

<br>
<br>

<table  border="1">
<tbody>
<tr>
<td colspan="2" style="text-align: center; background-color:#58ACFA; font-weight: bold;" > IV.- ANTECEDENTE ESCOLAR Y SOCIAL</td>
</tr>

<tr>
<td colspan="2"><strong>ESCUELA DE PROCEDENCIA: </strong> '.((isset($escuela_procedencia[0]->nombre_escuela_procedencia)) ? strtoupper($escuela_procedencia[0]->nombre_escuela_procedencia) : "").'</td>
</tr>

<tr>
<td colspan="2"><strong>C.C.T.: </strong> '.((isset($estudiante['estudiante'][0]->cct_escuela_procedencia)) ? strtoupper($estudiante['estudiante'][0]->cct_escuela_procedencia) : "").'</td>
</tr>

<tr>
<td colspan="2"><strong>TIPO DE SUBSISTEMA: </strong> '.((isset($escuela_procedencia[0]->tipo_subsistema)) ? strtoupper($escuela_procedencia[0]->tipo_subsistema) : "").'</td>
</tr>


</tbody>
</table>

<table  border="1">
<tbody>

<tr>
<td colspan="5" style="text-align: center; font-weight: bold;" >DATOS DE LENGUA MATERNA</td>
</tr>

<tr>
<td colspan="5"><strong>LENGUA MATERNA: </strong> '.strtoupper($nombre_lengua).'</td>
</tr>

<tr>
<td style="text-align: center;"><strong>ENTIENDE</strong></td>
<td style="text-align: center;"><strong>HABLA</strong></td>
<td style="text-align: center;"><strong>LEE</strong></td>
<td style="text-align: center;"><strong>ESCRIBE</strong></td>
<td style="text-align: center;"><strong>TRADUCE</strong></td>
</tr>

<tr>
<td style="text-align: center;">'.strtoupper($lengua_entiende).'</td>
<td style="text-align: center;">'.strtoupper($lengua_habla).'</td>
<td style="text-align: center;">'.strtoupper($lengua_lee).'</td>
<td style="text-align: center;">'.strtoupper($lengua_escribe).'</td>
<td style="text-align: center;">'.strtoupper($lengua_traduce).'</td>
</tr>

</tbody>
</table>

<br>
<br>


<table  border="1">
<tbody>
<tr>
<td colspan="2" style="text-align: center; background-color:#58ACFA; font-weight: bold;" > V.- DOCUMENTOS SOLICITADOS</td>
</tr>


<tr>
<td colspan="2" style="text-align: center;">ORIGINAL Y COPIA</td>
</tr>



';

$html_2="";
$cont=1;
$columna=0;
$entregado="";
foreach ($lista_documentacion as $documento) {
	$entregado="";
	$columna++;
 if($columna==1){
 	$html_2.="<tr>";
 }
 if($columna<=2){
 	if($documento->entregado){
 		$entregado="checked=\"checked\"";
 	}
 	$html_2.='<td><input type="checkbox" name="documento'.$cont.'" value="'.$documento->id_documento.'" '.$entregado.'>'.strtoupper($documento->nombre_documento).' </td>';
 	
 }

 if($columna==2){
 	$html_2.="</tr>";
 	$columna=0;
 }
	
$cont++;	
}

if($columna!=0 ){
	$html_2.="<td></td></tr>";
}

$html_3='
</tbody>
</table>

';


// print a block of text using Write()
// output the HTML content
$pdf->writeHTML($html_1.$html_2.$html_3, true, 0, true, true);


//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+



?>