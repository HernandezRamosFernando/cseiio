<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_documentacion extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_documentacion');
    }


    function documentos_base_faltantes_aspirante(){
        $no_control = $this->input->get('no_control');
        echo json_encode($this->M_documentacion->documentos_base_faltantes_aspirante($no_control));
    }


    function lista_documentacion(){
        $tipoingreso = $this->input->get('tipoingreso');
         $datos['listadoc']=$this->M_documentacion->get_documentacion_x_tipoingreso($tipoingreso);
         echo json_encode($datos);
     }
}