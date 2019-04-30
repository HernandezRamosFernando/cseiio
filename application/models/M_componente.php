<?php
class M_componente extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }



   public function get_id_componente($nombre_corto_componente){
        return $this->db->query("select id_componente from Componente where nombre_corto='".$nombre_corto_componente."'")->result();
   }
}