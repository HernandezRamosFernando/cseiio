<?php
class M_nulidad_semestre extends CI_Model { 
   public function __construct() {
      parent::__construct();
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



public function materias_debe_estudiante_actualmente_nulidad($no_control){
   return $this->db->query("select id_materia from Grupo_Estudiante where calificacion_final<6 and Estudiante_no_control='".$no_control."' and id_materia not in (select id_materia from Regularizacion where calificacion>=6 and Estudiante_no_control='".$no_control."')")->result();
}




public function get_alumnos($id_plantel,$curp){
    $query = $this->db->query("select * from Estudiante e left join Plantel p on p.cct_plantel=e.Plantel_cct_plantel left join (select distinct ge.Estudiante_no_control,ge.Grupo_id_grupo,ge.Ciclo_escolar_id_ciclo_escolar,g.semestre,g.id_grupo,g.nombre_grupo,g.estatus from Grupo_Estudiante ge LEFT JOIN Grupo g on g.id_grupo=ge.Grupo_id_grupo where g.estatus=1) datos_grupo on e.no_control=datos_grupo.Estudiante_no_control left join (SELECT distinct n.no_control as estudiante_no_control,n.autorizado por_autorizar FROM Nulidad_semestre n where n.autorizado=0) nulidad on e.no_control=nulidad.estudiante_no_control where e.Plantel_cct_plantel like'".$id_plantel."%' and e.curp like'".$curp."%'")->result();
    return $query;
    
  }


public function solicitar_nulidad($datos_nulidad,$datos_estudiante_documentos){

            
            $this->db->trans_start();
            
            foreach($datos_estudiante_documentos as $documento){
               $this->db->insert('Documentacion',$documento);
            }

            $this->db->insert('Nulidad_semestre',$datos_nulidad);

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE)
            {
               print_r($this->db->error());
             
            }
               
            else{
               return "si";
              
            }

}

public function get_solicitantes_nulidad($id_plantel,$curp){
  $query = $this->db->query("select * from Nulidad_semestre n left join Estudiante e on n.no_control=e.no_control left join (select distinct ge.Estudiante_no_control,ge.Grupo_id_grupo,ge.Ciclo_escolar_id_ciclo_escolar,g.semestre,g.id_grupo,g.nombre_grupo,g.estatus from Grupo_Estudiante ge LEFT JOIN Grupo g on g.id_grupo=ge.Grupo_id_grupo where g.estatus=1) datos_grupo on n.no_control=datos_grupo.Estudiante_no_control where e.Plantel_cct_plantel like'".$id_plantel."%' and e.curp like'".$curp."%' order by n.autorizado,e.Plantel_cct_plantel;")->result();
    return $query;
}


public function get_alumno_datos_nulidad($id_nulidad){
  $query = $this->db->query("select * from Nulidad_semestre n where n.idnulidad_semestre=".$id_nulidad.";")->result();
    return $query;
}


function nulidad_semestre_estudiante($no_control,$semestre_hasta_el_que_anula,$datos_nulidad,$id_nulidad){
    $this->db->trans_start();


    $this->db->where('idnulidad_semestre',$id_nulidad);
    $this->db->update('Nulidad_semestre',$datos_nulidad);

    $estudiante = $this->db->query("select * from Estudiante where no_control='".$no_control."'")->result()[0];



        //grupo y semestre de los grupos cursados
        $grupo_semestre_cursados = $this->db->query("select distinct Grupo_id_grupo as grupo,semestre from Grupo_Estudiante as ge inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo where Estudiante_no_control='".$no_control."' order by semestre asc")->result();
        //actualizar el semestre en curso del estudinate por el del smeestre hasta el que anulo
        $this->db->query("update Estudiante set semestre_en_curso=".$semestre_hasta_el_que_anula." where no_control='".$no_control."'");

        foreach($grupo_semestre_cursados as $grupo_semestre){
            if(intval($grupo_semestre->semestre) >= intval($semestre_hasta_el_que_anula)){
                $this->db->query("update Grupo_Estudiante set calificacion_final=null where Grupo_id_grupo='".$grupo_semestre->grupo."' and Estudiante_no_control='".$no_control."'");
            }
        }


        $anular_regularizaciones = $this->db->query("select * from Regularizacion r inner join Materia m on r.id_materia=m.clave where r.Estudiante_no_control='".$no_control."' and semestre>=".intval($semestre_hasta_el_que_anula))->result();


        foreach($anular_regularizaciones as $regulizacion){
                $this->db->query("update Regularizacion set estatus=2 where id_materia='".$regulizacion->id_materia."' and Estudiante_no_control='".$no_control."'");
        }


        //$materias_debe = $this->materias_debe_estudiante_actualmente_nulidad($no_control);
        $materias_debe = $this->materias_debe_estudiante_actualmente($no_control);

        if(sizeof($materias_debe)==0){
            if($estudiante->tipo_ingreso=="SIN DERECHO"){
               $this->db->query("update Estudiante set tipo_ingreso='REPETIDOR',estatus='REGULAR' where no_control='".$no_control."'");
            }
            else{
               $this->db->query("update Estudiante set tipo_ingreso='REPETIDOR',estatus='REGULAR' where no_control='".$no_control."'");
            }
            
        }

        else if(sizeof($materias_debe)>0 && sizeof($materias_debe)<=3){
                
                if($estudiante->tipo_ingreso=="SIN DERECHO"){
                   $this->db->query("update Estudiante set tipo_ingreso='REPETIDOR',estatus='IRREGULAR' where no_control='".$no_control."'");
                 
                }
                
                else{
                   $this->db->query("update Estudiante set tipo_ingreso='REPETIDOR',estatus='IRREGULAR' where no_control='".$no_control."'");
                   
                }
            }

        if(intval($semestre_hasta_el_que_anula)==1){
            $this->db->query("update Estudiante set curp=null, tipo_ingreso='NULIDAD SEMESTRE' where no_control='".$no_control."'");
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