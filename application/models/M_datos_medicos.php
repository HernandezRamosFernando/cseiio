<?php
class M_datos_medicos extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }


   public function get_datos_medicos_aspirante($no_control){
        return $this->db->get_where('Datos_medicos_aspirante',array('Aspirante_no_control' => $no_control))->result();
   }
}