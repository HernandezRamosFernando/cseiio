<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_bajas extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("M_baja");
    }

    public function busqueda_alumnos_grupo(){
        $curp = $this->input->get('curp');
        $cct_plantel = $this->input->get('cct_plantel');
        echo json_encode($this->M_baja->busqueda_alumnos_grupo($curp,$cct_plantel));
    }

    public function agregar_permiso(){
        $no_control = $this->input->post('no_control');
        $id_grupo = $this->input->post('id_grupo');
        $id_plantel = $this->input->post('id_plantel');
        
        $fecha_inicio = $this->input->post('fecha_inicio');
        $fecha_fin = $this->input->post('fecha_fin');
        $examen = $this->input->post('examen');
        echo $this->M_baja->agregar_permiso($examen,$no_control,$id_grupo,$fecha_inicio,$fecha_fin,$id_plantel);

    }

    public function get_materias_por_calificar(){
        $grupo = $this->input->get("grupo");
        echo json_encode($this->M_baja->get_materias_por_calificar($grupo));
    }

    public function get_estudiantes_por_calificar(){
        $grupo = $this->input->get("grupo");
        $materias = $this->input->get("materia");
        echo json_encode($this->M_baja->get_estudiantes_por_calificar($grupo,$materias));
    }


    public function actualizar_calificaciones_materia_grupo(){
        $datos = json_decode($this->input->raw_input_stream);
        echo $this->M_baja->actualizar_calificaciones_materia_grupo($datos);
    }

}