<?php
class M_tutor extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }

   public function login($usuario, $password){
    $query = $this->db->query("SELECT * FROM Usuario where password=md5('".$password."') and usuario='".$usuario."'");
    return $query->row_array();
}
}