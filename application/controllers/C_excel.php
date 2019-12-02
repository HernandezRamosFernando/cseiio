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
		$this->load->model('M_ciclo_escolar');
		$this->load->model('M_grupo');
		$this->load->model('M_grupo_estudiante');
		$this->load->model('M_Regularizacion');
	}
	// index
	public function index()
	{
		$data = array();
		$data['title'] = 'Import Excel Sheet | TechArise';
		$data['breadcrumbs'] = array('Home' => '#');
		$this->load->view('spreadsheet/index', $data);
	}

	public function num_materias_semestre($id_semestre){
		$resultado=0;
		switch ($id_semestre) {

			case 1:
				$resultado=13;//Numero de materias
				break;
			case 2:
				$resultado=14;//Numero de materias
			break;

			case 3:
				$resultado=13;//Numero de materias
			break;

			case 4:
				$resultado=12;//Numero de materias
			break;

			case 5:
				$resultado=9;//Numero de materias
			break;

			case 6:
				$resultado=8;//Numero de materias
			break;
		}
		return $resultado;
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
                
//Empieza a leer hoja Friae y calificaciones___________________________________________________________________
                    $indiceHoja = 0;
                    $calificaciones_friae = $spreadsheet->getSheet($indiceHoja);
                    echo "<h3>Vamos en la hoja con índice $indiceHoja</h3>";
                    
                    # Lo que hay en B2
                    $celda = $calificaciones_friae->getCell('B2');
                    # El valor, así como está en el documento
                    $plantel_cct = trim($celda->getValue());

                    $nombre_ciclo_escolar= trim($calificaciones_friae->getCell('B3')->getValue());

                    $periodo= trim($calificaciones_friae->getCell('B4')->getValue());

                    $modulo= trim($calificaciones_friae->getCell('B5')->getValue());

					$grupo= trim($calificaciones_friae->getCell('B6')->getValue());
					
					$id_ciclo_escolar=""; //inicializamos variable
					$id_grupo=""; //inicializamos variable id_grupo
					$id_periodo="";//inicalizamos variable periodo
					$existe_grupo=0;//inicializamos varfiable existe grupo
					$num_materias=0; //inicalizamos variable numero de materias semestre
					
					$cont_materias_reprobadas=0;// Contador de materias reprobadas por cada alumno
					$cont_materias_estudiante=0;// cuenta el número de materias subidas por el estudiante.
					$temp_no_control='';// Almacena de manera temporal el número de control de cada estudiante
					$estudiantes_grupo=[];

					$num_materias=$this->num_materias_semestre($modulo);
					$id_ciclo_escolar=$this->M_ciclo_escolar->get_id_ciclo_escolar_x_periodo_x_nombre($periodo,$nombre_ciclo_escolar)->id_ciclo_escolar;

					if(trim($periodo) == "AGOSTO-ENERO"){
						$id_periodo="B";
					  }else{
						$id_periodo="A";
					  }


					$id_grupo=$plantel_cct.$modulo.$id_ciclo_escolar.$id_periodo.$grupo;// GENERANDO ID_GRUPO

					$existe_grupo=count($this->M_grupo->existe_id_grupo_ciclo_anterior($id_grupo));
		
					if ($existe_grupo==0) 
						{
							$this->M_grupo->agregar_grupo_de_ciclo_anterior($id_grupo,$modulo,$grupo,$plantel_cct);
						}

					
						
					
						foreach ($calificaciones_friae->getRowIterator(10) as $fila) {
							$no_control='';
								$matricula='';
								$clave='';
								$p1=null;
								$p2=null;
								$p3=null;
								$promedio_modular=null;
								$examen_final=null;
								$cal_final=null;
								$bandera=0;
								$num_materias_reprobadas=0;
								$cont_materias_alumno=0;

							$fila=$fila->getCellIterator("A","I");

							foreach ($fila as $celda) {
								if(!is_null($celda->getValue())){

								$fila = $celda->getRow();
								# Columna, que es la A, B, C y así...
								$columna = $celda->getColumn();
								

								if($columna=='A'){
									$no_control=trim($celda->getValue());
									$bandera++;
									
									
								}

								if($columna=='B'){
									$matricula=trim($celda->getValue());
									$bandera++;
								}

								if($columna=='C'){
									$clave=trim($celda->getValue());
									$bandera++;
								}

								if($columna=='D'){
									$p1=trim($celda->getValue());
									if($p1=='/'){
										$p1=0;
									}
									$bandera++;
								}

								if($columna=='E'){
									$p2=trim($celda->getValue());
									if($p2=='/'){
										$p2=0;
									}
									$bandera++;
								}

								if($columna=='F'){
									$p3=trim($celda->getValue());
									if($p3=='/'){
										$p3=0;
									}
									$bandera++;
								}

								if($columna=='G'){
									$promedio_modular=$celda->getCalculatedValue();
									if($promedio_modular=='/'){
										$promedio_modular=0;
									}
									$bandera++;
								}

								if($columna=='H'){
									$examen_final=$celda->getCalculatedValue();
									if($examen_final=='/'){
										$examen_final=0;
									}
									$bandera++;
								}

								if($columna=='I'){
									$cal_final=$celda->getCalculatedValue();
									if($cal_final=='/'){
										$cal_final=0;
									}

									$bandera++;
								}

								if($bandera==9){//Solo se insertaran aquellas calificaciones en donde todas las 9 columnas esten rellenados.
									$datos_calificacion_estudiante = array(
										'Grupo_id_grupo' => strtoupper($id_grupo),
										'Estudiante_no_control' => strtoupper($no_control),
										'Ciclo_escolar_id_ciclo_escolar' =>$id_ciclo_escolar,
										'id_materia' => strtoupper($clave),
										'primer_parcial' => $p1,
										'segundo_parcial' => $p2,
										'tercer_parcial' => $p3,
										'examen_final' => $examen_final,
										'calificacion_final' => $cal_final
									);

									if($no_control!=$temp_no_control){
										$cont_materias_reprobadas=0;
									}

									if(intval(trim($cal_final))<=5){
										$cont_materias_reprobadas=$cont_materias_reprobadas+1;
										$estudiantes_grupo[$no_control]=['materias_reprobadas'=>$cont_materias_reprobadas];
										$temp_no_control=$no_control;
										
									}
									  
									
									$existe_alumno_materia='';
									
									$existe_alumno_materia=count($this->M_grupo_estudiante->existe_materia_grupo_ciclo_anterior($id_grupo,$clave,$no_control));

									if($existe_alumno_materia==0){
										$this->M_grupo_estudiante->insertar_calificaciones_ciclos_anteriores($datos_calificacion_estudiante);
									}
									
								}
								

								}

								

								
								
							}
						}

						echo "Hola mundo: ";
						var_dump($estudiantes_grupo);
						
//Termina a leer hoja Friae y calificaciones_______________________________________________________________________
					
//Empieza a leer pestaña FRER_______________________________________________________________________________________
					$indiceHoja = 1;
					$frer = $spreadsheet->getSheet($indiceHoja);
					echo "<h3>Vamos en la hoja con índice $indiceHoja</h3>";

					foreach ($frer->getRowIterator(3) as $fila) {
						$no_control='';
						$clave_materia='';
						$calificacion_regularizacion=null;
						$fecha_regularizacion=null;
						$hora_regularizacion=null;
						$bandera=0;
						

						$fila=$fila->getCellIterator("A","E");

						foreach ($fila as $celda) {
							if(!is_null($celda->getValue())){

							$fila = $celda->getRow();
							# Columna, que es la A, B, C y así...
							$columna = $celda->getColumn();
							

							if($columna=='A'){
								$no_control=trim($celda->getValue());
								$bandera++;
							}

							if($columna=='B'){
								$clave_materia=trim($celda->getValue());
								$bandera++;
							}

							if($columna=='C'){
								$calificacion_regularizacion=$celda->getValue();
								$bandera++;
							}

							if($columna=='D'){
								$fecha_regularizacion=$celda->getFormattedValue();
								$bandera++;
							}

							if($columna=='E'){
								$hora_regularizacion=$celda->getFormattedValue();
								$bandera++;
							}

							

							if($bandera==5){//Solo se insertaran aquellas calificaciones en donde todas las 9 columnas esten rellenados.
								$datos_regularizacion_estudiante = array(
									'id_materia' => strtoupper($clave_materia),
									'calificacion' =>$calificacion_regularizacion,
									'fecha_calificacion' =>$fecha_regularizacion,
									'Estudiante_no_control' => $no_control,
									'Plantel_cct_plantel' => $plantel_cct,
									'estatus'=>0,
									'hora'=>$hora_regularizacion,
									'fecha'=>date('Y-m-d')

								);

								$existe_regu=count($this->M_Regularizacion->existe_regu_ciclo_anterior($plantel_cct,$clave_materia,$no_control,$fecha_regularizacion));
								if($existe_regu==0){
									$this->M_Regularizacion->insertar_regularizacion_ciclos_anteriores($datos_regularizacion_estudiante);
								}

								
								

							}
							

							}

							

							
							
						}
					}

//TERmina lectura de pestaña FRER---------------------------------------------------------------------------------

//Empieza actualizacion de estado del estudiante-------------------------------------------------------------------
$estudiantes_grupo=$this->M_grupo->get_estudiantes_grupo($id_grupo);
var_dump($estudiantes_grupo);
echo "----------------------------------------------------------------------------";
foreach($estudiantes_grupo as $e){

	$num_adeudos= count($this->M_grupo->materias_adeudo_estudiante($e->no_control));
	$this->M_grupo->actualizar_estatus_estudiante($e->no_control,$num_adeudos,$modulo,$plantel_cct);
	
	/*$num_adeudos= count($this->M_regularizacion->get_materias_adeudo_estudiante($e->no_control));
	*/


}


//TErmina actulizacion de estado del estudiante--------------------------------------------------------------------
            }
            // If file uploaded
		   /*
		   # El valor, así como está en el documento
								$valorRaw = $celda->getValue();
								# Formateado por ejemplo como dinero o con decimales
								$valorFormateado = $celda->getFormattedValue();
								# Si es una fórmula y necesitamos su valor, llamamos a:
								$valorCalculado = $celda->getCalculatedValue();
								# Fila, que comienza en 1, luego 2 y así...
								$fila = $celda->getRow();
								# Columna, que es la A, B, C y así...
								$columna = $celda->getColumn();

           
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
//Hola mundo