<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_plantel extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model("M_plantel");
    }


    public function get_plantel_especialidad(){
        $plantel = $this->input->get("plantel");
        echo json_encode($this->M_plantel->get_plantel_especialidad($plantel));
    }

    public function get_plantel_especialidad_html(){
        $plantel = $this->input->get("plantel");
        echo $this->M_plantel->get_plantel_especialidad_html($plantel);
        //print_r($this->M_plantel->get_plantel_especialidad($plantel));
    }


    public function get_grupos_plantel_html(){
        $plantel = $this->input->get("plantel");
        $semestre = $this->input->get("semestre");
        echo $this->M_plantel->get_grupos_plantel_html($plantel,$semestre);
    }

    public function get_grupos_plantel_htmloption(){
        $plantel = $this->input->get("plantel");
        $semestre = $this->input->get("semestre");
        echo $this->M_plantel->get_grupos_plantel_htmloption($plantel,$semestre);
    }

    public function get_planteles(){
        echo json_encode($this->M_plantel->get_planteles());
    }

    function get_planteles_sin_cerrar_calificaciones(){
        echo json_encode($this->M_plantel->get_planteles_sin_cerrar_calificaciones());
     }

     ////////////----------------------------------------------------------------------------------
    /*public function get_lista_planteles_especialidad_html(){
        $id_componente = $this->input->get("id_componente");
        echo $this->M_plantel->get_lista_planteles_especialidad_html($id_componente);
    }
 */

public function get_lista_planteles_especialidad_traslado_html(){
    $no_control = $this->input->get("no_control");
    $semestre = $this->input->get("semestre");
    $id_componente = $this->input->get("id_componente");
    echo $this->M_plantel->get_lista_planteles_especialidad_traslado_html($no_control,$semestre,$id_componente);
}

    function get_planteles_sin_examen_final(){
        echo json_encode($this->M_plantel->get_planteles_sin_examen_final());
     }

     
}