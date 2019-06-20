<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_usuario extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_usuario');
    }



    public function index(){

 
		//restrict users to go back to login if session has been set
		if($this->session->userdata('user')){
			redirect(base_url().'index.php/c_menu/principal');
		}
		else{
			$data['title'] = 'Login';
		$this->load->view('headers/cabecera', $data);
		$this->load->view('login');
		$this->load->view('footers/footer.php');
		}
    }
    


    public function login(){

 
		$usuario = $_POST['usuario'];
    $password = $_POST['password'];
 
        
		$datos = $this->M_usuario->login($usuario, $password);
 
		if($datos){
			$this->session->set_userdata('user',$datos);
			//redirect(base_url().'index.php/c_menu/principal');
		}
		else{
			header('location:'.base_url().'index.php/c_usuario');
			$this->session->set_flashdata('error','Invalid login. User not found');
        } 
    }
    

    public function home(){

	
 
		//restrict users to go to home if not logged in
		if($this->session->userdata('user')){
			$this->load->view(base_url().'index.php/c_menu/principal');
		}
		else{
			redirect('/');
		}
 
	}
 
	public function logout(){
		//load session library
		$this->session->sess_destroy();
		redirect('index.php/c_usuario');
	}
 


public function crear_usuario(){
	$datos = json_decode($this->input->raw_input_stream);
	echo $this->M_usuario->crear_usuario($datos);
}


public function usuarios_registrados(){

	echo json_encode($this->M_usuario->usuarios_registrados());

}

public function usuarios_registrados_id(){
	$usuario = $this->input->get("id_usuario");
	echo json_encode($this->M_usuario->usuarios_registrados_id($usuario));

}


public function editar_usuario(){
	$datos = json_decode($this->input->raw_input_stream);
  echo $this->M_usuario->editar_usuario($datos);
}

public function borrar_usuario(){
	$datos = json_decode($this->input->raw_input_stream);
	echo $this->M_usuario->borrar_usuario($datos);
}



}