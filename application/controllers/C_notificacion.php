<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_notificacion extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_notificacion');
    }




    function agregar_notificacion(){
        $datos = json_decode($this->input->raw_input_stream);
        echo $this->M_notificacion->agregar_notificacion($datos);
    }

    function notificaciones_plantel(){
        $plantel = $this->input->get("plantel");
        echo json_encode($this->M_notificacion->notificaciones_plantel($plantel));
    }
}