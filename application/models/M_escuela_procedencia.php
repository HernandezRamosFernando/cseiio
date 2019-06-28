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

   

   public function get_escuela_procedencia_repetidor($no_control){
  return $this->db->query("SELECT * FROM Estudiante_Escuela_procedencia ep inner join Escuela_procedencia e on e.cct_escuela_procedencia=ep.Escuela_procedencia_cct_escuela_procedencia where Estudiante_no_control='".$no_control."' and tipo_escuela_procedencia='BACHILLERATO';")->result();

}


}