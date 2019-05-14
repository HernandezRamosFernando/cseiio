<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_reinscripcion extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("M_reinscripcion");
    }



    function estudiantes_en_grupos_activos(){
        echo json_encode($this->M_reinscripcion->estudiantes_en_grupos_activos());
    }

    function reinscribir(){
        echo $this->M_reinscripcion->reinscribir();
    }


    function materias_cursando_estudiante(){ 
        $no_control = $this->input->get("no_control");
        echo json_encode($this->M_reinscripcion->materias_cursando_estudiante($no_control));
    }
}