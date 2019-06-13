<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_frer extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("M_frer");
        $this->load->model("M_regularizacion");
    }


    function generar_frer_plantel_periodo(){
        $this->load->library('pdf');
        $plantel = $this->input->get('plantel');
        $periodo = $this->input->get('periodo');

        $mes_ano = explode('-',$periodo);

        //echo $mes_ano[0];
        //echo $mes_ano[1];

       $regularizaciones = $this->M_regularizacion->regularizaciones_plantel_periodo_sin_grupo($plantel,$mes_ano[0],$mes_ano[1]);
       print_r($regularizaciones);

        //$this->load->view('reportes/frer');
    }


}