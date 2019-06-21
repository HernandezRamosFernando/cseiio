<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_grupo_estudiante extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("M_grupo_estudiante");
    }


    public function agregar_calificaciones_materia_grupo(){
        $datos = json_decode($this->input->raw_input_stream);
        echo $this->M_grupo_estudiante->agregar_calificaciones_materia_grupo($datos);
    }


    public function calificaciones_grupo_materia(){
        
    }
}