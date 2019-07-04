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
}