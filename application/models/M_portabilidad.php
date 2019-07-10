<?php
class M_portabilidad extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }




   function estudiante_portabilidad($no_control){
       return $this->db->query("select * from Resolucion_equivalencia where id_estudiante='".$no_control."'")->result();
   }

   function estudiantes_de_portabilidad($curp,$plantel){
        return $this->db->query("select * from Friae_Estudiante as fe inner join Estudiante as e on fe.Estudiante_no_control=e.no_control where tipo_ingreso_inscripcion='PORTABILIDAD' and e.curp like '".$curp."%' and Plantel_cct_plantel like '".$plantel."%'")->result();
   }

   //select if(datediff(curdate(),fecha_inscripcion)<=60,"si","no") as dias from Estudiante where no_control='CSEIIO1910001';

   function fecha_valida_agregar_materias($no_control){
      return $this->db->query("select if(datediff(curdate(),fecha_inscripcion)<=60,'si','no') as dias from Estudiante where no_control='".$no_control."'")->result()[0]->dias;
   }
}