<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_portabilidad extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model("M_portabilidad");
    }



    function estudiantes_de_portabilidad(){
        $plantel = $this->input->get("plantel");
        $curp = $this->input->get("curp");

        echo json_encode($this->M_portabilidad->estudiantes_de_portabilidad($curp,$plantel));
    }
}