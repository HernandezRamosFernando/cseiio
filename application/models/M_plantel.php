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

function get_planteles_sin_cerrar_calificaciones(){
   return $this->db->query("select distinct cct_plantel,nombre_plantel from Grupo_Estudiante as ge inner join (SELECT Estudiante_no_control as no_control,g.id_grupo FROM Friae_Estudiante as fe inner join Friae as f on fe.Friae_folio=f.folio inner join Grupo as g on f.id_grupo=g.id_grupo where estatus=1) as eg on ge.Estudiante_no_control=eg.no_control inner join Grupo as g on g.id_grupo=ge.Grupo_id_grupo inner join Plantel as p on p.cct_plantel=g.plantel where calificacion_final is null")->result();
}

function get_planteles_sin_examen_final(){
   return $this->db->query("select * from Grupo_Estudiante as ge inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo where estatus=1 and examen_final is null")->result();
}

function get_planteles_sin_cerrar_calificaciones_vista(){
   return $this->db->query("select distinct cct_plantel,nombre_plantel from Grupo_Estudiante as ge inner join (SELECT Estudiante_no_control as no_control,g.id_grupo FROM Friae_Estudiante as fe inner join Friae as f on fe.Friae_folio=f.folio inner join Grupo as g on f.id_grupo=g.id_grupo where estatus=1) as eg on ge.Estudiante_no_control=eg.no_control inner join Grupo as g on g.id_grupo=ge.Grupo_id_grupo inner join Plantel as p on p.cct_plantel=g.plantel where calificacion_final ")->result();
}

/////---------------------------------------------------------------------------------------------------------
function get_lista_planteles_especialidad_traslado_html($no_control,$semestre,$id_componente){

   if(intval($semestre)==5){ 
            if($id_componente!=""){
               $planteles = $this->db->query("SELECT * FROM Plantel p inner join Plantel_componente pc on p.cct_plantel=pc.Plantel_cct inner join Componente c on pc.Componente_id_componente=c.id_componente where c.nombre_corto='".$id_componente."';")->result();
            }
            else{
               $planteles = $this->db->query("SELECT * FROM Plantel p")->result();
            }
   }

   if(intval($semestre)==6){
      if($id_componente!=""){
         $planteles = $this->db->query("SELECT * FROM Plantel p inner join Plantel_componente pc on p.cct_plantel=pc.Plantel_cct inner join Componente c on pc.Componente_id_componente=c.id_componente where c.nombre_corto='".$id_componente."';")->result();
      }
      else{
         $datos_quinto=$this->db->query("select distinct g.nombre_grupo from Grupo g inner join Grupo_Estudiante ge on g.id_grupo=ge.Grupo_id_grupo where ge.Estudiante_no_control='".$no_control."' and g.semestre=5;")->result()[0]->nombre_grupo;
         $dividir = explode("-", $datos_quinto);
         $id_componente=$dividir[1]; // porción1

         $planteles = $this->db->query("SELECT * FROM Plantel p inner join Plantel_componente pc on p.cct_plantel=pc.Plantel_cct inner join Componente c on pc.Componente_id_componente=c.id_componente where c.nombre_corto='".$id_componente."';")->result();
      }
   }
   
   $respuesta="";
   $respuesta.='<option value="">Seleccione el plantel a trasladar</option>';

   foreach($planteles as $plantel){
      $respuesta.='<option value="'.$plantel->cct_plantel.'">'.$plantel->nombre_plantel.' ----- CCT:'.$plantel->cct_plantel.'</option>';
   }

   return $respuesta;
}






}
