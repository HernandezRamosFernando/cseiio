<?php
class M_tutor extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }

   function get_tutor_aspirante($no_control){
    return $this->db->get_where('Tutor', array('Aspirante_no_control' => $no_control))->result();
   }
}