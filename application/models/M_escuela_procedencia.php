<?php
class M_escuela_procedencia extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }


   public function get_escuelas(){
       return $this->db->get('Escuela_procedencia')->result();
   }

   public function get_escuela($cct){
        return $this->db->get_where('Escuela_procedencia',array('cct_escuela_procedencia'=>$cct))->result();
   }

   public function get_secundarias(){

    return $this->db->query("select * from Escuela_procedencia where tipo_escuela_procedencia='SECUNDARIA'")->result();

   }

   public function get_bachilleratos(){

    return $this->db->query("select * from Escuela_procedencia where tipo_escuela_procedencia='BACHILLERATO'")->result();

   }

   public function insert_escuela($datos){
    return $this->db->insert('Escuela_procedencia',$datos);
}

   


}