<?php
class M_friae extends CI_Model { 
   public function __construct() {
      parent::__construct();
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

        $materias_debiendo = $this->db->query("select id_materia from Grupo_Estudiante where calificacion_final<6 and Estudiante_no_control='".$estudiante_materia->no_control."' and id_materia not in (select id_materia from Regularizacion where calificacion>=6 and Estudiante_no_control='".$estudiante_materia->no_control."')")->result();
        $materias_id = "";
        foreach($materias_debiendo as $id_materia){
            $materias_id.=$id_materia->id_materia;
        }
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

}