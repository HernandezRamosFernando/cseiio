<?php
class M_permisos extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }



   public function agregar_permisos($datos){
    $this->db->trans_start();
    foreach($datos as $dato){
        $primer_parcial = $dato->primer_parcial==1?1:0;
        $segundo_parcial = $dato->segundo_parcial==1?1:0;
        $tercer_parcial = $dato->tercer_parcial==1?1:0;
        $examen_final = $dato->examen_final==1?1:0;
        $this->db->query("insert into Permiso_calificacion (Plantel_cct_plantel,usuario,primer_parcial,segundo_parcial,tercer_parcial,examen_final,fecha_inicio,fecha_fin)
        values ('".$dato->cct_plantel."','".$dato->usuario."',".$primer_parcial.",".$segundo_parcial.",".$tercer_parcial.",".$examen_final.",'".$dato->fecha_inicio."','".$dato->fecha_fin."')");
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
        return $this->db->query("select * from Permiso_calificacion where id_permiso = (select max(id_permiso) from Permiso_calificacion where Plantel_cct_plantel='".$plantel."')")->result();
   }
}