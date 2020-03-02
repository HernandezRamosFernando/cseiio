<?php
class M_baja extends CI_Model { 
   public function __construct() {
      parent::__construct();
      $this->load->model("M_reinscripcion");
   }


   public function eliminar_datos_baja($datos){
    
    $this->db->trans_start();
    $this->db->update('Baja',$datos);

    $folio = $this->db->query("select max(Friae_folio) as folio from Friae_Estudiante where Estudiante_no_control='".$estudiante->Estudiante_no_control."'")->result()[0]->folio;//folio del friae del estudiante del grupo actual

    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE)
    {
        return "no";
    }

    else{
        return "si";
    }
  
}
   public function permisos_editar_datos_baja($datos,$no_control){
    $this->db->trans_start();

    $this->db->query("update Permiso_editar_baja set estatus=0 where Estudiante_no_control='".$no_control."' and idpermiso>=0;");
    
    $this->db->insert('Permiso_editar_baja',$datos);

    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE)
    {
        return "no";
    }

    else{
        return "si";
    }
  
}


   public function busqueda_alumnos_grupo_baja_permisos($curp,$cct_plantel){
    return $this->db->query("SELECT * FROM Estudiante e inner join Grupo_Estudiante ge on e.no_control=ge.Estudiante_no_control inner join Grupo g on ge.Grupo_id_grupo=g.id_grupo inner join Baja b on b.Estudiante_no_control=e.no_control inner join Permiso_editar_baja edit_baja on edit_baja.Estudiante_no_control=e.no_control where g.estatus=1 and edit_baja.estatus=1 and tipo_ingreso='BAJA' and curp like '%".$curp."%' and curdate() between fecha_inicio and fecha_termino and Plantel_cct_plantel  like '%".$cct_plantel."%' group by e.no_control order by e.primer_apellido,e.segundo_apellido,e.nombre,e.semestre_en_curso;")->result();
}

   public function editar_datos_baja($datos,$no_control){
    $this->db->trans_start();

    $this->db->where('Estudiante_no_control',$no_control);
    $this->db->update('Baja',$datos);

    $folio = $this->db->query("select max(Friae_folio) as folio from Friae_Estudiante as a where a.Estudiante_no_control='".$no_control."'")->result()[0]->folio;
   $this->db->query("update Friae_Estudiante set baja='".$datos['fecha']."', tipo_ingreso_fin_semestre='BAJA',adeudos_fin_semestre='', id_materia_adeudos_fin_semestre='' where Estudiante_no_control='".$no_control."' and Friae_folio=".$folio);

   $materias = $this->M_reinscripcion->get_materias_cursando_estudiante_actual($no_control);//materias de cada estudiante
            foreach($materias as $materia){
    
                $this->db->query("update Grupo_Estudiante set calificacion_final=0 where id_materia='".$materia->id_materia."' and Estudiante_no_control='".$no_control."'");//agrega las calificaciones finales a cada materia
            }



    $this->db->query("update Permiso_editar_baja set estatus=0 where Estudiante_no_control='".$no_control."' and idpermiso>=0;");

    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE)
    {
        return "no";
    }

    else{
        return "si";
    }
  
}

   public function datos_alumno_baja($no_control){
    return $this->db->query("SELECT * FROM Estudiante e inner join Baja b on b.Estudiante_no_control=e.no_control where no_control='".$no_control."';")->row();
}


   public function busqueda_alumnos_grupo_baja($curp,$cct_plantel){
    return $this->db->query("SELECT * FROM Estudiante e inner join Grupo_Estudiante ge on e.no_control=ge.Estudiante_no_control inner join Grupo g on ge.Grupo_id_grupo=g.id_grupo inner join Baja b on b.Estudiante_no_control=e.no_control where g.estatus=1 and tipo_ingreso='BAJA' and curp like '%".$curp."%' and Plantel_cct_plantel like '%".$cct_plantel."%' group by e.no_control order by e.primer_apellido,e.segundo_apellido,e.nombre,e.semestre_en_curso;")->result();
}


   function baja_estudiante($no_control){
      return $this->db->query("select * from Baja 
      where 
      fecha between 
      (select fecha_inicio from Ciclo_escolar where id_ciclo_escolar=(select max(id_ciclo_escolar) from Ciclo_escolar)) 
      and 
      (select fecha_terminacion from Ciclo_escolar where id_ciclo_escolar=(select max(id_ciclo_escolar) from Ciclo_escolar))
      and Estudiante_no_control='".$no_control."'")->result();
   }


   function lista_baja_estudiante_x_plantel_ciclo($plantel,$id_ciclo){
      return $this->db->query("SELECT distinct ge.Estudiante_no_control,g.semestre,g.nombre_grupo,e.nombre,e.primer_apellido,e.segundo_apellido,b.motivo,b.fecha,b.observacion FROM Grupo_Estudiante ge inner join Grupo g on ge.Grupo_id_grupo=g.id_grupo inner join Baja b on b.Estudiante_no_control=ge.Estudiante_no_control inner join Estudiante e on e.no_control=ge.Estudiante_no_control inner join Ciclo_escolar c on ge.Ciclo_escolar_id_ciclo_escolar=c.id_ciclo_escolar where g.plantel='".$plantel."' and c.id_ciclo_escolar=".$id_ciclo." and b.fecha between c.fecha_inicio_inscripcion and c.fecha_terminacion order by g.semestre,g.nombre_grupo,e.primer_apellido,e.segundo_apellido,e.nombre;")->result();
   }


   public function busqueda_alumnos_grupo($curp,$cct_plantel){
      return $this->db->query("SELECT * FROM Estudiante e inner join Grupo_Estudiante ge on e.no_control=ge.Estudiante_no_control inner join Grupo g on ge.Grupo_id_grupo=g.id_grupo where g.estatus=1 and tipo_ingreso='BAJA' and curp like '%".$curp."%' and Plantel_cct_plantel like '%".$cct_plantel."%' group by e.no_control order by e.primer_apellido,e.segundo_apellido,e.nombre,e.semestre_en_curso;")->result();
  }

  public function agregar_permiso($respuesta,$no_control,$id_grupo,$fecha_inicio,$fecha_fin,$id_plantel){
   $this->db->trans_start();
       /*$this->db->trans_start();
           $this->db->insert('Permisos_extemporaneo', $datos);
           $this->db->trans_complete();
   
           if ($this->db->trans_status() === FALSE)
           {
               return "no";
           }
   
           else{
               return "si";
           }*/

           foreach ($respuesta as $id_materia => $variable) {

               if (is_array($variable)){

                   $primer_parcial=0;
                   $segundo_parcial=0;
                   $tercer_parcial=0;
                   $examen_final=0;
                   
                 foreach($variable as $tipo => $valorArreglo)
                   {
                          
                          if($tipo=='parcial1'){
                           $primer_parcial=1;
                          }
                          if($tipo=='parcial2'){
                           $segundo_parcial=1;
                          }
                          if($tipo=='parcial3'){
                           $tercer_parcial=1;
                          }
                          if($tipo=='examen_final'){
                           $examen_final=1;
                          }
                           

                   }
                         /*echo '</br>';
                           echo '<hr />';
                           echo '<b>'.$primer_parcial.'-</b>';
                           echo '<b>'.$segundo_parcial.'-</b>';
                           echo '<b>'.$tercer_parcial.'-</b>';
                           echo '<b>'.$examen_final.'-</b>';
                           echo '<b>'.$id_materia.'</b>';
                           echo '<hr />';*/
                           $datos = array(
                               'Estudiante_no_control' =>$no_control,
                               'primer_parcial' =>$primer_parcial,
                               'segundo_parcial' =>$segundo_parcial,
                               'tercer_parcial' =>$tercer_parcial,
                               'examen_final' =>$examen_final,
                               'fecha_inicio' =>$fecha_inicio,
                               'fecha_fin' =>$fecha_fin,
                               'id_materia' =>$id_materia,
                               'id_grupo' =>$id_grupo,
                               'estatus' =>1,
                               'Plantel_cct_plantel' =>$id_plantel
                               
                           );
                           $this->db->insert('Permisos_bajas', $datos);
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

function get_materias_por_calificar($id_grupo){
   $registros = $this->db->query("SELECT p.id_grupo,m.clave,m.unidad_contenido FROM Permisos_bajas p inner join Materia m on p.id_materia=m.clave where p.id_grupo='".$id_grupo."' and estatus=1 group by m.clave;")->result();
   return $registros;
}

function get_estudiantes_por_calificar($id_grupo,$id_materia){
   $registros = $this->db->query("SELECT *,p.primer_parcial as p1,p.segundo_parcial as p2,p.tercer_parcial as p3,p.examen_final as final FROM Permisos_bajas p inner join Estudiante e on e.no_control=p.Estudiante_no_control inner join Grupo_Estudiante ge on e.no_control=ge.Estudiante_no_control inner join Materia m on ge.id_materia=m.clave where id_grupo='".$id_grupo."' and p.estatus=1 and p.id_materia='".$id_materia."' and ge.id_materia='".$id_materia."' group by e.no_control order by primer_apellido,segundo_apellido,nombre;")->result();
   return $registros;
}

public function actualizar_calificaciones_materia_grupo($datos){
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


      // if($calificaciones_estudiante->examen_final!=null){
          if($calificaciones_estudiante->primer_parcial!=null && $calificaciones_estudiante->segundo_parcial!=null && $calificaciones_estudiante->tercer_parcial!=null){
          
           $examen_fin="/";
           if($calificaciones_estudiante->examen_final!=null){
               $examen_fin=$calificaciones_estudiante->examen_final;
           }

           $this->db->query("update Grupo_Estudiante 
           set examen_final=".($examen_fin=="/"?0:$examen_fin)." 
           where Grupo_id_grupo='".$calificaciones_estudiante->id_grupo."' and 
           Estudiante_no_control='".$calificaciones_estudiante->no_control."' and 
           id_materia='".$calificaciones_estudiante->materia."'");

          }
           
      // }
       $this->db->query("update Permisos_bajas set estatus=0 where id_materia='".$id_materia."' and id_grupo='".$id_grupo."' and Estudiante_no_control='".$calificaciones_estudiante->no_control."'");
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