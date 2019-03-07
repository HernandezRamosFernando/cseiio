<?php
class M_lengua_materna extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }


   function get_lengua_materna_aspirante($no_control){

    return $this->db->get_where('Lengua_materna', array('Aspirante_no_control' => $no_control))->result();

   }
}