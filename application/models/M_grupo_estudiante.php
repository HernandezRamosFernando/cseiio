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


   public function calificaciones_grupo_materia($grupo,$materia){
        return $this->db->query();
    }

    public function nombres_estudiantes_grupo_materia($grupo,$materia){
        return $this->db->query("select nombre,primer_apellido,segundo_apellido from Grupo_Estudiante as ge inner join Estudiante as e on ge.Estudiante_no_control=e.no_control where Grupo_id_grupo='".$grupo."' and id_materia='".$materia."' order by primer_apellido,segundo_apellido,nombre")->result();
    }

    public function datos_estudiantes_grupo_materia($grupo,$materia){
        return $this->db->query("select * from Grupo_Estudiante as ge inner join Estudiante as e on ge.Estudiante_no_control=e.no_control where Grupo_id_grupo='".$grupo."' and id_materia='".$materia."' order by primer_apellido,segundo_apellido,nombre")->result();
    }

    public function plantel_grupo($grupo){
        return $this->db->query("select director,nombre_plantel,cct_plantel,concat(nombre_localidad,',',nombre_municipio) as localidad_municipio from Grupo as g inner join Plantel as p on g.plantel=p.cct_plantel inner join Localidad as l on p.id_localidad_plantel=l.id_localidad inner join Municipio as m on l.Municipio_id_municipio=m.id_municipio where id_grupo='".$grupo."'")->result()[0];
    }

    public function datos_materia_grupo($materia,$grupo){
        return $this->db->query("select unidad_contenido,clave,nombre_grupo,g.semestre,periodo,nombre_ciclo_escolar,a.nombre,a.primer_apellido,a.segundo_apellido,if(periodo='AGOSTO-ENERO','B','A') as tipo_semestre from Grupo_Estudiante as ge inner join Ciclo_escolar as ce on ge.Ciclo_escolar_id_ciclo_escolar=ce.id_ciclo_escolar inner join Materia as m on m.clave=ge.id_materia inner join Asesor as a on a.id_asesor=if(ge.id_asesor='',964,ge.id_asesor) inner join Grupo as g on g.id_grupo=ge.Grupo_id_grupo where ge.Grupo_id_grupo='".$grupo."' and id_materia='".$materia."' limit 1")->result()[0];
    }


    //------------------------------------------------------------------------------------------------------------------------------
    public function get_datos_grupo_estudiante_asesor($id_grupo,$id_materia){
        return $this->db->query("SELECT distinct g.id_grupo,g.nombre_grupo,a.nombre,a.primer_apellido,a.segundo_apellido,m.unidad_contenido FROM Grupo g inner join Grupo_Estudiante ge on g.id_grupo=ge.Grupo_id_grupo left join Asesor a on ge.id_asesor=a.id_asesor inner join Materia m on ge.id_materia=m.clave where g.id_grupo='".$id_grupo."' and m.clave='".$id_materia."';")->result();
    }

    public function existe_grupo_ciclo_escolar_estudiante($no_control,$id_ciclo,$semestre){
        return $this->db->query("SELECT count(*) resultado from Grupo_Estudiante ge inner join Grupo g on ge.Grupo_id_grupo=g.id_grupo where ge.Estudiante_no_control='".$no_control."' and ge.Ciclo_escolar_id_ciclo_escolar=".$id_ciclo." and g.semestre=".$semestre)->result();
   }

   public function lista_asistencia_x_grupo($grupo,$materia){
    return $this->db->query("select nombre,primer_apellido,segundo_apellido from Grupo_Estudiante as ge inner join Estudiante as e on ge.Estudiante_no_control=e.no_control where Grupo_id_grupo='".$grupo."' and id_materia='".$materia."' order by nombre,primer_apellido,segundo_apellido")->result();
}
}