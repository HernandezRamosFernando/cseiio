

<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_estudiante extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_estudiante');
    }

    public function generar_matricula(){
       // $no_control = "";
        $numero = $this->M_estudiante->asignar_matricula();
        //$no_control = 'CSEIIO'.date('y').str_pad($numero,4,'0',STR_PAD_LEFT);
        //$matricula = date('y').$num;
        return $numero;

    }

 


    public function insertar_estudiante(){
        $no_control = $this->input->get('no_control');
        $matricula = $this->generar_matricula();
        $datos = array(
            'Aspirante_no_control' => $no_control,
            'matricula' => $matricula
        );
        echo $this->M_estudiante->insertar_estudiante($datos);
    }


    public function estudiantes_sin_matricula(){
       $cct = $this->input->get('cct');
       echo json_encode($this->M_estudiante->estudiantes_sin_matricula($cct));
    }
}







  