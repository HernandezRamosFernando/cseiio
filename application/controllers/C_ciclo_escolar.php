<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_aspirante extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }


    public function get_siguiente_ciclo(){
            echo "hola";
    }
}