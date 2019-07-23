<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_acta_regularizacion extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_plantel');
        $this->load->model('M_acta_regularizacion');
    }


    function generar_acta(){
        $this->load->library('pdf');
        $plantel = $this->input->get("plantel");
        $mes = intval($this->input->get("mes"));
        $ano = intval($this->input->get("ano"));
        $materia = $this->input->get("materia");

        $datos['plantel'] = $this->M_plantel->get_plantel($plantel)[0];
        $datos['fecha_hora'] = $this->M_acta_regularizacion->fecha_hora_regularizacion($mes,$ano,$plantel,$materia)[0];
        $datos['materia'] = $this->M_acta_regularizacion->materia($materia);
        $datos['asesor'] = $this->M_acta_regularizacion->asesor($mes,$ano,$plantel,$materia)[0];
        $mes_dato = "";
        switch($mes){
            case 1:
            $mes_dato="ENERO";
            break;

            case 5:
            $mes_dato="MAYO";
            break;

            case 7:
            $mes_dato="JULIO";
            break;

            case 10:
            $mes_dato="OCTUBRE";
            break;
        }
        $datos['mes'] = $mes_dato;

        if($mes==5 || $mes==10){// muestra el grupo anterior

            $datos['estudiantes_con_grupo'] = $this->M_acta_regularizacion->estudiantes_con_grupo_regularizacion_intermedia($mes,$ano,$plantel,$materia);
            $datos['estudiantes_sin_grupo'] = $this->M_acta_regularizacion->estudiantes_sin_grupo_regularizacion_intermedia($mes,$ano,$plantel,$materia);

        }

        else{// muestra el grupo actual
            $datos['estudiantes_con_grupo'] = $this->M_acta_regularizacion->estudiantes_con_grupo_regularizacion_intermedia($mes,$ano,$plantel,$materia);
            $datos['estudiantes_sin_grupo'] = $this->M_acta_regularizacion->estudiantes_sin_grupo_regularizacion_intermedia($mes,$ano,$plantel,$materia);
        }

       //print_r($datos['estudiantes_con_grupo']);
        $this->load->view('reportes/acta_regularizacion',$datos);
    }
}