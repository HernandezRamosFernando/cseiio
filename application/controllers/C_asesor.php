<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_asesor extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model("M_asesor");
        
    }


    public function get_asesores_plantel(){
        $id_plantel = $this->input->get("plantel");
        echo $this->M_asesor->get_asesores_plantel($id_plantel);
    }

    public function buscar_asesores_plantel(){
        $plantel = $this->input->get("cct_plantel");
        $curp = $this->input->get("curp");
        echo json_encode($this->M_asesor->buscar_asesores_plantel($curp,$plantel));
    }


}