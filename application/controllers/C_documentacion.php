<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_documentacion extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_documentacion');
    }


    public function get_estudiantes_falta_documentacion_base(){
        $curp = $this->input->get('curp');
        $cct_plantel = $this->input->get('cct_plantel');
        echo json_encode($this->M_documentacion->get_estudiantes_falta_documentacion_base($curp,$cct_plantel));
    }
}