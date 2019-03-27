<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_secundaria extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_secundaria');
    }


    public function get_secundarias(){
        echo json_encode($this->M_secundaria->get_secundarias());
    }

    public function get_secundaria(){
        $cct_secundaria = $this->input->get('cct_secundaria');
        echo json_encode($this->M_secundaria->get_secundaria($cct_secundaria));
    }

    public function insert_secundaria(){
        $secundaria = json_decode($this->input->raw_input_stream);
        //print_r($secundaria);
        //echo $secundaria->cct_secundaria;
        $datos = array(
            'nombre_secundaria' => strtoupper($secundaria->nombre_secundaria),
            'tipo_subsistema' => strtoupper($secundaria->subsistema),
            'Localidad_id_localidad' => $secundaria->localidad,
            'cct_secundaria' => strtoupper($secundaria->cct_secundaria)
        );

       if($this->M_secundaria->insert_secundaria($datos)==1){
           echo "si";
       }

       else{
           echo "no";
       }
     
        
    }
}

       
    
