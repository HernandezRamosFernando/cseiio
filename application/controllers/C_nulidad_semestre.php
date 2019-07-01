<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_nulidad_semestre extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("M_nulidad_semestre");
        $this->load->model("M_ciclo_escolar");
        $this->load->model("M_documentacion");
    }


    function nulidad_semestre_estudiante(){
        $no_control = $this->input->get("no_control");
        $semestre = $this->input->get("semestre");
        echo $this->M_nulidad_semestre->nulidad_semestre_estudiante($no_control,$semestre);
    }


    public function get_alumnos(){
        $id_plantel = $this->input->get("plantel");
        $curp = $this->input->get("curp");
        echo json_encode($this->M_nulidad_semestre->get_alumnos($id_plantel,$curp));
    }


    public function get_solicitantes_nulidad(){
        $id_plantel = $this->input->get("plantel");
        $curp = $this->input->get("curp");
        echo json_encode($this->M_nulidad_semestre->get_solicitantes_nulidad($id_plantel,$curp));
    }


    public function solicitar_nulidad(){
        $id_plantel = $this->input->post("id_plantel");
        $semestre_en_curso = $this->input->post("semestre");
        $grupo_en_curso = $this->input->post("grupo");
        
        $semestre_nulidad = $this->input->post("semestre_nulidad");
        $motivo_nulidad = $this->input->post("motivo_nulidad");
        $no_control = $this->input->post("no_control_estudiante");


        $datos_nulidad = array(
            'no_control' =>$no_control,
            'semestre_en_curso' =>$semestre_en_curso,
            'grupo_en_curso' =>$grupo_en_curso,
            'semestre_nulidad' =>$semestre_nulidad,
            'fecha_solicitud' =>date('Y-m-d'),
           
            'motivo'=>$motivo_nulidad,
            'autorizado'=>0   
        );



        if($this->input->post('documento_solicitud_nulidad')!=''){
                $datos_estudiante_documentos['documento_solicitud_nulidad'] = array(
                    'id_documento' => 13,
                    'entregado' => true,
                    'Estudiante_no_control' => $no_control
                    //'id_plantel' => $id_plantel
                );
            }
            else{
                $datos_estudiante_documentos['documento_solicitud_nulidad'] = array(
                    'id_documento' => 13,
                    'entregado' => 0,
                    'Estudiante_no_control' => $no_control
                    //'id_plantel' => $id_plantel
                );
            }
        echo $this->M_nulidad_semestre->solicitar_nulidad($datos_nulidad,$datos_estudiante_documentos);
        
        
    }






public function autorizar_nulidad(){
        $no_control = $this->input->post("no_control_estudiante");
        $semestre_nulidad = $this->input->post("semestre_nulidad");
        $id_nulidad = $this->input->post("id_nulidad");
        $semestre_en_curso = $this->input->post("semestre");
        $grupo_en_curso = $this->input->post("grupo");
        $ciclo_escolar = $this->input->post("ciclo_escolar");
        $motivo_nulidad = $this->input->post("motivo_nulidad");
        $documento = $this->input->post("documento_solicitud_nulidad");

        
         $datos_nulidad = array(
            'no_control' =>$no_control,
            'semestre_en_curso' =>$semestre_en_curso,
            'grupo_en_curso' =>$grupo_en_curso,
            'semestre_nulidad' =>$semestre_nulidad,
            
            'motivo'=>$motivo_nulidad,
            'fecha_autorizacion'=>date('Y-m-d'),
            'autorizado'=>1   
        );
        echo $this->M_nulidad_semestre->nulidad_semestre_estudiante($no_control,$semestre_nulidad,$datos_nulidad,$id_nulidad);

    }

    ////////////////////////////////////////////////////////////////////////////////////////////

    public function get_alumno_datos_nulidad(){
    $id_nulidad = $this->input->get("id_nulidad");

    $datos_nulidad=$this->M_nulidad_semestre->get_alumno_datos_nulidad($id_nulidad);
    $datos['datos_nulidad']=$datos_nulidad;
    $datos['documento']=$this->M_documentacion->get_datos_documento($datos_nulidad[0]->no_control,13);
  echo json_encode($datos);
    }
}