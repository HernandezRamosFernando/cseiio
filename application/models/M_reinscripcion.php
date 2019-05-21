<?php
class M_reinscripcion extends CI_Model { 
   public function __construct() {
      parent::__construct();
      $this->load->model('M_grupo_estudiante');
      $this->load->model("M_regularizacion");
   }


   public function estudiantes_en_grupos_activos(){
       return $this->db->query("select no_control,estatus,tipo_ingreso from Estudiante as e inner join (select distinct Estudiante_no_control from Grupo_Estudiante as ge inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo) as g on e.no_control=g.Estudiante_no_control")->result();
   }



   public function cerrar_calificaciones(){
    $this->db->trans_start();
    $estudiantes = $this->estudiantes_en_grupos_activos();
    foreach($estudiantes as $estudiante){
        $materias_estudiante = $this->materias_cursando_estudiante($estudiante->no_control);

        foreach($materias_estudiante as $materia){
            $primer_parcial = $materia->primer_parcial==null?0:intval($materia->primer_parcial);
            $segundo_parcial = $materia->segundo_parcial==null?0:intval($materia->segundo_parcial);
            $tercer_parcial = $materia->tercer_parcial==null?0:intval($materia->tercer_parcial);
            $examen_final = $materia->examen_final==null?0:intval($materia->examen_final);

            $promedio_modular = ($primer_parcial+$segundo_parcial+$tercer_parcial)/3;
            $promedio_final = ($promedio_modular+$examen_final)/2;
            $promedio_final = round($promedio_final,0,PHP_ROUND_HALF_UP);

            $this->db->query("update Grupo_Estudiante set calificacion_final=".$promedio_final." where id_materia='".$materia->id_materia."' and Estudiante_no_control='".$estudiante->no_control."'");

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

   public function reinscribir(){
    $this->db->trans_start();

       $estudiantes = $this->estudiantes_en_grupos_activos();

       //inicio materias de un estudiante
       foreach($estudiantes as $estudiante){
            if($estudiante->estatus=="" || $estudiante->estatus=="REGULAR"){

                $materias_estudiante = $this->materias_cursando_estudiante($estudiante->no_control);
                $contador_materias_reprobadas = 0;

                //recorrido de su carga de materias de el estudiante una por una
                foreach($materias_estudiante as $materia){
                    $primer_parcial = $materia->primer_parcial==null?0:intval($materia->primer_parcial);
                    $segundo_parcial = $materia->segundo_parcial==null?0:intval($materia->segundo_parcial);
                    $tercer_parcial = $materia->tercer_parcial==null?0:intval($materia->tercer_parcial);
                    $examen_final = $materia->examen_final==null?0:intval($materia->examen_final);

                    $promedio_modular = ($primer_parcial+$segundo_parcial+$tercer_parcial)/3;
                    $promedio_final = ($promedio_modular+$examen_final)/2;
                    $promedio_final = round($promedio_final,0,PHP_ROUND_HALF_UP);

                    $this->db->query("update Grupo_Estudiante set calificacion_final=".$promedio_final." where id_materia='".$materia->id_materia."' and Estudiante_no_control='".$estudiante->no_control."'");

                    if($promedio_final<6){
                        $contador_materias_reprobadas+=1;
                    }

                }
                //--------------- validacion del tipo deestatus que tendra el estudiante a partir de sus materias reprobadas
                if($contador_materias_reprobadas==0){
                    $this->db->query("update Estudiante set tipo_ingreso='NUEVO INGRESO',estatus='REGULAR',semestre_en_curso=semestre_en_curso+1 where no_control='".$estudiante->no_control."'");
                }


                else if($contador_materias_reprobadas<=3){
                    $this->db->query("update Estudiante set tipo_ingreso='NUEVO INGRESO',estatus='IRREGULAR',semestre_en_curso=semestre_en_curso+1 where no_control='".$estudiante->no_control."'");
                }

                else if($contador_materias_reprobadas>3 && $contador_materias_reprobadas<6){
                    $this->db->query("update Estudiante set tipo_ingreso='SIN DERECHO',estatus='IRREGULAR' where no_control='".$estudiante->no_control."'");
                }

                else if($contador_materias_reprobadas>=6){
                    $this->db->query("update Estudiante set tipo_ingreso='REPROBADO',estatus='IRREGULAR' where no_control='".$estudiante->no_control."'");
                }
                //----------------

                // fin recorrido de su carga de materias de el estudiante una por una

            }

            else if($estudiante->estatus=="IRREGULAR" && $estudiante->tipo_ingreso=='NUEVO INGRESO'){

                $materias_reprobadas = $this->M_grupo_estudiante->get_materias_reprobadas_estudiante_semestres_pasados($estudiante->no_control);
                $mtaerias_pasadas_regularizacion = $this->M_regularizacion->get_materias_pasadas_estudiante($estudiante->no_control);
                $materias_debe = sizeof($materias_reprobadas)-sizeof($mtaerias_pasadas_regularizacion);
                //aqui se valida si es irregular cuantas ya paso primero necesito las materias anteriores y luego las actuales
                $materias_estudiante = $this->materias_cursando_estudiante($estudiante->no_control);
                $contador_materias_reprobadas = 0;

                //recorrido de su carga de materias de el estudiante una por una
                foreach($materias_estudiante as $materia){
                    $primer_parcial = $materia->primer_parcial==null?0:intval($materia->primer_parcial);
                    $segundo_parcial = $materia->segundo_parcial==null?0:intval($materia->segundo_parcial);
                    $tercer_parcial = $materia->tercer_parcial==null?0:intval($materia->tercer_parcial);
                    $examen_final = $materia->examen_final==null?0:intval($materia->examen_final);

                    $promedio_modular = ($primer_parcial+$segundo_parcial+$tercer_parcial)/3;
                    $promedio_final = ($promedio_modular+$examen_final)/2;
                    $promedio_final = round($promedio_final,0,PHP_ROUND_HALF_UP);

                    $this->db->query("update Grupo_Estudiante set calificacion_final=".$promedio_final." where id_materia='".$materia->id_materia."' and Estudiante_no_control='".$estudiante->no_control."'");

                    if($promedio_final<6){
                        $contador_materias_reprobadas+=1;
                    }

                }

                $materias_reprobadas_total = $contador_materias_reprobadas+$materias_debe;

                

                if($materias_reprobadas_total<=3){
                    $this->db->query("update Estudiante set tipo_ingreso='NUEVO INGRESO',estatus='IRREGULAR',semestre_en_curso=semestre_en_curso+1 where no_control='".$estudiante->no_control."'");
                }

                else if($materias_reprobadas_total>3 && $materias_reprobadas_total<6){
                    $this->db->query("update Estudiante set tipo_ingreso='SIN DERECHO',estatus='IRREGULAR' where no_control='".$estudiante->no_control."'");
                }

                else if($materias_reprobadas_total>=6){
                    $this->db->query("update Estudiante set tipo_ingreso='REPROBADO',estatus='IRREGULAR' where no_control='".$estudiante->no_control."'");
                }

            }


            else if($estudiante->estatus=="IRREGULAR" && $estudiante->tipo_ingreso=='REPROBADO'){


            }

            else if ($estudiante->estatus=="IRREGULAR" && $estudiante->tipo_ingreso=='INCORPORADO'){

            }

            

            
       }
       //fin materias de un estudiante
       $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
                return "no";
        }

        else{
            return "si";
        }
   }

   function materias_cursando_estudiante($no_control){
        return $this->db->query("select * from Grupo_Estudiante as ge inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo and ge.Estudiante_no_control='".$no_control."'")->result();
    }

    function ultimo_semestre_de_grupo_cursado($no_control){
            return $this->db->query("select max(semestre) as semestre from Grupo_Estudiante as ge inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo where ge.Estudiante_no_control='".$no_control."' and estatus=0")->result();
    }




}