<?php
class M_ciclo_escolar extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }


   public function get_ciclo_escolar(){
        return $this->db->get('Ciclo_escolar')->result();
   }
}