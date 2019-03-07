<?php
class M_documentacion extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }


   function get_documentacion_aspirante($no_control){
    return $this->db->get_where('Documentacion', array('Aspirante_no_control' => $no_control))->result();

   }

}