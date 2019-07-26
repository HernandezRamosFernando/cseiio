<?php
class M_estudiante extends CI_Model { 
   public function __construct() {
      parent::__construct();
      
   }

   public function obtener_nombre_tutor_estudiante($no_control){
        return $this->db->query("select nombre_tutor,primer_apellido_tutor,segundo_apellido_tutor from Estudiante_Tutor as et inner join Tutor as t on et.Tutor_id_tutor=t.id_tutor where et.Estudiante_no_control='".$no_control."'")->result()[0];
   }


//generacion de matricula

public function asignar_numero_consecutivo(){
   /*SELECT  max(CONVERT(SUBSTRING(a.no_control,10,LENGTH(a.no_control)), SIGNED INTEGER)) as numero FROM control_escolar.aspirante a where no_control like 'CSEIIO20%';*/
  $this->db->select('max(CONVERT(SUBSTRING(e.no_control,10,LENGTH(e.no_control)), SIGNED INTEGER)) as numero');
  $this->db->from('Estudiante e');
  $this->db->like('e.no_control','CSEIIO'.date("y"),'after');

  $consulta = $this->db->get();
  $resultado=$consulta->row()->numero;

  return $resultado;
   
}

//fin generacion de matricula





public function insertar_estudiante_nuevo_ingreso(
   $datos_estudiante,
   $datos_estudiante_tutor,
   $parentesco_estudiante_tutor,
   $datos_estudiante_lengua_materna,
   $datos_estudiante_documentos,
   $datos_estudiante_medicos,
   $datos_escuela_procedencia){

      

            $this->db->trans_start();

            $this->db->insert('Estudiante',$datos_estudiante);

            
            $this->db->insert('Tutor',$datos_estudiante_tutor);
            $id_tutor = $this->db->insert_id();
            
            $this->db->insert('Estudiante_Tutor',array(
               'Estudiante_no_control' => $datos_estudiante['no_control'],
               'Tutor_id_tutor' => $id_tutor,
               'parentesco' => $parentesco_estudiante_tutor
            ));
            
            
            
            foreach($datos_estudiante_lengua_materna as $dato_lengua){
               $this->db->insert('Datos_lengua_materna',$dato_lengua);
            }

            

            
           
            foreach($datos_estudiante_medicos as $dato_medico){
               $this->db->insert('Expediente_medico',$dato_medico);
            }
            
            
            foreach($datos_estudiante_documentos as $documento){

               $this->db->insert('Documentacion',$documento);
         }


         foreach($datos_escuela_procedencia as $escuela){
            if($escuela['Escuela_procedencia_cct_escuela_procedencia']!=""){
               $this->db->insert('Estudiante_Escuela_procedencia',$escuela);
            }
               
         }
         
         
         

         
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE)
            {
               print_r($this->db->error());
             //return "no";
            }
               
            else{
               return "si";
               //return "si";
            }

   
}



public function get_estudiantes_curp_plantel($curp,$cct_plantel){
   return $this->db->query("SELECT * FROM Estudiante WHERE curp LIKE '".$curp."%' and Plantel_cct_plantel LIKE '".$cct_plantel."%'")->result();
}


public function get_estudiante($no_control){
   $datos['estudiante'] = $this->db->get_where('Estudiante',array(
      'no_control' => $no_control
   ))->result();

   $datos['escuela_procedencia'] = $this->db->query("select Escuela_procedencia_cct_escuela_procedencia,tipo_escuela_procedencia,nombre_escuela_procedencia,tipo_subsistema from Estudiante_Escuela_procedencia as ee inner join Escuela_procedencia as ep on ee.Escuela_procedencia_cct_escuela_procedencia=ep.cct_escuela_procedencia where Estudiante_no_control='".$no_control."' order by tipo_escuela_procedencia desc")->result();

   $datos['tutor'] =$this->db->query("SELECT * from Estudiante_Tutor as et inner join Tutor as t on et.Tutor_id_tutor=t.id_tutor  where Estudiante_no_control='".$no_control."'")->result();

   $datos['expediente_medico'] = $this->db->query("SELECT * from Expediente_medico where Estudiante_no_control='".$no_control."'")->result();
   $datos['lengua_materna'] = $this->db->query("SELECT * from Datos_lengua_materna where Estudiante_no_control='".$no_control."'")->result();
   return $datos;
}

public function update_estudiante(
   $datos_estudiante,
   $datos_estudiante_tutor,
   $parentesco_estudiante_tutor,
   $datos_estudiante_lengua_materna,
   $datos_estudiante_medicos,
   $no_control,
   $id_tutor,
   $datos_escuela_procedencia
   ){

      

            //$this->db->trans_start();

            //tabla estudiante
            $this->db->where('no_control', $no_control);
            $this->db->update('Estudiante',$datos_estudiante);

            //tabla tutor
            $this->db->where('id_tutor', $id_tutor);
            $this->db->update('Tutor',$datos_estudiante_tutor);

            //tabla estudiante-tutor
            $this->db->where("Estudiante_no_control",$no_control);
            $this->db->update("Estudiante_Tutor",array(
               'parentesco' => $parentesco_estudiante_tutor
            ));


            
            foreach($datos_estudiante_medicos as $dato_medico){
               
               $this->db->where(array(
                  'Estudiante_no_control' =>$no_control,
                  'descripcion' => $dato_medico['descripcion']
               ));
               $this->db->update('Expediente_medico',$dato_medico);
            }
            
            
            
            foreach($datos_estudiante_lengua_materna as $dato_lengua){
               $this->db->where(array(
                  'Estudiante_no_control' => $no_control,
                  'descripcion' => $dato_lengua['descripcion']
               ));
               $this->db->update('Datos_lengua_materna',$dato_lengua);
            }

            
            $cct = $this->db->query("select cct_escuela_procedencia as cct from Escuela_procedencia as ep inner join Estudiante_Escuela_procedencia as eep on ep.cct_escuela_procedencia=eep.Escuela_procedencia_cct_escuela_procedencia where Estudiante_no_control='".$no_control."' and tipo_escuela_procedencia='SECUNDARIA'")->result()[0]->cct;
            $this->db->query("delete from Estudiante_Escuela_procedencia where Estudiante_no_control='".$no_control."' and Escuela_procedencia_cct_escuela_procedencia='".$cct."'");
            foreach($datos_escuela_procedencia as $escuela){
               $this->db->insert("Estudiante_Escuela_procedencia",$escuela);
            }
            

            //print_r($datos_escuela_procedencia);

            
         
            

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE)
            {
               return "no";
             //return "no";
            }
               
            else{
               return "si";
               //return "si";
            }
            

   
}

/**$this->db->query("DELETE 
   FROM Estudiante 
   WHERE (no_control = '".$no_control."'") */
function delete_estudiante($no_control){
   $this->db->trans_start();
   $this->db->where('no_control',$no_control);
   $this->db->delete('Estudiante');
   $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE)
            {
               return "no";
             //return "no";
            }
               
            else{
               return "si";
               //return "si";
            }
}



public function get_plantel_estudiante($no_control){
   return $this->db->query("SELECT * 
   FROM Estudiante as e inner join Plantel as p on e.Plantel_cct_plantel=p.cct_plantel 
   where no_control='".$no_control."'")->result();
}

function listar_aspirantes_xplantel($curp, $plantel){
   return $this->db->query(
      "select *,(SELECT count(*) noentregada FROM Documentacion d1 where d1.Estudiante_no_control=Estudiante.no_control and d1.entregado=0) as no_entregado,(SELECT count(*) nosubida FROM Documentacion d1 where d1.Estudiante_no_control=Estudiante.no_control and ruta is null or length(ruta)=0) as no_subida from Estudiante where Plantel_cct_plantel like'".$plantel."%' and curp like'".$curp."%' ")->result();


  }

  public function estudiantes_sin_matricula($curp, $plantel){

   return $this->db->query(
    "select * from Estudiante where Plantel_cct_plantel like'".$plantel."%' and curp like'".$curp."%' and matricula is null and tipo_ingreso not in('BAJA','NULIDAD SEMESTRE','DESERTOR');")->result();

}

public function obtener_fecha_inscripcion_semestre($no_control){
   //select fecha_inscripcion FROM Aspirante where no_control='CSEIIO1910002' 
   $this->db->select('semestre_ingreso,fecha_inscripcion');
   $this->db->from('Estudiante e');
   $this->db->where('e.no_control',$no_control);
   $consulta = $this->db->get();
   $resultado=$consulta->row();
   return $resultado;
   
   }

   public function obtener_ciclo_escolar($fecha){
      //SELECT fecha_matricula FROM ciclo_escolar where fecha_inicio<='2018-08-13' and fecha_termino>='2018-08-13'; 
      $this->db->select('fecha_matricula');
      $this->db->from('Ciclo_escolar c');
      $this->db->where('fecha_inicio_inscripcion<=\''.$fecha.'\' and fecha_terminacion>=\''.$fecha.'\'');
      $consulta = $this->db->get()->row();
      $resultado=0;
      if($consulta!=null)
      {
          $resultado=$consulta->fecha_matricula;
        
      }
  
      else{
         $resultado=null;
      }
      
      return $resultado;
      
      }
      public function numero_consecutivo_matricula($anio){
         //SELECT max(CONVERT(SUBSTRING(matricula,4,LENGTH(matricula)),SIGNED INTEGER)) as total FROM estudiante where matricula like '18%';
        $this->db->select('max(CONVERT(SUBSTRING(matricula,4,LENGTH(matricula)),SIGNED INTEGER)) as total');
        $this->db->from('Estudiante');
        $this->db->like('matricula',$anio,'after');
      
        $consulta = $this->db->get();
        $resultado=$consulta->row()->total;
        if($resultado==null){
          $resultado=1;
        }
        else{
          $resultado=$resultado+1;
        }
      
        return $resultado;
      }
      public function insertar_matricula($datos){
         $this->db->trans_start();
         $this->db->query("update Estudiante set matricula = '".$datos["matricula"]."' where no_control = '".$datos["no_control"]."' " );
         $this->db->trans_complete();
   
               if ($this->db->trans_status() === FALSE)
               {
                  return "no";
                }
                  
               else{
                  return $datos['matricula'];
                 
               }
   
     }
     
     public function estudiantes_portabilidad($curp, $plantel){

      return $this->db->query("select *,(select count(*) from Resolucion_equivalencia r where r.id_estudiante=e.no_control) as entregado from Estudiante e where e.Plantel_cct_plantel like'".$plantel."%' and e.curp like'".$curp."%' and semestre_ingreso>1")->result();
      
   }

   public function get_tipo_ingreso_estudiante($no_control){
      return $this->db->query("select tipo_ingreso from Estudiante where no_control='".$no_control."'")->result()[0]->tipo_ingreso;
   }


   public function get_estudiantes_porsibles_incorporados($plantel,$curp){
      return $this->db->query("select * from Estudiante where (tipo_ingreso='PROBABLE REINCORPORADO' or tipo_ingreso='DESERTOR') and Plantel_cct_plantel like '".$plantel."%' and curp like '".$curp."%'")->result();

   }




   public function incorporar_estudiante($datos){
      $this->db->trans_start();
      $tipo_ingreso = $this->db->query("select tipo_ingreso from Estudiante where no_control='".$datos->no_control."'")->result()[0]->tipo_ingreso;

      if($tipo_ingreso=='PROBABLE REINCORPORADO'){
         $this->db->query("update Estudiante set tipo_ingreso='INCORPORADO',semestre_en_curso=semestre_en_curso+1 where no_control='".$datos->no_control."'");
      }

      else if($tipo_ingreso=='DESERTOR'){
         $this->db->query("update Estudiante set tipo_ingreso='INCORPORADO' where no_control='".$datos->no_control."'");
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

   public function get_estudiantes_reprobados($plantel,$curp){
      return $this->db->query("select * from Estudiante where curp like '".$curp."%' and Plantel_cct_plantel like '".$plantel."%' and (tipo_ingreso='REPROBADO' or tipo_ingreso='BAJA')")->result();
   }

   public function reinscribir_reprobado($datos){
      $this->db->trans_start();
      $this->db->query("update Estudiante set tipo_ingreso='REPETIDOR' where no_control='".$datos->no_control."'");
      $materias_anular = $this->db->query("select Grupo_id_grupo as grupo,id_materia from Grupo_Estudiante as ge inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo where Estudiante_no_control='".$datos->no_control."' and semestre=(select semestre_en_curso from Estudiante where no_control='".$datos->no_control."')")->result();
      foreach($materias_anular as $materia){
         $this->db->query("update Grupo_Estudiante set calificacion_final=null where Estudiante_no_control='".$datos->no_control."' and id_materia='".$materia->id_materia."' and Grupo_id_grupo='".$materia->grupo."'");
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


  function get_estudiantes_probables_desertores($plantel,$curp){
     return $this->db->query("select * from Estudiante where tipo_ingreso = 'REINGRESO' and curp like '".$curp."%' and Plantel_cct_plantel like '".$plantel."%'")->result();
  }

  function set_desertor($no_control,$motivo_desercion,$fecha_desercion,$semestre,$grupo){
   $this->db->trans_start();

   $this->db->query("update Estudiante set tipo_ingreso='DESERTOR' where no_control='".$no_control."'");
   $data = array(
      'Estudiante_no_control' =>$no_control,
      'motivo' => $motivo_desercion,
      'fecha' => $fecha_desercion,
      'semestre' => $semestre,
      'grupo' => $grupo
);

$this->db->insert('Desertor', $data);

   $this->db->trans_complete();
   
   if ($this->db->trans_status() === FALSE)
   {
      return "no";
    }
      
   else{
      return "si";
     
   }
  }



  function set_baja($datos){
   $this->db->trans_start();

   $this->db->query("update Estudiante set tipo_ingreso='BAJA' where no_control='".$datos->no_control."'");
   $this->db->query("insert into Baja (motivo,Estudiante_no_control,fecha,observacion) values ('".$datos->motivo."','".$datos->no_control."','".$datos->fecha."','".$datos->observacion."')");
   $folio = $this->db->query("select max(Friae_folio) as folio from Friae_Estudiante as a where a.Estudiante_no_control='".$datos->no_control."'")->result()[0]->folio;
   $this->db->query("update Friae_Estudiante set baja='".$datos->fecha."' where Estudiante_no_control='".$datos->no_control."' and Friae_folio=".$folio);

   $this->db->trans_complete();
   
   if ($this->db->trans_status() === FALSE)
   {
      return "no";
    }
      
   else{
      return "si";
     
   }
  }

///----------------------------------------------------------------------------------

public function get_estudiantes_derecho_a_traslado($curp, $plantel){

   return $this->db->query("select *,(SELECT count(*)-SUM(CASE
   WHEN d.entregado = 1 THEN 1
   ELSE 0
END) from Documentacion d inner join Documento doc on d.id_documento=doc.id_documento where d.Estudiante_no_control=e.no_control and doc.tipo='base') as faltantes from Estudiante e left join Plantel p on p.cct_plantel=e.Plantel_cct_plantel left join (select ge.Estudiante_no_control, ge.Grupo_id_grupo,g.nombre_grupo,sum(CASE
   WHEN ge.primer_parcial>=0 THEN 1
   ELSE 0
END) num_primer_parcial,sum(CASE
   WHEN ge.segundo_parcial>=0 THEN 1
   ELSE 0
END) num_segundo_parcial,sum(CASE
   WHEN ge.tercer_parcial>=0 THEN 1
   ELSE 0
END) num_tercer_parcial,sum(CASE
   WHEN ge.examen_final>=0 THEN 1
   ELSE 0
END) num_examen_final,sum(CASE
   WHEN ge.calificacion_final>=0 THEN 1
   ELSE 0
END) num_calificacion_final from Grupo_Estudiante ge LEFT JOIN Grupo g on g.id_grupo=ge.Grupo_id_grupo where g.estatus=1 group by ge.Estudiante_no_control) otro on otro.Estudiante_no_control=e.no_control
where e.Plantel_cct_plantel like'".$plantel."%' and e.curp like'".$curp."%' and e.tipo_ingreso not in ('BAJA','DESERTOR') order by e.semestre_en_curso, concat(e.nombre,' ',e.primer_apellido,' ',e.segundo_apellido);")->result();
  }


/*public function get_estudiante_traslado($no_control){

  return $this->db->query("select * from Estudiante e
LEFT JOIN Plantel p on p.cct_plantel=e.Plantel_cct_plantel
LEFT JOIN Grupo_estudiante ge on e.no_control=ge.Estudiante_no_control
LEFT JOIN Grupo g on g.id_grupo=ge.Grupo_id_grupo
where e.no_control='".$no_control."' and g.estatus=1 or g.estatus is null group by e.no_control;")->result();

}*/



public function realizar_traslado_estudiante($no_control,
           $cct_plantel_traslado,
           $cct_plantel_origen,
           $datos_estudiante_documentos,
           $id_grupo,
           $id_grupo_destino,
           $id_friae_origen,
           $id_friae_destino,
           $tipo_ingreso,
           $grupo,
           $semestre_en_curso){

           
           
           $this->db->trans_start();

           if($tipo_ingreso!='DESERTOR'){
                  
                  $data = array(
                     'Estudiante_no_control' =>$no_control,
                     'motivo' => "SE CAMBIO A OTRO PLANTEL",
                     'fecha' =>date('Y-m-d'),
                     'semestre' => $semestre_en_curso,
                     'grupo' => $grupo
               );
               
               $this->db->insert('Desertor', $data);

           }
           
           $this->db->set('Estudiante_no_control', $no_control);
           $this->db->set('cct_plantel_origen', $cct_plantel_origen);
           $this->db->set('id_grupo_origen', $id_grupo);
           $this->db->set('cct_plantel_traslado', $cct_plantel_traslado);
           $this->db->set('id_grupo_traslado', $id_grupo_destino);
           $this->db->set('fecha_tramite',date('Y-m-d'));
           $this->db->insert('Traslado');
           
           foreach($datos_estudiante_documentos as $documento){
              $this->db->insert('Documentacion',$documento);
           }

            if($id_grupo_destino!=''){

               $materias_estudiante = $this->db->query("select id_materia,id_asesor,Grupo_id_grupo from Grupo_Estudiante where Grupo_id_grupo='".$id_grupo_destino."' group by id_materia;")->result();
               
                 $this->db->set('Grupo_id_grupo',$id_grupo_destino);
                 $this->db->where('Estudiante_no_control',$no_control);
                 $this->db->where('Grupo_id_grupo',$id_grupo);
                 $this->db->update('Grupo_Estudiante');

                 

                 foreach($materias_estudiante as $m){

                        $this->db->set('id_asesor',$m->id_asesor);
                        $this->db->where('Estudiante_no_control',$no_control);
                        $this->db->where('id_materia',$m->id_materia);
                         $this->db->where('Grupo_id_grupo',$m->Grupo_id_grupo);
                         $this->db->update('Grupo_Estudiante');
                   }

                    
            }


            if($id_friae_destino!=''){
                 $this->db->set('Friae_folio',$id_friae_destino);
                 $this->db->set('tipo_ingreso_inscripcion','TRASLADO');
                 
                 $this->db->where('Estudiante_no_control',$no_control);
                 $this->db->where('Friae_folio',$id_friae_origen);
                 $this->db->update('Friae_Estudiante');
                    
            }

           $this->db->set('Plantel_cct_plantel',$cct_plantel_traslado);
           $this->db->set('tipo_ingreso',"TRASLADO");
           $this->db->where('no_control',$no_control);
           $this->db->update('Estudiante');

           



           $this->db->trans_complete();

           if ($this->db->trans_status() === FALSE)
           {
              return "no";
            
           }
              
           else{
              return "si";
             
           }


           //return "si";



}








public function get_estudiante_datos_semestre_grupo($no_control){

  return $this->db->query("select * from Estudiante e
LEFT JOIN Plantel p on p.cct_plantel=e.Plantel_cct_plantel left join (select * from Grupo_Estudiante ge LEFT JOIN Grupo g on g.id_grupo=ge.Grupo_id_grupo where g.estatus=1 group by ge.Estudiante_no_control) datos_escuela on e.no_control=datos_escuela.Estudiante_no_control
where e.no_control='".$no_control."';")->result();

}



public function get_estudiante_datos_semestre_grupo_calificacion($no_control){

  return $this->db->query("select *,(SELECT count(*)-SUM(CASE
  WHEN d.entregado = 1 THEN 1
  ELSE 0
END) from Documentacion d inner join Documento doc on d.id_documento=doc.id_documento where d.Estudiante_no_control=e.no_control and doc.tipo='base' ) as faltantes from Estudiante e left join Plantel p on p.cct_plantel=e.Plantel_cct_plantel left join (select ge.Estudiante_no_control, g.id_grupo,g.nombre_grupo,sum(CASE
  WHEN ge.primer_parcial>=0 THEN 1
  ELSE 0
END) num_primer_parcial,sum(CASE
  WHEN ge.segundo_parcial>=0 THEN 1
  ELSE 0
END) num_segundo_parcial,sum(CASE
  WHEN ge.tercer_parcial>=0 THEN 1
  ELSE 0
END) num_tercer_parcial,sum(CASE
  WHEN ge.examen_final>=0 THEN 1
  ELSE 0
END) num_examen_final,sum(CASE
  WHEN ge.calificacion_final>=0 THEN 1
  ELSE 0
END) num_calificacion_final from Grupo_Estudiante ge LEFT JOIN Grupo g on g.id_grupo=ge.Grupo_id_grupo where g.estatus=1 group by ge.Estudiante_no_control) otro on otro.Estudiante_no_control=e.no_control
where e.no_control='".$no_control."';")->result();

}


public function get_estudiantes_porsibles_traslados($matricula,$curp){
   return $this->db->query("select * from Estudiante where tipo_ingreso in ('DESERTOR','REINGRESO') and curp='".$curp."' or matricula='".$matricula."';")->result();

}


public function generar_lista_desercion($plantel,$fecha_inicio,$fecha_fin,$id_ciclo){
   //return $this->db->query("SELECT e.nombre,e.primer_apellido,e.segundo_apellido,d.semestre,d.grupo,d.motivo FROM Desertor d inner join Estudiante e on d.Estudiante_no_control=e.no_control where e.Plantel_cct_plantel='".$plantel."' and d.fecha between '".$fecha_inicio."' and '".$fecha_fin."' order by d.semestre,d.grupo, e.primer_apellido,e.segundo_apellido,e.nombre")->result();
   return $this->db->query("SELECT e.nombre,e.primer_apellido,e.segundo_apellido,d.semestre,d.grupo,d.motivo FROM Desertor d inner join Estudiante e on d.Estudiante_no_control=e.no_control inner join (SELECT distinct ge.Estudiante_no_control FROM Grupo_Estudiante ge inner join Grupo g on ge.Grupo_id_grupo=g.id_grupo where ge.Ciclo_escolar_id_ciclo_escolar=".$id_ciclo." and g.plantel='".$plantel."') grupo_anterior on grupo_anterior.Estudiante_no_control=d.Estudiante_no_control where e.Plantel_cct_plantel='".$plantel."' and d.fecha between '".$fecha_inicio."' and '".$fecha_fin."' order by d.semestre,d.grupo, e.primer_apellido,e.segundo_apellido,e.nombre")->result();

}


}
?>