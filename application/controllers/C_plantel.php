<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_plantel extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model("M_plantel");
    }


    public function get_plantel_especialidad(){
        $plantel = $this->input->get("plantel");
        echo json_encode($this->M_plantel->get_plantel_especialidad($plantel));
    }

    public function get_plantel_especialidad_html(){
        $plantel = $this->input->get("plantel");
        echo $this->M_plantel->get_plantel_especialidad_html($plantel);
        //print_r($this->M_plantel->get_plantel_especialidad($plantel));
    }
}