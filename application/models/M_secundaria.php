<?php
class M_secundaria extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }



   public function get_secundarias(){
       return $this->db->get('Secundaria')->result();
   }

   public function get_secundaria($cct_secundaria){
        return $this->db->get_where('Secundaria',array('cct_secundaria' => $cct_secundaria))->result();
   }


   public function insert_secundaria($datos){
        return $this->db->insert('Secundaria',$datos);
   }
}