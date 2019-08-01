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

        public $plantel;
        public $ciclo;
	

	

	public function set_plantel($plantel){
	$this->plantel=$plantel;
        }

        public function set_ciclo($ciclo){
                $this->ciclo=$ciclo;
        }

        public function periodo($periodo){
                $resultado='';
                if($periodo=='AGOSTO-ENERO'){
                        $resultado='B';
                }

                if($periodo=='FEBRERO-JULIO'){
                        $resultado='A';
                        
                }
                return $resultado;
        }


	//Page header
	public function Header() {

        $html='<div style="text-align: center;" ><span ><strong>DEPARTAMENTO DE CONTROL ESCOLAR</strong></span></div>

        <br>
        <table border="1" cellpadding="3">
            <tr>
            <td style="text-align: center;font-weight: bold">REPORTE DE BAJAS</td>
            </tr>
        </table>
        
        <br>
        <br>
        <br>

        <table border="0">
            <tr>
                <td style="font-weight: bold"  WIDTH="16%">NOMBRE DEL PLANTEL:</td><td colspan="3">'.$this->plantel[0]->nombre_plantel.'</td>
            </tr>
            <tr>
                <td style="font-weight: bold"  WIDTH="16%">CLAVE C.C.T.:</td><td colspan="3">'.$this->plantel[0]->cct_plantel.'</td>
            </tr>
            <tr>
                <td style="font-weight: bold"  WIDTH="16%">CICLO ESCOLAR:</td><td WIDTH="69%">'.$this->ciclo[0]->nombre_ciclo_escolar.'</td><td WIDTH="10%">PERIODO:</td><td WIDTH="5%">"'.$this->periodo($this->ciclo[0]->periodo).'"</td>
            </tr>
        </table>


        ';

$this->SetFont('helvetica', 'B',8);

		$this->writeHTMLCell($w =234.5, $h =59.8, $x =21, $y = 28, $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);

		// Logo
		$image_file =base_url().'assets/img/cabecera.png';
		$this->Image($image_file, 176,6, 90, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

		$image_file =base_url().'assets/img/ladoderecho.png';
		$this->Image($image_file, 257, 40, 15, '', 'PNG', '', 'T', false, 100, '', false, false, 0, false, false, false);


		// Set font
		$this->SetFont('helvetica', 'B',6);



		// Titulo
		$this->SetXY(25,26);
		$this->Cell(0,0, '"2019, AÑO POR LA ERRADICACIÓN DE LA VIOLENCIA CONTRA LA MUJER"', 0, false, 'C', 0, '', 0, false, 'M', 'M');


		
	}

	// Page footer
	public function Footer() {
		$html = '<br><br><br><br><br><br><br><br><table>
                <tbody>
                <tr>
        
                <td>
                
                <p style="text-decoration: underline;">'.$this->plantel[0]->director.'</p>
                <p>NOMBRE Y FIRMA DEL DIRECTOR</p>
                <p>DEL PLANTEL</p>
                </td>
        
                <td>
                <p> </p>
                <p>____________________________</p>
                <p>SELLO DEL PLANTEL</p>
                <p></p>
                </td>
        
                <td>
                <p>DAVID ERNESTO HERNANDEZ AVENDAÑO</p>
                <p>____________________________</p>
                <p>JEFA DE DEPARTAMENTO</p>
                <p>DE CONTROL ESCOLAR</p>
                </td>
        
        
                <td>
                <p> </p>
                <p>____________________________</p>
                <p>SELLO DE CONTROL ESCOLAR</p>
                <p></p>
                </td>
        
                </tr>
                </tbody>
                </table>';
		// Position at 15 mm from bottom
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


$pdf->set_plantel($plantel);
$pdf->set_ciclo($ciclo_escolar);


// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Control Escolar CSEIIO');
$pdf->SetTitle('PDF Lista de bajas');
$pdf->SetSubject('PDF Lista de bajas');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(20,65,23);
$pdf->SetHeaderMargin(65);
$pdf->SetFooterMargin(94);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE,94);

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
 
        $tabla='
        <table border="1">
        <thead>
        <tr style="background-color:#ececec;height:10px">
        <td style="width:5%;text-align:center">N/P</td>
        <td style="width:20%;text-align:center">MODULO/GRUPO</td>
        <td style="width:15%;text-align:center">NOMBRE DEL ALUMNO</td>
        <td style="width:20%;text-align:center">MOTIVO</td>
        <td style="width:10%;text-align:center">FECHA DE BAJA</td>
        <td style="width:30%;text-align:center">OBSERVACIONES</td>
        </tr>
        </thead>

        <tbody>';
       $cont=1;
        foreach ($lista_baja as $baja) {

            $tabla.='<tr>
            <td style="width:5%">'.$cont.'</td>
            <td style="width:20%">'.semestre_en_letra($baja->semestre).'/'.$baja->nombre_grupo.'</td>
            <td style="width:15%">'.$baja->primer_apellido.' '.$baja->segundo_apellido.' '.$baja->nombre.'</td>
            <td style="width:20%">'.$baja->motivo.'</td>
            <td style="width:10%">'.$baja->fecha.'</td>
            <td style="width:30%">'.$baja->observacion.'</td>
            </tr>';
            $cont=$cont++;
            
        }
        

        $tabla.=' </tbody>
        </table>
        ';

// print a block of text using Write()
// output the HTML content
$pdf->writeHTML($tabla, true, 0, true, true);


//Close and output PDF document
$pdf->Output('Lista de Asistencia.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>