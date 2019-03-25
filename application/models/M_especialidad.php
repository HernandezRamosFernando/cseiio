<?php
class M_especialidad extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }


   public function get_especialidad($cct){
        return $this->db->get_where('Plantel_Especialidad', array('Plantel_cct' => $cct))->result();
   }
}