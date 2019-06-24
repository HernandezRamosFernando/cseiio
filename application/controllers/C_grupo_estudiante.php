<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_grupo_estudiante extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("M_grupo_estudiante");
        $this->load->model("M_plantel");
    }


    public function agregar_calificaciones_materia_grupo(){
        $datos = json_decode($this->input->raw_input_stream);
        echo $this->M_grupo_estudiante->agregar_calificaciones_materia_grupo($datos);
    }


    public function calificaciones_grupo_materia(){
        
    }

    //------------------------------------
    public function generar_lista_asistencia(){
    $id_materia = $this->input->post('materias');
    $id_grupo = $this->input->post('grupos');
    $mes = $this->input->post('mes');
    $cct_plantel = $this->input->post('plantel');
    $nombre_plantel=$this->M_plantel->get_plantel($cct_plantel)[0]->nombre_plantel;
    $semestre_grupo = $this->input->post('semestre_grupo');
    $datos_grupo=$this->M_grupo_estudiante->get_datos_grupo_estudiante_asesor($id_grupo,$id_materia);

    $anio=date("Y");

    //$nombre_grupo=$this->input->post('');

     $datos['lista_alumnos']=$this->M_grupo_estudiante->nombres_estudiantes_grupo_materia($id_grupo,$id_materia);
     $datos['datos_grupo']=$datos_grupo;
     $datos['mes']=$mes;
     $datos['anio']=$anio;
     $datos['cct_plantel']=$cct_plantel;
     $datos['nombre_plantel']=$nombre_plantel;
     $datos['semestre']=$semestre_grupo;

    $this->load->library('pdf');
    $this->load->view('reportes/formato_asistencia',$datos);
    }
}