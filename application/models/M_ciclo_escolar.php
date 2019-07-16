<?php
class M_ciclo_escolar extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }


   public function get_ciclo_escolar(){
        return $this->db->query('SELECT * FROM Ciclo_escolar WHERE fecha_inicio = ( SELECT  MAX(fecha_inicio) FROM Ciclo_escolar);')->result();
   }

   public function get_datos_siguiente_ciclo(){
      $registros_ciclo = $this->db->query("select count(*) as n from Ciclo_escolar where nombre_ciclo_escolar=(select nombre_ciclo_escolar from Ciclo_escolar where fecha_inicio= (select max(fecha_inicio) from Ciclo_escolar))")->result();
      if($registros_ciclo[0]->n<2){
         return $this->get_ciclo_escolar();
      }
      
      else{
         return array(array('respuesta'=>true),
         $this->get_ciclo_escolar()[0]);
      }
   }



   public function agregar_ciclo_escolar($datos){
      $this->db->trans_start();
      $this->db->query("insert into Ciclo_escolar (fecha_matricula,nombre_ciclo_escolar,fecha_inicio,fecha_terminacion,periodo)
      values (".$datos->fecha_matricula.",'".$datos->nombre_ciclo."','".$datos->fecha_inicio."','".$datos->fecha_terminacion."','".$datos->periodo."')");
      $this->db->trans_complete();

      if ($this->db->trans_status() === FALSE)
      {
            return "no";
      }

      else{
         return "si";
      }
   }

   public function lista_ciclo_escolar(){
      return $this->db->query('SELECT * FROM Ciclo_escolar')->result();
 }

 public function obtener_nombre_ciclo_escolar($ciclo){
   return $this->db->query('SELECT * FROM Ciclo_escolar where id_ciclo_escolar='.$ciclo.'')->result();
}


public function ciclo_escolar_fecha($fecha){

   return $this->db->query("select * from Ciclo_escolar where '".$fecha."' between fecha_inicio and fecha_terminacion")->result()[0];
        
}

public function ciclo_escolar_x_periodo($periodo){

   return $this->db->query("SELECT * FROM Ciclo_escolar where periodo='".$periodo."';")->result();
        
}


public function fecha_inscripcion(){
   return $this->db->query("select max(fecha_inicio) as fecha from Ciclo_escolar")->result()[0]->fecha;
}


public function fecha_fin_ciclo(){
   return $this->db->query("select max(fecha_terminacion) as fecha from Ciclo_escolar")->result()[0]->fecha;
}

}