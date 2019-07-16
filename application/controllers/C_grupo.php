<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_grupo extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('M_grupo');
    }

    public function get_existe_grupo(){
        $id_grupo = $this->input->get("id_grupo");
    echo json_encode($this->M_grupo->get_existe_grupo($id_grupo));
    }

    public function get_estudiantes_grupo(){
        $id_grupo = $this->input->get("id_grupo");
        echo json_encode($this->M_grupo->get_estudiantes_grupo($id_grupo));
    }

    public function delete_estudiantes_grupo(){
        $datos = json_decode($this->input->raw_input_stream);
        echo $this->M_grupo->delete_estudiantes_grupo($datos);
    }

    public function delete_grupo(){
        $grupo = json_decode($this->input->raw_input_stream);
        echo $this->M_grupo->delete_grupo($grupo->id_grupo);
    }

    public function get_materias_grupo(){
        $id_grupo = $this->input->get("grupo");
        echo json_encode($this->M_grupo->get_materias_grupo($id_grupo));
    }
    public function get_materias_grupo_por_calificar(){
        $id_grupo = $this->input->get("grupo");
        echo json_encode($this->M_grupo->get_materias_grupo_por_calificar($id_grupo));
    }

    public function get_materias_grupo_asesor(){
        $id_grupo = $this->input->get("grupo");
        echo json_encode($this->M_grupo->get_materias_grupo_asesor($id_grupo));
    }

    function permiso_materia_grupo(){
        $grupo = $this->input->get("grupo");
        $materia = $this->input->get("materia");

        echo $this->M_grupo->permiso_materia_grupo($materia,$grupo);
    }

    public function agregar_asesor_materias(){
        $datos = json_decode($this->input->raw_input_stream);
        echo $this->M_grupo->agregar_asesor_materias($datos);
    }


    public function get_estudiantes_grupo_materia(){
        $id_grupo = $this->input->get("grupo");
        $id_materia = $this->input->get("materia");
        //echo $id_materia;
        echo json_encode($this->M_grupo->get_estudiantes_grupo_materia($id_grupo,$id_materia));
    }


    public function get_grupos_ciclo_escolar_plantel_inactivos(){
        $plantel = $this->input->get("plantel");
        $ciclo = $this->input->get("ciclo");

        $grupos = $this->M_grupo->get_grupos_ciclo_escolar_plantel_inactivos($plantel,$ciclo);

        $respuesta_html = "";

        foreach($grupos as $grupo){
            $respuesta_html.='<option value="'.$grupo->id_grupo.'">'.$grupo->semestre.' '.$grupo->nombre_grupo.'</option>';
        }

        echo $respuesta_html;
    }

    public function get_grupos_ciclo_escolar_plantel_friae(){
        $plantel = $this->input->get("plantel");
        $ciclo = $this->input->get("ciclo");

        $grupos = $this->M_grupo->get_grupos_ciclo_escolar_plantel_friae($plantel,$ciclo);

        $respuesta_html = "";

        foreach($grupos as $grupo){
            $respuesta_html.='<option value="'.$grupo->id_grupo.'">'.$grupo->semestre.' '.$grupo->nombre_grupo.'</option>';
        }

        echo $respuesta_html;
    }

//---------------------------------------------------------------
public function get_num_estudiantes_grupo(){
    $id_grupo = $this->input->get("id_grupo");
    echo json_encode($this->M_grupo->get_num_alumnos_grupo($id_grupo));


}

}
?>




