<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_permiso_regularizacion extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("M_permiso_regularizacion");
    }


    public function obtener_permiso_plantel_materia(){
        $plantel = $this->input->get("plantel");
        $materia = $this->input->get("materia");

        echo json_encode($this->M_permiso_regularizacion->obtener_permiso_plantel_materia($plantel,$materia));
    }
}