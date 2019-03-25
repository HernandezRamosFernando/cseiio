<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_acreditacion extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('M_plantel');
        $this->load->model('M_ciclo_escolar');
        $this->load->model('M_especialidad');
    }

public function acreditacion(){
    $this->load->view("admin/acreditacion", );
}

public function crear_grupo(){
    $datos['planteles'] = $this->M_plantel->get_planteles();
    $datos['ciclo_escolar'] = $this->M_ciclo_escolar->get_ciclo_escolar();
    $this->load->view("admin/creargrupo", $datos);
}

}


?>

