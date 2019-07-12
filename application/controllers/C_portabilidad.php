<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_portabilidad extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model("M_portabilidad");
    }



    function estudiantes_de_portabilidad(){
        $plantel = $this->input->get("plantel");
        $curp = $this->input->get("curp");

        echo json_encode($this->M_portabilidad->estudiantes_de_portabilidad($curp,$plantel));
    }

    function fecha_valida_agregar_materias(){
        $no_control = $this->input->get("no_control");
        echo $this->M_portabilidad->fecha_valida_agregar_materias($no_control);
    }

    function datos_cargar_materias_estudiante(){
        $no_control = $this->input->get("no_control");
        echo json_encode($this->M_portabilidad->datos_cargar_materias_estudiante($no_control));
    }


    function materias_html(){
        $materias = $this->M_portabilidad->materias();
        $respuesta = '<option value="">Seleccione una materia</option>';

        foreach($materias as $materia){
            $respuesta .= '<option value="'.$materia->clave.'">'.$materia->unidad_contenido.'->'.$materia->clave.'</option>';
        }


        echo $respuesta;
    }


    function agregar_materias(){
        $datos = json_decode($this->input->raw_input_stream);
        echo $this->M_portabilidad->agregar_materias($datos);
    }
}