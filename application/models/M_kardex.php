<?php
class M_kardex extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }





   function datos_estudiante_tutor($no_control){
        return $this->db->query("select * from Estudiante as e inner join Estudiante_Tutor as et on e.no_control=et.Estudiante_no_control inner join Tutor as t on t.id_tutor=et.Tutor_id_tutor inner join Localidad as l on e.id_localidad=l.id_localidad inner join Municipio as m on l.Municipio_id_municipio=m.id_municipio inner join Plantel as p on e.Plantel_cct_plantel=p.cct_plantel where no_control='".$no_control."'")->result()[0];
   }

   function grupos_ordenados_estudiante_normal($no_control){
      return $this->db->query("select Grupo_id_grupo,semestre from Grupo_Estudiante as ge inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo where Estudiante_no_control='".$no_control."' and g.estatus=0 and ge.calificacion_final is not null group by Grupo_id_grupo order by semestre asc")->result();
   }

   function datos_materias_grupo_estudiante($grupo,$no_control){
      return $this->db->query("select * from Grupo_Estudiante as ge inner join Materia as m on m.clave=ge.id_materia inner join Ciclo_escolar as ce on ce.id_ciclo_escolar=ge.Ciclo_escolar_id_ciclo_escolar where Estudiante_no_control='".$no_control."' and Grupo_id_grupo='".$grupo."' group by m.clave")->result();
   }

   function materia_regularizacion_estudiante($no_control,$materia){
      return $this->db->query("select * from Regularizacion where Estudiante_no_control='".$no_control."' and id_materia='".$materia."' and calificacion>5")->result();
   }

   function resolucion_equivalencia_estudiante($no_control){
      return $this->db->query("SELECT * FROM Resolucion_equivalencia where id_estudiante='".$no_control."'")->result();
   }

   function materias_hasta_semestre_validado($semestre){
      $materias = array();
      for($i=1;$i<=$semestre;$i++){
         $materias[$i-1] = $this->db->query("select * from Materia where semestre=".$i)->result();
      }
      return $materias;
   }


   function bachillerato_procedencia($no_control){
      return $this->db->query("select *,concat(nombre_municipio,',',nombre_estado) as lugar_escuela from Estudiante_Escuela_procedencia as eep inner join Escuela_procedencia as ep on eep.Escuela_procedencia_cct_escuela_procedencia=ep.cct_escuela_procedencia inner join Localidad as l on ep.id_localidad_escuela_procedencia=l.id_localidad inner join Municipio as m on l.Municipio_id_municipio=m.id_municipio inner join Estado as e on m.Estado_id_estado=e.id_estado where Estudiante_no_control='".$no_control."' and tipo_escuela_procedencia='BACHILLERATO'")->result()[0];
   }

}