<?php
class M_permiso_regularizacion extends CI_Model { 
   public function __construct() {
      parent::__construct();
      $this->load->model("M_regularizacion");
   }


   public function obtener_permiso_plantel_materia($plantel,$materia){
        return $this->db->query("select * from Permiso_regularizacion where Plantel_cct_plantel='".$plantel."' and id_materia='".$materia."' and curdate() between fecha_inicio and fecha_fin and estatus=1")->result();
    }


    public function agregar_permiso_todos_planteles($datos){
      $this->db->trans_start();
      $this->db->query("SET SQL_SAFE_UPDATES = 0");
      $this->db->query("update Permiso_regularizacion set estatus=0");
      $this->db->query("SET SQL_SAFE_UPDATES = 1");
      foreach($datos as $permiso_plantel){//para cada plante;
         $materias = $this->M_regularizacion->materias_con_reprobados_html_regularizacion($permiso_plantel->plantel);
         foreach($materias as $materia){// para cada una de las materias que tienen que abrir
            $this->db->query("insert into Permiso_regularizacion (usuario,id_materia,Plantel_cct_plantel,fecha_inicio,fecha_fin,estatus)
            values ('".$permiso_plantel->usuario."','".$materia->id_materia."','".$permiso_plantel->plantel."','".$permiso_plantel->fecha_inicio."','".$permiso_plantel->fecha_fin."',1)");
         }
      }

      $this->db->trans_complete();
      
      if ($this->db->trans_status() === FALSE)
      {
         return "no";
      }

      else{
         return "si";
      }
      
  }



  public function agregar_permiso_plantel_materia($datos){
   $this->db->trans_start();
   $this->db->query("update Permiso_regularizacion set estatus=0 where Plantel_cct_plantel='".$datos->plantel."' and id_materia='".$datos->id_materia."'");

   $this->db->query("insert into Permiso_regularizacion (usuario,id_materia,Plantel_cct_plantel,fecha_inicio,fecha_fin,estatus)
   values ('".$datos->usuario."','".$datos->id_materia."','".$datos->plantel."','".$datos->fecha_inicio."','".$datos->fecha_fin."',1)");

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