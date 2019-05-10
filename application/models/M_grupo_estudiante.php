<?php
class M_grupo_estudiante extends CI_Model { 
   public function __construct() {
      parent::__construct();
      
   }



   public function agregar_calificaciones_materia_grupo($datos){
        $this->db->trans_start();

        foreach($datos as $calificaciones_estudiante){
            if($calificaciones_estudiante->primer_parcial!=null){
                $this->db->query("update Grupo_Estudiante 
                set primer_parcial=".($calificaciones_estudiante->primer_parcial=="/"?0:$calificaciones_estudiante->primer_parcial)." 
                where Grupo_id_grupo='".$calificaciones_estudiante->id_grupo."' and 
                Estudiante_no_control='".$calificaciones_estudiante->no_control."' and 
                id_materia='".$calificaciones_estudiante->materia."'");
            }

            if($calificaciones_estudiante->segundo_parcial!=null){
                $this->db->query("update Grupo_Estudiante 
                set segundo_parcial=".($calificaciones_estudiante->segundo_parcial=="/"?0:$calificaciones_estudiante->segundo_parcial)." 
                where Grupo_id_grupo='".$calificaciones_estudiante->id_grupo."' and 
                Estudiante_no_control='".$calificaciones_estudiante->no_control."' and 
                id_materia='".$calificaciones_estudiante->materia."'");
            }


            if($calificaciones_estudiante->tercer_parcial!=null){
                $this->db->query("update Grupo_Estudiante 
                set tercer_parcial=".($calificaciones_estudiante->tercer_parcial=="/"?0:$calificaciones_estudiante->tercer_parcial)." 
                where Grupo_id_grupo='".$calificaciones_estudiante->id_grupo."' and 
                Estudiante_no_control='".$calificaciones_estudiante->no_control."' and 
                id_materia='".$calificaciones_estudiante->materia."'");
            }


            if($calificaciones_estudiante->examen_final!=null){
                $this->db->query("update Grupo_Estudiante 
                set examen_final=".($calificaciones_estudiante->examen_final=="/"?0:$calificaciones_estudiante->examen_final)." 
                where Grupo_id_grupo='".$calificaciones_estudiante->id_grupo."' and 
                Estudiante_no_control='".$calificaciones_estudiante->no_control."' and 
                id_materia='".$calificaciones_estudiante->materia."'");
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
}