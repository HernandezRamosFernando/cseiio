<?php
class M_permisos_extemporaneo extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }

   public function lista_permisos(){
    return $this->db->query("SELECT *,if(curdate() between fecha_inicio and fecha_fin,1,0) as fecha FROM Permisos_extemporaneo p inner join Estudiante e on e.no_control=p.Estudiante_no_control where p.estatus=1 order by primer_apellido,segundo_apellido,nombre;")->result();
}

   public function busqueda_alumnos_grupo($curp,$cct_plantel){
    return $this->db->query("SELECT * FROM Estudiante e inner join Grupo_Estudiante ge on e.no_control=ge.Estudiante_no_control inner join Grupo g on ge.Grupo_id_grupo=g.id_grupo where g.estatus=1 and curp like '%".$curp."%' and Plantel_cct_plantel like '%".$cct_plantel."%' group by e.no_control order by e.primer_apellido,e.segundo_apellido,e.nombre,e.semestre_en_curso;")->result();
}
   
   public function permisos_cal_extemporaneo_plantel($plantel){
    return $this->db->query("SELECT * from Permisos_extemporaneo where estatus=1 and curdate() between fecha_inicio and fecha_fin and Plantel_cct_plantel='".$plantel."'  limit 1;")->result();
}

   function get_estudiantes_por_calificar_extemporaneo($id_grupo,$id_materia){
    $registros = $this->db->query("SELECT *,p.primer_parcial as p1,p.segundo_parcial as p2,p.tercer_parcial as p3,p.examen_final as final FROM Permisos_extemporaneo p inner join Estudiante e on e.no_control=p.Estudiante_no_control inner join Grupo_Estudiante ge on e.no_control=ge.Estudiante_no_control inner join Materia m on ge.id_materia=m.clave where id_grupo='".$id_grupo."' and p.estatus=1 and p.id_materia='".$id_materia."' and ge.id_materia='".$id_materia."' group by e.no_control order by primer_apellido,segundo_apellido,nombre;")->result();
    return $registros;
 }
  
   function get_materias_por_calificar_extemporaneo($id_grupo){
    $registros = $this->db->query("SELECT p.id_grupo,m.clave,m.unidad_contenido FROM Permisos_extemporaneo p inner join Materia m on p.id_materia=m.clave where p.id_grupo='".$id_grupo."' and estatus=1 group by m.clave;")->result();
    return $registros;
 }

   function get_semestre_grupos_htmloption($plantel,$semestre){
    $registros = $this->db->query("SELECT p.id_grupo,nombre_grupo FROM Permisos_extemporaneo p inner join Grupo g on p.id_grupo=g.id_grupo where semestre=".$semestre." and p.estatus=1 and Plantel_cct_plantel='".$plantel."' group by p.id_grupo;")->result();
    $respuesta = "";
    $respuesta.='<option value="'."".'">'."Seleccione grupo".'</option>';
    foreach($registros as $registro){
       $respuesta.='<option value="'.$registro->id_grupo.'">'.$registro->nombre_grupo.'</option>';
    }
    return $respuesta;
 }
  
   function get_semestres_htmloption($plantel){
    $registros = $this->db->query("SELECT semestre FROM Permisos_extemporaneo p inner join Materia m on p.id_materia=m.clave where Plantel_cct_plantel='".$plantel."' and estatus=1 and CURDATE()>=fecha_inicio and curdate()<=fecha_fin group by semestre;")->result();
    $respuesta = "";
    $respuesta.='<option value="'."".'">'."Seleccione semestre".'</option>';
    foreach($registros as $registro){
       $respuesta.='<option value="'.$registro->semestre.'">'.$registro->semestre.'</option>';
    }
    return $respuesta;
 }


   public function get_datos_materia($id_grupo){
        return $this->db->query("select clave, unidad_contenido from Grupo_Estudiante ge inner join Materia m on ge.id_materia=m.clave where Grupo_id_grupo='".$id_grupo."' group by ge.id_materia order by ge.id_materia")->result();
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
                                $this->db->insert('Permisos_extemporaneo', $datos);
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


            if($calificaciones_estudiante->examen_final!=null){
              /* if($calificaciones_estudiante->primer_parcial!=null && $calificaciones_estudiante->segundo_parcial!=null && $calificaciones_estudiante->tercer_parcial!=null){*/
               
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
            $this->db->query("update Permisos_extemporaneo set estatus=0 where id_materia='".$id_materia."' and id_grupo='".$id_grupo."' and Estudiante_no_control='".$calificaciones_estudiante->no_control."'");
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
?>