<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_acta_regularizacion extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }


    function generar_acta(){
        $this->load->library('pdf');
        $this->load->view('reportes/acta_regularizacion');
    }
}