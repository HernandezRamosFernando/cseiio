<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_graficas extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("M_graficas");
    }

   function numero_estudiantes_hombres_mujeres_por_plantel(){

    echo json_encode($this->M_graficas->numero_estudiantes_hombres_mujeres_por_plantel());

   }

}
