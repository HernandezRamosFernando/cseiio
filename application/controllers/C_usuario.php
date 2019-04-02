<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_usuario extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_usuario');
    }



    public function index(){
		//load session library
		$this->load->library('session');
 
		//restrict users to go back to login if session has been set
		if($this->session->userdata('user')){
			redirect(base_url().'c_menu/principal');
		}
		else{
			$data['title'] = 'Login';
		$this->load->view('headers/cabecera', $data);
		$this->load->view('login');
		$this->load->view('footers/footer.php');
		}
    }
    


    public function login(){
		//load session library
		$this->load->library('session');
 
		$usuario = $_POST['usuario'];
        $password = $_POST['password'];
 
        
		$datos = $this->M_usuario->login($usuario, $password);
 
		if($datos){
			$this->session->set_userdata('user', $datos);
			redirect(base_url().'c_menu/principal');
		}
		else{
			header('location:'.base_url().'c_usuario');
			$this->session->set_flashdata('error','Invalid login. User not found');
        } 
    }
    

    public function home(){
		//load session library
		$this->load->library('session');
 
		//restrict users to go to home if not logged in
		if($this->session->userdata('user')){
			$this->load->view(base_url().'c_menu/principal');
		}
		else{
			redirect('/');
		}
 
	}
 
	public function logout(){
		//load session library
		$this->load->library('session');
		$this->session->unset_userdata('user');
		redirect('/c_usuario');
	}
 






}