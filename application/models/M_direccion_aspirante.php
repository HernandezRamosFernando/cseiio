<?php
class M_direccion_aspirante extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }


   function get_direccion_aspirante($no_control){

    return $this->db->get_where('Direccion_Aspirante', array('Aspirante_no_control' => $no_control))->result();

   }
}