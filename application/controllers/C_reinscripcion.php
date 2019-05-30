<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_reinscripcion extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("M_reinscripcion");
    }



    function estudiantes_en_grupos_activos(){
        echo json_encode($this->M_reinscripcion->estudiantes_en_grupos_activos());
    }

    function reinscribir(){
        echo $this->M_reinscripcion->reinscribir();
    }

    function cerrar_calificaciones_plantel(){//primera*-*-**-*-**-*-*-*-*-*-*-*-*-
        $plantel = $this->input->get("plantel");
        echo $this->M_reinscripcion->cerrar_calificaciones_plantel($plantel);
    }

    function cerrar_calificaciones(){
        echo $this->M_reinscripcion->cerrar_calificaciones();
    }


    function materias_cursando_estudiante(){ 
        $no_control = $this->input->get("no_control");
        echo json_encode($this->M_reinscripcion->materias_cursando_estudiante($no_control));
    }


    function actualizar_tipo_ingreso_despues_calificar_estudiante(){//segundo*/*/*/*/*/*/*/*/*/*
            echo $this->M_reinscripcion->actualizar_tipo_ingreso_despues_calificar_estudiante();
    }

    public function cerrar_periodo(){
        $datos = json_decode($this->input->raw_input_stream);
        echo $this->M_reinscripcion->cerrar_periodo($datos);
    }
}