<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class C_menu extends CI_Controller{
    public function inscripcion(){
        $this->load->view("headers/cabecera");
        $this->load->view("headers/menuarriba");
        $this->load->view("admin/inscripcion");
        $this->load->view("footers/footer");
    }
    
    public function principal(){
        $this->load->view("headers/cabecera");
        $this->load->view("admin/menuadmin");
        $this->load->view("footers/footer");
    }





}