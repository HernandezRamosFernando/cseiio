
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
      return $this->db->query("
      SELECT DISTINCT clave as id_materia,unidad_contenido from Materia as m inner join (SELECT DISTINCT
          distinct id_materia
      FROM
          Grupo_Estudiante AS ge inner join Estudiante as e on ge.Estudiante_no_control=e.no_control
      INNER JOIN Grupo AS g ON ge.Grupo_id_grupo = g.id_grupo
      WHERE
          plantel = '".$plantel."'
              AND calificacion_final < 6 and tipo_ingreso!='REPROBADO' and tipo_ingreso!='BAJA' and concat(Estudiante_no_control,id_materia) not in (
              SELECT 
                  concat (Estudiante_no_control, id_materia)
              FROM 
                  Regularizacion
              WHERE
                  Plantel_cct_plantel = '".$plantel."'
                      AND calificacion > 5)) as n on m.clave=n.id_materia")->result();
   }


   public function estudiantes_materia($plantel,$materia){

      return $this->db->query("select * from Estudiante as e inner join (SELECT 
      Estudiante_no_control
   FROM
       Grupo_Estudiante AS ge
   INNER JOIN Grupo AS g ON ge.Grupo_id_grupo = g.id_grupo
   WHERE
       plantel = '".$plantel."'
           AND calificacion_final < 6 and ge.id_materia='".$materia."' and Estudiante_no_control not in (
           SELECT 
               Estudiante_no_control
           FROM
               Regularizacion
           WHERE
               Plantel_cct_plantel = '".$plantel."'
                   AND calificacion > 5 and id_materia='".$materia."')) as n on e.no_control=n.Estudiante_no_control where tipo_ingreso!='REPROBADO' and tipo_ingreso!='BAJA'")->result();

   }

   public function estudiantes_materia_registrada_activa($plantel,$materia){

      return $this->db->query("select * from Estudiante as e inner join (SELECT 
       Estudiante_no_control,calificacion
  FROM
      Regularizacion
  WHERE
      estatus=1 and id_materia='".$materia."' and Plantel_cct_plantel='".$plantel."') as a on e.no_control=a.Estudiante_no_control")->result();

   }




   public function agregar_regularizacion($datos){
      
      $this->db->trans_start();
      $materia = "";
      $plantel = "";
      foreach($datos as $regularizacion){// para cada estudiante que presento regularizacion de esa materia
         $datos_estudiante = $this->db->query("select tipo_ingreso from Estudiante where no_control='".$regularizacion->no_control."'")->result()[0];
         $materia = $regularizacion->id_materia;
         $plantel = $regularizacion->cct_plantel;
         //selecciona el folio de el friae actual del estudiante
         $folio = $this->db->query("select max(Friae_folio) as folio from Friae_Estudiante where Estudiante_no_control='".$regularizacion->no_control."'")->result()[0]->folio;//folio del friae
         //antes de agregar una regularizacion, desactiva una regularizacion de la misma materia si es que llegara a estar activa
         $this->db->query("update Regularizacion set estatus=0 where id_materia='".$materia."' and Estudiante_no_control='".$regularizacion->no_control."' and estatus=1");


         //nos dice si el estudiante esta en grupo
         $estudiante_en_grupo = $this->db->query("select IF(count(distinct Estudiante_no_control),'si','no') as respuesta from Grupo_Estudiante as ge inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo where estatus=1 and Estudiante_no_control='".$regularizacion->no_control."'")->result()[0]->respuesta;//saber si ese estudiante esta en un grupo activo




         //inserta la regularizacion
         $this->db->query("insert into Regularizacion (Estudiante_no_control,id_materia,calificacion,fecha,fecha_calificacion,Plantel_cct_plantel,estatus) 
         values ('".$regularizacion->no_control."','".$regularizacion->id_materia."',".$regularizacion->calificacion.",'".date("Y-m-d")."','".$regularizacion->fecha_calificacion."','".$regularizacion->cct_plantel."',1)");

         if($estudiante_en_grupo=="si"){//si el estudiante esta en grupo se debe actualizar su estatus y su friae
            //si la regularizacion es en julio o enero ,es la regularizacion terminando el semestre (segunda en el friae)
         if(date("m",strtotime($regularizacion->fecha_calificacion))=="07" || date("m",strtotime($regularizacion->fecha_calificacion))=="01"){
            //se sacan las materias que el estudiante debe
            $materias_debe = $this->materias_debe_estudiante_actualmente($regularizacion->no_control);
            $materias_ids="";
            //se saca la cadena de claves de materias que debe
            foreach($materias_debe as $id){
                $materias_ids.=$id->id_materia.",";
            }

            $materias_ids = substr($materias_ids,0,-1);
            //buscamos el tipo de ingreso del estudiante
            //$datos_estudiante = $this->db->query("select tipo_ingreso from Estudiante where no_control='".$regularizacion->no_control."'")->result()[0];
            if(sizeof($materias_debe)==0){
               
               if($datos_estudiante->tipo_ingreso=="SIN DERECHO"){
                  $this->db->query("update Estudiante set tipo_ingreso='REINGRESO',estatus='REGULAR' where no_control='".$regularizacion->no_control."'");
                  $this->db->query("update Friae_Estudiante set tipo_ingreso_despues_regularizacion='REINCORPORADO', adeudos_segunda_regularizacion=".sizeof($materias_debe).", id_materia_adeudos_segunda_regularizacion='".$materias_ids."' where Estudiante_no_control='".$regularizacion->no_control."' and Friae_folio=".$folio);
               }
               else{
                  $this->db->query("update Estudiante set tipo_ingreso='REINGRESO',estatus='REGULAR' where no_control='".$regularizacion->no_control."'");
                  $this->db->query("update Friae_Estudiante set tipo_ingreso_despues_regularizacion='REINGRESO', adeudos_segunda_regularizacion=".sizeof($materias_debe).", id_materia_adeudos_segunda_regularizacion='".$materias_ids."' where Estudiante_no_control='".$regularizacion->no_control."' and Friae_folio=".$folio);
               }
               
           }

           else if(sizeof($materias_debe)>0 && sizeof($materias_debe)<=3){
               
               if($datos_estudiante->tipo_ingreso=="SIN DERECHO"){
                  $this->db->query("update Estudiante set tipo_ingreso='REINGRESO',estatus='IRREGULAR' where no_control='".$regularizacion->no_control."'");
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
               $this->db->query("update Estudiante set tipo_ingreso='REPROBADO',estatus='IRREGULAR' where no_control='".$regularizacion->no_control."'");
               $this->db->query("update Friae_Estudiante set tipo_ingreso_despues_regularizacion='REPROBADO', adeudos_segunda_regularizacion=".sizeof($materias_debe).", id_materia_adeudos_segunda_regularizacion='".$materias_ids."' where Estudiante_no_control='".$regularizacion->no_control."' and Friae_folio=".$folio);
             
           }

         }

         else if(date("m",strtotime($regularizacion->fecha_calificacion))=="05" || date("m",strtotime($regularizacion->fecha_calificacion))=="10"){//if de si son regularizaciones intermedias
            // $datos_estudiante$datos_estudiante = $this->db->query("select tipo_ingreso from Estudiante where no_control='".$regularizacion->no_control."'")->result()[0];
             //se sacan las materias que el estudiante debe
             $materias_debe = $this->materias_debe_estudiante_actualmente($regularizacion->no_control);
             $materias_ids="";
             //se saca la cadena de claves de materias que debe
             foreach($materias_debe as $id){
                 $materias_ids.=$id->id_materia.",";
             }
 
             $materias_ids = substr($materias_ids,0,-1);
             //buscamos el tipo de ingreso del estudiante
             //$datos_estudiante$datos_estudiante = $this->db->query("select tipo_ingreso from Estudiante where no_control='".$regularizacion->no_control."'")->result()[0];
             if(sizeof($materias_debe)==0){
                
                if($datos_estudiante->tipo_ingreso=="SIN DERECHO"){
                   $this->db->query("update Estudiante set tipo_ingreso='PROBABLE REINCORPORADO',estatus='REGULAR' where no_control='".$regularizacion->no_control."'");
                   $this->db->query("update Friae_Estudiante set adeudos_primera_regularizacion=".sizeof($materias_debe).", id_materia_adeudos_primera_regularizacion='".$materias_ids."' where Estudiante_no_control='".$regularizacion->no_control."' and Friae_folio=".$folio);
                }
                else{
                   $this->db->query("update Estudiante set tipo_ingreso='REINGRESO',estatus='REGULAR' where no_control='".$regularizacion->no_control."'");
                   $this->db->query("update Friae_Estudiante set adeudos_primera_regularizacion=".sizeof($materias_debe).", id_materia_adeudos_primera_regularizacion='".$materias_ids."' where Estudiante_no_control='".$regularizacion->no_control."' and Friae_folio=".$folio);
                }
                
            }
 
            else if(sizeof($materias_debe)>0 && sizeof($materias_debe)<=3){
                
                if($datos_estudiante->tipo_ingreso=="SIN DERECHO"){
                   $this->db->query("update Estudiante set tipo_ingreso='PROBABLE REINCORPORADO',estatus='IRREGULAR' where no_control='".$regularizacion->no_control."'");
                   $this->db->query("update Friae_Estudiante set adeudos_primera_regularizacion=".sizeof($materias_debe).", id_materia_adeudos_primera_regularizacion='".$materias_ids."' where Estudiante_no_control='".$regularizacion->no_control."' and Friae_folio=".$folio);
                }
                
                else{
                   $this->db->query("update Estudiante set tipo_ingreso='REINGRESO',estatus='IRREGULAR' where no_control='".$regularizacion->no_control."'");
                   $this->db->query("update Friae_Estudiante set adeudos_primera_regularizacion=".sizeof($materias_debe).", id_materia_adeudos_primera_regularizacion='".$materias_ids."' where Estudiante_no_control='".$regularizacion->no_control."' and Friae_folio=".$folio);
                }
            }
 
            else if(sizeof($materias_debe)>3 && sizeof($materias_debe)<=5){
                $this->db->query("update Estudiante set tipo_ingreso='SIN DERECHO',estatus='IRREGULAR' where no_control='".$regularizacion->no_control."'");
                $this->db->query("update Friae_Estudiante set adeudos_primera_regularizacion=".sizeof($materias_debe).", id_materia_adeudos_primera_regularizacion='".$materias_ids."' where Estudiante_no_control='".$regularizacion->no_control."' and Friae_folio=".$folio);
            }
 
            else if(sizeof($materias_debe)>5){
                $this->db->query("update Estudiante set tipo_ingreso='REPROBADO',estatus='IRREGULAR' where no_control='".$regularizacion->no_control."'");
                $this->db->query("update Friae_Estudiante set adeudos_primera_regularizacion=".sizeof($materias_debe).", id_materia_adeudos_primera_regularizacion='".$materias_ids."' where Estudiante_no_control='".$regularizacion->no_control."' and Friae_folio=".$folio);
              
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
            $this->db->query("update Estudiante set tipo_ingreso='REPROBADO',estatus='IRREGULAR' where no_control='".$regularizacion->no_control."'");
            //$this->db->query("update Friae_Estudiante set tipo_ingreso_despues_regularizacion='REPETIDOR', adeudos_segunda_regularizacion=".sizeof($materias_debe).", id_materia_adeudos_segunda_regularizacion='".$materias_ids."' where Estudiante_no_control='".$regularizacion->no_control."' and Friae_folio=".$folio);
          
        }
      }
      

      }
      //$this->db->query("SET SQL_SAFE_UPDATES = 0");
      $this->db->query("update Permiso_regularizacion set estatus=0 where id_materia='".$materia."' and Plantel_cct_plantel='".$plantel."'");
      //$this->db->query("SET SQL_SAFE_UPDATES = 1");
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


   public function obtener_calificacion_regularizacion_estudiante_materia_reciente($no_control,$materia){
      return $this->db->query("select * from Regularizacion where Estudiante_no_control='".$no_control."' and id_materia='".$materia."' and fecha_calificacion=(select max(fecha_calificacion) from Regularizacion where Estudiante_no_control='".$no_control."' and id_materia='".$materia."')")->result();
   }

   public function obtener_estudiantes_plantel_grupo_activo($plantel){
      return $this->db->query("select distinct Estudiante_no_control as no_control,tipo_ingreso from Grupo_Estudiante as ge inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo where estatus=1 and plantel = '".$plantel."'")->result();
   }



   
}