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
		$this->load->model('M_regularizacion');
		$this->load->model('M_estudiante');
		$this->load->model('M_plantel');
		
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

					$no_control= trim($calificaciones_friae->getCell('A9')->getValue());

					$matricula= trim($calificaciones_friae->getCell('B9')->getValue());
					
					$id_ciclo_escolar=""; //inicializamos variable
					$id_grupo=""; //inicializamos variable id_grupo
					$id_periodo="";//inicalizamos variable periodo
					$existe_grupo=0;//inicializamos varfiable existe grupo
					$num_materias=0; //inicalizamos variable numero de materias semestre
					
					$cont_materias_reprobadas=0;// Contador de materias reprobadas por cada alumno
					$cont_materias_estudiante=0;// cuenta el número de materias subidas por el estudiante.
					$resultado_error="";
					

					$num_materias=$this->num_materias_semestre($modulo);
					
					 ///////////////////////////////////////////////////COMIENZA VALIDACIÓN DE DATOS ///////////////////////

					  if($plantel_cct==""){
							$resultado_error.="<li>No ha seleccionado CCT de un Plantel.</li>";  
					  }

					  else{
						  if(empty($this->M_plantel->get_plantel($plantel_cct))){
							$resultado_error.="<li>CCT de Plantel incorrecto, vuelva a seleccionar.</li>";
						  }
					  }

					  if($periodo==""){
						$resultado_error.="<li>No ha seleccionado un periodo.</li>";  
						  }
						  
						  else{
							  if(trim($periodo)!='FEBRERO-JULIO' && trim($periodo)!='AGOSTO-ENERO'){
								$resultado_error.="<li>Seleccione un periodo valido.</li>";
							  }
						  }
					  
					  if($nombre_ciclo_escolar==""){
							$resultado_error.="<li>No ha seleccionado el ciclo escolar.</li>"; 

					  }
					  else{
							if(empty($this->M_ciclo_escolar->existe_ciclo_escolar_x_periodo_x_nombre($periodo,$nombre_ciclo_escolar))){
								$resultado_error.="<li>El ciclo escolar seleccionado no se encuentra dado de alta en el sistema, consulte al Depto. de Control Escolar</li>";
								
							}
					  }
					  
					  
					  
					  if($modulo=="" && $modulo>6){
							$resultado_error.="<li>No ha seleccionado un semestre valido.</li>";  
					  }
					  
					  if($grupo==""){
							$resultado_error.="<li>No ha seleccionado un grupo.</li>";  
					  }
					  
					  if($no_control==""){
							$resultado_error.="<li>No ha ingresado un número de control del alumno.</li>"; 
							
					  }

					  else{
						 if(empty($this->M_estudiante->get_estudiante($no_control)['estudiante'][0])){
							$resultado_error.="<li>Los datos pertenecientes al número de control <span style='font-weight:bold'>".$no_control."</span> no se encuentran registrados en el sistema, ingrese los datos del estudiante en el módulo correspondiente.</li>"; 
						 } 
						 
					  }

					  $calificacion_valida = array("/",5,6,7,8,9,10);
					  $cont_calificacion=0;
					  

					  foreach ($calificaciones_friae->getRowIterator(13) as $fila) {

							$fila=$fila->getCellIterator("A","I");

							foreach ($fila as $celda) {
								$fila = $celda->getRow();
								$columna = $celda->getColumn();

								/*if($columna=='A' && $columna==''){
									$p1=trim($celda->getValue());
									
								}*/
								
								if($columna=='B' && trim($celda->getValue())!='' && in_array($celda->getValue(), $calificacion_valida)){
									$columna++;
									
								}

								if($columna=='C' && trim($celda->getValue())!='' && in_array($celda->getValue(), $calificacion_valida)){
									$columna++;
									
								}

								if($columna=='D' && trim($celda->getValue())!='' && in_array($celda->getValue(), $calificacion_valida)){
									$columna++;
									
								}
								
									
								

								

								/*if($columna=='C'){
									$p2=trim($celda->getValue());
									
								}

								if($columna=='D'){
									$p3=trim($celda->getValue());
									
								}

								if($columna=='E'){
									$promedio_modular=$celda->getCalculatedValue();
									
								}

								if($columna=='F'){
									$examen_final=$celda->getCalculatedValue();
									
								}

								if($columna=='G'){
									$cal_final=$celda->getCalculatedValue();


								}*/
							}
						}
					  
					  
					  
					  
					  
					  
					  
					  
					  
					  ///////////////////////////////////////////////TERMINA VALIDACIÓN DE DATOS ////////////////////////////
					if($resultado_error==""){
					
					
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

					
						
					
						foreach ($calificaciones_friae->getRowIterator(13) as $fila) {
							
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
									$clave=trim($celda->getValue());
									$bandera++;
								}

								if($columna=='B'){
									$p1=trim($celda->getValue());
									if($p1=='/'){
										$p1=0;
									}
									$bandera++;
								}

								if($columna=='C'){
									$p2=trim($celda->getValue());
									if($p2=='/'){
										$p2=0;
									}
									$bandera++;
								}

								if($columna=='D'){
									$p3=trim($celda->getValue());
									if($p3=='/'){
										$p3=0;
									}
									$bandera++;
								}

								if($columna=='E'){
									$promedio_modular=$celda->getCalculatedValue();
									if($promedio_modular=='/'){
										$promedio_modular=0;
									}
									$bandera++;
								}

								if($columna=='F'){
									$examen_final=$celda->getCalculatedValue();
									if($examen_final=='/'){
										$examen_final=0;
									}
									$bandera++;
								}

								if($columna=='G'){
									$cal_final=$celda->getCalculatedValue();
									if($cal_final=='/'){
										$cal_final=0;
									}

									$bandera++;
								}

								if($bandera==7){//Solo se insertaran aquellas calificaciones en donde todas las 9 columnas esten rellenados.
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

									/*if($no_control!=$temp_no_control){
										$cont_materias_reprobadas=0;
									}

									if(intval(trim($cal_final))<=5){
										$cont_materias_reprobadas=$cont_materias_reprobadas+1;
										$estudiantes_grupo[$no_control]=['materias_reprobadas'=>$cont_materias_reprobadas];
										$temp_no_control=$no_control;
										
									}*/
									
									  
									
									$existe_alumno_materia='';
									
									$existe_alumno_materia=count($this->M_grupo_estudiante->existe_materia_grupo_ciclo_anterior($id_grupo,$clave,$no_control));

									if($existe_alumno_materia==0){
										$this->M_grupo_estudiante->insertar_calificaciones_ciclos_anteriores($datos_calificacion_estudiante);
									}
									
								}
								

								}

								

								
								
							}
						}

						
						
						
//Termina a leer hoja Friae y calificaciones_______________________________________________________________________
					
//Empieza a leer pestaña FRER_______________________________________________________________________________________
					$indiceHoja = 0;
					$frer = $spreadsheet->getSheet($indiceHoja);
					echo "<h3>Vamos en la hoja con índice $indiceHoja</h3>";

					foreach ($frer->getRowIterator(3) as $fila) {
						
						$clave_materia='';
						$calificacion_regularizacion=null;
						$fecha_regularizacion=null;
						$hora_regularizacion=null;
						$bandera=0;
						

						$fila=$fila->getCellIterator("A","J");

						foreach ($fila as $celda) {
							if(!is_null($celda->getValue())){

							$fila = $celda->getRow();
							# Columna, que es la A, B, C y así...
							$columna = $celda->getColumn();
							

							

							if($columna=='A'){
								$clave_materia=trim($celda->getValue());
								$bandera++;
							}

							if($columna=='H'){
								$calificacion_regularizacion=$celda->getValue();
								$bandera++;
							}

							if($columna=='I'){
								$fecha_regularizacion=$celda->getFormattedValue();
								$bandera++;
							}

							if($columna=='J'){
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

								$existe_regu=count($this->M_regularizacion->existe_regu_ciclo_anterior($plantel_cct,$clave_materia,$no_control,$fecha_regularizacion));
								if($existe_regu==0){
									$this->M_regularizacion->insertar_regularizacion_ciclos_anteriores($datos_regularizacion_estudiante);

									
								}

								
								

							}
							

							}

							

							
							
						}
					}

//TERmina lectura de pestaña FRER---------------------------------------------------------------------------------


//Empieza actualizacion de estado del estudiante-------------------------------------------------------------------

echo "----------------------------------------------------------------------------";
$num_adeudos=0;
$num_adeudos=count($this->M_regularizacion->materias_debe_estudiante_actualmente($no_control));
$this->M_regularizacion->actualizar_estatus_estudiante($no_control,$num_adeudos,$modulo,$plantel_cct,$matricula);


//TErmina actulizacion de estado del estudiante--------------------------------------------------------------------
			}
			
			else{
				echo $resultado_error;
				
			}





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