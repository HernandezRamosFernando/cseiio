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


   function permiso_materia_grupo($materia,$grupo){
        return sizeof($this->db->query("select * from Permiso_calificacion where id_grupo='".$grupo."' and id_materia='".$materia."' and estatus=1")->result());
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

    $materias_mostrar = array();

    return $materias;
   }


   public function get_materias_grupo_por_calificar($id_grupo){
    $semestre = $this->db->query("select semestre from Grupo where id_grupo='".$id_grupo."'")->result()[0]->semestre;
    if($semestre<5){
        $materias = $this->M_materia->get_materias_semestre_completo($semestre);
    }

    else{

        $id_componente = $this->M_componente->get_id_componente(explode('-',$id_grupo)[1]);
        $materias = $this->M_materia->get_materias_semestre_componente($semestre,$id_componente[0]->id_componente);
    }

    $materias_mostrar = array();

    $indice=0;
    foreach($materias as $materia){

        //echo $this->permiso_materia_grupo($materia->clave,$id_grupo);
        if($this->permiso_materia_grupo($materia->clave,$id_grupo)>0){
            $materias_mostrar[$indice]=$materia;
            $indice+=1;
        }
        

    }
    return $materias_mostrar;
   }


   public function get_materias_grupo_asesor($id_grupo){
   
    return $this->db->query("select * from Materia inner join (select distinct id_materia,id_asesor from Grupo_Estudiante where Grupo_id_grupo='".$id_grupo."') as asesores on id_materia=clave")->result();
   }


   public function agregar_asesor_materias($datos){
    $this->db->trans_start();

    foreach($datos as $dato){
        $this->db->query("update Grupo_Estudiante set id_asesor=".$dato->asesor." where Grupo_id_grupo='".$dato->id_grupo."' and id_materia='".$dato->id_materia."'");
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

   public function get_estudiantes_grupo_materia($id_grupo,$id_materia){
    return $this->db->query("select distinct ge.Estudiante_no_control as no_control,nombre,primer_apellido,segundo_apellido,primer_parcial,segundo_parcial,tercer_parcial,examen_final,tipo from Grupo_Estudiante as ge inner join Estudiante as e on ge.Estudiante_no_control=e.no_control inner join Materia m on ge.id_materia=m.clave  where ge.Grupo_id_grupo='".$id_grupo."' and ge.id_materia='".$id_materia."' and e.tipo_ingreso!='BAJA' order by primer_apellido,segundo_apellido,nombre")->result();
   }

   public function get_grupos_activos_plantel($plantel){
       return $this->db->query("select id_grupo from Grupo where estatus=1 and plantel='".$plantel."'")->result();
   }




   public function get_grupos_ciclo_escolar_plantel_inactivos($plantel,$ciclo){
        return $this->db->query("SELECT distinct id_grupo,semestre,nombre_grupo FROM Grupo as g inner join Grupo_Estudiante as ge on g.id_grupo=ge.Grupo_id_grupo where plantel='".$plantel."' and Ciclo_escolar_id_ciclo_escolar=".$ciclo." and g.estatus=0")->result();
    }

    public function get_grupos_ciclo_escolar_plantel_friae($plantel,$ciclo){
        return $this->db->query("SELECT distinct id_grupo,semestre,nombre_grupo FROM Grupo as g inner join Grupo_Estudiante as ge on g.id_grupo=ge.Grupo_id_grupo where plantel='".$plantel."' and Ciclo_escolar_id_ciclo_escolar=".$ciclo)->result();
    }

   public function get_num_alumnos_grupo($id_grupo){
    return $this->db->query("select count(distinct ge.Estudiante_no_control) num_alumnos from Grupo g inner join Grupo_Estudiante ge on ge.Grupo_id_grupo=g.id_grupo where g.id_grupo='".$id_grupo."'")->result();
}

public function director_plantel($grupo){
    return $this->db->query("select director from Grupo as g inner join Plantel as p on g.plantel=p.cct_plantel where g.id_grupo='20EBD0001C11BA'")->result()[0]->director;
}


}