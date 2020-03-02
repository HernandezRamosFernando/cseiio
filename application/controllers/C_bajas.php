<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_bajas extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("M_baja");
    }

    public function eliminar_datos_baja(){
        $no_control = $this->input->post('no_control_baja_eliminar');
        $fecha_baja = $this->input->post('fecha_baja_eliminar');

        $datos = array(
            'Estudiante_no_control' => $no_control,
            'fecha' =>$fecha_baja
        );
        
        
        echo $this->M_baja->eliminar_datos_baja($datos);

    }

    public function busqueda_alumnos_grupo_baja_permisos(){
        $curp = $this->input->get('curp');
        $cct_plantel = $this->input->get('cct_plantel');
        echo json_encode($this->M_baja->busqueda_alumnos_grupo_baja_permisos($curp,$cct_plantel));
    }
    public function permisos_editar_datos_baja(){
        $no_control = $this->input->post('no_control_editar');
        $fecha_inicio=$this->input->post('fecha_inicio2');
        $fecha_fin=$this->input->post('fecha_fin2');

        
        $datos = array(
            'Estudiante_no_control' => $no_control,
            'fecha_inicio' =>$fecha_inicio,
            'fecha_termino' =>$fecha_fin,
            'estatus' =>1
        );
        
        
        echo $this->M_baja->permisos_editar_datos_baja($datos,$no_control);

    }

    public function editar_datos_baja(){
        $no_control = $this->input->post('no_control_baja');
        $fecha = $this->input->post('fecha_baja');
        $motivo = $this->input->post('motivo_baja');
        $observacion = $this->input->post('observacion_baja');

        $datos = array(
            'fecha' => $fecha,
            'motivo' =>$motivo,
            'observacion' =>$observacion
        );
        
        
        echo $this->M_baja->editar_datos_baja($datos,$no_control);

    }

    public function datos_alumno_baja(){
        $no_control = $this->uri->segment(3);
        $datos['datos_baja']=$this->M_baja->datos_alumno_baja($no_control);
        echo json_encode($datos);
    }

    public function busqueda_alumnos_grupo_baja(){
        $curp = $this->input->get('curp');
        $cct_plantel = $this->input->get('cct_plantel');
        echo json_encode($this->M_baja->busqueda_alumnos_grupo_baja($curp,$cct_plantel));
    }

    public function busqueda_alumnos_grupo(){
        $curp = $this->input->get('curp');
        $cct_plantel = $this->input->get('cct_plantel');
        echo json_encode($this->M_baja->busqueda_alumnos_grupo($curp,$cct_plantel));
    }

    public function agregar_permiso(){
        $no_control = $this->input->post('no_control');
        $id_grupo = $this->input->post('id_grupo');
        $id_plantel = $this->input->post('id_plantel');
        
        $fecha_inicio = $this->input->post('fecha_inicio');
        $fecha_fin = $this->input->post('fecha_fin');
        $examen = $this->input->post('examen');
        echo $this->M_baja->agregar_permiso($examen,$no_control,$id_grupo,$fecha_inicio,$fecha_fin,$id_plantel);

    }

    public function get_materias_por_calificar(){
        $grupo = $this->input->get("grupo");
        echo json_encode($this->M_baja->get_materias_por_calificar($grupo));
    }

    public function get_estudiantes_por_calificar(){
        $grupo = $this->input->get("grupo");
        $materias = $this->input->get("materia");
        echo json_encode($this->M_baja->get_estudiantes_por_calificar($grupo,$materias));
    }


    public function actualizar_calificaciones_materia_grupo(){
        $datos = json_decode($this->input->raw_input_stream);
        echo $this->M_baja->actualizar_calificaciones_materia_grupo($datos);
    }

}