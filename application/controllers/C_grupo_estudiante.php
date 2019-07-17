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

    $tipo_formato = $this->input->post('tipo_formato');

    $anio=date("Y");

    //$nombre_grupo=$this->input->post('');

     $datos['lista_alumnos']=$this->M_grupo_estudiante->lista_asistencia_x_grupo($id_grupo,$id_materia);
     $datos['datos_grupo']=$datos_grupo;
     $datos['mes']=$mes;
     $datos['anio']=$anio;
     $datos['cct_plantel']=$cct_plantel;
     $datos['nombre_plantel']=$nombre_plantel;
     $datos['semestre']=$semestre_grupo;
     

    $this->load->library('pdf');
    if($tipo_formato=='CARTA'){
        $this->load->view('reportes/formato_asistencia',$datos);
    }

    if($tipo_formato=='OFICIO'){
        $this->load->view('reportes/formato_asistencia_oficio',$datos);
    }
    
    }


    public function existe_grupo_ciclo_escolar_estudiante(){
        $id_ciclo = $this->input->get('id_ciclo_escolar');
        $no_control = $this->input->get('no_control');
        $semestre = $this->input->get('semestre_nulidad');
        echo json_encode( $this->M_grupo_estudiante->existe_grupo_ciclo_escolar_estudiante($no_control,$id_ciclo,$semestre));
    }
}