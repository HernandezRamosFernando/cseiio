<?php
class M_reinscripcion extends CI_Model { 
    
   public function __construct() {
      parent::__construct();
      $this->load->model('M_grupo_estudiante');
      $this->load->model("M_regularizacion");
   }


   public function estudiantes_en_grupos_activos(){
       return $this->db->query("select no_control,estatus,tipo_ingreso from Estudiante as e inner join (select distinct Estudiante_no_control from Grupo_Estudiante as ge inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo  where g.estatus=1) as g on e.no_control=g.Estudiante_no_control")->result();
   }

   public function estudiantes_en_grupo_plantel($plantel){
        return  $this->db->query("select distinct Estudiante_no_control,tipo_ingreso from Grupo_Estudiante as ge inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo inner join Estudiante as e on e.no_control=ge.Estudiante_no_control where g.estatus=1 and plantel='".$plantel."'")->result();
   }

   public function get_materias_cursando_estudiante_actual($no_control){
    return $this->db->query("select * from Grupo_Estudiante as ge inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo where estatus=1 and Estudiante_no_control='".$no_control."'")->result();
   }

  

   public function cerrar_calificaciones_plantel($plantel){
    $this->db->trans_start();
    $estudiantes_grupo = $this->estudiantes_en_grupo_plantel($plantel);//estudiantes que tienen grupo en ese plantel
    $this->db->query("update Regularizacion set estatus=0 where Plantel_cct_plantel='".$plantel."'");//desactiva las regularizaciones en ese plantel para poder abrir las segundas
//estatus
    foreach($estudiantes_grupo as $estudiante){//de cada estudiante necesito sus materias
        $folio = $this->db->query("select max(Friae_folio) as folio from Friae_Estudiante where Estudiante_no_control='".$estudiante->Estudiante_no_control."'")->result()[0]->folio;//folio del friae del estudiante del grupo actual
        if($estudiante->tipo_ingreso!="BAJA"){//if de si es baja
        $materias_debe = $this->M_regularizacion->materias_debe_estudiante_actualmente($estudiante->Estudiante_no_control);// materias que debe  incluyendo las del grupo actual porque ya se calificaron
        $materias_ids="";
        foreach($materias_debe as $id){
            $materias_ids.=$id->id_materia.",";//string de las claves de materias
        }

        $materias_ids = substr($materias_ids,0,-1);

        $this->db->query("update Friae_Estudiante set adeudos_primera_regularizacion=".sizeof($materias_debe).",id_materia_adeudos_primera_regularizacion='".$materias_ids."' where Estudiante_no_control='".$estudiante->Estudiante_no_control."' and Friae_folio=".$folio);

        //rellenar calificaciones finales
        $materias = $this->get_materias_cursando_estudiante_actual($estudiante->Estudiante_no_control);//materias de cada estudiante
            foreach($materias as $materia){
                $primer_parcial = $materia->primer_parcial==null?0:intval($materia->primer_parcial);//primer parcial de la materia
                $segundo_parcial = $materia->segundo_parcial==null?0:intval($materia->segundo_parcial);//segundo parcial de la materia
                $tercer_parcial = $materia->tercer_parcial==null?0:intval($materia->tercer_parcial);//tercer parcial de la materia
                $examen_final = $materia->examen_final==null?0:intval($materia->examen_final);//examen final 
    
                $promedio_modular = ($primer_parcial+$segundo_parcial+$tercer_parcial)/3;

                //$promedio = (intval($estudiante->primer_parcial)+intval($estudiante->segundo_parcial)+intval($estudiante->tercer_parcial))/3;
            if($promedio_modular>0 && $promedio_modular<6){
                $promedio_modular=5;
            }
            else{
                $promedio_modular = round($promedio_modular,0,PHP_ROUND_HALF_UP);
            }


                $promedio_final = ($promedio_modular+$examen_final)/2;

                if($promedio_final>0 && $promedio_final<6){
                    $promedio_final=5;
                }
                else{
                    $promedio_final = round($promedio_final,0,PHP_ROUND_HALF_UP);
                }
                //$promedio_final = round($promedio_final,0,PHP_ROUND_HALF_UP);
    
                $this->db->query("update Grupo_Estudiante set calificacion_final=".$promedio_final." where id_materia='".$materia->id_materia."' and Estudiante_no_control='".$estudiante->Estudiante_no_control."'");//agrega las calificaciones finales a cada materia
            }

            //estatus despues de haber calificado (calcular calificacion final)
            $materias_debe = $this->M_regularizacion->materias_debe_estudiante_actualmente($estudiante->Estudiante_no_control);// materias que debe  incluyendo las del grupo actual porque ya se calificaron
            $materias_ids="";
            foreach($materias_debe as $id){
                $materias_ids.=$id->id_materia.",";//string de las claves de materias
            }
    
            $materias_ids = substr($materias_ids,0,-1);

            if(sizeof($materias_debe)==0){//si el estudiante debe nada
                $this->db->query("update Estudiante set tipo_ingreso='REINGRESO',estatus='REGULAR' where no_control='".$estudiante->Estudiante_no_control."'");
                $this->db->query("update Friae_Estudiante set tipo_ingreso_fin_semestre='REINGRESO', adeudos_fin_semestre=".sizeof($materias_debe).", id_materia_adeudos_fin_semestre='".$materias_ids."' where Estudiante_no_control='".$estudiante->Estudiante_no_control."' and Friae_folio=".$folio);
            }
    
            else if(sizeof($materias_debe)>0 && sizeof($materias_debe)<=3){// irregular reingreso
                $this->db->query("update Estudiante set tipo_ingreso='REINGRESO',estatus='IRREGULAR' where no_control='".$estudiante->Estudiante_no_control."'");
                $this->db->query("update Friae_Estudiante set tipo_ingreso_fin_semestre='REINGRESO', adeudos_fin_semestre=".sizeof($materias_debe).", id_materia_adeudos_fin_semestre='".$materias_ids."' where Estudiante_no_control='".$estudiante->Estudiante_no_control."' and Friae_folio=".$folio);
             
                
            }
    
            else if(sizeof($materias_debe)>3 && sizeof($materias_debe)<=5){//sin derecho
                $this->db->query("update Estudiante set tipo_ingreso='SIN DERECHO',estatus='IRREGULAR' where no_control='".$estudiante->Estudiante_no_control."'");
                $this->db->query("update Friae_Estudiante set tipo_ingreso_fin_semestre='SIN DERECHO', adeudos_fin_semestre=".sizeof($materias_debe).", id_materia_adeudos_fin_semestre='".$materias_ids."' where Estudiante_no_control='".$estudiante->Estudiante_no_control."' and Friae_folio=".$folio);
            }
    
            else if(sizeof($materias_debe)>5){//reprobado
                $this->db->query("update Estudiante set tipo_ingreso='REPROBADO',estatus='IRREGULAR' where no_control='".$estudiante->Estudiante_no_control."'");
                $this->db->query("update Friae_Estudiante set tipo_ingreso_fin_semestre='REPROBADO', adeudos_fin_semestre=".sizeof($materias_debe).", id_materia_adeudos_fin_semestre='".$materias_ids."' where Estudiante_no_control='".$estudiante->Estudiante_no_control."' and Friae_folio=".$folio);
              
            }
        }

        else{//si es baja
            $materias = $this->get_materias_cursando_estudiante_actual($estudiante->Estudiante_no_control);//materias de cada estudiante
            foreach($materias as $materia){
    
                $this->db->query("update Grupo_Estudiante set calificacion_final=0 where id_materia='".$materia->id_materia."' and Estudiante_no_control='".$estudiante->Estudiante_no_control."'");//agrega las calificaciones finales a cada materia
            }
            $this->db->query("update Friae_Estudiante set tipo_ingreso_fin_semestre='BAJA' where Estudiante_no_control='".$estudiante->Estudiante_no_control."' and Friae_folio=".$folio);
        }
    }

    //generar estatus
    
        

        
  

    $this->db->query("update Permiso_calificacion set estatus=0 where Plantel_cct_plantel='".$plantel."'");
    $this->db->query("update Permiso_regularizacion set estatus=0 where Plantel_cct_plantel='".$plantel."'");
    $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
            return "no";
        }

        else{
            return "si";
        }
    //fin generar estatus
   }



   function materias_cursando_estudiante($no_control){
        return $this->db->query("select * from Grupo_Estudiante as ge inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo and ge.Estudiante_no_control='".$no_control."'")->result();
    }

    function ultimo_semestre_de_grupo_cursado($no_control){
            return $this->db->query("select max(semestre) as semestre from Grupo_Estudiante as ge inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo where ge.Estudiante_no_control='".$no_control."' and estatus=0")->result();
    }


    function actualizar_tipo_ingreso_despues_calificar_estudiante(){//segunda/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*
        
        $this->db->trans_start();
        $estudiantes = $this->estudiantes_en_grupos_activos();
        

        
        foreach($estudiantes as $estudiante){
            $folio = $this->db->query("select max(Friae_folio) as folio from Friae_Estudiante where Estudiante_no_control='".$estudiante->no_control."'")->result()[0]->folio;
            $materias_debe = $this->M_regularizacion->materias_debe_estudiante_actualmente($estudiante->no_control);
            $materias_ids="";
            foreach($materias_debe as $id){
                $materias_ids.=$id->id_materia.",";
            }

            $materias_ids = substr($materias_ids,0,-1);
            
            
            if(sizeof($materias_debe)==0){
                $this->db->query("update Estudiante set tipo_ingreso='NUEVO INGRESO',estatus='REGULAR' where no_control='".$estudiante->no_control."'");
                $this->db->query("update Friae_Estudiante set tipo_ingreso_fin_semestre='NUEVO INGRESO', adeudos_fin_semestre=".sizeof($materias_debe).", id_materia_adeudos_fin_semestre='".$materias_ids."' where Estudiante_no_control='".$estudiante->no_control."' and Friae_folio=".$folio);
            }

            else if(sizeof($materias_debe)>0 && sizeof($materias_debe)<=3){
                $this->db->query("update Estudiante set tipo_ingreso='NUEVO INGRESO',estatus='IRREGULAR' where no_control='".$estudiante->no_control."'");
                $this->db->query("update Friae_Estudiante set tipo_ingreso_fin_semestre='NUEVO INGRESO', adeudos_fin_semestre=".sizeof($materias_debe).", id_materia_adeudos_fin_semestre='".$materias_ids."' where Estudiante_no_control='".$estudiante->no_control."' and Friae_folio=".$folio);
             
                
            }

            else if(sizeof($materias_debe)>3 && sizeof($materias_debe)<=5){
                $this->db->query("update Estudiante set tipo_ingreso='SIN DERECHO',estatus='IRREGULAR' where no_control='".$estudiante->no_control."'");
                $this->db->query("update Friae_Estudiante set tipo_ingreso_fin_semestre='SIN DERECHO', adeudos_fin_semestre=".sizeof($materias_debe).", id_materia_adeudos_fin_semestre='".$materias_ids."' where Estudiante_no_control='".$estudiante->no_control."' and Friae_folio=".$folio);
            }

            else if(sizeof($materias_debe)>5){
                $this->db->query("update Estudiante set tipo_ingreso='REPETIDOR',estatus='IRREGULAR' where no_control='".$estudiante->no_control."'");
                $this->db->query("update Friae_Estudiante set tipo_ingreso_fin_semestre='REPETIDOR', adeudos_fin_semestre=".sizeof($materias_debe).", id_materia_adeudos_fin_semestre='".$materias_ids."' where Estudiante_no_control='".$estudiante->no_control."' and Friae_folio=".$folio);
              
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



    public function cerrar_periodo($datos){
        $this->db->trans_start();

        $estudiantes_en_grupos = $this->estudiantes_en_grupos_activos();
        //return json_encode($estudiantes_en_grupos);

        foreach($estudiantes_en_grupos as $estudiante){
            
            if($estudiante->tipo_ingreso!="BAJA"){
            $materias_debe = $this->M_regularizacion->materias_debe_estudiante_actualmente($estudiante->no_control);
    
            
            $folio = $this->db->query("select max(Friae_folio) as folio from Friae_Estudiante where Estudiante_no_control='".$estudiante->no_control."'")->result()[0]->folio;//folio del friae

         $materias_ids="";
             //se saca la cadena de claves de materias que debe
             foreach($materias_debe as $id){
                 $materias_ids.=$id->id_materia.",";
             }
 
         $materias_ids = substr($materias_ids,0,-1);

         $this->db->query("update Friae_Estudiante set adeudos_segunda_regularizacion=".sizeof($materias_debe).",id_materia_adeudos_segunda_regularizacion='".$materias_ids."',tipo_ingreso_despues_regularizacion='".$estudiante->tipo_ingreso."' where Estudiante_no_control='".$estudiante->no_control."' and Friae_folio=".$folio);//aqui actualiza el friae en su segunda regularizacion

            if(sizeof($materias_debe)>=0 && sizeof($materias_debe)<=3){
                $this->db->query("update Estudiante set semestre_en_curso=semestre_en_curso+1 where no_control='".$estudiante->no_control."'");
            }
            

        }

        }


        $planteles = $this->db->query("select Plantel_cct_plantel from Regularizacion where estatus=1 group by Plantel_cct_plantel")->result();

        foreach($planteles as $plantel){

            $this->M_regularizacion->cerrar_regularizacion($plantel->Plantel_cct_plantel);

        }

            $this->db->query("SET SQL_SAFE_UPDATES = 0");
            $this->db->query("update Regularizacion set estatus=0");
            $this->db->query("update Permiso_regularizacion set estatus=0");
            $this->db->query("update Estudiante set semestre=semestre+1");
            $this->db->query("update Grupo set estatus=0");
            $this->db->query("SET SQL_SAFE_UPDATES = 0");
            $this->db->query("insert into Ciclo_escolar (fecha_matricula,nombre_ciclo_escolar,fecha_inicio,fecha_terminacion,periodo,fecha_inicio_inscripcion)
            values (".$datos->fecha_matricula.",'".$datos->nombre_ciclo."','".$datos->fecha_inicio."','".$datos->fecha_terminacion."','".$datos->periodo."','".$datos->fecha_inicio_inscripcion."')");
            

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