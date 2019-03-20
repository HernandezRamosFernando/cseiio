

<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_estudiante extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_estudiante');
    }


    public function generar_matricula($no_control){
        $matricula='';
        
        $datos= $this->M_estudiante->obtener_fecha_inscripcion_semestre($no_control);
            $fecha_inscripcion=$datos->fecha_inscripcion;
            $semestre=$datos->semestre;
            $anio_ciclo=$this->M_estudiante->obtener_ciclo_escolar($fecha_inscripcion);
            if($anio_ciclo!=null){
                $numconsecutivo=$this->M_estudiante->numero_consecutivo_matricula($anio_ciclo);
                $matricula=$anio_ciclo.$semestre.str_pad($numconsecutivo,4,'0',STR_PAD_LEFT);
                
    
            }
            else{
                $matricula=null;
            }
    
            return $matricula;
       
    }
    
 


    public function insertar_estudiante(){


        $no_control = $this->input->get('no_control');
        //$matricula = $this->generar_matricula();
        $no_control = $this->input->get('no_control');
        $matricula=$this->generar_matricula($no_control);
       
        $datos = array(
            'Aspirante_no_control' => $no_control,
            'matricula' => $matricula
        );
        echo $this->M_estudiante->insertar_estudiante($datos);
    }


    public function estudiantes_sin_matricula(){
        $curp = $this->input->get('curp');
        $plantel = $this->input->get('plantel');
       echo json_encode($this->M_estudiante->estudiantes_sin_matricula( 
            $curp,
            $plantel
            ));
    }
}







  