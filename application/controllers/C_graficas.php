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

   function total_estudiantes_por_plantel(){
       echo json_encode($this->M_graficas->total_estudiantes_por_plantel());
   }

   function estatus_estudiantes_por_plantel(){
       echo json_encode($this->M_graficas->estatus_estudiantes_por_plantel());
   }

   function estudiantes_por_distrito(){
       echo json_encode($this->M_graficas->estudiantes_por_distrito());
   }

   function estudiantes_lengua(){
       echo json_encode($this->M_graficas->estudiantes_lengua());
   }

   function materias_con_reprobados(){
       echo json_encode($this->M_graficas->materias_con_reprobados());
   }


   function estudiantes_tipo_ingreso(){
       echo json_encode($this->M_graficas->estudiantes_tipo_ingreso());
   }

}
