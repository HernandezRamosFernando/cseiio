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
    $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
                return "algo salio mal";
        }

        else{
            return "si";
        }
        
   }
}
