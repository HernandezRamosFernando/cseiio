<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_friae extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("M_configuracion");

    }

    

    
}