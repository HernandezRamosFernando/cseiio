<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_lista_calificaciones extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_localidad');
        $this->load->model('M_grupo_estudiante');
    }



    public function lista_calificaciones_grupo_materia(){
        
        $grupo = $this->input->get("grupo");
        $materia = $this->input->get("materia");

        $datos['estudiantes'] =$this->load->library('pdf'); $this->M_grupo_estudiante->nombres_estudiantes_grupo_materia($grupo,$materia);
        $datos['plantel'] = $this->M_grupo_estudiante->plantel_grupo($grupo);
        $datos['materia'] = $this->M_grupo_estudiante->datos_materia_grupo($materia,$grupo);
        $this->load->view("reportes/lista_calificaciones",$datos);
    }


    public function lista_calificaciones_grupo_materia_llena(){
        $this->load->library('pdf');
        $grupo = $this->input->get("grupo");
        $materia = $this->input->get("materia");

        $datos['estudiantes'] = $this->M_grupo_estudiante->datos_estudiantes_grupo_materia($grupo,$materia);
        $datos['plantel'] = $this->M_grupo_estudiante->plantel_grupo($grupo);
        $datos['materia'] = $this->M_grupo_estudiante->datos_materia_grupo($materia,$grupo);
        $this->load->view("reportes/lista_calificaciones_llena",$datos);
    }

   
}