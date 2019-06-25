<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_graficas extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("M_graficas");
    }

   function hombres_mujeres_total(){

    echo json_encode($this->M_graficas->hombres_mujeres_total());

   }


   function estudiantes_por_plantel(){
       echo json_encode($this->M_graficas->estudiantes_por_plantel());
   }


   function estudiantes_hablan_lengua(){
       echo json_encode($this->M_graficas->estudiantes_hablan_lengua());
   }



    


}
