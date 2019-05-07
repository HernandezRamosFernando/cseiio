<?php
class M_lengua extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }


   function get_lenguas(){
       return $this->db->get('Lengua')->result();
   }

   //------------------------------ inicia operacion panzer
   function get_nombre_lengua($idlengua){
      $this->db->select('nombre_lengua');
        $this->db->from('Lengua');
        $this->db->where('id_lengua',$idlengua);
          return $this->db->get()->row();
  }
}