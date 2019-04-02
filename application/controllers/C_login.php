<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	public function index()
	{
		$data['title'] = 'Login';
		$this->load->view('headers/cabecera', $data);
		$this->load->view('login');
		$this->load->view('footers/footer.php');
	}

}