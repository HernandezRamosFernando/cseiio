<?php
class M_localidad extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }


   function get_localidades_municipio($id_municipio){
        return $this->db->get_where('Localidad', array('Municipio_id_municipio' => $id_municipio))->result();
   }

   function get_estado_municipio_localidad($id_localidad){
      $this->db->select('id_localidad,id_municipio,id_estado');
      $this->db->from('Localidad');
      $this->db->join('Municipio','Localidad.Municipio_id_municipio = Municipio.id_municipio','inner');		
      $this->db->join('Estado','Municipio.Estado_id_estado = Estado.id_estado','inner');
      $this->db->where('id_localidad', $id_localidad);
      return $this->db->get()->result();
   }
   
   function get_nombre_estado_municipio_localidad($id_localidad){
      $this->db->select('id_localidad,nombre_localidad, id_municipio,nombre_municipio,nombre_estado,id_estado');
      $this->db->from('Localidad');
      $this->db->join('Municipio','Localidad.Municipio_id_municipio = Municipio.id_municipio','inner');     
      $this->db->join('Estado','Municipio.Estado_id_estado = Estado.id_estado','inner');
      $this->db->where('id_localidad', $id_localidad);
      return $this->db->get()->result();
   }

}