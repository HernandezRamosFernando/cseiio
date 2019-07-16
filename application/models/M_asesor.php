<?php
class M_asesor extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }


   public function get_asesores_plantel($id_plantel){
       $asesores = $this->db->query("select * from Asesor where Plantel_cct_plantel='".$id_plantel."' and  puesto NOT LIKE  'INTENDENTE DE PLANTEL%' and puesto NOT LIKE 'SECRETARIA(O) DE PLANTEL%'")->result();
        $respuesta = '<option value="">SIN PROFESOR ASIGNADO</option>';
       foreach($asesores as $asesor){
        $respuesta.='<option value="'.$asesor->id_asesor.'">'.$asesor->nombre.' '.$asesor->primer_apellido.' '.$asesor->segundo_apellido.'</option>';
       }


       return $respuesta;
   }


   public function asesor_materia_grupo($grupo,$materia){
      return $this->db->query("select nombre,primer_apellido,segundo_apellido from Grupo_Estudiante as ge inner join Asesor as a on ge.id_asesor=a.id_asesor where Grupo_id_grupo='".$grupo."' and id_materia='".$materia."' limit 1")->result();
   }
}