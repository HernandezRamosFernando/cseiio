<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_frer extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("M_frer");
    }


    function generar_frer_plantel_periodo(){
        $this->load->library('pdf');
        $plantel = $this->input->get('plantel');
        $periodo = $this->input->get('periodo');
        $this->load->view('reportes/frer');
    }

    
}