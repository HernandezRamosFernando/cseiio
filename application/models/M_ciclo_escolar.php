<?php
class M_ciclo_escolar extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }


   public function get_ciclo_escolar(){
        return $this->db->query('SELECT * FROM Ciclo_escolar WHERE fecha_inicio = ( SELECT  MAX(fecha_inicio) FROM Ciclo_escolar);')->result();
   }
}