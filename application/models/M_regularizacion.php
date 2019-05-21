<?php
class M_regularizacion extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }


   public function get_materias_pasadas_estudiante($no_control){
      return $this->db->query("select id_materia,calificacion from Regularizacion where calificacion>=6 and Estudiante_no_control='".$no_control."'")->result();
   }


   public function get_materias_adeudo_estudiantes(){
      $this->db->query("select * from Grupo_Estudiante where calificacion_final<6 and id_materia not in(select id_materia from Regularizacion where calificacion>=6)");
   }

   public function get_materias_adeudo_estudiante($no_control){
      $this->db->query("select * from Grupo_Estudiante where calificacion_final<6 and id_materia not in(select id_materia from Regularizacion where calificacion>=6 and Estudiante_no_control='".$no_control."')");
   }

   public function materias_con_reprobados_html($plantel){
      return $this->db->query("SELECT 
      distinct ge.id_materia,g.plantel,m.unidad_contenido
   FROM
       Grupo_Estudiante AS ge
   INNER JOIN Materia AS m ON ge.id_materia = m.clave INNER JOIN Grupo as g on g.id_grupo=ge.Grupo_id_grupo INNER JOIN Estudiante as e on e.no_control=ge.Estudiante_no_control
   WHERE
       calificacion_final < 6 and plantel='".$plantel."'
     AND id_materia NOT IN (SELECT 
               id_materia
           FROM
               Regularizacion
           WHERE
               calificacion >= 6) and (e.estatus='IRREGULAR' or e.estatus='SIN DERECHO' or e.estatus='INCORPORADO')")->result();
   }


   public function estudiantes_materia($plantel,$materia){

      return $this->db->query("SELECT 
      ge.Estudiante_no_control,ge.id_materia,m.semestre,e.semestre_en_curso,e.nombre,e.primer_apellido,e.segundo_apellido
       FROM
           Grupo_Estudiante AS ge
       INNER JOIN Materia AS m ON ge.id_materia = m.clave INNER JOIN Grupo as g on g.id_grupo=ge.Grupo_id_grupo INNER JOIN Estudiante as e on e.no_control=ge.Estudiante_no_control
       WHERE
           calificacion_final < 6 and plantel='".$plantel."'
         AND id_materia NOT IN (SELECT 
                   id_materia
               FROM
                   Regularizacion
               WHERE
                   calificacion >= 6) and id_materia='".$materia."' and (e.estatus='IRREGULAR' or e.estatus='SIN DERECHO' or e.estatus='INCORPORADO')")->result();

   }



   public function agregar_regularizacion($datos){
      
      $this->db->trans_start();
      foreach($datos as $regularizacion){

         $this->db->query("insert into Regularizacion (Estudiante_no_control,id_materia,calificacion,fecha) 
         values ('".$regularizacion->no_control."','".$regularizacion->id_materia."',".$regularizacion->calificacion.",'".date("Y-m-d")."')");

      }
      $this->db->trans_complete();
      
      if ($this->db->trans_status() === FALSE)
      {
              return "no";
      }

      else{
         return "si";
      }
   }



   public function materias_debe_estudiante_actualmente($no_control){
        return $this->db->query("select id_materia from Grupo_Estudiante where calificacion_final<6 and Estudiante_no_control='".$no_control."' and id_materia not in (select id_materia from Regularizacion where calificacion>=6 and Estudiante_no_control='".$no_control."')");
   }
}