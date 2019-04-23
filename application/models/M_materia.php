<?php
class M_materia extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }

   public function get_materias_semestre($semestre){
        return $this->db->query("select clave from Materia where semestre=".$semestre)->result();
   }
}