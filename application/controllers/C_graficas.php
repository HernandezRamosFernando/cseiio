<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_graficas extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("M_graficas");
    }

    function count_estudiantes_hombres(){
        echo json_encode($this->M_graficas->count_estudiantes_hombres());

    }
    function count_estudiantes_mujeres(){
        echo json_encode($this->M_graficas->count_estudiantes_mujeres());
    }



    


}
