<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_formato_bajas extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }



    function generar_formato(){
        $this->load->library('pdf');
        $this->load->view('reportes/bajas');
    }
}