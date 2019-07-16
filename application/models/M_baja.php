<?php
class M_baja extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }



   function baja_estudiante($no_control){
      return $this->db->query("select * from Baja 
      where 
      fecha between 
      (select fecha_inicio from Ciclo_escolar where id_ciclo_escolar=(select max(id_ciclo_escolar) from Ciclo_escolar)) 
      and 
      (select fecha_terminacion from Ciclo_escolar where id_ciclo_escolar=(select max(id_ciclo_escolar) from Ciclo_escolar))
      and Estudiante_no_control='".$no_control."'")->result();
   }
}