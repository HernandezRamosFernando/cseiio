<?php
class M_datos_secundaria extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }


   function get_datos_secundaria_aspirante($no_control){
    return $this->db->get_where('Datos_Secundaria', array('Aspirante_no_control' => $no_control))->result();

   }
}