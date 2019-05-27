<?php
class M_grupo_estudiante extends CI_Model { 
   public function __construct() {
      parent::__construct();
      
   }



   public function agregar_calificaciones_materia_grupo($datos){
        $this->db->trans_start();
        foreach($datos as $calificaciones_estudiante){
            $id_grupo = $calificaciones_estudiante->id_grupo;
            $id_materia = $calificaciones_estudiante->materia;
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


        $this->db->query("update Permiso_calificacion set estatus=0 where id_grupo='".$id_grupo."' and id_materia='".$id_materia."'");

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
               return "no";
        }

        else{
            return "si";
        }

   }


   public function get_materias_reprobadas_estudiante_semestres_pasados($no_control){
        return $this->db->query("SELECT id_materia,calificacion_final FROM Grupo as g inner join Grupo_Estudiante as ge on g.id_grupo=ge.Grupo_id_grupo where Estudiante_no_control='".$no_control."' estatus=0 and calificacion_final<6")->result();
   }
}