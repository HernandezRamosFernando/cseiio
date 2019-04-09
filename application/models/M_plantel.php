<?php
class M_plantel extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }



   function get_planteles(){
        return $this->db->get('Plantel')->result();
   }

   function get_plantel($plantel){
      return $this->db->get_where('Plantel',array('cct'=>$plantel))->result();
   }

}
