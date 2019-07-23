<?php
class M_acta_regularizacion extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }




   function fecha_hora_regularizacion($mes,$ano,$plantel,$materia){
        return $this->db->query("select fecha_calificacion,hora from Regularizacion where year(fecha_calificacion)=".$ano." and month(fecha_calificacion)=".$mes." and Plantel_cct_plantel='".$plantel."' and id_materia='".$materia."' limit 1")->result();
   }

   function materia($materia){
       return $this->db->query("select * from Materia where clave = '".$materia."' limit 1")->result()[0];
   }

   function asesor($mes,$ano,$plantel,$materia){
    return $this->db->query("select * from Asesor as a inner join (select id_asesor from Regularizacion where month(fecha_calificacion)=".$mes." and Plantel_cct_plantel='".$plantel."' and year(fecha_calificacion)=".$ano." and id_materia='".$materia."') as b on a.id_asesor=b.id_asesor limit 1")->result();
   }


   function estudiantes_con_grupo($mes,$ano,$plantel,$materia){

   }

   function estudiantes_sin_grupo($mes,$ano,$plantel,$materia){

   }
}