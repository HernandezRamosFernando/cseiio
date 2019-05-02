<?php
class M_grupo extends CI_Model { 
   public function __construct() {
      parent::__construct();
      $this->load->model("M_materia");
      $this->load->model("M_componente");
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




   public function get_id_ciclo_grupo($id_grupo){
       return $this->db->query("select Ciclo_escolar_id_ciclo_escolar from Grupo_Estudiante where Grupo_id_grupo='".$id_grupo."' limit 1")->result();
   }


   public function delete_grupo($id_grupo){
    $this->db->trans_start();
        $this->db->query("delete from Grupo where id_grupo='".$id_grupo."'");
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
           return "no";
        }

        else{
            return "si";
        }
   }



   public function get_materias_grupo($id_grupo){
    $semestre = $this->db->query("select semestre from Grupo where id_grupo='".$id_grupo."'")->result()[0]->semestre;
    if($semestre<5){
        $materias = $this->M_materia->get_materias_semestre_completo($semestre);
    }

    else{

        $id_componente = $this->M_componente->get_id_componente(explode('-',$id_grupo)[1]);
        $materias = $this->M_materia->get_materias_semestre_componente($semestre,$id_componente[0]->id_componente);
    }
    return $materias;
   }


   public function agregar_asesor_materias($datos){
    $this->db->trans_start();

    foreach($datos as $dato){
        $this->db->query("update Grupo_Estudiante set asesor='".$dato->asesor."' where Grupo_id_grupo='".$dato->id_grupo."' and id_materia='".$dato->id_materia."'");
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