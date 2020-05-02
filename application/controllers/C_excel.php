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
		$this->load->model('M_ciclo_escolar');
		$this->load->model('M_grupo');
		$this->load->model('M_grupo_estudiante');
		$this->load->model('M_regularizacion');
		$this->load->model('M_estudiante');
		$this->load->model('M_plantel');
		$this->load->model('M_materia');
		$this->load->model('M_friae');
		$this->load->model('M_reinscripcion');

		
		
		
	}
	// index
	

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
	
	

	function validar_fecha_espanol($fecha){
		//checkdate(2, 30, 2000); mes, dia,año 2018-12-01
		$valores = explode('-', $fecha);
		if(count($valores) == 3 && checkdate($valores[1], $valores[2], $valores[0])){
			return true;
		}
		return false;
	}


	function validar_fecha($anio,$mes,$dia){
		//checkdate(2, 30, 2000); mes, dia,año 2018-12-01
		//str_pad($dia,2,'0',STR_PAD_LEFT)
		$mes=$this->num_mes($mes);
	   $fecha=$anio."-".str_pad($mes,2,'0',STR_PAD_LEFT)."-".str_pad($dia,2,'0',STR_PAD_LEFT);
	   
		if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$fecha)) {
			
				if(checkdate($mes, $dia, $anio)){
					return true;
				}
				else{
					return false;
				}
			
		}
		else {
			return false;
		}
		
        
		
	}


	function validar_formato_hora($hora){
		
		if(preg_match('/^(?:2[0-3]|[01][0-9]|[0-9]):[0-5][0-9]$/',$hora)) {
			return true;
		}
		
			return false;

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
							$id_friae=$this->M_friae->crear_friae_ciclos_anteriores($id_grupo);
						}


						else{
							$id_friae=$this->M_friae->id_friae($id_grupo)[0]->folio;
						}

					
						
					
						foreach ($calificaciones_friae->getRowIterator(15) as $fila) {
							
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

							$fila=$fila->getCellIterator("B","H");

							foreach ($fila as $celda) {
								if(!is_null($celda->getValue())){

								$fila = $celda->getRow();
								# Columna, que es la A, B, C y así...
								$columna = $celda->getColumn();
								


								if($columna=='B'){
									$clave=trim($celda->getValue());
									$bandera++;
								}

								if($columna=='C'){
									$p1=trim($celda->getValue());
									if($p1=='/'){
										$p1=0;
									}
									$bandera++;
								}

								if($columna=='D'){
									$p2=trim($celda->getValue());
									if($p2=='/'){
										$p2=0;
									}
									$bandera++;
								}

								if($columna=='E'){
									$p3=trim($celda->getValue());
									if($p3=='/'){
										$p3=0;
									}
									$bandera++;
								}


								if($columna=='F'){
									$promedio_modular=$celda->getCalculatedValue();
									if($promedio_modular=='/'){
										$promedio_modular=0;
									}
									$bandera++;
								}

								if($columna=='G'){
									$examen_final=$celda->getCalculatedValue();
									if($examen_final=='/'){
										$examen_final=0;
									}
									$bandera++;
								}

								if($columna=='H'){
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

									
									$datos_calificacion_estudiante_update = array(
										'primer_parcial' => $p1,
										'segundo_parcial' => $p2,
										'tercer_parcial' => $p3,
										'examen_final' => $examen_final,
										'calificacion_final' => $cal_final
									);

									$parametros_estudiante_update_cal = array(
										'id_grupo' => strtoupper($id_grupo),
										'no_control' => strtoupper($no_control),
										'id_ciclo_escolar' =>$id_ciclo_escolar,
										'id_materia' => strtoupper($clave)
									);
									  
									
									$existe_alumno_materia='';
									
									$existe_alumno_materia=count($this->M_grupo_estudiante->existe_materia_grupo_ciclo_anterior($id_grupo,$clave,$no_control));

									if($existe_alumno_materia==0){
										$this->M_grupo_estudiante->insertar_calificaciones_ciclos_anteriores($datos_calificacion_estudiante);

										$datos_friae = array(
											
											'no_control' => $no_control,
											'id_grupo' => $id_grupo,
											'semestre' =>$modulo,
											'id_friae'=>$id_friae
											
										);
				
										if(count($this->M_friae->get_datos_friae_estudiante($id_grupo,$no_control))==0){
											$this->M_friae->agregar_estudiante_friae_ciclos_anteriores((object)$datos_friae);
										}
										
									}

									else{
										$this->M_grupo_estudiante->actualizar_calificaciones_ciclos_anteriores((object)$parametros_estudiante_update_cal,$datos_calificacion_estudiante_update);
									}
									
									
								}
								

								}

								

								
								
							}
						}

						
						
						
//Termina a leer hoja Friae y calificaciones_______________________________________________________________________
			$matricula="NULL";
		
		$this->M_regularizacion->actualizar_estatus_estudiante($no_control,$num_adeudos,$modulo,$plantel_cct,$matricula,$fecha_baja,$motivo_baja,$tipo_operacion_excel,$grupo);
		
		
		$datos_friae_baja = array(
			'no_control' => $no_control,
			'id_friae' => $id_friae,
			'fecha_baja' =>$fecha_baja,
			'anio_baja' =>$anio_baja,
			'semestre'=>$modulo,
			'periodo'=>$periodo

		);


		$this->M_friae->actualizar_friae_baja_ciclos_anteriores((object)$datos_friae_baja);


		
		
		
		
		
		
		$this->session->set_flashdata('msg_exito', 'Los datos del alumno con estatus <span style="font-weight:bold">BAJA SIN MATRICULA</span> se han agregado al sistema correctamente, para corroborar verique en el reporte KARDEX.');
			
		}
			
			break;//Termina caso baja sin matricula
			case 'DESERTOR'://Empieza caso desertor
			
			$this->form_validation->set_rules('fileURL','Upload File', 'callback_checkValidateDesertor');
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

					$matricula= trim($calificaciones_friae->getCell('B10')->getValue());

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
					$num_adeudos=0;
			$num_adeudos=count($this->M_regularizacion->materias_debe_estudiante_actualmente($no_control));
		
		$this->M_regularizacion->actualizar_estatus_estudiante($no_control,$num_adeudos,$modulo,$plantel_cct,$matricula,$fecha_baja,$motivo_baja,$tipo_operacion_excel,$grupo);
		
		
		$this->session->set_flashdata('msg_exito', 'Los datos del alumno <span style="font-weight:bold">DESERTOR</span> se han agregado al sistema correctamente, para corroborar verique en el reporte KARDEX.');
		}
        
        break;//Termina caso desertor
		
		case 'TRASLADO'://Empieza caso traslado
			
			$this->form_validation->set_rules('fileURL','Upload File', 'callback_checkValidateTraslado');
				if($this->form_validation->run() != false){
					$indiceHoja = 0;
					$id_friae="";
                    $plantilla_traslado = $this->get_archivo()->getSheet($indiceHoja);
                   // echo "<h3>Vamos en la hoja con índice $indiceHoja</h3>";
                    
                    # Lo que hay en B2
                    $celda = $plantilla_traslado->getCell('B2');
                    # El valor, así como está en el documento
					$plantel_cct_origen = trim($celda->getValue());
					$tipo_operacion_excel= trim($plantilla_traslado->getCell('B1')->getValue());
					$nombre_ciclo_escolar= trim($plantilla_traslado->getCell('B3')->getValue());
					$periodo= trim($plantilla_traslado->getCell('B4')->getValue());
					$modulo= trim($plantilla_traslado->getCell('B5')->getValue());
					$grupo_anterior_acreditado= trim($plantilla_traslado->getCell('B6')->getValue());
					$plantel_cct_destino = trim($plantilla_traslado->getCell('B7')->getValue());
					$no_control= trim($plantilla_traslado->getCell('A11')->getValue());
					$matricula= trim($plantilla_traslado->getCell('B11')->getValue());
					$motivo_traslado= trim($plantilla_traslado->getCell('F11')->getValue());
					
					$anio_traslado= trim($plantilla_traslado->getCell('C11')->getValue());
					$mes_traslado= trim($plantilla_traslado->getCell('D11')->getValue());
					$dia_traslado= trim($plantilla_traslado->getCell('E11')->getValue());

					$fecha_traslado="";

					if($anio_traslado!='' && $mes_traslado!='' && $dia_traslado!=''){
						$fecha_traslado=$anio_traslado."-".$this->num_mes($mes_traslado)."-".$dia_traslado;
					}

					$ciclo_escolar=""; //inicializamos variable
					$id_grupo=""; //inicializamos variable id_grupo
					$grupo="";
					$ciclo_escolar=$this->M_ciclo_escolar->get_id_ciclo_escolar_x_periodo_x_nombre($periodo,$nombre_ciclo_escolar);

					$id_ciclo_escolar=$ciclo_escolar->id_ciclo_escolar;

					if(trim($periodo) == "AGOSTO-ENERO"){
						$id_periodo="B";
					  }else{
						$id_periodo="A";
					  }
					  $datos_grupo_actual=$this->M_grupo_estudiante->grupo_semestre_estudiante_x_ciclo_escolar($no_control,$id_ciclo_escolar,$modulo);
					  $grupo=$datos_grupo_actual->nombre_grupo;

					  $id_grupo=$plantel_cct_destino.$modulo.$id_ciclo_escolar.$id_periodo.$grupo;// GENERANDO ID_GRUPO

					 
					$id_friae=$this->M_friae->id_friae($id_grupo)[0]->folio;
					

					  $datos_traslado = array(
						'no_control' => $no_control,
						'cct_origen' => $plantel_cct_origen,
						'cct_traslado' => $plantel_cct_destino,
						'fecha_tramite' => $fecha_traslado,
						'fecha_inicio_ciclo_escolar'=>$ciclo_escolar->fecha_inicio,
						'motivo'=>$motivo_traslado,
						'semestre'=>$modulo,
						'grupo_anterior_acreditado'=>$grupo_anterior_acreditado,
						'id_friae'=>$id_friae
					);


						
					$this->M_reinscripcion->traslado_ciclos_anteriores((object)$datos_traslado);
					
                  /*  $calificaciones_friae = $spreadsheet->getSheet($indiceHoja);
                   
		
		$this->M_regularizacion->actualizar_estatus_estudiante($no_control,$num_adeudos,$modulo,$plantel_cct,$matricula,$fecha_baja,$motivo_baja,$tipo_operacion_excel,$grupo);*/
		
		
		$this->session->set_flashdata('msg_exito', 'Los datos del alumno <span style="font-weight:bold">TRASLADO</span> se han agregado al sistema correctamente, para corroborar verique en el reporte KARDEX.');
		}
        
        break;//Termina caso traslado
		
    case 'BAJA': //Empieza caso Baja
			$this->form_validation->set_rules('fileURL','Upload File', 'callback_checkValidateBaja');
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

					$matricula= trim($calificaciones_friae->getCell('B10')->getValue());

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
							$id_friae=$this->M_friae->crear_friae_ciclos_anteriores($id_grupo);
						}


						else{
							$id_friae=$this->M_friae->id_friae($id_grupo)[0]->folio;
						}

					
						
					
						foreach ($calificaciones_friae->getRowIterator(15) as $fila) {
							
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

							$fila=$fila->getCellIterator("B","H");

							foreach ($fila as $celda) {
								if(!is_null($celda->getValue())){

								$fila = $celda->getRow();
								# Columna, que es la A, B, C y así...
								$columna = $celda->getColumn();
								


								if($columna=='B'){
									$clave=trim($celda->getValue());
									$bandera++;
								}

								if($columna=='C'){
									$p1=trim($celda->getValue());
									if($p1=='/'){
										$p1=0;
									}
									$bandera++;
								}

								if($columna=='D'){
									$p2=trim($celda->getValue());
									if($p2=='/'){
										$p2=0;
									}
									$bandera++;
								}

								if($columna=='E'){
									$p3=trim($celda->getValue());
									if($p3=='/'){
										$p3=0;
									}
									$bandera++;
								}


								if($columna=='F'){
									$promedio_modular=$celda->getCalculatedValue();
									if($promedio_modular=='/'){
										$promedio_modular=0;
									}
									$bandera++;
								}

								if($columna=='G'){
									$examen_final=$celda->getCalculatedValue();
									if($examen_final=='/'){
										$examen_final=0;
									}
									$bandera++;
								}

								if($columna=='H'){
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

										$datos_friae = array(
											
											'no_control' => $no_control,
											'id_grupo' => $id_grupo,
											'semestre' =>$modulo,
											'id_friae'=>$id_friae
											
										);
				
										if(count($this->M_friae->get_datos_friae_estudiante($id_grupo,$no_control))==0){
											$this->M_friae->agregar_estudiante_friae_ciclos_anteriores((object)$datos_friae);
										}
										
									}
									
									
								}
								

								}

								

								
								
							}
						}

						
						
						
//Termina a leer hoja Friae y calificaciones_______________________________________________________________________
			
		
		$this->M_regularizacion->actualizar_estatus_estudiante($no_control,$num_adeudos,$modulo,$plantel_cct,$matricula,$fecha_baja,$motivo_baja,$tipo_operacion_excel,$grupo);
		
		
		$datos_friae_baja = array(
			'no_control' => $no_control,
			'id_friae' => $id_friae,
			'fecha_baja' =>$fecha_baja,
			'anio_baja' =>$anio_baja,
			'semestre'=>$modulo,
			'periodo'=>$periodo

		);


		$this->M_friae->actualizar_friae_baja_ciclos_anteriores((object)$datos_friae_baja);


		
		
		
		
		
		
		$this->session->set_flashdata('msg_exito', 'Los datos del alumno con estatus <span style="font-weight:bold">BAJA</span> se han agregado al sistema correctamente, para corroborar verique en el reporte KARDEX.');
			
		}
        
        break;//Termina caso Baja
    default://Empieza default
        	$this->form_validation->set_rules('fileURL','Upload File', 'callback_checkCamposPermitidos');

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

					$matricula= trim($calificaciones_friae->getCell('B10')->getValue());
					
					if($matricula==''){
						$matricula="NULL";
					}

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

					
					$ciclo_escolar="";
					$id_ciclo_escolar=""; //inicializamos variable
					$id_grupo=""; //inicializamos variable id_grupo
					$id_periodo="";//inicalizamos variable periodo
					$existe_grupo=0;//inicializamos varfiable existe grupo
					$num_materias=0; //inicalizamos variable numero de materias semestre
					
					$cont_materias_reprobadas=0;// Contador de materias reprobadas por cada alumno
					$cont_materias_estudiante=0;// cuenta el número de materias subidas por el estudiante.
					$resultado_error="";
					

					
					
					

					$ciclo_escolar=$this->M_ciclo_escolar->get_id_ciclo_escolar_x_periodo_x_nombre($periodo,$nombre_ciclo_escolar);

					$id_ciclo_escolar=$ciclo_escolar->id_ciclo_escolar;

					

					if(trim($periodo) == "AGOSTO-ENERO"){
						$id_periodo="B";
					  }else{
						$id_periodo="A";
					  }
					  
					 


					$id_grupo=$plantel_cct.$modulo.$id_ciclo_escolar.$id_periodo.$grupo;// GENERANDO ID_GRUPO
					$id_friae="";

					$existe_grupo=count($this->M_grupo->existe_id_grupo_ciclo_anterior($id_grupo));
		
					if ($existe_grupo==0) 
						{
							$this->M_grupo->agregar_grupo_de_ciclo_anterior($id_grupo,$modulo,$grupo,$plantel_cct);

							$id_friae=$this->M_friae->crear_friae_ciclos_anteriores($id_grupo);

						}
						else{
							$id_friae=$this->M_friae->id_friae($id_grupo)[0]->folio;
						}

					
						
					
						foreach ($calificaciones_friae->getRowIterator(15) as $fila) {
							
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

							$fila=$fila->getCellIterator("B","H");

							foreach ($fila as $celda) {
								if(!is_null($celda->getValue())){

								$fila = $celda->getRow();
								# Columna, que es la A, B, C y así...
								$columna = $celda->getColumn();
								


								if($columna=='B'){
									$clave=trim($celda->getValue());
									$bandera++;
								}

								if($columna=='C'){
									$p1=trim($celda->getValue());
									if($p1=='/'){
										$p1=0;
									}
									$bandera++;
								}

								if($columna=='D'){
									$p2=trim($celda->getValue());
									if($p2=='/'){
										$p2=0;
									}
									$bandera++;
								}

								if($columna=='E'){
									$p3=trim($celda->getValue());
									if($p3=='/'){
										$p3=0;
									}
									$bandera++;
								}


								if($columna=='F'){
									$promedio_modular=$celda->getCalculatedValue();
									if($promedio_modular=='/'){
										$promedio_modular=0;
									}
									$bandera++;
								}

								if($columna=='G'){
									$examen_final=$celda->getCalculatedValue();
									if($examen_final=='/'){
										$examen_final=0;
									}
									$bandera++;
								}

								if($columna=='H'){
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

									$datos_calificacion_estudiante_update = array(
										'primer_parcial' => $p1,
										'segundo_parcial' => $p2,
										'tercer_parcial' => $p3,
										'examen_final' => $examen_final,
										'calificacion_final' => $cal_final
									);

									$parametros_estudiante_update_cal = array(
										'id_grupo' => strtoupper($id_grupo),
										'no_control' => strtoupper($no_control),
										'id_ciclo_escolar' =>$id_ciclo_escolar,
										'id_materia' => strtoupper($clave)
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
									else{
										$this->M_grupo_estudiante->actualizar_calificaciones_ciclos_anteriores((object)$parametros_estudiante_update_cal,$datos_calificacion_estudiante_update);
									}

									
									
								}
								

								}

								

								
								
							}
						}

						$datos_friae = array(
							'no_control' => $no_control,
							'id_grupo' => $id_grupo,
							'semestre' =>$modulo,
							'id_friae'=>$id_friae
							
						);


						if(count($this->M_friae->get_datos_friae_estudiante($id_grupo,$no_control))==0){
							$this->M_friae->agregar_estudiante_friae_ciclos_anteriores((object)$datos_friae);
						}
						
						


						
						
						
//Termina a leer hoja Friae y calificaciones_______________________________________________________________________

//Empiepza elaboración de Friae---------------------------------------------------------------------------


//Termina Elaboración de Friae----------------------------------------------------------------------------
					
//Empieza a leer pestaña FRER_______________________________________________________________________________________
					$indiceHoja = 0;
					$frer = $spreadsheet->getSheet($indiceHoja);
					//echo "<h3>Vamos en la hoja con índice $indiceHoja</h3>";

					foreach ($frer->getRowIterator(15) as $fila) {
						
						$clave_materia='';
						$calificacion_regularizacion=null;
						$fecha_regularizacion=null;
						$hora_regularizacion=null;
						$bandera=0;

						$anio_regu='';
						$mes_regu='';
						$dia_regu='';
						

						$fila=$fila->getCellIterator("B","M");

						foreach ($fila as $celda) {
							if(!is_null($celda->getValue())){

							$fila = $celda->getRow();
							# Columna, que es la A, B, C y así...
							$columna = $celda->getColumn();
							

							

							if($columna=='B' && $celda->getCalculatedValue()!=''){
								$clave_materia=trim($celda->getValue());
								$bandera++;
							}

							if($columna=='I' && $celda->getCalculatedValue()!=''){
								$calificacion_regularizacion=$celda->getValue();
								$bandera++;
							}

							if($columna=='J' && $celda->getCalculatedValue()!=''){
								$anio_regu=$celda->getValue();
								$bandera++;
							}

							if($columna=='K' && $celda->getCalculatedValue()!=''){
								$mes_regu=$celda->getValue();
								
								$bandera++;
							}

							if($columna=='L' && $celda->getCalculatedValue()!=''){
								$dia_regu=$celda->getValue();
								
								$bandera++;
							}

							if($columna=='M' && $celda->getCalculatedValue()!=''){
								$hora_regularizacion=str_pad($celda->getFormattedValue(),5,'0',STR_PAD_LEFT);
								
								$bandera++;
							}

							

							if($bandera==6){//Solo se insertaran aquellas calificaciones en donde todas las 9 columnas esten rellenados.
								$fecha_regularizacion=$anio_regu."-".$this->num_mes($mes_regu)."-".$dia_regu;
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

								//var_dump($datos_regularizacion_estudiante);

								$existe_regu=count($this->M_regularizacion->existe_regu_ciclo_anterior($plantel_cct,$clave_materia,$no_control,$fecha_regularizacion));
								if($existe_regu==0){
									$this->M_regularizacion->insertar_regularizacion_ciclos_anteriores($datos_regularizacion_estudiante);

									
								}
								else{
									$datos_update_regularizacion_estudiante = array(
										
										'calificacion' =>$calificacion_regularizacion,
										'estatus'=>0,
										'hora'=>$hora_regularizacion,
										'fecha'=>date('Y-m-d')
	
									);

									$parametros_estudiante = array(
										'id_materia' => strtoupper($clave_materia),
										'no_control' => $no_control,
										'plantel_cct' => $plantel_cct,
										'fecha_calificacion'=>$fecha_regularizacion
									);
	
									$this->M_regularizacion->update_regularizacion_ciclos_anteriores((object)$parametros_estudiante,$datos_update_regularizacion_estudiante);
								}

								
								

							}
							

							}

							

							
							
						}
					}

//TERmina lectura de pestaña FRER---------------------------------------------------------------------------------

$valores = explode('-',$ciclo_escolar->fecha_inicio);
$valores2 = explode('-',$ciclo_escolar->fecha_terminacion);
		
$anio_inicio=$valores[0];
$anio_terminacion=$valores2[0];

$parametros_friae= array(
	'anio_inicio' => $anio_inicio,
	'anio_termino' => $anio_terminacion,
	'fecha_termino'=>$ciclo_escolar->fecha_terminacion,
	'semestre' =>$modulo,
	'no_control'=>$no_control,
	'id_friae'=>$id_friae,
	'periodo'=>$periodo

	
);

$this->M_regularizacion->actualizar_friae_ciclos_anteriores((object)$parametros_friae);

$indiceHoja = 0;
					$frer = $spreadsheet->getSheet($indiceHoja);
					
					foreach ($frer->getRowIterator(15) as $fila) {
						$anio_regu='';
						$mes_regu='';
						$dia_regu='';
						$bandera=0;
						

						$fila=$fila->getCellIterator("J","M");

						foreach ($fila as $celda) {
							if(!is_null($celda->getValue())){

							$fila = $celda->getRow();
							# Columna, que es la A, B, C y así...
							$columna = $celda->getColumn();
							


							if($columna=='J'){
								$anio_regu=$celda->getValue();
								$bandera++;
								
							}

							if($columna=='K'){
								$mes_regu=$celda->getValue();
								
								$bandera++;
							}

							if($columna=='L'){
								$dia_regu=$celda->getValue();
								
								$bandera++;
							}

							if($columna=='M'){
								$hora_regularizacion=str_pad($celda->getFormattedValue(),5,'0',STR_PAD_LEFT);
								
								$bandera++;
							}

							if($bandera==4){
								$fecha_regularizacion=$anio_regu."-".$this->num_mes($mes_regu)."-".$dia_regu;
							$parametros_frer= array(
								'semestre' =>$modulo,
								'no_control'=>$no_control,
								'mes_regu'=>$this->num_mes($mes_regu),
								'anio_regu'=>$anio_regu,
								'fecha_regularizacion'=>$fecha_regularizacion,
								'cct_plantel'=>$plantel_cct

							);
						
						$this->M_regularizacion->actualizar_frer_ciclos_ant((object)$parametros_frer);

							}
							

							
							

							}//Fin de celdas no vacias

							

							
							

							
							
						}//Fin de for columnas por fila

						
					}//Fin de ciclo de frer





//Empieza actualizacion de estado del estudiante-------------------------------------------------------------------

$num_adeudos=0;
//if(strlen(trim($fecha_baja))==0 || $tipo_operacion=='DESERTOR'){
	$num_adeudos=count($this->M_regularizacion->materias_debe_estudiante_actualmente($no_control));

	
//}
/*else{
	$num_adeudos=-1;
	
}*/

$this->M_regularizacion->actualizar_estatus_estudiante($no_control,$num_adeudos,$modulo,$plantel_cct,$matricula,$fecha_baja,$motivo_baja,$tipo_operacion,$grupo);


$this->session->set_flashdata('msg_exito', 'Los datos del alumno se han agregado al sistema correctamente, para corroborar verique en el reporte KARDEX.');

//TErmina actulizacion de estado del estudiante--------------------------------------------------------------------
			}
        break;//Termina default
}






			
			
			$data= array('title'=>'Importar archivo de Excel');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdacescolar");
            $this->load->view("spreadsheet/upload_excel");
            $this->load->view("footers/footer");
				
			





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
	
	
	
	public function checkValidateBaja($spreadsheet) {
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

					$matricula= trim($calificaciones_friae->getCell('B10')->getValue());

					

					$motivo_baja= trim($calificaciones_friae->getCell('F10')->getValue());

					$anio_baja= trim($calificaciones_friae->getCell('C10')->getValue());
					$mes_baja= trim($calificaciones_friae->getCell('D10')->getValue());
					$dia_baja= trim($calificaciones_friae->getCell('E10')->getValue());
					$tipo_operacion='';
					$tipo_operacion= trim($calificaciones_friae->getCell('B1')->getValue());

					$resultado_error='';

					

					if($matricula==''){
						$resultado_error.="<li>No ha ingresado la matricula.</li>";
					}
					else{
						if(strlen($matricula)!=7){
							$resultado_error.="<li>La matricula no cumple con los criterios establecidos por el Depto. de Control Escolar.</li>";
						}

					}

					

					if(trim($anio_baja)!='' && trim($mes_baja)!='' && trim($dia_baja)!=''){
						 if(!$this->validar_fecha($anio_baja,$mes_baja,$dia_baja)){
								$resultado_error.="<li>El formato de fecha de baja no es valida.</li>";
						 }

					}
					else{
						$resultado_error.="<li>El formato de fecha de baja no es valida o se encuentra vacia</li>";
					}

					if($motivo_baja==''){
						$resultado_error.="<li>No ha seleccionado un motivo de baja</li>";
					}

					$id_ciclo_escolar=""; //inicializamos variable
					$id_grupo=""; //inicializamos variable id_grupo
					$id_periodo="";//inicalizamos variable periodo
					$existe_grupo=0;//inicializamos varfiable existe grupo
					$num_materias=0; //inicalizamos variable numero de materias semestre
					
					$cont_materias_reprobadas=0;// Contador de materias reprobadas por cada alumno
					$cont_materias_estudiante=0;// cuenta el número de materias subidas por el estudiante.
					



					

					
					

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
					  $lista_materias =array();
					  foreach( $this->M_materia->get_materias_semestre($modulo) as $materia){
							$lista_materias[]=$materia->clave;
					  }
					  
					   $cont_materias_cal_alumno=0;
					  

					  $cont_materias_aprobadas=0;
					  
					  foreach ($calificaciones_friae->getRowIterator(15) as $fila) {

						        $clave='';
								$cal_final=null;
								
							$fila=$fila->getCellIterator("B","H");

							foreach ($fila as $celda) {
								$fila = $celda->getRow();
								$columna = $celda->getColumn();

								if($columna=='B' && $columna!='' && in_array($celda->getValue(), $lista_materias)){
									$clave=$celda->getValue();
									$cont_materias_cal_alumno++;
								}
								
								
								if($columna=='C' && trim($celda->getValue())!='' && in_array($celda->getValue(), $calificacion_valida)){
									$cont_materias_cal_alumno++;
									
								}

								if($columna=='D' && trim($celda->getValue())!='' && in_array($celda->getValue(), $calificacion_valida)){
									$cont_materias_cal_alumno++;
									
								}

								if($columna=='E' && trim($celda->getValue())!='' && in_array($celda->getValue(), $calificacion_valida)){
									$cont_materias_cal_alumno++;
									
								}

								if($columna=='F' && trim($celda->getCalculatedValue())!='' && trim($celda->getCalculatedValue())=='/'){
									$cont_materias_cal_alumno++;
									
								}


								if($columna=='G' && trim($celda->getCalculatedValue())!='' && trim($celda->getCalculatedValue())=='/'){
									$cont_materias_cal_alumno++;
									
								}

								if($columna=='H' && trim($celda->getCalculatedValue())!='' && trim($celda->getCalculatedValue())=='/'){
									$cont_materias_cal_alumno++;
									
									
									
									
								}

								
								

							}
						}//Fin ciclo
					  
						
						
					 
					  if($cont_materias_cal_alumno!=($num_materias*7)){
						$resultado_error.="<li>Verifique el concentrado de calificaciones si alguna de las celdas se encuentra vacia o no cumple con los criterios de evaluación de calificaciones parciales, modulares y finales de las materias pertenecientes al semestre.</li>";
					  }
					///////////////////////////////////////////////TERMINA VALIDACIÓN DE DATOS ////////////////////////////
					if($resultado_error!=""){
						$resultado_error="<span style='font-weight:bold'>ERRORES DE PLANTILLA BAJA</span><BR>".$resultado_error;
						$this->form_validation->set_message('checkValidateBaja',$resultado_error);
						return false;

					 }
					 else{
						return true;
					 }

	}


	public function checkValidateDesertor($spreadsheet) {
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

					$matricula= trim($calificaciones_friae->getCell('B10')->getValue());

					

					$motivo_baja= trim($calificaciones_friae->getCell('F10')->getValue());

					$anio_baja= trim($calificaciones_friae->getCell('C10')->getValue());
					$mes_baja= trim($calificaciones_friae->getCell('D10')->getValue());
					$dia_baja= trim($calificaciones_friae->getCell('E10')->getValue());
					$tipo_operacion='';
					$tipo_operacion= trim($calificaciones_friae->getCell('B1')->getValue());

					$resultado_error='';

					

					if($matricula==''){
						$resultado_error.="<li>No ha ingresado la matricula.</li>";
					}
					else{
						if(strlen($matricula)!=7){
							$resultado_error.="<li>La matricula no cumple con los criterios establecidos por el Depto. de Control Escolar.</li>";
						}

					}

					

					if(trim($anio_baja)!='' && trim($mes_baja)!='' && trim($dia_baja)!=''){
						 if(!$this->validar_fecha($anio_baja,$mes_baja,$dia_baja)){
								$resultado_error.="<li>El formato de fecha de deserción no es valida.</li>";
						 }

					}
					else{
						$resultado_error.="<li>El formato de fecha de deserción no es valida o se encuentra vacia</li>";
					}

					if($motivo_baja==''){
						$resultado_error.="<li>No ha seleccionado un motivo de baja</li>";
					}

					$id_ciclo_escolar=""; //inicializamos variable
					$id_grupo=""; //inicializamos variable id_grupo
					$id_periodo="";//inicalizamos variable periodo
					$existe_grupo=0;//inicializamos varfiable existe grupo
					$num_materias=0; //inicalizamos variable numero de materias semestre
					
					$cont_materias_reprobadas=0;// Contador de materias reprobadas por cada alumno
					$cont_materias_estudiante=0;// cuenta el número de materias subidas por el estudiante.
					



					

					
					

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
					///////////////////////////////////////////////TERMINA VALIDACIÓN DE DATOS ////////////////////////////
					if($resultado_error!=""){
						$resultado_error="<span style='font-weight:bold'>ERRORES DE PLANTILLA DESERTOR</span><BR>".$resultado_error;
						$this->form_validation->set_message('checkValidateDesertor',$resultado_error);
						return false;

					 }
					 else{
						return true;
					 }

	}
	
	public function checkValidateTraslado($spreadsheet) {
		$indiceHoja = 0;
                    $plantilla_traslado = $this->get_archivo()->getSheet($indiceHoja);
                   // echo "<h3>Vamos en la hoja con índice $indiceHoja</h3>";
                    
                    # Lo que hay en B2
                    $celda = $plantilla_traslado->getCell('B2');
                    # El valor, así como está en el documento
                    $plantel_cct_origen = trim($celda->getValue());
					$nombre_ciclo_escolar= trim($plantilla_traslado->getCell('B3')->getValue());
					$periodo= trim($plantilla_traslado->getCell('B4')->getValue());
					$modulo= trim($plantilla_traslado->getCell('B5')->getValue());
					$plantel_cct_destino = trim($plantilla_traslado->getCell('B7')->getValue());
					$grupo_anterior_acreditado = trim($plantilla_traslado->getCell('B6')->getValue());
					$no_control= trim($plantilla_traslado->getCell('A11')->getValue());
					$matricula= trim($plantilla_traslado->getCell('B11')->getValue());
					$motivo_traslado= trim($plantilla_traslado->getCell('F11')->getValue());
					
					$anio_traslado= trim($plantilla_traslado->getCell('C11')->getValue());
					$mes_traslado= trim($plantilla_traslado->getCell('D11')->getValue());
					$dia_traslado= trim($plantilla_traslado->getCell('E11')->getValue());
					$resultado_error='';
					$id_periodo="";
					$datos_semestre_actual=0;

					if(trim($periodo) == "AGOSTO-ENERO"){
						$id_periodo="B";
					  }else{
						$id_periodo="A";
					  }


					if($grupo_anterior_acreditado==''){
						$resultado_error.="<li>No ha seleccionado el grupo al que perteneció el alumno en el último semestre acreditado.</li>";
					}
					if($matricula==''){
						$resultado_error.="<li>No ha ingresado la matricula.</li>";
					}
					else{
						if(strlen($matricula)!=7){
							$resultado_error.="<li>La matricula no cumple con los criterios establecidos por el Depto. de Control Escolar.</li>";
						}
					}
						
						if(trim($anio_traslado)!='' && trim($mes_traslado)!='' && trim($dia_traslado)!=''){
						 if(!$this->validar_fecha($anio_traslado,$mes_traslado,$dia_traslado)){
								$resultado_error.="<li>El formato de fecha de traslado no es valida.</li>";
						 }

					}
					else{
						$resultado_error.="<li>El formato de fecha de traslado no es valida o se encuentra vacia</li>";
					}
					
					
					if($motivo_traslado==''){
						$resultado_error.="<li>No ha seleccionado un motivo de traslado</li>";
					}
					
					if($plantel_cct_origen==""){
							$resultado_error.="<li>No ha seleccionado CCT de Plantel de origen.</li>";  
					  }

					  else{
						  if(empty($this->M_plantel->get_plantel($plantel_cct_origen))){
							$resultado_error.="<li>CCT de Plantel de origen incorrecto, vuelva a seleccionar.</li>";
						  }
					  }
					  
					 if($plantel_cct_destino==""){
							$resultado_error.="<li>No ha seleccionado CCT de Plantel de destino.</li>";  
					  }

					  else{
						  if(empty($this->M_plantel->get_plantel($plantel_cct_destino))){
							$resultado_error.="<li>CCT de Plantel de destino incorrecto, vuelva a seleccionar.</li>";
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
							else{
								$id_ciclo_escolar=$this->M_ciclo_escolar->get_id_ciclo_escolar_x_periodo_x_nombre($periodo,$nombre_ciclo_escolar)->id_ciclo_escolar;

								$datos_semestre_actual=$this->M_grupo_estudiante->grupo_semestre_estudiante_x_ciclo_escolar($no_control,$id_ciclo_escolar,$modulo);

								if(count($datos_semestre_actual)==0){
									$resultado_error.="<li>No se pueden cargar los datos de TRASLADO, porque aun no se han cargado los datos de calificaciones del módulo ".$modulo."</li>";

								}
								


							}
					  }

					  
					///////////////////////////////////////////////TERMINA VALIDACIÓN DE DATOS ////////////////////////////
					if($resultado_error!=""){
						$resultado_error="<span style='font-weight:bold'>ERRORES DE PLANTILLA TRASLADO</span><BR>".$resultado_error;
						$this->form_validation->set_message('checkValidateTraslado',$resultado_error);
						return false;

					 }
					 else{
						return true;
					 }

	}
	

	public function checkCamposPermitidos($spreadsheet) {


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

					$matricula= trim($calificaciones_friae->getCell('B10')->getValue());
					
					$tiene_matricula= trim($calificaciones_friae->getCell('C10')->getValue());

					

					$motivo_baja= trim($calificaciones_friae->getCell('F10')->getValue());

					$anio_baja= trim($calificaciones_friae->getCell('C10')->getValue());
					$mes_baja= trim($calificaciones_friae->getCell('D10')->getValue());
					$dia_baja= trim($calificaciones_friae->getCell('E10')->getValue());
					$tipo_operacion='';
					$tipo_operacion= trim($calificaciones_friae->getCell('B1')->getValue());

					$resultado_error='';
                      if($tiene_matricula!='' && $tiene_matricula=='SI'){
					  
					if($matricula==''){
						$resultado_error.="<li>No ha ingresado la matricula.</li>";
					}
					else{
						if(strlen($matricula)!=7){
							$resultado_error.="<li>La matricula no cumple con los criterios establecidos por el Depto. de Control Escolar.</li>";
						}

					}
					}

					$bandera_error=0;
					
					if($modulo>1){

					if(trim($anio_baja)!='' || trim($mes_baja)!='' || trim($dia_baja)!=''){
						 if(!$this->validar_fecha($anio_baja,$mes_baja,$dia_baja)){
							if($tipo_operacion=='DESERTOR'){
								$bandera_error=1;
								$resultado_error.="<li>El formato de fecha de deserción no es valida.</li>";
							}
							else{
								$bandera_error=1;
								$resultado_error.="<li>El formato de fecha de baja no es valida.</li>";
							}
							

						 }

						 if(trim($motivo_baja)==''){
							if($tipo_operacion=='DESERTOR'){
							$resultado_error.="<li>El motivo de deserción en la celda <span style='font-weight:bold'>F10</span> esta vacia seleccione el motivo.</li>";
							}
							else{
								$resultado_error.="<li>El motivo de baja en la celda <span style='font-weight:bold'>F10</span> esta vacia seleccione el motivo.</li>";
							}
							
						}
						

					}

					}
					if($motivo_baja!='' && $modulo!=1){
						
						if(!$this->validar_fecha($anio_baja,$mes_baja,$dia_baja) && $bandera_error==0){
							if($tipo_operacion=='DESERTOR'){
								$resultado_error.="<li>El formato de fecha de deserción no es valida.</li>";
							}
							else{
								$resultado_error.="<li>El formato de fecha de baja no es valida.</li>";
							}

						}
					}


					
					$id_ciclo_escolar=""; //inicializamos variable
					$id_grupo=""; //inicializamos variable id_grupo
					$id_periodo="";//inicalizamos variable periodo
					$existe_grupo=0;//inicializamos varfiable existe grupo
					$num_materias=0; //inicalizamos variable numero de materias semestre
					
					$cont_materias_reprobadas=0;// Contador de materias reprobadas por cada alumno
					$cont_materias_estudiante=0;// cuenta el número de materias subidas por el estudiante.
					



					

					
					

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
					  $lista_materias =array();
					  foreach( $this->M_materia->get_materias_semestre($modulo) as $materia){
							$lista_materias[]=$materia->clave;
					  }

					  
					  $cont_materias_cal_alumno=0;
					  

					  $cont_materias_aprobadas=0;
					  
					  foreach ($calificaciones_friae->getRowIterator(15) as $fila) {

						        $clave='';
								$cal_final=null;
								
							$fila=$fila->getCellIterator("B","H");

							foreach ($fila as $celda) {
								$fila = $celda->getRow();
								$columna = $celda->getColumn();

								if($columna=='B' && $columna!='' && in_array($celda->getValue(), $lista_materias)){
									$clave=$celda->getValue();
									$cont_materias_cal_alumno++;
								}
								
								
								if($columna=='C' && trim($celda->getValue())!='' && in_array($celda->getValue(), $calificacion_valida)){
									$cont_materias_cal_alumno++;
									
								}

								if($columna=='D' && trim($celda->getValue())!='' && in_array($celda->getValue(), $calificacion_valida)){
									$cont_materias_cal_alumno++;
									
								}

								if($columna=='E' && trim($celda->getValue())!='' && in_array($celda->getValue(), $calificacion_valida)){
									$cont_materias_cal_alumno++;
									
								}

								if($columna=='F' && trim($celda->getCalculatedValue())!='' && in_array($celda->getCalculatedValue(), $calificacion_valida)){
									$cont_materias_cal_alumno++;
									
								}


								if($columna=='G' && trim($celda->getCalculatedValue())!='' && in_array($celda->getCalculatedValue(), $calificacion_valida)){
									$cont_materias_cal_alumno++;
									
								}

								if($columna=='H' && trim($celda->getCalculatedValue())!='' && in_array($celda->getCalculatedValue(), $calificacion_valida)){
									$cont_materias_cal_alumno++;
									if($celda->getCalculatedValue()=='/')
									{
										$cal_final=0;
									}
									else{
										$cal_final=$celda->getCalculatedValue();
									}
									
									if($cal_final>=6){ //Contador de materias aprobadas en el semestre
										$cont_materias_aprobadas++;
										}
									
								}

								
								

							}
						}
					  
						
						
					 
					  if($cont_materias_cal_alumno!=($num_materias*7)){
						$resultado_error.="<li>Verifique el concentrado de calificaciones si alguna de las celdas se encuentra vacia o no cumple con los criterios de evaluación de calificaciones parciales, modulares y finales de las materias pertenecientes al semestre.</li>";
					  }

					  else{

					  }
					  


					$indiceHoja = 0;
					$cont_cal_frer=0;
					$calificaciones_frer = $this->get_archivo()->getSheet($indiceHoja);
					
		
							foreach ($calificaciones_frer->getRowIterator(15) as $fila) {
		
								$fila=$fila->getCellIterator("B","M");

								$clave_materia='';
								$calificacion_regularizacion=0;
								$anio_regu='';
								$mes_regu='';
								$dia_regu='';
								$cont_columnas_regu=0;
		
								foreach ($fila as $celda) {
									$fila = $celda->getRow();
									$columna = $celda->getColumn();

									if(!is_null($celda->getValue())){

										if($columna=='B'){
											$clave_materia=$celda->getValue();
											
										}

										if($columna=='I'){
											if(!in_array($celda->getCalculatedValue(), $calificacion_valida)){
												$resultado_error.="<li>La calificación de regularización en la celda <span style='font-weight:bold'>".$columna.$fila."</span> no es valida.</li>";

											}
											else{
												$cont_columnas_regu++;
												if($celda->getCalculatedValue()=='/'){
													$calificacion_regularizacion=0;
												}
												else{
													$calificacion_regularizacion=$celda->getCalculatedValue();
												}
												if($calificacion_regularizacion>=6){
													$cont_cal_frer++;
													
												}

											}
											
											
										}


										
										if($columna=='J'){
											$cont_columnas_regu++;
											$anio_regu=$celda->getValue();
											
										}

										if($columna=='K'){
											$cont_columnas_regu++;
											$mes_regu=$celda->getValue();
											
											
										}

										if($columna=='L'){
											$cont_columnas_regu++;
											$dia_regu=$celda->getValue();
											
										}


										
										
										

										if($columna=='M'){
											if(!$this->validar_formato_hora($celda->getFormattedValue())){
												$resultado_error.="<li>El formato de hora de regularización en la celda <span style='font-weight:bold'>".$columna.$fila."</span> no es valida.</li>";

											}

											else{
												$cont_columnas_regu++;
											}

											
											
										}

									}

									

								}

								

								if($cont_columnas_regu>0 && $cont_columnas_regu<5){
									$resultado_error.="<li>Existen algunos campos vacios, verifique en las columnas pertenecientes a Calificación de regularizacion, fecha y hora de aplicación de la fila <span style='font-weight:bold'>".$fila."</span>.</li>";
								}
								

								if(trim($anio_regu)!='' || trim($mes_regu)!='' || trim($dia_regu)!=''){
									if(!$this->validar_fecha($anio_regu,$mes_regu,$dia_regu)){
									   $resultado_error.="<li>El formato de fecha de regularización en la fila <span style='font-weight:bold'>".$fila."</span> no es valida.</li>";
		   
									}
								
								}

								
							
						} 
					  
					  
					  


					 if(intval($modulo)==1){
						$total_materias_aprobadas=$cont_materias_aprobadas+$cont_cal_frer;
						$num_adeudos_alumno_validacion=$num_materias-$total_materias_aprobadas;
						
						if($num_adeudos_alumno_validacion>3 && $num_adeudos_alumno_validacion<=5){
						   $resultado_error.="<li>El alumno que intenta ingresar al sistema es un alumno <span style='font-weight:bold'>SIN DERECHO</span>.</li>";
   
						}
   
						if($num_adeudos_alumno_validacion>5){
						   $resultado_error.="<li>El alumno que intenta ingresar al sistema es un alumno <span style='font-weight:bold'>REPROBADO</span>.</li>";
   
						}

					 }
					 

					 
					  
					  
					  ///////////////////////////////////////////////TERMINA VALIDACIÓN DE DATOS ////////////////////////////
					 if($resultado_error!=""){
						$this->form_validation->set_message('checkCamposPermitidos',$resultado_error);
						return false;

					 }
					 else{
						return true;
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

					

					$bandera_error=0;

					if(trim($anio_baja)!='' || trim($mes_baja)!='' || trim($dia_baja)!=''){
						 if(!$this->validar_fecha($anio_baja,$mes_baja,$dia_baja)){
							if($tipo_operacion=='DESERTOR'){
								$bandera_error=1;
								$resultado_error.="<li>El formato de fecha de deserción no es valida.</li>";
							}
							else{
								$bandera_error=1;
								$resultado_error.="<li>El formato de fecha de baja no es valida.</li>";
							}
							

						 }

						 if(trim($motivo_baja)==''){
							if($tipo_operacion=='DESERTOR'){
							$resultado_error.="<li>El motivo de deserción en la celda <span style='font-weight:bold'>F10</span> esta vacia seleccione el motivo.</li>";
							}
							else{
								$resultado_error.="<li>El motivo de baja en la celda <span style='font-weight:bold'>F10</span> esta vacia seleccione el motivo.</li>";
							}
							
						}
						

					}

					if($motivo_baja!=''){
						if(!$this->validar_fecha($anio_baja,$mes_baja,$dia_baja) && $bandera_error==0){
							if($tipo_operacion=='DESERTOR'){
								$resultado_error.="<li>El formato de fecha de deserción no es valida.</li>";
							}
							else{
								$resultado_error.="<li>El formato de fecha de baja no es valida.</li>";
							}

						}
					}


					
					$id_ciclo_escolar=""; //inicializamos variable
					$id_grupo=""; //inicializamos variable id_grupo
					$id_periodo="";//inicalizamos variable periodo
					$existe_grupo=0;//inicializamos varfiable existe grupo
					$num_materias=0; //inicalizamos variable numero de materias semestre
					
					$cont_materias_reprobadas=0;// Contador de materias reprobadas por cada alumno
					$cont_materias_estudiante=0;// cuenta el número de materias subidas por el estudiante.
					



					

					
					

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
					  $lista_materias =array();
					  foreach( $this->M_materia->get_materias_semestre($modulo) as $materia){
							$lista_materias[]=$materia->clave;
					  }

					  
					  $cont_materias_cal_alumno=0;
					  

					  $cont_materias_aprobadas=0;
					  
					  foreach ($calificaciones_friae->getRowIterator(15) as $fila) {

						        $clave='';
								$cal_final=null;
								
							$fila=$fila->getCellIterator("B","H");

							foreach ($fila as $celda) {
								$fila = $celda->getRow();
								$columna = $celda->getColumn();

								if($columna=='B' && $columna!='' && in_array($celda->getValue(), $lista_materias)){
									$clave=$celda->getValue();
									$cont_materias_cal_alumno++;
								}
								
								
								if($columna=='C' && trim($celda->getValue())!='' && in_array($celda->getValue(), $calificacion_valida)){
									$cont_materias_cal_alumno++;
									
								}

								if($columna=='D' && trim($celda->getValue())!='' && in_array($celda->getValue(), $calificacion_valida)){
									$cont_materias_cal_alumno++;
									
								}

								if($columna=='E' && trim($celda->getValue())!='' && in_array($celda->getValue(), $calificacion_valida)){
									$cont_materias_cal_alumno++;
									
								}

								if($columna=='F' && trim($celda->getCalculatedValue())!='' && in_array($celda->getCalculatedValue(), $calificacion_valida)){
									$cont_materias_cal_alumno++;
									
								}


								if($columna=='G' && trim($celda->getCalculatedValue())!='' && in_array($celda->getCalculatedValue(), $calificacion_valida)){
									$cont_materias_cal_alumno++;
									
								}

								if($columna=='H' && trim($celda->getCalculatedValue())!='' && in_array($celda->getCalculatedValue(), $calificacion_valida)){
									$cont_materias_cal_alumno++;
									if($celda->getCalculatedValue()=='/')
									{
										$cal_final=0;
									}
									else{
										$cal_final=$celda->getCalculatedValue();
									}
									
									if($cal_final>=6){ //Contador de materias aprobadas en el semestre
										$cont_materias_aprobadas++;
										}
									
								}

								
								

							}
						}
					  
						
						
					 
					  if($cont_materias_cal_alumno!=($num_materias*7)){
						$resultado_error.="<li>Verifique el concentrado de calificaciones si alguna de las celdas se encuentra vacia o no cumple con los criterios de evaluación de calificaciones parciales, modulares y finales de las materias pertenecientes al semestre.</li>";
					  }


					  



					

					 
					  
					  
					  ///////////////////////////////////////////////TERMINA VALIDACIÓN DE DATOS ////////////////////////////
					 if($resultado_error!=""){
						$this->form_validation->set_message('checkValidateSinMatricula',$resultado_error);
						return false;

					 }
					 else{
						return true;
					 }
					  
		
	  }

}
//Hola mundo