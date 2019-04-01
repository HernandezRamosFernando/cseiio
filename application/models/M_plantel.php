<?php
class M_plantel extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }



   function get_planteles(){
        return $this->db->get('Plantel')->result();
   }
   function get_nombre_plantel($idplantel){
      $this->db->select('nombre_plantel');
     $this->db->from('Plantel');
     $this->db->where('cct', $idplantel);
       return $this->db->get()->row();
}
}
