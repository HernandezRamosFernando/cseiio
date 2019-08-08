<?php
class M_graficas extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }
   

   function numero_estudiantes_hombres_mujeres_por_plantel(){

      return $this->db->query("select nombre_corto as plantel,hombres,mujeres from Plantel as p inner join (select hombre.Plantel_cct_plantel as plantel,hombres,mujeres from (select Plantel_cct_plantel,count(sexo) as hombres from Estudiante where sexo='H' group by Plantel_cct_plantel) as hombre inner join (select Plantel_cct_plantel,count(sexo) as mujeres from Estudiante where sexo='M' group by Plantel_cct_plantel) as mujer on hombre.Plantel_cct_plantel=mujer.Plantel_cct_plantel) as datos on p.cct_plantel=datos.plantel")->result();

   }

   function total_estudiantes_por_plantel(){
      return $this->db->query("select nombre_corto as plantel,total_estudiantes from Plantel as p inner join (select Plantel_cct_plantel as plantel,count(*) as total_estudiantes from Estudiante group by Plantel_cct_plantel) as datos on p.cct_plantel=datos.plantel")->result();
   }

   function estatus_estudiantes_por_plantel(){
      return $this->db->query("select nombre_corto,regulares,irregulares from Plantel as p inner join (select a.plantel,regulares,irregulares from (select plantel,sum(total) as regulares from (select Plantel_cct_plantel as plantel,count(*) as total from Estudiante where estatus='' group by Plantel_cct_plantel
      union
      select Plantel_cct_plantel as plantel,count(*) as total from Estudiante where estatus='REGULAR' group by Plantel_cct_plantel) as regulares group by plantel) as a 
      inner join
      (select Plantel_cct_plantel as plantel,count(*) as irregulares  from Estudiante where estatus='IRREGULAR' group by Plantel_cct_plantel) as b on a.plantel=b.plantel) as datos on p.cct_plantel=datos.plantel
      ")->result();
   }


   function estudiantes_por_distrito(){
      return $this->db->query("select nombre_distrito as distrito,count(*) as total from Estudiante as e inner join Localidad as l on e.id_localidad=l.id_localidad inner join Municipio as m on l.Municipio_id_municipio=m.id_municipio inner join Distrito as d on m.Distrito_id_distrito=d.id_distrito group by nombre_distrito")->result();
   }


   function estudiantes_lengua(){
      return $this->db->query(" select l.nombre_lengua as lengua,leen,hablan,escriben,entienden,traducen from Lengua as l inner join (select leen.id_lengua,leen,hablan,escriben,entienden,traducen from (select id_lengua,count(*) as leen from Datos_lengua_materna where porcentaje>0 and descripcion='LEE' group by id_lengua) as leen
      inner join
      (select id_lengua,count(*) as hablan from Datos_lengua_materna where porcentaje>0 and descripcion='HABLA' group by id_lengua) as hablan on leen.id_lengua=hablan.id_lengua
      inner join
      (select id_lengua,count(*) as escriben from Datos_lengua_materna where porcentaje>0 and descripcion='ESCRIBE' group by id_lengua) as escriben on leen.id_lengua=escriben.id_lengua
      inner join
      (select id_lengua,count(*) as entienden from Datos_lengua_materna where porcentaje>0 and descripcion='ENTIENDE' group by id_lengua) as entienden on leen.id_lengua=entienden.id_lengua
      inner join
      (select id_lengua,count(*) as traducen from Datos_lengua_materna where porcentaje>0 and descripcion='TRADUCE' group by id_lengua) as traducen on leen.id_lengua=traducen.id_lengua) as datos on l.id_lengua=datos.id_lengua")->result();
   }



   function materias_con_reprobados(){
      return $this->db->query("select distinct unidad_contenido,reprobados from Materia as m inner join (select id_materia,count(id_materia) as reprobados from Grupo_Estudiante where calificacion_final<6 group by id_materia) as datos on m.clave=datos.id_materia")->result();
   }



   function estudiantes_tipo_ingreso(){
      return $this->db->query("select tipo_ingreso,count(*) as total from Estudiante group by tipo_ingreso")->result();
   }
}