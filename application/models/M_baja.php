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


   function lista_baja_estudiante_x_plantel_ciclo($plantel,$id_ciclo){
      return $this->db->query("SELECT distinct ge.Estudiante_no_control,g.semestre,g.nombre_grupo,e.nombre,e.primer_apellido,e.segundo_apellido,b.motivo,b.fecha,b.observacion FROM Grupo_Estudiante ge inner join Grupo g on ge.Grupo_id_grupo=g.id_grupo inner join Baja b on b.Estudiante_no_control=ge.Estudiante_no_control inner join Estudiante e on e.no_control=ge.Estudiante_no_control inner join Ciclo_escolar c on ge.Ciclo_escolar_id_ciclo_escolar=c.id_ciclo_escolar where g.plantel='".$plantel."' and c.id_ciclo_escolar=".$id_ciclo." and b.fecha between c.fecha_inicio_inscripcion and c.fecha_terminacion order by g.semestre,g.nombre_grupo,e.primer_apellido,e.segundo_apellido,e.nombre;")->result();
   }

   
}