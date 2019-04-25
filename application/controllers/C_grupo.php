<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_grupo extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('M_grupo');
    }


    public function get_existe_grupo(){
        $id_grupo = $this->input->get("id_grupo");
    echo json_encode($this->M_grupo->get_existe_grupo($id_grupo));
    }

    public function get_estudiantes_grupo(){
        $id_grupo = $this->input->get("id_grupo");
        echo json_encode($this->M_grupo->get_estudiantes_grupo($id_grupo));
    }
}


