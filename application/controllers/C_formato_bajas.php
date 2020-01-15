<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_formato_bajas extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_baja');
        $this->load->model('M_plantel');
        $this->load->model('M_ciclo_escolar');
        $this->load->model('M_friae');
        $this->load->model('M_configuracion');
        $this->load->model('M_ciclo_escolar');
    }



    function generar_formato(){
        $plantel = $this->input->post('plantel');
        $ciclo_escolar = $this->input->post('ciclo_escolar');
        $datos['ciclo_escolar']=$this->M_ciclo_escolar->obtener_nombre_ciclo_escolar($ciclo_escolar);
        $datos['plantel']=$this->M_plantel->get_plantel($plantel);
       $datos['lista_baja']=$this->M_baja->lista_baja_estudiante_x_plantel_ciclo($plantel,$ciclo_escolar);
       $datos['revisor']=$this->M_friae->get_revisor($datos['plantel'][0]->cct_plantel);
       $datos['jefe_escolar']=$this->M_configuracion->get_jefe_escolar();
       $datos['fecha_fin'] = $this->M_ciclo_escolar->fecha_fin_ciclo();

       

       
        
        $this->load->library('pdf');
        $this->load->view('reportes/bajas',$datos);
    }


}