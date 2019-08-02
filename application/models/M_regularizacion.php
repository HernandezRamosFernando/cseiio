
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

   public function materias_con_reprobados_html($plantel,$semestre){
      return $this->db->query("select distinct clave as id_materia,unidad_contenido from Materia as m inner join (select distinct id_materia from (select Estudiante_no_control,id_materia from Grupo_Estudiante as ge 
      inner join 
      Grupo as g on ge.Grupo_id_grupo=g.id_grupo
      inner join Estudiante as e on ge.Estudiante_no_control=e.no_control
      where Plantel_cct_plantel='".$plantel."' and calificacion_final<6 and (tipo_ingreso!='REPROBADO' and tipo_ingreso!='BAJA')
      union
      select Estudiante_no_control,Materia_id_materia as id_materia from Portabilidad_adeudos as pa 
      inner join 
      Estudiante as e on pa.Estudiante_no_control=e.no_control
      where e.Plantel_cct_plantel='".$plantel."' and calificacion<6 and (tipo_ingreso!='REPROBADO' and tipo_ingreso!='BAJA')) 
      as a where concat(a.Estudiante_no_control,a.id_materia) 
      not in 
      (select concat(Estudiante_no_control,id_materia) 
      from Regularizacion 
      where calificacion>=6 and Plantel_cct_plantel='".$plantel."' and estatus!=2)) as reprobadas 
      on m.clave=reprobadas.id_materia where m.semestre=".$semestre)->result();
   }


   public function materias_con_reprobados_html_regularizacion($plantel){
    return $this->db->query("select distinct clave as id_materia,unidad_contenido from Materia as m inner join (select distinct id_materia from (select Estudiante_no_control,id_materia from Grupo_Estudiante as ge 
    inner join 
    Grupo as g on ge.Grupo_id_grupo=g.id_grupo
    inner join Estudiante as e on ge.Estudiante_no_control=e.no_control
    where Plantel_cct_plantel='".$plantel."' and calificacion_final<6 and (tipo_ingreso!='REPROBADO' and tipo_ingreso!='BAJA')
    union
    select Estudiante_no_control,Materia_id_materia as id_materia from Portabilidad_adeudos as pa 
    inner join 
    Estudiante as e on pa.Estudiante_no_control=e.no_control
    where e.Plantel_cct_plantel='".$plantel."' and calificacion<6 and (tipo_ingreso!='REPROBADO' and tipo_ingreso!='BAJA')) 
    as a where concat(a.Estudiante_no_control,a.id_materia) 
    not in 
    (select concat(Estudiante_no_control,id_materia) 
    from Regularizacion 
    where calificacion>=6 and Plantel_cct_plantel='".$plantel."' and estatus!=2)) as reprobadas 
    on m.clave=reprobadas.id_materia")->result();
 }

   public function semetres_con_reprobados_html($plantel){
      return $this->db->query("select distinct semestre from Materia as m inner join (select distinct id_materia from (select Estudiante_no_control,id_materia from Grupo_Estudiante as ge 
      inner join 
      Grupo as g on ge.Grupo_id_grupo=g.id_grupo
      inner join Estudiante as e on ge.Estudiante_no_control=e.no_control
      where Plantel_cct_plantel='".$plantel."' and calificacion_final<6 and (tipo_ingreso!='REPROBADO' and tipo_ingreso!='BAJA')
      union
      select Estudiante_no_control,Materia_id_materia as id_materia from Portabilidad_adeudos as pa 
      inner join 
      Estudiante as e on pa.Estudiante_no_control=e.no_control
      where e.Plantel_cct_plantel='".$plantel."' and calificacion<6 and (tipo_ingreso!='REPROBADO' and tipo_ingreso!='BAJA')) 
      as a where concat(a.Estudiante_no_control,a.id_materia) 
      not in 
      (select concat(Estudiante_no_control,id_materia) 
      from Regularizacion 
      where calificacion>=6 and Plantel_cct_plantel='".$plantel." and estatus!=2')) as reprobadas 
      on m.clave=reprobadas.id_materia")->result();
   }


   public function estudiantes_materia($plantel,$materia){

      return $this->db->query("select distinct id_materia,Estudiante_no_control as no_control,m.semestre as semestre_materia,nombre,primer_apellido,segundo_apellido,matricula,semestre_en_curso from (select * from (select Estudiante_no_control,id_materia from Grupo_Estudiante as ge 
      inner join 
      Grupo as g on ge.Grupo_id_grupo=g.id_grupo
      inner join Estudiante as e on ge.Estudiante_no_control=e.no_control
      where Plantel_cct_plantel='".$plantel."' and calificacion_final<6 and (tipo_ingreso!='REPROBADO' and tipo_ingreso!='BAJA')
      union
      select Estudiante_no_control,Materia_id_materia as id_materia from Portabilidad_adeudos as pa 
      inner join 
      Estudiante as e on pa.Estudiante_no_control=e.no_control
      where e.Plantel_cct_plantel='".$plantel."' and calificacion<6 and (tipo_ingreso!='REPROBADO' and tipo_ingreso!='BAJA')) 
      as a where concat(a.Estudiante_no_control,a.id_materia) 
      not in 
      (select concat(Estudiante_no_control,id_materia) 
      from Regularizacion 
      where calificacion>=6 and Plantel_cct_plantel='".$plantel."' and estatus!=2)) 
      as estudiante_materia 
      inner join Materia as m on estudiante_materia.id_materia=m.clave
      inner join Estudiante as e on estudiante_materia.Estudiante_no_control=e.no_control
      where id_materia='".$materia."'
      ")->result();

   }

   public function estudiantes_materia_registrada_activa($plantel,$materia){

      return $this->db->query("select * from Estudiante as e inner join (SELECT 
       Estudiante_no_control,calificacion
  FROM
      Regularizacion
  WHERE
      estatus=1 and id_materia='".$materia."' and Plantel_cct_plantel='".$plantel."') as a on e.no_control=a.Estudiante_no_control")->result();

   }

   //regresa solo no control y semestre
   public function regularizaciones_plantel_periodo_sin_grupo($plantel,$mes,$ano){
      //echo $mes;
      return $this->db->query("select datos.no_control,datos.semestre_en_curso,datos.ultimo_semestre_cursado from Estudiante as e inner join (select distinct no_control,semestre_en_curso,(select concat(semestre,nombre_grupo) from Grupo_Estudiante as ge inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo where Estudiante_no_control=no_control and semestre=(select max(semestre) as semestre from Grupo_Estudiante as ge inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo where ge.Estudiante_no_control=no_control and calificacion_final is not null) and calificacion_final is not null limit 1) as ultimo_semestre_cursado from (select *,(select IF(count(distinct Estudiante_no_control),'si','no') as respuesta from Grupo_Estudiante as ge inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo where estatus=1 and Estudiante_no_control=r.Estudiante_no_control) as grupo from Regularizacion as r where calificacion is not null and month(fecha_calificacion)=".$mes." and year(fecha_calificacion)=".$ano." and Plantel_cct_plantel='".$plantel."') as regularizacion inner join Estudiante as e on regularizacion.Estudiante_no_control=e.no_control where grupo='no' order by e.semestre_en_curso asc) as datos on e.no_control=datos.no_control order by datos.ultimo_semestre_cursado,e.primer_apellido,e.segundo_apellido")->result();
   }

   //alumnos que no presentaron regularizacion y se actualiza el friae

   function estudiantes_sin_regularizacion_friae_en_grupos_activos($plantel){
      return $this->db->query("select no_control,e.tipo_ingreso,e.estatus,ge.Grupo_id_grupo from Estudiante as e inner join Grupo_Estudiante as ge on e.no_control=ge.Estudiante_no_control inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo where g.estatus=1 and e.Plantel_cct_plantel='".$plantel."' group by e.no_control")->result();
   }


   //regresa solo no control y semestre
   public function regularizaciones_plantel_periodo_con_grupo($plantel,$mes,$ano){
      //echo $mes;
      return $this->db->query("select datos.no_control,datos.semestre_en_curso,datos.ultimo_semestre_cursado from Estudiante as e inner join (select distinct no_control,semestre_en_curso,(select concat(semestre,nombre_grupo) from Grupo_Estudiante as ge inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo where Estudiante_no_control=no_control and semestre=(select max(semestre) as semestre from Grupo_Estudiante as ge inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo where ge.Estudiante_no_control=no_control and calificacion_final is not null) and calificacion_final is not null limit 1) as ultimo_semestre_cursado from (select *,(select IF(count(distinct Estudiante_no_control),'si','no') as respuesta from Grupo_Estudiante as ge inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo where estatus=1 and Estudiante_no_control=r.Estudiante_no_control) as grupo from Regularizacion as r where calificacion is not null and month(fecha_calificacion)=".$mes." and year(fecha_calificacion)=".$ano." and Plantel_cct_plantel='".$plantel."') as regularizacion inner join Estudiante as e on regularizacion.Estudiante_no_control=e.no_control where grupo='si' order by e.semestre_en_curso asc) as datos on e.no_control=datos.no_control order by datos.ultimo_semestre_cursado,e.primer_apellido,e.segundo_apellido")->result();
   }


   public function ultimo_grupo_cursado($no_control){
      return $this->db->query("select semestre,nombre_grupo from Grupo_Estudiante as ge inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo where Estudiante_no_control='".$no_control."' and semestre=(select max(semestre) as semestre from Grupo_Estudiante as ge inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo where ge.Estudiante_no_control='".$no_control."' and calificacion_final is not null) and calificacion_final is not null limit 1")->result()[0];
   }


   public function regularizacion_estudiante_periodo($no_control,$mes,$ano){
      return $this->db->query("select * from Regularizacion where Estudiante_no_control='".$no_control."' and month(fecha_calificacion)=".$mes." and year(fecha_calificacion)=".$ano)->result();
   }


   public function dias_regularizacion_periodio_plantel($plantel,$mes,$ano){
      return $this->db->query("select day(min(fecha_calificacion)) as dias from Regularizacion where month(fecha_calificacion)=".$mes." and year(fecha_calificacion)=".$ano." and Plantel_cct_plantel='".$plantel."'
      union
      select day(max(fecha_calificacion)) as dias from Regularizacion where month(fecha_calificacion)=".$mes." and year(fecha_calificacion)=".$ano." and Plantel_cct_plantel='".$plantel."'")->result();
   }

   public function nombre_ciclo_periodo_plantel($plantel,$mes,$ano){
      return $this->db->query("select nombre_ciclo_escolar from Ciclo_escolar where (select max(fecha_calificacion) as fecha from Regularizacion where Plantel_cct_plantel='".$plantel."' and month(fecha_calificacion)=".$mes." and year(fecha_calificacion)=".$ano.") between fecha_inicio and date_add(fecha_terminacion,interval 20 day)")->result()[0]->nombre_ciclo_escolar;
   }

   public function plantel_con_municipio_localidad($plantel){

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




         //primero revisar si ya existe una regularizacion de ese periodo y de esa materia
         $existe = $this->db->query("select * from Regularizacion where Estudiante_no_control='".$regularizacion->no_control."' and month(fecha_calificacion)=month('".$regularizacion->fecha_calificacion."') and year(fecha_calificacion)=year('".$regularizacion->fecha_calificacion."') and id_materia='".$regularizacion->id_materia."'")->result();

         if(sizeof($existe)==0){// si no existe la regularizacion la agrega
            //inserta la regularizacion
         if($regularizacion->calificacion!=""){
            if($regularizacion->calificacion=="/"){
                $this->db->query("insert into Regularizacion (Estudiante_no_control,id_materia,calificacion,fecha,fecha_calificacion,Plantel_cct_plantel,estatus,hora,id_asesor) 
            values ('".$regularizacion->no_control."','".$regularizacion->id_materia."',0,'".date("Y-m-d")."','".$regularizacion->fecha_calificacion."','".$regularizacion->cct_plantel."',1,'".$regularizacion->hora."',".$regularizacion->asesor.")");
            }

            else{
                $this->db->query("insert into Regularizacion (Estudiante_no_control,id_materia,calificacion,fecha,fecha_calificacion,Plantel_cct_plantel,estatus,hora,id_asesor) 
            values ('".$regularizacion->no_control."','".$regularizacion->id_materia."',".$regularizacion->calificacion.",'".date("Y-m-d")."','".$regularizacion->fecha_calificacion."','".$regularizacion->cct_plantel."',1,'".$regularizacion->hora."',".$regularizacion->asesor.")");
            }
         }

         }

         else{// si no solo la actualiza

            if($regularizacion->calificacion!=""){
               if($regularizacion->calificacion=="/"){
                   $this->db->query("update Regularizacion set calificacion=0 where Estudiante_no_control='".$regularizacion->no_control."' and fecha_calificacion='".$regularizacion->fecha_calificacion."'");
               }
   
               else{
                  $this->db->query("update Regularizacion set calificacion=".$regularizacion->calificacion." where Estudiante_no_control='".$regularizacion->no_control."' and fecha_calificacion='".$regularizacion->fecha_calificacion."'");
               }
            }

         }
         

         
         

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
             //se sacan las materias que el estudiante debeagreg
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
        return $this->db->query("select * from (select Estudiante_no_control,id_materia from Grupo_Estudiante as ge 
        inner join 
        Grupo as g on ge.Grupo_id_grupo=g.id_grupo
        inner join Estudiante as e on ge.Estudiante_no_control=e.no_control
        where calificacion_final<6 and no_control='".$no_control."'
        union
        select Estudiante_no_control,Materia_id_materia as id_materia from Portabilidad_adeudos as pa 
        inner join 
        Estudiante as e on pa.Estudiante_no_control=e.no_control
        where calificacion<6 and no_control='".$no_control."') 
        as a where concat(a.Estudiante_no_control,a.id_materia) 
        not in 
        (select concat(Estudiante_no_control,id_materia) 
        from Regularizacion 
        where calificacion>=6 and estatus!=2)")->result();
   }


   public function obtener_calificacion_regularizacion_estudiante_materia_reciente($no_control,$materia){
      return $this->db->query("select * from Regularizacion where Estudiante_no_control='".$no_control."' and id_materia='".$materia."' and fecha_calificacion=(select max(fecha_calificacion) from Regularizacion where Estudiante_no_control='".$no_control."' and id_materia='".$materia."')")->result();
   }

   public function obtener_estudiantes_plantel_grupo_activo($plantel){
      return $this->db->query("select distinct Estudiante_no_control as no_control,tipo_ingreso from Grupo_Estudiante as ge inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo where estatus=1 and plantel = '".$plantel."'")->result();
   }



   function periodos_regularizacion_plantel($plantel){
      return $this->db->query("SELECT distinct concat(
         CASE
             WHEN month(fecha_calificacion) =  1 THEN 'ENERO'
             WHEN month(fecha_calificacion) =  5 THEN 'MAYO'
             WHEN month(fecha_calificacion) =  7 THEN 'JULIO'
             WHEN month(fecha_calificacion) =  10 THEN 'OCTUBRE'
         END,
         '-'
         ,
         year(fecha_calificacion)) as periodo
          from Regularizacion as r inner join Ciclo_escolar as c on r.fecha_calificacion between c.fecha_inicio and date_add(c.fecha_terminacion,interval 20 day) where Plantel_cct_plantel='".$plantel."'")->result();
   }


  

public function cerrar_regularizacion($plantel){
   $this->db->trans_start();

   $periodo = $this->db->query("select month(max(fecha_calificacion)) as mes,year(max(fecha_calificacion)) as ano from Regularizacion where Plantel_cct_plantel='".$plantel."' and estatus=1")->result();

   $periodo_fecha = $this->db->query("select max(fecha_calificacion) as fecha from Regularizacion where Plantel_cct_plantel='".$plantel."' and estatus=1")->result()[0]->fecha;

   $this->db->query("insert into Frer (fecha,Plantel_cct_plantel) values ('".$periodo_fecha."','".$plantel."')");

   $id_frer = $this->db->insert_id();

    //solo numero de control y semestre regresa
    $datos ['regularizaciones_sin_grupo'] = $this->regularizaciones_plantel_periodo_sin_grupo($plantel,$periodo[0]->mes,$periodo[0]->ano);
    //solo numero de control y semestre regresa
    $datos ['regularizaciones_con_grupo'] = $this->regularizaciones_plantel_periodo_con_grupo($plantel,$periodo[0]->mes,$periodo[0]->ano);

    $datos['estudiantes_sin_regularizacion'] = $this->estudiantes_sin_regularizacion_friae_en_grupos_activos($plantel);

    //$contador=0;

    foreach($datos ['regularizaciones_con_grupo'] as $regularizacion){
      //$datos ['grupo_anterior_regularizaciones_sin_grupo'][$contador] = $this->ultimo_grupo_cursado($regularizacion->no_control);
      $ultimo_semestre = $this->ultimo_grupo_cursado($regularizacion->no_control);
      $materias_debe = $this->materias_debe_estudiante_actualmente($regularizacion->no_control);

      $materias_ids="";
        foreach($materias_debe as $id){
            $materias_ids.=$id->id_materia.",";//string de las claves de materias
        }

        $materias_ids = substr($materias_ids,0,-1);
        $estatus_alumno='';

        if(sizeof($materias_debe)==0){//si el estudiante debe nada
         $this->db->query("update Estudiante set tipo_ingreso='REINGRESO',estatus='REGULAR' where no_control='".$regularizacion->no_control."'");
         $estatus_alumno='REGULAR';
     }

     else if(sizeof($materias_debe)>0 && sizeof($materias_debe)<=3){// irregular reingreso
         $this->db->query("update Estudiante set tipo_ingreso='REINGRESO',estatus='IRREGULAR' where no_control='".$regularizacion->no_control."'");
         $estatus_alumno='IRREGULAR';
     }

     else if(sizeof($materias_debe)>3 && sizeof($materias_debe)<=5){//sin derecho
         $this->db->query("update Estudiante set tipo_ingreso='SIN DERECHO',estatus='IRREGULAR' where no_control='".$regularizacion->no_control."'");
         $estatus_alumno='IRREGULAR';
     }

     

      $this->db->query("insert into Detalle_frer (Estudiante_no_control,ultimo_semestre_cursado,numero_adeudos,situacion_estudiante,observaciones,Frer_id_frer) 
      values ('".$regularizacion->no_control."','".$ultimo_semestre->semestre."-".$ultimo_semestre->nombre_grupo."',".sizeof($materias_debe).",'".$estatus_alumno."','".$materias_ids."',".$id_frer.")");

      //$contador+=1;
  }

  $contador=0;

  foreach($datos ['regularizaciones_sin_grupo'] as $regularizacion){
      //$datos ['grupo_anterior_regularizaciones_sin_grupo'][$contador] = $this->ultimo_grupo_cursado($regularizacion->no_control);
      $ultimo_semestre = $this->ultimo_grupo_cursado($regularizacion->no_control);
      $materias_debe = $this->materias_debe_estudiante_actualmente($regularizacion->no_control);

      $materias_ids="";
        foreach($materias_debe as $id){
            $materias_ids.=$id->id_materia.",";//string de las claves de materias
        }

        $materias_ids = substr($materias_ids,0,-1);
        $estatus_alumno='';

        if(sizeof($materias_debe)==0){//si el estudiante debe nada
         $this->db->query("update Estudiante set tipo_ingreso='REINGRESO',estatus='REGULAR' where no_control='".$regularizacion->no_control."'");
         $estatus_alumno='REGULAR';
     }

     else if(sizeof($materias_debe)>0 && sizeof($materias_debe)<=3){// irregular reingreso
         $this->db->query("update Estudiante set tipo_ingreso='REINGRESO',estatus='IRREGULAR' where no_control='".$regularizacion->no_control."'");
         $estatus_alumno='IRREGULAR';
     }

     else if(sizeof($materias_debe)>3 && sizeof($materias_debe)<=5){//sin derecho
         $this->db->query("update Estudiante set tipo_ingreso='SIN DERECHO',estatus='IRREGULAR' where no_control='".$regularizacion->no_control."'");
         $estatus_alumno='IRREGULAR';
     }

     

      $this->db->query("insert into Detalle_frer (Estudiante_no_control,ultimo_semestre_cursado,numero_adeudos,situacion_estudiante,observaciones,Frer_id_frer) 
      values ('".$regularizacion->no_control."','".$ultimo_semestre->semestre."-".$ultimo_semestre->nombre_grupo."',".sizeof($materias_debe).",'".$estatus_alumno."','".$materias_ids."',".$id_frer.")");

      $this->db->query("update Regularizacion set estatus=0 where Plantel_cct_plantel='".$plantel."' and estatus=1");

      //$contador+=1;
  }




  if(intval($periodo[0]->mes)==1 || intval($periodo[0]->mes)==7){
   foreach($datos['estudiantes_sin_regularizacion'] as $estudiante){

      $folio_friae = $this->db->query("select folio from Friae where id_grupo='".$estudiante->Grupo_id_grupo."'")->result()[0]->folio;
      $materias_debe = $this->materias_debe_estudiante_actualmente($estudiante->no_control);

      $materias_ids="";
            //se saca la cadena de claves de materias que debe
            foreach($materias_debe as $id){
                $materias_ids.=$id->id_materia.",";
            }


      $this->db->query("update Friae_Estudiante set tipo_ingreso_despues_regularizacion='".$estudiante->tipo_ingreso."' where Friae_folio=".$folio_friae." and Estudiante_no_control='".$estudiante->no_control."'");//-----------------------------------------------------------------------------------------------------------------------------------------------------------
      $this->db->query("update Friae_Estudiante set adeudos_segunda_regularizacion=".(sizeof($materias_debe)).",id_materia_adeudos_segunda_regularizacion='".$materias_ids."' where Friae_folio=".$folio_friae." and Estudiante_no_control='".$estudiante->no_control."'");

      
   }
  }
  


  


  //insertar estudiantes sin grupo


  //$materias_debe = $this->M_regularizacion->materias_debe_estudiante_actualmente($estudiante->Estudiante_no_control)

    $this->db->trans_complete();

   if ($this->db->trans_status() === FALSE)
   {
         return "no";
   } 
   else{
      return "si";
   }


}



function materias_regularizadas_periodo($mes,$ano,$plantel){
   return $this->db->query("select clave,unidad_contenido from Materia as m inner join (select id_materia from Regularizacion where month(fecha_calificacion)=".$mes." and year(fecha_calificacion)=".$ano." and Plantel_cct_plantel='".$plantel."' group by id_materia) as ma on m.clave=ma.id_materia group by clave")->result();
}

   
}