<?php
class M_nulidad_semestre extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }

   public function materias_debe_estudiante_actualmente($no_control){
    return $this->db->query("select id_materia from Grupo_Estudiante where calificacion_final<6 and Estudiante_no_control='".$no_control."' and id_materia not in (select id_materia from Regularizacion where calificacion>=6 and Estudiante_no_control='".$no_control."')")->result();
}



   function nulidad_semestre_estudiante($no_control,$semestre_hasta_el_que_anula){
    $this->db->trans_start();
    $estudiante = $this->db->query("select * from Estudiante where no_control='".$no_control."'")->result()[0];



        //grupo y semestre de los grupos cursados
        $grupo_semestre_cursados = $this->db->query("select distinct Grupo_id_grupo as grupo,semestre from Grupo_Estudiante as ge inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo where Estudiante_no_control='".$no_control."' order by semestre asc")->result();
        //actualizar el semestre en curso del estudinate por el del smeestre hasta el que anulo
        $this->db->query("update Estudiante set semestre_en_curso=".$semestre_hasta_el_que_anula." where no_control='".$no_control."'");

        foreach($grupo_semestre_cursados as $grupo_semestre){
            if(intval($grupo_semestre->semestre) >= intval($semestre_hasta_el_que_anula)){
                $this->db->query("update Grupo_Estudiante set calificacion_final=null where Grupo_id_grupo='".$grupo_semestre->grupo."'");
            }
        }

        $materias_debe = $this->materias_debe_estudiante_actualmente($no_control);

        if(sizeof($materias_debe)==0){
            //reingreso regular
            $this->db->query("update Estudiante set estatus='REGULAR' where no_control='".$no_control."'");
        }

        else{
            //reingreso irregular
            $this->db->query("update Estudiante set estatus='IRREGULAR' where no_control='".$no_control."'");
        }

        if(intval($semestre_hasta_el_que_anula)==1){
            $this->db->query("update Estudiante set semestre=1 where no_control='".$no_control."'");
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
}