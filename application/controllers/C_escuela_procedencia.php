<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_escuela_procedencia extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_escuela_procedencia');
    }


    public function get_escuela(){
        $cct = $this->input->get('cct');
        echo json_encode($this->M_escuela_procedencia->get_escuela($cct));
    }


    public function insert_escuela(){
        $escuela = json_decode($this->input->raw_input_stream);
    
       if($this->M_escuela_procedencia->insert_escuela($escuela)==1){
           echo "si";
       }
    
       else{
           echo "no";
       }
     
        
    }


     public function get_escuela_procedencia_repetidor(){
        $no_control = $this->input->get('no_control');
        echo json_encode($this->M_escuela_procedencia->get_escuela_procedencia_repetidor($no_control));
    }


}