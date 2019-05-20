<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_regularizacion extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("M_regularizacion");
    }

    public function materias_con_reprobados_html(){
        $respuesta = "";
        $plantel = $this->input->get("plantel");
        $materias = $this->M_regularizacion->materias_con_reprobados_html($plantel);
        if(sizeof($materias) == 0){
            $respuesta ="";
        }else{
            $respuesta.='<option value =""> Seleccione una materia </option>';
            foreach($materias as $materia){
                $respuesta.='<option value="'.$materia->id_materia.'">'.$materia->unidad_contenido.'</option>';
            }
        }

        echo $respuesta;

       
    }
}