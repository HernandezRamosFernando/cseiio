<?php
class M_acreditacion extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }


   function numero_estudiantes_semestre_plantel($datos){
       return $this->db->query("select count(*) as total_estudiante from Estudiante where semestre_en_curso=".$datos['semestre']." and Plantel_cct_plantel='".$datos['cct']."'")->result();
   }

   



   function agregar_grupo($datos){
    
    $this->db->trans_start();
    $this->db->insert('Grupo',$datos);
    $id = $this->db->insert_id();
    $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
                return "no";
        }

        else{
            return $id;
        }
        
   }




   public function get_estudiantes_plantel_semestre($plantel,$semestre){
       return $this->db->query("select * from Estudiante where semestre=".$semestre." and Plantel_cct_plantel='".$plantel."' and no_control not in (select distinct Estudiante_no_control from Grupo_Estudiante)")->result(); 
   }
}
