<?php
class M_grupo extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }


   public function get_existe_grupo($id_grupo){
        return $this->db->query("select count(Estudiante_no_control) as total_alumnos,Grupo_id_grupo as id_grupo from (select Estudiante_no_control,Grupo_id_grupo from Grupo_Estudiante where Grupo_id_grupo='".$id_grupo."' group by Estudiante_no_control) as grupo group by Grupo_id_grupo")->result();
   }

   public function get_estudiantes_grupo($id_grupo){
        return $this->db->query("SELECT 
        nombre,primer_apellido,segundo_apellido,no_control,sexo
    FROM
        Estudiante
            INNER JOIN
        (SELECT 
            Estudiante_no_control
        FROM
            Grupo_Estudiante
        WHERE
            Grupo_id_grupo = '".$id_grupo."'
        GROUP BY Estudiante_no_control) AS e ON Estudiante.no_control = e.Estudiante_no_control")->result();
   }



   public function delete_estudiantes_grupo($datos){
       
    $this->db->trans_start();
    foreach($datos->eliminados as $alumno){
        $this->db->query("delete from Grupo_Estudiante where Grupo_id_grupo='".$datos->id_grupo."' and Estudiante_no_control='".$alumno."'");
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