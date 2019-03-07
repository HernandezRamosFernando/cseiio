<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_menu extends CI_Controller{
    public function inscripcion(){
        $this->load->view("inscripcion");
    }
    
    public function principal(){
        $this->load->view("menuadmin");
    }

    public function control_alumnos(){
        $this->load->view("controlalumnos");
    }




}