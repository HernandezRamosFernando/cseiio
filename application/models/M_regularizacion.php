
<?php
class M_regularizacion extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }

   public function para_frer_materias_debe_estudiante_periodo($mes,$ano,$no_control){
      

      return $this->db->query("select * from (select Estudiante_no_control, id_materia from Grupo_Estudiante as ge 
      inner join 
      Grupo as g on ge.Grupo_id_grupo=g.id_grupo
      inner join Estudiante as e on ge.Estudiante_no_control=e.no_control
      inner join Ciclo_escolar c on c.id_ciclo_escolar=ge.Ciclo_escolar_id_ciclo_escolar where  c.fecha_terminacion<='".$ano."-".$mes."-30' and calificacion_final<6 and calificacion_final is not null and no_control='".$no_control."' union
      select Estudiante_no_control,Materia_id_materia as id_materia from Portabilidad_adeudos as pa
      inner join 
      Estudiante as e on pa.Estudiante_no_control=e.no_control
      where calificacion<6 and no_control='".$no_control."') as a where concat(a.Estudiante_no_control,a.id_materia) 
      not in (select concat(Estudiante_no_control,id_materia) 
      from Regularizacion 
      where Estudiante_no_control='".$no_control."' and fecha_calificacion<='".$ano."-".$mes."-30' and calificacion>=6 and estatus!=2)")->result();

   }

   public function para_frer_regularizaciones_plantel_periodo_sin_grupo($plantel,$mes,$ano){
      

      return $this->db->query("select nombre,no_control,semestre_en_curso,(select concat(semestre,nombre_grupo) from Grupo_Estudiante as ge inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo where Estudiante_no_control=e.no_control and semestre=(select max(semestre) as semestre from Grupo_Estudiante as ge inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo inner join Ciclo_escolar c on c.id_ciclo_escolar=ge.Ciclo_escolar_id_ciclo_escolar where  c.fecha_terminacion<='".$ano."-".$mes."-30' and ge.Estudiante_no_control=e.no_control and calificacion_final is not null)  and calificacion_final is not null limit 1) as ultimo_semestre_cursado from Estudiante as e where e.no_control not in (select distinct Estudiante_no_control from Grupo_Estudiante as ge inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo inner join Ciclo_escolar c on c.id_ciclo_escolar=ge.Ciclo_escolar_id_ciclo_escolar where g.plantel='".$plantel."' and '".$ano."-".$mes."-01' between fecha_inicio_inscripcion and fecha_terminacion) and e.no_control in (select Estudiante_no_control from Regularizacion r where calificacion is not null and month(fecha_calificacion)=".$mes." and year(fecha_calificacion)=".$ano." and Plantel_cct_plantel='".$plantel."') order by ultimo_semestre_cursado,e.primer_apellido,e.segundo_apellido,e.nombre")->result();

   }

   public function para_frer_regularizaciones_plantel_periodo_con_grupo($plantel,$mes,$ano){
      

      return $this->db->query("select nombre,no_control,semestre_en_curso,(select concat(semestre,nombre_grupo) from Grupo_Estudiante as ge inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo where Estudiante_no_control=e.no_control and semestre=(select max(semestre) as semestre from Grupo_Estudiante as ge inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo inner join Ciclo_escolar c on c.id_ciclo_escolar=ge.Ciclo_escolar_id_ciclo_escolar where  c.fecha_terminacion<='".$ano."-".$mes."-30' and ge.Estudiante_no_control=e.no_control and calificacion_final is not null)  and calificacion_final is not null limit 1) as ultimo_semestre_cursado from Estudiante as e where e.no_control in (select distinct Estudiante_no_control from Grupo_Estudiante as ge inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo inner join Ciclo_escolar c on c.id_ciclo_escolar=ge.Ciclo_escolar_id_ciclo_escolar where g.plantel='".$plantel."' and '".$ano."-".$mes."-01' between fecha_inicio_inscripcion and fecha_terminacion) and e.no_control in (select Estudiante_no_control from Regularizacion r where calificacion is not null and month(fecha_calificacion)=".$mes." and year(fecha_calificacion)=".$ano." and Plantel_cct_plantel='".$plantel."') order by ultimo_semestre_cursado,e.primer_apellido,e.segundo_apellido,e.nombre")->result();

   }

   public function modificar_datos_regularizacion($parametros_regu,$parametros_actualizar){
      $this->db->trans_start();

        $this->db->where('id_materia',$parametros_regu->id_materia);
        $this->db->where('fecha',$parametros_regu->fecha);
        $this->db->where('Plantel_cct_plantel',$parametros_regu->cct_plantel);
        $this->db->where('calificacion',$parametros_regu->calificacion_inicial);
        $this->db->where('Estudiante_no_control',$parametros_regu->no_control);
        $this->db->update('Regularizacion',$parametros_actualizar);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
            return "no";
        }

        else{
            return "si";
        }

   }

   function estudiantes_regularizadas_periodo_mostrar($mes,$ano,$plantel,$materia){
      $mes_anterior=$mes-1;
      $mes_posterior=$mes+1;
      return $this->db->query("select *,a.primer_apellido primer_apellido_asesor,a.segundo_apellido segundo_apellido_asesor,a.nombre nombre_asesor,e.primer_apellido primer_apellido_alumno,e.segundo_apellido segundo_apellido_alumno,e.nombre nombre_alumno from Regularizacion r inner join Estudiante e on r.Estudiante_no_control=e.no_control left join Asesor a on r.id_asesor=a.id_asesor where month(fecha_calificacion) between ".$mes_anterior." and ".$mes_posterior." and id_materia='".$materia."' and year(fecha_calificacion)=".$ano." and r.Plantel_cct_plantel='".$plantel."'")->result();
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
      where id_materia='".$materia."' order by primer_apellido,segundo_apellido,nombre
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
            $materias_ids=trim($materias_ids,',');

            if(sizeof($materias_debe)>=6){
               $materias_ids='';
            }

      $this->db->query("update Friae_Estudiante set tipo_ingreso_despues_regularizacion=if(adeudos_fin_semestre=0,'','".$estudiante->tipo_ingreso."') where Friae_folio=".$folio_friae." and Estudiante_no_control='".$estudiante->no_control."'");//-----------------------------------------------------------------------------------------------------------------------------------------------------------
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


public function insertar_regularizacion_ciclos_anteriores($datos){
   $this->db->trans_start();
       $this->db->insert('Regularizacion', $datos);
       $this->db->trans_complete();

       if ($this->db->trans_status() === FALSE)
       {
           return "no";
       }

       else{
           return "si";
       }
  }


  public function existe_regu_ciclo_anterior($id_plantel,$materia,$no_control,$fecha_regularizacion){
   return $this->db->query("SELECT * FROM Regularizacion where id_materia='".$materia."' and Estudiante_no_control='".$no_control."' and Plantel_cct_plantel='".$id_plantel."' and fecha_calificacion='".$fecha_regularizacion."';")->result();
}








public function actualizar_estatus_estudiante($no_control,$num_adeudos,$modulo,$plantel_cct,$matricula,$fecha_baja,$motivo_baja,$tipo_operacion,$grupo){


   
   $this->db->trans_start();
   $tipo_ingreso='';
   $semestre_en_curso=0;
   $num_semestres_trascurridos=0; //Contador de semestres.

   $num_semestres_trascurridos=count($this->db->query("SELECT * FROM Ciclo_escolar where fecha_inicio between (select fecha_registro from Estudiante where no_control='".$no_control."') and CURDATE()")->result());

 
  
  switch ($tipo_operacion) {
      
      case 'DESERTOR':
         $estatus_desertor='IRREGULAR';
            if($num_adeudos==0){
               $estatus_desertor='REGULAR';
            }
         
            $semestre_en_curso=$modulo;
            $this->db->query("update Estudiante set tipo_ingreso='DESERTOR',semestre_en_curso=".$semestre_en_curso.",semestre=".$num_semestres_trascurridos.", matricula='".$matricula."' where no_control='".$no_control."'");

            
            
            $existe_registro_desercion=$this->db->query("SELECT * FROM Desertor where Estudiante_no_control='".$no_control."' and fecha='".$fecha_baja."';")->result();

            

            

           if(count($existe_registro_desercion)==0){
            
               $data = array(
                  'Estudiante_no_control' =>$no_control,
                  'motivo' => $motivo_baja,
                  'fecha' => $fecha_baja,
                  'semestre' => $semestre_en_curso,
                  'grupo' => $grupo
            );

           

            $this->db->insert('Desertor', $data);
         }
          
          break;
          default:
          if($matricula!='NULL'){
            $matricula="'".$matricula."'";
         }
		  if($num_adeudos==0){
      $tipo_ingreso='PROBABLE REINCORPORADO';
      $semestre_en_curso=$modulo;
      $this->db->query("update Estudiante set tipo_ingreso='".$tipo_ingreso."',estatus='REGULAR',semestre_en_curso=".$semestre_en_curso.",semestre=".$num_semestres_trascurridos.", matricula=".$matricula." where no_control='".$no_control."'");
   }
   if($num_adeudos>=1 && $num_adeudos<=3){
      $tipo_ingreso='PROBABLE REINCORPORADO';
      $semestre_en_curso=$modulo;

      $this->db->query("update Estudiante set tipo_ingreso='".$tipo_ingreso."',estatus='IRREGULAR',semestre_en_curso=".$semestre_en_curso.",semestre=".$num_semestres_trascurridos.",matricula=".$matricula." where no_control='".$no_control."'");
   }

   if($num_adeudos>3 && $num_adeudos<=5){
      $tipo_ingreso='SIN DERECHO';
      $semestre_en_curso=$modulo;
      $this->db->query("update Estudiante set tipo_ingreso='".$tipo_ingreso."',estatus='IRREGULAR',semestre_en_curso=".$semestre_en_curso.",semestre=".$num_semestres_trascurridos.", matricula=".$matricula." where no_control='".$no_control."'");
      
   }
   if($num_adeudos>=6){

   
       $tipo_ingreso='REPROBADO';
       $semestre_en_curso=$modulo;
      $this->db->query("update Estudiante set tipo_ingreso='".$tipo_ingreso."',estatus='IRREGULAR',semestre_en_curso=".$semestre_en_curso.",semestre=".$num_semestres_trascurridos.", matricula=".$matricula." where no_control='".$no_control."'");
      
   }


   if($num_adeudos<0){
      
      $semestre_en_curso=$modulo;
     $this->db->query("update Estudiante set tipo_ingreso='BAJA',semestre_en_curso=".$semestre_en_curso.",semestre=".$num_semestres_trascurridos.", matricula=".$matricula." where no_control='".$no_control."'");

     $existe_registro_baja=$this->db->query("select * from Baja where Estudiante_no_control='".$no_control."' and fecha='".$fecha_baja."'")->result();

     if(count($existe_registro_baja)==0){
            $datos = array(
               'Estudiante_no_control' => strtoupper($no_control),
               'motivo' => strtoupper($motivo_baja),
               'fecha' => $fecha_baja,
               'observacion' =>'NINGUNA'
         );
         
            $this->db->insert('Baja', $datos);

     }
     
  }
		  
      }//Termina condicion multiple



   $this->db->trans_complete();

   

       if ($this->db->trans_status() === FALSE)
       {
           return "no";
       }

       else{
         
           return "si";
       }


   

}
   




public function actualizar_friae_ciclos_anteriores($parametros){

   /*
   'anio_inicio' => $anio_inicio,
	'anio_termino' => $anio_terminacion,
	'semestre' =>$modulo,
	'no_control'=>$no_control
   */

   $this->db->trans_complete();
   $semestre_anterior=intval($parametros->semestre)-1;

if($parametros->periodo=="AGOSTO-ENERO"){

   if(intval($parametros->semestre)==1){

      
      $situacion_fin_modulo='REINGRESO';
      $num_adeudos_fin_modulo=0;
      $materias_adeudo_fin_modulo='';
      $adeudos_sin_regu_enero=$this->db->query("SELECT * FROM Grupo_Estudiante ge inner join Grupo g on g.id_grupo=ge.Grupo_id_grupo where g.semestre=1 and Estudiante_no_control='".$parametros->no_control."' and calificacion_final>0 and calificacion_final<=5 and calificacion_final IS NOT NULL and id_materia not in (SELECT id_materia FROM Regularizacion where fecha_calificacion<'".$parametros->anio_termino."-01-01' and Estudiante_no_control='".$parametros->no_control."' and calificacion>=6);")->result();

      $num_adeudos_fin_modulo=count($adeudos_sin_regu_enero);

      if($num_adeudos_fin_modulo>0 && $num_adeudos_fin_modulo<=3){
         $situacion_fin_modulo='REINGRESO';// equivale a irregular
      }

      if($num_adeudos_fin_modulo>3 && $num_adeudos_fin_modulo<=5){
         $situacion_fin_modulo='SIN DERECHO';// equivale a irregular
      }

      if($num_adeudos_fin_modulo>=6){
         $situacion_fin_modulo='REPROBADO';// SIN DERECHO
      }

      foreach($adeudos_sin_regu_enero as $id){
         $materias_adeudo_fin_modulo.=$id->id_materia.",";
     }

     $materias_adeudo_fin_modulo=trim($materias_adeudo_fin_modulo,',');
      
     $situacion_despues_regu='REINGRESO';
     $num_adeudos_despues_regu=0;
     $materias_adeudo_despues_regu='';
      $adeudos_despues_regu_enero=$this->db->query("SELECT * FROM Grupo_Estudiante ge inner join Grupo g on g.id_grupo=ge.Grupo_id_grupo where g.semestre=1 and Estudiante_no_control='".$parametros->no_control."' and calificacion_final>0 and calificacion_final<=5 and calificacion_final IS NOT NULL and id_materia not in (SELECT id_materia FROM Regularizacion where fecha_calificacion<'".$parametros->anio_termino."-02-01' and Estudiante_no_control='".$parametros->no_control."' and calificacion>=6);")->result();
      $num_adeudos_despues_regu=count($adeudos_despues_regu_enero);

      if($num_adeudos_despues_regu>0 && $num_adeudos_despues_regu<=3){
         $situacion_despues_regu='REINGRESO';// equivale a irregular
      }


      if($num_adeudos_despues_regu>3 && $num_adeudos_despues_regu<=5){
         $situacion_despues_regu='SIN DERECHO';// equivale a irregular
      }

      if($num_adeudos_despues_regu>=6){
         $situacion_despues_regu='REPROBADO';// equivale a irregular
      }

      foreach($adeudos_despues_regu_enero as $id){
         $materias_adeudo_despues_regu.=$id->id_materia.",";
     }

     $materias_adeudo_despues_regu=trim($materias_adeudo_despues_regu,',');
     
     if($num_adeudos_fin_modulo==0){
      $situacion_despues_regu="";
    }

     $datos = array(
      'tipo_ingreso_fin_semestre' => $situacion_fin_modulo,
      'adeudos_fin_semestre' => $num_adeudos_fin_modulo,
      'id_materia_adeudos_fin_semestre' => $materias_adeudo_fin_modulo,
      'adeudos_segunda_regularizacion' => $num_adeudos_despues_regu,
      'id_materia_adeudos_segunda_regularizacion' => $materias_adeudo_despues_regu,
      'tipo_ingreso_despues_regularizacion' => $situacion_despues_regu,
  );
        $this->db->where('Friae_folio',$parametros->id_friae);
        $this->db->where('Estudiante_no_control',$parametros->no_control);
        $this->db->update('Friae_Estudiante',$datos);


   }
   else{
      
      $tipo_ingreso_modulo='REINGRESO';
      $estatus_inscripcion='REGULAR';
      $num_adeudos_inicio_modulo=0;
      $materias_adeudo_inicio_modulo='';

      $num_adeudos_regu_octubre=0;
      $materias_adeudo_regu_octubre='';

      $adeudos_sin_regu_octubre=$this->db->query("SELECT * FROM Grupo_Estudiante ge inner join Grupo g on g.id_grupo=ge.Grupo_id_grupo where g.semestre<=".$semestre_anterior." and Estudiante_no_control='".$parametros->no_control."' and calificacion_final>0 and calificacion_final<=5 and calificacion_final IS NOT NULL and id_materia not in (SELECT id_materia FROM Regularizacion where fecha_calificacion<'".$parametros->anio_inicio."-10-01' and Estudiante_no_control='".$parametros->no_control."' and calificacion>=6);")->result();

      $num_adeudos_inicio_modulo=count($adeudos_sin_regu_octubre);
      if($num_adeudos_inicio_modulo>0){
         $estatus_inscripcion='IRREGULAR';

      }

      foreach($adeudos_sin_regu_octubre as $id){
         $materias_adeudo_inicio_modulo.=$id->id_materia.",";
     }

     $materias_adeudo_inicio_modulo=trim($materias_adeudo_inicio_modulo,",");

     $adeudos_con_regu_octubre=$this->db->query("SELECT * FROM Grupo_Estudiante ge inner join Grupo g on g.id_grupo=ge.Grupo_id_grupo where g.semestre<=".$semestre_anterior." and Estudiante_no_control='".$parametros->no_control."' and calificacion_final>0 and calificacion_final<=5 and calificacion_final IS NOT NULL and id_materia not in (SELECT id_materia FROM Regularizacion where fecha_calificacion<'".$parametros->anio_inicio."-11-01' and Estudiante_no_control='".$parametros->no_control."' and calificacion>=6);")->result();

     $num_adeudos_regu_octubre=count($adeudos_con_regu_octubre);

     foreach($adeudos_con_regu_octubre as $id){
      $materias_adeudo_regu_octubre.=$id->id_materia.",";
  }

      $materias_adeudo_regu_octubre=trim($materias_adeudo_regu_octubre,",");
  $estatus_final='REINGRESO';
      $situacion_fin_modulo='REINGRESO';
      $num_adeudos_fin_modulo=0;
      $materias_adeudo_fin_modulo='';

      $num_adeudos_regu_enero=0;
      $materias_adeudo_regu_enero='';

      $adeudos_sin_regu_enero=$this->db->query("SELECT * FROM Grupo_Estudiante ge inner join Grupo g on g.id_grupo=ge.Grupo_id_grupo where g.semestre<=".$parametros->semestre." and Estudiante_no_control='".$parametros->no_control."' and calificacion_final>0 and calificacion_final<=5 and calificacion_final IS NOT NULL and id_materia not in (SELECT id_materia FROM Regularizacion where fecha_calificacion<'".$parametros->anio_termino."-01-01' and Estudiante_no_control='".$parametros->no_control."' and calificacion>=6);")->result();

      $num_adeudos_fin_modulo=count($adeudos_sin_regu_enero);
      

      foreach($adeudos_sin_regu_enero as $id){
         $materias_adeudo_fin_modulo.=$id->id_materia.",";
     }
     $materias_adeudo_fin_modulo=trim($materias_adeudo_fin_modulo,",");
     $adeudos_con_regu_enero=$this->db->query("SELECT * FROM Grupo_Estudiante ge inner join Grupo g on g.id_grupo=ge.Grupo_id_grupo where g.semestre<=".$parametros->semestre." and Estudiante_no_control='".$parametros->no_control."' and calificacion_final>0 and calificacion_final<=5 and calificacion_final IS NOT NULL and id_materia not in (SELECT id_materia FROM Regularizacion where fecha_calificacion<'".$parametros->anio_termino."-02-01' and Estudiante_no_control='".$parametros->no_control."' and calificacion>=6);")->result();

     $num_adeudos_regu_enero=count($adeudos_con_regu_enero);

     foreach($adeudos_con_regu_enero as $id){
      $materias_adeudo_regu_enero.=$id->id_materia.",";
  }
  $materias_adeudo_regu_enero=trim($materias_adeudo_regu_enero,",");
   if($num_adeudos_fin_modulo>0 && $num_adeudos_fin_modulo<=3){
      $situacion_fin_modulo='REINGRESO';// equivale a irregular
      }

      if($num_adeudos_fin_modulo>3 && $num_adeudos_fin_modulo<=5){
         $situacion_fin_modulo='SIN DERECHO';// equivale a irregular
      }

      if($num_adeudos_fin_modulo>=6){
         $situacion_fin_modulo='REPROBADO';// SIN DERECHO
         $materias_adeudo_fin_modulo='';
      }


      if($num_adeudos_regu_enero>0 && $num_adeudos_regu_enero<=3){
         $estatus_final='REINGRESO';// equivale a irregular
         }
   
         if($num_adeudos_regu_enero>3 && $num_adeudos_regu_enero<=5){
            $estatus_final='SIN DERECHO';// equivale a irregular
         }
   
         if($num_adeudos_regu_enero>=6){
            $estatus_final='REPROBADO';// SIN DERECHO
            $materias_adeudo_regu_enero="";
         }
         if($num_adeudos_fin_modulo==0){
            $estatus_final="";
          }


        $datos = array(
            'tipo_ingreso_inscripcion' => $tipo_ingreso_modulo,
            'estatus_inscripcion' => $estatus_inscripcion,
            'numero_adeudos_inscripcion' => $num_adeudos_inicio_modulo,
            'id_materia_adeudos_inscripcion' => $materias_adeudo_inicio_modulo,
            'adeudos_primera_regularizacion' => $num_adeudos_regu_octubre,
            'id_materia_adeudos_primera_regularizacion' => $materias_adeudo_regu_octubre,
            'tipo_ingreso_fin_semestre' => $situacion_fin_modulo,
            'adeudos_fin_semestre' => $num_adeudos_fin_modulo,
            'id_materia_adeudos_fin_semestre' => $materias_adeudo_fin_modulo,
            'adeudos_segunda_regularizacion' => $num_adeudos_regu_enero,
            'id_materia_adeudos_segunda_regularizacion' => $materias_adeudo_regu_enero,
            'tipo_ingreso_despues_regularizacion' => $estatus_final,
        );
              $this->db->where('Friae_folio',$parametros->id_friae);
              $this->db->where('Estudiante_no_control',$parametros->no_control);
              $this->db->update('Friae_Estudiante',$datos);





      
      

      
   }


}

if($parametros->periodo=="FEBRERO-JULIO"){

   //-------------------------------------------------------------------------------------------------------
   $tipo_ingreso_modulo='REINGRESO';
   $estatus_inscripcion='REGULAR';
   $num_adeudos_inicio_modulo=0;
   $materias_adeudo_inicio_modulo='';

   $num_adeudos_regu_mayo=0;
   $materias_adeudo_regu_mayo='';

   

   $adeudos_sin_regu_mayo=$this->db->query("SELECT * FROM Grupo_Estudiante ge inner join Grupo g on g.id_grupo=ge.Grupo_id_grupo where g.semestre<=".$semestre_anterior." and Estudiante_no_control='".$parametros->no_control."' and calificacion_final>0 and calificacion_final<=5 and calificacion_final IS NOT NULL and id_materia not in (SELECT id_materia FROM Regularizacion where fecha_calificacion<'".$parametros->anio_inicio."-05-01' and Estudiante_no_control='".$parametros->no_control."' and calificacion>=6);")->result();

   $num_adeudos_inicio_modulo=count($adeudos_sin_regu_mayo);
   if($num_adeudos_inicio_modulo>0){
      $estatus_inscripcion='IRREGULAR';

   }

   foreach($adeudos_sin_regu_mayo as $id){
      $materias_adeudo_inicio_modulo.=$id->id_materia.",";
  }

  $materias_adeudo_inicio_modulo=trim($materias_adeudo_inicio_modulo,',');

  $adeudos_con_regu_mayo=$this->db->query("SELECT * FROM Grupo_Estudiante ge inner join Grupo g on g.id_grupo=ge.Grupo_id_grupo where g.semestre<=".$semestre_anterior." and Estudiante_no_control='".$parametros->no_control."' and calificacion_final>0 and calificacion_final<=5 and calificacion_final IS NOT NULL and id_materia not in (SELECT id_materia FROM Regularizacion where fecha_calificacion<'".$parametros->anio_inicio."-06-01' and Estudiante_no_control='".$parametros->no_control."' and calificacion>=6);")->result();

  $num_adeudos_regu_mayo=count($adeudos_con_regu_mayo);

  foreach($adeudos_con_regu_mayo as $id){
   $materias_adeudo_regu_mayo.=$id->id_materia.",";
}
$materias_adeudo_regu_mayo=trim($materias_adeudo_regu_mayo,',');

$estatus_final='REINGRESO';
   $situacion_fin_modulo='REINGRESO';
   $num_adeudos_fin_modulo=0;
   $materias_adeudo_fin_modulo='';

   $num_adeudos_regu_julio=0;
   $materias_adeudo_regu_julio='';

   $adeudos_sin_regu_julio=$this->db->query("SELECT * FROM Grupo_Estudiante ge inner join Grupo g on g.id_grupo=ge.Grupo_id_grupo where g.semestre<=".$parametros->semestre." and Estudiante_no_control='".$parametros->no_control."' and calificacion_final>0 and calificacion_final<=5 and calificacion_final IS NOT NULL and id_materia not in (SELECT id_materia FROM Regularizacion where fecha_calificacion<'".$parametros->anio_termino."-07-01' and Estudiante_no_control='".$parametros->no_control."' and calificacion>=6);")->result();

   $num_adeudos_fin_modulo=count($adeudos_sin_regu_julio);
   

   foreach($adeudos_sin_regu_julio as $id){
      $materias_adeudo_fin_modulo.=$id->id_materia.",";
  }
  $materias_adeudo_fin_modulo=trim($materias_adeudo_fin_modulo,',');

  $adeudos_con_regu_julio=$this->db->query("SELECT * FROM Grupo_Estudiante ge inner join Grupo g on g.id_grupo=ge.Grupo_id_grupo where g.semestre<=".$parametros->semestre." and Estudiante_no_control='".$parametros->no_control."' and calificacion_final>0 and calificacion_final<=5 and calificacion_final IS NOT NULL and id_materia not in (SELECT id_materia FROM Regularizacion where fecha_calificacion<'".$parametros->anio_termino."-08-01' and Estudiante_no_control='".$parametros->no_control."' and calificacion>=6);")->result();

  $num_adeudos_regu_julio=count($adeudos_con_regu_julio);

  foreach($adeudos_con_regu_julio as $id){
   $materias_adeudo_regu_julio.=$id->id_materia.",";
}

$materias_adeudo_regu_julio=trim($materias_adeudo_regu_julio,',');


if($num_adeudos_fin_modulo>0 && $num_adeudos_fin_modulo<=3){
   $situacion_fin_modulo='REINGRESO';// equivale a irregular
   }

   if($num_adeudos_fin_modulo>3 && $num_adeudos_fin_modulo<=5){
      $situacion_fin_modulo='SIN DERECHO';// equivale a irregular
   }

   if($num_adeudos_fin_modulo>=6){
      $situacion_fin_modulo='REPROBADO';// SIN DERECHO
   }


   if($num_adeudos_regu_julio>0 && $num_adeudos_regu_julio<=3){
      $estatus_final='REINGRESO';// equivale a irregular
      }

      if($num_adeudos_regu_julio>3 && $num_adeudos_regu_julio<=5){
         $estatus_final='SIN DERECHO';// equivale a irregular
      }

      if($num_adeudos_regu_julio>=6){
         $estatus_final='REPROBADO';// SIN DERECHO
      }

      if($num_adeudos_fin_modulo==0){
         $estatus_final="";
       }

      $datos = array(
         'tipo_ingreso_inscripcion' => $tipo_ingreso_modulo,
         'estatus_inscripcion' => $estatus_inscripcion,
         'numero_adeudos_inscripcion' => $num_adeudos_inicio_modulo,
         'id_materia_adeudos_inscripcion' => $materias_adeudo_inicio_modulo,
         'adeudos_primera_regularizacion' => $num_adeudos_regu_mayo,
         'id_materia_adeudos_primera_regularizacion' => $materias_adeudo_regu_mayo,
         'tipo_ingreso_fin_semestre' => $situacion_fin_modulo,
         'adeudos_fin_semestre' => $num_adeudos_fin_modulo,
         'id_materia_adeudos_fin_semestre' => $materias_adeudo_fin_modulo,
         'adeudos_segunda_regularizacion' => $num_adeudos_regu_julio,
         'id_materia_adeudos_segunda_regularizacion' => $materias_adeudo_regu_julio,
         'tipo_ingreso_despues_regularizacion' => $estatus_final,
     );
           $this->db->where('Friae_folio',$parametros->id_friae);
           $this->db->where('Estudiante_no_control',$parametros->no_control);
           $this->db->update('Friae_Estudiante',$datos);




   //------------------------------------------------------------------------------------------------------
   
     

}
  



   

   

       if ($this->db->trans_status() === FALSE)
       {
           return "no";
       }

       else{
         
           return "si";
       }


   

}


public function actualizar_frer_ciclos_ant($datos){
   $this->db->trans_complete();
   $id_frer=0;

   

   $frer_dato=$this->db->query("SELECT max(id_frer) as id_frer FROM Frer where month(fecha)=".$datos->mes_regu." and year(fecha)=".$datos->anio_regu." and Plantel_cct_plantel='".$datos->cct_plantel."';")->row();

  

   if(!is_null($frer_dato->id_frer)){
      $id_frer=$frer_dato->id_frer;
      
      
   }
   else{
         
         $frer = array(
            'Plantel_cct_plantel' =>$datos->cct_plantel,
            'fecha' => $datos->anio_regu."-".$datos->mes_regu."-20"

         );

   $this->db->insert('Frer', $frer);
      $id_frer = $this->db->insert_id();
   }


   
   $detalle_frer=$this->db->query("SELECT * FROM Detalle_frer where Estudiante_no_control='".$datos->no_control."' and Frer_id_frer=".$id_frer.";")->result();

   $mes_final=intval($datos->mes_regu)+1;          


   $datos_adeudos_estudiante=$this->db->query("SELECT * FROM Ciclo_escolar c inner join Grupo_Estudiante ge on c.id_ciclo_escolar=ge.Ciclo_escolar_id_ciclo_escolar where fecha_inicio<'".$datos->fecha_regularizacion."' and Estudiante_no_control='".$datos->no_control."' and calificacion_final>0 and calificacion_final<=5 and calificacion_final is not null and id_materia not in (SELECT id_materia FROM Regularizacion where fecha_calificacion<'".$datos->anio_regu."-".$mes_final."-01' and Estudiante_no_control='".$datos->no_control."' and calificacion>=6);")->result();



$datos_grupo=$this->db->query("SELECT * FROM Ciclo_escolar c inner join Grupo_Estudiante ge on c.id_ciclo_escolar=ge.Ciclo_escolar_id_ciclo_escolar inner join Grupo g on g.id_grupo=ge.Grupo_id_grupo where fecha_inicio<'".$datos->fecha_regularizacion."' and Estudiante_no_control='".$datos->no_control."' order by fecha_inicio desc")->result();

$ultimo_grupo_cursado='';

if(count($datos_grupo)>0){
   $ultimo_grupo_cursado=$datos_grupo[0]->semestre."-".$datos_grupo[0]->nombre_grupo;
}
   $num_adeudos_regu=count($datos_adeudos_estudiante);
   $estatus_alumno='REGULAR';

   $materias_adeudos_despues_de_regu='';

   foreach($datos_adeudos_estudiante as $id){
      $materias_adeudos_despues_de_regu.=$id->id_materia.",";
  }
  $materias_adeudos_despues_de_regu=trim($materias_adeudos_despues_de_regu,',');
  if($num_adeudos_regu>0){
      $estatus_alumno='IRREGULAR';
  }

   if(count($detalle_frer)>0){
      $modificar_frer = array(
         'ultimo_semestre_cursado' =>$ultimo_grupo_cursado,
         'numero_adeudos' =>$num_adeudos_regu,
         'situacion_estudiante' =>$estatus_alumno,
         'observaciones'=>$materias_adeudos_despues_de_regu

       );
       $this->db->where('Frer_id_frer',$id_frer);
       $this->db->where('Estudiante_no_control',$datos->no_control);
      $this->db->update('Detalle_frer', $modificar_frer);
              

   }
   else{
               

               $insertar_frer = array(
                  'Estudiante_no_control' =>$datos->no_control,
                  'ultimo_semestre_cursado' =>$ultimo_grupo_cursado,
                  'numero_adeudos' =>$num_adeudos_regu,
                  'situacion_estudiante' =>$estatus_alumno,
                  'observaciones'=>$materias_adeudos_despues_de_regu,
                  'Frer_id_frer' =>$id_frer
         );

         $this->db->insert('Detalle_frer', $insertar_frer);

   }


   if ($this->db->trans_status() === FALSE)
       {
           return "no";
       }

       else{
         
           return "si";
       }

   }

   public function update_regularizacion_ciclos_anteriores($parametros,$datos){
      $this->db->trans_start();
  
         $this->db->where('id_materia',$parametros->id_materia);
         $this->db->where('Estudiante_no_control',$parametros->no_control);
         $this->db->where('Plantel_cct_plantel',$parametros->plantel_cct);
         $this->db->where('fecha_calificacion',$parametros->fecha_calificacion);
          $this->db->update('Regularizacion', $datos);
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