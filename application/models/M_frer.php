<?php
class M_frer extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }



   function folio_frer_periodo_plantel($plantel,$mes,$ano){
      return $this->db->query("select id_frer from Frer where month(fecha)=".$mes." and year(fecha)=".$ano." and Plantel_cct_plantel='".$plantel."'")->result()[0]->id_frer;
   }

   function datos_estudiante($no_control){
      return $this->db->query("select * from Estudiante where no_control='".$no_control."'")->result()[0];
   }

   function datos_frer_estudiante($folio,$no_control){
      return $this->db->query("select * from Detalle_frer where Frer_id_frer=".$folio." and Estudiante_no_control='".$no_control."'")->result()[0];
   }


   function datos_plantel_frer($plantel){
      return $this->db->query("select *,concat(nombre_localidad,',',nombre_municipio) as localidad_municipio from Plantel as p inner join Localidad as l on p.id_localidad_plantel=l.id_localidad inner join Municipio as m on l.Municipio_id_municipio=m.id_municipio where cct_plantel='".$plantel."'")->result()[0];
   }
}