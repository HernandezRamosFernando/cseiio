<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_ciclo_escolar extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("M_ciclo_escolar");
    }

    public function get_ciclo_escolar_en_curso(){
        echo json_encode($this->M_ciclo_escolar->get_ciclo_escolar());
    }


    public function get_datos_siguiente_ciclo(){
        echo json_encode($this->M_ciclo_escolar->get_datos_siguiente_ciclo());
    }

    public function agregar_ciclo_escolar(){
        $datos = json_decode($this->input->raw_input_stream);
        echo $this->M_ciclo_escolar->agregar_ciclo_escolar($datos);
    }

    
}