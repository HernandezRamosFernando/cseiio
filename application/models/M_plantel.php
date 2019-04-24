<?php
class M_plantel extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }



   function get_planteles(){
        return $this->db->get('Plantel')->result();
   }

   function get_plantel($plantel){
      return $this->db->get_where('Plantel',array('cct'=>$plantel))->result();
   }

   function get_plantel_especialidad($plantel){
      return $this->db->query("SELECT c.id_componente,c.nombre FROM Plantel_Componente as pc inner join Componente as c on pc.Componente_id_componente=c.id_componente  where pc.Componente_id_componente>1  and pc.Plantel_cct='".$plantel."'")->result();
   }

   function get_plantel_especialidad_html($plantel){
      $registros = $this->db->query("SELECT c.id_componente,c.nombre FROM Plantel_Componente as pc inner join Componente as c on pc.Componente_id_componente=c.id_componente  where pc.Componente_id_componente>1  and pc.Plantel_cct='".$plantel."'")->result();
      $respuesta = "";
      foreach($registros as $registro){
         $respuesta.='<option value="'.$registro->id_componente.'">'.$registro->nombre.'</option>';
      }
      return $respuesta;
   }

}
