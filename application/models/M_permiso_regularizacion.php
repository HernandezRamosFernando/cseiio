<?php
class M_permiso_regularizacion extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }


   public function obtener_permiso_plantel_materia($plantel,$materia){
        return $this->db->query("select * from Permiso_regularizacion where Plantel_cct_plantel='".$plantel."' and id_materia='".$materia."' and curdate() between fecha_inicio and fecha_fin")->result();
    }
}