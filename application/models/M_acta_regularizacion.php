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


   function estudiantes_con_grupo_regularizacion_intermedia($mes,$ano,$plantel,$materia){
         return $this->db->query("select regularizaciones.Estudiante_no_control as no_control,e.nombre,e.primer_apellido,e.segundo_apellido,e.matricula,regularizaciones.calificacion,
         (select concat(semestre,nombre_grupo) from Grupo_Estudiante as ge inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo where Estudiante_no_control=no_control and semestre=(select max(semestre) as semestre from Grupo_Estudiante as ge inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo where ge.Estudiante_no_control=no_control and calificacion_final is not null) and calificacion_final is not null limit 1) as ultimo_grupo
          from (select Estudiante_no_control,fecha_calificacion,calificacion from Regularizacion where year(fecha_calificacion)=".$ano." and month(fecha_calificacion)=".$mes." and Plantel_cct_plantel='".$plantel."' and id_materia='".$materia."') as regularizaciones inner join (select * from Grupo_Estudiante as ge inner join Ciclo_escolar as ce on ge.Ciclo_escolar_id_ciclo_escolar=ce.id_ciclo_escolar) as grupos on regularizaciones.Estudiante_no_control=grupos.Estudiante_no_control inner join Estudiante as e on regularizaciones.Estudiante_no_control=e.no_control where regularizaciones.fecha_calificacion between grupos.fecha_inicio and date_add(grupos.fecha_terminacion,interval 20 day) group by regularizaciones.Estudiante_no_control order by ultimo_grupo,primer_apellido,segundo_apellido,nombre")->result();
   }

   function estudiantes_sin_grupo_regularizacion_intermedia($mes,$ano,$plantel,$materia){
      return $this->db->query("select Estudiante_no_control as no_control,
      e.nombre,e.primer_apellido,e.segundo_apellido,e.matricula,
      (select concat(semestre,nombre_grupo) from Grupo_Estudiante as ge inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo where Estudiante_no_control=no_control and semestre=(select max(semestre) as semestre from Grupo_Estudiante as ge inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo where ge.Estudiante_no_control=no_control and calificacion_final is not null) and calificacion_final is not null limit 1) as ultimo_grupo
       from (select Estudiante_no_control from Regularizacion where year(fecha_calificacion)=".$ano." and month(fecha_calificacion)=".$mes." and Plantel_cct_plantel='".$plantel."' and id_materia='".$materia."' and Estudiante_no_control not in 
      (select regularizaciones.Estudiante_no_control
       from (select Estudiante_no_control,fecha_calificacion from Regularizacion where year(fecha_calificacion)=".$ano." and month(fecha_calificacion)=".$mes." and Plantel_cct_plantel='".$plantel."' and id_materia='".$materia."') as regularizaciones inner join (select * from Grupo_Estudiante as ge inner join Ciclo_escolar as ce on ge.Ciclo_escolar_id_ciclo_escolar=ce.id_ciclo_escolar) as grupos on regularizaciones.Estudiante_no_control=grupos.Estudiante_no_control where regularizaciones.fecha_calificacion between grupos.fecha_inicio and date_add(grupos.fecha_terminacion,interval 20 day) group by regularizaciones.Estudiante_no_control)) as sin_grupo inner join Estudiante as e on e.no_control=sin_grupo.Estudiante_no_control order by ultimo_grupo,primer_apellido,segundo_apellido,nombre")->result();
   }
}