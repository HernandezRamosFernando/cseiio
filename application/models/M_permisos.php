<?php
class M_permisos extends CI_Model { 
   public function __construct() {
      parent::__construct();
      $this->load->model('M_grupo');
   }



   public function agregar_permisos($datos){
    $this->db->trans_start();

    if(sizeof($datos)==1){//Plantel_cct_plantel
        $this->db->query("update Permiso_calificacion set estatus=0 where Plantel_cct_plantel='".$datos[0]->cct_plantel."'");
    }

    else{
        $this->db->query("update Permiso_calificacion set estatus=0");
    }
    

    foreach($datos as $dato){
        $grupos = $this->M_grupo->get_grupos_activos_plantel($dato->cct_plantel);

        foreach($grupos as $grupo){
        $materias = $this->M_grupo->get_materias_grupo($grupo->id_grupo);//id_materia=clave

        foreach($materias as $materia){
        $primer_parcial = $dato->primer_parcial==1?1:0;
        $segundo_parcial = $dato->segundo_parcial==1?1:0;
        $tercer_parcial = $dato->tercer_parcial==1?1:0;
        $examen_final = $dato->examen_final==1?1:0;
        $this->db->query("insert into Permiso_calificacion (Plantel_cct_plantel,usuario,primer_parcial,segundo_parcial,tercer_parcial,examen_final,fecha_inicio,fecha_fin,id_grupo,id_materia,estatus)
        values ('".$dato->cct_plantel."','".$dato->usuario."',".$primer_parcial.",".$segundo_parcial.",".$tercer_parcial.",".$examen_final.",'".$dato->fecha_inicio."','".$dato->fecha_fin."','".$grupo->id_grupo."','".$materia->clave."',1)");
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



   public function get_permiso_plantel($plantel){
        return $this->db->query("select * from Permiso_calificacion where id_permiso=(select max(id_permiso) from Permiso_calificacion where Plantel_cct_plantel='".$plantel."') and curdate() between fecha_inicio and fecha_fin")->result();
   }


   public function get_permisos_plantel_grupo_materia($plantel,$grupo,$materia){
        return $this->db->query("select * from Permiso_calificacion where Plantel_cct_plantel='".$plantel."' and id_grupo='".$grupo."' and id_materia='".$materia."' and estatus=1 and curdate() between fecha_inicio and fecha_fin")->result();
    }

    public function permisos_calificaciones_activos(){
        return $this->db->query("select *,if(curdate() between fecha_inicio and fecha_fin,1,0) as fecha from Permiso_calificacion as pc inner join Plantel as p on pc.Plantel_cct_plantel=p.cct_plantel inner join Materia as m on pc.id_materia=m.clave where estatus=1")->result();
    }

    public function permisos_regularizaciones_activos(){
        return $this->db->query("select *,if(curdate() between fecha_inicio and fecha_fin,1,0) as fecha from Permiso_regularizacion as pg inner join Plantel as p on pg.Plantel_cct_plantel=p.cct_plantel inner join Materia as m on pg.id_materia=m.clave where estatus=1")->result();
    }

    public function permisos_regularizacion_plantel($plantel){
        return $this->db->query("select fecha_fin from Permiso_regularizacion where Plantel_cct_plantel='".$plantel."' and curdate() between fecha_inicio and fecha_fin limit 1")->result();
    }
}