<?php
class M_plantel extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }



   function get_planteles(){
        return $this->db->get('Plantel')->result();
   }

   function get_plantel($plantel){
      return $this->db->get_where('Plantel',array('cct_plantel'=>$plantel))->result();
   }

   function get_plantel_especialidad($plantel){
      return $this->db->query("SELECT c.id_componente,c.nombre FROM Plantel_Componente as pc inner join Componente as c on pc.Componente_id_componente=c.id_componente  where pc.Componente_id_componente>1  and pc.Plantel_cct='".$plantel."'")->result();
   }

   function get_plantel_especialidad_html($plantel){
      $registros = $this->db->query("SELECT c.id_componente,c.nombre,c.nombre_corto FROM Plantel_Componente as pc inner join Componente as c on pc.Componente_id_componente=c.id_componente  where pc.Componente_id_componente>1  and pc.Plantel_cct='".$plantel."'")->result();
      $respuesta = "";
      $respuesta.='<option value="'."".'">'."Seleccione una especialidad".'</option>';
      foreach($registros as $registro){
         $respuesta.='<option value="'.$registro->id_componente.'-'.$registro->nombre_corto.'">'.$registro->nombre.'</option>';
      }
      return $respuesta;
   }


   function get_grupos_plantel_html($plantel,$semestre){
         $grupos = $this->db->query("select * from Grupo where semestre=".$semestre." and plantel='".$plantel."' and estatus=1")->result();
         $respuesta="";

         foreach($grupos as $grupo){
            $respuesta.='<option value="'.$grupo->id_grupo.'">'.$grupo->semestre.' '.$grupo->nombre_grupo.'</option>';
         }

         return $respuesta;
   }

   function get_grupos_plantel_htmloption($plantel,$semestre){
      $grupos = $this->db->query("select * from Grupo where semestre=".$semestre." and plantel='".$plantel."'and estatus=1")->result();
      $respuesta="";
      $respuesta.='<option value="'."".'">'."Seleccione un grupo".'</option>';

      foreach($grupos as $grupo){
         $respuesta.='<option value="'.$grupo->id_grupo.'">'.$grupo->semestre.' '.$grupo->nombre_grupo.'</option>';
      }

      return $respuesta;
}
function get_nombre_localidad($plantel){
        
   return $this->db->query("SELECT nombre_localidad FROM Plantel p inner join Localidad l on p.id_localidad_plantel=l.id_localidad where p.cct_plantel='".$plantel."'")->result();
}

}
