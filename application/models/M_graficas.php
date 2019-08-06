<?php
class M_graficas extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }
   

   function numero_estudiantes_hombres_mujeres_por_plantel(){

      return $this->db->query("select hombre.Plantel_cct_plantel as plantel,hombres,mujeres from (select Plantel_cct_plantel,count(sexo) as hombres from Estudiante where sexo='H' group by Plantel_cct_plantel) as hombre inner join (select Plantel_cct_plantel,count(sexo) as mujeres from Estudiante where sexo='M' group by Plantel_cct_plantel) as mujer on hombre.Plantel_cct_plantel=mujer.Plantel_cct_plantel")->result();

   }

}