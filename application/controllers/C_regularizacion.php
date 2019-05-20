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


    public function estudiantes_materia(){
        $plantel = $this->input->get("plantel");
        $materia = $this->input->get("materia");

        echo json_encode($this->M_regularizacion->estudiantes_materia($plantel,$materia));        

    }

    public function agregar_regularizacion(){
        $datos = json_decode($this->input->raw_input_stream);
        //print_r($datos);
        echo $this->M_regularizacion->agregar_regularizacion($datos);
    }
}