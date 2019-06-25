<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_documentacion extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_documentacion');
        $this->load->model('M_estudiante');
        $this->load->model('M_ciclo_escolar');
    }


    public function get_estudiantes_falta_documentacion_base(){
        $curp = $this->input->get('curp');
        $cct_plantel = $this->input->get('cct_plantel');
        echo json_encode($this->M_documentacion->get_estudiantes_falta_documentacion_base($curp,$cct_plantel));
    }

    public function get_dias_ultima_carta_compromiso_estudiante(){
        $no_control = $this->input->get('no_control');
        echo json_encode($this->M_documentacion->get_dias_ultima_carta_compromiso_estudiante($no_control));
    }


    public function get_documentos_base_faltantes_estudiante(){
        $no_control = $this->input->get('no_control');
        echo json_encode($this->M_documentacion->get_documentos_base_faltantes_estudiante($no_control));
    }

    function add_observaciones_documentacion_faltante_estudiante(){

        $observaciones = json_decode($this->input->raw_input_stream);
       //print_r($observaciones);
        echo $this->M_documentacion->add_observaciones_documentacion_faltante_estudiante($observaciones);
    
    }

    function get_fecha_ultima_carta_compromiso_estudiante(){
        $no_control = $this->input->get('no_control');
        echo json_encode($this->m_documentacion->get_fecha_ultima_carta_compromiso_estudiante($no_control));
    }

    public function generar_carta_compromiso(){
        $this->load->library('pdf');
        $no_control = $this->input->get('no_control');
        $datos['documentos'] = $this->M_documentacion->get_documentos_base_faltantes_estudiante($no_control);
        $datos['estudiante_plantel'] = $this->M_estudiante->get_plantel_estudiante($no_control);
        $datos['fecha_carta'] = $this->M_documentacion->get_fecha_ultima_carta_compromiso_estudiante($no_control);
        $datos['nombre_tutor'] = $this->M_estudiante->obtener_nombre_tutor_estudiante($no_control);
        //print_r($datos['fecha_carta'][0]->fecha);
        $datos['ciclo_escolar'] = $this->M_ciclo_escolar->ciclo_escolar_fecha($datos['fecha_carta'][0]->fecha);
        //$datos['aspirante_plantel'] = $this->M_aspirante->get_aspirante($no_control);
        $this->load->view('reportes/carta_compromiso',$datos);


    }


    public function get_documentacion_base_faltante_estudiante(){
        $no_control = $this->input->get("no_control");
        //echo $no_control;
        echo json_encode($this->M_documentacion->documentos_base_faltantes_aspirante($no_control));
    }
}