<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_menu extends CI_Controller{
    public function inscripcion(){
        $this->load->view("headers/cabezera");
        $this->load->view("admin/inscripcion");
    }
    
    public function principal(){
        $this->load->view("headers/cabezera");
        $this->load->view("admin/menuadmin");
    }





}