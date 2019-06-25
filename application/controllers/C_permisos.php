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

    public function permisos_calificaciones_activos(){
        echo json_encode($this->M_permisos->permisos_calificaciones_activos());
    }

    public function permisos_regularizaciones_activos(){
        echo json_encode($this->M_permisos->permisos_regularizaciones_activos());
    }

    public function permisos_regularizacion_plantel(){
        $plantel = $this->input->get("plantel");
        echo json_encode($this->M_permisos->permisos_regularizacion_plantel($plantel));
    }

    //select fecha_fin from Permiso_regularizacion where Plantel_cct_plantel='20EBD0001C' and curdate() between fecha_inicio and fecha_fin limit 1;
}