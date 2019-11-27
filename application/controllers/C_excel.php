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

class C_excel extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// load model
       // $this->load->model('Site', 'site');
	}
	// index
	public function index()
	{
		$data = array();
		$data['title'] = 'Import Excel Sheet | TechArise';
		$data['breadcrumbs'] = array('Home' => '#');
		$this->load->view('spreadsheet/index', $data);
	}

	// file upload functionality
    public function upload() {
    	$data = array();
        $data['title'] = 'Import Excel Sheet | TechArise';
        $data['breadcrumbs'] = array('Home' => '#');
    	 // Load form validation library
         $this->load->library('form_validation');
         $this->form_validation->set_rules('fileURL', 'Upload File', 'callback_checkFileValidation');
         if($this->form_validation->run() == false) {
            
            $this->load->view('spreadsheet/index', $data);
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
                
                //Empieza a leer hoja Friae y calificaciones
                    $indiceHoja = 0;
                    $calificaciones_friae = $spreadsheet->getSheet($indiceHoja);
                    echo "<h3>Vamos en la hoja con índice $indiceHoja</h3>";
                    
                    # Lo que hay en B2
                    $celda = $calificaciones_friae->getCell('B2');
                    # El valor, así como está en el documento
                    $plantel_cct = $celda->getValue();

                    $ciclo_escolar= $calificaciones_friae->getCell('B3')->getValue();

                    $periodo= $calificaciones_friae->getCell('B4')->getValue();

                    $modulo= $calificaciones_friae->getCell('B5')->getValue();

                    $grupo= $calificaciones_friae->getCell('B6')->getValue();

                    echo $plantel_cct.'_'.$ciclo_escolar.'_'.$periodo.'_'.$modulo.'_'.$grupo;                
                
                
                    //Empieza a leer hoja Friae y calificaciones
            
                
            }
            // If file uploaded
           /*
           
           # Formateado por ejemplo como dinero o con decimales
                    $valorFormateado = $celda->getFormattedValue();
                    # Si es una fórmula y necesitamos su valor, llamamos a:
                    $valorCalculado = $celda->getCalculatedValue();
                    # Imprimir
                    echo "En <strong>B2</strong> tenemos el valor <strong>$valorRaw</strong>. ";
                    echo "Formateado es: <strong>$valorFormateado</strong>. ";
                    echo "Calculado es: <strong>$valorCalculado</strong><br><br>";
           
           
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
				$allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
			
				// array Count
				$arrayCount = count($allDataInSheet);
	            $flag = 0;
	            $createArray = array('First_Name', 'Last_Name', 'Email', 'DOB', 'Contact_No');
	            $makeArray = array('First_Name' => 'First_Name', 'Last_Name' => 'Last_Name', 'Email' => 'Email', 'DOB' => 'DOB', 'Contact_No' => 'Contact_No');
                $SheetDataKey = array();
                
                
	            foreach ($allDataInSheet as $dataInSheet) {
	                foreach ($dataInSheet as $key => $value) {
	                    if (in_array(trim($value), $createArray)) {
                            $value = preg_replace('/\s+/', '', $value);
                            
	                        $SheetDataKey[trim($value)] = $key;
	                    } 
	                }
	            }
	            $dataDiff = array_diff_key($makeArray, $SheetDataKey);
	            if (empty($dataDiff)) {
                	$flag = 1;
            	}
            	// match excel sheet column
	            if ($flag == 1) {
	                for ($i = 2; $i <= $arrayCount; $i++) {
	                    $addresses = array();
	                    $firstName = $SheetDataKey['First_Name'];
	                    $lastName = $SheetDataKey['Last_Name'];
	                    $email = $SheetDataKey['Email'];
	                    $dob = $SheetDataKey['DOB'];
	                    $contactNo = $SheetDataKey['Contact_No'];

	                    $firstName = filter_var(trim($allDataInSheet[$i][$firstName]), FILTER_SANITIZE_STRING);
	                    $lastName = filter_var(trim($allDataInSheet[$i][$lastName]), FILTER_SANITIZE_STRING);
	                    $email = filter_var(trim($allDataInSheet[$i][$email]), FILTER_SANITIZE_EMAIL);
	                    $dob = filter_var(trim($allDataInSheet[$i][$dob]), FILTER_SANITIZE_STRING);
	                    $contactNo = filter_var(trim($allDataInSheet[$i][$contactNo]), FILTER_SANITIZE_STRING);
	                    $fetchData[] = array('first_name' => $firstName, 'last_name' => $lastName, 'email' => $email, 'dob' => $dob, 'contact_no' => $contactNo);
	                }   
	                $data['dataInfo'] = $fetchData;
	                //$this->site->setBatchImport($fetchData);
	                //$this->site->importData();
	            } else {
	                echo "Please import correct file, did not match excel sheet column";
	            }
	           // $this->load->view('spreadsheet/display', $data);
        	}              */
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
                $this->form_validation->set_message('checkFileValidation', 'Please choose correct file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('checkFileValidation', 'Please choose a file.');
            return false;
        }
    }

}
