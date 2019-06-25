<?php
class M_graficas extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }
   
   function hombres_mujeres_total(){

    return $this->db->query("select sexo,count(*) as total from Estudiante group by sexo")->result();
       
    }



    function estudiantes_por_plantel(){
     return $this->db->query("select nombre_plantel,total from (select Plantel_cct_plantel,count(*) as total from Estudiante group by Plantel_cct_plantel) as pl inner join Plantel as p on pl.Plantel_cct_plantel=p.cct_plantel")->result();  
    }


    function estudiantes_hablan_lengua(){
       return $this->db->query("select nombre_lengua,count(*) as total from Lengua as l inner join (select distinct no_control,id_lengua from Estudiante as e inner join Datos_lengua_materna as d on e.no_control=d.Estudiante_no_control where id_lengua>0) as la on l.id_lengua=la.id_lengua group by nombre_lengua")->result();
    }

}