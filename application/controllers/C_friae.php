<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_friae extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("M_friae");
        $this->load->model('M_grupo');
    }

    public function crear_friae(){
        $datos = json_decode($this->input->raw_input_stream);
        echo $this->M_friae->crear_friae($datos);
    }

    public function agregar_estudiantes_friae(){
        $datos = json_decode($this->input->raw_input_stream);
        echo $this->M_friae->agregar_estudiantes_friae($datos);
    }

    public function quitar_estudiante(){
        $datos = json_decode($this->input->raw_input_stream);
        echo $this->M_friae->quitar_estudiante($datos);
    }


    public function generar_friae_grupo(){
        $this->load->library('pdf');
        $grupo = $this->input->get('grupo');
        $director_plantel_grupo = $this->M_grupo->director_plantel($grupo);
        $datos['datos_friae']=$this->M_friae->get_datos_friae($grupo);
        $contador=0;
        $materias_estudiantes;
        $datos_friae_estudiante;
        $datos_estudiante;
        foreach($this->M_friae->get_estudiantes_friae($grupo) as $estudiante){//por cada estduainte del friae
            $materias_estudiantes[$contador]=$this->M_friae->get_materias_estudiante_friae($estudiante->grupo,$estudiante->no_control);
            $datos_friae_estudiante[$contador]=$this->M_friae->get_datos_friae_estudiante($estudiante->grupo,$estudiante->no_control);
            $datos_estudiante[$contador]=$this->M_friae->get_datos_estudiante($estudiante->no_control);
            $contador+=1;
        }
        $datos['datos_friae_estudiante']=$datos_friae_estudiante;
        $datos['materias_estudiantes']=$materias_estudiantes;
        $datos['datos_estudiante']=$datos_estudiante;
        $datos['director'] = $director_plantel_grupo;

        //print_r($datos['materias_estudiantes'][0]);
        //$datos['documentos'] = $this->M_documentacion->get_documentos_base_faltantes_estudiante($no_control);
        //$datos['estudiante_plantel'] = $this->M_estudiante->get_plantel_estudiante($no_control);
        //$datos['fecha_carta'] = $this->M_documentacion->get_fecha_ultima_carta_compromiso_estudiante($no_control);
        //$datos['nombre_tutor'] = $this->M_estudiante->obtener_nombre_tutor_estudiante($no_control);
        //$datos['aspirante_plantel'] = $this->M_aspirante->get_aspirante($no_control);
        $this->load->view('reportes/friae',$datos);


    }
}