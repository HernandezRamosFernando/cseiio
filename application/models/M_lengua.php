<?php
class M_lengua extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }


   function get_lenguas(){
       return $this->db->get('Lengua')->result();
   }
}