<?php
class M_estado extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }


function get_estados(){
   return $this->db->get('Estado')->result();
}

}