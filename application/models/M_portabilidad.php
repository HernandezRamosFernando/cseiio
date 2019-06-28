<?php
class M_portabilidad extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }




   function estudiante_portabilidad($no_control){
       return $this->db->query("select * from Resolucion_equivalencia where id_estudiante='".$no_control."'")->result();
   }
}