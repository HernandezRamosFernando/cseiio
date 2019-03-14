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
        
    }
}