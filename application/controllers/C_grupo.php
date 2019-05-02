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

    public function delete_estudiantes_grupo(){
        $datos = json_decode($this->input->raw_input_stream);
        echo $this->M_grupo->delete_estudiantes_grupo($datos);
    }

    public function delete_grupo(){
        $grupo = json_decode($this->input->raw_input_stream);
        echo $this->M_grupo->delete_grupo($grupo->id_grupo);
    }

    public function get_materias_grupo(){
        $id_grupo = $this->input->get("grupo");
        echo json_encode($this->M_grupo->get_materias_grupo($id_grupo));
    }

    public function agregar_asesor_materias(){
        $datos = json_decode($this->input->raw_input_stream);
        echo $this->M_grupo->agregar_asesor_materias($datos);
    }
}



