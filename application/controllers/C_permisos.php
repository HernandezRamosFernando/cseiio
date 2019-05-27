<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_permisos extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("M_permisos");
    }


    public function agregar_permisos(){
        $datos = json_decode($this->input->raw_input_stream);
        //print_r($datos);
        echo $this->M_permisos->agregar_permisos($datos);
    }


    public function get_permiso_plantel(){
        $plantel = $this->input->get("plantel");
        echo json_encode($this->M_permisos->get_permiso_plantel($plantel));
    }

    public function get_permisos_plantel_grupo_materia(){
        $plantel = $this->input->get('plantel');
        $grupo = $this->input->get('grupo');
        $materia = $this->input->get('materia');

        echo json_encode($this->M_permisos->get_permisos_plantel_grupo_materia($plantel,$grupo,$materia));
    }
}