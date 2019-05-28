<?php
class M_regularizacion extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }


   public function get_materias_pasadas_estudiante($no_control){
      return $this->db->query("select id_materia,calificacion from Regularizacion where calificacion>=6 and Estudiante_no_control='".$no_control."'")->result();
   }


   public function get_materias_adeudo_estudiantes(){
      $this->db->query("select * from Grupo_Estudiante where calificacion_final<6 and id_materia not in(select id_materia from Regularizacion where calificacion>=6)");
   }

   public function get_materias_adeudo_estudiante($no_control){
      $this->db->query("select * from Grupo_Estudiante where calificacion_final<6 and id_materia not in(select id_materia from Regularizacion where calificacion>=6 and Estudiante_no_control='".$no_control."')");
   }

   public function materias_con_reprobados_html($plantel){
      return $this->db->query("SELECT 
      distinct ge.id_materia,g.plantel,m.unidad_contenido
   FROM
       Grupo_Estudiante AS ge
   INNER JOIN Materia AS m ON ge.id_materia = m.clave INNER JOIN Grupo as g on g.id_grupo=ge.Grupo_id_grupo INNER JOIN Estudiante as e on e.no_control=ge.Estudiante_no_control
   WHERE
       calificacion_final < 6 and plantel='".$plantel."'
     AND id_materia NOT IN (SELECT 
               id_materia
           FROM
               Regularizacion
           WHERE
               calificacion >= 6) and (e.estatus='IRREGULAR' or e.estatus='SIN DERECHO' or e.estatus='INCORPORADO')")->result();
   }


   public function estudiantes_materia($plantel,$materia){

      return $this->db->query("SELECT 
      ge.Estudiante_no_control,ge.id_materia,m.semestre,e.semestre_en_curso,e.nombre,e.primer_apellido,e.segundo_apellido
       FROM
           Grupo_Estudiante AS ge
       INNER JOIN Materia AS m ON ge.id_materia = m.clave INNER JOIN Grupo as g on g.id_grupo=ge.Grupo_id_grupo INNER JOIN Estudiante as e on e.no_control=ge.Estudiante_no_control
       WHERE
           calificacion_final < 6 and plantel='".$plantel."'
         AND id_materia NOT IN (SELECT 
                   id_materia
               FROM
                   Regularizacion
               WHERE
                   calificacion >= 6) and id_materia='".$materia."' and (e.estatus='IRREGULAR' or e.estatus='SIN DERECHO' or e.estatus='INCORPORADO')")->result();

   }



   public function agregar_regularizacion($datos){
      
      $this->db->trans_start();
      foreach($datos as $regularizacion){
         $folio = $this->db->query("select max(Friae_folio) as folio from Friae_Estudiante where Estudiante_no_control='".$regularizacion->no_control."'")->result()[0]->folio;
         $estudiante_en_grupo = $this->db->query("select IF(count(distinct Estudiante_no_control),'si','no') as respuesta from Grupo_Estudiante as ge inner join Grupo as g where estatus=1 and Estudiante_no_control='".$regularizacion->no_control."'")->result()[0]->respuesta;
         $this->db->query("insert into Regularizacion (Estudiante_no_control,id_materia,calificacion,fecha,fecha_calificacion) 
         values ('".$regularizacion->no_control."','".$regularizacion->id_materia."',".$regularizacion->calificacion.",'".date("Y-m-d")."','".$regularizacion->fecha_calificacion."')");

         if($estudiante_en_grupo=="si"){
         if(date("m")=="07" || date("m")=="01"){
            $materias_debe = $this->materias_debe_estudiante_actualmente($regularizacion->no_control);
            $materias_ids="";
            foreach($materias_debe as $id){
                $materias_ids.=$id->id_materia.",";
            }

            $materias_ids = substr($materias_ids,0,-1);
            $datos_estudiante = $this->db->query("select tipo_ingreso from Estudiante where no_control='".$regularizacion->no_control."'")->result()[0];
            if(sizeof($materias_debe)==0){
               
               if($datos_estudiante->tipo_ingreso=="SIN DERECHO"){
                  $this->db->query("update Estudiante set tipo_ingreso='PROBABLE REINCORPORADO',estatus='REGULAR' where no_control='".$regularizacion->no_control."'");
                  $this->db->query("update Friae_Estudiante set tipo_ingreso_despues_regularizacion='REINCORPORADO', adeudos_segunda_regularizacion=".sizeof($materias_debe).", id_materia_adeudos_segunda_regularizacion='".$materias_ids."' where Estudiante_no_control='".$regularizacion->no_control."' and Friae_folio=".$folio);
               }
               else{
                  $this->db->query("update Estudiante set tipo_ingreso='REINGRESO',estatus='REGULAR' where no_control='".$regularizacion->no_control."'");
                  $this->db->query("update Friae_Estudiante set tipo_ingreso_despues_regularizacion='REINGRESO', adeudos_segunda_regularizacion=".sizeof($materias_debe).", id_materia_adeudos_segunda_regularizacion='".$materias_ids."' where Estudiante_no_control='".$regularizacion->no_control."' and Friae_folio=".$folio);
               }
               
           }

           else if(sizeof($materias_debe)>0 && sizeof($materias_debe)<=3){
               
               if($datos_estudiante->tipo_ingreso=="SIN DERECHO"){
                  $this->db->query("update Estudiante set tipo_ingreso='PROBABLE REINCORPORADO',estatus='IRREGULAR' where no_control='".$regularizacion->no_control."'");
                  $this->db->query("update Friae_Estudiante set tipo_ingreso_despues_regularizacion='REINCORPORADO', adeudos_segunda_regularizacion=".sizeof($materias_debe).", id_materia_adeudos_segunda_regularizacion='".$materias_ids."' where Estudiante_no_control='".$regularizacion->no_control."' and Friae_folio=".$folio);
               }
               
               else{
                  $this->db->query("update Estudiante set tipo_ingreso='REINGRESO',estatus='IRREGULAR' where no_control='".$regularizacion->no_control."'");
                  $this->db->query("update Friae_Estudiante set tipo_ingreso_despues_regularizacion='REINGRESO', adeudos_segunda_regularizacion=".sizeof($materias_debe).", id_materia_adeudos_segunda_regularizacion='".$materias_ids."' where Estudiante_no_control='".$regularizacion->no_control."' and Friae_folio=".$folio);
               }
           }

           else if(sizeof($materias_debe)>3 && sizeof($materias_debe)<=5){
               $this->db->query("update Estudiante set tipo_ingreso='SIN DERECHO',estatus='IRREGULAR' where no_control='".$regularizacion->no_control."'");
               $this->db->query("update Friae_Estudiante set tipo_ingreso_despues_regularizacion='SIN DERECHO', adeudos_segunda_regularizacion=".sizeof($materias_debe).", id_materia_adeudos_segunda_regularizacion='".$materias_ids."' where Estudiante_no_control='".$regularizacion->no_control."' and Friae_folio=".$folio);
           }

           else if(sizeof($materias_debe)>5){
               $this->db->query("update Estudiante set tipo_ingreso='REPETIDOR',estatus='IRREGULAR' where no_control='".$regularizacion->no_control."'");
               $this->db->query("update Friae_Estudiante set tipo_ingreso_despues_regularizacion='REPETIDOR', adeudos_segunda_regularizacion=".sizeof($materias_debe).", id_materia_adeudos_segunda_regularizacion='".$materias_ids."' where Estudiante_no_control='".$regularizacion->no_control."' and Friae_folio=".$folio);
             
           }

         }
      }//cierre if si tiene grupo





      else{//si no tiene grupo
         $materias_debe = $this->materias_debe_estudiante_actualmente($regularizacion->no_control);
         if(sizeof($materias_debe)==0){
               
            if($datos_estudiante->tipo_ingreso=="SIN DERECHO"){
               $this->db->query("update Estudiante set tipo_ingreso='PROBABLE REINCORPORADO',estatus='REGULAR' where no_control='".$regularizacion->no_control."'");
               //$this->db->query("update Friae_Estudiante set tipo_ingreso_despues_regularizacion='REINCORPORADO', adeudos_segunda_regularizacion=".sizeof($materias_debe).", id_materia_adeudos_segunda_regularizacion='".$materias_ids."' where Estudiante_no_control='".$regularizacion->no_control."' and Friae_folio=".$folio);
            }
            else{
               $this->db->query("update Estudiante set tipo_ingreso='PROBABLE REINCORPORADO',estatus='REGULAR' where no_control='".$regularizacion->no_control."'");
               //$this->db->query("update Friae_Estudiante set tipo_ingreso_despues_regularizacion='NUEVO_INGRESO', adeudos_segunda_regularizacion=".sizeof($materias_debe).", id_materia_adeudos_segunda_regularizacion='".$materias_ids."' where Estudiante_no_control='".$regularizacion->no_control."' and Friae_folio=".$folio);
            }
            
        }

        else if(sizeof($materias_debe)>0 && sizeof($materias_debe)<=3){
            
            if($datos_estudiante->tipo_ingreso=="SIN DERECHO"){
               $this->db->query("update Estudiante set tipo_ingreso='PROBABLE REINCORPORADO',estatus='IRREGULAR' where no_control='".$regularizacion->no_control."'");
               //$this->db->query("update Friae_Estudiante set tipo_ingreso_despues_regularizacion='REINCORPORADO', adeudos_segunda_regularizacion=".sizeof($materias_debe).", id_materia_adeudos_segunda_regularizacion='".$materias_ids."' where Estudiante_no_control='".$regularizacion->no_control."' and Friae_folio=".$folio);
            }
            
            else{
               $this->db->query("update Estudiante set tipo_ingreso='PROBABLE REINCORPORADO',estatus='IRREGULAR' where no_control='".$regularizacion->no_control."'");
               //$this->db->query("update Friae_Estudiante set tipo_ingreso_despues_regularizacion='NUEVO INGRESO', adeudos_segunda_regularizacion=".sizeof($materias_debe).", id_materia_adeudos_segunda_regularizacion='".$materias_ids."' where Estudiante_no_control='".$regularizacion->no_control."' and Friae_folio=".$folio);
            }
        }

        else if(sizeof($materias_debe)>3 && sizeof($materias_debe)<=5){
            $this->db->query("update Estudiante set tipo_ingreso='SIN DERECHO',estatus='IRREGULAR' where no_control='".$regularizacion->no_control."'");
            //$this->db->query("update Friae_Estudiante set tipo_ingreso_despues_regularizacion='SIN DERECHO', adeudos_segunda_regularizacion=".sizeof($materias_debe).", id_materia_adeudos_segunda_regularizacion='".$materias_ids."' where Estudiante_no_control='".$regularizacion->no_control."' and Friae_folio=".$folio);
        }

        else if(sizeof($materias_debe)>5){
            $this->db->query("update Estudiante set tipo_ingreso='REPETIDOR',estatus='IRREGULAR' where no_control='".$regularizacion->no_control."'");
            //$this->db->query("update Friae_Estudiante set tipo_ingreso_despues_regularizacion='REPETIDOR', adeudos_segunda_regularizacion=".sizeof($materias_debe).", id_materia_adeudos_segunda_regularizacion='".$materias_ids."' where Estudiante_no_control='".$regularizacion->no_control."' and Friae_folio=".$folio);
          
        }
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



   public function materias_debe_estudiante_actualmente($no_control){
        return $this->db->query("select id_materia from Grupo_Estudiante where calificacion_final<6 and Estudiante_no_control='".$no_control."' and id_materia not in (select id_materia from Regularizacion where calificacion>=6 and Estudiante_no_control='".$no_control."')")->result();
   }
}