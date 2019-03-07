<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_municipio extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_municipio');
    }


    public function get_municipios_estado(){
       $id_estado = $this->input->get('id_estado');
       echo json_encode($this->M_municipio->get_municipios_estado($id_estado));
    }
}