<?php
class M_friae extends CI_Model { 
   public function __construct() {
      parent::__construct();
      $this->load->model("M_regularizacion");
      $this->load->model("M_plantel");
   }

   public function actualizar($parametros){
    $this->db->trans_complete();
    $semestre_anterior=intval($parametros->semestre)-1;
 
 if($parametros->periodo=="AGOSTO-ENERO"){
 
    if(intval($parametros->semestre)==1){
 
       if($parametros->realizo_examen_final=="si"){

       
       $situacion_fin_modulo='REINGRESO';
       $num_adeudos_fin_modulo=0;
       $materias_adeudo_fin_modulo='';
       $adeudos_sin_regu_enero=$this->db->query("SELECT * FROM Grupo_Estudiante ge inner join Grupo g on g.id_grupo=ge.Grupo_id_grupo where g.semestre=1 and Estudiante_no_control='".$parametros->no_control."' and calificacion_final>0 and calificacion_final<=5 and calificacion_final IS NOT NULL and id_materia not in (SELECT id_materia FROM Regularizacion where fecha_calificacion<'".$parametros->anio_termino."-01-01' and Estudiante_no_control='".$parametros->no_control."' and calificacion>=6);")->result();
 
       $num_adeudos_fin_modulo=count($adeudos_sin_regu_enero);

       foreach($adeudos_sin_regu_enero as $id){
        $materias_adeudo_fin_modulo.=$id->id_materia.",";
    }
    $materias_adeudo_fin_modulo=trim($materias_adeudo_fin_modulo,',');
 
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
 
       
 
       
      $situacion_despues_regu='REINGRESO';
      $num_adeudos_despues_regu=0;
      $materias_adeudo_despues_regu='';
       $adeudos_despues_regu_enero=$this->db->query("SELECT * FROM Grupo_Estudiante ge inner join Grupo g on g.id_grupo=ge.Grupo_id_grupo where g.semestre=1 and Estudiante_no_control='".$parametros->no_control."' and calificacion_final>0 and calificacion_final<=5 and calificacion_final IS NOT NULL and id_materia not in (SELECT id_materia FROM Regularizacion where fecha_calificacion<'".$parametros->anio_termino."-02-01' and Estudiante_no_control='".$parametros->no_control."' and calificacion>=6);")->result();
       $num_adeudos_despues_regu=count($adeudos_despues_regu_enero);

       foreach($adeudos_despues_regu_enero as $id){
        $materias_adeudo_despues_regu.=$id->id_materia.",";
    }
    $materias_adeudo_despues_regu=trim($materias_adeudo_despues_regu,',');
 
       if($num_adeudos_despues_regu>0 && $num_adeudos_despues_regu<=3){
          $situacion_despues_regu='REINGRESO';// equivale a irregular
       }
 
 
       if($num_adeudos_despues_regu>3 && $num_adeudos_despues_regu<=5){
          $situacion_despues_regu='SIN DERECHO';// equivale a irregular
       }
 
       if($num_adeudos_despues_regu>=6){
          $situacion_despues_regu='REPROBADO';// equivale a irregular
          $materias_adeudo_despues_regu="";
       }
 
      
 
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
 
      $adeudos_con_regu_octubre=$this->db->query("SELECT * FROM Grupo_Estudiante ge inner join Grupo g on g.id_grupo=ge.Grupo_id_grupo where g.semestre<=".$semestre_anterior." and Estudiante_no_control='".$parametros->no_control."' and calificacion_final>0 and calificacion_final<=5 and calificacion_final IS NOT NULL and id_materia not in (SELECT id_materia FROM Regularizacion where fecha_calificacion<'".$parametros->anio_inicio."-11-01' and Estudiante_no_control='".$parametros->no_control."' and calificacion>=6);")->result();
 
      $num_adeudos_regu_octubre=count($adeudos_con_regu_octubre);
 
      foreach($adeudos_con_regu_octubre as $id){
       $materias_adeudo_regu_octubre.=$id->id_materia.",";
   }
 
 
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
 
      $adeudos_con_regu_enero=$this->db->query("SELECT * FROM Grupo_Estudiante ge inner join Grupo g on g.id_grupo=ge.Grupo_id_grupo where g.semestre<=".$parametros->semestre." and Estudiante_no_control='".$parametros->no_control."' and calificacion_final>0 and calificacion_final<=5 and calificacion_final IS NOT NULL and id_materia not in (SELECT id_materia FROM Regularizacion where fecha_calificacion<'".$parametros->anio_termino."-02-01' and Estudiante_no_control='".$parametros->no_control."' and calificacion>=6);")->result();
 
      $num_adeudos_regu_enero=count($adeudos_con_regu_enero);
 
      foreach($adeudos_con_regu_enero as $id){
       $materias_adeudo_regu_enero.=$id->id_materia.",";
   }
 
    if($num_adeudos_fin_modulo>0 && $num_adeudos_fin_modulo<=3){
       $situacion_fin_modulo='REINGRESO';// equivale a irregular
       }
 
       if($num_adeudos_fin_modulo>3 && $num_adeudos_fin_modulo<=5){
          $situacion_fin_modulo='SIN DERECHO';// equivale a irregular
       }
 
       if($num_adeudos_fin_modulo>=6){
          $situacion_fin_modulo='REPROBADO';// SIN DERECHO
       }
 
 
       if($num_adeudos_regu_enero>0 && $num_adeudos_regu_enero<=3){
          $estatus_final='REINGRESO';// equivale a irregular
          }
    
          if($num_adeudos_regu_enero>3 && $num_adeudos_regu_enero<=5){
             $estatus_final='SIN DERECHO';// equivale a irregular
          }
    
          if($num_adeudos_regu_enero>=6){
             $estatus_final='REPROBADO';// SIN DERECHO
          }
 
 
 
         $datos = array(
             //'tipo_ingreso_inscripcion' => $tipo_ingreso_modulo,
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
          //'tipo_ingreso_inscripcion' => $tipo_ingreso_modulo,
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


   public function cerrar_friae($plantel){
    $this->db->trans_start();
    $grupos_plantel = $this->M_plantel->get_grupos_plantel($plantel);
    $examen_final=$this->db->query("select * from Grupo_Estudiante as ge inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo where estatus=1 and calificacion_final is not null and plantel='".$plantel."'")->result();
    $realizo_examen_final=(count( $examen_final)>0)? "si": "no";
    foreach($grupos_plantel as $grupo){
        $estudiante = $this->db->query("SELECT * FROM Grupo_Estudiante ge inner join Ciclo_escolar c on ge.Ciclo_escolar_id_ciclo_escolar=c.id_ciclo_escolar inner join Grupo g on g.id_grupo=ge.Grupo_id_grupo where Grupo_id_grupo='".$grupo->id_grupo."' group by Estudiante_no_control;")->result();
        foreach($estudiante as $e){
            $friae=$this->id_friae($e->id_grupo)[0]->folio;
            $detalle_friae = $this->db->query("select * from Friae_Estudiante where Estudiante_no_control='".$e->Estudiante_no_control."' and Friae_folio=".$friae)->result();

           if( $detalle_friae[0]->tipo_ingreso_fin_semestre!='BAJA'){

           

                    $valores = explode('-',$e->fecha_inicio);
                    $valores2 = explode('-',$e->fecha_terminacion);
                            
                    $anio_inicio=$valores[0];
                    $anio_terminacion=$valores2[0];
                    
                    $parametros_friae= array(
                        'anio_inicio' => $anio_inicio,
                        'anio_termino' => $anio_terminacion,
                        'fecha_termino'=>$e->fecha_terminacion,
                        'semestre' =>$e->semestre,
                        'no_control'=>$e->Estudiante_no_control,
                        'id_friae'=>$friae,
                        'periodo'=>$e->periodo,
                        'realizo_examen_final'=>$realizo_examen_final
                    
                        
                    );
                    $this->actualizar((object)$parametros_friae);
            }
            else{
                
                $this->db->query("update Friae_Estudiante set tipo_ingreso_fin_semestre='BAJA',adeudos_fin_semestre=0, id_materia_adeudos_fin_semestre='',adeudos_segunda_regularizacion=0,id_materia_adeudos_segunda_regularizacion='',tipo_ingreso_despues_regularizacion='BAJA' where Estudiante_no_control='".$e->Estudiante_no_control."' and Friae_folio=".$friae);
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






   public function crear_friae_ciclos_anteriores($id){
    $insert_id="";
    
    $this->db->trans_start();
    $this->db->query("insert into Friae (id_grupo) values ('".$id."')");
    $insert_id = $this->db->insert_id();

    $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
            $insert_id="";
         return $insert_id;
        }

        else{
            return $insert_id;
        }
   }


   public function quitar_estudiante($datos){
    $this->db->trans_start();
    $folio = $this->db->query("select folio from Friae where id_grupo='".$datos->id_grupo."'")->result()[0]->folio;
    foreach($datos->eliminados as $estudiante){
        $this->db->query("delete from Friae_Estudiante where Estudiante_no_control='".$estudiante."' and Friae_folio=".$folio);
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


   public function crear_friae($datos){
    //--------------
    if($datos->grupo->semestre<5){
        $id = $datos->grupo->plantel.$datos->grupo->semestre.$datos->grupo->ciclo_escolar.$datos->grupo->periodo.mb_strtoupper($datos->grupo->nombre_grupo);
    }

    else{
        $valor_option = $datos->grupo->componente;
        $id_componente = explode("-",$valor_option)[0];
        $nombre_corto_componente = explode("-",$valor_option)[1];
        $id = $datos->grupo->plantel.$datos->grupo->semestre.$datos->grupo->ciclo_escolar.$datos->grupo->periodo.mb_strtoupper($datos->grupo->nombre_grupo).'-'.$nombre_corto_componente;
    }

    

  
    //----------------
    
    $this->db->trans_start();
    $this->db->query("insert into Friae (id_grupo) values ('".$id."')");
    $insert_id = $this->db->insert_id();

    $estudiantes_grupo = $this->db->query("select distinct no_control,tipo_ingreso,estatus from Grupo_Estudiante as ge inner join Estudiante as e on ge.Estudiante_no_control=e.no_control where Grupo_id_grupo='".$id."'")->result();

    foreach($estudiantes_grupo as $estudiante_materia){

        //$materias_debiendo = $this->db->query("select id_materia from Grupo_Estudiante where calificacion_final<6 and Estudiante_no_control='".$estudiante_materia->no_control."' and id_materia not in (select id_materia from Regularizacion where calificacion>=6 and Estudiante_no_control='".$estudiante_materia->no_control."')")->result();//------------------------------------------------------------------------------------
        $materias_debiendo = $this->M_regularizacion->materias_debe_estudiante_actualmente($estudiante_materia->no_control);

        $materias_id = "";
        foreach($materias_debiendo as $id_materia){
            $materias_id.=$id_materia->id_materia.',';
        }
        $materias_id = substr($materias_id,0,-1);
        $this->db->query("insert into Friae_Estudiante (Friae_folio,Estudiante_no_control,tipo_ingreso_inscripcion,estatus_inscripcion,numero_adeudos_inscripcion,id_materia_adeudos_inscripcion)
                            values (".$insert_id.",'".$estudiante_materia->no_control."','".$estudiante_materia->tipo_ingreso."','".$estudiante_materia->estatus."',".sizeof($materias_debiendo).",'".$materias_id."')");

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



    public function agregar_estudiantes_friae($datos){
        //var_dump($datos);

        $this->db->trans_start();

        if($datos->semestre<5){
            $id_grupo=$datos->id_grupo;
        }
    
        else{
            //$materias = $this->M_materia->get_materias_semestre_componente($datos->semestre,$datos->id_componente);
            $id_grupo=$datos->id_grupo.'-'.$datos->componente;
        }

        foreach($datos->estudiantes as $estudiante){
            $datos_estudiante = $this->db->query("select * from Estudiante where no_control='".$estudiante."'")->result();

            $materias_debiendo = $this->M_regularizacion->materias_debe_estudiante_actualmente($estudiante);


            $materias_id = "";
            foreach($materias_debiendo as $id_materia){
                $materias_id.=$id_materia->id_materia.',';
            }
            $materias_id = substr($materias_id,0,-1);

            
            $folio_friae = $this->db->query("select folio from Friae where id_grupo='".$id_grupo."'")->result()[0]->folio;
            $this->db->query("insert into Friae_Estudiante (Friae_folio,Estudiante_no_control,tipo_ingreso_inscripcion,estatus_inscripcion,numero_adeudos_inscripcion,id_materia_adeudos_inscripcion)
                                values (".$folio_friae.",'".$estudiante."','".$datos_estudiante[0]->tipo_ingreso."','".$datos_estudiante[0]->estatus."',".sizeof($materias_debiendo).",'".$materias_id."')");

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


    function get_estudiantes_friae($grupo){
        return $this->db->query("select distinct Estudiante_no_control as no_control,id_grupo as grupo from Friae as f inner join Friae_Estudiante as fe on f.folio=fe.Friae_folio inner join Estudiante as e on e.no_control=fe.Estudiante_no_control where id_grupo='".$grupo."' order by e.primer_apellido,e.segundo_apellido,e.nombre")->result();
    }

    function get_materias_estudiante_friae($grupo,$no_control){
        return $this->db->query("select * from Grupo_Estudiante as ge inner join Materia as m on ge.id_materia=m.clave where Estudiante_no_control='".$no_control."' and Grupo_id_grupo='".$grupo."' group by id_materia order by NULL")->result();
    }

    function get_datos_friae_estudiante($grupo,$no_control){
        return $this->db->query("select * from Friae_Estudiante as fe inner join Friae as f on fe.Friae_folio=f.folio where id_grupo='".$grupo."' and Estudiante_no_control='".$no_control."'")->result();
    }

    function get_datos_estudiante($no_control){
        return $this->db->query("select * from Estudiante where no_control='".$no_control."'")->result()[0];
    }

    function get_datos_friae($grupo){
        return $this->db->query("select nombre_largo, nombre_plantel,cct_plantel,nombre_localidad,nombre_municipio,nombre_estado,nombre_distrito,semestre,nombre_ciclo_escolar,nombre_grupo from Grupo as g inner join Grupo_Estudiante as ge on g.id_grupo=ge.Grupo_id_grupo inner join Plantel as p on p.cct_plantel=g.plantel inner join Ciclo_escolar as ce on ce.id_ciclo_escolar=ge.Ciclo_escolar_id_ciclo_escolar inner join Localidad as l on l.id_localidad=p.id_localidad_plantel inner join Municipio as m on m.id_municipio=l.Municipio_id_municipio inner join Estado e on m.Estado_id_estado=e.id_estado inner join Distrito as d on m.Distrito_id_distrito=d.id_distrito where g.id_grupo='".$grupo."' limit 1")->result()[0];
    }

    ///////////////////////// inicia operación panzer.......................................

    public function id_friae($id_grupo){

        return $this->db->query("SELECT * FROM Friae where id_grupo='".$id_grupo."';")->result();
        
     }

     function nombre_materias_friae($grupo){
        return $this->db->query("select id_materia,UPPER(unidad_contenido) unidad_contenido from Grupo_Estudiante ge inner join Materia m on ge.id_materia=m.clave where Grupo_id_grupo='".$grupo."' group by id_materia")->result();
    }

    function get_revisor($cct){
        return $this->db->query("SELECT * FROM Plantel p  LEFT JOIN Revisor r on p.id_revisor=r.idrevisor where p.cct_plantel='".$cct."';")->result();
    }



    public function actualizar_friae_baja_ciclos_anteriores($parametros){


        $this->db->trans_start();
        $semestre_anterior=intval($parametros->semestre)-1;
        $datos = array();

        if($parametros->periodo=="AGOSTO-ENERO"){
            if(intval($parametros->semestre)!=1){
                $tipo_ingreso_modulo='REINGRESO';
                $estatus_inscripcion='REGULAR';
                $num_adeudos_inicio_modulo=0;
                $materias_adeudo_inicio_modulo='';

                $num_adeudos_regu_octubre=0;
                $materias_adeudo_regu_octubre='';

                $adeudos_sin_regu_octubre=$this->db->query("SELECT * FROM Grupo_Estudiante ge inner join Grupo g on g.id_grupo=ge.Grupo_id_grupo where g.semestre<=".$semestre_anterior." and Estudiante_no_control='".$parametros->no_control."' and calificacion_final>0 and calificacion_final<=5 and calificacion_final IS NOT NULL and id_materia not in (SELECT id_materia FROM Regularizacion where fecha_calificacion<'".$parametros->anio_baja."-10-01' and Estudiante_no_control='".$parametros->no_control."' and calificacion>=6);")->result();

                $num_adeudos_inicio_modulo=count($adeudos_sin_regu_octubre);
                if($num_adeudos_inicio_modulo>0){
                    $estatus_inscripcion='IRREGULAR';

                }

                foreach($adeudos_sin_regu_octubre as $id){
                    $materias_adeudo_inicio_modulo.=$id->id_materia.",";
                }

                $materias_adeudo_inicio_modulo=trim($materias_adeudo_inicio_modulo,',');
                $adeudos_con_regu_octubre=$this->db->query("SELECT * FROM Grupo_Estudiante ge inner join Grupo g on g.id_grupo=ge.Grupo_id_grupo where g.semestre<=".$semestre_anterior." and Estudiante_no_control='".$parametros->no_control."' and calificacion_final>0 and calificacion_final<=5 and calificacion_final IS NOT NULL and id_materia not in (SELECT id_materia FROM Regularizacion where fecha_calificacion<'".$parametros->anio_baja."-11-01' and Estudiante_no_control='".$parametros->no_control."' and calificacion>=6);")->result();

                $num_adeudos_regu_octubre=count($adeudos_con_regu_octubre);

                foreach($adeudos_con_regu_octubre as $id){
                $materias_adeudo_regu_octubre.=$id->id_materia.",";
                }
                $materias_adeudo_regu_octubre=trim($materias_adeudo_regu_octubre,',');

                $datos = array(
                    'tipo_ingreso_inscripcion' => $tipo_ingreso_modulo,
                    'estatus_inscripcion' => $estatus_inscripcion,
                    'numero_adeudos_inscripcion' => $num_adeudos_inicio_modulo,
                    'id_materia_adeudos_inscripcion' => $materias_adeudo_inicio_modulo,
                    'adeudos_primera_regularizacion' => $num_adeudos_regu_octubre,
                    'id_materia_adeudos_primera_regularizacion' => $materias_adeudo_regu_octubre,
                    'baja' => $parametros->fecha_baja,
                    'tipo_ingreso_fin_semestre' => 'BAJA'
        
                );

            }
            
        }

        if($parametros->periodo=="FEBRERO-JULIO"){

            $tipo_ingreso_modulo='REINGRESO';
            $estatus_inscripcion='REGULAR';
            $num_adeudos_inicio_modulo=0;
            $materias_adeudo_inicio_modulo='';

            $num_adeudos_regu_mayo=0;
            $materias_adeudo_regu_mayo='';

            
            

            $adeudos_sin_regu_mayo=$this->db->query("SELECT * FROM Grupo_Estudiante ge inner join Grupo g on g.id_grupo=ge.Grupo_id_grupo where g.semestre<=".$semestre_anterior." and Estudiante_no_control='".$parametros->no_control."' and calificacion_final>0 and calificacion_final<=5 and calificacion_final IS NOT NULL and id_materia not in (SELECT id_materia FROM Regularizacion where fecha_calificacion<'".$parametros->anio_baja."-05-01' and Estudiante_no_control='".$parametros->no_control."' and calificacion>=6);")->result();

            $num_adeudos_inicio_modulo=count($adeudos_sin_regu_mayo);
            if($num_adeudos_inicio_modulo>0){
                $estatus_inscripcion='IRREGULAR';

            }

            foreach($adeudos_sin_regu_mayo as $id){
                $materias_adeudo_inicio_modulo.=$id->id_materia.",";
            }

            $materias_adeudo_inicio_modulo=trim($materias_adeudo_inicio_modulo,',');

            $adeudos_con_regu_mayo=$this->db->query("SELECT * FROM Grupo_Estudiante ge inner join Grupo g on g.id_grupo=ge.Grupo_id_grupo where g.semestre<=".$semestre_anterior." and Estudiante_no_control='".$parametros->no_control."' and calificacion_final>0 and calificacion_final<=5 and calificacion_final IS NOT NULL and id_materia not in (SELECT id_materia FROM Regularizacion where fecha_calificacion<'".$parametros->anio_baja."-06-01' and Estudiante_no_control='".$parametros->no_control."' and calificacion>=6);")->result();

            $num_adeudos_regu_mayo=count($adeudos_con_regu_mayo);

            foreach($adeudos_con_regu_mayo as $id){
            $materias_adeudo_regu_mayo.=$id->id_materia.",";
            }

            $materias_adeudo_regu_mayo=trim($materias_adeudo_regu_mayo,',');
            $datos = array(
                'tipo_ingreso_inscripcion' => $tipo_ingreso_modulo,
                'estatus_inscripcion' => $estatus_inscripcion,
                'numero_adeudos_inscripcion' => $num_adeudos_inicio_modulo,
                'id_materia_adeudos_inscripcion' => $materias_adeudo_inicio_modulo,
                'adeudos_primera_regularizacion' => $num_adeudos_regu_mayo,
                'id_materia_adeudos_primera_regularizacion' => $materias_adeudo_regu_mayo,
                'baja' => $parametros->fecha_baja,
                'tipo_ingreso_fin_semestre' => 'BAJA'
    
            );


        }

        
       $this->db->where('Estudiante_no_control',$parametros->no_control);
        $this->db->where('Friae_folio',$parametros->id_friae);
        $this->db->update('Friae_Estudiante',$datos);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
            return "no";
        }

        else{
            return "si";
        }
      
   }





   public function agregar_estudiante_friae_ciclos_anteriores($datos){
    //var_dump($datos);

    $this->db->trans_start();


   /* semestre*/

            $datos_estudiante = $this->db->query("select * from Estudiante where no_control='".$datos->no_control."'")->result();

            if($datos->semestre>1){
                $datos = array(
                    'Friae_folio' => $datos->id_friae,
                    'Estudiante_no_control'=>$datos->no_control,
                    'tipo_ingreso_inscripcion'=>$datos_estudiante[0]->tipo_ingreso,
                    'estatus_inscripcion'=>$datos_estudiante[0]->estatus
                );
            }

            else{
                $datos = array(
                    'Friae_folio' => $datos->id_friae,
                    'Estudiante_no_control'=>$datos->no_control,
                    'tipo_ingreso_inscripcion'=>$datos_estudiante[0]->tipo_ingreso,
                    'estatus_inscripcion'=>'',
                    'numero_adeudos_inscripcion'=>0,
                    'id_materia_adeudos_inscripcion'=>''

                    
                );

            }
            
                
    $this->db->insert('Friae_Estudiante', $datos);


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