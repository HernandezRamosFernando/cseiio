<?php
class M_acreditacion extends CI_Model { 
   public function __construct() {
      parent::__construct();
      $this->load->model('M_materia');
   }


   function numero_estudiantes_semestre_plantel($datos){
       return $this->db->query("select count(*) as total_estudiante from Estudiante where semestre_en_curso=".$datos['semestre']." and Plantel_cct_plantel='".$datos['cct']."'")->result();
   }

   



   function agregar_grupo($datos){
       //return $datos->grupo->plantel;
    
    $this->db->trans_start();
    $this->db->insert('Grupo',array(
        'semestre'=>$datos->grupo->semestre,
        'nombre_grupo'=>mb_strtoupper($datos->grupo->nombre_grupo),
        'plantel'=>$datos->grupo->plantel
    ));
    
    $id = $this->db->insert_id();
    $materias = $this->M_materia->get_materias_semestre($datos->grupo->semestre);

    
    foreach(($datos->alumnos) as $alumno){

        foreach($materias as $materia){

            $this->db->insert('Grupo_Estudiante',array(
                'Grupo_id_grupo'=>$id,
                'Estudiante_no_control'=>$alumno,
                'Ciclo_escolar_id_ciclo_escolar'=>$datos->grupo->ciclo_escolar,
                'id_materia'=>$materia->clave,

            ));

        }
       
    }
    
    $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
                return "no";
        }

        else{
            return "si";
        }
        
        
   }




   public function get_estudiantes_plantel_semestre($plantel,$semestre){
       return $this->db->query("select * from Estudiante where semestre=".$semestre." and Plantel_cct_plantel='".$plantel."' and no_control not in (select distinct Estudiante_no_control from Grupo_Estudiante)")->result(); 
   }
}
