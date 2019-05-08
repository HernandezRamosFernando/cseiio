<?php
class M_materia extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }

   public function get_materias_semestre($semestre){
        return $this->db->query("select clave from Materia where semestre=".$semestre)->result();
   }

   public function get_materias_semestre_completo($semestre){
      return $this->db->query("select * from Materia where semestre=".$semestre)->result();
 }

   public function get_materias_semestre_componente($semestre,$id_componente){
      return $this->db->query("select * from Materia where semestre=".$semestre." and componente=".$id_componente)->result();
   }


   function get_lista(){

      $this->db->select('*');
      $this->db->from('Materia');
      $this->db->join('Componente', 'Componente.id_componente = Materia.componente');
      $this->db->order_by('Materia.semestre','asc');
      $resultado = $this->db->get()->result();
      return $resultado;
  
     }


     function get_materia($materia){
      $this->db->select('*');
      $this->db->from('Materia');
      $this->db->join('Componente', 'Componente.id_componente = Materia.componente');
      
       $this->db->where('Materia.clave',$materia);
      $resultado = $this->db->get()->row();
      return $resultado;
     }

     public function insertar_materia($datos){
    $this->db->trans_start();
        $this->db->insert('Materia', $datos);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
            return "no";
        }

        else{
            return "si";
        }
   }


    public function modificar_materia($datos,$clave){
        $this->db->trans_start();

        $this->db->where('clave',$clave);
        $this->db->update('Materia',$datos);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
            return "no";
        }

        else{
            return "si";
        }
      
   }


 function eliminar_materia($clave_eliminar){

   $this->db->trans_start();
    $this->db->delete('Materia', array('clave' => $clave_eliminar)); 
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