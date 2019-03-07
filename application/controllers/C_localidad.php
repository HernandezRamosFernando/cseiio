<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_localidad extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_localidad');
    }

    public function get_localidades_municipio(){
        $id_municipio = $this->input->get('id_municipio');
        echo json_encode($this->M_localidad->get_localidades_municipio($id_municipio));
     }
}