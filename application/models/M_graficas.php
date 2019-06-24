<?php
class M_graficas extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }
   
function count_estudiantes_hombres(){
    return $this->db->query("select count(*) as hombres  FROM Estudiante where sexo = 'H'")->result();

}

function count_estudiantes_mujeres(){
    return $this->db->query("select count(*) as mujeres FROM Estudiante where sexo = 'M'")->result();
    
}

}