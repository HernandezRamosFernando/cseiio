<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_ciclo_escolar extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("M_ciclo_escolar");
    }


    public function get_datos_siguiente_ciclo(){
        echo json_encode($this->M_ciclo_escolar->get_datos_siguiente_ciclo());
    }
}