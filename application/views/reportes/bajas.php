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
        public $revisor;
        public $jefe_escolar;
        
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

        public function set_revisor($revisor){
            $this->revisor=$revisor;
                }
        
        
                


                public function set_jefe_escolar($jefe_escolar){
                    $this->jefe_escolar=$jefe_escolar;
                        }

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

        $html='<div style="text-align: center;" >
        <span style="text-align:center;font-size:8pt;  font-weight:bold">COLEGIO SUPERIOR PARA LA EDUCACIÓN INTEGRAL INTERCULTURAL DE OAXACA</span><br>
        <span style="text-align:center;font-size:7pt;  font-weight:bold">DEPARTAMENTO DE CONTROL ESCOLAR</span></div>
        <br>
        
        <br>


        <table border="1" WIDTH="100%"><tr>
        <td style="font-weight: bold;font-size:10pt;text-align: center;background-color:#ececec;height:10px">
        <br>REPORTE DE BAJAS</td>
    </tr></table>
    <br>
        <br>

        <table border="0">
            <tr>
                <td style="font-weight: bold"  WIDTH="16%">NOMBRE DEL PLANTEL:</td><td colspan="3">'.$this->plantel[0]->nombre_largo.' DE '.$this->plantel[0]->nombre_plantel.'</td>
            </tr>
            <tr>
                <td style="font-weight: bold"  WIDTH="16%">CLAVE C.C.T.:</td><td colspan="3">'.$this->plantel[0]->cct_plantel.'</td>
            </tr>
            <tr>
                <td style="font-weight: bold"  WIDTH="16%">CICLO ESCOLAR:</td><td WIDTH="69%">'.$this->ciclo[0]->nombre_ciclo_escolar.'</td><td WIDTH="10%">PERIODO:</td><td WIDTH="5%">"'.$this->periodo($this->ciclo[0]->periodo).'"</td>
            </tr>
        </table>
        <br>
        
        <br>
        <br>
        <br>

        ';

$this->SetFont('helvetica', 'B',8);

		$this->writeHTMLCell($w =250, $h =59.8, $x =14, $y = 12, $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);

		// Logo
		$image_file =base_url().'assets/img/logo_cseiio.png';
        $this->Image($image_file, 14,6, 13, '', 'PNG', '', 'T', false, 100, '', false, false, 0, false, false, false);
        
        $image_file =base_url().'assets/img/logo_gobierno.png';
		$this->Image($image_file, 250,6, 13, '', 'PNG', '', 'T', false, 100, '', false, false, 0, false, false, false);

		/*$image_file =base_url().'assets/img/ladoderecho.png';
		$this->Image($image_file, 257, 40, 15, '', 'PNG', '', 'T', false, 100, '', false, false, 0, false, false, false);*/


		// Set font
		$this->SetFont('helvetica', 'B',6);



		/*
		$this->SetXY(25,26);
		$this->Cell(0,0, '"2019, AÑO POR LA ERRADICACIÓN DE LA VIOLENCIA CONTRA LA MUJER"', 0, false, 'C', 0, '', 0, false, 'M', 'M');*/


		
	}

	// Page footer
	public function Footer() {
        $html = '
        <table>
                <tbody>
                <tr>
        
                <td style="text-align:center">
                
                <span style="text-decoration: underline;">'.$this->plantel[0]->director.'</span><br>
               <span style="font-weight: bold"> NOMBRE Y FIRMA DEL DIRECTOR<br>
                DEL PLANTEL</span>
                </td>
        
                <td style="text-align:center">
                
                ____________________________
                <br>SELLO DEL PLANTEL
                </td>
        
                <td style="text-align:center">
                
                <span style="text-decoration: underline;">'.$this->jefe_escolar[0]->valor.'</span><br>
                
                <span style="font-weight: bold">JEFE DE DEPARTAMENTO<br>
               DE CONTROL ESCOLAR</span>
                </td>
        
        
                <td style="text-align:center">
                
                ____________________________<br>
                <span style="font-weight: bold">SELLO DE CONTROL ESCOLAR</span>
                
                </td>
        
                </tr>
                </tbody>
                </table>
                
                <p></p>

                <table>
                <tbody>
                <tr>

                <td style="width: 10%;text-align:right;font-weight: bold">
                VALIDÓ:
                </td>


                <td style="width: 70%">
                '.$this->revisor[0]->nombre.' '.$this->revisor[0]->primer_apellido.' '.$this->revisor[0]->segundo_apellido.'
                
                </td>

                <td style="width: 20%;font-size:7px" >
                ORIGINAL.- DEPTO. CONTROL ESCOLAR.<br>
                COPIA.- PLANTEL.
                    
                </td>

                </tr>
                </tbody>
                </table>
                
                
                ';
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
$pdf->set_revisor($revisor);

$pdf->set_jefe_escolar($jefe_escolar);



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
$pdf->SetMargins(12,45,15);
$pdf->SetHeaderMargin(30);
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
$pdf->SetFont('helvetica','', 8);

// add a page
$pdf->AddPage();

// set some text to print
 
        $tabla='
        <table border="1">
        <thead>
        <tr style="background-color:#ececec;height:10px">
        <td style="width:5%;text-align:center;font-weight:bold">N/P</td>
        <td style="width:10%;text-align:center;font-weight:bold">MODULO</td>
        <td style="width:6%;text-align:center;font-weight:bold">GRUPO</td>
        <td style="width:30%;text-align:center;font-weight:bold">NOMBRE DEL ALUMNO</td>
        <td style="width:39%;text-align:center;font-weight:bold">MOTIVO</td>
        <td style="width:10%;text-align:center;font-weight:bold">FECHA DE BAJA</td>
        
        </tr>
        </thead>

        <tbody>';
       $cont=1;
        foreach ($lista_baja as $baja) {

            $tabla.='<tr style="line-height: 30px">
            <td style="width:5%;text-align:center;font-size: 7px;">'.$cont.'</td>
            <td style="width:10%;text-align:center;font-size: 7px;">'.semestre_en_letra($baja->semestre).'</td>
            <td style="width:6%;text-align:center;font-size: 7px;">'.$baja->nombre_grupo.'</td>
            <td style="width:30%;font-size: 7px;">'.$baja->primer_apellido.' '.$baja->segundo_apellido.' '.$baja->nombre.'</td>
            <td style="width:39%;font-size: 7px;">'.$baja->motivo.'</td>
            <td style="width:10%;font-size: 7px;text-align:center">'.$baja->fecha.'</td>
            
            </tr>';
            $cont++;
            
        }


        if($cont>1){
            $tabla.='<tr style="line-height: 20px;background-color:#909090">
            <td style="width:5%;text-align:center;font-size: 7px">'.$cont.'</td>
            <td style="width:10%"></td>
            <td style="width:6%"></td>
            <td style="width:30%"></td>
            <td style="width:39%"></td>
            <td style="width:10%"></td>
            
            </tr>';
            $cont++;
        }
        

            while ($cont <= 15) {

                $tabla.='<tr style="line-height: 20px">
                <td style="width:5%;text-align:center;font-size: 7px">'.$cont.'</td>
                <td style="width:10%;text-align:center"></td>
                <td style="width:6%"></td>
                <td style="width:30%"></td>
                <td style="width:39%"></td>
                <td style="width:10%"></td>
                
                </tr>';
                $cont++;
                
            }
        


            $date = date_create($fecha_fin);
            $cadena_fecha=date_format($date, 'd').' DE '.$pdf->get_nombre_mes(date_format($date, 'm')).' DE '.date_format($date, 'Y');

        $tabla.=' </tbody>
        </table>
            <br>
            <br>

        <span style="font-weight: bold">Fecha:</span>'.$cadena_fecha.'
        ';

// print a block of text using Write()
// output the HTML content
$pdf->writeHTML($tabla, true, 0, true, true);


//Close and output PDF document
$pdf->Output('Lista de bajas.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>