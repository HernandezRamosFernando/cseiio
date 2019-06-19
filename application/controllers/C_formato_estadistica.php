<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_formato_estadistica extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }



    public function generar_formato_estadistico(){
        $this->load->library('pdf');
        $this->load->view("reportes/formato_estadistica");
    }
}