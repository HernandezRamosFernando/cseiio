<?php
class M_componente extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }



   public function get_id_componente($nombre_corto_componente){
        return $this->db->query("select id_componente from Componente where nombre_corto='".$nombre_corto_componente."'")->result();
   }


   public function get_lista(){
   	$this->db->select('*');
     $this->db->from('Componente');
     $this->db->order_by('nombre','asc');
     return $this->db->get()->result();
   }


   public function insertar_componente($datos){
        $this->db->trans_start();
        $this->db->insert('Componente', $datos);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
            return "no";
        }

        else{
            return "si";
        }

   }


public function get_componente($componente){

      $this->db->select('*');
      $this->db->from('Componente');
       $this->db->where('id_componente',$componente);
      $resultado = $this->db->get()->row();
      return $resultado;
  
     }


     public function modificar_componente($datos,$id){
        $this->db->trans_start();

        $this->db->where('id_componente',$id);
        $this->db->update('Componente',$datos);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
            return "no";
        }

        else{
            return "si";
        }
      

   }


   function eliminar_componente($id){

   $this->db->trans_start();
    $this->db->delete('Componente', array('id_componente' => $id)); 
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