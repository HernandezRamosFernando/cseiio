<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_localidad extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_localidad');
    }


    public function get_localidades_municipio_html(){
        $id_municipio = $this->input->get('id_municipio');
        $respuesta = "";
        foreach($this->M_localidad->get_localidades_municipio($id_municipio) as $localidad){
            $respuesta.='<option value="'.$localidad->id_localidad.'">'.mb_strtoupper($localidad->nombre_localidad).'</option>';
        }

        echo $respuesta;
    }
}