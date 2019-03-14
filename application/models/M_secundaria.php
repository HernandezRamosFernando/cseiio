<?php
class M_secundaria extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }



   public function get_secundarias(){
       return $this->db->get('Secundaria')->result();
   }
}