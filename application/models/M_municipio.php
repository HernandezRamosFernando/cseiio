<?php
class M_municipio extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }


   function get_municipios_estado($id_estado){
        return $this->db->get_where('Municipio', array('Estado_id_estado' => $id_estado))->result();
   }

   

}