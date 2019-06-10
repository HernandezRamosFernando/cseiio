<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_nulidad_semestre extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("M_nulidad_semestre");
    }


    function nulidad_semestre_estudiante(){
        $no_control = $this->input->get("no_control");
        $semestre = $this->input->get("semestre");
        echo $this->M_nulidad_semestre->nulidad_semestre_estudiante($no_control,$semestre);
    }
}