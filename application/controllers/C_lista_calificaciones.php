<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_lista_calificaciones extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_localidad');
        $this->load->model('M_grupo_estudiante');
        $this->load->model('M_asesor');
        $this->load->model('M_ciclo_escolar');
        $this->load->model('M_baja');
    }



    public function lista_calificaciones_grupo_materia(){
        
        $grupo = $this->input->get("grupo");
        $materia = $this->input->get("materia");

        $this->load->library('pdf');
        $datos['estudiantes'] = $this->M_grupo_estudiante->nombres_estudiantes_grupo_materia($grupo,$materia);
        $datos['plantel'] = $this->M_grupo_estudiante->plantel_grupo($grupo);
        $datos['materia'] = $this->M_grupo_estudiante->datos_materia_grupo($materia,$grupo);
        $this->load->view("reportes/lista_calificaciones",$datos);
    }


    public function lista_calificaciones_grupo_materia_llena(){
        $this->load->library('pdf');
        $grupo = $this->input->get("grupo");
        $materia = $this->input->get("materia");

        $datos['estudiantes'] = $this->M_grupo_estudiante->datos_estudiantes_grupo_materia($grupo,$materia);

        $bajas = array();
        $contador = 0;

        foreach($datos['estudiantes'] as $estudiante){
            $baja = $this->M_baja->baja_estudiante($estudiante->no_control);
            
            if(sizeof($baja)>0){
                $bajas[$contador]=$baja;
            }

            else{
                $bajas[$contador]=array();
            }
            $contador+=1;
        }
        $datos['plantel'] = $this->M_grupo_estudiante->plantel_grupo($grupo);
        $datos['materia'] = $this->M_grupo_estudiante->datos_materia_grupo($materia,$grupo);
        $datos['asesor'] = $this->M_asesor->asesor_materia_grupo($grupo,$materia);
        $datos['fecha_fin'] = $this->M_ciclo_escolar->fecha_fin_ciclo();
        $datos['bajas'] = $bajas;
        //$datos['bajas'] = $this->;
       // print_r($this->M_asesor->asesor_materia_grupo($grupo,$materia));
        $this->load->view("reportes/lista_calificaciones_llena",$datos);
        //print_r($bajas);
    }

   
}