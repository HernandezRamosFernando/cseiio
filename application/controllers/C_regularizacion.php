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

    public function estudiantes_materia_registrada_activa(){
        $plantel = $this->input->get("plantel");
        $materia = $this->input->get("materia");
        echo json_encode($this->M_regularizacion->estudiantes_materia_registrada_activa($plantel,$materia)); 

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


    public function materias_debe_estudiante_actualmente(){
        $no_control = $this->input->get("estudiante");
        echo $this->M_regularizacion->materias_debe_estudiante_actualmente($no_control);
    }

    public function obtener_calificacion_regularizacion_estudiante_materia_reciente(){
        $no_control = $this->input->get("no_control");
        $materia = $this->input->get("materia");

        echo json_encode($this->M_regularizacion->obtener_calificacion_regularizacion_estudiante_materia_reciente($no_control,$materia));
    }



    function periodos_regularizacion_plantel(){
        $plantel = $this->input->get("plantel");

        echo json_encode($this->M_regularizacion->periodos_regularizacion_plantel($plantel));
    }

    ///debe mandar el periodo en formato 5-2021
    public function regularizaciones_plantel_periodo(){
        $plantel = $this->input->get('plantel');
        $mes = $this->input->get('mes');
        $ano = $this->input->get('ano');

        echo json_encode($this->M_regularizacion->regularizaciones_plantel_periodo($plantel,$mes,$ano));
    }
}