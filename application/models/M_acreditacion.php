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
    //grupos de semestres normales sin especialidad
    if($datos->grupo->semestre<5){
        $id = $datos->grupo->plantel.$datos->grupo->semestre.$datos->grupo->ciclo_escolar.$datos->grupo->periodo.mb_strtoupper($datos->grupo->nombre_grupo);
        $materias = $this->M_materia->get_materias_semestre($datos->grupo->semestre);
        $nombre_grupo=mb_strtoupper($datos->grupo->nombre_grupo);
    }

    else{
        $valor_option = $datos->grupo->componente;
        $id_componente = explode("-",$valor_option)[0];
        $nombre_corto_componente = explode("-",$valor_option)[1];
        $id = $datos->grupo->plantel.$datos->grupo->semestre.$datos->grupo->ciclo_escolar.$datos->grupo->periodo.mb_strtoupper($datos->grupo->nombre_grupo).'-'.$nombre_corto_componente;
        $materias = $this->M_materia->get_materias_semestre_componente($datos->grupo->semestre,$id_componente);
        $nombre_grupo=mb_strtoupper($datos->grupo->nombre_grupo).'-'.$nombre_corto_componente;
    }
    //$id = $datos->grupo->plantel.$datos->grupo->semestre.$datos->grupo->ciclo_escolar.mb_strtoupper($datos->grupo->nombre_grupo);
    

    $this->db->trans_start();
    $this->db->insert('Grupo',array(
        'id_grupo'=>$id,
        'semestre'=>$datos->grupo->semestre,
        'nombre_grupo'=>$nombre_grupo,
        'plantel'=>$datos->grupo->plantel
    ));
    
    

    
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

    //fin materias normales
    
    $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
                return "no";
        }

        else{
            return "si";
        }
        
        
   }


   public function agregar_estudiantes_grupo($datos){
    $this->db->trans_start();

    if($datos->semestre<5){
        $materias = $this->M_materia->get_materias_semestre($datos->semestre);
        $id_grupo=$datos->id_grupo;
    }

    else{
        $materias = $this->M_materia->get_materias_semestre_componente($datos->semestre,$datos->id_componente);
        $id_grupo=$datos->id_grupo.'-'.$datos->componente;
    }

    

    foreach(($datos->estudiantes) as $estudiante){

        foreach($materias as $materia){

            $this->db->insert('Grupo_Estudiante',array(
                'Grupo_id_grupo'=>$id_grupo,
                'Estudiante_no_control'=>$estudiante,
                'Ciclo_escolar_id_ciclo_escolar'=>$datos->ciclo_escolar,
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
