<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_lista_calificaciones extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_localidad');
    }



    public function lista_calificaciones_grupo_materia(){
        $this->load->library('pdf');
        $this->load->view("reportes/lista_calificaciones");
    }
}