<?php
class M_acreditacion extends CI_Model { 
   public function __construct() {
      parent::__construct();
      $this->load->model('M_materia');
      $this->load->model('M_componente');
      $this->load->model('M_grupo');
   }


   function numero_estudiantes_semestre_plantel($datos){
       return $this->db->query("select count(*) as total_estudiante from Estudiante where (tipo_ingreso = 'REINGRESO' or tipo_ingreso = 'REPETIDOR' or tipo_ingreso = 'INCORPORADO' or tipo_ingreso = 'TRASLADO' or tipo_ingreso = 'PORTABILIDAD' or tipo_ingreso = 'NUEVO INGRESO') and semestre_en_curso=".$datos['semestre']." and Plantel_cct_plantel='".$datos['cct']."'")->result();
   }



   function asesor_de_materia($materias_asesores,$clave_materia){
       $respuesta = "";
        foreach($materias_asesores as $materia_asesor){
            if($materia_asesor->materia==$clave_materia){
                $respuesta = $materia_asesor->asesor;
                break;
            }
        }

        return $respuesta;
   }

   



   function agregar_grupo($datos){
    //grupos de semestres normales sin especialidad
    if($datos->grupo->semestre<5){
        $id = $datos->grupo->plantel.$datos->grupo->semestre.$datos->grupo->ciclo_escolar.$datos->grupo->periodo.mb_strtoupper($datos->grupo->nombre_grupo);
        $materias = $this->M_materia->get_materias_semestre($datos->grupo->semestre);
        $nombre_grupo=mb_strtoupper($datos->grupo->nombre_grupo);
    }

    else{
        $valor_option = $datos->grupo->componente;
        $id_componente = explode("-",$valor_option)[0];
        $nombre_corto_componente = explode("-",$valor_option)[1];
        $id = $datos->grupo->plantel.$datos->grupo->semestre.$datos->grupo->ciclo_escolar.$datos->grupo->periodo.mb_strtoupper($datos->grupo->nombre_grupo).'-'.$nombre_corto_componente;
        $materias = $this->M_materia->get_materias_semestre_componente($datos->grupo->semestre,$id_componente);
        $nombre_grupo=mb_strtoupper($datos->grupo->nombre_grupo).'-'.$nombre_corto_componente;
    }
    //$id = $datos->grupo->plantel.$datos->grupo->semestre.$datos->grupo->ciclo_escolar.mb_strtoupper($datos->grupo->nombre_grupo);
    

    $this->db->trans_start();
    $this->db->insert('Grupo',array(
        'id_grupo'=>$id,
        'semestre'=>$datos->grupo->semestre,
        'nombre_grupo'=>$nombre_grupo,
        'plantel'=>$datos->grupo->plantel
    ));
    
    

    
    foreach(($datos->alumnos) as $alumno){

        foreach($materias as $materia){

            $this->db->insert('Grupo_Estudiante',array(
                'Grupo_id_grupo'=>$id,
                'Estudiante_no_control'=>$alumno,
                'Ciclo_escolar_id_ciclo_escolar'=>$datos->grupo->ciclo_escolar,
                'id_materia'=>$materia->clave,
                'id_asesor'=>$this->asesor_de_materia($datos->asesores_materia,$materia->clave)
                //'id_materia'=>

            ));

        }
       
    }

    //fin materias normales
    
    $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
                return "no";
        }

        else{
            return "si";
        }
        
        
   }

   public function agregar_estudiantes_grupo_editado($datos){

    
    $id_ciclo = $this->M_grupo->get_id_ciclo_grupo($datos->id_grupo)[0]->Ciclo_escolar_id_ciclo_escolar;
    $this->db->trans_start();

    if($datos->semestre<5){
        $materias = $this->M_materia->get_materias_semestre($datos->semestre);
        
    }

    else{
        $materias = $this->M_materia->get_materias_semestre_componente($datos->semestre,$id_componente);
        $id_componente = $this->M_componente->get_id_componente(explode("-",$datos->id_grupo)[1])[0]->id_componente;
    }


    foreach(($datos->estudiantes) as $estudiante){

        foreach($materias as $materia){

            $this->db->insert('Grupo_Estudiante',array(
                'Grupo_id_grupo'=>$datos->id_grupo,
                'Estudiante_no_control'=>$estudiante,
                'Ciclo_escolar_id_ciclo_escolar'=>$id_ciclo,
                'id_materia'=>$materia->clave,

            ));

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


   public function agregar_estudiantes_grupo($datos){
    $this->db->trans_start();

    if($datos->semestre<5){
        $materias = $this->M_materia->get_materias_semestre($datos->semestre);
        $id_grupo=$datos->id_grupo;
    }

    else{
        $materias = $this->M_materia->get_materias_semestre_componente($datos->semestre,$datos->id_componente);
        $id_grupo=$datos->id_grupo.'-'.$datos->componente;
    }

    

    foreach(($datos->estudiantes) as $estudiante){

        foreach($materias as $materia){

            $this->db->insert('Grupo_Estudiante',array(
                'Grupo_id_grupo'=>$id_grupo,
                'Estudiante_no_control'=>$estudiante,
                'Ciclo_escolar_id_ciclo_escolar'=>$datos->ciclo_escolar,
                'id_materia'=>$materia->clave,

            ));

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




   public function get_estudiantes_plantel_semestre($plantel,$semestre,$id_componente){

    if(intval($semestre)<6){
        return $this->db->query("select * from Estudiante where semestre_en_curso=".$semestre." and Plantel_cct_plantel='".$plantel."' and (tipo_ingreso='NUEVO INGRESO' or tipo_ingreso='REINGRESO' or tipo_ingreso='INCORPORADO' or tipo_ingreso='TRASLADO' or tipo_ingreso='PORTABILIDAD' or tipo_ingreso='REPETIDOR') and no_control not in (select distinct Estudiante_no_control from Grupo_Estudiante as ge inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo where semestre=".$semestre." and g.estatus=1) order by primer_apellido")->result(); 
    }

    else{
        return $this->db->query("select * from Estudiante as e inner join (select if(count(*)=9,Estudiante_no_control,null) as Estudiante_no_control from Grupo_Estudiante as ge inner join (select * from Materia where semestre = 5 and componente=".(intval($id_componente)).") as m on ge.id_materia=m.clave) as c on e.no_control=c.Estudiante_no_control where semestre_en_curso=6 and Plantel_cct_plantel='".$plantel."' and (tipo_ingreso='NUEVO INGRESO' or tipo_ingreso='REINGRESO' or tipo_ingreso='INCORPORADO' or tipo_ingreso='TRASLADO' or tipo_ingreso='PORTABILIDAD' or tipo_ingreso='REPETIDOR') and no_control not in (select distinct Estudiante_no_control from Grupo_Estudiante as ge inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo where semestre=6 and g.estatus=1)")->result();
    }
       
   }


   public function cerrar_calificaciones_plantel($plantel){
        return $this->db->query("select if(count(*)>0,'no','si') as respuesta from Grupo_Estudiante as ge inner join Estudiante as e on ge.Estudiante_no_control=e.no_control inner join Grupo as g on ge.Grupo_id_grupo=g.id_grupo where g.estatus=1 and examen_final is null and tipo_ingreso!='BAJA' and g.plantel='".$plantel."'")->result()[0];
   }
}
