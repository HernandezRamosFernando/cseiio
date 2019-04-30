<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_componente extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model("M_componente");
    }

    public function get_id_componente(){
        $nombre_corto_componente = $this->input->get('nombre');
        echo json_encode($this->M_componente->get_id_componente($nombre_corto_componente));
    }
}