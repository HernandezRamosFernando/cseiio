<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_grupo extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('M_grupo');
        $this->load->model('M_friae');
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

public function get_lista_grupos_estudiante(){
    $plantel = $this->input->get("plantel");
    $grupo = $this->input->get("grupo");
    $semestre_grupo = $this->input->get("semestre");
    $respuesta = "";
    $respuesta.='<option value="">Seleccione un grupo</option>';
    foreach($this->M_grupo->get_lista_grupos_estudiante($plantel,$grupo,$semestre_grupo) as $grupo){
        $respuesta .= '<option value="'.$grupo->id_grupo.'">'.mb_strtoupper($grupo->nombre_grupo).'</option>';
    }

    echo $respuesta;
}

public function modificar_grupo(){
    
    $no_control= $this->input->post("no_control_alumno");
    $id_grupo_destino = $this->input->post("id_grupo_destino");
    $id_grupo_a_modificar = $this->input->post("id_grupo_a_modificar");
     $num_alumnos=0;
     $num_alumnos=$this->M_grupo->get_num_alumnos_grupo($id_grupo_destino)[0]->num_alumnos;
     $id_friae_destino=$this->M_friae->id_friae($id_grupo_destino)[0]->folio;
     $id_friae_origen=$this->M_friae->id_friae($id_grupo_a_modificar)[0]->folio;
     
     if($num_alumnos<35){
        echo json_encode($this->M_grupo->actualizar_estudiante_grupo($no_control,$id_grupo_a_modificar,$id_grupo_destino,$id_friae_destino,$id_friae_origen));
        
    }
     else{
        
         echo json_encode(array ('error'=>"El grupo seleccionado ha superado el limite permitido de alumnos."));
     }
     
}


public function get_grupos_activos(){
    $cct_plantel= $this->input->get("plantel");
    echo json_encode($this->M_grupo->get_grupos_activos_plantel_completo($cct_plantel));
}


}
?>




