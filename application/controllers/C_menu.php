<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class C_menu extends CI_Controller{

    public function inscripcion(){

        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
            $data= array('title'=>'Inscripcion');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view('admin/inscripcion');
            $this->load->view("footers/footer");
    
            }
            else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
                $data= array('title'=>'Inscripcion');
                $this->load->view("headers/cabecera", $data);
                $this->load->view("headers/menuarriba");
                $this->load->view("headers/menuizquierda");
                $this->load->view('admin/inscripcion');
                $this->load->view("footers/footer");
                }

            else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
                $data= array('title'=>'Inscripcion');
                $this->load->view("headers/cabecera", $data);
                $this->load->view("headers/menuarriba");
                $this->load->view("headers/menuizquierdaplantel");
                $this->load->view('plantel/inscripcion');
                $this->load->view("footers/footer");
            }
    
            else{
                redirect(base_url().'index.php/c_usuario');
            }
    }
    
    public function principal(){
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
        $data= array('title'=>'Menú principal');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("admin/menuadmin");
        $this->load->view("footers/footer");

        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $data= array('title'=>'Menú principal');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("cescolar/menucescolar");
            $this->load->view("footers/footer");
    
            }

        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $data= array('title'=>'Menú principal');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("plantel/menuplantel");
            $this->load->view("footers/footer");
        }

        else{
            header('location:'.base_url().'index.php/c_usuario');
        }
    }





}