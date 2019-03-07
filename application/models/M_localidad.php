<?php
class M_localidad extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }


   function get_localidades_municipio($id_municipio){
        return $this->db->get_where('Localidad', array('Municipio_id_municipio' => $id_municipio))->result();
   }

}