<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_municipio extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_municipio');
    }


    public function get_municipios_estado_html(){
        $id_estado = $this->input->get('id_estado');
        $respuesta = "";
        $respuesta.='<option value="">Seleccione un municipio</option>';
        foreach($this->M_municipio->get_municipios_estado($id_estado) as $municipio){
            $respuesta .= '<option value="'.$municipio->id_municipio.'">'.mb_strtoupper($municipio->nombre_municipio).'</option>';
        }

        echo $respuesta;
    }
}