<?php
/**
 * @package Phpspreadsheet :  Phpspreadsheet
 * @author TechArise Team
 *
 * @email  info@techarise.com
 *   
 * Description of Phpspreadsheet Controller
 */

defined('BASEPATH') OR exit('No direct script access allowed');
//PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;



class C_prueba extends CI_Controller {

	public $archivo;

	

	public function get_archivo(){
			return $this->archivo;
	}

	public function set_archivo($archivo_excel){
		$this->archivo=$archivo_excel;
	}

	public function __construct()
	{
		parent::__construct();
		// load model
		
		
		
	}
	// index
	

	

	public function num_mes($mes){
		$resultado='';
		switch ($mes) {

			case 'ENERO':
				$resultado=1;//Numero de mES
				break;
			case 'FEBRERO':
				$resultado=2;//Numero de mes
			break;

			case 'MARZO':
				$resultado=3;//Numero de mes
			break;

			case 'ABRIL':
				$resultado=4;//Numero de mes
			break;

			case 'MAYO':
				$resultado=5;//Numero de mes
			break;

			case 'JUNIO':
				$resultado=6;//Numero de mes
			break;

			case 'JULIO':
				$resultado=7;//Numero de mes
			break;

			case 'AGOSTO':
				$resultado=8;//Numero de mes
			break;

			case 'SEPTIEMBRE':
				$resultado=9;//Numero de mes
			break;

			case 'OCTUBRE':
				$resultado=10;//Numero de mes
			break;

			case 'NOVIEMBRE':
				$resultado=11;//Numero de mes
			break;

			case 'DICIEMBRE':
				$resultado=12;//Numero de mes
			break;
		}
		return $resultado;
	}
	


	

	//preg_match("/^(?:2[0-3]|[01][0-9]|[0-9]):[0-5][0-9]$/", $time)

	//if(preg_match('/^(?:[01][0-9]|2[0-3]):[0-5][0-9]$/',$input)) {
        //$input is valid HH:MM format.
//}([0-9]+):([0-5]?[0-9]):([0-5]?[0-9])
	
	

	// file upload functionality
    public function upload() {
    	$data= array('title'=>'Importar archivo de Excel');
    	 // Load form validation library
         $this->load->library('form_validation');
         $this->form_validation->set_rules('fileURL', 'Upload File', 'callback_checkFileValidation');
         if($this->form_validation->run() == false) {

			//redirect('C_vistas/lectura_excel');
			$data= array('title'=>'Importar archivo de Excel');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdacescolar");
            $this->load->view("spreadsheet/upload_excel");
            $this->load->view("footers/footer");

         } else {

            if(!empty($_FILES['fileURL']['name'])) { 
            	// get file extension
            	$extension = pathinfo($_FILES['fileURL']['name'], PATHINFO_EXTENSION);

            	if($extension == 'csv'){
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
				} elseif($extension == 'xlsx') {
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
				} else {
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
				}
				// file path
				$spreadsheet = $reader->load($_FILES['fileURL']['tmp_name']);
                
                $totalDeHojas = $spreadsheet->getSheetCount();
                
//Empieza a leer hoja Friae y calificaciones___________________________________________________________________
$this->set_archivo($spreadsheet);



$indiceHoja = 0;
$plantilla_excel = $spreadsheet->getSheet($indiceHoja);
$tipo_operacion_excel='';
$tipo_operacion_excel= trim($plantilla_excel->getCell('B1')->getValue());

switch ($tipo_operacion_excel) {
			case 'BAJA SIN MATRICULA'://Empieza caso baja sin matricula
			
			$this->form_validation->set_rules('fileURL','Upload File', 'callback_checkValidateSinMatricula');
		if($this->form_validation->run() != false){
			$indiceHoja = 0;
                    $calificaciones_friae = $spreadsheet->getSheet($indiceHoja);
                   // echo "<h3>Vamos en la hoja con índice $indiceHoja</h3>";
                    
                    # Lo que hay en B2
                    $celda = $calificaciones_friae->getCell('B2');
                    # El valor, así como está en el documento
                    $plantel_cct = trim($celda->getValue());

                    $nombre_ciclo_escolar= trim($calificaciones_friae->getCell('B3')->getValue());

                    $periodo= trim($calificaciones_friae->getCell('B4')->getValue());

                    $modulo= trim($calificaciones_friae->getCell('B5')->getValue());

					$grupo= trim($calificaciones_friae->getCell('B6')->getValue());

					$no_control= trim($calificaciones_friae->getCell('A10')->getValue());

					

					$tipo_operacion='';
					$tipo_operacion= trim($calificaciones_friae->getCell('B1')->getValue());


					$anio_baja= trim($calificaciones_friae->getCell('C10')->getFormattedValue());
					$mes_baja= trim($calificaciones_friae->getCell('D10')->getFormattedValue());
					$dia_baja= trim($calificaciones_friae->getCell('E10')->getFormattedValue());


					$fecha_baja="";

					if($anio_baja!='' && $mes_baja!='' && $dia_baja!=''){
						$fecha_baja=$anio_baja."-".$this->num_mes($mes_baja)."-".$dia_baja;
					}
						

					$motivo_baja= trim($calificaciones_friae->getCell('F10')->getValue());
					$num_adeudos=-1;
					
					
					$id_ciclo_escolar=""; //inicializamos variable
					$id_grupo=""; //inicializamos variable id_grupo
					$id_periodo="";//inicalizamos variable periodo
					$existe_grupo=0;//inicializamos varfiable existe grupo
					$num_materias=0; //inicalizamos variable numero de materias semestre
					
					$cont_materias_reprobadas=0;// Contador de materias reprobadas por cada alumno
					$cont_materias_estudiante=0;// cuenta el número de materias subidas por el estudiante.
					$resultado_error="";
					$id_friae="";
					
//Empieza a leer hoja Friae y calificaciones_______________________________________________________________________
					
echo "Este es el tipo:".$tipo_operacion_excel."------";
echo "motivo baja es:".$motivo_baja."------";


		
		
		
		
		
		
		$this->session->set_flashdata('msg_exito', 'Los datos del alumno con estatus <span style="font-weight:bold">BAJA SIN MATRICULA</span> se han agregado al sistema correctamente, para corroborar verique en el reporte KARDEX.');
			
		}
			
			break;//Termina caso baja sin matricula
			
    default://Empieza default
        	

        break;//Termina default
}






			
			
			/*$data= array('title'=>'Importar archivo de Excel');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdacescolar");
            $this->load->view("spreadsheet/upload_excel");
            $this->load->view("footers/footer");*/
				
			





            }
            // If file uploaded
		   /*
		               */
    	}
	}

	// checkFileValidation
    public function checkFileValidation($string) {
      $file_mimes = array('text/x-comma-separated-values', 
      	'text/comma-separated-values', 
      	'application/octet-stream', 
      	'application/vnd.ms-excel', 
      	'application/x-csv', 
      	'text/x-csv', 
      	'text/csv', 
      	'application/csv', 
      	'application/excel', 
      	'application/vnd.msexcel', 
      	'text/plain', 
      	'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
      );
      if(isset($_FILES['fileURL']['name'])) {
			$arr_file = explode('.', $_FILES['fileURL']['name']);
			$extension = end($arr_file);
            if(($extension == 'xlsx' || $extension == 'xls' || $extension == 'csv') && in_array($_FILES['fileURL']['type'], $file_mimes)){
                return true;
            }else{
                $this->form_validation->set_message('checkFileValidation', 'Seleccione un archivo en excel.');
                return false;
            }
        }else{
            $this->form_validation->set_message('checkFileValidation', 'Seleccione un archivo.');
            return false;
        }
	}
	
	

	  
	  public function checkValidateSinMatricula($spreadsheet) {


		$indiceHoja = 0;
                    $calificaciones_friae = $this->get_archivo()->getSheet($indiceHoja);
                   // echo "<h3>Vamos en la hoja con índice $indiceHoja</h3>";
                    
                    # Lo que hay en B2
                    $celda = $calificaciones_friae->getCell('B2');
                    # El valor, así como está en el documento
                    $plantel_cct = trim($celda->getValue());

                    $nombre_ciclo_escolar= trim($calificaciones_friae->getCell('B3')->getValue());

                    $periodo= trim($calificaciones_friae->getCell('B4')->getValue());

                    $modulo= trim($calificaciones_friae->getCell('B5')->getValue());

					$grupo= trim($calificaciones_friae->getCell('B6')->getValue());

					$no_control= trim($calificaciones_friae->getCell('A10')->getValue());

					

					

					$motivo_baja= trim($calificaciones_friae->getCell('F10')->getValue());

					$anio_baja= trim($calificaciones_friae->getCell('C10')->getValue());
					$mes_baja= trim($calificaciones_friae->getCell('D10')->getValue());
					$dia_baja= trim($calificaciones_friae->getCell('E10')->getValue());
					$tipo_operacion='';
					$tipo_operacion= trim($calificaciones_friae->getCell('B1')->getValue());

					$resultado_error='';

					

					

					return true;
					  
		
	  }

}
//Hola mundo