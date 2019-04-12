<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_estado extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_estado');
    }



    function get_estados(){
        echo json_encode($this->M_estado->get_estados());
    }

}