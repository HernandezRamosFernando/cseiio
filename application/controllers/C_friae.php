<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_friae extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("M_friae");
    }

    public function crear_friae(){
        $datos = json_decode($this->input->raw_input_stream);
        echo $this->M_friae->crear_friae($datos);
    }
}