<?php
class M_ciclo_escolar extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }


   public function get_ciclo_escolar(){
        return $this->db->query('SELECT * FROM Ciclo_escolar WHERE fecha_inicio = ( SELECT  MAX(fecha_inicio) FROM Ciclo_escolar);')->result();
   }

   public function get_datos_siguiente_ciclo(){
      $registros_ciclo = $this->db->query("select count(*) as n from Ciclo_escolar where fecha_inicio=(select max(fecha_inicio) from Ciclo_escolar)")->result();
      if($registros_ciclo[0]->n<2){
         return $this->get_ciclo_escolar();
      }
      
      else{
         return array('respuesta'=>true);
      }
   }
}