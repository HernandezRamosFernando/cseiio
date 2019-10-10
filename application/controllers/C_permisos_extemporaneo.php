<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_permisos_extemporaneo extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("M_permisos_extemporaneo");
    }

    public function busqueda_alumnos_grupo(){
        $curp = $this->input->get('curp');
        $cct_plantel = $this->input->get('cct_plantel');
        echo json_encode($this->M_permisos_extemporaneo->busqueda_alumnos_grupo($curp,$cct_plantel));
    }

    public function actualizar_calificaciones_materia_grupo(){
        $datos = json_decode($this->input->raw_input_stream);
        echo $this->M_permisos_extemporaneo->actualizar_calificaciones_materia_grupo($datos);
    }

    public function get_datos_materia(){
        $grupo = $this->input->get('grupo');
        echo json_encode($this->M_permisos_extemporaneo->get_datos_materia($grupo));
    }


    public function agregar_permiso(){
        $no_control = $this->input->post('no_control');
        $id_grupo = $this->input->post('id_grupo');
        $id_plantel = $this->input->post('id_plantel');
        
        $fecha_inicio = $this->input->post('fecha_inicio');
        $fecha_fin = $this->input->post('fecha_fin');
        $examen = $this->input->post('examen');
        echo $this->M_permisos_extemporaneo->agregar_permiso($examen,$no_control,$id_grupo,$fecha_inicio,$fecha_fin,$id_plantel);

    }

    public function get_semestres_htmloption(){
        $plantel = $this->input->get("plantel");
        echo $this->M_permisos_extemporaneo->get_semestres_htmloption($plantel);
    } 

    public function get_semestre_grupos_htmloption(){
        $plantel = $this->input->get("plantel");
        $semestre = $this->input->get("semestre");
        if($plantel!="" && $semestre!=""){
            echo $this->M_permisos_extemporaneo->get_semestre_grupos_htmloption($plantel,$semestre);
        }
        else{
            echo "";
        }
        
    }

    public function get_materias_por_calificar_extemporaneo(){
        $grupo = $this->input->get("grupo");
        echo json_encode($this->M_permisos_extemporaneo->get_materias_por_calificar_extemporaneo($grupo));
    }

    public function get_estudiantes_por_calificar_extemporaneo(){
        $grupo = $this->input->get("grupo");
        $materias = $this->input->get("materia");
        echo json_encode($this->M_permisos_extemporaneo->get_estudiantes_por_calificar_extemporaneo($grupo,$materias));
    }


    public function permisos_cal_extemporaneo_plantel(){
        $plantel = $this->input->get("plantel");
        if($plantel!=''){
            echo json_encode($this->M_permisos_extemporaneo->permisos_cal_extemporaneo_plantel($plantel));
        }
        else{
            echo json_encode(array());
        }
        
    }

    public function lista_permisos(){
 
        echo json_encode($this->M_permisos_extemporaneo->lista_permisos());
    }

}