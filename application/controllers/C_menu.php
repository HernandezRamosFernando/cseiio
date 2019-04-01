<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class C_menu extends CI_Controller{
    public function inscripcion(){

        $data= array('title'=>'Inscripcion');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view('admin/inscripcion',);
        $this->load->view("footers/footer");
    }
    
    public function principal(){
        $data= array('title'=>'Menú principal');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("admin/menuadmin");
        $this->load->view("footers/footer");
    }





}